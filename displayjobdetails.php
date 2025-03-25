<?php
include("header.php");
if(isset($_POST['submit']))
{
	$sqljob_application = "INSERT INTO job_application(student_id,job_id,applied_date,application_status,status) VALUES('$_SESSION[student_id]','$_POST[job_id]','$dt','','Pending')";
	$qsqljob_application = mysqli_query($con,$sqljob_application);
	echo mysqli_error($con);
	echo "<script>alert('Job Application submitted successfully...');</script>";
	echo "<script>window.location='displayjobdetails.php?job_id=$_GET[job_id]';</script>";
}
	$sqljob = "SELECT * FROM job LEFT JOIN job_category on job_category.jobcategory_id=job.jobcategory_id LEFT JOIN location on location.location_id=job.location_id left join company ON company.company_id=job.company_id WHERE job.status='Active' AND job.job_id='$_GET[job_id]'";
	$qsqljob = mysqli_query($con,$sqljob);
	echo mysqli_error($con);
	$rsjob = mysqli_fetch_array($qsqljob);
	//View Job Application
	$sqljob_application ="SELECT * FROM job_application WHERE student_id='$_SESSION[student_id]' AND job_id='$_GET[job_id]'";
	$qsqljob_application = mysqli_query($con,$sqljob_application);
	$rsjob_application = mysqli_fetch_array($qsqljob_application);
?>
<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
	<div class="container">
	  <div class="row d-flex justify-content-center">
		<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
		  <h2>Jobs detail</h2>
		</div>
	  </div>
	</div>
  </div>
</section>

    <div class="bg-light">
      <div class="container">
        <div class="row">
 
 <div class="col-lg-5">
            <div class="p-4 mb-3 bg-white">
              <h3 class="h5 text-black mb-3">Company Detail</h3><hr>
              <h2 class="h5 text-black mb-3"><b style='color: red;'><?php echo $rsjob['company_name']; ?></b></h2>
<?php
		if($rsjob['logo'] == "")
		{
			$img = "images/No-Image-Available.png";
		}
		else if(file_exists('filecompany/'.$rsjob['logo']))
		{
			$img = 'filecompany/'.$rsjob['logo'];
		}
		else
		{
			$img = "images/No-Image-Available.png";
		}
		echo "<img src='$img' width='100%' height='200' ><br><hr>";
?>		
              <p class="mb-0"><b>Address:</b> <?php echo $rsjob['address']; ?></p>
			  
              <p class="mb-0"><b>Phone:</b> <?php echo $rsjob['phone_no']; ?></p>

              <p class="mb-0"><b>Email Address:</b> <?php echo $rsjob['email_id']; ?></span></a></p>
			  <hr>
			  <p>
			  <b>Company Description</b><br><?php echo $rsjob['company_description']; ?>
			  </p>
            </div>
            
          </div>
		  
      
          <div class="col-md-12 col-lg-7 mb-5">
          
			     <form action="#" class="p-4 bg-white">
              

<div class="row form-group">
	<div class="col-md-12"><h3><?php echo $rsjob['job_title']; ?></h3></div>
	<div class="col-md-12 mb-3 mb-md-0">
<?php echo $rsjob['job_description']; ?>
<h2>Job Details : </h2>
<table class="table table-striped table-bordered">
	<tr>
		<th style="width: 250px;">Last Date to Apply</th><td><?php echo date("d-M-Y",strtotime($rsjob['publish_date'])); ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Job Location</th><td><?php echo $rsjob['location']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Industry type</th><td><?php echo $rsjob['industry_type']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Employment Type</th><td><?php echo $rsjob['employee_type']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Interview Date</th><td><?php echo date("d-M-Y",strtotime($rsjob['interview_fdate']))  . " - " . date("d-M-Y",strtotime($rsjob['interview_tdate'])); ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Educational Qualification</th><td><?php 
		$eduqual = unserialize($rsjob['edu_qualification']);
		foreach($eduqual as $val)
		{
				$sqlcourse ="SELECT * FROM course WHERE course_id='$val'";
				$qsqlcourse = mysqli_query($con,$sqlcourse);
				$rscourse = mysqli_fetch_array($qsqlcourse);
			echo " " . $rscourse['course_title'] . " ";
		}
		?></td>
	</tr>
</table>

	</div>
	<div class="col-md-12 mb-3 mb-md-0">
	<p>
	<hr>
<?php
if(mysqli_num_rows($qsqljob_application) >= 1)
{
	echo "<center><a href='' onclick='return false;' class='btn btn-danger  py-2 px-4' >You have already applied for this job..</a></center>";
}
else
{
	if($rsstudent['photo'] == "")
	{
		echo "<center><a href='studentprofile.php?job_id=$_GET[job_id]' onclick='alert('Kindly update your profile details...');return false;' class='btn btn-danger  py-2 px-4' >Kindly update your profile details...</a></center>";
	}
	else
	{
		$sqlcomputer_skill = "select * from computer_skill WHERE student_id='$_SESSION[student_id]'";
		$qsqlcomputer_skill = mysqli_query($con,$sqlcomputer_skill);
		if(mysqli_num_rows($qsqlcomputer_skill) == 0 )
		{
		echo "<center><a href='computerskill.php?job_id=$_GET[job_id]' onclick='alert('Kindly update Computer skills...');return false;' class='btn btn-danger  py-2 px-4' >Kindly update Computer skills...</a></center>";
		}
		else
		{
			$sqleducation_qualification = "select * from education_qualification WHERE student_id='$_SESSION[student_id]'";
			$qsqleducation_qualification = mysqli_query($con,$sqleducation_qualification);
			if(mysqli_num_rows($qsqleducation_qualification) == 0 )
			{
				echo "<center><a href='education_qualification.php?job_id=$_GET[job_id]' onclick='alert('Kindly Add Educational Qualification details...');return false;' class='btn btn-danger  py-2 px-4' >Kindly Add Educational Qualification ...</a></center>";
			}
			else
			{
?>
				<center><a href="" onclick="return false;"  class="btn btn-primary  py-2 px-4" data-toggle="modal" data-target="#myModal">Apply For Job</a></center>
<?php
			}
		}
	}
}
?>

	</p>
	</div>
</div>

  
            </form>
          </div>


		  
		  
        </div>
      </div>
    </div>

    <?php
	include("footer.php");
	?>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
	<form method="post" action="">
	<input type="hidden" name="job_id" id="job_id" value="<?php echo $_GET['job_id']; ?>" >
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Apply for <?php echo $rsjob['job_title']; ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <p>
<table class="table table-striped table-bordered">
	<tr>
		<th style="width: 250px;">Company Name</th><td><?php echo $rsjob['company_name']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Last Date to Apply</th><td><?php echo date("d-M-Y",strtotime($rsjob['publish_date'])); ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Job Location</th><td><?php echo $rsjob['location']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Employment Type</th><td><?php echo $rsjob['employee_type']; ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Interview Date</th><td><?php echo date("d-M-Y",strtotime($rsjob['interview_fdate']))  . " - " . date("d-M-Y",strtotime($rsjob['interview_tdate'])); ?></td>
	</tr>
	<tr>
		<th style="width: 250px;">Educational Qualification</th><td><?php echo $rsjob['edu_qualification']; ?></td>
	</tr>
</table>
	</p>
      </div>
      <div class="modal-footer">
        <button type="submit" name="submit" id="submit" class="btn btn-success" >Click here to Apply...</button>
      </div>
    </div>
	</form>
  </div>
</div>