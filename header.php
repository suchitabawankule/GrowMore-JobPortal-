<?php
//In this page student registration code allows student to register a website. Even it allows students and administrator to login the website. This header page creates session for student and administrator. 
session_start(); //session_start() function used to define session varaiable. Using session variable user can Login or Logout to the system.
error_reporting(E_ALL & ~E_NOTICE  &  ~E_STRICT  &  ~E_WARNING);
include("dbconnection.php"); //Include function used to connect database. this function will connect to the database.
$dt = date("Y-m-d");
//isset function will check btnregister button clicked or not.
if(isset($_POST['btnregister']))
{
	//This statement inserts student registration profile details.
	$sql ="INSERT INTO student(student_name,register_number,password,course_id,email_id,contact_no,status) values ('$_POST[stnameid]','$_POST[stregisternumber]','$_POST[stapassword]','$_POST[stcourse]','$_POST[stemailid]','$_POST[stcontactnumberid]','Pending')";
	$qsql = mysqli_query($con,$sql); // mysqli_query executes insert statement.
	if(mysqli_affected_rows($con) == 1) // This code will check whether student record inserted or not. 
	{
		echo "<script>alert('Student Registration done successfully..');</script>"; //if the record inserted the system displays message "Student Registration done successfully."
		echo "<script>window.location='index.php';</script>"; // AFter the registration the page redirects to index.php
	}
	else
	{
		echo "<script>alert('You have already registered....');</script>";
	}
}
if(isset($_POST["btnstudentlogin"])) //This isset function will check btnstudentlogin button clicked or not.
{
	//This code will check whether entered logged in is valid or not. If entered logged in is valid then the page redirects to student account.
	$sql ="SELECT * FROM student WHERE register_number='$_POST[stloginid]' AND password='$_POST[stpassword]' AND status='Active'"; // System checks whether entered registration number and password is valid or not.
	$qsql = mysqli_query($con,$sql); // Mysqli query executes select statement.
	if(mysqli_num_rows($qsql) == 1) // If login is valid mysqli_num_rows counts 1 and redirects to account page.
	{
		$rsstudent = mysqli_fetch_array($qsql); // This fetches array value and stores in rsstudent variable.
		$_SESSION['student_id'] = $rsstudent['student_id']; //This stores session value student_id
		echo "<script>window.location='studentaccount.php';</script>"; //This is the javascript link which redirects to student account page.
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials.');</script>"; //If the login credentials not valid then the system displays alert message "You have entered invalid login credentials."
		echo "<script>window.location='index.php';</script>"; 
	}
}

if(isset($_POST["btnstafflogin"]))//This isset function will check btnstafflogin button clicked or not.
{
	//This code will check whether entered logged in is valid or not. If entered logged in is valid then the page redirects to Dashboard.
	$sql ="SELECT * FROM admin WHERE login_id='$_POST[staffloginid]' AND password='$_POST[staffpassword]' AND status='Active'";// System checks whether entered  admin or employee Login ID and password is valid or not.
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rsadmin = mysqli_fetch_array($qsql);// This fetches array value and stores in rsstudent variable.
		$_SESSION['admin_id'] = $rsadmin['admin_id']; //This stores session value student_id
		echo "<script>window.location='dashboard.php';</script>"; //This is the javascript link which redirects to dashboard page.
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials.');</script>"; //If the login credentials not valid then the system displays alert message "You have entered invalid login credentials."
		echo "<script>window.location='index.php';</script>"; 
	}
}

if(isset($_POST["btncompanylogin"]))//This isset function will check btncompanylogin button clicked or not.
{
	//This code will check whether entered logged in is valid or not. If entered logged in is valid then the page redirects to Company Account.
	$sql ="SELECT * FROM company WHERE email_id='$_POST[comploginid]' AND password='$_POST[comppassword]' AND status='Active'";// System checks whether entered  Company email and password is valid or not.
	$qsql = mysqli_query($con,$sql);
	if(mysqli_num_rows($qsql) == 1)
	{
		$rscompany = mysqli_fetch_array($qsql);// This fetches array value and stores in rscompany variable.
		$_SESSION['company_id'] = $rscompany['company_id'];//This stores session value company_id
		echo "<script>window.location='companypanel.php';</script>";//This is the javascript link which redirects to company panel page.
	}
	else
	{
		echo "<script>alert('You have entered invalid login credentials.');</script>";//If the login credentials not valid then the system displays alert message "You have entered invalid login credentials."
		echo "<script>window.location='index.php';</script>"; 
	}
}
if(isset($_POST["btnstudentreset"]))
{
	$_SESSION['studentreset'] = rand(100001,999999);
	$sqlstudent ="SELECT * FROM student WHERE register_number='$_POST[strecoveryloginid]'";
	$qsqlstudent = mysqli_query($con,$sqlstudent);
	$rsstudent = mysqli_fetch_array($qsqlstudent);
	//#### MAIL CODE STARTS HERE
	include("phpmailer.php");
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?studentid=".$rsstudent[0]."&resetcode=".$_SESSION['studentreset'];
	$subject="Career Portal - Password Reset Request";
	$msg = "<h2>Password Reset:</h2><br>To reset your password, <a href='$url'><b>click here</b></a>
	<br>Or you may open the following link in your browser : $url
	<br> --------------
	<br><b>Career Portal</b>";
	sendmail($rsstudent['email_id'], "Career Portal" , $subject,$msg);
	echo "<script>alert('Password recovery mail sent successfully...');</script>";
	//echo "<script>window.location='index.php';</script>";
	//#### MAIL CODE ENDS HERE
}
if(isset($_POST["btncompanyreset"]))
{
	$_SESSION['companyresetcode'] = rand(100001,999999);
	$sqlcompany ="SELECT * FROM company WHERE email_id='$_POST[resetemailid]' AND status='Active'";
	$qsqlcompany = mysqli_query($con,$sqlcompany);
	$rscompany = mysqli_fetch_array($qsqlcompany);
	//#### MAIL CODE STARTS HERE
	include("phpmailer.php");
	$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
	$url = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . "?company_id=".$rscompany[0]."&companyresetcode=".$_SESSION['companyresetcode'];
	$subject="Career Portal - Password Reset Request...";
	$msg = "<h2>Password Reset:</h2><br>To reset your password, <a href='$url'><b>click here</b></a>
	<br>Or you may open the following link in your browser : $url
	<br> --------------
	<br><b>Career Portal</b>";
	sendmail($rscompany['email_id'], "Career Portal" , $subject,$msg);
	echo "<script>alert('Company password recovery mail sent successfully...');</script>";
	echo "<script>window.location='index.php';</script>";
	//#### MAIL CODE ENDS HERE
}

if(isset($_POST['csubmit']))
{
	$filelogo = rand() . $_FILES['clogo']['name'];
	move_uploaded_file($_FILES['clogo']['tmp_name'], "filecompany/" . $filelogo);
	$company_description = mysqli_real_escape_string($con,$_POST['company_description']);
	$sql ="INSERT INTO company(company_name,logo,address,email_id,phone_no,company_description,status,password) values ('$_POST[ccompany_name]','$filelogo','$_POST[caddress]','$_POST[cemail_id]','$_POST[cphone_no]','$company_description','Pending','$_POST[cpassword]')";
	$qsql = mysqli_query($con,$sql);
	echo mysqli_error($con);
	if(mysqli_affected_rows($con) == 1)
	{
		echo "<script>alert('Company Registration Done successfully...');</script>";
		echo "<script>window.location='index.php';</script>";
	}
}

//This will retrieve records from student profile - STARTS HERE
if(isset($_SESSION['student_id']))
{
	$sqlstudent ="SELECT * FROM student WHERE student_id='$_SESSION[student_id]'";
	$qsqlstudent = mysqli_query($con,$sqlstudent);
	$rsstudent = mysqli_fetch_array($qsqlstudent);
}
//This will retrieve records from student profile - ENDS HERE
//This will retrieve records from admin profile - STARTS HERE
if(isset($_SESSION['admin_id']))
{
	$sqladmin ="SELECT * FROM admin WHERE admin_id='$_SESSION[admin_id]'";
	$qsqladmin = mysqli_query($con,$sqladmin);
	$rsadmin= mysqli_fetch_array($qsqladmin);
}
//This will retrieve records from admin profile - ENDS HERE
//This will retrieve records from company profile - STARTS HERE
if(isset($_SESSION['company_id']))
{
	$sqlcompany ="SELECT * FROM company WHERE company_id='$_SESSION[company_id]'";
	$qsqlcompany = mysqli_query($con,$sqlcompany);
	$rscompany = mysqli_fetch_array($qsqlcompany);
}
//This will retrieve records from company profile - ENDS HERE
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>GROWMORE A JOB PORTAL </title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

<!-- Website Template Design Starts here -->
    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:200,300,400,600,700,800,900" rel="stylesheet">	
    <link rel="stylesheet" href="css/open-iconic-bootstrap.min.css">
    <link rel="stylesheet" href="css/animate.css">    
    <link rel="stylesheet" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/owl.theme.default.min.css">
    <link rel="stylesheet" href="css/magnific-popup.css">
    <link rel="stylesheet" href="css/aos.css">
    <link rel="stylesheet" href="css/ionicons.min.css">
    <link rel="stylesheet" href="css/bootstrap-datepicker.css">
    <link rel="stylesheet" href="css/jquery.timepicker.css">    
    <link rel="stylesheet" href="css/flaticon.css">
    <link rel="stylesheet" href="css/icomoon.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/jquery.dataTables.min.css">	
<style>
@import "compass/css3";

/*Be sure to look into browser prefixes for keyframes and annimations*/
.flash {
   animation-name: flash;
    animation-duration: 0.2s;
    animation-timing-function: linear;
    animation-iteration-count: infinite;
    animation-direction: alternate;
    animation-play-state: running;
}

@keyframes flash {
    from {color: red;}
    to {color: black;}
}

.errmsg
{
	/*display: none;*/
}
</style>
<!-- Website Template Design Ends here -->

  </head>
  <body>

<?php
if(isset($_SESSION['admin_id']) || isset($_SESSION['company_id']) || isset($_SESSION['student_id']))
{
?>  
<nav class="navbar navbar-expand-lg navbar-light bg-light"  style="top: 0px;background: #ffffff !important;">
  <a class="navbar-brand" href="index.php">GROWMORE A JOB PORTAL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
	<?php
if(isset($_SESSION['admin_id']))
{
	//Administrator Menu starts here
	?>
      <li class="nav-item  border">
        <a class="nav-link" href="dashboard.php">Dashboard</a>
      </li>
	  <li class="nav-item dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Job listings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="job.php">Add New Job</a>
          <a class="dropdown-item" href="viewjob.php">View Job listings</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="company.php">Add Company</a>
          <a class="dropdown-item" href="viewcompany.php">View Company</a>
        </div>
      </li>
	  <li class="nav-item dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Job Applications
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="viewjobapplication.php">View Job Applications</a>
          <a class="dropdown-item" href="viewjobapplication.php?status=Selected">View Selected candidates</a>
        </div>
      </li>
      <li class="nav-item dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Training Materials
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="training_material.php?material_type=Docs">Training Material (Docs)</a>
          <a class="dropdown-item" href="./displaytrainingmaterial.php">Training Material (Video)</a>
          <a class="dropdown-item" href="training_material.php?material_type=Audio">Training Material (Audio)</a>
          <a class="dropdown-item" href="training_material.php?material_type=Photo Slider">Training Material (Photo Slider)</a>
          <a class="dropdown-item" href="training_material.php?material_type=Others">Training Material (Others)</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="viewtraining_material.php?material_type=Docs">View Training Material (Docs)</a>
          <a class="dropdown-item" href="viewtraining_material.php?material_type=Video">View Training Material (Video)</a>
          <a class="dropdown-item" href="viewtraining_material.php?material_type=Audio">View Training Material (Audio)</a>
          <a class="dropdown-item" href="viewtraining_material.php?material_type=Photo Slider">View Training Material (Photo Slider)</a>
          <a class="dropdown-item" href="viewtraining_material.php?material_type=Others">View Training Material (Others)</a>
        </div>
      </li>
      <li class="nav-item dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         User
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="student.php">Add User</a>
          <a class="dropdown-item" href="viewstudent.php">View Users</a>
        </div>
      </li>
<?php
if($rsadmin['admin_type'] == "Administrator")
{
?>
<li class="nav-item dropdown  border">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Admins
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	  <a class="dropdown-item" href="admin.php">Add Admin</a>
	  <a class="dropdown-item" href="viewadmin.php">View Admins</a>
	</div>
</li>
      <li class="nav-item dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
         Settings
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="location.php">Add Job Location</a>
          <a class="dropdown-item" href="viewlocation.php">View Job Location</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="job_category.php">Add Job Category</a>
          <a class="dropdown-item" href="viewjobcategory.php">View Job Category</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="course.php">Add Course</a>
          <a class="dropdown-item" href="viewcourse.php">View Course</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="mailsetting.php">Email Settings</a>
        </div>
      </li>
<?php
}
?>
   <?php
   //Administrator Menu Ends here
}
if(isset($_SESSION['company_id']))
{
	//Company Menu starts here
	?>
      <li class="nav-item active border">
        <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item active dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Jobs Listing
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="job.php">Post Job</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="viewjob.php">View Jobs</a>
        </div>
      </li>
	  <li class="nav-item active dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Job Applications
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="viewjobapplication.php">View Job Applications</a>
          <a class="dropdown-item" href="viewjobapplication.php?status=Selected">View Selected candidates</a>
        </div>
      </li>
   <?php
}
if(isset($_SESSION['student_id']))
{
	?>
  <li class="nav-item active border">
	<a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
  </li>
  
  <li class="nav-item active dropdown border">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Jobs List
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<a class='dropdown-item' href='joblistings.php?jobcategory=JobCategory'>Jobs By Category</a>
		<a class='dropdown-item' href='joblistings.php?jobcategory=JobLocation'>Jobs By Location</a>	  
	</div>
  </li>
	  
  <li class="nav-item active dropdown border">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  Training Materials
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		<a class="dropdown-item" href="displaytrainingmaterial.php?material_type=Docs&presentationtype=Docs Training Materials">Docs Training Materials</a>
		<a class="dropdown-item" href="displaytrainingmaterial.php?material_type=Video&presentationtype=Video Training Materials">Video Training Materials</a>
		<a class="dropdown-item" href="displaytrainingmaterial.php?material_type=Audio&presentationtype=Audio Training Materials">Audio Training Materials</a>
		<a class="dropdown-item" href="displaytrainingmaterial.php?material_type=Photo Slider&presentationtype=Presentation Training Materials">Presentation Training Material</a>
		<a class="dropdown-item" href="displaytrainingmaterial.php?material_type=Others&presentationtype=Training Materials - Others">Other Training Material</a>
	</div>
  </li>
  
  
  
	  <li class="nav-item active dropdown border">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Job Applications
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="viewjobapplication.php">View Job Applications</a>
          <a class="dropdown-item" href="viewjobapplication.php?status=Selected">View Selected candidates</a>
        </div>
      </li>
<?php
	//Company Menu Ends here
}
	?>
	</ul>
    <form class="form-inline my-2 my-lg-0">
    <ul class="navbar-nav mr-auto">

<?php
if(isset($_SESSION['admin_id']))
{
	//Admin Profile Menu starts here
?>
<li class="nav-item dropdown active border">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  My Profile
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	  <a class="dropdown-item" href="adminprofile.php">Edit Profile</a>
	  <a class="dropdown-item" href="adminchangepassword.php">Change Password</a>
	</div>
</li>
<?php
	//Admin Profile Menu Ends here
}
if(isset($_SESSION['company_id']))
{
	//Company Profile Menu starts here
?>
  <li class="nav-item active border">
	<a class="nav-link" href="companypanel.php">Company panel <span class="sr-only">(current)</span></a>
  </li>
<li class="nav-item dropdown active border">
	<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	  My Profile
	</a>
	<div class="dropdown-menu" aria-labelledby="navbarDropdown">
	  <a class="dropdown-item" href="companyprofile.php">Edit Profile</a>
	  <div class="dropdown-divider"></div>
	  <a class="dropdown-item" href="companychangepassword.php">Change Password</a>
	</div>
</li>
<?php
	//Company Profile Menu Ends here
}
if(isset($_SESSION['student_id']))
{
	//Student Profile Menu starts here
?>
	<li class="nav-item active border">
		<a class="nav-link" href="studentaccount.php">My Account <span class="sr-only">(current)</span></a>
	</li>
	<li class="nav-item dropdown active border">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  Resume Builder
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item" href="certification.php">Add Certification</a>
		  <a class="dropdown-item" href="viewcertification.php">View Certification</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="computerskill.php">Computer Skills</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="education_qualification.php">Add Educational Qualification</a>
		  <a class="dropdown-item" href="vieweducation.php">View Educational Qualification</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="other_activities.php">Add Other Activities</a>
		  <a class="dropdown-item" href="viewotheractivities.php">View Other Activities</a>
		</div>
	</li>
	<li class="nav-item dropdown active border">
		<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		  My Profile
		</a>
		<div class="dropdown-menu" aria-labelledby="navbarDropdown">
		  <a class="dropdown-item" href="studentprofile.php">Edit Profile</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="studentchangepassword.php">Change Password</a>
		  <div class="dropdown-divider"></div>
		  <a class="dropdown-item" href="resumebuilder.php?student_id=<?php echo $_SESSION['student_id']; ?>">Resume Preview</a>
		</div>
	</li>
<?php
	//Student Profile Menu ends here
}
?>
	  
      <li class="nav-item active border">
        <a class="nav-link" href="logout.php">Logout</a>
      </li>
    </ul>
    </form>
  </div>
</nav>
<?php
}
else
{
?>
<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
<div class="container">
  <a class="navbar-brand" href="index.php">GROWMORE A JOB PORTAL</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav" aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
	<span class="oi oi-menu"></span> Menu
  </button>

  <div class="collapse navbar-collapse" id="ftco-nav">
	<ul class="navbar-nav ml-auto">
	  <li class="nav-item active"><a href="index.php" class="nav-link">Home</a></li>
	  <li class="nav-item"><a href="about.php" class="nav-link">About</a></li>
	  <?php /*<li class="nav-item"><a href="#" class="nav-link">Training material</a></li> */ ?>
	  <li class="nav-item"><a href="contact.php" class="nav-link">Contact</a></li>
	  
<?php
if(isset($_SESSION['company_id']))			  
{
	//Company Account Logout Menu starts here
?>
<li class="nav-item cta mr-md-2"><a href="companypanel.php" class="nav-link">Account</a></li>
<li class="nav-item cta cta-colored"><a href="logout.php" class="nav-link"  >Logout</a></li>
<?php
	//Company Account Logout Menu ends here
}
else if(isset($_SESSION['student_id']))			  
{
	//student Account Logout Menu ends here
?>
<li class="nav-item cta mr-md-2"><a href="studentaccount.php" class="nav-link">Account</a></li>
<li class="nav-item cta cta-colored"><a href="logout.php" class="nav-link"  >Logout</a></li>
<?php
	//student Account Logout Menu ends here
}
else if(isset($_SESSION['admin_id']))			  
{
	//admin Account Logout Menu ends here
?>
<li class="nav-item cta mr-md-2"><a href="dashboard.php" class="nav-link">Account</a></li>
<li class="nav-item cta cta-colored"><a href="logout.php" class="nav-link"  >Logout</a></li>
<?php
	//admin Account Logout Menu ends here
}
else
{
	//Student Account Logout Menu ends here
?>
	  <li class="nav-item cta mr-md-2"><a href="" onclick="return false;" class="nav-link"  data-toggle="modal" data-target="#StudentLoginModal">Login</a></li>
	  
	  <li class="nav-item cta cta-colored"><a href="" onclick="return false;" class="nav-link"  data-toggle="modal" data-target="#StudentRegisterModal">Register</a></li>
<?php
	//Student Account Logout Menu ends here
}
?>
	</ul>
  </div>
</div>
</nav>
<?php
}
?>
<!-- END nav -->
    
<?php
if(basename($_SERVER['PHP_SELF']) == "index.php" || basename($_SERVER['PHP_SELF']) == "about.php" || basename($_SERVER['PHP_SELF']) == "contact.php")
{
?>	
    <div class="hero-wrap js-fullheight" style="background-image: url('images/bg_2.jpg');" data-stellar-background-ratio="0.5">
		<?php
		if(!isset($_SESSION['admin_id']) && !isset($_SESSION['company_id']) && !isset($_SESSION['student_id']))
		{
		?>
      <div class="overlay"></div>
		<?php
		}
		?>
      <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center justify-content-start" data-scrollax-parent="true">
          <div class="col-xl-10 ftco-animate mb-5 pb-5" data-scrollax=" properties: { translateY: '70%' }">
          	<p class="mb-4 mt-5 pt-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">We have <span class="number" data-number="<?php 
$sqljob = "SELECT * FROM job LEFT JOIN job_category on job_category.jobcategory_id=job.jobcategory_id LEFT JOIN location on location.location_id=job.location_id left join company ON company.company_id=job.company_id WHERE job.status='Active' order by job_id DESC LIMIT 10";
$qsqljob = mysqli_query($con,$sqljob);
echo mysqli_num_rows($qsqljob);
			?>">0</span> great job offers you deserve!</p>
            <h1  class="mb-5" data-scrollax="properties: { translateY: '30%', opacity: 1.6 }">SPACE FOR <br><span>PROFESSIONALS</span></h1>

						<div class="ftco-search">
							<div class="row">
		            <div class="col-md-12 nav-link-wrap">
			            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
			              <a class="nav-link active mr-md-1" id="v-pills-1-tab" data-toggle="pill" href="#v-pills-1" role="tab" aria-controls="v-pills-1" aria-selected="true">Find a Job</a>
<?php
/*
			              <a class="nav-link" id="v-pills-2-tab" data-toggle="pill" href="#v-pills-2" role="tab" aria-controls="v-pills-2" aria-selected="false">Find a Candidate</a>
*/
?>
			            </div>
			          </div>
			          <div class="col-md-12 tab-wrap">
			            
			            <div class="tab-content p-4" id="v-pills-tabContent">

			              <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
			              	<form action="jobsearchresult.php" method="get" class="search-job">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
				              					<div class="icon"><span class="icon-briefcase"></span></div>
								                <input type="text" class="form-control" placeholder="eg. Web Developer">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="select-wrap">
						                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                      <select name="jobcategory_id" id="jobcategory_id" class="form-control">
						                      	<option value="">Select Category</option>
<?php
$sqljob_category ="SELECT *, (SELECT COUNT(*) from job where jobcategory_id=job_category.jobcategory_id) AS jobcount FROM job_category WHERE status='Active'";
$qsqljob_category = mysqli_query($con,$sqljob_category);
echo mysqli_error($con);
while($rsjob_category = mysqli_fetch_array($qsqljob_category))
{
?>
<option value="<?php echo $rsjob_category[0]; ?>"><?php echo $rsjob_category['job_category']; ?></option>
<?php
}
?>
						                      </select>
						                    </div>
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="icon"><span class="icon-map-marker"></span></div>

<select name="location_id" id="location_id" class="form-control">
	<option value="">Select location</option>
	<?php
	$sqllocation ="SELECT * FROM location WHERE status='Active'";
	$qsqllocation = mysqli_query($con,$sqllocation);
	echo mysqli_error($con);
	while($rslocation = mysqli_fetch_array($qsqllocation))
	{
	?>
	<option value="<?php echo $rslocation['location_id']; ?>"><?php echo $rslocation['location']; ?></option>
	<?php
	}
	?>
</select>
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Search" class="form-control btn btn-primary">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>
<?php
/*
			              <div class="tab-pane fade" id="v-pills-2" role="tabpanel" aria-labelledby="v-pills-performance-tab">
			              	<form action="#" class="search-job">
			              		<div class="row">
			              			<div class="col-md">
			              				<div class="form-group">
				              				<div class="form-field">
				              					<div class="icon"><span class="icon-user"></span></div>
								                <input type="text" class="form-control" placeholder="eg. Adam Scott">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="select-wrap">
						                      <div class="icon"><span class="ion-ios-arrow-down"></span></div>
						                      <select name="" id="" class="form-control">
	<?php
$sqljob_category ="SELECT *, (SELECT COUNT(*) from job where jobcategory_id=job_category.jobcategory_id) AS jobcount FROM job_category WHERE status='Active'";
$qsqljob_category = mysqli_query($con,$sqljob_category);
echo mysqli_error($con);
while($rsjob_category = mysqli_fetch_array($qsqljob_category))
{
?>
	<div class="col-md-3 ftco-animate">
		<ul class="category">
			<li><a href="#"><?php echo $rsjob_category['job_category']; ?> <span class="number" data-number="<?php echo $rsjob_category['jobcount']; ?>">jobcount</span></a></li>
		</ul>
	</div>
<?php
}
?>
						                      </select>
						                    </div>
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
				              					<div class="icon"><span class="icon-map-marker"></span></div>
								                <input type="text" class="form-control" placeholder="Location">
								              </div>
							              </div>
			              			</div>
			              			<div class="col-md">
			              				<div class="form-group">
			              					<div class="form-field">
								                <input type="submit" value="Search" class="form-control btn btn-primary">
								              </div>
							              </div>
			              			</div>
			              		</div>
			              	</form>
			              </div>
*/
?>
						</div>
			          </div>
			        </div>
		        </div>
          </div>
        </div>
      </div>
    </div>
<?php
}
else
{
	/*
?>
	 <div class="hero-wrap" style="background-image: url('images/bg_3.jpg'); height: 125px;" data-stellar-background-ratio="0.5">
    </div>
<?php
	*/
}
?>