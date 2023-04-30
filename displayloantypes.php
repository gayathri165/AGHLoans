<?php
include("header.php");
?>
<section class="content-info py-5">
	<div class="container py-md-5">

		<h3 class="title-w3ls mb-5 text-center">Loan Types</h3>
		<div class="row">
		<?php
		$sql = "SELECT * FROM  ltyp_loantypes WHERE ltyp_status	='Active'";
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
			<div class="col-lg-4 col-md-6 mt-4">
				<div class="thumbnail card">
					<div class="position-relative">
						<img src="<?php echo $icon; ?>" style="height: 250px;width: 100%;" class="img-fluid" alt="">
					</div>
					<div class="blog-info card-body">
						<h4 class=""><?php echo $rs['ltyp_loantype']; ?></h4>
						<p class="mt-2">
						<b>- Loan Amount -</b> <?php echo moneyFormatIndia($rs['min_loanamt']); ?> - <?php echo moneyFormatIndia($rs['max_loanamt']); ?><br>
						<b>- maximum Month -</b>  <?php echo $rs['ltyp_maxmonth']; ?> months<br>
						<b>- Interest rate -</b> <?php echo $rs['ltyp_interestperc']; ?>%<br>
						<b>- Delay Payment Charges -</b> <?php echo $rsdelaypaymentpenaltycharge['dpmt_charge']; ?>%  
						</p>
						<div class="read-icon">
							<center><a href="loanapplicationform.php?ltyp_id=<?php echo $rs['ltyp_id']; ?>" class="btn read">Click here to Apply</a></center>
						</div>
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
<?php
include("footer.php");
?>