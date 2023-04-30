<?php
include("header.php");
if(isset($_POST['submit']))  
{
	$cst_photo = rand() . $_FILES['cst_photo']['name'];
	move_uploaded_file($_FILES['cst_photo']['tmp_name'],"filecst_photo/".$cst_photo);
	$cst_idproof  = rand() . $_FILES['cst_idproof']['name'];
	move_uploaded_file($_FILES['cst_idproof']['tmp_name'],"filecst_idproof/".$cst_idproof);
	$cst_addressproof =rand() .  $_FILES['cst_addressproof']['name'];
	move_uploaded_file($_FILES['cst_addressproof']['tmp_name'],"filecst_addressproof/".$cst_addressproof);
	$sql ="INSERT INTO cst_customer(usr_id, cst_type, comp_name, cst_fname, cst_mname, cst_lname, cst_dob, cst_gender, cst_address, cst_state, cst_contact, cst_email, cst_password, cst_bankdetail, cst_jobdetail, cst_note, cst_photo, cst_idproof, cst_addressproof, cst_status) values('$_POST[usr_id]','$_POST[cst_type]','$_POST[comp_name]','$_POST[cst_fname]','$_POST[cst_mname]','$_POST[cst_lname]','$_POST[cst_dob]','$_POST[cst_gender]','$_POST[cst_address]','$_POST[cst_state]','$_POST[cst_contact]','$_POST[cst_email]','$_POST[cst_password]','$_POST[cst_bankdetail]','$_POST[cst_jobdetail]','$_POST[cst_note]','$cst_photo','$cst_idproof','$cst_addressproof','$_POST[cst_status]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Customer record inserted successfully..');</script>";
		echo "<script>window.location='customer.php';</script>";
	}
}
?>
    <section class="content-info py-5">
        <div class="container py-md-5">

<form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-2 col-md-2 mt-2"></div>
                <div class="col-lg-8 col-md-8 mt-8">
                    <div class="thumbnail card">
                        <div class="blog-info card-body">
                            <center><h3 class="">Customer</h3></center>
                            <p class="mt-2">
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Employee
	</div>
	<div class="col-md-9">
		<select name="usr_id" id="usr_id" class="form-control">
			<option value="">Select Employee</option>
			<?php
			$sqlusr_user = "SELECT * FROM usr_user WHERE usr_status='Active'";
			$qsqlusr_user = mysqli_query($con,$sqlusr_user);
			while($rsusr_user = mysqli_fetch_array($qsqlusr_user))
			{
				if($rsusr_user['usr_login_id'] == $rsedit['usr_login_id'])
				{
					echo "<option value='$rsusr_user[usr_id]' selected >$rsusr_user[usr_name] (" . $rsusr_user['usr_login_id'] . ")</option>";
				}
				else
				{
					echo "<option value='$rsusr_user[usr_id]'>$rsusr_user[usr_name] (" . $rsusr_user['usr_login_id'] . ")</option>";
				}
			}
			?>
		</select>
	</div>
</div>				
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Customer Type
	</div>
	<div class="col-md-9">
		<select  name="cst_type" id="cst_type" class="form-control">
			<option value="">Select Customer type</option>
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
	</div>
</div>	
<br>

 
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Company name
	</div>
	<div class="col-md-9">
		<input type="text" name="comp_name" id="comp_name" class="form-control">
	</div></div>	
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		First Name
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_fname" id="cst_fname" class="form-control">
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Middle Name
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_mname" id="cst_mname" class="form-control">
	</div>
</div>	
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Last Name
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_lname" id="cst_lname" class="form-control">
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Date of Birth
	</div>
	<div class="col-md-9">
		<input type="date" name="cst_dob" id="cst_dob" class="form-control">
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Gender
	</div>
	<div class="col-md-9">
		<select  name="cst_gender" id="cst_gender" class="form-control">
			<option value="">Select Customer type</option>
			<?php
			$arr = array("Male","Female");
			foreach($arr as $val)
			{
				if($val == $rsedit['cst_gender'])
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
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Address
	</div>
	<div class="col-md-9">
		<textarea name="cst_address" id="cst_address" class="form-control"></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		State
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_state" id="cst_state" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Contact No.
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_contact" id="cst_contact" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Email ID.
	</div>
	<div class="col-md-9">
		<input type="email" name="cst_email" id="cst_email" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Password
	</div>
	<div class="col-md-9">
		<input type="password" name="cst_password" id="cst_password" class="form-control">
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Confirm Password
	</div>
	<div class="col-md-9">
		<input type="password" name="ccst_password" id="ccst_password" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Bank Account Detail
	</div>
	<div class="col-md-9">
		<textarea name="cst_bankdetail" id="cst_bankdetail" class="form-control"></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Job Detail
	</div>
	<div class="col-md-9">
		<textarea name="cst_jobdetail" id="cst_jobdetail" class="form-control"></textarea>
	</div>
</div>
<br>



<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload Photo
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_photo" id="cst_photo" class="form-control" accept="image/*">
	</div>
</div>
<br>




<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload ID proof
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_idproof" id="cst_idproof" class="form-control">
	</div>
</div>
<br>




<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload Adress Proof
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_addressproof" id="cst_addressproof" class="form-control">
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Customer Note
	</div>
	<div class="col-md-9">
		<textarea name="cst_note" id="cst_note" class="form-control"></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Status
	</div>
	<div class="col-md-9">
		<select name="cst_status" id="cst_status" class="form-control">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsedit['status']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
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