<?php
//This page created to view student records.. Even this page has delete statement.
include("header.php"); //This will include header statement
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_GET['student_id']))
{
	$sqlstudent ="SELECT * FROM student WHERE student_id='$_GET[student_id]'";
	$qsqlstudent = mysqli_query($con,$sqlstudent);
	$rsstudent = mysqli_fetch_array($qsqlstudent);
	//#### MAIL CODE STARTS HERE
	include("phpmailer.php");
	$subject = "Your CareerPortal account has been approved.";
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
	$msg = "<h2>Dear " . $rsstudent['student_name'] .  ",</h2>Your CareerPortal account  has been approved. You can start using our services after Login..<br>Visit following link, <a href='$url'><b>click here</b></a>
	<br>Or you may open the following link in your browser : $url
	<br> --------------
	<br>Regards<br><b>Career Portal</b>";
	sendmail($rsstudent['email_id'], "Career Portal" , $subject,$msg);
	//#### MAIL CODE STARTS HERE
	//student_id Active
	$sql = "UPDATE student SET status='Active' WHERE student_id='$_GET[student_id]'";
	$qsql = mysqli_query($con,$sql);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Student Account activated successfully..');</script>";		
	}
}
if(isset($_GET['delid'])) // If delid is set then it sends request to delete
{
	$sql = "DELETE  FROM student WHERE student_id='$_GET[delid]'"; // Delete statement to delete student record
	$qsql = mysqli_query($con,$sql); // This mysqli_query executes delete statement.
		echo mysqli_error($con); // This code executes error statement	
	if(mysqli_affected_rows($con) == 1) //Following code will check whether the record deleted or not.  If the record deleted mysqli_affected_rows function will execute if statement
	{
		echo "<script>alert('Student record deleted successfully..');</script>"; //This code will display message after deleting student record.
		echo "<script>window.location='viewstudent.php';</script>"; //This code will redirect to viewstudentpage after deletion.. This will created to refresh the page after deletion.
	}
}
?>
	<section class="bg-light" style="padding-top: 15px;">
			<div class="container">

				<div class="row">

<div class="col-md-12 ftco-animate">
		<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">

		  <div class="mb-12 mb-md-12 mr-12">
		   <div class="job-post-item-header d-flex align-items-center">
			 <h2 class="mr-3 text-black h4">View Student records</h2>
		   </div>
		   <div class="job-post-item-body d-block d-md-flex">

<table id="myTable" class="table table-striped table-bordered" style="width: 1050px;">
	<thead>
		<tr>
			<th>Photo</th>
			<th>Course</th>
			<th>Student name</th>
			<th>Register No.</th>
			<th>Contact Detail</th>	
			<th>DOB</th>
			<th>status</th>
			<th>Action</th>
		</tr>
	</thead>
	<tbody>
	<?php
	$sql ="SELECT student.*,course.course_title FROM student LEFT JOIN course on student.course_id=course.course_id ORDER BY student.student_id DESC"; // This code selects record from student table. Along with student table it retrieves record from course table. In this sql statement student table and course table combined.
	$qsql = mysqli_query($con,$sql); // mysqli_query executes select statement
	while($rs = mysqli_fetch_array($qsql)) // This function will fetch the query execution record in  array format
	{
		if($rs['photo'] == "") // This if statement will check and execute if the photo has empty record or not.
		{
			$img = "images/No-Image-Available.png";
		}
		else if(file_exists('filestudent/'.$rs['photo']))
		{
			$img = 'filestudent/'.$rs['photo'];
		}
		else
		{
			$img = "images/No-Image-Available.png";
		}
		if($rs['id_proof'] == "")
		{
			$img1 = "images/No-Image-Available.png";
		}
		else if(file_exists('filestudent/'.$rs['id_proof']))
		{
			$img1 = 'filestudent/'.$rs['id_proof'];
		}
		else
		{
			$img1 = "images/No-Image-Available.png";
		}		
		if($rs['address_proof'] == "")
		{
			$img2 = "images/No-Image-Available.png";
		}
		else if(file_exists('filestudent/'.$rs['address_proof']))
		{
			$img2 = 'filestudent/'.$rs['address_proof'];
		}
		else
		{
			$img2 = "images/No-Image-Available.png";
		}
		echo "<tr>
				<td><img src='$img' width='100' height='110' ></td>
				<td>$rs[course_title]</td>
				<td>$rs[student_name]</td>
				<td>$rs[register_number]</td>
				<td>$rs[email_id]<br>$rs[contact_no]</td>
			<td>";
			if($rs['dob'] != "0000-00-00")
			{
				echo date("d-M-Y",strtotime($rs['dob']));
			}
		echo "</td>
			<td>$rs[status]";
			if($rs['status'] == "Pending")
			{
		echo "	<hr>
			<a href='viewstudent.php?student_id=$rs[0]&st=Active' class='btn btn-primary' style='width: 85px;'>Activate</a>";
			}			
			echo "</td>
			<td style='width: 75px;'>
				<a href='student.php?editid=$rs[0]' class='btn btn-info' style='width: 85px;' >Edit</a>
				<a href='viewstudent.php?delid=$rs[0]' class='btn btn-danger' onclick='return confirm2delete()' style='width: 85px;'>Delete</a>
				<a href='resumebuilder.php?student_id=$rs[0]' class='btn btn-primary' target='_blank' style='width: 85px;'>Resume</a>
			</td>
			</tr>";
	}
	?>
	</tbody>
</table>

		   </div>
		  </div>
		</div>
</div> <!-- end -->

				</div>
				
			</div>
		</section>

    <?php
	include("footer.php");
	?>
<script>
function confirm2delete()
{
	if(confirm("Are you sure want to delete this record?") == true)
	{
		return true;
	}
	else
	{
		return false;
	}
}
</script>