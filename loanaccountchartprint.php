<?php
include("header.php");
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$_GET[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="printarea">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> Loan Account Chart</h3>
	<table class="table table-striped table-bordered">
			<tr>
			<?php
			if($rslacc_loanaccount['comp_name'] != "")
			{
			?>
				<th>Company Name.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['comp_name']; ?></td>
			<?php
			}
			else
			{
			?>
				<th>Customer Name.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_custname']; ?></td>
			<?php
			}
			?>
				<th>PAN Card No. </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['cst_pan']; ?></td>
			</tr>
			<tr>
				<th style="width:20%">Address</th>
				<td style="text-align: left;width:30%"><?php echo $rslacc_loanaccount['cst_address']; ?>, <?php echo $rslacc_loanaccount['cst_state']; ?><br>Contact No. <?php echo $rslacc_loanaccount['cst_contact']; ?><br>Email ID. <?php echo $rslacc_loanaccount['cst_email']; ?></td>
				<th style="width:20%">Bank Account</th>
				<td  style="text-align: left;width:30%"><?php $arrbankdet =  unserialize($rslacc_loanaccount['cst_bankdetail']); ?>
				<b>Bank Name:</b> <?php echo $arrbankdet[0]; ?><br>
				<b>Bank A/c:</b> <?php echo $arrbankdet[1]; ?><br>
				<b>IFSC Code:</b> <?php echo $arrbankdet[2]; ?><br>
				</td>
			</tr>
			<tr>
				<th>Email ID.</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['cst_email']; ?></td>
				<th>Contact No. </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['cst_contact']; ?></td>
			</tr>
	</table>
	<hr>
	<table class="table table-striped table-bordered">
			<tr>
				<th style="width:20%">Loan Account No.</th>
				<td  style="text-align: left;width:30%" ><?php echo $rslacc_loanaccount['lacc_no']; ?></td>
				<th style="width:20%">Account Opened Date</th>
				<td  style="text-align: left;width:30%" ><?php echo date("d-M-Y",strtotime($rslacc_loanaccount['lacc_opendt'])); ?></td>
			</tr>
			<tr>
				<th>Loan Amount</th>
				<td style="text-align: left;"><?php echo moneyFormatIndia($rslacc_loanaccount['lacc_loanamt']); ?></td>
				<th>Interest </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_intrate']; ?>%</td>
			</tr>
			<tr>
				<th>Tenor</th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['lacc_tenor']; ?> months</td>
				<th>Loan Type </th>
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['ltyp_loantyp']; ?></td>
			</tr>
			<tr>
				<th>Processing Charge</th>
				<td style="text-align: left;"><?php echo moneyFormatIndia($rslacc_loanaccount['lacc_ipfprocessingfee']); ?></td>
				<th>Delay Payment Charge</th>
				<td style="text-align: left;"><?php echo moneyFormatIndia($rslacc_loanaccount['dpmt_charge']); ?>%</td>
			</tr>
	</table>
	<hr>
	<table  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Installment No.</th>
				<th style="width: 130px;">EMI Date</th>
				<th style='text-align: right'>Principal Amount</th>
				<th style='text-align: right'>Interest amount</th>
				<th style='text-align: right'>Delay Payment Charges</th>
				<th style='text-align: right'>Penalty amount</th>
				<th style='text-align: right'>Total amount</th>
				<th style='text-align: right'>Paid Amount</th>
				<th style='text-align: right'>Balance Amount</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lins_loaninstallment ORDER BY lins_no ASC";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND  ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
				$qsqlloanpenaltytransaction = mysqli_query($con,$sqlloanpenaltytransaction);
				$rsloanpenaltytransaction = mysqli_fetch_array($qsqlloanpenaltytransaction);
				$sqlloandelaypmttrans= "SELECT ifnull(SUM(ltr_amt),0) as interstamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Delay Payment' AND ltr_status='Active'";
				$qsqlloandelaypmttrans = mysqli_query($con,$sqlloandelaypmttrans);
				$rsloandelaypmttransaction = mysqli_fetch_array($qsqlloandelaypmttrans);
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Payment' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				$totamt = 0;
				$totamt = $rs['lins_amt'] + $rs['lins_iamt'] + $rsloandelaypmttransaction['interstamt'] + $rsloanpenaltytransaction['penaltyamt'];
				echo "<tr>
						<td>$rs[lins_no]</td>
						<td>". date("d-M-Y",strtotime($rs['lins_date'])) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($rs['lins_amt']) ."</td>
						<td style='text-align: right'>" . moneyFormatIndia($rs['lins_iamt']) ."</td>
						<td style='text-align: right'>". moneyFormatIndia($rsloandelaypmttransaction['interstamt']) ."</td>
						<td style='text-align: right'>" . moneyFormatIndia($rsloanpenaltytransaction['penaltyamt']) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($totamt) . "</td>
						<td style='text-align: right'>" . moneyFormatIndia($rsloanpmt['loanpaid']) . "</td>";
						$balamts = $totamt - $rsloanpmt['loanpaid'];
				echo "<td style='text-align: right'>" . moneyFormatIndia($balamts) . "</td>
					</tr>";
			}
			?>
		</tbody>
	</table>
	
        </div>
    </section>
    <!-- //products -->


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
printDiv("printarea");
</script>