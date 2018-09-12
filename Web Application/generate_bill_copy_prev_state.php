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

/*function bill()
{
  $servername="localhost";
  $username="root";
  $password="root";
  $dbname="martand";
  $conn= new mysqli($servername,$username,$password,$dbname);
  if($conn->connect_error)
  {
    die("Connection failed : ".$conn->connect_error);
  }
  $sql="INSERT INTO SALES(cust_name,billdate,user,total_amt) VALUES('".$_POST['custname']."','".$_POST['billdate']."','".$_SESSION['user']."',".$_POST['totbill'].");";
  if($conn->query($sql)==true)
  {
    echo '<script>alert("Bill created")</script>';
  }
  $conn->close();
}*/
if (isset($_POST['createbill']))
{
  bill();
}
if(isset($_GET['action']) && $_GET['action'] == 'callfunction'){
  signout();
}
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
     echo "<script>
     var nameAndExpiry = {};";
     while($row = $result->fetch_assoc())
     {
      echo "nameAndExpiry['".$row["med_name"]."'] =[";
      $sql1 = "SELECT exp_date,mrp FROM stock WHERE med_name='".$row["med_name"]."';";
      $result1 = $conn->query($sql1);
      if ($result1->num_rows > 0)
      {
        $counter=0;
        while($row1 = $result1->fetch_assoc())
        {
          echo "'".$row1["exp_date"]."'";
          if($counter==$result1->num_rows-1)
          {
            break;
          }
          echo ",";
          $counter++;
        }
        echo ",";
        echo "'".$row1["mrp"]."'];";
      }
    }
    echo "</script>";
   }
 }
$conn->close();
?>
<script>
function medlist(mid)
{
  var dd1=document.getElementById(mid);
  for(var i in nameAndExpiry)
  {
    var opt=document.createElement("option");
    opt.appendChild(document.createTextNode(i));
    opt.value=i;
    dd1.appendChild(opt);
  }
}
function expdatelist(medid,expid,mrpid,qid,did,aid)
{
  document.getElementById(qid).value="0";
  document.getElementById(did).value="0.00";
  document.getElementById(aid).value="0.00";
  var meddd = document.getElementById(medid);
  var expdd = document.getElementById(expid);
  var mrpBox = document.getElementById(mrpid);
  var selMed = meddd.options[meddd.selectedIndex].value;
  while (expdd.options.length)
  {
      expdd.remove(0);
  }
  var medList = nameAndExpiry[selMed];
  if (medList)
  {
      var i;
      for (i = 0; i < medList.length-1; i++)
      {
          var med1 = new Option(medList[i], i);
          expdd.options.add(med1);
      }
      mrpBox.value = medList[i];
  }
}
function calcTotAmt(totid1,tableid1)
{
  var totamt = document.getElementById(totid1);
  var table = document.getElementById(tableid1);
  var rowCount=table.rows.length;
  var y=0;
  for(var i=1;i<rowCount;i++)
  {
    y = y + parseFloat(table.rows[i].cells[6].childNodes[0].value);
  }
  totamt.value = "Rs. "+y.toFixed(2);
}
function calcAmt(mid,qid,did,aid,totid,tableid)
{
  var mrp = document.getElementById(mid);
  var qy = document.getElementById(qid);
  var dst = document.getElementById(did);
  var amt = document.getElementById(aid);
  var x = mrp.value * qy.value - dst.value/100*(mrp.value * qy.value);
  amt.value = x.toFixed(4);
  calcTotAmt(totid,tableid)
}
function addRow(tableid)
{
    var table=document.getElementById(tableid);
    var rowCount=table.rows.length;
    var cellCount=table.rows[0].cells.length;
    var row=table.insertRow(rowCount);
    var cells=[];
    for(var i=0;i<cellCount;++i)
    {
      cells[i]=row.insertCell(i);
      if(i!=1 && i!=2)
      {
        var element=document.createElement("input");
        if(i!=4)
        {element.type="text";}
        else if(i==4)
        {element.type="number";
         element.min=0;}
        element.id="inp"+"_"+i+"_"+rowCount;
      }
      else if (i==1 || i==2)
      {
        var element=document.createElement("select");
        if(i==1)
        {element.id="medicine"+"_"+rowCount;}
        else if(i==2)
        {element.id="exp"+"_"+rowCount;}
      }
      cells[i].appendChild(element);
    }
    cells[0].childNodes[0].name="sno";cells[0].childNodes[0].value=rowCount;
    cells[1].childNodes[0].name="medname";
    medlist(cells[1].childNodes[0].id);
    cells[2].childNodes[0].name="expiry";
    cells[3].childNodes[0].name="mrp";cells[3].childNodes[0].placeholder="MRP";cells[3].childNodes[0].value="0.00";
    cells[4].childNodes[0].name="qty";cells[4].childNodes[0].placeholder="Quantity";cells[4].childNodes[0].value="0";
    cells[5].childNodes[0].name="disc";cells[5].childNodes[0].placeholder="Discount";cells[5].childNodes[0].value="0.00";
    cells[6].childNodes[0].name="amt";cells[6].childNodes[0].placeholder="Amount";cells[6].childNodes[0].value="0.00";cells[6].childNodes[0].readOnly=true;
    cells[1].childNodes[0].addEventListener("change",myfn1);
    cells[4].childNodes[0].addEventListener("change",myfn2);
    cells[5].childNodes[0].addEventListener("change",myfn2);
    function myfn1()
    {
      expdatelist(cells[1].childNodes[0].id,cells[2].childNodes[0].id,cells[3].childNodes[0].id,cells[4].childNodes[0].id,cells[5].childNodes[0].id,cells[6].childNodes[0].id)
    }
    function myfn2()
    {
      calcAmt(cells[3].childNodes[0].id,cells[4].childNodes[0].id,cells[5].childNodes[0].id,cells[6].childNodes[0].id,"totbill","billtable");
    }
}
function delRow(totid,tableid)
{
    var table=document.getElementById(tableid);
    var rowCount=table.rows.length;
    if(rowCount>1)
    {
      table.deleteRow(rowCount-1);
    }
    calcTotAmt(totid,tableid)
}
</script>
<html
<head>
  <title>Bill</title>
  <link rel="stylesheet" type="text/css" href="generate_bill_style.css">
</head>
<body onload="addRow('billtable')">
 <div><ul>
   <li><a href="shop_home.php">Home</a></li>
   <li><a href="stock_management.php">Stock Management</a></li>
   <li><a class="active" href="javascript:void(0)">Create Bill</a></li>
   <li><a href="order.php">Itmes to be ordered</a></li>
   <li><a href="doctor.php">Doctor`s Corner</a></li>
   <li id="s"><a href="shop_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul></div>
 <br>
 <button onclick="addRow('billtable')" >Add a new Row</button>
 <button onclick="delRow('totbill','billtable')" >Delete Row</button>
 <center>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
     <div>
     <label for="custname"><b>Customer Name</b></label>
     <input style="margin-left:25px;" class="txtfld" type="text" name="custname" placholder="Enter Customer Name">
     <br><br>
     <label for="billdate"><b>Bill Date</b></label>
     <input style="margin-left:75px;" class="txtfld" type="date" name="billdate" id="billdate" placholder="Bill date" value="<?php echo date("Y-m-d");?>">
   </div>
   <br><br>
 <table id="billtable">
   <tr>
     <th>S.No.</th>
     <th>Medicine Name</th>
     <th>Expiry Date</th>
     <th>MRP</th>
     <th>Quantity</th>
     <th>Discount(in %)</th>
     <th>Amount</th>
   </tr>
</table>
<br>
<input type="txt" name="totbill" id="totbill" placeholder="Your total payable amount" />
<br>
<input type="submit" name="createbill" value="Create Bill" />
<br>
</form>
</center>
</body>
</html>
