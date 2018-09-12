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
     <group>";
     while($row = $result->fetch_assoc())
     {
      echo "<".$row["med_name"].">";
      $sql1 = "SELECT exp_date FROM stock WHERE med_name='".$row["med_name"]."';";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0)
      {
        $counter=0;
        while($row1 = $result1->fetch_assoc())
        {
          echo "<detail".$counter.">";
          echo "<date>".$row1["exp_date"]."</date>";
          echo "</detail".$counter.">";
          $counter++;
        }
      }
      echo "</".$row["med_name"].">";
     }
     echo "</group>";
   }
 }
$conn->close();
?>
