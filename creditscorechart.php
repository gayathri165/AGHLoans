<?php
include("header.php");
if(!isset($_SESSION['cst_id']))
{
		echo "<script>window.location='customerlogin.php';</script>";
}
$sqlcreditscore = "select * from creditscore WHERE cst_id='$_SESSION[cst_id]'";
$qsqlcreditscore = mysqli_query($con,$sqlcreditscore);
$rscreditscore = mysqli_fetch_array($qsqlcreditscore);
?>
    </div>
<form method="post" action="">
<input type="hidden" id="credit_score" name="credit_score" value="<?php echo $rscreditscore['credit_score']; ?>" > 
<section class="content-info py-5">
	<div class="container py-md-5">
		<h3 class="title-w3ls mb-5 text-center">CIBIL SCORE</h3>
		<div class="row">
			<div class="col-lg-12 col-md-12 mt-12">
				<div class="thumbnail card">
					<div class="blog-info card-body">
<!--  ##################################################################### -->
<!--  ##################################################################### -->
<link rel="stylesheet" href="chartdist/style.css">
<!-- partial:index.partial.html -->
<div id="chart-container"></div>
<!-- partial -->
<script src='https://cdn.fusioncharts.com/fusioncharts/latest/fusioncharts.js'></script>
<script src='https://cdn.fusioncharts.com/fusioncharts/latest/themes/fusioncharts.theme.fusion.js'></script><script  src="chartdist/script.js"></script>
<!--  ##################################################################### -->
<!--  ##################################################################### -->
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //banner-botttom -->
</form>
<?php
include("footer.php");
?>