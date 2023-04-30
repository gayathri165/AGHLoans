<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_SESSION['cst_id']))
{
	echo "<script>window.location='customeraccount.php';</script>";
}
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO cst_customer values('$_POST[usr_id]','$_POST[cst_type]','$_POST[comp_name]','$_POST[cst_fname]','$_POST[cst]','$_POST[ltyp_status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer Login record inserted successfully..');</script>";
		echo "<script>window.location='customerlogin.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
if(isset($_POST['loginbutton']))
{
	$sql ="SELECT * FROM cst_customer WHERE  cst_email='$_POST[login_id]' AND cst_password='$_POST[password]'  AND cst_status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION['cst_id'] = $rs['cst_id'];
		$_SESSION['cst_type'] = $rs['cst_type'];
		echo "<script>window.location='customeraccount.php';</script>";
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials..');</script>";
	}
}
?>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<html>
<head>
<title>AGH LOANS- Login Panel</title>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
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
<style>
body#LoginForm{ background-image:url("https://hdwallsource.com/img/2014/9/blur-26347-27038-hd-wallpapers.jpg"); background-repeat:no-repeat; background-position:center; background-size:cover; padding:10px;}

.form-heading { color:#fff; font-size:23px;}
.panel h2{ color:#444444; font-size:18px; margin:0 0 8px 0;}
.panel p { color:#777777; font-size:14px; margin-bottom:30px; line-height:24px;}
.login-form .form-control {
  background: #f7f7f7 none repeat scroll 0 0;
  border: 1px solid #d4d4d4;
  border-radius: 4px;
  font-size: 14px;
  height: 50px;
  line-height: 50px;
}
.main-div {
  background: #ffffff none repeat scroll 0 0;
  border-radius: 2px;
  margin: 10px auto 30px;
  max-width: 38%;
  padding: 50px 70px 70px 71px;
}

.login-form .form-group {
  margin-bottom:10px;
}
.login-form{ text-align:center;}
.forgot a {
  color: #777777;
  font-size: 14px;
  text-decoration: underline;
}
.login-form  .btn.btn-primary {
  background: #f0ad4e none repeat scroll 0 0;
  border-color: #f0ad4e;
  color: #ffffff;
  font-size: 14px;
  width: 100%;
  height: 50px;
  line-height: 50px;
  padding: 0;
}
.forgot {
  text-align: left; margin-bottom:30px;
}
.botto-text {
  color: #ffffff;
  font-size: 14px;
  margin: auto;
}
.login-form .btn.btn-primary.reset {
  background: #ff9900 none repeat scroll 0 0;
}
.back { text-align: left; margin-top:10px;}
.back a {color: #444444; font-size: 13px;text-decoration: none;}
</style>
  </head>
<body id="LoginForm">
<div class="container">
<center><h1 class="form-heading" style="cursor: pointer;" onclick="window.location='index.php'">AGH LOANS</h1></center>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Customer Login Panel</h2>
   <p>Please enter your Email ID and password</p>
   </div>
    <form id="Login" method="post" action="" onsubmit="return validateform()" >

        <div class="form-group">
			<input type="email" name="login_id" id="login_id" class="form-control" placeholder="Email Address">
			<span class="errormsg"  id="errlogin_id"></span>
        </div>

        <div class="form-group">		
			<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			<span class="errormsg"  id="errpassword"></span>
        </div>
        <div class="forgot">
</div>
        <button class="btn btn-primary"  type="submit" name="loginbutton" id="loginbutton"  value="Click here to Login" >Login</button>
<hr>
<p class="botto-text"><b><a href="customerrecoverpassword.php">Forgot Password</a></b></p>
    </form>
    </div>
<p class="botto-text"><b><a href="customerregister.php">Click Here to Register</a></b></p>
</div></div></div>


</body>
</html>
<script>
function validateform()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('.errormsg').html('');
	var errchk = "False";
	if(document.getElementById("login_id").value == "")
	{
		document.getElementById("errlogin_id").innerHTML="Login ID should not be empty...";
		errchk = "True";
	}	
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password should not be empty..";
		errchk = "True";
	}
	if(errchk == "True")
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>