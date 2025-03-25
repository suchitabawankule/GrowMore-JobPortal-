<?php
include("header.php");
if(isset($_POST['submit']))
{
    if(isset($_GET['editid']))
	{
	$sql ="UPDATE other_activities SET activity_title='$_POST[activity_title]',activity_detail='$_POST[activity_detail]',completed_date='$_POST[completed_date]' WHERE otheractivity_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Other Activities record updated successfully..');</script>";
		echo "<script>window.location='viewotheractivities.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
else
	{
	$sql ="INSERT INTO other_activities(student_id,activity_title,activity_detail,completed_date,status) values ('$_SESSION[student_id]','$_POST[activity_title]','$_POST[activity_detail]','$_POST[completed_date]','Active')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('other activities record inserted successfully..');</script>";
		echo "<script>window.location='viewotheractivities.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
?>
<?php
if(isset($_SESSION['student_id']))
{
	$sqledit = "SELECT * FROM other_activities WHERE otheractivity_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
		<section class="ftco-section bg-light"  style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Other Activities</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Activity Title : </div>
	<div class="col-md-7"><input type="text" name="activity_title" id="activity_title" class="form-control"  value="<?php echo $rsedit['activity_title'] ?>" ><span class="errmsg flash" id="erractivity_title" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Activity Detail: </div>
	<div class="col-md-7"><textarea name="activity_detail" id="activity_detail" class="form-control" ><?php echo $rsedit['activity_detail'] ?></textarea><span class="errmsg flash" id="erractivity_detail" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>



<div class="row p-2" >
	<div class="col-md-3 p-2">Competion Date : </div>
	<div class="col-md-7"><input type="date" name="completed_date" id="completed_date" class="form-control" value="<?php echo $rsedit['completed_date'] ?>" max="<?php echo date("Y-m-d"); ?>" ><span class="errmsg flash" id="errcompleted_date" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2"><input type="submit" class="form-control" name="submit" id="submit" ></div>
	<div class="col-md-7"></div>
	<div class="col-md-3 p-2"></div>
</div>


</div>
</form>
            </div>
          </div><!-- end -->

			</div>

			</div>
		</section>
 
<?php
include("footer.php");
?>
<script>
function checkerror()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z.\s]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	if(!document.getElementById("activity_title").value.match(alphaSpaceExp))
	{
		document.getElementById("erractivity_title").innerHTML="Entered Activity title is not valid..";
		errchk = "True";
	}
	if(document.getElementById("activity_title").value == "")
	{
		document.getElementById("erractivity_title").innerHTML="Activity Title Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("activity_detail").value.match(alphaNumericExp))
	{
		document.getElementById("erractivity_detail").innerHTML="Entered Activity Detail is not valid..";
		errchk = "True";
	}
	if(document.getElementById("activity_detail").value == "")
	{
		document.getElementById("erractivity_detail").innerHTML="Activity Detail Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("completed_date").value == "")
	{
		document.getElementById("errcompleted_date").innerHTML="Completed Date Should not be empty..";
		errchk = "True";
	}
	
	if(errchk == "True")
	{
		return false;
	}
	else
	{
		return true;
	}
}
</script>