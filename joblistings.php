<?php
include("header.php");
?>
<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
	<div class="container">
	  <div class="row d-flex justify-content-center">
		<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
<?php
if($_GET['jobcategory'] == "JobCategory")
{
?>
		  <h2>Jobs By Category</h2>
<?php
}
if($_GET['jobcategory'] == "JobLocation")
{
?>
		  <h2>Jobs By Location</h2>
<?php
}
?>		  
		</div>
	  </div>
	</div>
  </div>
</section>

<?php
if($_GET['jobcategory'] == "JobCategory")
{
?>
    <section class="ftco-section ftco-counter">
    	<div class="container">
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
			<li><a href="joblistings.php?jobcategory_id=<?php echo $rsjob_category[0]; ?>&jobcategory=JobCategory"><?php echo $rsjob_category['job_category']; ?> <span class="number" data-number="<?php echo $rsjob_category['jobcount']; ?>">jobcount</span></a></li>
		</ul>
	</div>
<?php
}
?>		
        </div>
    	</div>
    </section>
<?php
}
if($_GET['jobcategory'] == "JobLocation")
{
?>
	<section class="ftco-section ftco-counter">
		<div class="container">
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
				<li><a href="joblistings.php?location_id=<?php echo $rsjob_location['location_id']; ?>&jobcategory=JobLocation"><?php echo $rsjob_location['location']; ?> <span class="number" data-number="<?php echo $rsjob_location['locationcount']; ?>">jobcount</span></a></li>
			</ul>
		</div>
	<?php
	}
	?>		
		</div>
		</div>
	</section>
<?php
}
?>
		<section class="bg-light">
			<div class="container">
			
   <br>  
				<div class="row col-md-12">
<?php
$sqljob = "SELECT * FROM job LEFT JOIN job_category on job_category.jobcategory_id=job.jobcategory_id LEFT JOIN location on location.location_id=job.location_id left join company ON company.company_id=job.company_id WHERE job.status='Active'";
if(isset($_GET['jobcategory_id']))
{
$sqljob = $sqljob . " AND job.jobcategory_id='$_GET[jobcategory_id]' ";
}
if(isset($_GET['location_id']))
{
$sqljob = $sqljob . " AND job.location_id='$_GET[location_id]' ";
}
$sqljob = $sqljob . " ORDER BY job.job_id DESC";
$qsqljob = mysqli_query($con,$sqljob);
echo mysqli_error($con);
while($rsjob = mysqli_fetch_array($qsqljob))
{
	$arredu_qualification = unserialize($rsjob['edu_qualification']);
	if(in_array($rsstudent['course_id'], $arredu_qualification))
	{
?>		
<div class="col-md-12 ftco-animate">
	<div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
	  <div class="mb-4 mb-md-0 mr-5">
		<div class="job-post-item-header d-flex align-items-center">
		  <h2 class="mr-3 text-black h3"><?php echo $rsjob['job_title']; ?></h2>
		  <div class="badge-wrap">
		   <span class="bg-danger text-white badge py-2 px-3"><?php echo $rsjob['job_category']; ?></span>
		  </div>
		</div>
		<div class="job-post-item-body d-block d-md-flex">
		  <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $rsjob['company_name']; ?></a></div>
		  <div><span class="icon-my_location"></span> <span><?php echo $rsjob['location']; ?></span></div>
		</div>
	  </div>

	  <div class="ml-auto d-flex">
		<a href="displayjobdetails.php?job_id=<?php echo $rsjob['job_id']; ?>" class="btn btn-primary py-2 mr-1">View Job</a>
	  </div>


	</div>
</div><!-- end -->
<?php
	}
}
?>
				</div>
   <br>  
<?php
/*
				<div class="row mt-5">
          <div class="col text-center">
            <div class="block-27">
              <ul>
                <li><a href="#">&lt;</a></li>
                <li class="active"><span>1</span></li>
                <li><a href="#">2</a></li>
                <li><a href="#">3</a></li>
                <li><a href="#">4</a></li>
                <li><a href="#">5</a></li>
                <li><a href="#">&gt;</a></li>
              </ul>
            </div>
          </div>
        </div>
*/
?>		
			</div>
		</section>
   

<?php
include("footer.php");
?>