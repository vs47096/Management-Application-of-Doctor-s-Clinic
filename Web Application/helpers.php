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
?>
<html
<head>
  <title>Helpers</title>
  <link rel="stylesheet" type="text/css" href="helpers_style.css">
</head>
<body>
 <div><ul>
   <li><a href="doctor_home.php">Doctor`s Home</a></li>
   <li><a class="active" href="javascript:void(0)">Helpers</a></li>
   <li><a href="sales.php">Sales</a></li>
   <li><a href="log.php">Log</a></li>
   <li><a href="chngpwd.php">Change Password</a></li>
   <li id="s"><a href="doctor_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div>
 <h1>This page helps you to:</h1>
   <h3>
     <ol style="list-style-type:disc">
       <li>Add new helpers to list</li><br>
       <li>Edit Details of helpers</li><br>
       <li>Remove helpers name from list</li><br>
    </ol>
   </h3>
 </div>
 <center>
  <button id="add" class="button" onclick="add()">Add</button>
  <button id="edit" class="button" onclick="edit()">Edit/Delete</button>
</center>
<br>
<center>
   <iframe id="my" src="helpers_embed.php" height="200" width="970"></iframe>
 </center>
 <center>
   <script> function add()
   {
     window.location.href="add_helpers.php";
     //document.getElementById("add").disabled=true;
   }
   function edit()
   {
     window.location.href="edit_helpers.php";
     //document.getElementById("edit").disabled=true;
   }
   </script>

</center>
</body>
</html>
