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
  <title>Action Page</title>
  <link rel="stylesheet" type="text/css" href="stock_management_style.css">
</head>
<body>
 <div><ul>
   <li><a href="shop_home.php">Home</a></li>
   <li><a class="active" href="javascript:void(0)">Stock Management</a></li>
   <li><a href="generate_bill.php">Create Bill</a></li>
   <li><a href="order.php">Itmes to be ordered</a></li>
   <li><a href="doctor.php">Doctor`s Corner</a></li>
   <li id="s"><a href="shop_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div>
 <br><br><br>
 <center><div>
 <button id='add_item' onclick='window.location.href="add_item.php"'>Add Items to Stock</button>
 <button id='view' onclick='window.location.href="view_stock.php"'>View Stock</button>
 </div></center>
</body>
</html>
