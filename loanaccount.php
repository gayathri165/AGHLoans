<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO lacc_loanaccount(lacc_no,lacc_custname,lacc_swdof,lacc_dob,lacc_pan,lacc_securityentry,lacc_resaddr,lacc_compaddr,lacc_permaddr,lacc_gender,lacc_martialst,lacc_jobprofile,lacc_education,lacc_ihave,lacc_bankac,lacc_loanamt,lacc_intrate,lacc_tenor,lacc_reference1,lacc_reference2,lacc_guarantor1,lacc_guarantor2,lacc_opendt,ltyp_id,ltyp_loantyp,lpf_id,lpf_amttype,lacc_ipfprocessingfee,lacc_remarks,dpmt_charge,lacc_status) values('$_POST[lacc_no]','$_POST[lacc_custname]','$_POST[lacc_swdof]','$_POST[lacc_dob]','$_POST[lacc_pan]','$_POST[lacc_securityentry]','$_POST[lacc_resaddr]','$_POST[lacc_compadddr]','$_POST[lacc_permaddr]','$_POST[lacc_gender]','$_POST[lacc_martialst]','$_POST[lacc_jobprofile]','$_POST[lacc_education]','$_POST[lacc_ihave]','$_POST[lacc_bankac]','$_POST[lacc_loanamount]','$_POST[lacc_intrate]','$_POST[lacc_tenor]','$_POST[lacc_reference1]','$_POST[lacc_reference2]','$_POST[lacc_guarantor1]','$_POST[lacc_guarantor2]','$_POST[lacc_opendt]','$_POST[ltyp_id]','$_POST[ltyp_loantype]','$_POST[lpf_id]','$_POST[lpf_amttype]','$_POST[lacc_ipfprocessingfee]','$_POST[lacc_remarks]','$_POST[dpmt_charge]','$_POST[lacc_status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan account record inserted successfully..');</script>";
		echo "<script>window.location='loaninstallment.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
    </div>
    <!-- //banner -->
    <!-- products -->
    <section class="products py-1" id="stats">
        <div class="container py-lg-5 py-1">
            <div class="row products_grids">

				<div class="col-lg-12 col-12" style="padding-left: 200px;padding-right: 200px;">
                    <div class="prodct1">
                            <center><h2 class="mt-2"> Loan Account Zone</h2></center><br>


<form method="post" action="">
<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		Loan Account Number
	</div>
	<div class="col-md-8">
		<input type="text" name="lacc_no" id="lacc_no" class="form-control">
	</div>
</div>
<br>		


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant CustomerName
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_custname" id="lacc_custname" class="form-control">
    </div>
</div>
<br>    



<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Number
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_swdof" id="lacc_swdof" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Date
    </div>
    <div class="col-md-8">
        <input type="date" name="lacc_dob " id="lacc_dob " class="form-control">
    </div>
</div>
<br>  


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Pan Number
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_pan " id="lacc_pan" class="form-control">
    </div>
</div>
<br>    

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant SecurityEntry Number
    </div>
    <div class="col-md-8">
        <textarea name="lacc_securityentry" id="lacc_securityentry" class="form-control"></textarea>
    </div>
</div>
<br> 

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Residential Address
    </div>
    <div class="col-md-8">
        <textarea name="lacc_resaddr"  id="lacc_resaddr" class="form-control"></textarea>
    </div>
</div>
<br> 

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Companyaddress
    </div>
    <div class="col-md-8">
        <textarea name="lacc_compadddr" id="lacc_compadddr" class="form-control"></textarea>
    </div>
</div>
<br> 

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Permenantaddress
    </div>
    <div class="col-md-8">
        <textarea name="lacc_permaddr"  id="lacc_permaddr" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Gender
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_gender" id="lacc_gender" class="form-control">
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Martialstate
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_martialst" id="lacc_martialst" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Jobprofile
    </div>
    <div class="col-md-8">
        <textarea name="lacc_jobprofile" id="lacc_jobprofile" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Education
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_education" id="lacc_education" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Ihave
    </div>
    <div class="col-md-8">
        <textarea name="lacc_ihave"  id="lacc_ihave" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Bankaccount
    </div>
    <div class="col-md-8">
        <textarea name="lacc_bankac" id="lacc_bankac" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Loanamount
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_loanamount" id="lacc_loanamount" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Interestrate
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_intrate" id="lacc_intrate" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Tenor
            </div>
    <div class="col-md-8">
        <textarea name="lacc_tenor" id="lacc_tenor" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Reference1
            </div>
    <div class="col-md-8">
        <textarea name="lacc_reference1" id="lacc_reference1" class="form-control"></textarea>
    </div>
</div>
<br>
		
<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Reference2
            </div>
    <div class="col-md-8">
        <textarea name="lacc_reference2" id="lacc_reference2" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Guarantor1
            </div>
    <div class="col-md-8">
        <textarea name="lacc_guarantor1" id="lacc_guarantor1" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Guarantor2
            </div>
    <div class="col-md-8">
        <textarea name="lacc_guarantor2" id="lacc_guarantor2" class="form-control"></textarea>
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Opendate
    </div>
    <div class="col-md-8">
        <input type="Date" name="lacc_opendt" id="lacc_opendt" class="form-control">
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Type ID
    </div>
    <div class="col-md-8">
        <input type="text" name="ltyp_id" id="ltypid" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
     Loantype
    </div>
    <div class="col-md-8">
        <input type="text" name="ltyp_loantype" id="ltyp_loantype" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Processingfee ID
    </div>
    <div class="col-md-8">
        <input type="text" name="lpf_id" id="lpf_id" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Processing fee Amounttype
    </div>
    <div class="col-md-8">
        <input type="text" name="lpf_amttype" id="lpf_amttype" class="form-control">
    </div>
</div>
<br>


<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Interestprocessingfee
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_ipfprocessingfee" id="lacc_ipfprocessingfee" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Remarks
    </div>
    <div class="col-md-8">
        <textarea name="lacc_remarks" id="lacc_remarks" class="form-control"></textarea>
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Charge
    </div>
    <div class="col-md-8">
        <input type="text" name="dpmt_charge" id="dpmt_charge" class="form-control">
    </div>
</div>
<br>

<div class="row">
    <div class="col-md-4" style="padding-top: 4px;">
        Loan Accountant Status
    </div>
    <div class="col-md-8">
        <input type="text" name="lacc_status" id="lacc_status" class="form-control">
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