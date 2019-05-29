<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$user=$_SESSION['username'];
$id=$_SESSION['cashier_id'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/index.php");
exit();
}
?>
<!DOCTYPE html>
<html>
<head>
<title><?php $user?>PHARMACY</title>
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
<script src="js/function1.js" type="text/javascript"></script>
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
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Invoice </a></li>  
                          
        </ul>  
          
        <div id="content_1" class="content">  
		<?php /*echo $message1;*/
		/* 
		View
        Displays all data from 'Pharmacist' table
		*/
        // connect to the database
        include_once('connect_db.php');
       // get results from database
       $result = mysqli_query($con,"SELECT invoice_no,supplier_name,cust_fname,cost,cust_address,bill_date FROM BILL,CUSTOMER,SUPPLIER,CASHIER WHERE CASHIER.cashier_id = $id AND BILL.cashier_id = CASHIER.cashier_id AND BILL.cust_id = CUSTOMER.cust_id AND BILL.supplier_id = SUPPLIER.supplier_id")or die(mysqli_error($con));
		// display data in table
        echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
        echo "<thead><tr> <th>Invoice ID</th><th>Customer Name</th><th>Supplier Name</th><th>Amount</th><th>Address</th><th>Date</th></tr></thead>";
        // loop through results of database query, displaying them in the table
        echo "<tbody>";
        while($row = mysqli_fetch_array( $result )) {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['invoice_no'] . '</td>';
                echo '<td>' . $row['cust_fname'] . '</td>';
                echo '<td>' . $row['supplier_name'] . '</td>';
				echo '<td>' . $row['cost'] . '</td>';
                echo '<td>' . $row['cust_address'] . '</td>';
                echo '<td>' . $row['bill_date'] . '</td>';
				
				?>				
				<?php
		}
        // close table>
        echo "</tbody></table>";
?> 
        </div>  

    </div>  
</div>
</div>
<div id="footer" align="Center"> PESU PHARMA - 2019</div>
</div>
</body>
</html>