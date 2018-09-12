<html>
<head>
  <link rel="stylesheet" type="text/css" href="edit_helpers_style.css">
  <link rel="stylesheet" type="text/css" href="responsive_css_box_style.css">
</head>
<body>
  <table>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact1</th>
            <th>Contact2</th>
            <th>pin</th>
            <th>User Name</th>
            <th>Password</th>
            <th id="actions">Actions</th>
            <th><input type="button" style="width:80px" value="Back" onclick="window.location.href='helpers.php'" /></th>
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
        <td>".$row["pin"]."</td>
        <form method='POST' action='".htmlspecialchars($_SERVER['PHP_SELF'])."'>
        <td >".$row["user"]."</td>
        <td>".$row["pwd"]."</td>
        <td><input type='button' value='Edit' class='EditClick rowbtn' onclick='editfn(this.id)' id='edit_".$row["user"]."' /><input type='button' value='Delete' onclick='delfn(this.id)' class='DeleteClick rowbtn' id='delete_".$row["user"]."' /></td>
        </form>
        </tr>";
       }
echo '</table>';
     }
    $conn->close();
    }
?>
<script>
function editfn(ebid)
{
  document.getElementById('id01').style.display='block';
}
function delfn(dbid)
{
  var helper_id=dbid.substring(7);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
    if(this.readyState == 4 && this.status == 200)
    {
      var xmlDoc=this.responseXML;
      var x=xmlDoc.getElementsByTagName("group");
      var status = x[0].childNodes[0].innerHTML;
      if(status=='delete_success')
      {
        alert("Helper Details are removed");
        window.location.reload();
      }
      else if(status=='delete_fail')
      {
        alert("Some error occured while deleting Helper Details");
      }
     }
    };
    xmlhttp.open("GET","delete_helper.php?helper_id="+helper_id,true);
    xmlhttp.send();
}
function backbtn()
{
  var z=confirm('All changes will be discarded');
  if(z==true){document.getElementById('id01').style.display='none';}
}
</script>
<!-- The Modal -->
<center>
<div id="id01" class="modal">
  <span onclick="document.getElementById('id01').style.display='none'" class="close" title="Close Modal">&times;</span>
  <!-- Modal Content -->
  <center>
  <h2>Edit the Details of helper:</h2>
  <form>
    <div class="container">
      <fieldset>
        <input id="fname" type="text" name="fname" autofocus placeholder="First Name">
        <input id="lname" type="text" name="lname" placeholder="Last Name">
        <input id="c1" type="text" name="c1" placeholder="Contact No.">
        <input id="c2" type="text" name="c2" placeholder="Alternate Contact No.(Optional)">
      </div>
      <br><br>
      <div>
      <button  class="evbuttons" id="updbtn">Update</button>
      <button  class="evbuttons" id="rstbtn">Reset</button>
    </div>
    </fieldset>
  </form>
  </center>
</div>
</center>
<!-- The Modal End-->
</body>
</html>
