<?php
session_start();
 ?>
<html>
<head>
  <title>Doctor Login Page</title>
  <link rel="stylesheet" type="text/css" href="doctor_style.css">
</head>
<body>
  <?php
  function myFunction()
  {
  $servername ="localhost";
  $username = "root";
  $password = "root";
  $dbname = "martand";
  $conn = new mysqli($servername,$username,$password,$dbname);
  if ($conn->connect_error)
    {
      die("Connection failed: " . $conn->connect_error);
    }
  else
   {
     if(empty($_POST["docid"]) || empty($_POST["pwd"]))
     {
       echo '<script>alert("You can`t leave userID/Password field blank")</script>';
     }
     else
     {
     $u=$_POST["docid"];
     $p=$_POST["pwd"];
     $sql = "SELECT doctor,pwd FROM doc_cred where doctor='$u';";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {
      while($row = $result->fetch_assoc())
      {
          if($row["doctor"]==$u && $row["pwd"]!=$p )
          {
            echo '<script>alert("Your password is wrong")</script>';
          }
          else if($row["doctor"]==$u && $row["pwd"]=$p )
          {
           $_SESSION["user"]=$u;
           $_SESSION["firstvisit"]="first";
           header("Location:doctor_home.php");
           exit;
          }
        }
      }
     else
     {
      echo '<script>alert("Please enter Doctor`s ID")</script>';
     }
    $conn->close();
    }
   }
  }

  if( isset( $_POST['docid']) && isset( $_POST['pwd']))
  {
   myFunction();
  }
  ?>
  <div><ul>
    <li><a href="shop_home.php">Home</a></li>
    <li><a href="stock_management.php">Stock Management</a></li>
    <li><a href="generate_bill.php">Create Bill</a></li>
    <li><a href="order.php">Itmes to be ordered</a></li>
    <li><a class="active" href="javascript:void(0)">Doctor`s Corner</a></li>
    <li id="s"><a href="shop_home.php?action=callfunction">Sign Out</a></li>
    <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
  </ul>
  </div>
  <center><img src="doctor-icon.png" alt="Doctor`s icon"align="center" width=170px height=170px></center><br>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" align="center" >
  <div>
  <center><fieldset  style=width:200px>
      <h3><label class="text" for="input-id">Doctor ID:</label></h3>
      <input id="inpur-id" placeholder="Username" type="text" autofocus name="docid">
      <br><br>
      <h3><label class="text" for="input-pwd">Password:</label></h3>
      <input id="input-pwd" placeholder="Password" type="password" name="pwd"><br>
      <br><br>
      <input class="text" type="submit" value="LOGIN" id="loginbt">
  </div>
</fieldset></center>
</form>
</body>
</html>
