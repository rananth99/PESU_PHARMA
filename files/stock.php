<?php
session_start();
include_once('connect_db.php');
if(isset($_SESSION['username'])){
$id=$_SESSION['admin_id'];
$user=$_SESSION['username'];
}else{
header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."index.php");
exit();
}
if(isset($_POST['submit'])){
$sname=$_POST['drug'];
$qua=$_POST['quantity'];
$com=$_POST['company'];
$cost=$_POST['cost'];
$des=$_POST['description'];
$exp=date('Y-m-d',strtotime($_POST['expiry_date']));
$sql=mysqli_query($con,"INSERT INTO STOCK(`drug`,`quantity`,`company`,`cost`,`description`,`expiry_date`,`admin_id`)
VALUES('$sname','$qua','$com','$cost','$des','$exp','$id');");
if($sql>0) {header("location:http://".$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF'])."/stock.php");
}else{
$message1="<font color=red>Adding Failed, Try again</font>";
echo $message1;
}
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

    $('#table2').DataTable( {
        "lengthMenu": [[7], [7]]
    } );
} );
  </script> 
<script src="js/function.js" type="text/javascript"></script>
<script src="js/validation_script.js" type="text/javascript"></script>
</head>
<body>
<div id="content">
<div id="header">
<h1><a href="#"><img src="images/hd_logo.jpg"></a>  PESU PHARMA</h1></div>
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
    <div class="tabbed_area">  
      
        <ul class="tabs">  
            <li><a href="javascript:tabSwitch('tab_1', 'content_1');" id="tab_1" class="active">View Stock</a></li>  
            <li><a href="javascript:tabSwitch('tab_2', 'content_2');" id="tab_2">Add Stock</a></li>  
            <li><a href="javascript:tabSwitch('tab_3', 'content_3');" id="tab_3">Wanted Stock</a></li>       
        </ul>  
          
        <div id="content_1" class="content">   
		<?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($con,"SELECT * FROM STOCK NATURAL JOIN ADMINISTRATOR WHERE admin_id=$id")
                or die(mysqli_error($con));
		// display data in table
        echo '<table id="table1" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
         echo "<thead><tr><th>ID</th><th>Name</th><th>Quantity</th><th>Company</th><th>Expiry Date</th><th>Delete</th></tr></thead><tbody>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                
                // echo out the contents of each row into a table
                echo "<tr>";
                 echo '<td>' . $row['stock_id'] . '</td>';               
                echo '<td>' . $row['drug'] . '</td>';
                 echo '<td>' . $row['quantity'] . '</td>';               
				echo '<td>' . $row['company'] . '</td>';
				echo '<td>' . $row['expiry_date'] . '</td>';?>
				<td><a href="delete_stock.php?stock_id=<?php echo $row['stock_id']?>"><img src="images/delete-icon.jpg" width="24" height="24" border="0" /></a></td>
				<?php
		 }
        // close table>
        echo "</tbody></table>";
?>
        </div>  

        <div id="content_2" class="content">
			<form name="myform" onsubmit="return validateForm(this);" action="stock.php" method="post" ><pre>
            Drug Name:    <input name="drug" type="text" style="width:170px" required="required" id="drug" /><br><br>
            Quantity:     <input name="quantity" type="text" style="width:170px"  required="required" id="quantity" /><br><br>
            Company Name: <input name="company" type="text" style="width:170px"   required="required" id="company" /><br><br>  
            Cost:         <input name="cost" type="text" style="width:170px"  required="required" id="cost" /><br><br>
            Description:  <input name="description" type="text" style="width:170px" required="required" id="description" /><br><br>
            Expiry Date:  <input name="expiry_date" type="Date" style="width:170px" required="required" id="expiry_date" /><br><br>
            <input name="submit" type="submit" value="Submit" id="submit"/></pre>
		</form>
        </div>  
              
        <div id="content_3" class="content">
        <?php
		/* 
		View
        Displays all data from 'Stock' table
		*/

        // connect to the database
        include_once('connect_db.php');

        // get results from database
		
        $result = mysqli_query($con,"SELECT STOCK.stock_id,drug,SUM(drug_quantity),STOCK.quantity
        FROM STOCK,PRESCRIPTION 
        WHERE PRESCRIPTION.stock_id = STOCK.stock_id
        GROUP BY STOCK.stock_id")
                or die(mysqli_error($con));
		// display data in table
        echo '<table id="table2" class="table table-bordered table-striped" border="1" cellpadding="5" align="center">';
         echo "<thead><tr><th>ID</th><th>Name</th><th>Required Quantity</th></thead><tbody>";

        // loop through results of database query, displaying them in the table
        while($row = mysqli_fetch_array( $result )) {
                $required = $row['2'] - $row['3'];
                if($required>0)
                {
                // echo out the contents of each row into a table
                echo "<tr>";
                echo '<td>' . $row['0'] . '</td>';
                echo '<td>' . $row['1'] . '</td>';
                echo '<td>' . $required . '</td>';
                }
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