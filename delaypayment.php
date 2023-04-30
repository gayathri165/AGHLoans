<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql = "DELETE FROM dpmt_delaypayment";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	$sql ="INSERT INTO dpmt_delaypayment values('','$_POST[dpmt_charge]','Active')";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Delay payment record updated successfully..');</script>";
		echo "<script>window.location='delaypayment.php';</script>";
	}
}

$sqledit = "SELECT * FROM dpmt_delaypayment ";
$qsqledit = mysqli_query($con,$sqledit);
		echo mysqli_error($con);
$rsedit = mysqli_fetch_array($qsqledit);
?>
    <section class="content-info py-5">
        <div class="container py-md-5">

<form method="post" action="">
            <div class="row">
                <div class="col-lg-2 col-md-2 mt-2"></div>
                <div class="col-lg-8 col-md-8 mt-8">
                    <div class="thumbnail card">
                        <div class="blog-info card-body">
                            <center><h3 class="">Delay Payment
							</h3></center>
                            <p class="mt-2">


<div class="row">
	<div class="col-md-5" style="padding-top: 4px;">
		Delay Payment Charge (in %)
	</div>
	<div class="col-md-7">
		<input type="text" name="dpmt_charge" id="dpmt_charge" class="form-control" value="<?php echo $rsedit['dpmt_charge']; ?>">
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