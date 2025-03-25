<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_SESSION['student_id']))
	{
		$sql = "DELETE  FROM computer_skill WHERE student_id='$_SESSION[student_id]'";
		$qsql = mysqli_query($con,$sql);
		
		$basic = mysqli_real_escape_string($con,$_POST['basic']);
		$programming = mysqli_real_escape_string($con,$_POST['programming']);
		$database = mysqli_real_escape_string($con,$_POST['database']);
		$softwares = mysqli_real_escape_string($con,$_POST['softwares']);
		$others = mysqli_real_escape_string($con,$_POST['others']);
		$sql ="INSERT INTO computer_skill(student_id,basic_known,programming,database_skill,software_skill,others) values ('$_SESSION[student_id]','$basic','$programming','$database','$softwares','$others')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Computer skill updated  successfully..');</script>";
			if(isset($_GET['job_id']))
			{
				echo "<script>window.location='displayjobdetails.php?job_id=$_GET[job_id]';</script>";
			}
			else
			{
				echo "<script>window.location='computerskill.php';</script>";
			}
		}
	}
}
?>
<?php
if(isset($_SESSION['student_id']))
{
	$sqledit = "SELECT * FROM computer_skill WHERE student_id='$_SESSION[student_id]'";
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
	
	  <h2 class="mr-3 text-black h3">Computer Skill</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Basic skills: </div>
	<div class="col-md-7"><textarea name="basic" id="basic" class="form-control" ><?php echo $rsedit['basic_known'] ?></textarea><span class="errmsg flash" id="errbasic" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Programming skills: </div>
	<div class="col-md-7"><textarea name="programming" id="programming" class="form-control" ><?php echo $rsedit['programming'] ?></textarea><span class="errmsg flash" id="errprogramming" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Database skills: </div>
	<div class="col-md-7"><textarea name="database" id="database" class="form-control" ><?php echo $rsedit['database_skill'] ?></textarea><span class="errmsg flash" id="errdatabase" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Software skills: </div>
	<div class="col-md-7"><textarea name="softwares" id="softwares" class="form-control" ><?php echo $rsedit['software_skill'] ?></textarea><span class="errmsg flash" id="errsoftwares" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Any Other skills: </div>
	<div class="col-md-7"><textarea name="others" id="others" class="form-control" ><?php echo $rsedit['others'] ?></textarea><span class="errmsg flash" id="errothers" style="color: red;"></span></div>
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
?><script>
function checkerror()
{	
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaAllexp = /^[0-9a-zA-Z,\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";

	if(!document.getElementById("basic").value.match(alphaAllexp))
	{
		document.getElementById("errbasic").innerHTML="Basic Skills not updated..";
		errchk = "True";
	}
	/*
	if(!document.getElementById("programming").value.match(alphaAllexp))
	{
		document.getElementById("errprogramming").innerHTML="Programming details is not valid..";
		errchk = "True";
	}
	if(!document.getElementById("database").value.match(alphaAllexp))
	{
		document.getElementById("errdatabase").innerHTML="Database Skill details is not valid..";
		errchk = "True";
	}
	if(!document.getElementById("softwares").value.match(alphaAllexp))
	{
		document.getElementById("errsoftwares").innerHTML="Software Skill details is not valid..";
		errchk = "True";
	}

	if(!document.getElementById("others").value.match(alphaAllexp))
	{
		document.getElementById("errothers").innerHTML="Other details not valid...";
		errchk = "True";
	}
	*/
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