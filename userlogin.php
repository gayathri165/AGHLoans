<?php
session_start();
include("dbconnection.php");
if(isset($_SESSION['usr_id']))
{
		echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST['loginbutton']))
{
	$sql ="SELECT * FROM usr_user WHERE usr_login_id='$_POST[login_id]' AND 	 usr_password = '$_POST[password]' AND 	usr_status='Active'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		$rs = mysqli_fetch_array($qsql);
		$_SESSION['usr_id'] = $rs['usr_id'];
		echo "<script>window.location='dashboard.php';</script>";
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
   <h2>ADMIN LOGIN PANEL</h2>
   <p>Please enter your ADMIN ID and PASSWORD</p>
   </div>
    <form id="Login" method="post" action="" onsubmit="return validateform()" >

        <div class="form-group">
			<input type="text" name="login_id" id="login_id" class="form-control" placeholder="Login ID">
			<span class="errormsg"  id="errlogin_id"></span>
        </div>

        <div class="form-group">		
			<input type="password" name="password" id="password" class="form-control" placeholder="Password">
			<span class="errormsg"  id="errpassword"></span>
        </div>
        <div class="forgot">
</div>
        <button class="btn btn-primary"  type="submit" name="loginbutton" id="loginbutton"  value="Click here to Login" >Login</button>

    </form>
    </div>
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