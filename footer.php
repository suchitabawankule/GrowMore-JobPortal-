<?php
//This page has Administrator Login Form and Customer Login Form.
?>
    <footer class="ftco-footer ftco-bg-dark ftco-section">
      <div class="container">
        <div class="row mb-5">
        	<div class="col-md">
             <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">About</h2>
              <p>Government Residential Women's Polytechnic, Yavatmal was established in 1994 with a primary aim to impart Technical Education exclusively to girls. From Jun 2018, the institute is known as Government Polytechnic Yavatmal with the admissions open for both boys and girls.</p>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
              <h2 class="ftco-heading-2">More Links</h2>
              <ul class="list-unstyled">
                <li><a href="http://gpyavatmal.ac.in/gpy/" class="py-2 d-block">Our College Website</a></li>
                <li><a href="https://www.google.com/maps?q=gramin+polytechnic+vishnupuri+nanded&rlz=1C1GCEA_enIN992IN992&um=1&ie=UTF-8&sa=X&ved=2ahUKEwihsYWmxNf3AhXqgf0HHc38A1oQ_AUoAXoECAIQAw" class="py-2 d-block">Find Us on Maps</a></li>
                <li><a href="https://wa.link/8a49o5" class="py-2 d-block">Chat With Us</a></li>
				<li><a href="https://t.me/growmorecommunity" class="py-2 d-block">Join Our Community</a></li>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4 ml-md-4">
              <h2 class="ftco-heading-2">Staff / Company</h2>
              <ul class="list-unstyled">
				<?php
				if(!isset($_SESSION['admin_id']) && !isset($_SESSION['company_id']) && !isset($_SESSION['student_id']))
				{
				?>
                <li><a href="" onclick="return false;"  class="py-2 d-block" data-toggle="modal" data-target="#StaffLoginModal">Staff Login</a></li>
                <li><a href="" onclick="return false;"  class="py-2 d-block" data-toggle="modal" data-target="#CompanyLoginModal">Company Login</a></li>
                <li><a href="" onclick="return false;"  class="py-2 d-block" data-toggle="modal" data-target="#CompanyRegisterModal">Company Register</a></li>
				<?php
				}
				if(isset($_SESSION['admin_id']))
				{
				?>
                <li><a href="dashboard.php"   class="py-2 d-block" >Dashboard</a></li>
				<?php
				}
				if(isset($_SESSION['company_id']))
				{
				?>
                <li><a href="companypanel.php">Company Panel</a></li>
				<?php
				}
				?>
              </ul>
            </div>
          </div>
          <div class="col-md">
            <div class="ftco-footer-widget mb-4">
            	<h2 class="ftco-heading-2">Have a Questions?</h2>
            	<div class="block-23 mb-3">
	              <ul>
	                <li><span class="icon icon-map-marker"></span><span class="text">Dhamangaon Road, Yavatmal-445001 7</span></li>
	                <li><a href="#"><span class="icon icon-phone"></span><span class="text">+7232-257042</span></a></li>
	                <li><a href="#"><span class="icon icon-envelope"></span><span class="text">officialsankid@gmail.com</span></a></li>
	              </ul>
	            </div>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
            <p>Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved This is developed by Team GrowMore</p>
          </div>
        </div>
      </div>
    </footer>
    
  

  <!-- loader -->
  <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div>
  
  
<!-- Student Login Modal Starts here -->
<div id="StudentLoginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <form method="post" action=""  onsubmit="return checkerror1()" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Login Window</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Roll No.:</div><div class="col-md-9"><input type="text" name="stloginid" id="stloginid" class="form-control"><span class="errmsg flash" id="errstloginid" style="color: red;"></span></div>
</div>        
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Password: </div><div class="col-md-9"><input type="password" name="stpassword" id="stpassword" class="form-control"><span class="errmsg flash" id="errstpassword" style="color: red;"></span></div>
	
</div>
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnstudentlogin" class="btn btn-info" >Click here to Login</button>
		
<br>
<div class="row">
<a href="" onclick="return false;" class="nav-link"  data-toggle="modal" data-target="#StudentRecoverPasswordModal">Recover Password</a>  
</div> 
      </div>
    </div>
</form>
  </div>
</div>
<!-- Student Login Modal Ends here -->

<!-- StaffLoginModal   Starts here -->
<div id="StaffLoginModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
   <form method="post" action=""   onsubmit="return checkerror2()">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Staff Login Window</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Login ID:</div><div class="col-md-9"><input type="text" name="staffloginid" id="staffloginid" class="form-control"><span class="errmsg flash" id="errstaffloginid" style="color: red;"></span></div>
</div>        
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Password: </div><div class="col-md-9"><input type="password" name="staffpassword" id="staffpassword" class="form-control"><span class="errmsg flash" id="errstaffpassword" style="color: red;"></span></div>
	
</div>        
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnstafflogin" class="btn btn-info" >Click here to Login</button>
      </div>
    </div>

  </div>
  </form>
</div>
<!-- StaffLoginModal   Ends here -->

<!-- CompanyLoginModal   Starts here -->
<div id="CompanyLoginModal" class="modal fade" role="dialog"   onsubmit="return checkerror3()">
  <div class="modal-dialog">
  <form method="post" action="" >
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Company Login Window</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Email ID:</div><div class="col-md-9"><input type="text" name="comploginid" id="comploginid" class="form-control"><span class="errmsg flash" id="errcomploginid" style="color: red;"></span></div>
</div>        
<br>
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Password: </div><div class="col-md-9"><input type="password" name="comppassword" id="comppassword" class="form-control"><span class="errmsg flash" id="errcomppassword" style="color: red;"></span></div>
</div>        
      </div>
      <div class="modal-footer">
        <button type="submit" name="btncompanylogin" class="btn btn-info" >Click here to Login</button>
		<hr>
		<a href="" onclick="return false;" class="nav-link"  data-toggle="modal" data-target="#CompanyRecoverPasswordModal">Recover Password</a>		
      </div>
    </div>

  </div>
  </form>
</div>
<!-- CompanyLoginModal   Ends here -->

<!-- CompanyRegisterModal   Starts here -->
<div id="CompanyRegisterModal" class="modal fade" role="dialog"   onsubmit="return checkerror8()">
  <div class="modal-dialog">
  <form method="post" action="" enctype="multipart/form-data">
    <!-- Modal content-->
    <div class="modal-content"  style="width: 800px;">
      <div class="modal-header">
        <h4 class="modal-title">Company Registration Window</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">

		<div class="row p-2" >
			<div class="col-md-3 p-2">Company Name  : </div>
			<div class="col-md-7"><input type="text" name="ccompany_name" id="ccompany_name" class="form-control" value="<?php echo $rsedit['company_name'] ?>" >
			<span class="errmsg flash" id="cerrcompany_name" style="color: red;"></span></div>
			<div class="col-md-2 p-2"></div>
		</div>

		<div class="row p-2" >
			<div class="col-md-3 p-2">About Company  : </div>
			<div class="col-md-7"><textarea name="company_description" id="company_description" class="form-control"  ><?php echo $rsedit['company_description'] ?></textarea>
			<span class="errmsg flash" id="cerrcompany_description" style="color: red;"></span></div>
			<div class="col-md-2 p-2"></div>
		</div>


	<div class="row p-2" >
		<div class="col-md-3 p-2">Logo  : </div>
		<div class="col-md-7"><input type="file" name="clogo" id="clogo" class="form-control">
		<?php
		if(isset($_GET['editid']))
		{
		?>
		<img src="filecompany/<?php echo $rsedit['logo'] ?>" style="width: 150px; height: 175px;">
		<?php
		}
		?>
		<span class="errmsg flash" id="cerrlogo" style="color: red;"></span>
		</div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Company Address  : </div>
		<div class="col-md-7"><textarea name="caddress" id="caddress" class="form-control" ><?php echo $rsedit['address'] ?></textarea>
		<span class="errmsg flash" id="cerraddress" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>


	<div class="row p-2" >
		<div class="col-md-3 p-2">Phone No  : </div>
		<div class="col-md-7"><input type="text" name="cphone_no" id="cphone_no" class="form-control" value="<?php echo $rsedit['phone_no'] ?>"  >
		<span class="errmsg flash" id="cerrphone_no" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Email Id  : </div>
		<div class="col-md-7"><input type="text" name="cemail_id" id="cemail_id" class="form-control" value="<?php echo $rsedit['email_id'] ?>" >
		<span class="errmsg flash" id="cerremail_id" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>

	<div class="row p-2" >
		<div class="col-md-3 p-2">Password  : </div>
		<div class="col-md-7"><input type="password" name="cpassword" id="cpassword" class="form-control"   value="<?php echo $rsedit['password'] ?>">
		<span class="errmsg flash" id="cerrpassword" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div>


	<div class="row p-2" >
		<div class="col-md-3 p-2">Confirm Password  : </div>
		<div class="col-md-7"><input type="password" name="ccpassword" id="ccpassword" class="form-control"    value="<?php echo $rsedit['password'] ?>">
		<span class="errmsg flash" id="cerrcpassword" style="color: red;"></span></div>
		<div class="col-md-2 p-2"></div>
	</div> 
      </div>
      <div class="modal-footer row">
		<div class="col-md-12"><center><input type="submit" class="btn btn-primary" name="csubmit" id="csubmit" value="Click here to Register" ></center></div>
      </div>
    </div>

  </div>
  </form>
</div>
<!-- CompanyRegisterModal   Ends here -->


<!-- Student Registration Modal Starts here -->
<div id="StudentRegisterModal" class="modal fade" role="dialog" >
  <div class="modal-dialog" >
  <form method="post" action="" enctype="multipart/form-data"  onsubmit="return checkerror4()" >
    <!-- Modal content-->
    <div class="modal-content" style="width: 600px;">
      <div class="modal-header">
        <h4 class="modal-title">Registration Window</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <div class="modal-body" style="padding-left: 25px;padding-right: 25px;">
<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Name:</div><div class="col-md-8"><input type="text" name="stnameid" id="stnameid" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstnameid" style="color: red;"></span></div>
</div>        
<br>
<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Register No: </div><div class="col-md-8"><input type="text" name="stregisternumber" id="stregisternumber" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstregisternumber" style="color: red;"></span></div>
	</div>
<br>	
	<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Password: </div><div class="col-md-8"><input type="password" name="stapassword" id="stapassword" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstapassword" style="color: red;"></span></div>
	</div>
</br>
	<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Confirm Password: </div><div class="col-md-8"><input type="password" name="stcpassword" id="stcpassword" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstcpassword" style="color: red;"></span></div>
	</div>
</br>
<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Course: </div><div class="col-md-8">
	<select class="form-control" name="stcourse" id="stcourse" style="height: 42px !important;">
		<option value="">Select Course</option>
		<?php
		$sqlcourse= "SELECT * FROM course WHERE status='Active'";
		$qsqlcourse = mysqli_query($con,$sqlcourse);
		while($rscourse = mysqli_fetch_array($qsqlcourse))
		{
			echo "<option value='$rscourse[course_id]'>$rscourse[course_title]</option>";
		}
		?>
	</select><span class="errmsg flash" id="errstcourse" style="color: red;"></span>
	</div>
</div>  
<br>
<div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Email: </div><div class="col-md-8"><input type="text" name="stemailid" id="stemailid" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstemailid" style="color: red;"></span></div>      
      </div>
	<br>  
	  <div class="row">
	<div class="col-md-4" style="padding-top: 5px;">Contact No: </div><div class="col-md-8"><input type="text" name="stcontactnumberid" id="stcontactnumberid" class="form-control" style="height: 42px !important;"><span class="errmsg flash" id="errstcontactnumberid" style="color: red;"></span></div>
	</div>
	
</div>     
      <div class="modal-footer">
        <button type="submit" name="btnregister" id="btnregister" class="btn btn-danger" >Click here to register</button>
      </div>
    </div>

  </div>
  </form>
</div>
</div>
<!-- Student Registration Modal Ends here -->

  
<!-- Forget password Starts here -->
<div id="StudentRecoverPasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <form method="post" action=""   onsubmit="return checkerror5()">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Enter Roll number to recover password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">Roll No.:</div><div class="col-md-9"><input type="text" name="strecoveryloginid" id="strecoveryloginid" class="form-control"><span class="errmsg flash" id="errstrecoveryloginid" style="color: red;"></span></div>
</div>        
<br>      
      </div>
      <div class="modal-footer">
        <button type="submit" name="btnstudentreset" class="btn btn-info" >Click here to Recover password</button>
      </div>
    </div>
</form>
  </div>
</div>
<!-- Forget password Ends here -->

<!-- Company - Forget password Starts here -->
<div id="CompanyRecoverPasswordModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
  <form method="post" action=""   onsubmit="return checkerror6()">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title">Enter Company E-Mail to recover password</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" style="padding-left: 50px;padding-right: 50px;">
<div class="row">
	<div class="col-md-3" style="padding-top: 15px;">E-Mail ID:</div><div class="col-md-9"><input type="text" name="resetemailid" id="resetemailid" class="form-control"><span class="errmsg flash" id="errresetemailid" style="color: red;"></span></div>
</div>        
<br>      
      </div>
      <div class="modal-footer">
        <button type="submit" name="btncompanyreset" class="btn btn-info" >Click here to Recover password</button>		
      </div>
    </div>
</form>
  </div>
</div>
<!-- Company - Forget password Ends here -->

<!-- Javascript and Jquery Library code starts here -->
  <script src="js/jquery.min.js"></script>
  <script src="js/jquery-migrate-3.0.1.min.js"></script>
  <script src="js/popper.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jquery.easing.1.3.js"></script>
  <script src="js/jquery.waypoints.min.js"></script>
  <script src="js/jquery.stellar.min.js"></script>
  <script src="js/owl.carousel.min.js"></script>
  <script src="js/jquery.magnific-popup.min.js"></script>
  <script src="js/aos.js"></script>
  <script src="js/jquery.animateNumber.min.js"></script>
  <script src="js/bootstrap-datepicker.js"></script>
  <script src="js/jquery.timepicker.min.js"></script>
  <script src="js/scrollax.min.js"></script>
  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
  <script src="js/google-map.js"></script>
  <script src="js/main.js"></script>
  <script src="js/jquery.dataTables.min.js"></script>
<!-- Javascript and Jquery Library code ends here -->

	<script>
	/* Datatable code starts here */
	$(document).ready( function () {
    $('#myTable').DataTable();
} );
	/* Datatable code ends here */
	</script>
<script>
function checkerror1()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	 //errstloginid errstpassword 
	//####################
	if(document.getElementById("stloginid").value == "")
	{
		document.getElementById("errstloginid").innerHTML="Student Login ID Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("stpassword").value == "")
	{
		document.getElementById("errstpassword").innerHTML="Password Should not be empty..";
		errchk = "True";
	}
	//####################
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
<script>
function checkerror2()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";	 
	//####################
	//errstaffloginid  errstaffpassword
	if(document.getElementById("staffloginid").value == "")
	{
		document.getElementById("errstaffloginid").innerHTML="Staff Login ID Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("staffpassword").value == "")
	{
		document.getElementById("errstaffpassword").innerHTML="Staff Password Should not be empty..";
		errchk = "True";
	}
	//####################
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
<script>
function checkerror3()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	 
	//####################
	//errcomploginid errcomppassword	
	if(document.getElementById("comploginid").value == "")
	{
		document.getElementById("errcomploginid").innerHTML="Company Login ID Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("comppassword").value == "")
	{
		document.getElementById("errcomppassword").innerHTML="Company Password Should not be empty..";
		errchk = "True";
	}
	//####################
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
<script>
function checkerror4()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	 
	//####################
//####################
	if(document.getElementById("stcourse").value == "")
	{
		document.getElementById("errstcourse").innerHTML="Kindly select the course..";
		errchk = "True";
	}
	if(!document.getElementById("stnameid").value.match(alphaSpaceExp))
	{
		document.getElementById("errstnameid").innerHTML = "Student name should contain alphabets..";
		errchk = "True";
	}
	if(document.getElementById("stnameid").value == "")
	{
		document.getElementById("errstnameid").innerHTML="Student name should not be empty..";
		errchk = "True";
	}
	if(!document.getElementById("stregisternumber").value.match(alphaNumericExp))
	{
		document.getElementById("errstregisternumber").innerHTML = "Registration name should  contain Alphabets and numerics..";
		errchk = "True";
	}
	if(document.getElementById("stregisternumber").value == "")
	{
		document.getElementById("errstregisternumber").innerHTML="Register Number Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("stapassword").value.length < 8)
	{
		document.getElementById("errstapassword").innerHTML="The password field  must contain atleast 8 character..";
		errchk = "True";
	}
	if(document.getElementById("stapassword").value == "")
	{
		document.getElementById("errstapassword").innerHTML="Password should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("stcpassword").value != document.getElementById("stapassword").value)
	{
		document.getElementById("errstcpassword").innerHTML="Password and Confirm password not matching..";
		errchk = "True";
	}
	if(document.getElementById("stcpassword").value == "")
	{
		document.getElementById("errstcpassword").innerHTML="Confirm Password should not be empty.";
		errchk = "True";
	}
	if(document.getElementById("stemailid").value == "")
	{
		document.getElementById("errstemailid").innerHTML="Email ID Should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("stcontactnumberid").value == "")
	{
		document.getElementById("errstcontactnumberid").innerHTML="Contact No Should not be empty..";
		errchk = "True";
	}
	//####################
	//####################
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
<script>
function checkerror5()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	 
	//####################
	if(document.getElementById("strecoveryloginid").value == "")
	{
		document.getElementById("errstrecoveryloginid").innerHTML="Recovery Login ID should not be empty..";
		errchk = "True";
	}
	//####################
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
<script>
function checkerror6()
{
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	
	$('.errmsg').html('');
	var errchk = "False";
	 
	//####################
	if(document.getElementById("resetemailid").value == "")
	{
		document.getElementById("errresetemailid").innerHTML="Recovery Login ID should not be empty..";
		errchk = "True";
	}	
	//####################
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
<script>
function checkerror8()
{
	
	var numericExp = /^[0-9]+$/;
	var alphaExp = /^[a-zA-Z]+$/;
	var alphaSpaceExp = /^[a-zA-Z\s]+$/;
	var alphaNumericExp = /^[0-9a-zA-Z]+$/;
	var emailExp = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;
	   
	$('.errmsg').html('');
	var errchk = "False";
	if(document.getElementById("ccompany_name").value == "")
	{
		document.getElementById("cerrcompany_name").innerHTML="Company name should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("company_description").value == "")
	{
		document.getElementById("cerrcompany_description").innerHTML="Company Description should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("clogo").value == "")
	{
		document.getElementById("cerrlogo").innerHTML="Kindly upload the Logo..";
		errchk = "True";
	}   
	if(document.getElementById("caddress").value == "")
	{
		document.getElementById("cerraddress").innerHTML="Company address should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("cphone_no").value == "")
	{
		document.getElementById("cerrphone_no").innerHTML="Kindly enter Phone number..";
		errchk = "True";
	}
	if(document.getElementById("cemail_id").value == "")
	{
		document.getElementById("cerremail_id").innerHTML="Email ID should not be empty..";
		errchk = "True";
	}
	if(document.getElementById("cpassword").value == "")
	{
		document.getElementById("cerrpassword").innerHTML="Password should not be empty....";
		errchk = "True";
	}
	if(document.getElementById("ccpassword").value == "")
	{
		document.getElementById("cerrcpassword").innerHTML="Confirm password should not be empty...";
		errchk = "True";
	}
	if(document.getElementById("ccpassword").value != document.getElementById("cpassword").value)
	{
		document.getElementById("cerrcpassword").innerHTML="Password and Confirm password not matching...";
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
  </body>
</html>