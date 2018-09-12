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
if (isset($_POST['createbill']))
{
  //code for CreateBill button click
}
if(isset($_GET['action']) && $_GET['action'] == 'callfunction'){
  //signout button task
  signout();
}
?>
<script>
function calcTotAmt(discid1,totid1,tableid1)
{
  var totamt = document.getElementById(totid1);
  var table = document.getElementById(tableid1);
  var dsc = document.getElementById(discid1);
  var rowCount=table.rows.length;
  var y=0;
  for(var i=1;i<rowCount;i++)
  {
    y = y + parseFloat(table.rows[i].cells[6].childNodes[0].value);
  }
  var p=y-dsc.value/100*y;
  totamt.value = "Rs. "+p.toFixed(2);
}
function calcAmt(mid,qid,did,aid,dcid,totid,tableid)
{
  var mrp = document.getElementById(mid);
  var qy = document.getElementById(qid);
  var dst = document.getElementById(did);
  var amt = document.getElementById(aid);
  var x = mrp.value * qy.value - dst.value/100*(mrp.value * qy.value);
  amt.value = x.toFixed(4);
  calcTotAmt(dcid,totid,tableid)
}
function medlist(medid)
{
  var dd1=document.getElementById(medid);
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200)
  {
     var i;
     var xmlDoc=this.responseXML;
     var x=xmlDoc.getElementsByTagName("name");
     for(i=0;i<x.length;i++)
     {
       var opt=document.createElement("option");
       opt.appendChild(document.createTextNode(x[i].childNodes[0].nodeValue));
       opt.value=x[i].childNodes[0].nodeValue;
       dd1.appendChild(opt);
     }
  }
  };
   xmlhttp.open("GET","billmednameajax.php?",true);
   xmlhttp.send();
}
function expdatelist(medid,expid)
{
  var dd1=document.getElementById(medid);
  var dd2=document.getElementById(expid);
  var name=dd1.options[dd1.selectedIndex].value;
  while (dd2.options.length!=1)
  {
      dd2.remove(1);
  }
  var xmlhttp = new XMLHttpRequest();
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200)
  {
     var i;
     var xmlDoc=this.responseXML;
     var x=xmlDoc.getElementsByTagName(name);
     for(i=0;i<x[0].childNodes.length;i++)
     {
       var opt=document.createElement("option");
       opt.appendChild(document.createTextNode(x[0].childNodes[i].childNodes[0].innerHTML));
       opt.value=x[0].childNodes[i].childNodes[0].innerHTML;
       dd2.appendChild(opt);
     }
  }
  };
   xmlhttp.open("GET","billexpnameajax.php?",true);
   xmlhttp.send();
}
function fillElements(mid,eid,mrpid,qtyid,did,aid,dscid,billid,tbid)
{
  var dd1=document.getElementById(mid);
  var dd2=document.getElementById(eid);
  var tf1=document.getElementById(mrpid);
  var tf2=document.getElementById(qtyid);
  var tf3=document.getElementById(did);
  var tf4=document.getElementById(aid);
  var xmlhttp = new XMLHttpRequest();
  var med=dd1.options[dd1.selectedIndex].value;
  var expdate=dd2.options[dd2.selectedIndex].value;
  xmlhttp.onreadystatechange = function() {
  if (this.readyState == 4 && this.status == 200)
  {
     var xmlDoc=this.responseXML;
     var x=xmlDoc.getElementsByTagName("group");
     tf1.value=x[0].childNodes[0].innerHTML;
     tf2.max=x[0].childNodes[1].innerHTML;
     tf2.placeholder="Available - "+x[0].childNodes[1].innerHTML;
  }
  };
   xmlhttp.open("GET","billmrpqtyajax.php?name="+med+"&exp="+expdate,true);
   xmlhttp.send();
   calcAmt(tf1,tf2,tf3,tf4,dscid,billid,tbid);
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
        {
          element.id="medicine"+"_"+rowCount;
          var opt=document.createElement("option");
          opt.appendChild(document.createTextNode("Choose  a Medicine"));
          opt.value="Choose  a Medicine";
          element.appendChild(opt);
        }
        else if(i==2)
        {
          element.id="exp"+"_"+rowCount;
          var opt=document.createElement("option");
          opt.appendChild(document.createTextNode("Choose  expiry Date"));
          opt.value="Choose  expiry Date";
          element.appendChild(opt);
        }
      }
      cells[i].appendChild(element);
    }
    cells[0].childNodes[0].name="sno";cells[0].childNodes[0].value=rowCount;
    cells[1].childNodes[0].name="medname";
    medlist(cells[1].childNodes[0].id);
    cells[2].childNodes[0].name="expiry";
    cells[3].childNodes[0].name="mrp";cells[3].childNodes[0].placeholder="MRP";cells[3].childNodes[0].value="0.00";
    cells[4].childNodes[0].name="qty";cells[4].childNodes[0].placeholder="Quantity";
    cells[5].childNodes[0].name="disc";cells[5].childNodes[0].placeholder="Discount";cells[5].childNodes[0].value="0.00";
    cells[6].childNodes[0].name="amt";cells[6].childNodes[0].placeholder="Amount";cells[6].childNodes[0].value="0.00";cells[6].childNodes[0].readOnly=true;
    cells[1].childNodes[0].addEventListener("change",myfn1);
    cells[2].childNodes[0].addEventListener("change",myfn2);
    cells[4].childNodes[0].addEventListener("change",myfn3);
    cells[5].childNodes[0].addEventListener("change",myfn3);
    document.getElementById("discbill").addEventListener("change",myfn3);
    function myfn1()
    {
      cells[3].childNodes[0].value="0.00";
      cells[4].childNodes[0].value="";cells[4].childNodes[0].placeholder="Quantity";
      //cells[4].childNodes[0].max="0";
      cells[5].childNodes[0].value="0.00";
      cells[6].childNodes[0].value="0.00";
      expdatelist(cells[1].childNodes[0].id,cells[2].childNodes[0].id);
    }
    function myfn2()
    {
      fillElements(cells[1].childNodes[0].id,cells[2].childNodes[0].id,cells[3].childNodes[0].id,cells[4].childNodes[0].id,cells[5].childNodes[0].id,cells[6].childNodes[0].id,"discbill","totbill","billtable");
    }
    function myfn3()
    {
      calcAmt(cells[3].childNodes[0].id,cells[4].childNodes[0].id,cells[5].childNodes[0].id,cells[6].childNodes[0].id,"discbill","totbill","billtable");
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
    calcTotAmt(dicid,totid,tableid)
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
Discount on entire bill(%) -- <input type="txt" name="discbill" id="discbill" placeholder="Discount on entire bill(%)" value="0.00" />
<br><br>
<input type="txt" name="totbill" id="totbill" placeholder="Your total payable amount"/>
<br><br>
<input type="submit" name="createbill" value="Create Bill" />
<br>
</form>
</center>
</body>
</html>
