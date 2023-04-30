<?php
include("header.php");
if(isset($_GET["delid"]))
{
	$sql = "DELETE FROM lins_loaninstallment WHERE lins_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan installment record deleted successfully...');</script>";
		echo "<script>window.location='viewloaninstallment.php';</script>";
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

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Loan Installment</h3>
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>Loan Account Id</th>
				<th>Loan Installment Id</th>
				<th>Loan Transaction Date</th>
				<th>Loan Installment amount</th>
				<th>Loan Installment percentage</th>
				<th>Loan Installment amount</th>
				<th>Loan Installment cheque No.</th>
				<th>Loan note </th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lins_loaninstallment";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>
						<td>$rs[lacc_id]</td>
						<td>$rs[lins_no]</td>
						<td>$rs[lins_date]</td>
						<td>$rs[lins_amt]</td>
						<td>$rs[lins_iperc]</td>
						<td>$rs[lins_iamt]</td>
						<td>$rs[lins_chqno]</td>
						<td>$rs[lins_note]</td>
						<td>$rs[lins_status]</td>
						<td>Edit | <a href='viewloaninstallment.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a></td>
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