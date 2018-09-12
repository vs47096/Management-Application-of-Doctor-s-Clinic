<?php
session_start();
function signout()
{
          // remove all session variables
          session_unset();
          // destroy the session
          session_destroy();
          echo '<script>alert("You have been logged out");</script>';
          header("location:login.php");

}
if(isset($_GET['action']) && $_GET['action'] == 'callfunction'){
  signout();
}
?>
<html
<head>
  <title>Home</title>
  <link rel="stylesheet" type="text/css" href="shop_home_style.css">
</head>
<body>
  <div class="navbar"><ul>
     <li><a class="active" href="javascript:void(0)">Home</a></li>
     <li><a href="stock_management.php">Stock Management</a></li>
     <li><a href="generate_bill.php">Create Bill</a></li>
     <li><a href="order.php">Itmes to be ordered</a></li>
     <li><a href="doctor.php">Doctor`s Corner</a></li>
     <li id="s"><a href="shop_home.php?action=callfunction">Sign Out</a></li>
     <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
   </ul>
   </div>
  <div class="video-container">
   <video class="video" autoplay>
     <source src="bg.mp4" type="video/mp4" />
     Your browser does not support video
   </video>
 </div>
 <div id="greetingtext">
   <h1 style="font-family:  cursive;color:  white;font-size: 52px;text-align:  center;"> Hi !</h1>
   <h3 style="color:  white;font-family:  serif;font-size: 51px;" > Welcome </h3>
 </div>
</body>
</html>
