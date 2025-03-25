<?php
include("header.php");
if(isset($_POST['submit']))
{
	$certification_title = mysqli_real_escape_string($con,$_POST['certification_title']);
	$anyother = mysqli_real_escape_string($con,$_POST['anyother']);
	$role = mysqli_real_escape_string($con,$_POST['role']);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE certification SET certification_title='$certification_title', description='$_POST[description]',work_duration='$_POST[workduration]',role='$role', anyother='$anyother' WHERE certification_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Certification record updated successfully..');</script>";
			echo "<script>window.location='viewcertification.php';</script>";
		}	
	}
	else // else block for innsert statement
	{
		$sql ="INSERT INTO certification(student_id,certification_title, description,work_duration,role, anyother) values ('$_SESSION[student_id]','$certification_title','$_POST[description]','$_POST[workduration]','$_POST[role]','$_POST[anyother]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('certification record inserted successfully..');</script>";
			echo "<script>window.location='viewcertification.php';</script>";
		}
	}
}
//Step 2: Select Statement starts here
if(isset($_GET['editid']))
{
	$sqledit= "SELECT * FROM certification WHERE certification_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2: Select Statement ends here
?>

		<section class="ftco-section bg-light" style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Certification</h2>
	</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Certification Title : </div>
	<div class="col-md-7"><input type="text" name="certification_title" id="certification_title" class="form-control" value="<?php echo $rsedit['certification_title']; ?>" ><span class="errmsg flash" id="errcertification_title" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Certificate Description : </div>
	<div class="col-md-7"><textarea name="description" id="description" class="form-control" ><?php echo $rsedit['description']; ?></textarea></div>
	<div class="col-md-2 p-2"><span class="errmsg flash" id="errdescription" style="color: red;"></span></div>
</div>
<div class="row p-2" >
	<div class="col-md-3 p-2">Work duration: </div>
	<div class="col-md-7">
	<select name="workduration" id="workduration" class="form-control">
		<option value="">Select  Work duration</option>
		<?php
		$arr = array("1-2 Week","1-2 months","3-4 months","6 months","1 year","2-3 years","4-5 years","5 Years","More than 5 years");
		foreach($arr as $val)
		{
			if($val == $rsedit['work_duration'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select><span class="errmsg flash" id="errworkduration" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>



<div class="row p-2" >
	<div class="col-md-3 p-2">Role  : </div>
	<div class="col-md-7"><input type="text" name="role" id="role" class="form-control" value="<?php echo $rsedit['role']; ?>" ><span class="errmsg flash" id="errrole" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Any other  details: </div>
	<div class="col-md-7"><textarea name="anyother" id="anyother" class="form-control" ><?php echo $rsedit['anyother']; ?></textarea><span class="errmsg flash" id="erranyother" style="color: red;"></span></div>
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
	if(!document.getElementById("certification_title").value.match(alphaSpaceExp))
	{
		document.getElementById("errcertification_title").innerHTML="Certification Title is not valid..";
		errchk = "True";
	}
	if(document.getElementById("certification_title").value == "")
	{
		document.getElementById("errcertification_title").innerHTML="Certification Title should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("description").value == "")
	{
		document.getElementById("errdescription").innerHTML="Kindly select the status..";
		errchk = "True";
	}
	if(document.getElementById("workduration").value == "")
	{
		document.getElementById("errworkduration").innerHTML="Kindly select the status..";
		errchk = "True";
	}
	if(!document.getElementById("role").value.match(alphaSpaceExp))
	{
		document.getElementById("errrole").innerHTML="Entered Certification Role is not valid..";
		errchk = "True";
	}
	if(document.getElementById("role").value == "")
	{
		document.getElementById("errrole").innerHTML="Kindly select the status..";
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