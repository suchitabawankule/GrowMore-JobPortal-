<?php
include("header.php");
if(isset($_POST['submit']))
{
	$filephoto = rand() . $_FILES['photo']['name'];
	move_uploaded_file($_FILES['photo']['tmp_name'], "filestudent/" . $filephoto);
	
	$fileid_proof = rand() . $_FILES['id_proof']['name'];
	move_uploaded_file($_FILES['id_proof']['tmp_name'], "filestudent/" . $fileid_proof);
	
	$fileaddress_proof = rand() . $_FILES['address_proof']['name'];
	move_uploaded_file($_FILES['address_proof']['tmp_name'], "filestudent/" . $fileaddress_proof);
	
	if(isset($_GET['editid']))
	{
		$sql ="UPDATE student SET address='$_POST[address]',course_id='$_POST[course_id]', student_name='$_POST[student_name]', register_number='$_POST[register_number]', password='$_POST[password]', email_id='$_POST[email_id]', contact_no='$_POST[contact_no]'";
		if($_FILES['photo']['name'] != "")
		{
		$sql = $sql. ", photo='$filephoto'";
		}
		if($_FILES['id_proof']['name'] != "")
		{
		$sql = $sql. ", id_proof='$fileid_proof'";
		}
		if($_FILES['address_proof']['name'] != "")
		{
		$sql = $sql. ", address_proof='$fileaddress_proof'";
		}
		$sql = $sql. ", father_name='$_POST[father_name]', mother_name='$_POST[mother_name]', dob='$_POST[dob]', gender='$_POST[gender]', religion='$_POST[religion]', nationality='$_POST[nationality]', marital_status='$_POST[marital_status]', languages_known='$_POST[languages_known]', hobbies='$_POST[hobbies]',  status= '$_POST[status]' WHERE student_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Student record updated successfully..');</script>";
		}
	}
	else
	{
		$sql ="INSERT INTO student(address, course_id, student_name, register_number, password, email_id, contact_no, photo, id_proof, address_proof, father_name, mother_name, dob, gender, religion, nationality, marital_status, languages_known, hobbies, status) values ('$_POST[address]', '$_POST[course_id]', '$_POST[student_name]', '$_POST[register_number]', '$_POST[password]', '$_POST[email_id]', '$_POST[contact_no]', '$filephoto', '$fileid_proof', '$fileaddress_proof ', '$_POST[father_name]', '$_POST[mother_name]', '$_POST[dob]', '$_POST[gender]', '$_POST[religion]', '$_POST[nationality]', '$_POST[marital_status]', '$_POST[languages_known]', '$_POST[hobbies]', '$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('Student record inserted successfully..');</script>";
			echo "<script>window.location='student.php';</script>";
		}
	}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM student WHERE student_id='$_GET[editid]'";
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
<form method="post" action="" enctype="multipart/form-data" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">User</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Course: </div>
	<div class="col-md-7">
	<select name="course_id" id="course_id" class="form-control">
		<option value="">Select Course</option>
		<?php
		$sqlcourse ="SELECT * FROM course where status='Active'";
		$qsqlcourse = mysqli_query($con,$sqlcourse);
		while($rscourse = mysqli_fetch_array($qsqlcourse))
		{
			if($rscourse['course_id'] == $rsedit['course_id'])
			{
				echo "<option value='$rscourse[course_id]' selected>$rscourse[course_title]</option>";
			}
			else
			{
				echo "<option value='$rscourse[course_id]'>$rscourse[course_title]</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errcourse_id" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">User Name : </div>
	<div class="col-md-7"><input type="text" name="student_name" id="student_name" class="form-control"  value="<?php echo $rsedit['student_name'] ?>">
	<span class="errmsg flash" id="errstudent_name" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>
<div class="row p-2" >
	<div class="col-md-3 p-2">User ID: </div>
	<div class="col-md-7"><input type="text" name="register_number" id="register_number" class="form-control"  value="<?php echo $rsedit['register_number'] ?>">
	<span class="errmsg flash" id="errregister_number" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>
<div class="row p-2" >
	<div class="col-md-3 p-2">Password  : </div>
	<div class="col-md-7"><input type="password" name="password" id="password" class="form-control"  value="<?php echo $rsedit['password'] ?>">
	<span class="errmsg flash" id="errpassword" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>
<div class="row p-2" >
	<div class="col-md-3 p-2">Confirm Password  : </div>
	<div class="col-md-7"><input type="password" name="cpassword" id="cpassword" class="form-control"  value="<?php echo $rsedit['password'] ?>">
	<span class="errmsg flash" id="errcpassword" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Address: </div>
	<div class="col-md-7"><textarea name="address" id="address" class="form-control" ><?php echo $rsedit['address'] ?></textarea>
	<span class="errmsg flash" id="erraddress" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Email ID: </div>
	<div class="col-md-7"><input type="text" name="email_id" id="email_id" class="form-control"  value="<?php echo $rsedit['email_id'] ?>" >
	<span class="errmsg flash" id="erremail_id" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Contact Number: </div>
	<div class="col-md-7"><input type="text" name="contact_no" id="contact_no" class="form-control"  value="<?php echo $rsedit['contact_no'] ?>">
	<span class="errmsg flash" id="errcontact_no" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>
<div class="row p-2" >
	<div class="col-md-3 p-2">Photo: </div>
	<div class="col-md-7"><input type="file" name="photo" id="photo" class="form-control">
	<?php
	if(isset($_GET['editid']))
	{
		if($rsedit['photo'] == "")
		{
			$imgname="images/noimage.png";
			echo "<input type='hidden' name='updphoto' id='updphoto'>";
		}
		else if(file_exists("filestudent/".$rsedit['photo']))
		{
			$imgname = "filestudent/".$rsedit['photo'];
			echo "<input type='hidden' name='updphoto' id='updphoto' value='$imgname'>";
		}
		else
		{
			$imgname="images/noimage.png";
			echo "<input type='hidden' name='updphoto' id='updphoto'>";
		}
	?>
		<img src="<?php echo $imgname; ?>" style="width: 150px;height: 175px;">
	<?php
	}
	?>
	<span class="errmsg flash" id="errphoto" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">ID Proof: </div>
	<div class="col-md-7"><input type="file" name="id_proof" id="id_proof" class="form-control"><?php
	if(isset($_GET['editid']))
	{
		if($rsedit['id_proof'] == "")
		{
			$id_proof="nolink";
			echo "<input type='hidden' name='updid_proof' id='updid_proof'>";
		}
		else if(file_exists("filestudent/".$rsedit['id_proof']))
		{
			$id_proof = "filestudent/".$rsedit['id_proof'];
			echo "<input type='hidden' name='updid_proof' id='updid_proof' value='$rsedit[id_proof]'>";
		}
		else
		{
			$id_proof="nolink";
			echo "<input type='hidden' name='updid_proof' id='updid_proof'>";
		}
		if($id_proof != "nolink")
		{
	?>
		<a href="<?php echo $id_proof; ?>" download class="btn btn-primary" >Download Link</a>
	<?php
		}
	}
	?>
	<span class="errmsg flash" id="errid_proof" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Address Proof: </div>
	<div class="col-md-7"><input type="file" name="address_proof" id="address_proof" class="form-control"><?php
	if(isset($_GET['editid']))
	{
		if($rsedit['address_proof'] == "")
		{
			$address_proof="nolink";
			echo "<input type='hidden' name='updaddress_proof' id='updaddress_proof'>";
		}
		else if(file_exists("filestudent/".$rsedit['address_proof']))
		{
			$address_proof = "filestudent/".$rsedit['address_proof'];
			echo "<input type='hidden' name='updaddress_proof' id='updaddress_proof' value='$rsedit[address_proof]'>";
		}
		else
		{
			$address_proof="nolink";
			echo "<input type='hidden' name='updaddress_proof' id='updaddress_proof'>";
		}
		if($address_proof != "nolink")
		{
	?>
		<a href="<?php echo $address_proof; ?>" download class="btn btn-primary" >Download Link</a>
	<?php
		}
	}
	?>
	<span class="errmsg flash" id="erraddress_proof" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Father Name: </div>
	<div class="col-md-7"><input type="text" name="father_name" id="father_name" class="form-control"  value="<?php echo $rsedit['father_name'] ?>">
	<span class="errmsg flash" id="errfather_name" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Mother Name: </div>
	<div class="col-md-7"><input type="text" name="mother_name" id="mother_name" class="form-control"  value="<?php echo $rsedit['mother_name'] ?>">
	<span class="errmsg flash" id="errmother_name" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Date of birth: </div>
	<div class="col-md-7"><input type="date" name="dob" id="dob" class="form-control"  value="<?php echo $rsedit['dob'] ?>">
	<span class="errmsg flash" id="errdob" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Gender: </div>
	<div class="col-md-7">
	<select name="gender" id="gender" class="form-control">
		<option value="">Select Gender</option>
		<?php
		$arr = array("Male","Female");
		foreach($arr as $val)
		{
			if($val == $rsedit['gender'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errgender" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Religion: </div>
	<div class="col-md-7">
	<select name="religion" id="religion" class="form-control">
		<option value="">Select Religion</option>
		<?php
		$arr = array("Hindu","Islam","Christian","Buddhism","Others");
		foreach($arr as $val)
		{
			if($val == $rsedit['religion'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errreligion" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Nationality: </div>
	<div class="col-md-7"><input type="text" name="nationality" id="nationality" class="form-control"  value="<?php echo $rsedit['nationality'] ?>" >
	<span class="errmsg flash" id="errnationality" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Marital Status: </div>
	<div class="col-md-7">
	<select name="marital_status" id="marital_status" class="form-control">
		<option value="">Select Marital Status</option>
		<?php
		$arr = array("Married","single","divorced","widowed");
		foreach($arr as $val)
		{
			if($val == $rsedit['marital_status'])
			{
			echo "<option value='$val' selected>$val</option>";
			}
			else
			{
			echo "<option value='$val'>$val</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errmarital_status" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Languages Known: </div>
	<div class="col-md-7"><textarea name="languages_known" id="languages_known" class="form-control" ><?php echo $rsedit['languages_known'] ?></textarea>
	<span class="errmsg flash" id="errlanguages_known" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Hobbies: </div>
	<div class="col-md-7"><textarea name="hobbies" id="hobbies" class="form-control" ><?php echo $rsedit['hobbies'] ?></textarea>
	<span class="errmsg flash" id="errhobbies" style="color: red;"></span></div>
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
<?php
if(isset($_GET['editid']))
{
?>

<script>
function checkerror()
{
	
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaSpaceCommaExp = /^[a-zA-Z,\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	

	$('.errmsg').html('');
	var errchk = "False";

	if(document.getElementById("course_id").value == "")
	{
		document.getElementById("errcourse_id").innerHTML="Kindly select the course..";
		errchk = "True";
	}
	if(!document.getElementById("student_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errstudent_name").innerHTML = "Student name should contain alphabets..";
		errchk = "True";
	}
	if(document.getElementById("student_name").value == "")
	{
		document.getElementById("errstudent_name").innerHTML="Student name should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("register_number").value.match(alphaNumericExp))
	{
		document.getElementById("errregister_number").innerHTML = "Registration name should  contain Alphabets and numerics..";
		errchk = "True";
	}
	if(document.getElementById("register_number").value == "")
	{
		document.getElementById("errregister_number").innerHTML="Register Number Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("password").value.length < 8)
	{
		document.getElementById("errpassword").innerHTML="The password field  must contain atleast 8 character..";
		errchk = "True";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password should not be empty..";
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
/*
errphoto updphoto photo 
errid_proof updid_proof id_proof
erraddress_proof updaddress_proof  address_proof 
*/
	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML="Address Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("email_id").value.match(emailExp))
	{
		document.getElementById("erremail_id").innerHTML = "Student name should contain alphabets..";
		errchk = "True";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Email ID Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("contact_no").value.match(numericExp))
	{
		document.getElementById("errcontact_no").innerHTML = "Contact No. is not valid..";
		errchk = "True";
	}
	if(document.getElementById("contact_no").value == "")
	{
		document.getElementById("errcontact_no").innerHTML="Contact No. Should not be empty..";
		errchk = "True";
	}

	if(!document.getElementById("father_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errfather_name").innerHTML = "Father name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("father_name").value == "")
	{
		document.getElementById("errfather_name").innerHTML="Father name Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("mother_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errmother_name").innerHTML = "Mother name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("mother_name").value == "")
	{
		document.getElementById("errmother_name").innerHTML="Mother name Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("gender").value == "")
	{
		document.getElementById("errgender").innerHTML="Date of Birth Should not be empty..";
		errchk = "True";
	}  
	if(!document.getElementById("religion").value.match(alphaSpaceExp))
	{
		document.getElementById("errreligion").innerHTML = "Mother name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("religion").value == "")
	{
		document.getElementById("errreligion").innerHTML="Religion Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("languages_known").value.match(alphaSpaceCommaExp))
	{
		document.getElementById("errlanguages_known").innerHTML = "Entered Known languages not valid..";
		errchk = "True";
	}
	if(document.getElementById("languages_known").value == "")
	{
		document.getElementById("errlanguages_known").innerHTML="Known languages Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("hobbies").value.match(alphaSpaceCommaExp))
	{
		document.getElementById("errhobbies").innerHTML = "Entered Hobbeis is not valid..";
		errchk = "True";
	}
	if(document.getElementById("hobbies").value == "")
	{
		document.getElementById("errhobbies").innerHTML="Hobbies Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("dob").value == "")
	{
		document.getElementById("errdob").innerHTML="Date of Birth Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("nationality").value == "")
	{
		document.getElementById("errnationality").innerHTML="Nationality Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("marital_status").value == "")
	{
		document.getElementById("errmarital_status").innerHTML="Marital Status Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("status").value == "")
	{
		document.getElementById("errstatus").innerHTML="Kindly select the status..";
		errchk = "True";
	}
	
	if(document.getElementById("photo").value == "")
	{
		if(document.getElementById("updphoto").value == "")
		{
			document.getElementById("errphoto").innerHTML="Kindly upload Profile Photo..";
			errchk = "True";
		}
	}
	if(document.getElementById("id_proof").value == "")
	{
		if(document.getElementById("updid_proof").value == "")
		{
			document.getElementById("errid_proof").innerHTML="Kindly upload ID proof..";
			errchk = "True";
		}
	}
	if(document.getElementById("address_proof").value == "")
	{
		if(document.getElementById("updaddress_proof").value == "")
		{
			document.getElementById("erraddress_proof").innerHTML="Kindly upload Address proof..";
			errchk = "True";
		}
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
<?php
}
else
{
?>
<script>
function checkerror()
{
	
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaSpaceCommaExp = /^[a-zA-Z,\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	

	$('.errmsg').html('');
	var errchk = "False";

	if(document.getElementById("course_id").value == "")
	{
		document.getElementById("errcourse_id").innerHTML="Kindly select the course..";
		errchk = "True";
	}
	if(!document.getElementById("student_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errstudent_name").innerHTML = "User name should contain alphabets..";
		errchk = "True";
	}
	if(document.getElementById("student_name").value == "")
	{
		document.getElementById("errstudent_name").innerHTML="User name should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("register_number").value.match(alphaNumericExp))
	{
		document.getElementById("errregister_number").innerHTML = "Registration name should  contain Alphabets and numerics..";
		errchk = "True";
	}
	if(document.getElementById("register_number").value == "")
	{
		document.getElementById("errregister_number").innerHTML="Register Number Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("password").value.length < 8)
	{
		document.getElementById("errpassword").innerHTML="The password field  must contain atleast 8 character..";
		errchk = "True";
	}
	if(document.getElementById("password").value == "")
	{
		document.getElementById("errpassword").innerHTML="Password should not be empty..";
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
	
	if(document.getElementById("address").value == "")
	{
		document.getElementById("erraddress").innerHTML="Address Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("email_id").value.match(emailExp))
	{
		document.getElementById("erremail_id").innerHTML = "User name should contain alphabets..";
		errchk = "True";
	}
	if(document.getElementById("email_id").value == "")
	{
		document.getElementById("erremail_id").innerHTML="Email ID Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("contact_no").value.match(numericExp))
	{
		document.getElementById("errcontact_no").innerHTML = "Contact No. is not valid..";
		errchk = "True";
	}
	if(document.getElementById("contact_no").value == "")
	{
		document.getElementById("errcontact_no").innerHTML="Contact No. Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("photo").value == "")
	{
		document.getElementById("errphoto").innerHTML="Kindly upload Photo..";
		errchk = "True";
	}
	if(document.getElementById("id_proof").value == "")
	{
		document.getElementById("errid_proof").innerHTML="Kindly upload ID Proof..";
		errchk = "True";
	}
	if(document.getElementById("address_proof").value == "")
	{
		document.getElementById("erraddress_proof").innerHTML="Kindly upload address proof..";
		errchk = "True";
	}
	if(!document.getElementById("father_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errfather_name").innerHTML = "Father name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("father_name").value == "")
	{
		document.getElementById("errfather_name").innerHTML="Father name Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("mother_name").value.match(alphaSpaceExp))
	{
		document.getElementById("errmother_name").innerHTML = "Mother name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("mother_name").value == "")
	{
		document.getElementById("errmother_name").innerHTML="Mother name Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("gender").value == "")
	{
		document.getElementById("errgender").innerHTML="Date of Birth Should not be empty..";
		errchk = "True";
	}  
	if(!document.getElementById("religion").value.match(alphaSpaceExp))
	{
		document.getElementById("errreligion").innerHTML = "Mother name is not valid..";
		errchk = "True";
	}
	if(document.getElementById("religion").value == "")
	{
		document.getElementById("errreligion").innerHTML="Religion Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("languages_known").value.match(alphaSpaceCommaExp))
	{
		document.getElementById("errlanguages_known").innerHTML = "Entered Known languages not valid..";
		errchk = "True";
	}
	if(document.getElementById("languages_known").value == "")
	{
		document.getElementById("errlanguages_known").innerHTML="Known languages Should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("hobbies").value.match(alphaSpaceCommaExp))
	{
		document.getElementById("errhobbies").innerHTML = "Entered Hobbeis is not valid..";
		errchk = "True";
	}
	if(document.getElementById("hobbies").value == "")
	{
		document.getElementById("errhobbies").innerHTML="Hobbies Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("dob").value == "")
	{
		document.getElementById("errdob").innerHTML="Date of Birth Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("nationality").value == "")
	{
		document.getElementById("errnationality").innerHTML="Nationality Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("marital_status").value == "")
	{
		document.getElementById("errmarital_status").innerHTML="Marital Status Should not be empty..";
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
<?php
}
?>