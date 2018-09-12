<?php
session_start();
 ?>
<html>
<head>
  <title>Login Page</title>
  <link rel="stylesheet" type="text/css" href="login_style.css">
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
     if(empty($_POST["userid"]) || empty($_POST["pwd"]))
     {
       echo '<script>alert("You can`t leave userID/Password field blank")</script>';
     }
     else
     {
     $u=$_POST["userid"];
     $p=$_POST["pwd"];
     $sql = "SELECT user,pwd FROM shop where user='$u';";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {
      while($row = $result->fetch_assoc())
      {
          if($row["user"]==$u && $row["pwd"]!=$p )
          {
            echo '<script>alert("Your password is wrong")</script>';
          }
          else if($row["user"]==$u && $row["pwd"]=$p )
          {
           $_SESSION["user"]=$u;
           header("Location:shop_home.php");
           exit;
          }
        }
      }
     else
     {
      echo '<script>alert("Sorry, This user dosn`t exist")</script>';
     }
    $conn->close();
    }
   }
  }

  if( isset( $_POST['userid']) && isset( $_POST['pwd']))
  {
   myFunction();
  }
  ?>
  <div class="mastercontainer">
  <div id="login_img_container">
    <img class="login_img" height="100%" src="login_picture.jpg">
  </div>
  <div id="gradient_background">
    <div id="loginformcontainer">
      <h1 id="loginformheading"> Welcome </h1>
      <form id="login_form" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST" align="center" >
        <fieldset style="border: none;">
        <h3  class="logintextfieldheading"><label for="input-id">User ID:</label></h3>
        <input id="input-id" class="logintextfields" type="text" placeholder="Enter your username here" autofocus name="userid" value="<?php if(isset($_POST['btn'])){echo $_POST['userid'];}?>">
        <br><br>
        <h3  class="logintextfieldheading"><label for="input-pwd">Password:</label></h3>
        <input id="input-pwd" class="logintextfields" type="password" placeholder="Enter your password here"name="pwd"><br>
        <br><br>
        <input class="text" type="submit" value="LOGIN" name="btn" id="loginbt">
        </fieldset>
        <h4 id="loginforminfo"> Please login to continue </h4>
        </form>
        <br>

    </div>
    </div>
  </div>
</div>
</body>
</html>
