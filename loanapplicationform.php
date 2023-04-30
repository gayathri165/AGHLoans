<?php
include("header.php");
$sqlltyp_loantypes = "SELECT * FROM  ltyp_loantypes WHERE ltyp_id='$_GET[ltyp_id]'";
$qsqlltyp_loantypes = mysqli_query($con,$sqlltyp_loantypes);
$rsloan_types = mysqli_fetch_array($qsqlltyp_loantypes);
if(isset($_POST['submit']))
{
	//Photo starts here	
	$lacc_photo = rand() .  $_FILES['lacc_photo']['name'];
	move_uploaded_file($_FILES['lacc_photo']['tmp_name'],"filecst_photo/".$lacc_photo);
	if($_FILES['lacc_photo']['name'] == "")
	{
		$lacc_photo = $rscustomerprofile['cst_photo'];
	}
	//Photo ends here
	//ID Proof starts here
	$lacc_idproof = rand() .  $_FILES['lacc_idproof']['name'];
	move_uploaded_file($_FILES['lacc_idproof']['tmp_name'],"filecst_idproof/".$lacc_idproof);
	if($_FILES['lacc_idproof']['name'] == "")
	{
		$lacc_idproof = $rscustomerprofile['cst_idproof'];
	}
	//ID Proof ends here
	//Address Proof starts here
	$lacc_adressproof = rand() . $_FILES['lacc_adressproof']['name'];
	move_uploaded_file($_FILES['lacc_adressproof']['tmp_name'],"filecst_addressproof/".$lacc_adressproof);
	if($_FILES['lacc_adressproof']['name'] == "")
	{
		$lacc_adressproof = $rscustomerprofile['cst_addressproof'];
	}
	//Address Proof ends here
	$lacc_custname = $_POST['cst_fname'] . " " . $_POST['cst_mname'] . " " . $_POST['cst_lname'];
	$resaddress = serialize(array($_POST['cst_address'],$_POST['cst_state'],$_POST['cst_contact'],$_POST['cst_email']));
	$jobprofile = serialize(array($_POST['net_income'],$_POST['salary_received_in'],$_POST['company_name'],$_POST['work_experience']));
	$sql ="INSERT INTO lacc_loanaccount(cst_id,lacc_custname,lacc_dob,lacc_pan,lacc_securityentry,lacc_resaddr,lacc_compaddr,lacc_permaddr,lacc_gender,lacc_martialst,lacc_jobprofile,lacc_education,lacc_ihave,lacc_bankac,lacc_loanamt,lacc_intrate,lacc_tenor,lacc_guarantor1,lacc_guarantor2,lacc_opendt,ltyp_id,ltyp_loantyp,lpf_id,lpf_amttype,lacc_ipfprocessingfee,lacc_remarks,dpmt_charge,lacc_status,lacc_restype,comp_name,lacc_applicationdt,lacc_photo,lacc_idproof,lacc_adressproof) values('$_SESSION[cst_id]','$lacc_custname','$_POST[cst_dob]','$_POST[lacc_pan]','$_POST[lacc_securityentry]','$resaddress','$_POST[company_name]','$resaddress','$rscustomerprofile[cst_gender]','$_POST[lacc_martialst]','$jobprofile','$_POST[lacc_education]','$_POST[lacc_ihave]','$_POST[lacc_bankac]','$_POST[desired_loan_amount]','$rsloan_types[ltyp_interestperc]','$rsloan_types[ltyp_maxmonth]','$_POST[lacc_guarantor1]','$_POST[lacc_guarantor2]','$_POST[lacc_opendt]','$rsloan_types[ltyp_id]','$rsloan_types[ltyp_loantype]','$_POST[lpf_id]','$_POST[lpf_amttype]','$_POST[lacc_ipfprocessingfee]','$_POST[lacc_remarks]','$_POST[dpmt_charge]','Pending','$_POST[residence_type]','$_POST[comp_name]','$dt','$lacc_photo','$lacc_idproof','$lacc_adressproof')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Request Sent successfully..');</script>";
		echo "<script>window.location='viewloanapplication.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
    <section class="content-info">
        <div class="container">

            <h3 class="title-w3ls text-center">Loan Types</h3>
            <div class="row">
<?php
$sql = "SELECT * FROM  ltyp_loantypes WHERE ltyp_id='$_GET[ltyp_id]'";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	if($rs['ltyp_icon'] == "")
	{
		$icon = "images/noimage.png";
	}
	else if(file_exists("imgloantype/".$rs['ltyp_icon']))
	{
		$icon = "imgloantype/".$rs['ltyp_icon'];
	}
	else
	{
		$icon = "images/noimage.png";
	}
?>
	<div class="col-lg-6 col-md-6" style="height: 275px;">
		<div class="thumbnail card" style="height: 275px;">
			<div class="position-relative">
				<img src="<?php echo $icon; ?>" style="height: 250px;width: 100%;" class="img-fluid" alt="">
			</div>
		</div>
	</div>
	<div class="col-lg-6 col-md-6" style="height: 275px;">
		<div class="thumbnail card" style="height: 275px;">
			<div class="blog-info card-body">
				<h4 class=""><?php echo $rs['ltyp_loantype']; ?></h4>
				<p class="mt-2">
				<b>- Loan Amount -</b> <?php $minamt = $rs['min_loanamt']; echo  moneyFormatIndia($rs['min_loanamt']); ?> - <?php $maxamt = $rs['max_loanamt']; echo moneyFormatIndia($rs['max_loanamt']); ?><br>
				<b>- maximum Month -</b>  <?php echo $rs['ltyp_maxmonth']; ?> months<br>
				<b>- Interest rate -</b> <?php echo $rs['ltyp_interestperc']; ?>% </p>
			</div>
		</div>
	</div>
<?php
}
?>
			</div>
        </div>
    </section>
    <!-- //banner-botttom -->
<hr>

    <section class="content-info">
        <div class="container ">

<form method="post" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="col-lg-12 col-md-12 mt-12">
                    <div class="thumbnail card">
                        <div class="blog-info card-body">
                            <center><h3 class="">Loan Application Form</h3></center>
<?php
if($noloanacc >=3)
{
?>	
<center><h4 style="color: red;">You have 3 Active Loan Accounts. You cannot apply for new loan account until you close your existing loan. </h4></center>
<?php
}
else
{
?>
<p class="mt-2"><?php include("loanapplication.php"); ?></p>
						
<?php
}
?>
                        </div>
                    </div>
                </div>
			</div>














<div class="read-icon">
<center> <a href="fun.php" class="btn read"> Apply for Loan</a></center>
                            </div>


</form -->


        </div>
    </section>
    <!-- //banner-botttom -->
<br>


<?php
include("footer.php");
?>
<script>
function loadregtype(regtype)
{
	if(regtype == "Company")
	{
		document.getElementById("divregtype").innerHTML = '<div class="row"><div class="col-md-3" style="padding-top: 4px;">Company name</div><div class="col-md-9"><input type="text" name="comp_name" id="comp_name" class="form-control"></div></div><br>';
	}
	if(regtype == "Customer")
	{
		document.getElementById("divregtype").innerHTML = '<div class="row"><div class="col-md-3" style="padding-top: 4px;">Customer Name</div><div class="col-md-9"><div class="row"><div class="col-md-4"><input type="text" name="cst_fname" id="cst_fname" class="form-control" placeholder="First Name" ></div><div class="col-md-4"><input type="text" name="cst_mname" id="cst_mname" class="form-control"  placeholder="Middle Name" ></div><div class="col-md-4"><input type="text" name="cst_lname" id="cst_lname" class="form-control"  placeholder="Last Name" ></div></div></div></div><br><div class="row"><div class="col-md-3" style="padding-top: 4px;">Date of Birth</div><div class="col-md-9"><input type="date" name="cst_dob" id="cst_dob" class="form-control"></div></div><br><div class="row"><div class="col-md-3" style="padding-top: 4px;">Gender</div><div class="col-md-9"><select  name="cst_gender" id="cst_gender" class="form-control"><option value="">Select Gender</option><option value="Male">Male</option><option value="Female" >Female</option>"; } } } ?> </select>	</div></div><br>';
	}
}
</script>