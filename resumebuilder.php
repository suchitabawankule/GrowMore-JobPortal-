<?php
include("header.php");
$sqlstudent1 ="SELECT * FROM student WHERE student_id='$_GET[student_id]'";
$qsqlstudent1 = mysqli_query($con,$sqlstudent1);
$rsstudent1 = mysqli_fetch_array($qsqlstudent1);
?>

    <section class="contact-section bg-light" style="padding-top: 25px; padding-bottom: 25px;"  id="printableArea">
      <div class="container">

        <div class="row">
          <div class="col-md-12 bg-white" style="padding-top: 15px;">
			<center><h2>BIO DATA</h2></center>
			<hr>
          </div>
        </div>
		
        <div class="row bg-white">
          <div class="col-md-8" style="padding-top: 15px;">
			<h3><?php echo strtoupper($rsstudent1['student_name']); ?></h3>
			<?php echo $rsstudent1['address']; ?><br>
			<b>Email ID:</b> <?php echo $rsstudent1['email_id']; ?><br>
			<b>Contact No.:</b> <?php echo $rsstudent1['contact_no']; ?>
          </div>
		  <div class="col-md-4 bg-white" style="padding-top: 15px;text-align: right;">
			<?php 
		if($rsstudent1['photo'] == "")
		{
			$img = "images/No-Image-Available.png";
		}
		else if(file_exists('filestudent/'.$rsstudent1['photo']))
		{
			$img = 'filestudent/'.$rsstudent1['photo'];
		}
		else
		{
			$img = "images/No-Image-Available.png";
		}
		echo "<img src='$img' width='160' height='175' >";
			?>
          </div>
        </div>
		
		<div class="row bg-white">
			<div class="col-md-12"><hr>
				<h2>Career Objective</h2>
				<p>Seeking a challenging and interesting job that encourages creativity and provide exposure to new technology to advice professional and personal growth along with the organization.</p><hr>
			</div>
		</div>
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Educational Qualification:</h2>
<table class="table table-bordered">
	<thead>
		<tr>
			<th>Qualification</th>
			<th>College</th>
			<th>Completion Date</th>
			<th>Percentage</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM education_qualification where student_id='$_GET[student_id]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>" .strtoupper($rs['qualification']) ."</td>
			<td>" . ucfirst($rs['college_name']) ."</td>
			<td>" . date("d-M-Y",strtotime($rs['completion_date'])) ."</td>
			<td>$rs[percentage]%</td>
			</tr>";
	}
	?>
	</tbody>
</table>
			</div>
		</div>
		
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Computer Skills:</h2>
<table class="table table-bordered">
	<tbody>
	<?php
	$sql ="SELECT * FROM computer_skill WHERE student_id='$_GET[student_id]'";
	$qsql = mysqli_query($con,$sql);
	$rs = mysqli_fetch_array($qsql);
	{
		echo "<tr>
				<th style='width: 250px;'>Basic Skills</th>
				<td>$rs[basic_known]</td>
			  </tr>
			  <tr>
				<th>Programming Skills</th>
				<td>$rs[programming]</td>
			  </tr>
			  <tr>
				<th>Database Skills</th>
				<td>$rs[database_skill]</td>
			   </tr>
			  <tr>
				<th>Software Skills</th>
				<td>$rs[software_skill]</td>
			  </tr>
			  <tr>
				<th>Other Skills</th>
				<td>$rs[others]</td>
			  </tr>";
	}
	?>
	</tbody>
</table>
			</div>
		</div>
		
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Certification details:</h2>
<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<th>Certification Title</th>
			<th>Certification detail</th>
			<th>Work duration</th>
			<th>Role</th>
			<th>Any Other detail</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM certification WHERE student_id='$_SESSION[student_id]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[certification_title]</td>
			<td>$rs[description]</td>
			<td>$rs[work_duration]</td>
			<td>$rs[role]</td>
			<td>$rs[anyother]</td>
			</tr>";
	}
	?>
	</tbody>
</table>
			</div>
		</div>
		
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Other Activities:</h2>
<table class="table table-striped table-bordered">
	<thead>
		<tr>

			<th>Activity Title</th>
			<th>Activity detail</th>
			<th>Completed date</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT * FROM other_activities WHERE student_id='$_SESSION[student_id]'";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		echo "<tr>
			<td>$rs[activity_title]</td>
			<td>$rs[activity_detail]</td>
			<td>" . date("d-M-Y",strtotime($rs['completed_date'])) ."</td>
			</tr>";
	}
	?>
	</tbody>
</table>
			</div>
		</div>		
		
		
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Hobbies:</h2>
<table class="table table-striped table-bordered">
		<tr>
			<td><?php echo $rsstudent1['hobbies']; ?></td>
		</tr>
</table>
			</div>
		</div>	
		
				
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Languages known:</h2>
<table class="table table-striped table-bordered">
		<tr>
			<td><?php echo $rsstudent1['languages_known']; ?></td>
		</tr>
</table>
			</div>
		</div>	
		
				
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Personal details:</h2>
<table class="table table-striped table-bordered">
		<tr>

			<th style="width: 225px;">Father's name</th>
			<th><?php echo $rsstudent1['father_name']; ?></th>
		</tr>
		<tr>
			<th style="width: 225px;">Mother's name</th>
			<td><?php echo $rsstudent1['mother_name']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Date of Birth</th>
			<td><?php echo date("d-M-Y",strtotime($rsstudent1['dob'])); ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Gender</th>
			<td><?php echo $rsstudent1['gender']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Religion</th>
			<td><?php echo $rsstudent1['religion']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Nationality</th>
			<td><?php echo $rsstudent1['nationality']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Marital status</th>
			<td><?php echo $rsstudent1['marital_status']; ?></td>
		</tr>
</table>
			</div>
		</div>	
		
		
		
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Personal details:</h2>
<table class="table table-striped table-bordered">
		<tr>

			<th style="width: 225px;">Father's name</th>
			<th><?php echo $rsstudent1['father_name']; ?></th>
		</tr>
		<tr>
			<th style="width: 225px;">Mother's name</th>
			<td><?php echo $rsstudent1['mother_name']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Date of Birth</th>
			<td><?php echo date("d-M-Y",strtotime($rsstudent1['dob'])); ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Gender</th>
			<td><?php echo $rsstudent1['gender']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Religion</th>
			<td><?php echo $rsstudent1['religion']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Nationality</th>
			<td><?php echo $rsstudent1['nationality']; ?></td>
		</tr>
		<tr>
			<th style="width: 225px;">Marital status</th>
			<td><?php echo $rsstudent1['marital_status']; ?></td>
		</tr>
</table>
			</div>
		</div>	
		
				
		<div class="row bg-white">
			<div class="col-md-12">
				<hr>
			</div>
		</div>
		
		
		<div class="row bg-white">
			<div class="col-md-12">
<h2>Declaration:</h2>
I here solemnly declare and affirm that all statement made in this application is true, complete and correct to
best of my knowledge and belief. I request your pardon to consider my application favorably and give me an
opportunity to serve you better. I assure you to serve well in your esteemed organization to best of my ability.
<br><br>
<b>Regards,</b><br>
<?php echo $rsstudent1['student_name']; ?>
			</div>
		</div>	

		
      </div>
    </section>
	
	
	
    <section class="contact-section bg-light" style="padding-top: 25px; padding-bottom: 25px;">
      <div class="container">

        <div class="row">
          <div class="col-md-12 bg-white" style="padding-top: 15px;">
			<center><h2><input type="button" name="submit" class="btn btn-primary" value="Print" onclick="printDiv('printableArea')"></h2></center>
          </div>
        </div>
		</div>
    </section>
	
<?php
include("footer.php");
?>
<script>
function printDiv(divName) {
     var printContents = document.getElementById(divName).innerHTML;
     var originalContents = document.body.innerHTML;

     document.body.innerHTML = printContents;

     window.print();

     document.body.innerHTML = originalContents;
}
</script>