<?php
include("header.php");
if(isset($_POST['submitreject']))
{
	$sql ="UPDATE lacc_loanaccount  SET lacc_status='Rejected' WHERE lacc_id='$_GET[viewid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Application Request updated successfully..');</script>";
		echo "<script>window.location='viewloanapplication.php?status=Pending';</script>";
	}
}
if(isset($_POST['submit']))
{
	$sql ="UPDATE lacc_loanaccount  SET lacc_swdof='$_POST[lacc_swdof]',lacc_securityentry='$_POST[lacc_securityentry]', lacc_martialst='$_POST[lacc_martialst]', lacc_ihave='$_POST[lacc_ihave]', lacc_reference1='$_POST[lacc_reference1]', lacc_reference2='$_POST[lacc_reference2]', lacc_guarantor1 ='$_POST[lacc_guarantor1]',lacc_guarantor2='$_POST[lacc_guarantor2]', lacc_remarks='$_POST[lacc_remarks]',ltyp_id='$_POST[ltyp_id]',lacc_tenor='$_POST[lacc_tenor]',lacc_loanamt='$_POST[lacc_loanamount]',lacc_intrate='$_POST[lacc_intrate]',interest_amt='$_POST[interest_amt]',dpmt_charge='$_POST[dpmt_charge]',lpf_id='$_POST[lpf_id]',lpf_amttype='$_POST[lpf_amttype]',lacc_ipfprocessingfee='$_POST[lpf_amt]',lacc_status='Approved' WHERE lacc_id='$_GET[viewid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Application Approved successfully..');</script>";
		echo "<script>window.location='viewloanapplication.php?status=Pending';</script>";
	}
}
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT * FROM  lacc_loanaccount where lacc_id='$_GET[viewid]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
//###########Loan pending customer profile starts here
$sqlcustomer = "SELECT * FROM  cst_customer WHERE cst_id='$rslacc_loanaccount[cst_id]'";
$qsqlcustomer = mysqli_query($con,$sqlcustomer);
$rsedit = mysqli_fetch_array($qsqlcustomer);
//###########Loan pending customer profile ends here
//###########Loan types starts here
$sqlltyp_loantypes= "SELECT * FROM ltyp_loantypes WHERE ltyp_id='$rslacc_loanaccount[ltyp_id]'";
$qsqlltyp_loantypes = mysqli_query($con,$sqlltyp_loantypes);
$rsltyp_loantypes = mysqli_fetch_array($qsqlltyp_loantypes);
//###########Loan types ends here
//###########loan processing fee starts  here
$sqlprocessingfee= "SELECT * FROM lpf_loanprocessingfee WHERE '$rslacc_loanaccount[lacc_loanamt]' BETWEEN lpf_famt AND lpf_tamt";
$qsqlprocessingfee = mysqli_query($con,$sqlprocessingfee);
$rslprocessingfee = mysqli_fetch_array($qsqlprocessingfee);
//###########loan processing fee ends here
?>
    </div>
    <!-- //banner -->
<link href="//netdna.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!-- products -->
    <section class="products py-1" id="stats">
        <div class="container py-lg-5 py-1">
            <div class="row products_grids">

				<div class="col-lg-12 col-12">
                    <div class="prodct1">
                            <center><h2 class="mt-2"><?php echo $rslacc_loanaccount['lacc_status']; ?> Loan Request</h2></center><br>
<form method="post" action="">

		
            <div class="panel with-nav-tabs panel-default">
                <div class="panel-heading">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab1default" data-toggle="tab">Customer detail</a></li>
                            <li><a href="#tab2default" data-toggle="tab">Contact detail</a></li>
                            <li><a href="#tab3default" data-toggle="tab">Loan detail</a></li>
                            <li><a href="#tab4default" data-toggle="tab">Loan Application Profile</a></li>
                            <li><a href="#tab5default" data-toggle="tab">Loan Account</a></li>
                        </ul>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="tab1default">
						
<!--######################### -->
<div id="divregtype">
<?php
if($rsedit['cst_type'] == "Company")
{
?>
<div class="row"><div class="col-md-3" style="padding-top: 4px;">Company name</div><div class="col-md-9"><input type="text" name="comp_name" id="comp_name" class="form-control" value="<?php echo $rsedit['comp_name']; ?>" readonly ></div></div><br>
<?php
}
if($rsedit['cst_type'] == "Customer")
{
?>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Customer Name</div>
	<div class="col-md-9"><input type="text" name="lacc_custname" id="lacc_custname" class="form-control" placeholder="Customer Name"  value="<?php echo $rslacc_loanaccount['lacc_custname']; ?>" readonly ></div>
</div>
<br>
<div class="row">
    <div class="col-md-3">
        S/O , W/O, D/O
    </div>
    <div class="col-md-9">
        <input type="text" name="lacc_swdof" id="lacc_swdof" class="form-control" value="<?php echo  $rslacc_loanaccount['lacc_swdof']; ?>">
    </div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Date of Birth</div>
	<div class="col-md-9"><input type="date" name="cst_dob" id="cst_dob" class="form-control" value="<?php echo  $rslacc_loanaccount['lacc_dob']; ?>" readonly ></div>
</div>
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Gender</div>
	<div class="col-md-9"><select  name="cst_gender" id="cst_gender" class="form-control" style="height: 35px;" readonly><?php $arr= array("Male","Female"); foreach($arr as $val) {	 if($val == $rslacc_loanaccount['lacc_gender'])	 {	 echo "<option value=$val selected>$val</option>";	 }	} ?></select>	</div>
</div>
<br>
<?php
}
?>
</div>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">PAN Card No.</div>
	<div class="col-md-9"><input type="text" name="cst_pan" id="cst_pan" class="form-control" value="<?php echo  $rslacc_loanaccount['lacc_pan']; ?>" readonly ></div>
</div>
<br>
<?php
$bankarr = unserialize($rsedit['cst_bankdetail']);
?>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Bank Name</div>
	<div class="col-md-9">
	<input type="text" name="bank_bankname" id="bank_bankname" class="form-control" value="<?php echo $bankarr[0]; ?>" readonly  >
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">Account Number</div>
	<div class="col-md-9">
	<input type="text" name="bank_accnumber" id="bank_accnumber" class="form-control" value="<?php echo $bankarr[1]; ?>"  readonly >
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		IFSC Code
	</div>
	<div class="col-md-9">
	<input type="text" name="bank_ifsc" id="bank_ifsc" class="form-control" value="<?php echo $bankarr[2]; ?>" readonly  >
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload Photo
	</div>
	<div class="col-md-9">
		<?php
		if($rslacc_loanaccount['lacc_photo'] == "")
		{
			echo "<img src='images/noimage.png' class='btn btn-warning' style='width: 170px; height: 200px;'>";
		}
		else if(file_exists("filecst_photo/".$rslacc_loanaccount['lacc_photo']))
		{
			echo "<img src='filecst_photo/$rslacc_loanaccount[lacc_photo]' class='btn btn-warning' style='width: 170px; height: 200px;'>";
		}
		?>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload ID proof
	</div>
	<div class="col-md-9">
		<?php
		if(file_exists("filecst_idproof/".$rslacc_loanaccount['lacc_idproof']))
		{
			echo "<a href='filecst_idproof/$rslacc_loanaccount[lacc_idproof]' class='btn btn-secondary' download >Download ID Proof</a>";
		}
		?>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Upload Adress Proof
	</div>
	<div class="col-md-9">
		<?php
		if(file_exists("filecst_addressproof/".$rslacc_loanaccount['lacc_adressproof']))
		{
			echo "<a href='filecst_addressproof/$rslacc_loanaccount[lacc_adressproof]' class='btn btn-primary' download >Download Address Proof</a>";
		}
		?>
	</div>
</div>
<br>

<!--######################### -->
						
						</div>
                        <div class="tab-pane fade" id="tab2default">
						
<br>
<b>Permanent Address:</b>
<?php
$lacc_permaddr = unserialize($rslacc_loanaccount['lacc_permaddr']);
?>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Address
	</div>
	<div class="col-md-9">
		<textarea name="cst_address" id="cst_address" class="form-control" readonly ><?php echo $lacc_permaddr[0]; ?></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		State
	</div>
	<div class="col-md-9">
<input name="cst_state" id="cst_state" class="form-control" value="<?php echo $lacc_permaddr[1]; ?>" readonly  >
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Contact No.
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_contact" id="cst_contact" class="form-control"  value="<?php echo $lacc_permaddr[2]; ?>" readonly >
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Email ID.
	</div>
	<div class="col-md-9">
	<input type="email" name="cst_email" id="cst_email" class="form-control" value="<?php echo  $rsedit['cst_email'];?>" readonly>
		<?php file_put_contents('file1.txt', $rsedit['cst_email']); ?>
	</div>
</div>
<br>
<hr>

<b>Residence Address:</b>
<?php
$lacc_resaddr = unserialize($rslacc_loanaccount['lacc_resaddr']);
?>
<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Address
	</div>
	<div class="col-md-9">
		<textarea name="cst_resaddress" id="cst_resaddress" class="form-control"  ><?php echo $lacc_resaddr[0]; ?></textarea>
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		State
	</div>
	<div class="col-md-9">
<input name="cst_resstate" id="cst_resstate" class="form-control" value="<?php echo $lacc_resaddr[1]; ?>"   >
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Contact No.
	</div>
	<div class="col-md-9">
		<input type="text" name="cst_rescontact" id="cst_rescontact" class="form-control"  value="<?php echo $lacc_resaddr[2]; ?>"  >
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Email ID.
	</div>
	<div class="col-md-9">
	<input type="email" name="cst_email" id="cst_email" class="form-control" value="<?php echo  $rsedit['cst_email'];?>" >
	<?php file_put_contents('file2.txt', $rsedit['cst_email']); ?>
	
	</div>
</div>
<br>

						</div>
                        <div class="tab-pane fade" id="tab3default">
<?php
$lacc_jobprofile = unserialize($rslacc_loanaccount['lacc_jobprofile']);
?>
<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Your Desired Loan Amount
		<input type="text" name="desired_loan_amount" id="desired_loan_amount"   value="<?php echo $rslacc_loanaccount['lacc_loanamt']; ?>" class="form-control" readonly >
	</div>
	<div class="col-md-6">
		Residence Type
		<input type="text" name="residence_type" id="residence_type" class="form-control"  value="<?php echo $rslacc_loanaccount['lacc_restype']; ?>" readonly  >
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Your net monthly income ? 
		<input type="text" name="net_income" id="net_income" class="form-control"  value="<?php echo  $lacc_jobprofile[0]; ?>" readonly >
	</div>
	<div class="col-md-6">
		Salary Received In
		<input type="text" readonly name="cst_jobdetail" id="cst_jobdetail" class="form-control" value="<?php echo  $lacc_jobprofile[1]; ?>" >
	</div>
</div>
<br>
<div class="row">
	<div class="col-md-6" style="padding-top: 4px;">
		Company name
		<input type="text" readonly name="cst_jobdetail" id="cst_jobdetail" class="form-control" value="<?php echo  $lacc_jobprofile[2]; ?>">
	</div>
	<div class="col-md-6">
		Current Work Exerience?
		<input type="text" readonly name="cst_jobdetail" id="cst_jobdetail" class="form-control" value="<?php echo  $lacc_jobprofile[3]; ?>">
	</div>
</div>

						
						</div>
                        <div class="tab-pane fade" id="tab4default">

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Account Security
    </div>
    <div class="col-md-8">
        <textarea name="lacc_securityentry" id="lacc_securityentry" class="form-control"><?php echo $rslacc_loanaccount['lacc_securityentry']; ?></textarea>
    </div>
</div>
<br> 
<?php
if($rsedit['cst_type'] == "Customer")
{
?>
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Marital status
    </div>
    <div class="col-md-8">
		<select  name="lacc_martialst" id="lacc_martialst" class="form-control" style="height: 35px;">
			<option value="">Select Marital status</option>
			<?php
			$arr = array("Married","single","Divorced","Widowed ");
			foreach($arr as $val)
			{
				if($val == $rslacc_loanaccount['lacc_martialst'])
				{
				echo "<option value='$val' selected>$val</option>";
				}
				else
				{
				echo "<option value='$val'>$val</option>";
				}
			}
			?>
		</select>
    </div>
</div>
<br>
<?php
}
?>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Existing loan Account detail
    </div>
    <div class="col-md-8">
        <textarea name="lacc_ihave"  id="lacc_ihave" class="form-control"><?php echo $rslacc_loanaccount['lacc_ihave']; ?></textarea>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
         Reference 1
            </div>
    <div class="col-md-8">
        <textarea name="lacc_reference1" id="lacc_reference1" class="form-control"><?php echo $rslacc_loanaccount['lacc_reference1']; ?></textarea>
    </div>
</div>
<br>
		
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Reference 2
            </div>
    <div class="col-md-8">
        <textarea name="lacc_reference2" id="lacc_reference2" class="form-control"><?php echo $rslacc_loanaccount['lacc_reference2']; ?></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Guarantor 1
            </div>
    <div class="col-md-8">
        <textarea name="lacc_guarantor1" id="lacc_guarantor1" class="form-control"><?php echo $rslacc_loanaccount['lacc_guarantor1']; ?></textarea>
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Guarantor 2
            </div>
    <div class="col-md-8">
        <textarea name="lacc_guarantor2" id="lacc_guarantor2" class="form-control"><?php echo $rslacc_loanaccount['lacc_guarantor2']; ?></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Remarks
    </div>
    <div class="col-md-8">
        <textarea name="lacc_remarks" id="lacc_remarks" class="form-control"><?php echo $rslacc_loanaccount['lacc_remarks']; ?></textarea>
    </div>
</div>
<br>


						
						</div>
                        
						<div class="tab-pane fade" id="tab5default">
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Type
    </div>
    <div class="col-md-8">
        <input type="hidden" name="ltyp_id" id="ltypid" class="form-control" value="<?php echo $rsltyp_loantypes['ltyp_id']; ?>">
        <input type="text" name="loantype" id="loantype" class="form-control" value="<?php echo $rsltyp_loantypes['ltyp_loantype']; ?>" readonly>
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Tenor (In Months)
            </div>
    <div class="col-md-8">
        <input type="number" name="lacc_tenor" id="lacc_tenor" class="form-control" min="1" max="<?php echo $rslacc_loanaccount['lacc_tenor']; ?>" value="<?php echo $rslacc_loanaccount['lacc_tenor']; ?>" readonly >
    </div>
</div>
<br>

	
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan amount
    </div>
    <div class="col-md-8">
        <input type="number" name="lacc_loanamount" id="lacc_loanamount" class="form-control" value="<?php 		
		echo intval($rslacc_loanaccount['lacc_loanamt']); 
		?>" min="<?php echo intval($rsltyp_loantypes['min_loanamt']); ?>" max="<?php echo intval($rsltyp_loantypes['max_loanamt']); ?>" readonly >
    </div>
</div>
<br>
 
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Interest rate (in %)
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_intrate" id="lacc_intrate" class="form-control" value="<?php 
		echo $rslacc_loanaccount['lacc_intrate']; 
		?>" readonly>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Interest Amount
    </div>
    <div class="col-md-8">
        <input type="text" name="interest_amt" id="interest_amt" class="form-control" value="<?php
		if($rslacc_loanaccount['interest_amt'] == 0)
		{
			echo $interest_amt = $rslacc_loanaccount['lacc_loanamt'] * ($rslacc_loanaccount['lacc_intrate']/100) * ($rslacc_loanaccount['lacc_tenor']/12);
		}
		else
		{
			echo $interest_amt = $rslacc_loanaccount['interest_amt'];
		}
		?>" readonly >
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Total Payment Amount
    </div>
    <div class="col-md-8">
        <input type="text" name="t_amt" id="t_amt" class="form-control" readonly value="<?php 
		echo $rslacc_loanaccount['lacc_loanamt'] + $interest_amt;
		?>">
    </div>
</div>
<br>



<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Delay Payment Charge (In %)
    </div>
    <div class="col-md-8">
<?php
$sqledit = "SELECT * FROM dpmt_delaypayment ";
$qsqledit = mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qsqledit);
?>
        <input type="text" name="dpmt_charge" id="dpmt_charge" class="form-control" value="<?php 
		if($rslacc_loanaccount['dpmt_charge'] >= 1)
		{
			echo $rslacc_loanaccount['dpmt_charge']; 
		}
		else
		{
			echo $rsedit['dpmt_charge']; 
		}
		?>" readonly >
    </div>
</div>
<br>
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Processing fee charges (<?php echo $rslprocessingfee['lpf_amt']; ?>%)
    </div>
    <div class="col-md-8">
        <input type="hidden" name="lpf_id" id="lpf_id" class="form-control" value="<?php echo $rslprocessingfee['lpf_id']; ?>">
        <input type="hidden" name="lpf_amttype" id="lpf_amttype" class="form-control" value="<?php echo $rslprocessingfee['lpf_amttype']; ?>">
        <input type="text" name="lpf_amt" id="lpf_amt" class="form-control" readonly value="<?php 
		if($rslprocessingfee['lpf_amttype'] == "Percentage")
		{
			echo intval($rslprocessingfee['lpf_amt']*$rslacc_loanaccount['lacc_loanamt']/100); 
		}
		else
		{
			echo $rslprocessingfee['lpf_amt']; 
		}
		?>">
    </div>
</div>
<br>


						
						</div>
                    </div>
                </div>
            </div>
    </p>
<div class="read-icon">
<div class="col-lg-6 col-md-6 mt-6" style="text-align: left"><input type="submit" name="submitreject" id="submitreject" class="btn read" value="Reject Loan Application"></a></div>					
<div class="col-lg-6 col-md-6 mt-6" style="text-align: left"><input type="submit" name="submitreject" id="submitreject" class="btn read" value="Reject Loan Application"></a></div>					
	
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