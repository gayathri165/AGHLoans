<?php
include("header.php");
if(isset($_POST['submit']))
{
		$sql ="UPDATE usr_user SET usr_name='$_POST[usr_name]',usr_login_id='$_POST[usr_login_id]',usr_contact='$_POST[usr_contact]',usr_emailid='$_POST[usr_emailid]',usr_note='$_POST[usr_note]'  WHERE usr_id='$_SESSION[usr_id]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('User Profile updated successfully..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
}
if(isset($_SESSION['usr_id']))
{
	 $sqlusr_user = "SELECT * FROM usr_user WHERE usr_id='$_SESSION[usr_id]'";
	$qsqlusr_user = mysqli_query($con,$sqlusr_user);
	echo mysqli_error($con);
	$rsusr_user = mysqli_fetch_array($qsqlusr_user);
}
?>
    <section class="content-info py-5">
        <div class="container py-md-5">

<form method="post" action="">
            <div class="row">
                <div class="col-lg-2 col-md-2 mt-2"></div>
                <div class="col-lg-8 col-md-8 mt-8">
                    <div class="thumbnail card">
                        <div class="blog-info card-body">
                            <center><h3 class="">Employee Profile</h3></center>
                            <p class="mt-2">


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		 Name
	</div>
	<div class="col-md-9">
		<input type="text" name="usr_name" id="usr_name" class="form-control" value="<?php echo $rsusr_user['usr_name']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		User Login ID
	</div>
	<div class="col-md-9">
		<input type="text" name="usr_login_id" id="usr_login_id" class="form-control" value="<?php echo  $rsusr_user['usr_login_id']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		User Contact No. 
	</div>
	<div class="col-md-9">
		<input type="text" name="usr_contact" id="usr_contact" class="form-control" value="<?php  echo $rsusr_user['usr_contact']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		User Email ID
	</div>
	<div class="col-md-9">
		<input type="text" name="usr_emailid" id="usr_emailid" class="form-control" value="<?php echo  $rsusr_user['usr_emailid']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		User Note
	</div>
	<div class="col-md-9">
		<textarea name="usr_note" id="usr_note" class="form-control"><?php  echo $rsusr_user['usr_note']; ?></textarea>
	</div>
</div>	
<br>


							</p>
<div class="read-icon">
	<center><input type="submit" name="submit" class="btn read" value="Update profile"></a></center>
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