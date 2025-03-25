<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filelogo = rand() . $_FILES['logo']['name'];
	move_uploaded_file($_FILES['logo']['tmp_name'], "filecompany/" . $filelogo);
	$company_description = mysqli_real_escape_string($con,$_POST['company_description']);
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE company SET company_name='$_POST[company_name]',address='$_POST[address]'";
		if($_FILES['logo']['name'] != "")
		{
		$sql = $sql . ",logo='$filelogo'";
		}
		$sql = $sql . ",email_id='$_POST[email_id]',password='$_POST[password]',phone_no='$_POST[phone_no]',company_description='$company_description',status='$_POST[status]' WHERE company_id='$_GET[editid]'";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Company record updated successfully..');</script>";
	}
}
else
	{
		$sql ="INSERT INTO company(company_name,logo,address,email_id,phone_no,company_description,status,password) values ('$_POST[company_name]','$filelogo','$_POST[address]','$_POST[email_id]','$_POST[phone_no]','$company_description','$_POST[status]','$_POST[password]')";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Company record inserted successfully..');</script>";
			echo "<script>window.location='company.php';</script>";
		}
	}
	
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM company WHERE company_id='$_GET[editid]'";
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
<input type="hidden" name="editid" id="editid" value="<?php 
if(isset($_GET['editid']))
{
	echo $_GET['editid'];
}
else
{
	echo "0";
}
?>" >
	<div class="mb-4 mb-md-1 mr-12">
		<div class="job-post-item-header d-flex align-items-center">
		  <h2 class="mr-3 text-black h3">Company</h2>
		</div>

		<div class="row p-2" >
			<div class="col-md-3 p-2">Company Name  : </div>
			<div class="col-md-7"><input type="text" name="company_name" id="company_name" class="form-control" value="<?php echo $rsedit['company_name'] ?>" >
			<span class="errmsg flash" id="errcompany_name" style="color: red;"></span></div>
			<div class="col-md-2 p-2"></div>
		</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Company Description  : </div>
		<div class="col-md-7"><textarea name="company_description" id="company_description" class="form-control" ><?php echo $rsedit['company_description'] ?></textarea>
		<span class="errmsg flash" id="errcompany_description" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Logo  : </div>
		<div class="col-md-7"><input type="file" name="logo" id="logo" class="form-control">
		<?php
		if(isset($_GET['editid']))
		{
		?>
		<img src="filecompany/<?php echo $rsedit['logo'] ?>" style="width: 150px; height: 175px;">
		<?php
		}
		?>
		<span class="errmsg flash" id="errlogo" style="color: red;"></span>
		</div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Company Address  : </div>
		<div class="col-md-7"><textarea name="address" id="address" class="form-control" ><?php echo $rsedit['address'] ?></textarea>
		<span class="errmsg flash" id="erraddress" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>


	<div class="row p-2" >
		<div class="col-md-3 p-2">Phone No  : </div>
		<div class="col-md-7"><input type="text" name="phone_no" id="phone_no" class="form-control" value="<?php echo $rsedit['phone_no'] ?>"  >
		<span class="errmsg flash" id="errphone_no" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Email Id  : </div>
		<div class="col-md-7"><input type="text" name="email_id" id="email_id" class="form-control" value="<?php echo $rsedit['email_id'] ?>" >
		<span class="errmsg flash" id="erremail_id" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Password  : </div>
		<div class="col-md-7"><input type="password" name="password" id="password" class="form-control"   value="<?php echo $rsedit['password'] ?>">
		<span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>


	<div class="row p-2" >
		<div class="col-md-3 p-2">Confirm Password  : </div>
		<div class="col-md-7"><input type="password" name="cpassword" id="cpassword" class="form-control"    value="<?php echo $rsedit['password'] ?>">
		<span class="errmsg flash" id="errcpassword" style="color: red;"></span></div>
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
		<span class="errmsg flash" id="errstatus" style="color: red;"></span>
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
	if(document.getElementById("company_name").value == "")
	{
		document.getElementById("errcompany_name").innerHTML="Company name should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("company_description").value == "")
	{
		document.getElementById("errcompany_description").innerHTML="Company description should not be empty..";
		errchk = "True";
	}

	if(document.getElementById("editid").value == "0")
	{
		if(document.getElementById("logo").value == "")
		{
			document.getElementById("errlogo").innerHTML="Kindly upload the Logo..";
			errchk = "True";
		}
	}


	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML="Company address should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("phone_no").value == "")
	{
		document.getElementById("errphone_no").innerHTML="Kindly enter Phone number..";
		errchk = "True";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Email ID should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password should not be empty....";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value == "")
	{
		document.getElementById("errcpassword").innerHTML="Confirm password should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value != document.getElementById("password").value)
	{
		document.getElementById("errcpassword").innerHTML="Password and Confirm password not matching...";
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