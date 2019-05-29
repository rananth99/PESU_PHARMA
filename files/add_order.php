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
    $sql1=mysqli_query($con,"LOCK TABLES PRESCRIPTION WRITE,BILL WRITE");
$cid=$_POST['cust_id'];
$name= $_POST['drug_name'];
$quantity = $_POST['drug_quantity'];
$sql=mysqli_query($con,"SELECT stock_id,cost FROM `STOCK` WHERE drug='$name'");
$result=mysqli_fetch_array($sql);
$date = date("Y-m-d");
if($result>0)
{
    $sid = $result['stock_id'];
    $cost = $result['cost']*$quantity;

    $sql1=mysqli_query($con,"INSERT INTO `PRESCRIPTION`(`order_date`,`stock_id`,`drug_quantity`,`cust_id`,`cashier_id`) 
    VALUES ('$date','$sid','$quantity','$cid','$id');");

    $sql2=mysqli_query($con,"INSERT INTO `BILL`(`bill_date`,`cost`,`cust_id`,`cashier_id`,`supplier_id`)
    VALUES ('$date','$cost','$cid','$id','1')");

    $sql1= mysqli_query($con,"COMMIT")
}
header("location:new_order.php");
}
?>