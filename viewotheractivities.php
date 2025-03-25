<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM other_activities WHERE otheractivity_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Other Activities record deleted successfully..');</script>";
		echo "<script>window.location='viewotheractivities.php';</script>";
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
			 <h2 class="mr-3 text-black h4">View Other Activities records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>

			<th>Activity Title</th>
			<th>Activity detail</th>
			<th>Completed date</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM other_activities WHERE student_id='$_SESSION[student_id]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[activity_title]</td>
			<td>$rs[activity_detail]</td>
			<td>" . date("d-M-Y",strtotime($rs['completed_date'])) ."</td>
			<td><a href='other_activities.php?editid=$rs[0]' class='btn btn-info' >Edit</a>
				 <a href='viewotheractivities.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()'>Delete</a></td>
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