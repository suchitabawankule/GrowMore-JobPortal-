<?php
include("header.php");
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM education_qualification WHERE eduqualification_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Education Qualification Skill record deleted successfully..');</script>";
		echo "<script>window.location='vieweducation.php';</script>";
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
			 <h2 class="mr-3 text-black h4">View Education Qualification Skill records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>

			<th>Qualification</th>
			<th>Completion Date</th>
			<th>College</th>
			<th>Percentage</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM education_qualification where student_id='$_SESSION[student_id]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>" .strtoupper($rs['qualification']) ."</td>
			<td>" . date("d-M-Y",strtotime($rs['completion_date'])) ."</td>
			<td>" . ucfirst($rs['college_name']) ."</td>
			<td>$rs[percentage]%</td>
			<td><a href='education_qualification.php?editid=$rs[0]' class='btn btn-info' >Edit</a>
				|  <a href='vieweducation.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()'>Delete</a></td>
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