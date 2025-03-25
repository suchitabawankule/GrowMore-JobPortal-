<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	if(isset($_SESSION['admin_id']))
	{
		$sql ="UPDATE admin SET admin_name='$_POST[admin_name]',admin_type='$_POST[admin_type]',login_id='$_POST[login_id]' WHERE admin_id='$_SESSION[admin_id]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Admin profile updated successfully..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}		
	}
}
?>
<?php
if(isset($_SESSION['admin_id']))
{
	$sqledit = "SELECT * FROM admin WHERE admin_id='$_SESSION[admin_id]'";
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
	  <h2 class="mr-3 text-black h3">Admin</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Admin Name  : </div>
	<div class="col-md-7"><input type="text" name="admin_name" id="admin_name" class="form-control" value="<?php echo $rsedit['admin_name'] ?>" ></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Admin Type  : </div>
	<div class="col-md-7">
	<select name="admin_type" id="admin_type"  class="form-control" >
		<?php
		$arr = array("Administrator","Employee");
		foreach($arr as $value)
		{
			if($value == $rsedit['admin_type'])
			{
			echo "<option value='$value' selected>$value</option>";
			}
		}
		?>
	</select>
	</div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Login ID  : </div>
	<div class="col-md-7"><input type="text" name="login_id" id="login_id" class="form-control"  value="<?php echo $rsedit['login_id'] ?>"></div>
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
	if(document.getElementById("admin_type").value == "")
	{
		document.getElementById("erradmin_type").innerHTML="Kindly select the Admin..";
		errchk = "True";
	}	
	if(document.getElementById("login_id").value == "")
	{
		document.getElementById("errlogin_id").innerHTML="Login Id Should not be empty..";
		errchk = "True";
	}
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