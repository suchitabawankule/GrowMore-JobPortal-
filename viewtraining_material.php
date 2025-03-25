<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['delid']))
{
	$sql = "DELETE  FROM training_material WHERE trainingmaterial_id='$_GET[delid]'";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Training Material record deleted successfully..');</script>";
		echo "<script>window.location='viewtraining_material.php?material_type=" . $_GET['material_type'] . "';</script>";
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
			 <h2 class="mr-3 text-black h4">View Training Material records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>
			<th>Banner</th>
			<th>Training Material Title</th>
			<th>Material type</th>
			<th>Status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM training_material WHERE material_type='$_GET[material_type]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{		
		if($rs['banner_img'] == "")
		  {
			$img =  "<img src='images/No-Image-Available.png' style='width: 155px;height: 100px;'>";
		  }
		else if(!file_exists("img_trainingmaterial/". $rs['banner_img']))
		  {
			$img =  "<img src='images/No-Image-Available.png' style='width: 155px;height: 100px;'>";
		  }
		else
		  {
			$img =  "<img src='img_trainingmaterial/$rs[banner_img]' style='width: 155px;height: 100px;'>";
		  }
		echo "<tr>
			<td>$img</td>
			<td><b style='color: black;'>$rs[title]</b><br>";
		echo substr(strip_tags($rs['description']), 0, 180) . "....";
		echo "</td>
			<td>$rs[material_type]</td><td>";
			if($rs['status'] == "Publish")
			{
				echo "Published";
			}
		echo "</td>
			<td>
				<a href='training_material.php?editid=$rs[0]&material_type=$_GET[material_type]' class='btn btn-info' style='width: 100px;' >Edit</a><br>
				
				<a href='viewtraining_material.php?delid=$rs[0]&material_type=$_GET[material_type]' class='btn btn-danger' style='width: 100px;' onclick='return confirm2delete()'>Delete</a><br>
				
				<a href='displaytrainingmaterialdetailed.php?trainingmaterial_id=$rs[0]&material_type=$rs[material_type]&presentationtype=$rs[presentationtype]' style='width: 100px;' class='btn btn-primary' target='_blank'>View</a>
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