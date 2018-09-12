<?php
header('Content-type:text/xml');
$servername="localhost";
$username="root";
$password="root";
$dbname="martand";
$conn=new mysqli($servername,$username,$password,$dbname);
if($conn->connect_error)
{
  die("Connection Failed : ".$conn->connect_error);
}
else {
  $sql = "DELETE FROM shop WHERE user='".$_GET['helper_id']."';";
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>
  <group>";
  if ($conn->query($sql) === TRUE)
  {
    echo "<status>delete_success</status>";
  }
  else
  {
    echo "<status>delete_fail</status>";
  }
   echo "</group>";
}
?>
