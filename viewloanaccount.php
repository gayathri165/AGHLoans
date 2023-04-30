<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM lacc_loanaccount WHERE lacc_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan installment record deleted successfully...');</script>";
		echo "<script>window.location='viewloanaccount.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Loan Account</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Loan Account Number</th>
				<th>Loan Account Customer Number</th>
				<th>Loan Account Date Of Birth</th>
				<th>Loan Account Pan ID </th>
				<th>Loan Account Security Entry</th>
				<th>Loan Account Residential Address</th>
				<th>Loan Account Company Address</th>
				<th>Loan Account Permanent Address </th>
				<th>Loan Account Gender</th>
				<th>Loan Account Martial List</th>
				<th>Loan Account Job Profile</th>
				<th>Loan Account Education</th>
				<th>Loan Account I Have</th>
				<th>Loan Account Bank Account</th>
				<th>Loan Account Loan Amount</th>
				<th>Loan Account Interest Rate</th>
				<th>LOan Account Tenor</th>
				<th>LOan account reference1</th>
				<th>Loan account reference2</th>
				<th>Loan Account guarantee1</th>
				<th>Loan Account guarantee2</th>
				<th>Loan Account open date</th>
				<th>LOan type ID</th>
				<th>LOan type </th>
				<th>LOan processing fee ID</th>
				<th>LOan processing fee Amount type</th>
				<th>LOan Account Interest Processing fee</th>
				<th>Loan Account Remarks</th>
				<th> Department charge</th>
				<th>Loan Account Status</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lacc_loanaccount";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>
						<td>$rs[lacc_no]</td>
						<td>$rs[lacc_custname]</td>
						<td>$rs[lacc_swdof]</td>
						<td>$rs[lacc_dob]</td>
						<td>$rs[lacc_pan]</td>
						<td>$rs[lacc_securityentry]</td>
						<td>$rs[lacc_resaddr]]</td>
						<td>$rs[lacc_compaddr]</td>
						<td>$rs[lacc_permaddr]</td>
						<td>$rs[lacc_gender]</td>
						<td>$rs[lacc_martialst]</td>
						<td>$rs[lacc_jobprofile]</td>
						<td>$rs[lacc_education]</td>
						<td>$rs[lacc_ihave]</td>
						<td>$rs[lacc_bankac]</td>
						<td>$rs[lacc_loanamt]</td>
						<td>$rs[lacc_intrate]</td>
						<td>$rs[lacc_reference1]</td>
						<td>$rs[lacc_reference2]</td>
						<td>$rs[lacc_guarantor1]</td>
						<td>$rs[lacc_guarantor2]</td>
						<td>$rs[lacc_opendt]</td>
						<td>$rs[Ityp_id]</td>
						<td>$rs[Ityp_loantype]</td>
						<td>$rs[Ipf_id]</td>
						<td>$rs[Ipf_amttype]</td>
						<td>$rs[lacc_ipfprocessingfee]</td>
						<td>$rs[lacc_remarks]</td>
						<td>$rs[dpmt_charge]</td>
						<td>$rs[lacc_status]</td>

						<td>Edit | 
						<a href='viewloanaccount.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a></td>
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
function confirmdelete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>