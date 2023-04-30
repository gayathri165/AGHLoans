<?php
include("header.php");
if(isset($_POST['submit']))
{
	$ltyp_icon = rand() . $_FILES['ltyp_icon']['name'];
	move_uploaded_file($_FILES['ltyp_icon']['tmp_name'],"imgloantype/".$ltyp_icon);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE  ltyp_loantypes SET ltyp_loantype='$_POST[ltyp_loantype]'";
		if($_FILES['ltyp_icon']['name'] != "")
		{
		$sql = $sql . ",ltyp_icon='$ltyp_icon'";
		}
		$sql = $sql . ", min_loanamt='$_POST[min_loanamt]',max_loanamt='$_POST[max_loanamt]',ltyp_maxmonth='$_POST[ltyp_maxmonth]',ltyp_interestperc='$_POST[ltyp_interestperc]',ltyp_status='$_POST[ltyp_status]' WHERE ltyp_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Loan type record updated successfully..');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO ltyp_loantypes(ltyp_loantype,ltyp_icon,min_loanamt,max_loanamt,ltyp_maxmonth,ltyp_interestperc,ltyp_status) values('$_POST[ltyp_loantype]','$ltyp_icon','$_POST[min_loanamt]','$_POST[max_loanamt]','$_POST[ltyp_maxmonth]','$_POST[ltyp_interestperc]','$_POST[ltyp_status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Loan type record inserted successfully..');</script>";
			echo "<script>window.location='loantypes.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM ltyp_loantypes WHERE ltyp_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
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
                            <center><h3 class="">Loan Types</h3></center>
                            <p class="mt-2">


<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Loan Type
	</div>
	<div class="col-md-7">
		<input type="text" name="ltyp_loantype" id="ltyp_loantype" class="form-control" value="<?php echo $rsedit['ltyp_loantype']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Icon
	</div>
	<div class="col-md-7">
		<input type="file" name="ltyp_icon" id="ltyp_icon" class="form-control">
		<?php
		if($rsedit['ltyp_icon'] == "")
		{
			
		}
		else if(file_exists("imgloantype/".$rsedit['ltyp_icon']))
		{
			echo "<img src='imgloantype/$rsedit[ltyp_icon]' style='width: 150px;height: 178px;'>";
		}
		?>
	</div>
</div>	

<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Minimum Loan amount
	</div> 
	<div class="col-md-7">
		<input type="number" name="min_loanamt" id="min_loanamt" class="form-control" value="<?php echo $rsedit['min_loanamt']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Maximum Loan amount
	</div>
	<div class="col-md-7">
		<input type="number" name="max_loanamt" id="max_loanamt" class="form-control" value="<?php echo $rsedit['max_loanamt']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Loan Type Maximum Month
	</div>
	<div class="col-md-7">
		<input type="number" name="ltyp_maxmonth" id="ltyp_maxmonth" class="form-control"value="<?php echo $rsedit['ltyp_maxmonth']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Loan Type Interest percentage
	</div>
	<div class="col-md-7">
		<input type="text" name="ltyp_interestperc" id="ltyp_interestperc" class="form-control" value="<?php echo $rsedit['ltyp_interestperc']; ?>">
	</div>
</div>	
<br>

<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Loan Type Status
	</div>
	<div class="col-md-7">
		<select name="ltyp_status" id="ltyp_status" class="form-control">
			<option value="">Select Status</option>
			<?php
			$arr = array("Active","Inactive");
			foreach($arr as $val)
			{
				if($val == $rsedit['ltyp_status']){ echo "<option value='$val' selected>$val</option>"; } else { echo "<option value='$val' >$val</option>"; }
			}
			?>
		</select>
	</div>
</div>				
<br>
			
							</p>
<div class="read-icon">
	<center><input type="submit" name="submit" id="submit" class="btn read" value="submit"></a></center>
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