<?php
error_reporting(0);
session_start();
include("dbconnection.php");
if(isset($_SESSION['usr_id']))
{
	echo "<script>window.location='dashboard.php';</script>";
}
if(isset($_POST['btnotpregister']))  
{
	$cst_photo = rand() . $_FILES['cst_photo']['name'];
	move_uploaded_file($_FILES['cst_photo']['tmp_name'],"filecst_photo/".$cst_photo);
	$cst_idproof  = rand() . $_FILES['cst_idproof']['name'];
	move_uploaded_file($_FILES['cst_idproof']['tmp_name'],"filecst_idproof/".$cst_idproof);
	$cst_addressproof =rand() .  $_FILES['cst_addressproof']['name'];
	move_uploaded_file($_FILES['cst_addressproof']['tmp_name'],"filecst_addressproof/".$cst_addressproof);
	$sql ="INSERT INTO cst_customer(usr_id, cst_type, comp_name, cst_fname, cst_mname, cst_lname, cst_dob, cst_gender, cst_address, cst_state, cst_contact, cst_email, cst_password, cst_bankdetail, cst_jobdetail, cst_note, cst_photo, cst_idproof, cst_addressproof, cst_status) values('$_POST[usr_id]','$_POST[cst_type]','$_POST[comp_name]','$_POST[cst_fname]','$_POST[cst_mname]','$_POST[cst_lname]','$_POST[cst_dob]','$_POST[cst_gender]','$_POST[cst_address]','$_POST[cst_state]','$_POST[cst_contact]','$_POST[cst_email]','$_POST[cst_password]','$_POST[cst_bankdetail]','$_POST[cst_jobdetail]','$_POST[cst_note]','$cst_photo','$cst_idproof','$cst_addressproof','Active')";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		$insid= mysqli_insert_id($con);
		$_SESSION['cst_id'] = $insid;
		$_SESSION['cst_type']=$_POST['cst_type'];
//#############################################################################
//#############################################################################
/*
?>
<?php
$msg= str_replace(" ","%20","Welcome to AGH Loans. Thanks for Registration. Your Account activated successfully.");//test%20message
$ch = curl_init();
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Length: 0'));
curl_setopt($ch,CURLOPT_URL,  "https://www.smsgatewayhub.com/api/mt/SendSMS?APIKey=04024e1f-2d50-4874-b1b5-b1b1d901e928&senderid=BIXTEL&channel=2&DCS=0&flashsms=0&number=$_POST[cst_contact]&text=$msg&route=21");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
//curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&cid=$cid&msgtxt=$msgtxt");
$buffer = curl_exec($ch);
if(empty ($buffer))
{ 
//echo " buffer is empty ";
}
else
{
//echo $buffer; 
} 
curl_close($ch);
//#############################################################################
//#############################################################################
*/
		echo "<script>alert('Thanks for registration..');</script>";
		echo "<script>window.location='customerlogin.php';</script>";
	}
	else
	{		
		echo "<script>alert('Your account already registered with us..');</script>";
		echo "<script>window.location='customerlogin.php';</script>";
	}
}
?>
<style>
.modal-header, h4, .close {
background-color: #5cb85c;
color:white !important;
text-align: center;
font-size: 30px;
}
.modal-footer {
background-color: #f9f9f9;
}
</style>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->
<html>
<head>
<title>AGH LOANS - Registration Panel</title>
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
  max-width: 75%;
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
<center><h1 class="form-heading" style="cursor: pointer;" onclick="window.location='index.php'">AGH Loans</h1></center>
<div class="login-form">
<div class="main-div">
    <div class="panel">
   <h2>Customer Registration Panel</h2>
   <p>Please enter following details</p>
   </div>
    <form id="Login"  method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()" >
<input type="hidden" name="otpcode" id="otpcode" value="000000">
        <div class="form-group"  style="text-align: left;">
			<b>Registration type</b>
			<select  name="cst_type" id="cst_type" class="form-control" onchange="loadregtype(this.value)" STYLE="height: 50px;">
					<option value="">Select Registration type</option>
					<?php
					$arr = array("Customer","Company");
					foreach($arr as $val)
					{
						if($val == $rsedit['cst_type'])
						{
						echo "<option value='$val' selected >$val</option>";
						}
						else
						{
						if($val == $rsedit['status']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
						}
					}
					?>
			</select>
			<span class="errormsg"  id="errcst_type"></span>
        </div>

        <div class="form-group">		
			<div id="divregtype"></div>
        </div>
		
		
        <div class="form-group">		
			<div class="row" >
				<div class="col-md-6" style="text-align: left;">
					<b>Contact No.</b>
					<input type="text" name="cst_contact" id="cst_contact" class="form-control">
					<span class="errormsg"  id="errcst_contact"></span>
				</div>
				<div class="col-md-6"  style="text-align: left;">
					<b>Email ID.</b>
					<input type="email" name="cst_email" id="cst_email" class="form-control">
					<span class="errormsg"  id="errcst_email"></span>
				</div>
			</div>
        </div>
		
        <div class="form-group">
			<div class="row" >
				<div class="col-md-6" style="text-align: left;">
					<b>Password</b>
					<input type="password" name="cst_password" id="cst_password" class="form-control">
					<span class="errormsg"  id="errcst_password"></span>
				</div>
				<div class="col-md-6"  style="text-align: left;">
					<b>Confirm Password</b>
					<input type="password" name="ccst_password" id="ccst_password" class="form-control">
					<span class="errormsg"  id="errccst_password"></span>
				</div>
			</div>		
        </div>
		
        <div class="form-group" style="text-align: left;">
			<b>Upload Photo</b>
			<input type="file" name="cst_photo" id="cst_photo" class="form-control" accept="image/*" style="height: 75px;">
			<span class="errormsg"  id="errcst_photo"></span>
        </div>
		
		
        <div class="forgot">
</div>
<!--
        <button class="btn btn-primary"  type="button"  onclick="return validateform()" name="btncustregister" id="btncustregister" >Click here to Register</button>
-->
<button type="submit" name="btnotpregister" id="btnotp"  class="btn btn-success btn-block" ><span class="glyphicon glyphicon-off" ></span> Click here to Register</button>


<div class="container">
  <!-- Trigger the modal with a button -->
  <!-- Modal -->
  <div class="modal fade" id="CustomerEnterOTP" role="dialog">
    <div class="modal-dialog">    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header" style="padding:35px 50px;">
          <h4><span class="glyphicon glyphicon-lock"></span> OTP VERIFICATION</h4>
        </div>
		
        <div class="modal-body" style="padding:40px 50px;">
            <div class="form-group" style="text-align: left;">
              <label for="usrname"><span class="glyphicon glyphicon-star"></span> Enter OTP Number</label>
              <input type="text" name="otpnumber" id="otpnumber" class="form-control" >
			  <span id="idotpnumber" class="errormsg">
            </div>
            <div class="checkbox">
              <label><b><a href="" onclick="return resendotp()">Resend OTP</a></b></label>
            </div>
        </div>
        <div class="modal-footer">
          <!-- 
              <button type="submit" name="btnotpregister" id="btnotp"  class="btn btn-success btn-block" onclick="return validateotp()"  ><span class="glyphicon glyphicon-off" ></span> Enter OTP</button>
			-->
        </div>
      </div>
    </div>
  </div> 
</div>


    </form>
    </div>
</div></div></div>


</body>
</html><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
	if(document.getElementById("cst_type").value == "")
	{
		document.getElementById("errcst_type").innerHTML="Kindly select Customer Type...";
		errchk = "True";
	}	
	if(document.getElementById("cst_contact").value.length != 10)
	{
		document.getElementById("errcst_contact").innerHTML="Mobile Number should contain 10 digits..";
		errchk = "True";
	}
	if(document.getElementById("cst_contact").value == "")
	{
		document.getElementById("errcst_contact").innerHTML="Mobile number should not be empty..";
		errchk = "True";
	}	
	if(!document.getElementById("cst_email").value.match(emailExp))
	{
		document.getElementById("errcst_email").innerHTML = "Entered Email ID is not valid....";
		errchk = "True";
	}
	if(document.getElementById("cst_email").value == "")
	{
		document.getElementById("errcst_email").innerHTML="Kindly enter Email ID.";
		errchk = "True";
	}
	         
	if(document.getElementById("cst_password").value.length < 8)
	{
		document.getElementById("errcst_password").innerHTML ="Password should contain more than 8 characters...";	
		errchk = "True";		
	}	
	if(document.getElementById("cst_password").value.length > 16)
	{
		document.getElementById("errcst_password").innerHTML ="Password should contain less than 16 characters...";	
		errchk = "True";		
	}		
	if(!document.getElementById("cst_password").value.match(alphaNumericExp))
	{
		document.getElementById("errcst_password").innerHTML ="New password should contain only alphabets and numbers....";		
		errchk = "True";
	}
	if(document.getElementById("cst_password").value == "")
	{
		document.getElementById("errcst_password").innerHTML ="New password should not be empty....";	
		errchk = "True";	
	}
	if(document.getElementById("ccst_password").value != document.getElementById("cst_password").value )
	{
		document.getElementById("errccst_password").innerHTML ="Confirm password Must match with new password..";	
		errchk = "True";		
	}
	if(document.getElementById("ccst_password").value == "")
	{
		document.getElementById("errccst_password").innerHTML ="Confirm Password should not be empty....";	
		i=1;		
	}
	if(document.getElementById("cst_photo").value == "")
	{
		document.getElementById("errcst_photo").innerHTML="Kindly upload the photo..";
		errchk = "True";
	}
	if(errchk == "True")
	{
		return false;
	}
	else
	{
		return true;
		/*
		//######################################################
		    var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
			  if (this.readyState == 4 && this.status == 200) {
				document.getElementById("otpcode").value = this.responseText;
				alert("OTP Sent to your Registered Mobile Number...");
				$("#CustomerEnterOTP").modal();	
			  }
			};
			xmlhttp.open("GET","ajaxotpsms.php?mobno=" + document.getElementById("cst_contact").value,true);
			xmlhttp.send();
		//######################################################
		*/
	}
}
</script>
<script>
function loadregtype(regtype)
{
	if(regtype == "Company")
	{
		document.getElementById("divregtype").innerHTML = '<div class="row"><div class="col-md-12" style="padding-top: 4px;text-align:left;">Company name</div><div class="col-md-12"><input type="text" name="comp_name" id="comp_name" class="form-control"></div></div><br>';
	}
	if(regtype == "Customer")
	{
		document.getElementById("divregtype").innerHTML = '<div class="row"><div class="col-md-4" style="text-align: left;">First Name<input type="text" name="cst_fname" id="cst_fname" class="form-control" placeholder="First Name" ></div>	<div class="col-md-4" style="text-align: left;">Middle Name<input type="text" name="cst_mname" id="cst_mname" class="form-control"  placeholder="Middle Name" >	</div>	<div class="col-md-4" style="text-align: left;">Last Name<input type="text" name="cst_lname" id="cst_lname" class="form-control"  placeholder="Last Name" >	</div></div><br><div class="row">	<div class="col-md-6" style="text-align: left;">Date of Birth: <input type="date" name="cst_dob" placeholder="Date of Birth" id="cst_dob" class="form-control"  max="<?php $StaringDate= date("Y-m-d"); echo date("Y-m-d", strtotime(date("Y-m-d", strtotime($StaringDate)) . " -18 years")); ?>" >	</div>	<div class="col-md-6" style="text-align: left;">Gender: <select  STYLE="height: 50px;" name="cst_gender" id="cst_gender" class="form-control"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female" >Female</option>"; } } } ?> </select>	</div></div><br>';
	}
}
</script>
<script>
function validateotp()
{	
	var i = 0;	
	$('.errorclass').html('');
	if(document.getElementById("otpnumber").value == "")
	{
		document.getElementById("idotpnumber").innerHTML = "OTP should not be empty...";
		i=1;
	}
	if(document.getElementById("otpcode").value != document.getElementById("otpnumber").value )
	{
		document.getElementById("idotpnumber").innerHTML = "Entered OTP is not valid...";
		i=1;
	}
	if(i == 0)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>
<script>
function resendotp()
{
	var otp = document.getElementById("otpcode").value;
	alert("OTP resent to your registered Mobile Number...");
	//######################################################
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
	  if (this.readyState == 4 && this.status == 200) {
		document.getElementById("otpcode").value = this.responseText;
		$("#CustomerEnterOTP").modal('show');
	  }
	};
	xmlhttp.open("GET","ajaxresendotp.php?mobno="+document.getElementById("cst_contact").value+"&otp="+otp,true);
	xmlhttp.send();
	//######################################################
	return false;
}
</script>