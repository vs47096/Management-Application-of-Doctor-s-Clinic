<?php
header('Content-type: text/xml');
$servername="localhost";
$username="root";
$password="root";
$dbname="martand";
$conn= new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
  die("Connection failed : ".$conn->connect_error);
}
else
{
   $sql = "SELECT mrp,qty FROM stock where exp_date='".$_GET['exp']."' AND med_name='".$_GET['name']."';";
   $result = $conn->query($sql);
   if ($result->num_rows > 0)
   {
     echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
     <group>";
     while($row = $result->fetch_assoc())
     {
       echo "<mrp>".$row["mrp"]."</mrp>";
       echo "<qty>".$row["qty"]."</qty>";
     }
   }
 echo "</group>";
}
$conn->close();
?>
