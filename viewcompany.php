<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM company WHERE company_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Company record deleted successfully..');</script>";
		echo "<script>window.location='viewcompany.php';</script>";
	}
}
?>

		<section class="bg-light" style="padding-top: 15px;">
			<div class="container">

				<div class="row">

<div class="col-md-12 ftco-animate">
		<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

		  <div class="mb-12 mb-md-12 mr-12">
		   <div class="job-post-item-header d-flex align-items-center">
			 <h2 class="mr-3 text-black h4">View Company records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>
			<th>Logo</th>
			<th>Company Name</th>
			<th style="width: 200px;">Address</th>
			<th>Contact Details</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM company";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs['logo'] == "")
		{
			$img = "images/No-Image-Available.png";
		}
		else if(file_exists('filecompany/'.$rs['logo']))
		{
			$img = 'filecompany/'.$rs['logo'];
		}
		else
		{
			$img = "images/No-Image-Available.png";
		}
		echo "<tr>
				<td>
				<img src='$img' width='150' height='100' > 
				</td>
				<td>$rs[company_name]</td>
				<td>$rs[address]</td>
				<td><b>Email ID:</b> $rs[email_id]<br><b>Phone No:</b> $rs[phone_no]</td>
				<td>$rs[status]</td>
				<td style='width: 150px;'> <a href='company.php?editid=$rs[0]' class='btn btn-primary' style='width: 70px;' >More</a> <a href='viewcompany.php?delid=$rs[0]' class='btn btn-secondary' onclick='return confirm2delete()' style='width: 70px;'>Jobs</a>
				<hr>
				<a href='company.php?editid=$rs[0]' class='btn btn-info' style='width: 70px;' >Edit</a> <a href='viewcompany.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()' style='width: 70px;'>Delete</a></td>
			</tr>";
	}
	?>
	</tbody>
</table>

		   </div>
		  </div>
		</div>
</div> <!-- end -->

				</div>
				
			</div>
		</section>
<?php
include("footer.php");
?>
<script>
function confirm2delete()
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