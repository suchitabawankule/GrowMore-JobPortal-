<?php
include("header.php");
?>
<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
	<div class="container">
	  <div class="row d-flex justify-content-center">
		<div class="col-md-7 text-center heading-section heading-section-white ftco-animate">
		  <h2><?php echo $_GET['presentationtype']; ?></h2>
		</div>
	  </div>
	</div>
  </div>
</section>
<section class="ftco-section bg-light">
  <div class="container">
	<div class="row d-flex">
	
	<?php
	$sql ="SELECT * FROM training_material WHERE material_type='$_GET[material_type]' ORDER BY trainingmaterial_id DESC";
	$qsql = mysqli_query($con,$sql);
	while($rs = mysqli_fetch_array($qsql))
	{
		if($rs['banner_img'] == "")
		  {
			$img =  "images/No-Image-Available.png";
		  }
		else if(file_exists("img_trainingmaterial/". $rs['banner_img']))
		  {
			$img =  "img_trainingmaterial/". $rs['banner_img'];
		  }
		else
		  {
			$img =  "images/No-Image-Available.png";
		  }
	?>
<div class="col-md-4 d-flex ftco-animate">
	<div class="blog-entry align-self-stretch border" style="padding-left: 10px; padding-right: 10px;">
		  <a href="displaytrainingmaterialdetailed.php?trainingmaterial_id=<?php echo $rs[0]; ?>" class="block-20" style="background-image: url('<?php echo $img; ?>');"
		>
		  </a>
		  <div class="text mt-4">
				<div class="meta mb-2">
				  <div><a href="#">(<?php echo $rs['material_type']; ?>)</a></div>
				</div>
				<h3 class="heading"><a href="displaytrainingmaterialdetailed.php?trainingmaterial_id=<?php echo $rs[0]; ?>&material_type=<?php echo $_GET['material_type']; ?>&presentationtype=<?php echo $_GET['presentationtype']; ?>"><?php echo $rs['title']; ?></a></h3>
			   <p><?php 
			   echo substr(strip_tags($rs['description']), 0, 100) . "....";
			   ?></p>
		  </div>
	</div>
</div>
<?php
	}
?>


	</div>
  </div>
</section>
	


<?php
include("footer.php");
?>