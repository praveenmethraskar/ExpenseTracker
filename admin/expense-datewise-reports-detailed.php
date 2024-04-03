<?php
session_start();
error_reporting(0);
require('../config.php');
if (strlen($_SESSION['id']==0)) {
  header('location:logout.php');
  } else{

  

  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Datewise Expense Report</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
	
	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

</head>
<body> 
<div class="hero">
  <nav>
    <div class="hh">
      <div class="logo"><img src="../img/expense.jpg" alt="logo"></div>
      <div class="hambargar">
        <div class="line"></div>
        <div class="line"></div>
        <div class="line"></div>
      </div>
    </div>
    <ul>
      <li><a href="welcome.php">Dashboard</a></li>
      <li><a href="addexpense.php">Add Expenses</a></li>
      <li><a href="manage-expense.php">View Expenses</a></li>
      <i class="fa-solid fa-user profileIcon"></i>
    </ul>
    <div class="sub-menu-wrap" id="profileMenu">
      <div class="sub-menu">
        <div class="user-info">
          <h3>Welcome <b><?php echo htmlspecialchars($_SESSION["username"]); ?></b></h3>
        </div>
        <hr>
        <div class="menu-link"> 
          <a href="reset-password.php"><i class="fa-solid fa-gear"></i>
            <h4> Reset Password <span>&gt;</span></h4>
          </a> 
        <!--  <a href="#"><i class="fa-solid fa-circle-info"></i>
            <h4> Help & Support <span>&gt;</span></h4>
          </a>-->
          <a href="logout.php"><i class="fa-solid fa-right-from-bracket"></i>
            <h4> LogOut <span>&gt;</span></h4>
          </a>
        </div>
      </div>
    </div>
  </nav>
</div>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="#">
					<em class="fa fa-home"></em>
				</a></li>
				<li class="active">Datewise Expense Report</li>
			</ol>
		</div><!--/.row-->
		
		
				
		
		<div class="row">
			<div class="col-lg-12">
			
				
				
				<div class="panel panel-default"> 
					<div class="panel-body">

						<div class="col-md-12">
					
<?php
$fdate=$_POST['fromdate'];
 $tdate=$_POST['todate'];
?>
<h5 align="center" style="color:blue">Datewise Expense Report from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
    <table id="datatable" class="table table-bordered dt-responsive nowrap table-striped table-hover"  style="border-collapse: collapse; border-spacing: 0; width: 100%;">
        <thead class="thead-dark">
             <tr>
                <tr>
              <th>S.NO</th>
              <th>Date</th>
              <th>Expense Amount</th>
                </tr>
            </tr>
        </thead>
<?php
$userid=$_SESSION['id'];
$sql="select ExpenseDate, SUM(ExpenseCost) as totaldaily FROM `tblexpense`  where (ExpenseDate BETWEEN '$fdate' and '$tdate') && (UserId='$userid') group by ExpenseDate";

$exe=mysqli_query($link, $sql);
$cnt=1;
while ($row=mysqli_fetch_array($exe)) {

?>
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php  echo $row['ExpenseDate'];?></td>
                  <td><?php  echo $ttlsl=$row['totaldaily'];?></td>
           
                </tr>
                <?php
                $totalsexp+=$ttlsl; 
$cnt=$cnt+1;
}?>

 <tr>
  <th colspan="2" style="text-align:center">Grand Total</th>     
  <td><?php echo $totalsexp;?></td>
 </tr>     

 </table>




						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col--> 
		</div><!-- /.row -->
	</div><!--/.main-->
	
<script src="js/jquery-1.11.1.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/chart.min.js"></script>
	<script src="js/chart-data.js"></script>
	<script src="js/easypiechart.js"></script>
	<script src="js/easypiechart-data.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/custom.js"></script>
    <script src="js/index.js"></script>
</body>
</html>
<?php } ?>