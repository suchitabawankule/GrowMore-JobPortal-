<?php
session_start();
include("dbconnection.php");
if(isset($_GET['filedelid']))
{
	$sqlfileid = "SELECT * FROM training_material WHERE trainingmaterial_id='$_GET[editid]'";
	$qsqlfileid = mysqli_query($con,$sqlfileid);
	echo mysqli_error($con);
	$rsfileid = mysqli_fetch_array($qsqlfileid);
	$arrfiles = unserialize($rsfileid['file']);
	unset($arrfiles[$_GET['filedelid']]);
	$anArray = array_values($arrfiles); //Coding to Re index array value
	$arrf = serialize($anArray);
	$sqlupd = "UPDATE training_material SET file='$arrf' WHERE trainingmaterial_id='$_GET[editid]'";
	$qsqlupd=mysqli_query($con,$sqlupd);
}
$sqlfileid = "SELECT * FROM training_material WHERE trainingmaterial_id='$_GET[editid]'";
$qsqlfileid = mysqli_query($con,$sqlfileid);
echo mysqli_error($con);
$rsfileid = mysqli_fetch_array($qsqlfileid);
$files = unserialize($rsfileid['file']);
//echo print_r($files[1]);
$countfiles = count($files);
for($i=0;$i<$countfiles;$i++)
{
	 $j = $i+1;
	 echo "<ul class='category'><li><a href='docstrainingmaterial/$files[$i]' target='_blank'>$j) $files[$i] <span class='number' data-number='1000' style='color: red;'><b><label onclick='deletefile($i,$_GET[editid]);return false;' style='cursor: grab;'>Delete File</label></b></span></a></li></ul>";
}
?>