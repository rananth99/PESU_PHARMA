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
mysqli_query($con,"LOCK TABLE CASHIER");
$id=$_GET['cashier_id'];
$sql="DELETE FROM CASHIER WHERE cashier_id='$id'";
mysqli_query($con,$sql);
mysqli_query($con,"COMMIT");
header("location:admin_cashier.php");
?>


