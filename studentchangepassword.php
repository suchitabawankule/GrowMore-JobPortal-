<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sqlupd= "UPDATE student SET password='$_POST[password]' WHERE student_id='$_SESSION[student_id]' AND password='$_POST[opassword]'";
	$qsqlupd = mysqli_query($con,$sqlupd);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Password updated  successfully..');</script>";
		echo "<script>window.location='studentchangepassword.php';</script>";
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
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">User - Change Password</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Old Password  : </div>
	<div class="col-md-7"><input type="password" name="opassword" id="opassword" class="form-control" >
	<span class="errmsg flash" id="erropassword" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">New Password  : </div>
	<div class="col-md-7"><input type="password" name="password" id="password" class="form-control" >
	<span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Confirm Password  : </div>
	<div class="col-md-7"><input type="password" name="cpassword" id="cpassword" class="form-control" >
	<span class="errmsg flash" id="errcpassword" style="color: red;"></span></div>
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
	if(document.getElementById("opassword").value == "")
	{
		document.getElementById("erropassword").innerHTML="Old Password field should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("password").value.length < 8)
	{
		document.getElementById("errpassword").innerHTML="Password field  should contain minimum 8 characters..";
		errchk = "True";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="New Password field should not be empty.....";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value != document.getElementById("password").value)
	{
		document.getElementById("errcpassword").innerHTML="Password and Confirm password not matching..";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value == "")
	{
		document.getElementById("errcpassword").innerHTML="Confirm Password should not be empty.";
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