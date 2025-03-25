<?php
include("header.php");
if(isset($_GET['resetcode']))
{
	echo "<script>window.location='resetstudentpassword.php?studentid=$_GET[studentid]&resetcode=$_GET[resetcode]'</script>";
}
if(isset($_GET['companyresetcode']))
{
	echo "<script>window.location='resetcompanypassword.php?company_id=$_GET[company_id]&companyresetcode=$_GET[companyresetcode]'</script>";
}
?>
    <section class="ftco-section services-section bg-light">
      <div class="container">
        <div class="row d-flex">
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-resume"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Search Millions of Jobs</h3>
                <p> Your Future Starts here.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-collaboration"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Easy To Manage Jobs</h3>
                <p>Best website for Job Seekers to get into jobs of their own.</p>
              </div>
            </div>    
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-promotions"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Top Careers</h3>
                <p>The best way to predict the future is to create it.</p>
              </div>
            </div>      
          </div>
          <div class="col-md-3 d-flex align-self-stretch ftco-animate">
            <div class="media block-6 services d-block">
              <div class="icon"><span class="flaticon-employee"></span></div>
              <div class="media-body">
                <h3 class="heading mb-3">Search Expert Candidates</h3>
                <p>Together we create.</p>
              </div>
            </div>      
          </div>
        </div>
      </div>
    </section>

    <section class="ftco-section ftco-counter">
    	<div class="container">
    		<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
            <h2 class="mb-4"><span>Job</span>  Categories</h2>
          </div>
        </div>
        <div class="row">
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
        </div>
    	</div>
    </section>


		<section class="ftco-section bg-light" style="background: #25405a !important;">
			<div class="container">
				<div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-7 heading-section text-center ftco-animate">
          	<span class="subheading" style="color: white;">Recently Added Jobs</span>
            <h2 class="mb-4"  style="color: yellow;"><span  style="color: white;">Recent</span> Jobs</h2>
          </div>
        </div>
				<div class="row">
				

				<div class="ftco-search">
							<div class="row">
		            <div class="col-md-12 nav-link-wrap">
			            <div class="nav nav-pills text-center" id="v-pills-tab" role="tablist" aria-orientation="vertical">
<?php
$sqlcourse ="SELECT * FROM course WHERE status='Active'";
$qsqlcourse = mysqli_query($con,$sqlcourse);
while($rscourse = mysqli_fetch_array($qsqlcourse))
{
	if($i == 0)
	{
?>
<a class="nav-link active mr-md-1" id="v-pills-<?php echo $rscourse[0]; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $rscourse[0]; ?>" role="tab" aria-controls="v-pills-1" aria-selected="true"><?php echo $rscourse['course_title']; ?></a>
<?php
		$i=1;
	}
	else
	{
?>
<a class="nav-link" id="v-pills-<?php echo $rscourse[0]; ?>-tab" data-toggle="pill" href="#v-pills-<?php echo $rscourse[0]; ?>" role="tab" aria-controls="v-pills-2" aria-selected="false"><?php echo $rscourse['course_title']; ?></a>
<?php
	}
}
?>

			            </div>
			          </div>
			          <div class="col-md-12 tab-wrap">
			            
			            <div class="tab-content p-4" id="v-pills-tabContent" style="background-color: #e9ecef;">
<?php
$i=0;
$sqlcourse ="SELECT * FROM course WHERE status='Active'";
$qsqlcourse = mysqli_query($con,$sqlcourse);
while($rscourse = mysqli_fetch_array($qsqlcourse))
{
?>
<div class="tab-pane fade show 
<?php
if($i == 0)
{
echo " active ";
$i = 1;
}
?>
" id="v-pills-<?php echo $rscourse[0]; ?>" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
<form action="#" class="search-job">
	<div class="row">
<?php
$sqljob = "SELECT * FROM job LEFT JOIN job_category on job_category.jobcategory_id=job.jobcategory_id LEFT JOIN location on location.location_id=job.location_id left join company ON company.company_id=job.company_id WHERE job.status='Active' order by job_id DESC LIMIT 10";
$qsqljob = mysqli_query($con,$sqljob);
echo mysqli_error($con);
while($rsjob = mysqli_fetch_array($qsqljob))
{
	$arredu_qualification = unserialize($rsjob['edu_qualification']);
	if(in_array($rscourse['course_id'], $arredu_qualification))
	{
?>		
<div class="col-md-12 ftco-animate">
	<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
	  <div class="mb-4 mb-md-0 mr-5">
		<div class="job-post-item-header d-flex align-items-center">
		  <h2 class="mr-3 text-black h3"><?php echo $rsjob['job_title']; ?></h2>
		  <div class="badge-wrap">
		   <span class="bg-primary text-white badge py-2 px-3"><?php echo $rsjob['job_category']; ?></span>
		  </div>
		</div>
		<div class="job-post-item-body d-block d-md-flex">
		  <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $rsjob['company_name']; ?></a></div>
		  <div><span class="icon-my_location"></span> <span><?php echo $rsjob['location']; ?></span></div>
		</div>
	  </div> 
	</div>
</div><!-- end -->
<?php
	}
}
?>
	</div>
</form>
</div>
<?php
}
?>

			            </div>
			          </div>
			        </div>
		        </div>
				
				

				</div>
			</div>
		</section>
   


<section class="ftco-section ftco-counter">
	<div class="container">
		<div class="row justify-content-center mb-5 pb-3">
	  <div class="col-md-7 heading-section text-center ftco-animate">
		<h2 class="mb-4"><span>Job</span>  Location</h2>
	  </div>
	</div>
	<div class="row">
<?php
$sqljob_location ="SELECT *, (SELECT COUNT(*) from job where location_id=location.location_id) AS locationcount FROM location WHERE status='Active'";
$qsqljob_location = mysqli_query($con,$sqljob_location);
echo mysqli_error($con);
while($rsjob_location = mysqli_fetch_array($qsqljob_location))
{
?>		
	<div class="col-md-3 ftco-animate">
		<ul class="category">
			<li><a href="#"><?php echo $rsjob_location['location']; ?> <span class="number" data-number="<?php echo $rsjob_location['locationcount']; ?>">jobcount</span></a></li>
		</ul>
	</div>
<?php
}
?>		
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
		                <strong class="number" data-number="<?php $sql = "select * from company where status='Active'"; $qsql = mysqli_query($con,$sql);echo mysqli_num_rows($qsql);
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


		<section class="ftco-section-parallax">
      <div class="parallax-img d-flex align-items-center">
        <div class="container">
          <div class="row d-flex">
            <div class="col-md-12 heading-section heading-section-white ftco-animate">
			

      <div class="container">
        <div class="row justify-content-center mb-5 pb-3">
          <div class="col-md-12 heading-section text-center ftco-animate">
            <h2> -<span>Training </span> Materials -</h2>
          	<span class="subheading">Find, Learn and Share knowledge.</span>
          </div>
        </div>
        <div class="row d-flex">
		
<?php          
$sqltraining_material ="SELECT * FROM training_material ORDER BY trainingmaterial_id DESC limit 4";
$qsqltraining_material = mysqli_query($con,$sqltraining_material);
while($rstraining_material = mysqli_fetch_array($qsqltraining_material))
{
?>
  <div class="col-md-3 d-flex ftco-animate">
		<div class="blog-entry align-self-stretch">
		  <a href="#" class="block-20" style="background-image: url('<?php 
		  if($rstraining_material['banner_img'] == "")
		  {
			  echo "images/No-Image-Available.png";
		  }
		  else if(!file_exists("img_trainingmaterial/". $rstraining_material['banner_img']))
		  {
			  echo "images/No-Image-Available.png";
		  }
		  else
		  {
			echo "img_trainingmaterial/". $rstraining_material['banner_img']; 
		  }
		  ?>');">
		  </a>
		  <div class="text mt-3">
			<div class="meta mb-2">
			  <div style="color: white;"><?php echo $rstraining_material['title']; ?></div>
			</div>
		  </div>
		</div>
  </div>
<?php
}
?>
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