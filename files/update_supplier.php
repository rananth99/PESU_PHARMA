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
$sid = $_POST['supplier_id'];
$name =$_POST['supplier_name'];
$sex=$_POST['supplier_sex'];
$phone=$_POST['supplier_phone'];
$cid=$_POST['cashier_id'];

// Retrieve data from database 
$sql=mysqli_query($con,"UPDATE SUPPLIER SET supplier_name='$name',supplier_sex='$sex',supplier_phone='$phone',cashier_id='$cid' WHERE supplier_id='$sid'");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/admin_supplier.php");
}else{
$msg="<font color=red>Update Failed, Try again</font>";
echo $msg;
}}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php $username?>PHARMACY</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<script src="js/function.js" type="text/javascript"></script>
 <style>#left-column {height: 477px;}
 #main {height: 477px;}</style>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a>  PESU PHARMA</h1></div>
<div id="left_column">
<div id="button">
<ul>
			<li><a href="admin.php">Dashboard</a></li>
			<li><a href="admin_pharmacist.php">Pharmacist</a></li>
			<li><a href="admin_manager.php">Manager</a></li>
			<li><a href="admin_cashier.php">Cashier</a></li>
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
		<?php 
			/*echo $msg;*/
		?>
       <form name="myform" onsubmit="return validateForm(this);" action="update_supplier.php" method="post" >
			<table width="420" height="106" border="0" >
				<tr><td align="center"><input name="supplier_id" type="text" style="width:170px" placeholder="SUpplier ID" id="supplier_id" value="<?php include_once('connect_db.php'); echo $_GET['supplier_id']?>" /></td></tr>
				<tr><td align="center"><input name="supplier_name" type="text" style="width:170px" placeholder="Name" id="supplier_name" /></td></tr>
				<tr><td align="center"><input name="supplier_sex" type="text" style="width:170px" placeholder="Gender" id="supplier_sex" /></td></tr>
				<tr><td align="center"><input name="supplier_phone" type="text" style="width:170px" placeholder="Phone" id="supplier_phone" /></td></tr>  
				<tr><td align="center"><input name="cashier_id" type="text" style="width:170px" placeholder="Cashier ID" id="cashier_id" /></td></tr>
				<tr><td align="center"><input name="submit" type="submit" value="Update"/></td></tr>
            </table>
		</form>
		</div>  
    </div>  
</div>
</div>
<div id="footer" align="Center"> PESU PHARMA - 2019</div>
</div>
</body>
</html>
