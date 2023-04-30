<?php
error_reporting(0);
session_start();
setlocale(LC_MONETARY, 'en_IN');
include("dbconnection.php");
$dt =date("Y-m-d");
$tim =date("H:i:s");
$dttim = date("Y-m-d H:i:s");
//Customer Profile Starts here
if(isset($_SESSION['cst_id']))
{
	$sqlcustomerprofile ="SELECT * FROM cst_customer WHERE  cst_id='$_SESSION[cst_id]'";
	$qsqlcustomerprofile = mysqli_query($con,$sqlcustomerprofile);
	$rscustomerprofile = mysqli_fetch_array($qsqlcustomerprofile);
}
//Customer Profile ends here
//Money Format Starts here
function moneyFormatIndia($num) {
	$num = intval($num);
    $explrestunits = "" ;
    if(strlen($num)>3) {
        $lastthree = substr($num, strlen($num)-3, strlen($num));
        $restunits = substr($num, 0, strlen($num)-3); // extracts the last three digits
        $restunits = (strlen($restunits)%2 == 1)?"0".$restunits:$restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for($i=0; $i<sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if($i==0) {
                $explrestunits .= (int)$expunit[$i].","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i].",";
            }
        }
        $thecash = $explrestunits.$lastthree;
    } else {
        $thecash = $num;
    }
    return "₹" . $thecash; // writes the final format where $currency is the currency symbol.
}
//Money Format Ends here
$sqldelaypaymentpenaltycharge = "SELECT * FROM dpmt_delaypayment ";
$qsqldelaypaymentpenaltycharge = mysqli_query($con,$sqldelaypaymentpenaltycharge);
$rsdelaypaymentpenaltycharge = mysqli_fetch_array($qsqldelaypaymentpenaltycharge);
?>
<!DOCTYPE html>
<html lang="zxx">
<head>
    <title>AGH Loans</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>	
    <!-- //Meta tag Keywords -->
    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <link rel="stylesheet" href="css/slider.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Catamaran:100,200,300,400,500,600,700,800" rel="stylesheet">
    <!-- //Fonts -->
    <!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Berkshire+Swash' rel='stylesheet' type='text/css'>
	<style>
.title-w3ls {
  font: 400 100px/1.3 'Berkshire Swash', Helvetica, sans-serif;
  color: #2b2b2b;
  text-shadow: 1px 1px 0px #ededed, 4px 4px 0px rgba(0,0,0,0.15);
}
	</style>
    <!-- //Fonts -->
<style>
@import "compass/css3";

/*Be sure to look into browser prefixes for keyframes and annimations*/
.errormsg {
   animation-name: flash;
    animation-duration: 0.2s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-play-state: running;
}

@keyframes flash {
    from {color: red;}
    to {color: black;}
}
</style>
</head>

<body>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark" style="margin-bottom: 0px;">

  <!-- Links -->
  <ul class="navbar-nav">
<?php
if(isset($_SESSION['usr_id']))
{
?>
    <li class="nav-item">
      <a class="nav-link " href="dashboard.php">DASHBOARD</a>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        LOAN APPLICATIONS
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="viewloanapplication.php?status=Pending">VIEW PENDING LOAN APPLICATIONS</a>
        <a class="dropdown-item" href="viewloanapplication.php?status=Approved">VIEW APPROVED LOAN APPLICATIONS</a>
        <a class="dropdown-item" href="viewloanapplication.php?status=Rejected">VIEW REJECTED LOAN APPLICATIONS</a>
      </div>
    </li>

    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        CUSTOMERS
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="viewcustomer.php">VIEW CUSTOMERS</a>
      </div>
    </li>
	
    <!-- Dropdown -->
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        LOAN ACCOUNTS
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="viewactiveloanaccount.php">VIEW LOAN ACCOUNTS</a>
        <a class="dropdown-item" href="viewterminatedloanaccount.php">VIEW TERMINATED LOAN ACCOUNTS</a>
        <a class="dropdown-item" href="viewclosedloanaccounts.php">VIEW CLOSED LOAN ACCOUNTS</a>
      </div>
    </li>

    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        REPORT
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="viewactiveloanaccount.php">LOAN TRANSACTION REPORT</a>
        <a class="dropdown-item" href="profitlossreport.php">PROFIT - LOSS REPORT</a>
      </div>
    </li>
	
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        ADMIN
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="user.php">ADD ADMIN</a>
        <a class="dropdown-item" href="viewuser.php">VIEW ADMIN</a>
      </div>
    </li>
	
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        SETTINGS
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="loantypes.php">ADD LOAN TYPES</a>
        <a class="dropdown-item" href="viewloantypes.php">VIEW LOAN TYPES</a>
        <a class="dropdown-item" href="loanprocessingfee.php">ADD LOAN PROCESSING FEE</a>
        <a class="dropdown-item" href="viewloanprocessingfee.php">VIEW LOAN PROCESSING FEE</a>
        <a class="dropdown-item" href="delaypayment.php">DELAY PAYMENT SETTINGS</a>
      </div>
    </li>
	
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        ADMIN ACCOUNT
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="userprofile.php">Update Profile</a>
        <a class="dropdown-item" href="userchangepassword.php">Change Password</a>
      </div>
    </li>
	
<?php
}
else if(isset($_SESSION['cst_id']))
{
?>
 <li class="nav-item">
   <a class="nav-link " href="customeraccount.php">MY DESK</a>
 </li>

    <li class="nav-item">
<?php
if($rscustomerprofile['cst_bankdetail'] == "")
{
?>
  <a class="nav-link " href="" onclick="alert('Kindly update profile details to apply Loan... ');return false;" >APPLY FOR LOAN</a>
<?php
}
else
{
?>	
  <a class="nav-link" href="displayloantypes.php">APPLY FOR LOAN</a>
<?php
}
?>
    </li>
<?php
/*
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">APPLY FOR LOAN</a>
      <div class="dropdown-menu">
	<?php
	$sqlltyp_loantypes = "select * from ltyp_loantypes WHERE ltyp_status='Active'";
	$qsqlltyp_loantypes = mysqli_query($con,$sqlltyp_loantypes);
	while($rsltyp_loantypes  = mysqli_fetch_array($qsqlltyp_loantypes))
	{
        echo "<a class='dropdown-item' href='#'>$rsltyp_loantypes[ltyp_loantype]</a>";
	}
	?>	
      </div>
    </li>
*/
?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        LOAN APPLICATIONS
      </a>
      <div class="dropdown-menu">
<?php
$sqllacc_loanaccounts = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
$sqllacc_loanaccounts = $sqllacc_loanaccounts . " AND lacc_status='Pending' ";
$sqllacc_loanaccounts = $sqllacc_loanaccounts  . " AND  cst_id='$_SESSION[cst_id]'";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccounts);
?>
        <a class="dropdown-item" href="viewloanapplication.php?status=Pending">VIEW PENDING LOAN APPLICATIONS (<?php echo mysqli_num_rows($qsqllacc_loanaccount); ?>)</a>
<?php
$sqllacc_loanaccounts = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
$sqllacc_loanaccounts = $sqllacc_loanaccounts . " AND lacc_status='Rejected' ";
$sqllacc_loanaccounts = $sqllacc_loanaccounts  . " AND  cst_id='$_SESSION[cst_id]'";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccounts);
?>
        <a class="dropdown-item" href="viewloanapplication.php?status=Rejected">VIEW REJECTED LOAN APPLICATIONS (<?php echo mysqli_num_rows($qsqllacc_loanaccount); ?>)</a>
      </div>
    </li>
<?php
$sqllacc_loanaccounts = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
$sqllacc_loanaccounts = $sqllacc_loanaccounts . " AND lacc_status='Approved' ";
$sqllacc_loanaccounts = $sqllacc_loanaccounts  . " AND  cst_id='$_SESSION[cst_id]'";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccounts);
?>
	 <li class="nav-item">
	   <a class="nav-link " href="viewloanapplication.php?status=Approved"> LOAN OFFER (<?php echo mysqli_num_rows($qsqllacc_loanaccount); ?>)</a>
	 </li>
<?php
$sqllacc_loanaccounts = "SELECT * FROM  lacc_loanaccount where lacc_id!='0' AND lacc_status='Active'  AND  cst_id='$_SESSION[cst_id]'";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccounts);
$noloanacc = mysqli_num_rows($qsqllacc_loanaccount);
?>
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
        MY LOAN ACCOUNT (<?php echo $noloanacc; ?>)
      </a>
      <div class="dropdown-menu">

        <a class="dropdown-item" href="viewactiveloanaccount.php">MY LOAN ACCOUNTS (<?php echo $noloanacc; ?>)</a>
<?php
$sqllacc_loanaccountsclosed = "SELECT * FROM  lacc_loanaccount where lacc_id!='0'";
$sqllacc_loanaccountsclosed = $sqllacc_loanaccountsclosed . " AND lacc_status='Closed' ";
$sqllacc_loanaccountsclosed = $sqllacc_loanaccountsclosed  . " AND  cst_id='$_SESSION[cst_id]'";

$qsqllacc_loanaccountclosed = mysqli_query($con,$sqllacc_loanaccountsclosed);
?>
        <a class="dropdown-item" href="viewclosedloanaccounts.php">CLOSED LOAN ACCOUNTS (<?php echo mysqli_num_rows($qsqllacc_loanaccountclosed); ?>)</a>
      </div>
    </li>
<?php
$sqlcibil = "SELECT * FROM creditscore where cst_id='$_SESSION[cst_id]'";
$qsqlcibil = mysqli_query($con,$sqlcibil);
if(mysqli_num_rows($qsqlcibil) >= 1)
{
?>
<li class="nav-item">
<a class="nav-link" href="creditscorechart.php"> CIBIL SCORE</a>
</li>
<?php
}
?>	
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
       MY ACCOUNT
      </a>
      <div class="dropdown-menu">
        <a class="dropdown-item" href="customerprofile.php">MY PROFILE</a>
        <a class="dropdown-item" href="customerchangepassword.php">CHANGE PASSWORD</a>
      </div>
    </li>
    <a class="nav-link" href="emicalc.php">EMI CALCULATOR</a>


<?php
}
?>	
  </ul>
</nav>
<?php
if(basename($_SERVER['PHP_SELF']) == "index.php" || basename($_SERVER['PHP_SELF']) == "about.php" || basename($_SERVER['PHP_SELF']) == "contact.php")
{
?>
    <!-- mian-content -->
    <div class="main-w3-pvt-header-sec" id="home">
<?php
}
else
{
?>
    <div class="main-w3-pvt-header-sec page-w3pvt-inner" id="home">
    <div class="overlay-innerpage">
<?php
}
?>
<!-- header -->
<header>
	<div class="container">
		<div class="header d-lg-flex justify-content-between align-items-center py-lg-3 px-lg-3">
			<!-- logo -->
			<div id="logo">
				<h1><a href="index.php"><span class="fa fa-suitcase mr-2"></span>AGH LOANS</a></h1>
			</div>
			<!-- //logo -->
			<div class="w3pvt-bg">
				<!-- nav -->
				<div class="nav_w3pvt">
	<nav>
		<label for="drop" class="toggle">Menu</label>
		<input type="checkbox" id="drop" />
		<ul class="menu">
			<li><a href="index.php">Home</a></li>
			<li><a href="about.php">About Us</a></li>
			<?php
			/*
			<li><a href="blog.html">Blogs</a></li>
			<li>
				<!-- First Tier Drop Down -->
				<label for="drop-2" class="toggle toogle-2">Dropdown <span class="fa fa-angle-down" aria-hidden="true"></span>
				</label>
				<a href="#">Dropdown <span class="fa fa-angle-down" aria-hidden="true"></span></a>
				<input type="checkbox" id="drop-2" />
				<ul>
					<li><a href="#process" class="drop-text">Process</a></li>
					<li><a href="#stats" class="drop-text">Statistics</a></li>
					<li><a href="#services" class="drop-text">Services</a></li>
					<li><a href="about.html" class="drop-text">Our Team</a></li>
					<li><a href="#test" class="drop-text">Clients</a></li>
				</ul>
			</li>
			*/
			?>
			<li><a href="contact.php">Contact Us</a></li>			
	</nav>
				</div>
				<!-- //nav -->
				<div class="justify-content-center">
					<!-- search -->
					<div class="apply-w3-pvt ml-lg-3">
<?php
if(isset($_SESSION['usr_id']))
{
?>
<a class="btn read" href="dashboard.php" role="button">Dashboard</a>
<a class="btn read" href="logout.php" role="button">EXIT</a>
<?php
}
else if(isset($_SESSION['cst_id']))
{
?>
<a class="btn read" href="customeraccount.php" role="button">Account</a>
<a class="btn read" href="logout.php" role="button">EXIT</a>
<?php
}
else
{
?>
<a class="btn read" href="customerlogin.php" role="button">Login</a>
<a class="btn read" href="customerregister.php" role="button">Register</a>
<?php
}
?>					
					</div>
					<!-- //search -->

				</div>
			</div>
		</div>
	</div>
</header>
<!-- //header -->
<?php
if(basename($_SERVER['PHP_SELF']) == "index.php")
{
?>
	</div>
<?php
}
else
{
?>	
	 <!-- //banner-inner -->
        </div>
    </div>
    <!-- //banner -->
<?php
}
?>
