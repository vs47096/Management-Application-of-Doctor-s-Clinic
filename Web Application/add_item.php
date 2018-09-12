<html>
<head>
  <link rel="stylesheet" type="text/css" href="add_item_style.css">
</head>
<body>
<?php
function myfunction()
{
  $x=0;
  if(isset($_POST['check']))
  {
  }
  else {
    $x=1;
  }
  if(empty($_POST['medname']) || empty($_POST['qty']) ||empty($_POST['expdate']) ||empty($_POST['recdate']) || empty($_POST['mrp']))
  {
   //if any field is left,c2 is optional
   echo '<script>alert("Fill all the Details");</script>';
  }
  else if($x==1)
  {
    if(empty($_POST['spec']))
    {
      echo '<script>alert("Either enter specification of medicine or select No specification check box");</script>';
    }
  }
  else if ($_POST['expdate'] <= $_POST['recdate'])
  {
   echo '<script>alert("Expiry date is before recieve date,check both dates");</script>';
  }
  else
  {
     //after every condition is met
     echo '<script>alert("every condition is met");</script>';
     $servername = "localhost";
     $username = "root";
     $password = "root";
     $dbname = "martand";
     // Create connection
     $conn = new mysqli($servername, $username, $password, $dbname);
     // Check connection
     if ($conn->connect_error)
     {
     die("Connection failed: " . $conn->connect_error);
     }
     $sql = "INSERT INTO STOCK (med_name,spec,qty,mrp,exp_date,rec_date) VALUES('".$_POST["medname"]."','".$_POST["spec"]."',".$_POST["qty"].",".$_POST["mrp"].",'".$_POST["expdate"]."','".$_POST["recdate"]."');";
     if ($conn->query($sql) === TRUE)
     {
     echo "<script>alert('Item added to stock');</script>";
     unset($_POST['addbtn']);
     }
     else {
       echo "<script>alert('Item not added');</script>";
     }
    $conn->close();
  }
}
if(isset($_POST["addbtn"]))
  {
  myfunction();
  }
if(isset($_POST["back"]))
{
  echo "<script>var z=confirm('All changes will be discarded');if(z==true){window.location.href='stock_management.php';}</script>";
}
?>
<script>
function disablespec(chkbox)
{
  var status=chkbox.checked?true:false;
  if(status==true)
  {
    document.getElementById('spec').readOnly=true;
    document.getElementById('spec').value="No specification";
  }
  else if(status==false)
  {
    document.getElementById('spec').readOnly=false;
    document.getElementById('spec').value="";
  }
}
</script>
<center>
<h2>Enter Medicine Details:</h2>
<form id="entryform" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <fieldset >
    <label style="float:left;">Medicine Name</label>
    <input id="medname" type="text" name="medname" placeholder="Enter Medicine Name" autofocus value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["medname"];}?>"></input>
    <div><label style="float:left;display:inline;">Specification</label>
    <input id="spec" type="text" name="spec" placeholder="Strength(10mg)/capacity(500ml)" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["spec"];}?>"></input>
    <div><input type="checkbox" name="check" class="spec_check" onchange="disablespec(this)"> <label for="check">No specification</label></div>
    <label style="float:left;">Quantity</label>
    <input id="qty" type="text" name="qty" placeholder="Enter Quantity" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["qty"];}?>"></input>
    <label style="float:left;">MRP</label>
    <input id="mrp" type="text" name="mrp" placeholder="Enter MRP" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["mrp"];}?>"></input>
    <label style="float:left;">Expiry Date</label>
    <input id="expdate" type="date" name="expdate" placeholder="Enter Expiry Date" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["expdate"];}?>"></input>
    <label style="float:left;">Receive Date</label>
    <input id="recdate" type="date" name="recdate" autocomplete="on" placeholder="Enter Receive Date" value="<?php if(isset($_POST["addbtn"])|isset($_POST["back"])){echo $_POST["recdate"];} else {echo date("Y-m-d");}?>"></input>
    <br>
    <button name="addbtn">Add</button>
    <button type="reset" name="rstbtn">Reset</button>
    <button name="back">Back</button>
  </fieldset>
</form>
</center>
</body>
</html>
