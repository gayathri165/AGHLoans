<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO lins_loaninstallment(lacc_id,lins_no,lins_date,lins_amt,lins_iperc,lins_iamt,lins_chqno,lins_note,lins_status) values('$_POST[lacc_id]','$_POST[lins_no]','$_POST[lins_date]','$_POST[lins_amt]','$_POST[lins_iperc]','$_POST[lins_iamt]','$_POST[lins_chqno]','$_POST[lins_chqno]','$_POST[lins_status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan Installment record inserted successfully..');</script>";
		echo "<script>window.location='loaninstallment.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
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
                            <center><h3 class="">Loan Installment</h3></center>
                            <p class="mt-2">


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Number
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_no" id="lins_no" class="form-control">
	</div>
</div>	
<br>

 <div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Date of Birth
	</div>
	<div class="col-md-9">
		<input type="date" name="lins_date" id="lins_date" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Amount
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_amt" id="lins_amt" class="form-control">
	</div>
</div>	
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Interestpercentage
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_iperc" id="lins_iperc" class="form-control">
	</div>
</div>

<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment InterestAmount
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_iamt" id="lins_iamt" class="form-control">
	</div>
</div>	
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Cheque Number
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_chqno" id="lins_chqno" class="form-control">
	</div>
</div>
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Note
	</div>
	<div class="col-md-9">
		<textarea name="lins_note" id="lins_note" class="form-control"></textarea>
	</div>
</div>
<br>


<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment Status
	</div>
	<div class="col-md-9">
		<select name="lins_status" id="lins_status" class="form-control">
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
    


