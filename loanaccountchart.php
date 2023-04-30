<?php
include("header.php");
//##########Loan Account starts here ########
$sqllacc_loanaccount = "SELECT lacc_loanaccount.*,cst_customer.* FROM  lacc_loanaccount LEFT JOIN cst_customer on lacc_loanaccount.cst_id=cst_customer.cst_id where lacc_loanaccount.lacc_id='$_GET[lacc_id]' ";
$qsqllacc_loanaccount = mysqli_query($con,$sqllacc_loanaccount);
$rslacc_loanaccount = mysqli_fetch_array($qsqllacc_loanaccount);
//##########Loan Account ends here ########
?>
<?php
$pmtst=0;
$sql = "SELECT * FROM  lins_loaninstallment WHERE lacc_id='$_GET[lacc_id]' ORDER BY lins_no ASC";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	$delaypayment = 0;
	$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
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
	$balamts = $totamt - $rsloanpmt['loanpaid'];
	//################Delay Payment New starts here
	   $date1 = $dt;
	   $dtm= date("Y-m");
	   $date2 = $rs['lins_date'];
	   $curtimestamp1 = strtotime($date1);
	   $curtimestamp2 = strtotime($date2);
	   if ($curtimestamp1 > $curtimestamp2)
	   {
		   if($balamts >= 1)
		   {
			//echo "$date1 is latest than $date2";
			$sqlchkdelaypmt = "select * from ltr_loantransaction WHERE ltr_transtype='Delay Payment' AND lins_id='$rs[lins_id]' AND (ltr_transdt BETWEEN '$dtm-01' AND '$dtm-31')";
			$qsqlchkdelaypmt = mysqli_query($con,$sqlchkdelaypmt);
			if(mysqli_num_rows($qsqlchkdelaypmt) ==0)
			{
				$delaypayment = ($balamts * $rsdelaypaymentpenaltycharge['dpmt_charge']/100)/12;
				$sqlinsdelaypayment = "INSERT INTO ltr_loantransaction(`lacc_id`, `lins_id`, `ltr_transdt`, `ltr_transtype`, `ltr_billno`, `ltr_amt`, `ltr_paymenttype`, `ltr_chqno`, `ltr_bank`, `ltr_note`, `ltr_status`, `ltr_cancellationtype`, `ltr_cancellationreason`, `ltr_chq_bounce_id`, `ltr_del_id`) VALUES('$_GET[lacc_id]', '$rs[lins_id]', '$dt', 'Delay Payment', '0', '$delaypayment', '', '', '', '', 'Active', '', '', '', '')";
				mysqli_query($con,$sqlinsdelaypayment);
				echo mysqli_error($con);
			}
		   }
	   }
	//################Delay Payment New starts here
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
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
				<td style="text-align: left;width:30%"><?php echo $rslacc_loanaccount['cst_address']; ?>, <?php echo $rslacc_loanaccount['cst_state']; ?></td>
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
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$pmtst=0;$pmtst1=0;
			$sql = "SELECT * FROM  lins_loaninstallment WHERE lacc_id='$_GET[lacc_id]' ORDER BY lins_no ASC";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				$sqlloanpenaltytransaction= "SELECT ifnull(SUM(ltr_amt),0) as penaltyamt FROM ltr_loantransaction WHERE lins_id='$rs[lins_id]' AND ltr_transtype IN ('Legal Case','Cheque Bounce','Others') AND ltr_status='Active'";
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
				echo "<td style='text-align: right'>" . moneyFormatIndia($balamts) . "</td>";
						
						echo "<td>";
						if($balamts >=1)
						{
							if($pmtst == 0)
							{
								if(isset($_SESSION['cst_id']))
								{
						echo "<a href='makeloanpayment.php?lacc_id=$_GET[lacc_id]&lins_id=$rs[0]' class='btn btn-success' style='width: 100%;' >Pay</a>";
								}
							$pmtst = 1;
							}
						}
						
						if($balamts >=1)
						{
								if(isset($_SESSION['usr_id']))
								{
						echo "<a href='addpenalty.php?lacc_id=$_GET[lacc_id]&lins_id=$rs[0]' class='btn btn-warning' style='width: 100%;' >Add Penalty</a>";	
if($balamts >=1)
{
	if($pmtst1 == 0)
	{
echo "<a href='makeofflinepayment.php?lacc_id=$_GET[lacc_id]&lins_id=$rs[0]' class='btn btn-success' style='width: 100%;' >Offline Payment</a>";
	$pmtst1 = 1;
	}
}
								}
						}
						echo "<a href='viewloantransaction.php?lacc_id=$_GET[lacc_id]&lins_id=$rs[0]' class='btn btn-info'  style='width: 100%;'>View Transaction</a>";
						echo "</td>";
						
				echo "</tr>";
			}
			?>
		</tbody>
	</table>
			<hr>
	<table  class="table table-striped table-bordered">
		<THEAD>
			<tr>
	<th style="width: 33%;"><centeR><a href="foreclosurechart.php?lacc_id=<?php echo $_GET['lacc_id']; ?>" class="btn btn-dark" target="_blank" >Apply for Foreclosure</a></centeR></th>
	<th style="width: 33%;"><centeR><a href="loanaccountchartprint.php?lacc_id=<?php echo $_GET['lacc_id']; ?>" class="btn btn-primary" target="_blank" >Print Loan Chart</a></centeR></th>
	<th style="width: 34%;"><centeR><a href="viewloantransactionprint.php?lacc_id=<?php echo $_GET['lacc_id']; ?>" class="btn btn-warning" target="_blank" >Print Transaction Report</a></centeR></th>
			</tr>
		</THEAD>
	</table>


        </div>
    </section>
    <!-- //products -->


<?php
include("footer.php");
?>