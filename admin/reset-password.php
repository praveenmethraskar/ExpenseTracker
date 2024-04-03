<?php
// Initialize the session
session_start();
 
// Check if the user is logged in, otherwise redirect to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../index.php");
    exit;
}
 
// Include config file
require_once "../config.php";
 
// Define variables and initialize with empty values
$new_password = $confirm_password = "";
$new_password_err = $confirm_password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate new password
    if(empty(trim($_POST["new_password"]))){
        $new_password_err = "Please enter the new password.";     
    } elseif(strlen(trim($_POST["new_password"])) < 6){
        $new_password_err = "Password must have atleast 6 characters.";
    } else{
        $new_password = trim($_POST["new_password"]);
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))){
        $confirm_password_err = "Please confirm the password.";
    } else{
        $confirm_password = trim($_POST["confirm_password"]);
        if(empty($new_password_err) && ($new_password != $confirm_password)){
            $confirm_password_err = "Password did not match.";
        }
    }
        
    // Check input errors before updating the database
    if(empty($new_password_err) && empty($confirm_password_err)){
        // Prepare an update statement
        $sql = "UPDATE users SET password = ? WHERE id = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "si", $param_password, $param_id);
            
            // Set parameters
            $param_password = password_hash($new_password, PASSWORD_DEFAULT);
            $param_id = $_SESSION["id"];
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                header("location: ../index.php");
                exit();
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
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

<form class="login" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>" placeholder="New Password">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>" placeholder="Confirm Password">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
  
</form>
   <!-- <div class="wrapper">
        <h2>Reset Password</h2>
        <p>Please fill out this form to reset your password.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post"> 
            <div class="form-group">
                <label>New Password</label>
                <input type="password" name="new_password" class="form-control <?php echo (!empty($new_password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $new_password; ?>">
                <span class="invalid-feedback"><?php echo $new_password_err; ?></span>
            </div>
            <div class="form-group">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" class="form-control <?php echo (!empty($confirm_password_err)) ? 'is-invalid' : ''; ?>">
                <span class="invalid-feedback"><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
                <a class="btn btn-link ml-2" href="welcome.php">Cancel</a>
            </div>
        </form>
    </div>    -->

    <script src="js/index.js"></script>
</body>
</html>