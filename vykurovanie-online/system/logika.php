	<?php
	
session_start();
	include ("connect.php");
	$kod_get = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $kod = mysqli_fetch_assoc($kod_get);
 $kodik = $kod['code']; 
 
 
 
  $vsetko_get = mysqli_query($con,"SELECT  * FROM `teplomery_vykurovanie` WHERE `code`='".$kodik."'") or die(mysqli_error($con));
 $vsetko = mysqli_fetch_assoc($vsetko_get);
	if($vsetko['rezim'] == "Automat"){
		
		$teplota = mysqli_query($con,"SELECT cislo FROM `teplomery_vykurovanie` WHERE `code`='".$kodik."'") or die(mysqli_error($con));
 $teplota1 = mysqli_fetch_assoc($teplota); 
if($teplota1['cislo']==1){
	$teplomer = mysqli_query($con,"SELECT teplota1 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota1'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
			
}else if($teplota1['cislo']==2){
	$teplomer = mysqli_query($con,"SELECT teplota2 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota2'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==3){
	$teplomer = mysqli_query($con,"SELECT teplota3 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota3'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==4){
	$teplomer = mysqli_query($con,"SELECT teplota4 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota4'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==5){
	$teplomer = mysqli_query($con,"SELECT teplota5 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
 $rozdiel = $vsetko['referencia']-$teplomer1['teplota5'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
}else if($teplota1['cislo']==6){
	$teplomer = mysqli_query($con,"SELECT teplota6 FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teplomer1 = mysqli_fetch_assoc($teplomer); 
  $rozdiel = $vsetko['referencia']-$teplomer1['teplota6'];
if($rozdiel>$vsetko['hystereza'])
			{
			if($vsetko['stav']!="ZAP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
				
		
			}
			else if($rozdiel<=$vsetko['hystereza'])
			{
				if($vsetko['stav']!="VYP"){
			$update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP' WHERE `code`='".$kodik."'") or die(mysqli_error($con));
			}
			}
}
	}
 ?>