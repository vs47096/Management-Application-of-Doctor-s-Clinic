<html>
<head>
  <title>Stock</title>
  <link rel="stylesheet" type="text/css" href="helpers_embed_style.css">
  <link rel="stylesheet" type="text/css" href="stock_management_style.css">
</head>
<body>
  <table style="float:left;">
        <tr>
            <th>Item ID</th>
            <th>Medicine Name</th>
            <th>Specification</th>
            <th>Quantity</th>
            <th>MRP</th>
            <th>Expiry Date</th>
            <th>Recieved Date</th>
            <th id="actions">Actions</th>
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
     $sql = "SELECT item_id,med_name,spec,qty,mrp,exp_date,rec_date FROM stock;";
     $result = $conn->query($sql);
     if ($result->num_rows > 0)
     {

      while($row = $result->fetch_assoc())
      {

        echo "<tr>
        <td>".$row["item_id"]."</td>
        <td>".$row["med_name"]."</td>
        <td>".$row["spec"]."</td>
        <td>".$row["qty"]."</td>
        <td>".$row["mrp"]."</td>
        <td>".$row["exp_date"]."</td>
        <td>".$row["rec_date"]."</td>
        <form method='POST' action='".htmlspecialchars($_SERVER['PHP_SELF'])."'>
        <td style='display:inline;'><div><button id='edit'  name='editbtn' >Edit</button><button id='delete' name='delbtn' >Delete</button></div></td>
        </form>
        </tr>";
       }
echo '</table>';
     }
    else
     {
      echo "<script>alert(\"No items in stock\");</script>";
     }
    $conn->close();
    }
?>
<button style="margin:10px;width:45px;height:40px"class="view_back" onclick="window.location.href='stock_management.php'">Back</button>
</body>
</html>
