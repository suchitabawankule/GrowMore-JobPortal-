<?php
include("header.php");
if(isset($_POST["submit"]))
{
	//Insert Statement starts here
	$smtp['mailsender'] 	= $_POST["mailsender"];
	$smtp['smtpserver'] 	= $_POST["smtpserver"];
	$smtp['smtpport']  		= $_POST["smtpport"];
	$smtp['loginid']  		= $_POST["loginid"];
	$smtp['password']  		= $_POST["password"];
	$smtp['smtpdetails'] 	= serialize($smtp);
	$sqldel ="DELETE from setting where settingtype='SMTP'";
	$qsqldel = mysqli_query($con,$sqldel);
	$sql = "INSERT INTO setting (settingtype,settingdetails,status) VALUES('SMTP','$smtp[smtpdetails]','Active')";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('SMTP Setting Record done successfully..');</script>";
		echo "<script>window.location='mailsetting.php';</script>";
	}
	else
	{
		$errmsg = str_replace("'","",mysqli_error($con));
		echo "<script>alert('$errmsg');</script>";
	}
	//Insert Statement ends here
}
?>
<?php
$sqledit = "SELECT * FROM setting where settingtype='SMTP'";
$qsqledit = mysqli_query($con,$sqledit);
$rsedit = mysqli_fetch_array($qsqledit);
$smtpdetails = unserialize($rsedit['settingdetails']);
?>
		<section class="ftco-section bg-light" style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Settings</h2>
	  <div class="page-title-subheading">Add/Edit SMTP Setting details..
</div>
	</div>


<div class="tab-content">
<div class="tab-pane tabs-animation fade show active" id="tab-content-0" role="tabpanel">
	<div class="main-card mb-3 card">
		<div class="card-body">
<form method="post"  onsubmit="return validatesubmit()"  action="">   
<div class="form-row">
		<div class="col-md-12">
			<div class="position-relative form-group">
				<label for="exampleCity" class="">Mail Sender</label>
				<input name="mailsender" id="mailsender" type="text" class="form-control" value="<?php echo $smtpdetails['mailsender']; ?>" >
			</div>
		</div> 
		<div class="col-md-12">
			<div class="position-relative form-group">
				<label for="exampleCity" class="">SMTP Server</label>
				<input name="smtpserver" id="smtpserver" type="text" class="form-control" value="<?php echo $smtpdetails['smtpserver']; ?>" >
			</div>
		</div> 
		</div>
<div class="form-row">
		<div class="col-md-12">
			<div class="position-relative form-group">
				<label for="exampleCity" class="">SMTP Port</label>
				<input name="smtpport" id="smtpport" type="text" class="form-control" value="<?php echo $smtpdetails['smtpport']; ?>" >
			</div>
		</div>
		</div>
<div class="form-row">
		<div class="col-md-12">
			<div class="position-relative form-group">
				<label for="exampleCity" class="">Login ID</label>
				<input name="loginid" id="loginid" type="text" class="form-control" value="<?php echo $smtpdetails['loginid']; ?>" >
			</div>
		</div>
		</div>
<div class="form-row">
		<div class="col-md-12">
			<div class="position-relative form-group">
				<label for="exampleCity" class="">Password</label>
				<input name="password" id="password" type="password" class="form-control" value="<?php echo $smtpdetails['password']; ?>" >
			</div>
		</div>
	</div>
<div class="col-md-12">
</div>
<button class="mt-2 btn btn-primary" name="submit" type="submit">Update Settings</button>
</form>

            </div>
          </div><!-- end -->

			</div>

			</div>
		</section>
 
<?php
include("footer.php");
?>