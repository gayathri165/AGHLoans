<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM ltr_loantransaction WHERE ltr_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan transaction record deleted successfully...');</script>";
		echo "<script>window.location='viewloantransaction.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$_GET[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
//##########Loan Installment starts here ########
if(isset($_GET['lins_id']))
{
$sqllins_loaninstallment = "SELECT * FROM  lins_loaninstallment WHERE lins_id='$_GET[lins_id]'";
$qsqllins_loaninstallment = mysqli_query($con,$sqllins_loaninstallment);
$rsllins_loaninstallment= mysqli_fetch_array($qsqllins_loaninstallment);
}
//#########Loan Installment starts here ########
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> Profit Loss Report</h3>

	<table class="table table-striped table-bordered">
			<tr>
				<th style="width:20%">Total Loan Paid</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Principal' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Total Interest</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Interest' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Total Legal Case Paid</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Legal Case' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Total Cheque Bounce Paid</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Cheque Bounce' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Other Penalty Amount</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Others' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Total Delay Payment Paid</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Delay Payment' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
			<tr>
				<th style="width:20%">Total Payment Collected</th>
				<td  style="text-align: left;width:30%" ><?php
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE  ltr_transtype='Payment' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				echo moneyFormatIndia($rsloanpmt[0]);
				?></td>
			</tr>
	</table>
	<hr>


        </div>
    </section>
    <!-- //products -->
<hr>
<center><a href="#" class="btn btn-secondary" onclick="printDiv('stats')">Print Profit Loss Report</a>
<hr>
<?php
include("footer.php");
?>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>