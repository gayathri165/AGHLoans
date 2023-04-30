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

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Loan Transaction</h3>
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
//##########Loan Installment starts here ########
if(isset($_GET['lins_id']))
{
?>
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
			$sql = "SELECT * FROM  lins_loaninstallment WHERE lins_id='$_GET[lins_id]'";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
				$qsqlloanpenaltytransaction = mysqli_query($con,$sqlloanpenaltytransaction);
				$rsloanpenaltytransaction = mysqli_fetch_array($qsqlloanpenaltytransaction);
				$sqlloandelaypmttrans= "SELECT ifnull(SUM(ltr_amt),0) as interstamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype='Penalty' AND ltr_status='Active'";
				$qsqlloandelaypmttrans = mysqli_query($con,$sqlloandelaypmttrans);
				$rsloandelaypmttransaction = mysqli_fetch_array($qsqlloandelaypmttrans);
				$sqlloanpmt= "SELECT ifnull(SUM(ltr_amt),0) as loanpaid FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND (ltr_transtype='Payment') AND ltr_status='Active'";
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
				echo "<td style='text-align: right'>" . moneyFormatIndia($balamts) . "</td></tr>";
			}
			?>
		</tbody>
	</table>
	<hr>
<?php
}
?>
	<table  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th style="width: 100px;">Acknowledgement No.</th>
				<th>Transaction Date</th>
				<th>Transaction Type</th>
				<th style='text-align: right;'>Charges</th>
				<th style='text-align: right;'>Payments</th>
				<th style='text-align: right;'>Balance</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  ltr_loantransaction where ltr_loantransaction.ltr_id!=0 AND lacc_id='$_GET[lacc_id]' ";
			if(isset($_GET['lins_id']))
			{
				$sql = $sql . " AND ltr_loantransaction.lins_id='$_GET[lins_id]' ";
			}
			$sql = $sql . " ORDER BY ltr_loantransaction.ltr_id,ltr_loantransaction.ltr_transdt ASC";
			$qsql = mysqli_query($con,$sql);
			$itamt = 0;
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>";
				if($rs['ltr_transtype'] == "Payment")
				{
					echo "<td>$rs[ltr_billno]</td>";
				}
				else
				{
					echo "<td>$rs[0]</td>";
				}
					
				echo "<td>" . date("d-M-Y",strtotime($rs['ltr_transdt'])) . "</td><td>$rs[ltr_transtype]</td>";						
				echo "<td style='text-align: right;'>";
				if($rs['ltr_transtype'] == "Principal" || $rs['ltr_transtype'] == "Interest" || $rs['ltr_transtype'] == "Legal Case" || $rs['ltr_transtype'] == "Cheque Bounce" || $rs['ltr_transtype'] == "Others" || $rs['ltr_transtype'] == "Delay Payment")
				{
					$itamt = $itamt + $rs['ltr_amt'];
					echo moneyFormatIndia($rs['ltr_amt']);
				}
				echo "</td>";				
				echo "<td style='text-align: right;'>";
				if($rs['ltr_transtype'] == "Payment" || $rs['ltr_transtype'] == 'Foreclosure')
				{
					$itamt = $itamt - $rs['ltr_amt'];
					echo moneyFormatIndia($rs['ltr_amt']);
					if($rs['ltr_transtype'] == "Foreclosure")
					{
						$foreclosure = "Foreclosure Interest Deduction";
						$foreclosurebillno = $rs['ltr_billno'];
						$foreclosuredt = $rs['ltr_transdt'];
						$foreclosureamt = -1 * abs($itamt);
					}
				}
				echo "</td>";
				echo "<td style='text-align: right;'>" . moneyFormatIndia($itamt) . "</td>";
				echo "<td>";
				if($rs['ltr_transtype'] == "Payment" || $rs['ltr_transtype'] == 'Foreclosure')
				{
				echo "<a href='loanpaymentreceipt.php?insid=$rs[0]' target='_blank' class='btn btn-primary' >View</a>";
				}
				echo "</td>	</tr>";
			}
			if($foreclosure == "Foreclosure Interest Deduction")
			{
				/*
						$foreclosure = "Foreclosure Interest Deductin";
						$foreclosuredt = $rs['ltr_transdt'];
						$foreclosureamt = -1 * abs($itamt);	
				*/
				$itamt = $itamt + $foreclosureamt;
echo "<tr>
		<td>" . $foreclosurebillno . "</td>
		<td>" . $foreclosuredt . "</td>
		<td>" . $foreclosure . "</td>
		<td style='text-align: right;'>" . moneyFormatIndia($foreclosureamt) ."</td>
		<td style='text-align: right;'></td>
		<td style='text-align: right;'>" . moneyFormatIndia($itamt). "</td>
		<td></td>
	</tr>";						
			}
			?>
		</tbody>
	</table>
<hr>
<?php
if(isset($_GET['lins_id']))
{
?>
<center><a href="viewloantransactionprint.php?lacc_id=<?php echo $_GET['lacc_id']; ?>&lins_id=<?php echo $_GET['lins_id']; ?>" class="btn btn-secondary" target="_blank">Print Transaction Report</a>
<?php
}
else
{
?>
<center><a href="viewloantransactionprint.php?lacc_id=<?php echo $_GET['lacc_id']; ?>" target="_blank" class="btn btn-secondary">Print Transaction Report</a>
<?php
}
?>
        </div>
    </section>
    <!-- //products -->


<?php
include("footer.php");
?>