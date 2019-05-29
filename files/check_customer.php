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
$fname=$_POST['cust_fname'];
$lname= $_POST['cust_lname'];
$sql1=mysqli_query($con,"SELECT * FROM `CUSTOMER` WHERE cust_fname='$fname' AND cust_lname='$lname'")or die(mysqli_error($con));
 $result=mysqli_fetch_array($sql1);
 if($result>0){
    $id = $result['cust_id'];
    header("location:old_customer_order.php?cust_id=".$id);    
 }else{
     header("location:new_customer_order.php");
}
}
?>