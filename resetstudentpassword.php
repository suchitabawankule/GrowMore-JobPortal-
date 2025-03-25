<?php
include("header.php");
if($_GET['resetcode'] != $_SESSION['studentreset'])
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{ 
	$sqlupd= "UPDATE student SET password='$_POST[password]' WHERE student_id='$_POST[student_id]'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated  successfully..');</script>";
		echo "<script>window.location='index.php';</script>";
	}
	else
	{
		echo "<script>alert('Entered old password is not valid..');</script>";
	}
}
?>
		<section class="ftco-section bg-light">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<input type="hidden" name="student_id" id="student_id" value="<?php echo $_GET['studentid']; ?>">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Student - Change Password</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">New Password  : </div>
	<div class="col-md-7"><input type="password" name="password" id="password" class="form-control" ></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Confirm Password  : </div>
	<div class="col-md-7"><input type="password" name="cpassword" id="cpassword" class="form-control" ></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-12 p-2"><center><input type="submit" class="form-control" name="submit" id="submit" value="Change Password" style="width: 250px;"></center></div>
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
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="The password field  must contain atleast 8 character..";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value == "")
	{
		document.getElementById("errcpassword").innerHTML="Invalid password..";
		errchk = "True";
	}
	
	if(document.getElementById("cpassword").value != document.getElementById("password").value)
	{
		document.getElementById("errcpassword").innerHTML="Password and Confirm password not matching..";
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