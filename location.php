<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	//If block for update
	if(isset($_GET['editid']))
	{
		//Step 4: update statement starts here
		$sql ="UPDATE location SET location='$_POST[location]',location_description='$_POST[location_description]',status='$_POST[status]' WHERE location_id='$_GET[editid]'";
		$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('location record updated successfully..');</script>";
		}		
		//Step 4: update statement ends here
	}
	else // else block for innsert statement
	{
		$sql ="INSERT INTO location(location,location_description,status) values ('$_POST[location]','$_POST[location_description]','$_POST[status]')";
		$qsql = mysqli_query($con,$sql);
			echo mysqli_error($con);
		if(mysqli_affected_rows($con) == 1)
		{
			echo "<script>alert('location record inserted successfully..');</script>";
			echo "<script>window.location='location.php';</script>";
		}
	}
}
?>
<?php
//Step 2: Select Statement starts here
if(isset($_GET['editid']))
{
	$sqledit= "SELECT * FROM location WHERE location_id='$_GET[editid]'";
	$qsqledit = mysqli_query($con,$sqledit);
			echo mysqli_error($con);
	$rsedit = mysqli_fetch_array($qsqledit);
}
//Step 2: Select Statement ends here
?>
		<section class="ftco-section bg-light"  style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Location</h2>
	</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">loctaion: </div>
	<div class="col-md-7">
	
	<input type="text" name="location" id="location" class="form-control" value="<?php echo $rsedit['location']; ?>" >
	
	<label class="errmsg flash" id="errlocation" style="color: red;"></label>
	
	</div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Location description : </div>
	<div class="col-md-7">
		<textarea name="location_description" id="location_description" class="form-control" ><?php echo $rsedit['location_description']; ?></textarea>
		<label id="errlocation_description" style="color: red;"></label>
	</div>
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
function checkerror()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	if(!document.getElementById("location").value.match(alphaSpaceExp))
	{
		document.getElementById("errlocation").innerHTML = "Kindly enter alphabets in Location Name..";
		errchk = "True";
	}
	if(document.getElementById("location").value == "")
	{
		document.getElementById("errlocation").innerHTML="Location Name Should not be empty..";
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