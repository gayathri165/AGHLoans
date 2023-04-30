<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE lpf_loanprocessingfee set  lpf_famt='$_POST[lpf_famt]',lpf_tamt='$_POST[lpf_tamt]',lpf_amttype='$_POST[lpf_amttype]',lpf_amt='$_POST[lpf_amt]',lpf_status='$_POST[lpf_status]' WHERE lpf_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Loan processing fee record updated successfully..');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO lpf_loanprocessingfee(lpf_famt,lpf_tamt,lpf_amttype,lpf_amt,lpf_status) values('$_POST[lpf_famt]','$_POST[lpf_tamt]','$_POST[lpf_amttype]','$_POST[lpf_amt]','$_POST[lpf_status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Loan processing fee record inserted successfully..');</script>";
			echo "<script>window.location='loanprocessingfee.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM lpf_loanprocessingfee WHERE lpf_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
			echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
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
                            <center><h3 class="">Loan Processing Fee</h3></center>
                            <p class="mt-2">


<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		From Amount
	</div>
	<div class="col-md-8">
		<input type="text" name="lpf_famt" id="lpf_famt" class="form-control" value="<?php echo $rsedit['lpf_famt']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		To Amount
	</div>
	<div class="col-md-8">
		<input type="text" name="lpf_tamt" id="lpf_tamt" class="form-control" value="<?php echo $rsedit['lpf_tamt']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		Processing fee type
	</div>
	<div class="col-md-8">
		<select name="lpf_amttype" id="lpf_amttype" class="form-control">
			<option value="">Select Processing fee type</option>
			<?php
			$arr = array("Percentage","Flat");
			foreach($arr as $val)
			{
				if($val == $rsedit['lpf_amttype']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
			}
			?>
		</select>
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		Loan Processing charge
	</div>
	<div class="col-md-8">
		<input type="text" name="lpf_amt" id="lpf_amt" class="form-control" value="<?php echo $rsedit['lpf_amt']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-4" style="padding-top: 4px;">
		 Status
	</div>
	<div class="col-md-8">
		<select name="lpf_status" id="lpf_status" class="form-control">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsedit['lpf_status']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
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