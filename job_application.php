<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sql ="UPDATE job_application SET application_status='$_POST[application_status]',status='$_POST[status]' WHERE jobapplication_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Job application record updated successfully..');</script>";
	}
	else
	{
		echo mysqli_error($con);
	}
}	
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT job_application.*, student.student_name, student.register_number, job.job_title FROM job_application LEFT JOIN student ON student.student_id=job_application.student_id LEFT JOIN job ON job.job_id=job_application.job_id WHERE job_application.jobapplication_id='$_GET[editid]'";
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
	  <h2 class="mr-3 text-black h3">Job application</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">User : </div>
	<div class="col-md-7"><input type="hidden" name="student_id" id="student_id" class="form-control" value="<?php echo $rsedit['student_id'] ?>" readonly >
	<?php echo $rsedit['student_name'] ?> (<?php echo $rsedit['register_number'] ?>)
	
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Job : </div>
	<div class="col-md-7"><?php echo $rsedit['job_title'] ?></div>
</div>



<div class="row p-2" >
	<div class="col-md-3 p-2">Applied  Date : </div>
	<div class="col-md-7"><input type="date" name="applied_date" id="applied_date" class="form-control btn-info" value="<?php echo $rsedit['applied_date'] ?>" readonly  ></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Application status: </div>
	<div class="col-md-7"><textarea name="application_status" id="application_status" class="form-control" ><?php echo $rsedit['application_status'] ?></textarea></div>
	<div class="col-md-2 p-2"></div>
</div>



<div class="row p-2" >
	<div class="col-md-3 p-2">Status  : </div>
	<div class="col-md-7">
	<select name="status" id="status"  class="form-control" >
		<option value="">Select status</option>
		<?php
		$arr = array("Selected","Rejected");
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
	if(document.getElementById("applied_date").value == "")
	{
		document.getElementById("errapplied_date").innerHTML="Applied Date Should not be empty..";
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