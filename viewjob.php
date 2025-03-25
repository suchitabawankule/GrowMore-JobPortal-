<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM job WHERE job_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Job record deleted successfully..');</script>";
		echo "<script>window.location='viewjob.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
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
			 <h2 class="mr-3 text-black h4">View Job listings...</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>
<?php
if(isset($_SESSION['admin_id']))
{
?>
			<th>Company</th>
<?php
}
?>
			<th style="width: 250px;">Job Title</th>
			<th>Location</th>
			<th>Dates scheduled</th>
			<th style="width: 50px;">Education Qualification</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT job.*,company.company_name,location.location,job_category.job_category FROM job LEFT JOIN company ON job.company_id = company.company_id LEFT JOIN location ON location.location_id = job.location_id LEFT JOIN  job_category ON  job_category.jobcategory_id=job.jobcategory_id WHERE job.status!='' ";
	if(isset($_SESSION['company_id']))
	{
	$sql = $sql . " AND job.company_id='$_SESSION[company_id]'";
	}
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>";
if(isset($_SESSION['admin_id']))
{
		echo "<td>$rs[company_name]</td>";
}
		echo "<td><b>$rs[job_title]</b>
		<br><b>Job Category
		:</b> $rs[job_category]
		</td>
				<td>$rs[location]</td>
				<td>
				<b>Publish date:</b> " . date("d-M-Y",strtotime($rs['publish_date'])) . "<br>
				<b>Last Date:</b>" . date("d-M-Y",strtotime($rs['last_date'])) . "<br>
				<b>Interview From:</b> " . date("d-M-Y",strtotime($rs['interview_fdate'])) . "<br><b>Interview To:</b> " . date("d-M-Y",strtotime($rs['interview_tdate'])) . "</td>
				<td>";
				$edu_qualification = unserialize($rs['edu_qualification']);
				foreach($edu_qualification as $val)
				{
						$sqlcourse ="SELECT * FROM course WHERE course_id='$val'";
						$qsqlcourse = mysqli_query($con,$sqlcourse);
						$rscourse = mysqli_fetch_array($qsqlcourse);
					echo strtoupper($rscourse['course_title']) . "<br>";
				}
				echo "</td>
				<td>$rs[status]</td>
				<td>
				<a href='job.php?editid=$rs[0]' class='btn btn-info' style='width: 75px;' >Edit</a><hr>
				<a href='viewjob.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()' style='width: 75px;'>Delete</a>
				</td>
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