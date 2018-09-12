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
  <title>Orders</title>
  <link rel="stylesheet" type="text/css" href="shop_home_style.css">
</head>
<body>
 <div><ul>
   <li><a href="shop_home.php">Home</a></li>
   <li><a href="stock_management.php">Stock Management</a></li>
   <li><a href="generate_bill.php">Create Bill</a></li>
   <li><a class="active" href="javascript:void(0)">Itmes to be ordered</a></li>
   <li><a href="doctor.php">Doctor`s Corner</a></li>
   <li id="s"><a href="shop_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div>

  <center><table>
        <tr>
            <th>Item ID</th>
            <th>Medicine Name</th>
            <th>Specification</th>
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
     $sql = "SELECT stock.item_id,med_name,spec FROM stock,stockorder WHERE stock.item_id=stockorder.item_id;";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {

      while($row = $result->fetch_assoc())
      {

        echo "<tr>
        <td>".$row["item_id"]."</td>
        <td>".$row["med_name"]."</td>
        <td>".$row["spec"]."</td>
        </tr>";
       }
echo '</table></center>';
     }
    $conn->close();
    }
?>
</body>
</html>
