<?php
$sqlcustomer = "SELECT * FROM  cst_customer WHERE cst_id='$_SESSION[cst_id]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rsedit = mysqli_fetch_array($qsqlcustomer);
?>
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<div class="container" style="width: 100%;">
    <div class="row">
    	<div class="col-md-12">
		
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Profile detail</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Contact detail</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Loan detail</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
						
<!--######################### -->
<?php
if($_SESSION['cst_type'] == "Company")
{
?>
<div class="row"><div class="col-md-3" style="padding-top: 4px;">Company name</div><div class="col-md-9"><input type="text" name="comp_name" id="comp_name" class="form-control" value="<?php echo $rsedit['comp_name']; ?>" ></div></div><br>
<?php
}
if($_SESSION['cst_type'] == "Customer")
{
?>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Customer Name</div>
	<div class="col-md-9"><div class="row"><div class="col-md-4"><input type="text" name="cst_fname" id="cst_fname" class="form-control" placeholder="First Name"  value="<?php echo  $rsedit['cst_fname']; ?>" ></div><div class="col-md-4"><input type="text" name="cst_mname" id="cst_mname" class="form-control"  placeholder="Middle Name" value="<?php echo  $rsedit['cst_mname']; ?>"  ></div><div class="col-md-4"><input type="text" name="cst_lname" id="cst_lname" class="form-control"  placeholder="Last Name"  value="<?php echo  $rsedit['cst_lname']; ?>" ></div></div></div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Date of Birth</div>
	<div class="col-md-9"><input type="date" name="cst_dob" id="cst_dob" class="form-control" value="<?php echo  $rsedit['cst_dob']; ?>"></div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">PAN Card No.</div>
	<div class="col-md-9"><input type="TEXT" name="lacc_pan" id="lacc_pan" class="form-control" value="<?php echo  $rsedit['cst_pan']; ?>">
	
</div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Gender</div>
	<div class="col-md-9">
	<select  name="cst_gender" id="cst_gender" class="form-control" style='height: 40px;'><option value="">Select Gender</option><?php $arr= array("Male","Female"); foreach($arr as $val) {	 if($val == $rsedit['cst_gender'])	 {	 echo "<option value=$val selected>$val</option>";	 }	 else	 {	 echo "<option value=$val >$val</option>";	 } } ?></select>	
	</div>
</div>
<br>
<?php
}
?>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Photo
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_photo" id="cst_photo" class="form-control" accept="image/*">
		<?php
		if($rsedit['cst_photo'] == "")
		{
			echo "<img src='images/noimage.png' class='btn btn-warning' style='width: 170px; height: 200px;'>";
		}
		else if(file_exists("filecst_photo/".$rsedit['cst_photo']))
		{
			echo "<img src='filecst_photo/$rsedit[cst_photo]' class='btn btn-warning' style='width: 170px; height: 200px;'>";
		}
		?>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		ID Proof
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_idproof" id="cst_idproof" class="form-control">
		<?php
		if(file_exists("filecst_idproof/".$rsedit['cst_idproof']))
		{
			echo "<a href='filecst_idproof/$rsedit[cst_idproof]' class='btn btn-secondary'>Download ID Proof</a>";
		}
		?>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Address Proof
	</div>
	<div class="col-md-9">
		<input type="file" name="cst_idproof" id="cst_idproof" class="form-control">
		<?php
		if(file_exists("filecst_idproof/".$rsedit['cst_idproof']))
		{
			echo "<a href='filecst_idproof/$rsedit[cst_idproof]' class='btn btn-secondary'>Download ID Proof</a>";
		}
		?>
	</div>
</div>
<br>
<!--######################### -->
						
						</div>
                        <div class="tab-pane fade" id="tab2default">
						

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Address
	</div>
	<div class="col-md-9">
		<textarea name="cst_address" id="cst_address" class="form-control"><?php echo  $rsedit['cst_address']; ?></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		State
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_state" id="cst_state" class="form-control" value="<?php echo  $rsedit['cst_state']; ?>">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Contact No.
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_contact" id="cst_contact" class="form-control" value="<?php echo  $rsedit['cst_contact']; ?>">
	</div>
</div><br><br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Email.
	</div>
	<div class="col-md-9">
		<input type="email" name="cst_email" id="cst_email" class="form-control" value="<?php echo  $rsedit['cst_email']; ?>">
		<?php file_put_contents('file.txt', $rsedit['cst_email']); ?>
		
	</div>
</div>
<br>


<br>


						
						</div>
                        <div class="tab-pane fade" id="tab3default">

<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Your Desired Loan Amount
		<input type="number" min="<?php echo $minamt; ?>" max="<?php echo $maxamt; ?>" name="desired_loan_amount" id="desired_loan_amount" class="form-control"  style="height: 50px;font-size: 36px;" >
	</div>
	<div class="col-md-6">
		Residence Type
		<select name="residence_type" id="residence_type" class="form-control"   style="height: 50px;font-size: 20px;"   >
			<option value="">Select Residence Type</option>
			<?php
			$arr = array("Owned by self/spouse","Owned by parents/sibling","Rented- With family","Rented- With friends","Rented- Staying alone","Paying guest","Hostel","Company Provided");
			foreach($arr as $val)
			{
				echo "<option value='$val'>$val</option>";
			}
			?>
		</select>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Your net monthly income ? 
		<input type="number" name="net_income" id="net_income" class="form-control"   style="height: 50px;font-size: 36px;" >
	</div>
	<div class="col-md-6">
		Salary Received In
		<select name="salary_received_in" id="employment_type" class="form-control"   style="height: 50px;font-size: 20px;"   >
			<option value="">Select Salary Received In</option>
			<?php
			$arr = array("Cheque","Cash","Bank Transfer");
			foreach($arr as $val)
			{
				echo "<option value='$val'>$val</option>";
			}
			?>
		</select>
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Your company name
		<input type="text" name="company_name" id="company_name" class="form-control"   style="height: 50px;font-size: 20px;"  >
	</div>
	<div class="col-md-6">
		Current Work Exerience?
		<select name="work_experience" id="work_experience" class="form-control"   style="height: 50px;font-size: 20px;"   >
			<option value="">Select Work Exerience</option>
			<?php
			$arr = array("0-3 Months","3-6 Months","6-12 Months","1-2 Years","2-3 Years","3-5 Years","5+ Years");
			foreach($arr as $val)
			{
				echo "<option value='$val'>$val</option>";
			}
			?>
		</select>






	</div>
</div>

						
						</div>
                        <div class="tab-pane fade" id="tab4default">Default 4</div>
                    </div>
                </div>
            </div>
        
		</div>
	</div>
</div>