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
  <link rel="stylesheet" type="text/css" href="sales_style.css">
</head>
<body>
 <div><ul>
   <li><a href="doctor_home.php">Doctor`s Home</a></li>
   <li><a href="helpers.php">Helpers</a></li>
   <li><a class="active" href="javascript:void(0)">Sales</a></li>
   <li><a href="log.php">Log</a></li>
   <li><a href="chngpwd.php">Change Password</a></li>
   <li id="s"><a href="doctor_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div>
 <body>
   <center><table>
         <tr>
             <th>Customer ID</th>
             <th>Customer Name</th>
             <th>Bill Date</th>
             <th>Billed by</th>
             <th>Total Amount</th>
        </tr>
 <?php
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
      $sql = "SELECT * FROM sales;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0)
      {
       while($row = $result->fetch_assoc())
       {

         echo "<tr>
         <td>".$row["cust_id"]."</td>
         <td>".$row["cust_name"]."</td>
         <td>".$row["billdate"]."</td>
         <td>".$row["user"]."</td>
         <td>".$row["total_amt"]."</td>
         </tr>";
        }
        echo '</table></center>';
      }
      else {
        echo "<script>alert('No sales for the date');</script>";
      }
     $conn->close();
     }
 ?>

</body>
</html>
