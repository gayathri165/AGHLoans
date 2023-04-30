<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE FROM usr_user WHERE usr_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('User record deleted successfully...');</script>";
		echo "<script>window.location='viewuser.php';</script>";
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

 <h3 class="title-w3ls mb-sm-5 mb-4 text-center"> View Employees</h3>
			
<table id="example" class="table table-striped table-bordered">
        <thead>
            <tr>
			<th>User Name</th>
			<th>Login ID</th>
			<th>Contact No.</th>
			<th>Email ID</th>
			<th>Status</th>
			<th>Action</th>
            </tr>
        </thead>
        <tbody>
<?php
$sql = "SELECT * FROM usr_user";
$qsql = mysqli_query($con,$sql);
while($rs = mysqli_fetch_array($qsql))
{
	echo "<tr>
			<td>$rs[usr_name]</td>
			<td>$rs[usr_login_id]</td>
			<td>$rs[usr_contact]</td>
			<td>$rs[usr_emailid]</td>
			<td>$rs[usr_status]</td>
			<td><a href='user.php?editid=$rs[0]' class='btn btn-info' >Edit</a> | <a href='viewuser.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirmdelete()' >Delete</a>
						
						</td>
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