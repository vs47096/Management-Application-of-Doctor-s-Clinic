<?php
session_start();
function signout()
{
          // remove all session variables
          session_unset();
          // destroy the session
          session_destroy();
          header("location:login.php");

}
function updatepwd()
{
  if(empty($_POST["oldpwd"]))
  {
    echo "<script>alert('Enter your Current password');</script>";
  }
  else if(empty($_POST["newpwd"]))
  {
    echo "<script>alert('Enter your new password');</script>";
  }
  else if(empty($_POST["cnfnewpwd"]))
  {
    echo "<script>alert('Confirm your new password by entering it again');</script>";
  }
  else if($_POST["newpwd"]!=$_POST["cnfnewpwd"])
  {
    echo "<script>alert('Password in both new password fields don`t match each other');</script>";
  }
  else if(isset($_POST["oldpwd"]) && isset($_POST["newpwd"]) && isset($_POST["cnfnewpwd"]))
  {
    $servername="localhost";
    $username="root";
    $password="root";
    $dbname="martand";
    //Create Coneection
    $conn=new mysqli($servername,$username,$password,$dbname);
    //check for error
    if($conn->connect_error)
    {
      die("Connection failed : ".$conn->connect_error);
    }
    $sql = "SELECT doctor,pwd FROM doc_cred where doctor='".$_SESSION["doctor"]."' AND pwd='".$_POST["oldpwd"]."';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {
     while($row = $result->fetch_assoc())
      {
       if($row["doctor"]==$_SESSION["doctor"] && $row["pwd"]=$_POST["oldpwd"] )
        {
         $sql="update doc_cred set pwd='".$_POST["newpwd"]."' where doctor='".$_SESSION["doctor"]."' AND pwd='".$_POST["oldpwd"]."';";
         if($conn->query($sql)==true)
          {
           echo "<script>alert('Password Changed Successfully');</script>";
          }
         else
         {
           echo "<script>alert('Sorry, Unable to change the password');</script>";
         }
        }
      }
    }
    else {
      echo "<script>alert('Password entered by you is not your current password');</script>";
    }
    $conn->close();
  }//mysql block
 }//function updatepwd end
if(isset($_GET['action']) && $_GET['action'] == 'callfunction'){
  signout();
}
if(isset($_POST["chngpwd"]))
{
  updatepwd();
}
if(isset($_POST["back"]))
{
  header("location:doctor_home.php");
  exit;
}
?>
<html
<head>
  <title>Chnage Password</title>
  <link rel="stylesheet" type="text/css" href="chngpwd_style.css">
</head>
<body>
 <div><ul>
   <li><a href="doctor_home.php">Doctor`s Home</a></li>
   <li><a href="helpers.php">Helpers</a></li>
   <li><a href="sales.php">Sales</a></li>
   <li><a href="log.php">Log</a></li>
   <li><a class="active" href="javascript:void(0)">Change Password</a></li>
   <li id="s"><a href="doctor_home.php?action=callfunction">Sign Out</a></li>
   <li id="s"><a>Logged in: <?php echo $_SESSION["user"];?></a></li>
 </ul>
 </div><br><br><br><br><br>
 <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
   <center><fieldset style="width:350;">
     <input type="text" name="oldpwd" autofocus placeholder="Current Password" value="<?php if(isset($_POST["rstbtn"])){echo "";}?>"></input>
     <input type="text" name="newpwd" placeholder="New Password" value="<?php if(isset($_POST["rstbtn"])){echo "";}?>"></input>
     <input type="text" name="cnfnewpwd" placeholder="Confirm New Password" value="<?php if(isset($_POST["rstbtn"])){echo "";}?>"></input>
     <br><br>
     <button name="chngpwd">Change password</button>
     <button name="rstbtn">Reset</button>
     <button name="back">Back</button>
   </fieldset></center>
</form>
</body>
</html>
