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
   $sql = "SELECT distinct med_name FROM stock;";
   $result = $conn->query($sql);
   if ($result->num_rows > 0)
   {
     echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
     <medname>";
     while($row = $result->fetch_assoc())
     {
       echo "<group>";
       echo "<name>".$row["med_name"]."</name>";
       echo "</group>";
     }
     echo "</medname>";
    }
  }
$conn->close();
?>
