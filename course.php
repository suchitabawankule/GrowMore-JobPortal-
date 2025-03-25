<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
	$sql ="UPDATE course SET course_title='$_POST[course_title]',course_description='$_POST[course_description]',status='$_POST[status]' WHERE course_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('course record updated successfully..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
else
{
	$sql ="INSERT INTO course(course_title,course_description,status) values ('$_POST[course_title]','$_POST[course_description]','$_POST[status]')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('course record inserted successfully..');</script>";
		echo "<script>window.location='course.php';</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM course WHERE course_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
?>
		<section class="ftco-section bg-light" style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Course</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Course Title  : </div>
	<div class="col-md-7"><input type="text" name="course_title" id="course_title" class="form-control" value="<?php echo $rsedit['course_title'] ?>"  >
	<label class="errmsg flash" id="errcourse_title" style="color: red;"></label>
	</div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Course Description : </div>
	<div class="col-md-7"><textarea name="course_description" id="course_description" class="form-control" ><?php echo $rsedit['course_description'] ?></textarea></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Status  : </div>
	<div class="col-md-7">
	<select name="status" id="status"  class="form-control" >
		<option value="">Select status</option>
		<?php
		$arr = array("Active","Inactive");
		foreach($arr as $value)
		{
			if($value == $rsedit['status'])
			{
			echo "<option value='$value' selected>$value</option>";
			}
			else
			{
			echo "<option value='$value'>$value</option>";
			}
		}
		?>
	</select>
	<label class="errmsg flash" id="errstatus" style="color: red;"></label>
	</div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2"></div>
	<div class="col-md-7"><input type="submit" class="form-control" name="submit" id="submit" ></div>
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
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('.errmsg').html('');
	var errchk = "False";
	if(!document.getElementById("course_title").value.match(alphaSpaceExp))
	{
		document.getElementById("errcourse_title").innerHTML = "Kindly enter alphabets in Course..";
		errchk = "True";
	}
	if(document.getElementById("course_title").value == "")
	{
		document.getElementById("errcourse_title").innerHTML="Course Title Name Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML="Kindly select the status..";
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