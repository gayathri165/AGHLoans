<?php
include("header.php");
//##########Loan transaction starts here ########
$sqlltr_loantransaction = "SELECT * FROM  ltr_loantransaction WHERE ltr_id='$_GET[insid]'";
$qsqlltr_loantransaction = mysqli_query($con,$sqlltr_loantransaction);
$rsltr_loantransaction = mysqli_fetch_array($qsqlltr_loantransaction);
//##########Loan transaction ends here ########
//##########Loan Installment starts here ########
$sqllins_loaninstallment = "SELECT * FROM  lins_loaninstallment WHERE lins_id='$rsltr_loantransaction[lins_id]'";
$qsqllins_loaninstallment = mysqli_query($con,$sqllins_loaninstallment);
$rsllins_loaninstallment= mysqli_fetch_array($qsqllins_loaninstallment);
//##########Loan Installment ends here ########
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$rsltr_loantransaction[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
?>
    </div>
<form method="post" action="" onsubmit="return validateform()" >
    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> Loan Payment Receipt</h3>
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
				<td style="text-align: left;"><?php echo $rslacc_loanaccount['dpmt_charge']; ?>%</td>
			</tr>
	</table>
	<hr>
<?php
/*
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
			$pmtst=0;
			$sql = "SELECT * FROM  lins_loaninstallment WHERE lins_id='$rsltr_loantransaction[lins_id]'";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Penalty' AND ltr_status='Active'";
				$qsqlloanpenaltytransaction = mysqli_query($con,$sqlloanpenaltytransaction);
				$rsloanpenaltytransaction = mysqli_fetch_array($qsqlloanpenaltytransaction);
				$sqlloandelaypmttrans= "SELECT ifnull(SUM(ltr_amt),0) as interstamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Delay Payment' AND ltr_status='Active'";
				$qsqlloandelaypmttrans = mysqli_query($con,$sqlloandelaypmttrans);
				$rsloandelaypmttransaction = mysqli_fetch_array($qsqlloandelaypmttrans);
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Payment' AND ltr_status='Active'";
				$qsqlloanpmt = mysqli_query($con,$sqlloanpmt);
				$rsloanpmt = mysqli_fetch_array($qsqlloanpmt);
				$totamt = 0;
				$totamt = $rs['lins_amt'] + $rs['lins_iamt'];
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
				echo "<td style='text-align: right'>" . moneyFormatIndia($balamts) . "</td></tr>";
			}
			?>
		</tbody>
	</table>
*/
?>
			<hr>
	<table class="table table-striped table-bordered">
			<tr>
				<th style="text-align: left;width: 20%;">Receipt No.</th>
				<td style="text-align: left;width: 30%;"><?php echo $rsltr_loantransaction['ltr_billno']; ?></td>
				<th style="text-align: left;width: 20%;">Paid Date</th>
				<td style="text-align: left;width: 30%;"><?php echo date("d-M-Y",strtotime($rsltr_loantransaction['ltr_transdt'])); ?></td>
			</tr>
			<tr>
				<th>Installment No.</th>
				<td style="text-align: left;"><?php 
				echo $rsllins_loaninstallment['lins_no']; 
				?></td>
				<th>Installment Date</th>
				<td style="text-align: left;"><?php echo date("d-M-Y",strtotime($rsllins_loaninstallment['lins_date'])); ?></td>
			</tr>
			<tr>
				<th style="color: red;">Paid Amount</th>
				<td style="text-align: left;color: red;"><?php echo moneyFormatIndia($rsltr_loantransaction['ltr_amt']); ?></td>
				<th>Payment Type</th>
				<td style="text-align: left;"><?php echo $rsltr_loantransaction['ltr_paymenttype']; ?></td>
			</tr>
	</table>
			<?php
			if(isset($_SESSION['usr_id']))
			{
				if($rsltr_loantransaction['ltr_paymenttype'] == "Cash")
				{
			?>
			<table class="table table-striped table-bordered">
				<tr>
					<th style="width: 150px;">Particulars</th>
					<td><?php echo $rsltr_loantransaction['ltr_note']; ?></td>				
				</tr>
			</table>
			<?php
				}
				else if($rsltr_loantransaction['ltr_paymenttype'] == "Cheque")
				{
			?>
			<table class="table table-striped table-bordered">
				<tr>
					<th>Particulars</th>
					<td  colspan="3"><?php echo $rsltr_loantransaction['ltr_note']; ?></td>
				</tr>
				<tr>
					<th>Cheque No.</th>
					<td><?php echo $rsltr_loantransaction['ltr_chqno']; ?></td>
					<th>Bank Detail</th>
					<td><?php echo $rsltr_loantransaction['ltr_bank']; ?></td>
				</tr>
			</table>
			<?php
				}
			}
			?>
        </div>
    </section>
    <!-- //products -->
			<hr>
	<table class="table table-striped table-bordered">
			<tr>
				<th colspan="4"><center><a onclick="return printme('stats');" class="form-control btn btn-primary" name="submit" id="submit" style="width: 325px;height: 50px;font-size: 25px;color: white;" >Click here to Print</a></center></th>
			</tr>
	</table>
</form>
<?php
include("footer.php");
?>
<script>
function printme(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>