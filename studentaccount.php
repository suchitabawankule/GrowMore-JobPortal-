<?php
include("header.php");
?>
<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
	<div class="container">
	  <div class="row d-flex justify-content-center">
		<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
		  <h2>Job Seeker Account Panel</h2>
		</div>
	  </div>
	</div>
  </div>
</section>

   
    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_1.jpg);" data-stellar-background-ratio="0.5">
    	<div class="container">
    		<div class="row justify-content-center">
    			<div class="col-md-10">
		    		<div class="row">
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="<?php
$sql = "select * from job where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
						?>">0</strong>
		                <span>Jobs</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="<?php
$sql = "select * from student where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
						?>">0</strong>
		                <span>Users</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="<?php
$sql = "select * from company where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
						?>">0</strong>
		                <span>Companies</span>
		              </div>
		            </div>
		          </div>
		          <div class="col-md-3 d-flex justify-content-center counter-wrap ftco-animate">
		            <div class="block-18 text-center">
		              <div class="text">
		                <strong class="number" data-number="<?php
$sql = "select * from training_material where status='Active'";
$qsql = mysqli_query($con,$sql);
echo mysqli_num_rows($qsql);
						?>">0</strong>
		                <span>Training Materials</span>
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