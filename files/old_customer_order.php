<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['cashier_id'];
$username=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
if(isset($_POST['submit']))
{
$cid=$_POST['cust_id'];
$name= $_POST['drug_name'];
$quantity = $_POST['drug_quantity'];
$sql=mysqli_query($con,"SELECT stock_id FROM `STOCK` WHERE drug = '$name'") or die(mysqli_error($con));
if($sql>0)
{
	$result=mysqli_fetch_array($sql);
	$sid = $result['stock_id'];
	echo $sid;
}
else
{
 header("location:new_order.php");
}
//$sql1=mysqli_query($con,"INSERT INTO `PRESCRIPTION`(`order_date`,`stock_id`,`drug_quantity`,`cust_id`,`cashier_id`) 
//VALUES (". DATE("Y-m-d"). ",'$sid','$quantity','$cid','$id');") or die(mysqli_error($con));
//header("location:new_order.php");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>PESU PHARMA</title>
<link rel="stylesheet" type="text/css" href="style/mystyle.css">
<link rel="stylesheet" href="style/style.css" type="text/css" media="screen" /> 
<link rel="stylesheet" href="style/table.css" type="text/css" media="screen" />
<link rel="stylesheet" href="style/bootstrap.min.css" type="text/css" /> 
<link rel="stylesheet" href="style/jquery.dataTables.min.css" type="text/css" /> 

<!-- Bootstrap -->
<script src="js/bootstrap.min.js" type="text/javascript"></script>

<!-- DATA TABES SCRIPT -->
<script src="js/datatables/jquery.dataaTables.js" type="text/javascript"></script>
<script src="js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="js/datatables/dataTables.bootstrap.js" type="text/javascript"></script>
<script src="js/jquery-3.3.1.js" type="text/javascript"></script>
<script src="js/jquery.dataTables.min.js" type="text/javascript"></script>

<script type="text/javascript">
 $(document).ready(function() {
    $('#table1').DataTable( {
        "lengthMenu": [[7], [7]]
    } );
} );
  </script> 
<script src="js/function.js" type="text/javascript"></script>
<script src="js/validation_script.js" type="text/javascript"></script>
<!--<script>
function validateForm()
{

//for alphabet characters only
var str=document.form1.first_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("First Name Cannot Contain Numerical Values");
	document.form1.first_name.value="";
	document.form1.first_name.focus();
	return false;
	}}
	
if(document.form1.first_name.value=="")
{
alert("Name Field is Empty");
return false;
}

//for alphabet characters only
var str=document.form1.last_name.value;
	var valid="abcdefghijklmnopqrstuvwxyz ABCDEFGHIJKLMNOPQRSTUVWXYZ";
	//comparing user input with the characters one by one
	for(i=0;i<str.length;i++)
	{
	//charAt(i) returns the position of character at specific index(i)
	//indexOf returns the position of the first occurence of a specified value in a string. this method returns -1 if the value to search for never ocurs
	if(valid.indexOf(str.charAt(i))==-1)
	{
	alert("Last Name Cannot Contain Numerical Values");
	document.form1.last_name.value="";
	document.form1.last_name.focus();
	return false;
	}}
	

if(document.form1.last_name.value=="")
{
alert("Name Field is Empty");
return false;
}

}

</script>-->
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a>  PESU PHARMA</h1></div>
<div id="left_column">
<div id="button">
<ul>
<li><a href="cashier1.php">Dashboard</a></li>
			<li><a href="new_order.php">New Order</a></li>
			<li><a href="view.php">Customer</a></li>
			<li><a href="view_prescription.php">Prescription</a></li>
			<li><a href="invoice.php">Invoice</a></li>
			<li><a href="logout.php">Logout</a></li>
		</ul>	
</div>
</div>
<div id="main">
<div id="tabbed_box" class="tabbed_box">  
    <div class="tabbed_area">  	
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">Add Order</a></li>  
              
        </ul>  
        <div id="content_1" class="content">  
		           <!--Cashier-->
		<?php /*echo $message;
			  echo $message1;*/
			  ?>
		<form name="form1"  onsubmit="return validateForm(validation_script.js);" action="add_order.php" method="post" ><pre>
				Customer ID: <input name="cust_id" type="text"  required="required"  value=<?php echo $_GET['cust_id']?> id="cust_id" /><br><br>
				Medicine: <input name="drug_name" type="text" required="required" id="drug_name" /><br><br>
				Quantity: <input name="drug_quantity" type="text" required="required" id="drug_quantity" /><br>
				<input name="submit" type="submit" value="Submit"></pre>
		</form>
        </div>   
        
      
    </div>  
  
</div>
 
</div>
<div id="footer" align="Center"> PESU PHARMA - 2019</div>
</div>
</body>
</html>