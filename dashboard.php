<?php
include("header.php");
if(!isset($_SESSION['admin_id']))
{
	echo "<script>window.location='index.php';</script>";
}
?>
<style>
.dot {
  height: 50%;
  width: 50%;
  background-color: #d40808;
  border-radius: 50%;
  display: inline-block;
  font-size: 22px;
}
</style>
	<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex justify-content-center">
            <div class="col-md-12 text-center heading-section heading-section-white ftco-animate">
              <h2>Dashboard</h2>
              <div class="row d-flex justify-content-center mt-4 mb-4">


<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/admin.png";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Admin Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from admin where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/certificate.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Certification Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from certification  ";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/company.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Company Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from company where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/computer.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Computer Skill Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from computer_skill";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/course.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Course Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from course where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/education.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Education_qualification Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from education_qualification where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/job.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Job Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from job where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/application.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Job Application Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from job_application where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/category.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Job category Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from job_category  where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/location.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Location Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from location where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/extra.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Other Activites Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from other_activities where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/student.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of User's Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from student where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>

<div class="col-md-3 d-flex ftco-animate border">
	<div class="blog-entry align-self-stretch">
	  <a href="#" class="block-20" style="background-image: url('<?php 
		  echo "images/training.jpg";
	  ?>');">
	  </a>
	  <div class="text mt-3">
		<div class="meta mb-2">
		  <div><a href="#">Number of Training Material Records</a></div>
		</div>
	   <p  class="dot"><?php
$sql = "select * from training_material where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
?></p>
	  </div>
	</div>
</div>
  
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>

<?php
include("footer.php");
?>