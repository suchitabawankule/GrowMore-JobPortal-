<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_POST['submit']))
{
	$banner_img =  rand().$_FILES["banner_img"]["name"];
	move_uploaded_file($_FILES['banner_img']['tmp_name'],'img_trainingmaterial/'.$banner_img);
	$title = mysqli_real_escape_string($con,$_POST['title']);
	$description = mysqli_real_escape_string($con,$_POST['description']);
		if(isset($_GET['editid']))
		{
$sqleditfile = "SELECT * FROM training_material WHERE trainingmaterial_id = '$_GET[editid]'";
$qsqleditfile = mysqli_query($con,$sqleditfile);
echo mysqli_error($con);
$rseditfile = mysqli_fetch_array($qsqleditfile);
$arrfiles = unserialize($rseditfile['file']);
if($_FILES['file']['name'][0] == "")
{
	$countfiles = 0;
}
else
{
	$countfiles = count($_FILES['file']['name']);
}

 // Looping all files
 for($i=0;$i<$countfiles;$i++)
 {
	$filename[$i] = rand().$_FILES['file']['name'][$i];
	// Upload file
	move_uploaded_file($_FILES['file']['tmp_name'][$i],'docstrainingmaterial/'.$filename[$i]);
 }
 $allfiles = array_merge($arrfiles,$filename);
 $trainingmaterialfiles = serialize($allfiles);
			$sql ="UPDATE training_material SET material_type='$_POST[material_type]',title='$title',description='$description'";
if($countfiles > 0)
{
			$sql = $sql . ",file='$trainingmaterialfiles'";
}
			$sql = $sql . ",status='$_POST[status]'";
if($_FILES["banner_img"]["name"] != "")			
{
			$sql = $sql . ",banner_img='$banner_img'";
}
			$sql = $sql . " WHERE trainingmaterial_id='$_GET[editid]'";
			$qsql = mysqli_query($con,$sql);
				echo mysqli_error($con);
			if(mysqli_affected_rows($con) == 1)
			{
				echo "<script>alert('Training material content updated successfully..');</script>";
				//echo "<script>window.locaiton='training_material.php?editid=$_GET[editid]&material_type=$_GET[material_type]';</script>";
			}
		}
		else
		{
 $countfiles = count($_FILES['file']['name']);
 // Looping all files
 for($i=0;$i<$countfiles;$i++)
 {
	  $filename[$i] = rand().$_FILES['file']['name'][$i];
	  // Upload file
	  move_uploaded_file($_FILES['file']['tmp_name'][$i],'docstrainingmaterial/'.$filename[$i]);
 }
	$trainingmaterialfiles = serialize($filename);
	$sql ="INSERT INTO training_material(material_type,title,description,file,status,banner_img) values ('$_POST[material_type]','$title','$description','$trainingmaterialfiles','$_POST[status]','$banner_img')";
	$qsql = mysqli_query($con,$sql);
		echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Training material Published successfully..');</script>";
		//echo "<script>window.location='training_material.php?material_type=" . $_GET['material_type'] ."';</script>";
	}
		}
}
?>
<?php
if(isset($_GET['editid']))
{
	$sqledit = "SELECT * FROM training_material WHERE trainingmaterial_id='$_GET[editid]'";
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
<input type="hidden" name="material_type" id="material_type" class="form-control" value="<?php echo $_GET['material_type']; ?>" >
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Upload Training material - <?php echo $_GET['material_type']; ?><input type="hidden" name="material_type" id="material_type" value="<?php echo $_GET['material_type'] ?>" readonly></h2>
	</div>
	
<div class="row p-2" >
	<div class="col-md-2 p-2">Title : </div>
	<div class="col-md-10"><input type="text" name="title" id="title" class="form-control" value="<?php echo $rsedit['title'] ?>"><label class="errmsg flash" id="errtitle" style="color: red;"></label></div>
</div>
<div class="row p-2" >
	<div class="col-md-2 p-2">Banner: </div>
	<div class="col-md-10"><input type="file" name="banner_img" id="banner_img" class="form-control" multiple accept="image/*"  ><label class="errmsg flash" id="errbanner_img" style="color: red;"></label>
	<?php
	if(isset($_GET['editid']))
	{ 
		  if($rsedit['banner_img'] == "")
		  {
			echo "<img src='images/No-Image-Available.png' width='300'>";
		  }
		  else if(!file_exists("img_trainingmaterial/". $rsedit['banner_img']))
		  {
			echo "<img src='images/No-Image-Available.png' width='300'>";
		  }
		  else
		  {
			echo "<img src='img_trainingmaterial/$rsedit[banner_img]' width='300'>";
		  }
	}
	?>
	</div>
</div>

<div class="row p-2" >
	<div class="col-md-2 p-2">Description: </div>
	<div class="col-md-10"><textarea name="description" id="description" class="form-control" ><?php echo $rsedit['description'] ?></textarea>
	<label class="errmsg flash" id="errdescription" style="color: red;"></label></div>
	
<script src="https://cdn.tiny.cloud/1/vkp7vwptosm1ao2ztjqdp0riscxgp2sxw81z6ma02p9h4oqc/tinymce/5/tinymce.min.js" ></script>
<script>tinymce.init({ selector:'textarea' });</script>
</div>

<div class="row p-2" >
	<div class="col-md-2 p-2">Upload files: </div>
	<div class="col-md-10"><input type="file" name="file[]" id="file" class="form-control" multiple 
	<?php
	if($_GET['material_type'] == "Docs")
	{
	echo ' accept=".csv, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.ms-excel,application/msword, application/vnd.ms-powerpoint,text/plain, application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document, application/vnd.openxmlformats-officedocument.spreadsheetml.sheet, application/vnd.openxmlformats-officedocument.presentationml.presentation" ';
	}
	else if($_GET['material_type'] == "Video")
	{
	echo ' accept="video/webm,video/mp4" ';
	}
	else if($_GET['material_type'] == "Audio")
	{
	echo ' accept=".mp3,audio/*" ';
	}
	else if($_GET['material_type'] == "Photo Slider")
	{
	echo ' accept="image/*" ';
	}
	else
	{
	echo '';
	}
	?>
>
	<label class="errmsg flash" id="errfile" style="color: red;"></label>
	<?php
	if(isset($_GET['editid']))
	{
			// Looping all files
			echo "<b>Uploaded Files</b><br>";
			echo "<div id='lblfile'>";
			include("ajaxdeletefile.php");
			 echo "</div>";
	}
	?>
</div>
</div>


<div class="row p-2" >
	<div class="col-md-2 p-2">Status  : </div>
	<div class="col-md-10">
	<select name="status" id="status"  class="form-control" >
		<option value="">Select status</option>
		<?php
		$arr = array("Publish","Draft");
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
	<div class="col-md-12 p-2">
	<center><input type="submit" class="form-control" name="submit" id="submit" value="Publish Training Material" style="width: 350px;cursor: pointer;" ></center>
	</div>
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
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	//    
	if(!document.getElementById("title").value.match(alphaSpaceExp))
	{
		document.getElementById("errtitle").innerHTML = "Kindly enter alphabets in Training material title..";
		errchk = "True";
	}
	if(document.getElementById("title").value == "")
	{
		document.getElementById("errtitle").innerHTML="Kindly enter the title..";
		errchk = "True";
	}
	if(document.getElementById("description").value == "")
	{
		document.getElementById("errdescription").innerHTML="Description should not be empty..";
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
else
{
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
	//    
	if(!document.getElementById("title").value.match(alphaSpaceExp))
	{
		document.getElementById("errtitle").innerHTML = "Kindly enter alphabets in Training material title..";
		errchk = "True";
	}
	if(document.getElementById("title").value == "")
	{
		document.getElementById("errtitle").innerHTML="Kindly enter the title..";
		errchk = "True";
	}
	if(document.getElementById("banner_img").value == "")
	{
		document.getElementById("errbanner_img").innerHTML="Kindly upload banner..";
		errchk = "True";
	}
	if(document.getElementById("description").value == "")
	{
		document.getElementById("errdescription").innerHTML="Description should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("file").value == "")
	{
		document.getElementById("errfile").innerHTML="Kindly upload Training material files..";
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
<script>
function deletefile(filedelid,editid)
{
	if(confirm("Are you sure want to delete this file?") == true )
	{
		document.getElementById("lblfile").innerHTML = "<img src='images/loading.gif'>";
		if (window.XMLHttpRequest) {
			// code for IE7+, Firefox, Chrome, Opera, Safari
			xmlhttp = new XMLHttpRequest();
		} else {
			// code for IE6, IE5
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
		}
		xmlhttp.onreadystatechange = function() {
			if (this.readyState == 4 && this.status == 200) {
				document.getElementById("lblfile").innerHTML = this.responseText;
			}
		};
		xmlhttp.open("GET","ajaxdeletefile.php?filedelid="+filedelid+"&editid="+editid,true);
		xmlhttp.send();
	}
}
</script>