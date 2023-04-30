<?php
include("header.php");
if(!isset($_SESSION['usr_id']))
{
		echo "<script>window.location='customerlogin.php';</script>";
}
if(isset($_POST['btnsubmit']))
{
	$dt = date("Y-m-d");
	$sqlDELETE = "DELETE from creditscore WHERE cst_id='$_GET[cst_id]'";
	mysqli_query($con,$sqlDELETE);
	$sqlins= "INSERT INTO creditscore(cst_id,last_updated,credit_score) values('$_GET[cst_id]','$dt','$_POST[credit_score]')";
	mysqli_query($con,$sqlins);
	echo "<script>alert('Credit Score updated successfully...');</script>";
}
$sqlcreditscore = "select * from creditscore WHERE cst_id='$_GET[cst_id]'";
$qsqlcreditscore = mysqli_query($con,$sqlcreditscore);
$rscreditscore = mysqli_fetch_array($qsqlcreditscore);
?>
    </div>
<form method="post" action="">
<section class="content-info py-1">
	<div class="container py-md-1">
		<div class="row">
			<div class="col-lg-12 col-md-12 mt-12">
				<div class="thumbnail card">
					<div class="blog-info card-body">
		<h3 class="title-w3ls mb-5 text-center">ENTER CIBIL SCORE</h3>
		
<center>
<?php
if(mysqli_num_rows($qsqlcreditscore) == 0)
{
?>
<b>Enter Credit Score</b>
<input type="number" id="credit_score" name="credit_score" value="300" class="btn btn-warning" min="300"  max="900">
<?php
}
else
{
?>
<b>Enter Credit Score</b>
<input type="number" id="credit_score" name="credit_score" value="<?php echo $rscreditscore['credit_score']; ?>"  class="btn btn-warning"  min="300"  max="900">
<?php
}
?>
<input type="SUBMIT" id="btnsubmit" name="btnsubmit" value="Update"  class="btn btn-success" >
</center>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- //banner-botttom -->
<section class="content-info py-1">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12">
				<div class="thumbnail card">
					<div class="blog-info card-body">
		<h3 class="title-w3ls mb-5 text-center">CIBIL SCORE</h3>
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
<!-- //banner-botttom --><br>
</form>
<?php
include("footer.php");
?>