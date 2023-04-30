<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE usr_user SET usr_name='$_POST[usr_name]',usr_login_id='$_POST[usr_login_id]',usr_password='$_POST[usr_password]',usr_contact='$_POST[usr_contact]',usr_emailid='$_POST[usr_emailid]',usr_note='$_POST[usr_note]',usr_status='$_POST[usr_status]'  WHERE usr_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('User Profile updated successfully..');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO usr_user values('$_POST[usr_id]','$_POST[usr_name]','$_POST[usr_login_id]','$_POST[usr_password]','$_POST[usr_contact]','$_POST[usr_emailid]','$_POST[usr_note]','$_POST[usr_status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('User record inserted successfully..');</script>";
			echo "<script>window.location='user.php';</script>";
		}
	}
}
if(isset($_GET['editid']))
{
	 $sqlusr_user = "SELECT * FROM usr_user WHERE usr_id='$_GET[editid]'";
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
                            <center><h3 class="">Employee</h3></center>
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
		User Password
	</div>
	<div class="col-md-9">
		<input type="Password" name="usr_password" id="usr_password" class="form-control" value="<?php echo  $rsusr_user['usr_password']; ?>">
	</div>
</div>	
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Confirm  Password
	</div>
	<div class="col-md-9">
		<input type="Password" name="cusr_password" id="cusr_password" class="form-control" value="<?php echo  $rsusr_user['usr_password']; ?>">
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
		User EmailID
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


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		User Status
	</div>
	<div class="col-md-9">
		<select name="usr_status" id="usr_status" class="form-control">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsusr_user['usr_status']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
			}
			?>
		</select>
	</div>
</div>		
<br>
			
							</p>
                            <div class="read-icon">
                                <center><input type="submit" name="submit" class="btn read" value="submit"></a></center>
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