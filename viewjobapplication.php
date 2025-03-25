<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM job_application WHERE jobapplication_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Job Application record deleted successfully..');</script>";
		echo "<script>window.location='viewjobapplication.php';</script>";
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
			 <h2 class="mr-3 text-black h4">View Job Application records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>
			<th>User</th>
			<th>Job detail</th>
			<th>Applied date</th>
			<th>Application status</th>
			<th>Status</th>
			<th>Action</th>
		
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT job_application.*, student.student_name, student.register_number, job.job_title FROM job_application LEFT JOIN student ON student.student_id=job_application.student_id LEFT JOIN job ON job.job_id=job_application.job_id WHERE job_application.jobapplication_id != '0'";
	if(isset($_GET['status']))
	{
		$sql = $sql . " AND job_application.status='$_GET[status]'";
	}
	if(isset($_SESSION['company_id']))
	{
		$sql = $sql . " AND job.company_id='$_SESSION[company_id]'";
	}
	if(isset($_SESSION['student_id']))
	{
		$sql = $sql . " AND job_application.student_id='$_SESSION[student_id]'";
	}
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
				<td>$rs[student_name] ($rs[register_number])</td>
				<td>$rs[job_title]</td>
				<td>$rs[applied_date]</td>
				<td>$rs[application_status]</td>
				<td>$rs[status]</td>
			<td>";
			
	if(!isset($_SESSION['student_id']))
	{
		echo "<a href='job_application.php?editid=$rs[0]' class='btn btn-info' >Edit</a>  | ";
	}
		echo " <a href='viewjobapplication.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()'>Delete</a></td>
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