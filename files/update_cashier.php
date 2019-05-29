<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit'])){
	$name=$_POST['cashier_name'];
	if (!preg_match("/^[a-zA-Z ]*$/",name))
	  {
	  $nameErr = "Only letters and white space allowed";
	  }
	$sex=$_POST['cashier_sex'];
	$phone=$_POST['cashier_phone'];
	$id=$_POST['admin_id'];
 
// get value of id that sent from address bar
$cid=$_POST['cashier_name'];

// Retrieve data from database 
$sql="UPDATE CASHIER SET cashier_name='$lname', cashier_id='$cid',phone='$phone',username='$username', password='$pas' WHERE username='$username'";
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin.php");
}else{
$message1="<font color=red>Update Failed, Try again</font>";
}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php echo $user;?></title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
 <style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a> Pharmacy Sys</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php">Dashboard</a></li>
            <li><a href="stock.php">Stock</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
			<li><a href="admin_supplier.php">Supplier</a></li>
			<li><a href="logout.php">Logout</a></li>
			
		</ul>	
</div>
		</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <h4>Manage Users</h4> 
<hr/>	
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Update User</a></li>  
              
        </ul>  

        <div id="content_1" class="content">
		<?php echo $message1;?>
          <form name="myform" onsubmit="return validateForm(this);" action="update_cashier.php" method="post" >
			<table width="420" height="106" border="0" >	
				<tr><td align="center"><input name="cashier_name" type="text" style="width:170px" placeholder="Name" id="cashier_name" value="<?php include_once('connect_db.php'); echo $_GET['last_name']?>" /></td></tr>
				<tr><td align="center"><input name="staff_id" type="text" style="width:170px" placeholder="Staff ID" id="staff_id" value="<?php include_once('connect_db.php'); echo $_GET['staff_id']?>" /></td></tr>  
				<tr><td align="center"><input name="postal_address" type="text" style="width:170px" placeholder="Address" id="postal_address" value="<?php include_once('connect_db.php'); echo $_GET['postal_address']?>" /></td></tr>  
				<tr><td align="center"><input name="phone" type="text" style="width:170px" placeholder="Phone" id="phone" value="<?php include_once('connect_db.php'); echo $_GET['phone']?>" /></td></tr>  
				<tr><td align="center"><input name="email" type="email" style="width:170px" placeholder="Email" id="email"value="<?php include_once('connect_db.php'); echo $_GET['email']?>" /></td></tr>   
				<tr><td align="center"><input name="username" type="text" style="width:170px" placeholder="Username" id="username"value="<?php include_once('connect_db.php'); echo $_GET['username']?>" /></td></tr>
				<tr><td align="center"><input name="password" placeholder="Password" id="password"value="<?php include_once('connect_db.php'); echo $_GET['password']?>"type="password" style="width:170px"/></td></tr>
				<tr><td align="center"><input name="submit" type="submit" value="Update"/></td></tr>
            </table>
		</form>
		</div>  
    </div>  
</div>
</div>
<div id="footer" align="Center"> Pharmacy Sys 2013. Copyright All Rights Reserved</div>
</div>
</body>
</html>