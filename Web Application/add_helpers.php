<html>
<head>
  <link rel="stylesheet" type="text/css" href="add_helpers_style.css">
</head>
<body>
<?php
function myfunction()
{
if(empty($_POST['fname']) || empty($_POST['lname']) ||empty($_POST['c1']) ||empty($_POST['pwd1']) || empty($_POST['pwd2']) || empty($_POST["pin"]))
{
  //if any field is left,c2 is optional
  echo '<script>alert("Fill all the Details");</script>';
}
else if ($_POST['pwd1']!=$_POST['pwd2'])
  {
    //block,if passwords in both fields wrong
   echo '<script>alert("Password entered in both the fields don`t match");</script>';
  }
else
  {
     //after every condition is met
     $servername = "localhost";
     $username = "root";
     $password = "root";
     $dbname = "martand";

     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
   }

  $sql = "INSERT INTO shop (firstname, lastname, cont1,cont2,user,pwd,pin) VALUES('".$_POST["fname"]."','".$_POST["lname"]."','".$_POST["c1"]."','".$_POST["c2"]."','".$_POST["username"]."','".$_POST["pwd1"]."','".$_POST["pin"]."');";

   if ($conn->query($sql) === TRUE) {
     echo "<script>alert('Helper added to List');window.location.href='helpers_embed.php';</script>";
    }
   else if($conn->error=="Duplicate entry 'user' for key 'PRIMARY'"){
    echo '<script>alert("This username is already taken")</script>';
   }
   $conn->close();
 }
}
if(isset($_POST["addbtn"]))
  {
  echo '<script>alert("Add button is clicked");</script>';
  myfunction();
  }
if(isset($_POST["back"]))
{
  echo "<script>var z=confirm('All changes will be discarded');if(z==true){window.location.href='helpers.php';}</script>";
}
?>
<center>
<h2>Enter the Details of helper:</h2>
<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <fieldset >
    <input id="fname" type="text" name="fname" autofocus placeholder="First Name" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["fname"];} else if(isset($_POST["rstbtn"])){echo "";}?>"></input>
    <input id="lname" type="text" name="lname" placeholder="Last Name" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["lname"];} else if(isset($_POST["rstbtn"])){echo "";}?>"></input>
    <input id="c1" type="text" name="c1" placeholder="Contact No." value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["c1"];} else if(isset($_POST["rstbtn"])){echo "";}?>"></input>
    <input id="c2" type="text" name="c2" placeholder="Alternate Contact No.(Optional)" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["c2"];} else if(isset($_POST["rstbtn"])){echo "";}?>">
    <input id="username" type="text" name="username" placeholder="User Name" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["username"];} else if(isset($_POST["rstbtn"])){echo "";}?>"></input>
    <input id="pin" type="text" name="pin" placeholder="4-digit PIN" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["pin"];} else if(isset($_POST["rstbtn"])){echo "";}?>"></input>
    <input type="password" name="pwd1" placeholder="Password for Helper"></input>
    <input type="password" name="pwd2" placeholder="Confirm Password"></input>
    <br>
    <button name="addbtn">Add</button>
    <button name="rstbtn">Reset</button>
    <button name="back">Back</button>
  </fieldset>
</form>
</center>
</body>
</html>
