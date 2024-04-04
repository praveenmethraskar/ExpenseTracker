<?php
session_start();
error_reporting(0);
require_once "../config.php";
if (strlen($_SESSION["id"]==0)) {
  header('location:logout.php');
  } else{

if(isset($_POST['submit']))
  {
  	$userid=$_SESSION["id"];
    $dateexpense=$_POST['dateexpense'];
     $item=$_POST['item'];
     $costitem=$_POST['costitem'];
     $sql = "INSERT INTO tblexpense (UserId,ExpenseDate,ExpenseItem,ExpenseCost) VALUES ('$userid','$dateexpense','$item','$costitem')";
     
    $query=mysqli_query($link, $sql);
    echo $query;
if($query){
echo "<script>alert('Expense has been added');</script>";
echo "<script>window.location.href='manage-expense.php'</script>";
} else {
echo "<script>alert('Something went wrong. Please try again');</script>";

}
  
}
  ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Daily Expense Tracker || Add Expense</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/datepicker3.css" rel="stylesheet">
	<link href="css/styles.css" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

	<!--Custom Font-->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">
	<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->
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
      <li><a href="addexpense.php" class="active">Add Expenses</a></li>
      <li><a href="manage-expense.php">View Expenses</a></li>
      <li><a href="datewisereport.php">Date wise Expenses</a></li>
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
        <div class="col-lg-3"></div>
			<div class="col-lg-6">
				<div class="panel panel-default">
					<div class="panel-heading">Add New Expenses</div>
					<div class="panel-body">
						<p style="font-size:16px; color:red" align="center"> <?php if($msg){echo $msg;}  ?> </p>
						<div class="col-md-12">
							
							<form role="form" method="post" action="">
								<div class="form-group">
									<label>Date of Expense</label>
									<input class="form-control" type="date" value="" name="dateexpense" required="true">
								</div>
								<div class="form-group">
									<label>Item</label>
									<input type="text" class="form-control" name="item" value="" required="true">
								</div>
								
								<div class="form-group">
									<label>Cost of Item</label>
									<input class="form-control" type="text" value="" required="true" name="costitem">
								</div>
															
								<div class="form-group has-success">
									<input type="submit" class="btn btn-primary" name="submit" value="Add Expenses" placeholder="add">
								</div>
								</div>
								
							</form>
						</div>
					</div>
				</div><!-- /.panel-->
			</div><!-- /.col-->
            <div class="col-lg-3"></div>
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
<?php }  ?>