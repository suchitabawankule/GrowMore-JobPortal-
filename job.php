<?php
//This code will insert job record.
include("header.php");// This code in include header content
if(isset($_POST['submit'])) // The code will whether submit button clicked or not.
{	
	$job_title = mysqli_real_escape_string($con,$_POST['job_title']);
	$job_description = mysqli_real_escape_string($con,$_POST['job_description']);
	$edu_qualification = $_POST['edu_qualification'];
	$arr_edu_qualification = serialize($edu_qualification);
	if(isset($_GET['editid'])) // If editid is set in the URL then the system updates job details.
	{
		//Update statement to update job record..
		$sql ="UPDATE job SET jobcategory_id='$_POST[jobcategory_id]',company_id='$_POST[company_id]',job_title='$job_title',job_description='$job_description',location_id='$_POST[location_id]',publish_date='$_POST[publish_date]',last_date='$_POST[last_date]',industry_type='$_POST[industry_type]',employee_type='$_POST[employee_type]',interview_fdate='$_POST[interview_fdate]',interview_tdate='$_POST[interview_tdate]', edu_qualification='$arr_edu_qualification', status='$_POST[status]'  WHERE job_id='$_GET[editid]'"; // This code will update job record..
		$qsql = mysqli_query($con,$sql); //This code will execute update statement..
		
		// mysqli_affected_rows function will check whether the record updated or not. If the record updated then the if statement will execute.
		if(mysqli_affected_rows($con) == 1) 
		{
			echo "<script>alert('Job record updated successfully..');</script>"; //alert function displays message "Job record updated successfully.."
		}
		else
		{
			echo mysqli_error($con); // If any error in the update statement mysqli_error function displays error reporting.
		}
	}
	else
	{
		//Following Insert statement executes and inserts job record.
     	$sql ="INSERT INTO job(jobcategory_id,company_id,job_title,job_description,location_id,publish_date,last_date,industry_type,employee_type,interview_fdate,interview_tdate,edu_qualification,status) values ('$_POST[jobcategory_id]','$_POST[company_id]','$job_title','$job_description','$_POST[location_id]','$_POST[publish_date]','$_POST[last_date]','$_POST[industry_type]','$_POST[employee_type]','$_POST[interview_fdate]','$_POST[interview_tdate]','$arr_edu_qualification','$_POST[status]')";
		$qsql = mysqli_query($con,$sql); // This mysqli_query executes insert statement
		// mysqli_affected_rows function will check whether the record inserted or not. If the record inserted then the if statement will execute.
		if(mysqli_affected_rows($con) == 1) 
		{
			$sqlcompany = "SELECT * FROM company WHERE company_id='$_POST[company_id]'";
			$qsqlcompany = mysqli_query($con,$sqlcompany);
			$rscompany = mysqli_fetch_array($qsqlcompany);
			$sqllocation = "SELECT * FROM location WHERE location_id='$_POST[company_id]'";
			$qsqllocation = mysqli_query($con,$sqllocation);
			$rslocation= mysqli_fetch_array($qsqllocation);
			//#### MAIL CODE STARTS HERE
				include("phpmailer.php");
				$subject="$rscompany[company_name] is hiring for $job_title";
				$msg = "
				<table style='border: 1px solid #1C6EA4;background-color: #EEEEEE;width: 100%;text-align: left; border-collapse: collapse;'>
				
				<tr>
					<td>
						<h2>$_POST[job_title]</h2>
						<b>Company Name: $rscompany[company_name]</b>
						<p>$job_description</p>
					</td>
				</tr>
				</table><hr>
				<table style='border: 1px solid #1C6EA4;background-color: #EEEEEE;width: 100%;text-align: left; border-collapse: collapse;'>
				<tr>
					<th style='width: 50px;'>Announced on :</th><td> $_POST[publish_date]</td>
				</tr>
				<tr>
					<th>Last Date to Apply : $_POST[last_date]</td>
				</tr>
				<tr>
					<th>Job Location : $rslocation[location]</td>
				</tr>
				<tr>
				<th>Industry type : $_POST[industry_type]</td>
				</tr>
				<tr>
				<th>Employment Type : $_POST[employee_type]</td>
				</tr>
				<tr><th>Interview Date: " . date("d-M-Y",strtotime($_POST['interview_fdate'])) . " - " . date("d-M-Y",strtotime($_POST['interview_tdate'])) . "</td>
				</tr>
				<tr><th>Educational Qualification: $_POST[edu_qualification]</td>
				</tr>
				</table>";
	$mailid= "'noreply@gmail.com'";
	$sql ="SELECT * FROM student WHERE status='Active'"; // This code selects record from student table. Along with student table it retrieves record from course table. In this sql statement student table and course table combined.
	$qsql = mysqli_query($con,$sql); // mysqli_query executes select statement
	while($rs = mysqli_fetch_array($qsql)) // This function will fetch the query execution record in  array format
	{
		//$mailid = $mailid . ",'" .$rs[email_id] ."'";
		sendmail($rs['email_id'], "Career Portal" , $subject,$msg);
	}
		//sendmail($mailid, "Career Portal" , $subject,$msg);
			//#### MAIL CODE ENDS HERE
			
			
			echo "<script>alert('Job record inserted successfully..');</script>";//alert function displays message "Job record inserted successfully.."
			echo "<script>window.location='job.php';</script>"; //After inserting record the page will redirects to job.php. This coding created to clear inserted record.
		}
		else
		{
			echo mysqli_error($con); // If any error in the insert statement mysqli_error function displays error reporting.
		}
	}
}
?>
<?php
if(isset($_GET['editid'])) //The system executes if the system has editid parameter in the URL
{
	$sqledit = "SELECT * FROM job WHERE job_id='$_GET[editid]'"; //This will selected existing record
	$qsqledit = mysqli_query($con,$sqledit); // This will send query execution
	echo mysqli_error($con); // This will display error message...
	$rsedit = mysqli_fetch_array($qsqledit); // This will fetch record from array
}
?>
<style>
.multiselect {
  width: 200px;
}

.selectBox {
  position: relative;
}

.selectBox select {
  width: 100%;
  font-weight: bold;
}

.overSelect {
  position: absolute;
  left: 0;
  right: 0;
  top: 0;
  bottom: 0;
}

#checkboxes {
  display: none;
  border: 1px #dadada solid;
}

#checkboxes label {
  display: block;
}

#checkboxes label:hover {
  background-color: #1e90ff;
}
</style>
<script>
var expanded = false;

function showCheckboxes() {
  var checkboxes = document.getElementById("checkboxes");
  if (!expanded) {
    checkboxes.style.display = "block";
    expanded = true;
  } else {
    checkboxes.style.display = "none";
    expanded = false;
  }
}
</script>
		<section class="ftco-section bg-light"  style="padding-top: 15px;">
			<div class="container">
				<div class="row">
					<div class="col-md-12 ftco-animate">

            <div class="job-post-item bg-white p-4 d-block align-items-center">
<form method="post" action="" onsubmit="return checkerror()">
<div class="mb-4 mb-md-1 mr-12">
	<div class="job-post-item-header d-flex align-items-center">
	  <h2 class="mr-3 text-black h3">Job</h2>
	</div>

<?php
if(isset($_SESSION['company_id']))
{
	echo "<input type='hidden' name='company_id' id='company_id' value='$_SESSION[company_id]'>
	<span class='errmsg flash' id='errcompany_id' style='color: red;'></span>";
}
else
{	
?>
<div class="row p-2" >
	<div class="col-md-3 p-2">Company : </div>
	<div class="col-md-7">
	<select name="company_id" id="company_id" class="form-control" >
		<option value="">Select Company</option>
		<?php
		//This will select location record
		$sqlcompany ="SELECT * FROM  company where status='Active'"; 
		$qsqlcompany = mysqli_query($con,$sqlcompany); // This query executes sql statement
		while($rscompany = mysqli_fetch_array($qsqlcompany)) //This will loop and display location record..
		{
			//This code works while updating record
			if($rscompany['company_id'] == $rsedit['company_id'])
			{
				echo "<option value='$rscompany[company_id]' selected>$rscompany[company_name]</option>";
			}
			else
			{
				echo "<option value='$rscompany[company_id]'>$rscompany[company_name]</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errcompany_id" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>
<?php
}
?>

<div class="row p-2" >
	<div class="col-md-3 p-2">Job title : </div>
	<div class="col-md-7"><input type="text" name="job_title" id="job_title" class="form-control" value="<?php echo $rsedit['job_title'] ?>"  >
	<span class="errmsg flash" id="errjob_title" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Job Category : </div>
	<div class="col-md-7">
	<select name="jobcategory_id" id="jobcategory_id" class="form-control" >
		<option value="">Select Job Category</option>
		<?php
		//This will select location record
		$sqljob_category ="SELECT * FROM  job_category where status='Active'"; 
		$qsqljob_category = mysqli_query($con,$sqljob_category); // This query executes sql statement
		while($rsjob_category = mysqli_fetch_array($qsqljob_category)) //This will loop and display location record..
		{
			//This code works while updating record
			if($rsjob_category['jobcategory_id'] == $rsedit['jobcategory_id'])
			{
				echo "<option value='$rsjob_category[jobcategory_id]' selected>$rsjob_category[job_category]</option>";
			}
			else
			{
				echo "<option value='$rsjob_category[jobcategory_id]'>$rsjob_category[job_category]</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errjobcategory_id" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Job description : </div>
	<div class="col-md-7"><textarea name="job_description" id="job_description" class="form-control" ><?php echo $rsedit['job_description'] ?></textarea>
	<span class="errmsg flash" id="errjob_description" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Location : </div>
	<div class="col-md-7">
	<select name="location_id" id="location_id" class="form-control" >
		<option value="">Select Location</option>
		<?php
		//This will select location record
		$sqllocation ="SELECT * FROM  location where status='Active'"; 
		$qsqllocation = mysqli_query($con,$sqllocation); // This query executes sql statement
		while($rslocation = mysqli_fetch_array($qsqllocation)) //This will loop and display location record..
		{
			//This code works while updating record
			if($rslocation['location_id'] == $rsedit['location_id'])
			{
				echo "<option value='$rslocation[location_id]' selected>$rslocation[location]</option>";
			}
			else
			{
				echo "<option value='$rslocation[location_id]'>$rslocation[location]</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errlocation_id" style="color: red;"></span>
</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Publish Date : </div>
	<div class="col-md-7"><input type="date" name="publish_date" id="publish_date" class="form-control" value="<?php echo $rsedit['publish_date'] ?>" min="<?php echo date("Y-m-d"); ?>" >
	<span class="errmsg flash" id="errpublish_date" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Last Date : </div>
	<div class="col-md-7"><input type="date" name="last_date" id="last_date" class="form-control" value="<?php echo $rsedit['last_date'] ?>"  >
	<span class="errmsg flash" id="errlast_date" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Industry type : </div>
	<div class="col-md-7">
	<select name="industry_type" id="industry_type"  class="form-control" >
		<option value="">Select Industry type</option>
		<?php
		//This array variable stores various types of industry record..
		$arr = array("Accounting / Finance / Tax / CS / Audit","Web / Graphic Design / Visualiser","Production / Maintenance / Quality","IT Software - E-Commerce / Internet Technologies","Engineering Design / R&D","Banking / Insurance","IT- Hardware / Telecom / Technical Staff / Support","Site Engineering / Project Management","Pharma / Biotech / Healthcare / Medical / R&D","Top Management","IT Software - Other","IT Software - Mobile","IT Software - System Programming","IT Software - ERP / CRM","IT Software - QA & Testing","Hotels / Restaurants","Purchase / Logistics / Supply Chain","Teaching / Education","Secretary / Front Office / Data Entry","Analytics & Business Intelligence","IT Software - DBA / Datawarehousing","Content / Journalism","IT Software - Network Administration / Security","Self Employed / Consultants","Ticketing / Travel / Airlines","IT Software - Client Server","Architecture / Interior Design","Corporate Planning / Consulting","Export / Import / Merchandising","IT Software - Embedded / EDA / VLSI / ASIC / Chip Des.","Fashion / Garments / Merchandising","Legal","IT Software - Telecom Software","IT Software - Mainframe","Packaging","IT Software - Middleware","Guards / Security Services","TV / Films / Production","IT Software - Systems / EDP / MIS","Shipping","Agent","Others");
		foreach($arr as $value)
		{
			//This code works while updating record
			if($value == $rsedit['industry_type'])
			{
			echo "<option value='$value' selected>$value</option>"; //This code will display selected record
			}
			else
			{
			echo "<option value='$value'>$value</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="errindustry_type" style="color: red;"></span>
	</div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Employment type : </div>
	<div class="col-md-7">
	<select name="employee_type" id="employee_type"  class="form-control" >
		<option value="">Select Employment type</option>
		<?php
		//This array variable stores various types of  Employment type..
		$arr = array("Permanent/Fixed-term","Casual employees","Apprentices/trainees","Employment agency staff","Contractors/sub-contractors","Others");
		foreach($arr as $value)
		{
			if($value == $rsedit['employee_type'])
			{
			echo "<option value='$value' selected>$value</option>"; //This code will display selected record
			}
			else
			{
			echo "<option value='$value'>$value</option>";
			}
		}
		?>
	</select>
	<span class="errmsg flash" id="erremployee_type" style="color: red;"></span>
</div>
	<div class="col-md-2 p-2"></div>
</div>


<div class="row p-2" >
	<div class="col-md-3 p-2">Interview Date - From: </div>
	<div class="col-md-7"><input type="date" name="interview_fdate" id="interview_fdate" class="form-control" value="<?php echo $rsedit['interview_fdate'] ?>" min="<?php date("Y-m-d"); ?>" >
	<span class="errmsg flash" id="errinterview_fdate" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Interview Date - To: </div>
	<div class="col-md-7"><input type="date" name="interview_tdate" id="interview_tdate" class="form-control" value="<?php echo $rsedit['interview_tdate'] ?>" min="<?php date("Y-m-d"); ?>" >
	<span class="errmsg flash" id="errinterview_tdate" style="color: red;"></span></div>
	<div class="col-md-2 p-2"></div>
</div>

<div class="row p-2" >
	<div class="col-md-3 p-2">Educational qualification: </div>
	<div class="col-md-7">
	<?php /*
	<textarea name="edu_qualification" id="edu_qualification" class="form-control" ><?php echo $rsedit['edu_qualification'] ?></textarea>
	*/ ?>
	
  <div class="multiselect">
    <div class="selectBox" onclick="showCheckboxes()">
      <select  class="form-control">
        <option>Select an option</option>
      </select>
      <div class="overSelect"></div>
    </div>
    <div id="checkboxes">
		<?php
		$arredu_qualification = unserialize($rsedit['edu_qualification']);
		$sqlcourse ="SELECT * FROM course where status='Active'";
		$qsqlcourse = mysqli_query($con,$sqlcourse);
		while($rscourse = mysqli_fetch_array($qsqlcourse))
		{
			if(isset($_GET['editid'])) //The system executes if the system has editid parameter in the URL
			{
				if(in_array($rscourse['course_id'], $arredu_qualification))
				{
					echo "<label for='one'> &nbsp; <input type='checkbox' name='edu_qualification[]' id='edu_qualification[]' value='$rscourse[course_id]' checked /> " . strtoupper($rscourse['course_title']) . "</label>";
					
				}
				else
				{
					echo "<label for='one'> &nbsp; <input type='checkbox' name='edu_qualification[]' id='edu_qualification[]' value='$rscourse[course_id]' /> " . strtoupper($rscourse['course_title']) . "</label>";
				}
			}
			else
			{
					echo "<label for='one'> &nbsp; <input type='checkbox' name='edu_qualification[]' id='edu_qualification[]' value='$rscourse[course_id]' /> " . strtoupper($rscourse['course_title']) . "</label>";
			}
		}
		?>
    </div>
  </div>
	<span class="errmsg flash" id="erredu_qualification" style="color: red;"></span>
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
			echo "<option value='$value' selected>$value</option>"; //This code will display selected record
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
include("footer.php"); // This code displays footer record...
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
	if(document.getElementById("company_id").value == "")
	{
		document.getElementById("errcompany_id").innerHTML="Kindly select the company..";
		errchk = "True";
	}
	if(document.getElementById("job_title").value == "")
	{
		document.getElementById("errjob_title").innerHTML="Job Title Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("jobcategory_id").value == "")
	{
		document.getElementById("errjobcategory_id").innerHTML="Kindly select the Job category..";
		errchk = "True";
	}
	if(document.getElementById("job_description").value == "")
	{
		document.getElementById("errjob_description").innerHTML="Job Description Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("location_id").value == "")
	{
		document.getElementById("errlocation_id").innerHTML="Kindly select the location..";
		errchk = "True";
	}
	if(document.getElementById("publish_date").value == "")
	{
		document.getElementById("errpublish_date").innerHTML="Kindly select the Job publish date..";
		errchk = "True";
	}
	if(document.getElementById("interview_tdate").value == "")
	{
		document.getElementById("errinterview_tdate").innerHTML="Kindly select the Interview date..";
		errchk = "True";
	}
	if(document.getElementById("last_date").value == "")
	{
		document.getElementById("errlast_date").innerHTML="Kindly select the Last date..";
		errchk = "True";
	}
	if(document.getElementById("employee_type").value == "")
	{
		document.getElementById("erremployee_type").innerHTML="Education Qualification Should not be empty..";
		errchk = "True";
	} 
	if(document.getElementById("interview_fdate").value == "")
	{
		document.getElementById("errinterview_fdate").innerHTML="Interview Date From - Should not be empty..";
		errchk = "True";
	}  
	if(document.getElementById("interview_tdate").value == "")
	{
		document.getElementById("errinterview_tdate").innerHTML="Interview till date should not be empty..";
		errchk = "True";
	} 
	if(document.getElementById("edu_qualification").value == "")
	{
		document.getElementById("erredu_qualification").innerHTML="Education Qualification Should not be empty..";
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