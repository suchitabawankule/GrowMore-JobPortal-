<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filelogo = rand() . $_FILES['logo']['name'];
	move_uploaded_file($_FILES['logo']['tmp_name'], "filecompany/" . $filelogo);
	$company_description = mysqli_real_escape_string($con,$_POST['company_description']);
	
	if(isset($_SESSION['company_id'] ))
	{
		$sql ="UPDATE company SET company_name='$_POST[company_name]'";
		if($_FILES['logo']['name'] != "")
		{
		$sql = $sql . ",logo='$filelogo'";
		}
		$sql = $sql . ",email_id='$_POST[email_id]',phone_no='$_POST[phone_no]',company_description='$company_description',address='$_POST[address]' WHERE company_id='$_SESSION[company_id]'";
		$qsql = mysqli_query($con,$sql);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Company profile updated successfully..');</script>";
		}
		else
		{
			echo mysqli_error($con);
		}
	}
}
?>
<?php
if(isset($_SESSION['company_id'] ))
{
	$sqledit = "SELECT * FROM company WHERE company_id='$_SESSION[company_id] '";
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
<form method="post" action="" enctype="multipart/form-data" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Company profile</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Company Name  : </div>
	<div class="col-md-7"><input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $rsedit['company_name'] ?>" ></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Logo  : </div>
	<div class="col-md-7"><input type="file" name="logo" id="logo" class="form-control">
	<?php
	if(isset($_SESSION['company_id']))
	{
		if($rsedit['logo'] == "")
		{
			$imgname="images/noimage.png";
		}
		else if(file_exists("filecompany/".$rsedit['logo']))
		{
			$imgname = "filecompany/".$rsedit['logo'];
		}
		else
		{
			$imgname="images/noimage.png";
		}
	?>
	<img src="<?php echo $imgname; ?>" style="width: 175px;height: 125px;">
	<?php
	}
	?>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Company Address  : </div>
	<div class="col-md-7"><textarea name="address" id="address" class="form-control" ><?php echo $rsedit['address'] ?></textarea></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Email Id  : </div>
	<div class="col-md-7"><input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rsedit['email_id'] ?>" ></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Phone No  : </div>
	<div class="col-md-7"><input type="text" name="phone_no" id="phone_no" class="form-control" value="<?php echo $rsedit['phone_no'] ?>"  ></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Company Description  : </div>
	<div class="col-md-7"><textarea name="company_description" id="company_description" class="form-control" ><?php echo $rsedit['company_description'] ?></textarea></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2"></div>
	<div class="col-md-7"><input type="submit" class="form-control" name="submit" id="submit" value="Update Profile" ></div>
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
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Please match the requested format..";
		errchk = "True";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="The password field  must contain atleast 8 character....";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value == "")
	{
		document.getElementById("errcpassword").innerHTML="Invalid password...";
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