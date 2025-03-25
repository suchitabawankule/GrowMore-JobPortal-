<?php
include("header.php");
	$sqltraining_material ="SELECT * FROM training_material WHERE trainingmaterial_id='$_GET[trainingmaterial_id]'";
	$qsqltraining_material = mysqli_query($con,$sqltraining_material);
	$rstraining_material = mysqli_fetch_array($qsqltraining_material);
?>

<section class="ftco-section-parallax">
  <div class="parallax-img d-flex align-items-center">
	<div class="container">
	  <div class="row d-flex justify-content-center">
		<div class="col-md-12 text-center heading-section heading-section-white ftco-animate">
		  <h2><?php echo $_GET['presentationtype']; ?></h2>
		</div>
	  </div>
	</div>
  </div>
</section>

    <section class="ftco-degree-bg">
      <div class="container">
        <div class="row">
          <div class="col-md-12 ftco-animate">
          
            <div class="about-author d-flex p-4 bg-light">

              <div class="desc">
                <h2><?php echo $rstraining_material['title']; ?></h2>
				<?php
		if($rstraining_material['banner_img'] == "")
		  {
			$img =  "images/No-Image-Available.png";
		  }
		else if(file_exists("img_trainingmaterial/". $rstraining_material['banner_img']))
		  {
			$img =  "img_trainingmaterial/". $rstraining_material['banner_img'];
		  }
		else
		  {
			$img =  "images/No-Image-Available.png";
		  }
				?>
				<img src="<?php echo $img; ?>" style='width: 600px;height: 300px;'>
                <p><?php echo $rstraining_material['description']; ?></p>
				<p>
				<hr>
				

<?php
if($rstraining_material['material_type'] == "Video")
{
?>
<h2>Video Player</h2>				
<?php
$files = unserialize($rstraining_material['file']);
//echo print_r($files[1]);
$countfiles = count($files);
for($i=0;$i<$countfiles;$i++)
{
	 $j = $i+1;
	 echo "<video width='100%' controls><source src='docstrainingmaterial/$files[$i]' type='video/mp4'>Your browser does not support the video tag.</video>";
	 //echo "<ul class='category'><li><a download href='docstrainingmaterial/$files[$i]' target='_blank' class='btn btn-primary' style='text-align: left; width: 50%;'>$j) <b>$files[$i]</b></a></li></ul>";
}
?>	
<?php
}
else
{
?>
<h2>Download Link</h2>				
<?php
$files = unserialize($rstraining_material['file']);
//echo print_r($files[1]);
$countfiles = count($files);
for($i=0;$i<$countfiles;$i++)
{
	 $j = $i+1;
	 echo "<ul class='category'><li><a download href='docstrainingmaterial/$files[$i]' target='_blank' class='btn btn-primary' style='text-align: left; width: 50%;'>$j) <b>$files[$i]</b></a></li></ul>";
}
?>				
<?php
}
?>
				</p>
              </div>
            </div>
          </div> <!-- .col-md-8 -->
		
        </div>
      </div>
    </section> <!-- .section -->

    <?php
	include("footer.php");
	?>