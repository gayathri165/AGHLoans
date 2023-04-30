<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="INSERT INTO ltr_loantransaction(lacc_id,lins_id,ltr_transdt,ltr_transtype,ltr_billno,ltr_amt,ltr_paymenttype,ltr_chqno,ltr_bank,ltr_note,ltr_status,ltr_cancellationtype,ltr_cancellationreason,ltr_chq_bounce_id,ltr_del_id) values('$_POST[lacc_id]','$_POST[lins_id]','$_POST[ltr_transdt]','$_POST[ltr_transtype]','$_POST[ltr_billno]','$_POST[ltr_amt]','$_POST[ltr_paymenttype]','$_POST[ltr_chqno]','$_POST[ltr_bank]','$_POST[ltr_note]','$_POST[ltr_status]','$_POST[ltr_cancellationtype]','$_POST[ltr_cancellationreason]','$_POST[ltr_chq_bounce_id]','$_POST[ltr_del_id]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan transaction record inserted successfully..');</script>";
		echo "<script>window.location='loantransaction.php';</script>";
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
		Loan Accountant ID
	</div>
	<div class="col-md-9">
		<input type="text" name="lacc_id" id="lacc_id" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Installment ID
	</div>
	<div class="col-md-9">
		<input type="text" name="lins_id" id="lins_id" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Date
	</div>
	<div class="col-md-9">
		<input type="Date" name="ltr_transdt" id="ltr_transdt" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Type
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_transtype" id="ltr_transtype" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction BillNo
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_billno" id="ltr_billno" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Amount
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_amt" id="ltr_amt" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Payment Type
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_paymenttype" id="ltr_paymenttype" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Cheque Number
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_chqno" id="ltr_chqno" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Bank
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_bank" id="ltr_bank" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Note
	</div>
	<div class="col-md-9">
		<textarea name="ltr_note" id="ltr_note" class="form-control"></textarea>
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Status
	</div>
	<div class="col-md-9">
		<select name="ltr_status" id="ltr_status" class="form-control">
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

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Cancellationtype
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_cancellationtype" id="ltr_cancellationtype" class="form-control">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Cancellationreason
	</div>
	<div class="col-md-9">
		<textarea name="ltr_cancellationreason" id="ltr_cancellationreason" class="form-control"></textarea>
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Chequebounce ID
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_chq_bounce_id" id="ltr_chq_bounce_id" class="form-control">
	</div>
</div>	
<br>	

<div class="row">
	<div class="col-md-3" style="padding-top: 4px;">
		Loan Transaction Delete ID
	</div>
	<div class="col-md-9">
		<input type="text" name="ltr_del_id" id="ltr_del_id" class="form-control">
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