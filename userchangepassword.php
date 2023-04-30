<?php
include("header.php");
if(isset($_POST['submit']))  
{
	$sql ="UPDATE usr_user SET usr_password='$_POST[usr_password]' WHERE usr_password='$_POST[ousr_password]' AND usr_id='$_SESSION[usr_id]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('User password updated successfully..');</script>";
		echo "<script>window.location='userchangepassword.php';</script>";
	}
	else
	{
		echo "<script>alert('Entered password is not valid..');</script>";
		echo "<script>window.location='userchangepassword.php';</script>";
	}
}
?>
    <section class="content-info py-5">
        <div class="container py-md-5">

<form method="post" action="" enctype="multipart/form-data" onsubmit="return validateform()" >
            <div class="row">
                <div class="col-lg-2 col-md-2 mt-2"></div>
                <div class="col-lg-8 col-md-8 mt-8">
                    <div class="thumbnail card">
                        <div class="blog-info card-body">
                            <center><h3 class="">Change Password</h3></center>
                            <p class="mt-2">

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Old Password
	</div>
	<div class="col-md-9">
		<input type="password" name="ousr_password" id="ousr_password" class="form-control">
					<span class="errormsg"  id="errousr_password"></span>
	</div>
</div>
<br><div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		New Password
	</div>
	<div class="col-md-9">
		<input type="password" name="usr_password" id="usr_password" class="form-control">
					<span class="errormsg"  id="errusr_password"></span>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Confirm Password
	</div>
	<div class="col-md-9">
		<input type="password" name="cusr_password" id="cusr_password" class="form-control">
					<span class="errormsg"  id="errcusr_password"></span>
	</div>
</div>
<br>
			
							</p>
                            <div class="read-icon">
<center><input type="submit" name="submit" class="btn read" value="Change Password"></a></center>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-2 mt-2"></div>
			</div>
</form>			
			
        </div>
    </section>
    <!-- //banner-botttom -->
    <?php
include("footer.php");
?>
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
	     
	if(document.getElementById("ousr_password").value == "")
	{
		document.getElementById("errousr_password").innerHTML="Old Password should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("usr_password").value == "")
	{
		document.getElementById("errusr_password").innerHTML ="New password should not be empty....";	
		errchk = "True";	
	}
	if(document.getElementById("cusr_password").value != document.getElementById("usr_password").value )
	{
		document.getElementById("errcusr_password").innerHTML ="Confirm password Must match with new password..";	
		errchk = "True";		
	}
	if(document.getElementById("cusr_password").value == "")
	{
		document.getElementById("errcusr_password").innerHTML ="Confirm Password should not be empty....";	
		i=1;		
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