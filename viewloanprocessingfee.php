<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM lpf_loanprocessingfee WHERE lpf_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Loan processing fee record deleted successfully...');</script>";
		echo "<script>window.location='viewloanprocessingfee.php';</script>";
	}
}
?>
    </div>

    <!-- products -->
    <section class="products py-5" id="stats">
        <div class="container">

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Loan Processing Fee</h3>
	
	<table id="example"  class="table table-striped table-bordered">
		<THEAD>
			<tr>
				<th>From Amount</th>
				<th>To Amount</th>
				<th>Processing fee type</th>
				<th>Loan Processing charge</th>
				<th>Status</th>
				<th>Action</th>
			</tr>
		</THEAD>
		<tbody>
			<?php
			$sql = "SELECT * FROM  lpf_loanprocessingfee";
			$qsql = mysqli_query($con,$sql);
			while($rs = mysqli_fetch_array($qsql))
			{
				echo "<tr>
						<td>" . moneyFormatIndia($rs['lpf_famt'])  ."</td>
						<td>" . moneyFormatIndia($rs['lpf_tamt'])  ."</td>
						<td>$rs[lpf_amttype]</td>
						<td>";
						if($rs['lpf_amttype'] == "Percentage")
						{
							echo $rs['lpf_amt'] . "%";
						}
						if($rs['lpf_amttype'] == "Flat")
						{
							echo moneyFormatIndia($rs['lpf_amt']) ;
						}
				echo "</td>
						<td>$rs[lpf_status]</td>
						<td><a href='loanprocessingfee.php?editid=$rs[0]' class='btn btn-info' >Edit</a> |
			<a href='viewloanprocessingfee.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a></td>
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