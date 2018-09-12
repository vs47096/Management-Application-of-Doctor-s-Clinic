<?php
session_start();
function signout()
{
          // remove all session variables
          session_unset();
          // destroy the session
          session_destroy();
          header("location:login.php");

}
if(isset($_GET['action']) && $_GET['action'] == 'callfunction'){
  signout();
}
if(isset($_SESSION["firstvisit"]))
{
echo '<script>alert("Welcome Dr. Doctor_Name")</script>';
unset($_SESSION["firstvisit"]);
}
?>
<html
<head>
  <title>Action Page</title>
  <link rel="stylesheet" type="text/css" href="doctor_home_style.css">
</head>
<body>
 <div><ul>
   <li><a class="active" href="javascript:void(0)">Doctor`s Home</a></li>
   <li><a href="helpers.php">Helpers</a></li>
   <li><a href="sales.php">Sales</a></li>
   <li><a href="log.php">Log</a></li>
   <li><a href="chngpwd.php">Change Password</a></li>
   <li id="s"><a href="doctor_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div>
</body>
</html>
