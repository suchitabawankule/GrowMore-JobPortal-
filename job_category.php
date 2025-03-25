<?php
//This page created to store job categories.
include("header.php"); //This will include header.php code
if(!isset($_SESSION['admin_id'])) //If admin is not logged in then this page will redirect to main page. Main page of the website is index.php
{
	echo "<script>window.location='index.php';</script>"; //This code will redirect to index page
}
//Coding to check whether the statement has update or insert starts here
if(isset($_POST['submit'])) //If statement executes if user clicks submit button
{
	if(isset($_GET['editid'])) 
	{
		//Update Job category statement starts here
		$sql ="UPDATE job_category SET job_category='$_POST[job_category]',note='$_POST[note]',status='$_POST[status]' WHERE jobcategory_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('job category record updated successfully..');</script>";
			
		}
		else
		{
			echo mysqli_error($con);
		}
		//Update Job category statement ends here
	}
	else
	{
		//INSERT Job category statement starts here
		$sql ="INSERT INTO job_category(job_category,note,status) values ('$_POST[job_category]','$_POST[note]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('job category record inserted successfully..');</script>";
			echo "<script>window.location='job_category.php';</script>";
			
		}
		else
		{
			echo mysqli_error($con);
		}
		//INSERT Job category statement ends here
	}
}
//Coding to check whether the statement has update or insert ends here
?>
<?php
if(isset($_GET['editid']))
{
	//This is the step 2 statement for update statement. Before updating record user needs to select and display the record.
	$sqledit = "SELECT * FROM job_category WHERE jobcategory_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit); //mysqli_query function executes job category select statement.
	echo mysqli_error($con); // mysqli_error function will display error message
	$rsedit = mysqli_fetch_array($qsqledit); //mysqli_fetch_array function will fetch record in array format and stores in $rsedit variable.
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
	  <h2 class="mr-3 text-black h3">Job category</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Job category: </div>
	<div class="col-md-7"><input type="text" name="job_category" id="job_category" class="form-control"  value="<?php echo $rsedit['job_category'] ?>" >
		<label class="errmsg flash" id="errjob_category" style="color: red;"></label>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Note : </div>
	<div class="col-md-7"><textarea name="note" id="note" class="form-control" ><?php echo $rsedit['note'] ?></textarea></div>
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
//This is the validation code starts here
function checkerror()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	$('.errmsg').html('');
	var errchk = "False";
	if(!document.getElementById("job_category").value.match(alphaSpaceExp))
	{
		document.getElementById("errjob_category").innerHTML = "Kindly enter alphabets in Job Category..";
		errchk = "True";
	}
	//If job category is not selected then the error message will display in errjob_category
	if(document.getElementById("job_category").value == "")
	{
		document.getElementById("errjob_category").innerHTML="Job Category Name Should not be empty..";
		errchk = "True";
	}
	//If the status is empty then the status displays error message
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML="Kindly select the status..";
		errchk = "True";
	}
	//If the condition is true then page will not submit. if the condition is false then it allows to submit form.
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