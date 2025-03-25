<?php
include("header.php");
if(isset($_POST['submit']))
{
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE education_qualification SET qualification='$_POST[qualification]',completion_date='$_POST[completion_date]',college_name='$_POST[college_name]',percentage='$_POST[percentage]',status='$_POST[status]' WHERE eduqualification_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Education qualification record updated successfully..');</script>";
			echo "<script>window.location='vieweducation.php';</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
	else
	{
		$sql ="INSERT INTO education_qualification(student_id,qualification,completion_date,college_name,percentage,status) values ('$_SESSION[student_id]','$_POST[qualification]','$_POST[completion_date]','$_POST[college_name]','$_POST[percentage]','Active')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Education qualification record inserted successfully..');</script>";
			echo "<script>window.location='vieweducation.php';</script>";
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
	$sqledit = "SELECT * FROM education_qualification WHERE eduqualification_id='$_GET[editid]'";
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
	  <h2 class="mr-3 text-black h3">Education Qualification</h2>
	</div>
<hr>
<div class="row p-2" >
	<div class="col-md-3 p-2">Qualification : </div>
	<div class="col-md-7"><input type="text" name="qualification" id="qualification" class="form-control" value="<?php echo strtoupper($rsedit['qualification']) ?>" ><span class="errmsg flash" id="errqualification" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Completion Date : </div>
	<div class="col-md-7"><input type="date" name="completion_date" id="completion_date" class="form-control" value="<?php echo $rsedit['completion_date'] ?>" max="<?php echo date("Y-m-d"); ?>" ><span class="errmsg flash" id="errcompletion_date" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">College name: </div>
	<div class="col-md-7"><input type="text" name="college_name" id="college_name" class="form-control" value="<?php echo $rsedit['college_name'] ?>"><span class="errmsg flash" id="errcollege_name" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Percentage: </div>
	<div class="col-md-7"><input type="text" name="percentage" id="percentage" class="form-control" value="<?php echo $rsedit['percentage'] ?>" ><span class="errmsg flash" id="errpercentage" style="color: red;"></span></div>
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
	
	var numericExp = /^[0-9.]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z.\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
   
	$('.errmsg').html('');
	var errchk = "False";

	if(!document.getElementById("qualification").value.match(alphaSpaceExp))
	{
		document.getElementById("errqualification").innerHTML="Qualification detail is not valid..";
		errchk = "True";
	}
	if(document.getElementById("qualification").value == "")
	{
		document.getElementById("errqualification").innerHTML="Qualification should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("completion_date").value == "")
	{
		document.getElementById("errcompletion_date").innerHTML="Completion Date should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("college_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errcollege_name").innerHTML="Entered College name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("college_name").value == "")
	{
		document.getElementById("errcollege_name").innerHTML="College Name should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("percentage").value.match(numericExp))
	{
		document.getElementById("errpercentage").innerHTML="Entered percentage is not valid..";
		errchk = "True";
	}
	if(document.getElementById("percentage").value == "")
	{
		document.getElementById("errpercentage").innerHTML="percentage should not be empty..";
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