<?php
include("header.php");
if(!isset($_SESSION['usr_id']))
{
		echo "<script>window.location='userlogin.php';</script>";
}
?>
    </div>
    <!-- //banner -->


    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container py-lg-5 py-3">
            <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> DASHBOARD</h3>
            <div class="row products_grids text-center mt-5">
                
	
<div class="col-lg-4 col-6 grid4">
	<div class="prodct1">
		<a href="viewloanapplication.php?status=Pending">
			<div class="icon-w3ls f1">
				<span class="fa fa fa-university"></span>
			</div>
			<h4 class="mt-1">Loan Applications - Pending</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM lacc_loanaccount WHERE lacc_status='Pending'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
		
			 records</strong></h4>
		</a>
	</div>
<hr>
		
</div>	

<div class="col-lg-4 col-6 grid4">
	<div class="prodct1">
		<a href="viewloanapplication.php?status=Approved">
			<div class="icon-w3ls f1">
				<span class="fa fa fa-university"></span>
			</div>
			<h4 class="mt-1">Loan Applications - Approved</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM lacc_loanaccount WHERE lacc_status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
		
			 records</strong></h4>
		</a>
	</div>
<hr>
</div>	

<div class="col-lg-4 col-6 grid4">
	<div class="prodct1">
		<a href="viewloanapplication.php?status=Closed">
			<div class="icon-w3ls f1">
				<span class="fa fa fa-university"></span>
			</div>
			<h4 class="mt-1">Loan Applications - Closed</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM lacc_loanaccount WHERE lacc_status='Closed'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
		
			 records</strong></h4>
		</a>
	</div>
<hr>
		
</div>	
				
<div class="col-lg-4 col-6 grid4" style="padding-bottom: 12px;">
	<div class="prodct1">
		<a href="#">
			<div class="icon-w3ls f1">
				<span class="fa fa fa-users"></span>
			</div>
			<h4 class="mt-2"> CUSTOMER</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM cst_customer";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
			 records</strong></h4>
		</a>
	</div>
</div>
		
			

<div class="col-lg-4 col-6 grid4">
	<div class="prodct1">
		<a href="#">
			<div class="icon-w3ls f1">
				<span class="fa  fa-table "></span>
			</div>
			<h4 class="mt-2"> Loan Transaction Report</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM ltr_loantransaction";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
		
			 records</strong></h4>
		</a>
	</div>
</div>			
		
<div class="col-lg-4 col-6 grid4">
	<div class="prodct1">
		<a href="#">
			<div class="icon-w3ls f1">
				<span class="fa fa fa-tasks "></span>
			</div>
			<h4 class="mt-2"> Loan Types</h4>
			<h4 class="mt-2"> <strong>
<?php
$sql = "SELECT * FROM ltyp_loantypes";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?>			
		
			 records</strong></h4>
		</a>
	</div>
</div>	

		
            </div>
        </div>
    </section>
    <!-- //products -->


    <?php
include("footer.php");
?>