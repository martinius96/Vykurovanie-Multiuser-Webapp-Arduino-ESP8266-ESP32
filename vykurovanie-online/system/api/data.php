<?php 
error_reporting(0);
include("../connect.php");
  $token   = mysqli_real_escape_string($con, $_GET["token"]);
  $username   = mysqli_real_escape_string($con, $_GET["username"]);
 $teplota1 = mysqli_real_escape_string($con, $_GET["teplota1"]);
 $teplota2 = mysqli_real_escape_string($con, $_GET["teplota2"]);
$teplota3  = mysqli_real_escape_string($con, $_GET["teplota3"]);
$teplota4  = mysqli_real_escape_string($con, $_GET["teplota4"]);
$teplota5  = mysqli_real_escape_string($con, $_GET["teplota5"]);
$teplota6  = mysqli_real_escape_string($con, $_GET["teplota6"]);



//echo "Prijate data:";
//echo "<br>".$teplota1." ".$teplota2." ".$teplota3." ".$teplota4." ".$teplota5." ".$teplota6;




$platny_token = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `code`='$token' AND `username`='$username'") or die(mysqli_error($con));
    if(mysqli_num_rows($platny_token) < 1){
	echo 'Autenzizácia neúspešná!';
	}else{	
	echo'Zápis úspešný!';
	$ins = mysqli_query($con,"INSERT INTO `data_vykurovanie` (`teplota1`,`teplota2`,`teplota3`,`teplota4`,`teplota5`,`teplota6`,`code`) VALUES ('$teplota1', '$teplota2', '$teplota3', '$teplota4', '$teplota5', '$teplota6', '$token')") or die (mysqli_error($con));	
  $vsetko_get = mysqli_query($con,"SELECT  * FROM `teplomery_vykurovanie` WHERE `code`='".$token."'LIMIT 1") or die(mysqli_error($con));
 $vsetko = mysqli_fetch_assoc($vsetko_get);



// echo "Rezim:";
// echo "<br>".$vsetko['rezim'];
//var_dump($vsetko['rezim']);

	if($vsetko['rezim'] == "Automat"){
		
		$teplota = mysqli_query($con,"SELECT cislo FROM `teplomery_vykurovanie` WHERE `code`='".$token."'") or die(mysqli_error($con));
 $teplota1 = mysqli_fetch_assoc($teplota); 




//  echo "Riadiaci teplomer:";
//echo "<br>".$teplota1['cislo'];




if($teplota1['cislo']==1){
	$teplomer = mysqli_query($con,"SELECT teplota1 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota1'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
			
}else if($teplota1['cislo']==2){
	$teplomer = mysqli_query($con,"SELECT teplota2 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota2'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==3){
	$teplomer = mysqli_query($con,"SELECT teplota3 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota3'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==4){
	$teplomer = mysqli_query($con,"SELECT teplota4 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota4'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==5){
	$teplomer = mysqli_query($con,"SELECT teplota5 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota5'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==6){
	$teplomer = mysqli_query($con,"SELECT teplota6 FROM `data_vykurovanie` WHERE `code`='".$token."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota6'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$token."'") or die(mysqli_error($con));
			}
			}
}
	}
  }   
	?>
	