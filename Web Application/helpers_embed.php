<html>
<head>
  <title>Helper`s list</title>
  <link rel="stylesheet" type="text/css" href="helpers_embed_style.css">
</head>
<body>
  <center><table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact1</th>
            <th>Contact2</th>
            <th>UserName</th>
            <th>Password</th>
            <th>PIN</th>
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
     $sql = "SELECT firstname,lastname,cont1,cont2,user,pwd,pin FROM shop;";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {

      while($row = $result->fetch_assoc())
      {

        echo "<tr>
        <td>".$row["firstname"]."</td>
        <td>".$row["lastname"]."</td>
        <td>".$row["cont1"]."</td>
        <td>".$row["cont2"]."</td>
        <td>".$row["user"]."</td>
        <td>".$row["pwd"]."</td>
        <td>".$row["pin"]."</td>
        </tr>";
       }
echo '</table></center>';
     }
    $conn->close();
    }
?>
