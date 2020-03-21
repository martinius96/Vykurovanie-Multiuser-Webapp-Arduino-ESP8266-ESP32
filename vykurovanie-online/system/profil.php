<?php
//error_reporting(0);
session_start();
include ("connect.php");
if(isset($_SESSION['uid'])){ 
?>
<!doctype html>
<html lang="sk">
	<?php

?>
<head>
<title>Prehľad nameraných údajov</title>
<?php 
include ("meta.php");
 $get_code_user = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));     
 $get_code_parsed = mysqli_fetch_assoc($get_code_user); 
 $kod = $get_code_parsed['code']; 
  $get_all_results = mysqli_query($con,"SELECT * FROM `data_vykurovanie` WHERE `code`='".$kod."'") or die(mysqli_error($con)); 
$rowcount = mysqli_num_rows($get_all_results);
 if(isset($_POST['zmenmikrokontroler'])){
 $get_code = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));     
 $get_code_parsed = mysqli_fetch_assoc($get_code);
 $kod = $get_code_parsed['code']; 
   $mikrokontroler = mysqli_real_escape_string($con, $_POST['mikrokontroler']);
   $mikrokontroler = htmlspecialchars( $mikrokontroler);
   $mikrokontroler = trim( $mikrokontroler );
   $update = mysqli_query($con,"UPDATE `user_vykurovanie` SET `mikrokontroler`='".$mikrokontroler."' WHERE `code`='".$kod."'") or die(mysqli_error($con));
   }
   
if(isset($_POST['zmen'])){
$get_code = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $get_code_parsed = mysqli_fetch_assoc($get_code);
 $kod = $get_code_parsed['code']; 
   $teplomer1 = mysqli_real_escape_string($con, $_POST['teplomer1']);
   $teplomer1 = htmlspecialchars( $teplomer1, ENT_QUOTES );
   $teplomer1 = trim( $teplomer1 );
   $teplomer2 = mysqli_real_escape_string($con, $_POST['teplomer2']);
   $teplomer2 = htmlspecialchars( $teplomer2, ENT_QUOTES );
   $teplomer2 = trim( $teplomer2 );
   $teplomer3 = mysqli_real_escape_string($con, $_POST['teplomer3']);
   $teplomer3 = htmlspecialchars( $teplomer3, ENT_QUOTES );
   $teplomer3 = trim( $teplomer3 );
   $teplomer4 = mysqli_real_escape_string($con, $_POST['teplomer4']);
   $teplomer4 = htmlspecialchars( $teplomer4, ENT_QUOTES );
   $teplomer4 = trim( $teplomer4 );
   $teplomer5 = mysqli_real_escape_string($con, $_POST['teplomer5']);
   $teplomer5 = htmlspecialchars( $teplomer5, ENT_QUOTES );
   $teplomer5 = trim( $teplomer5 );
   $teplomer6 = mysqli_real_escape_string($con, $_POST['teplomer6']);
   $teplomer6 = htmlspecialchars( $teplomer6, ENT_QUOTES );
   $teplomer6 = trim( $teplomer6 );
   $update_stats = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `teplomer1`='".$teplomer1."',`teplomer2`='".$teplomer2."',`teplomer3`='".$teplomer3."',`teplomer4`='".$teplomer4."',`teplomer5`='".$teplomer5."',`teplomer6`='".$teplomer6."' WHERE `code`='".$kod."'") or die(mysqli_error($con));
}
// $nazov_get = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kod."'") or die(mysqli_error($con));
// $nazov = mysqli_fetch_assoc($nazov_get);
if(isset($_POST['zmenspinanie'])){
$get_code = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $get_code_parsed = mysqli_fetch_assoc($get_code);
 $kod = $get_code_parsed['code']; 
   $teplomer = mysqli_real_escape_string($con, $_POST['teplomer']);
   $teplomer = htmlspecialchars( $teplomer, ENT_QUOTES );
   $teplomer = trim( $teplomer );
 if($teplomer ==  "teplomer1"){
  $teplomer = 1; 
 }elseif($teplomer ==  "teplomer2"){
  $teplomer = 2; 
      }elseif($teplomer ==  "teplomer3"){ 
	  $teplomer = 3;
	   }
     elseif($teplomer ==  "teplomer4"){
	  $teplomer = 4;
	   }elseif($teplomer ==  "teplomer5"){ 
	   $teplomer = 5; }
elseif($teplomer ==  "teplomer6"){ 
$teplomer = 6; }
 $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `cislo`='".$teplomer."',`stav`='VYP' WHERE `code`='".$kod."'") or die(mysqli_error($con));
}
  $vsetko_get = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $vsetko = mysqli_fetch_assoc($vsetko_get);
 $kod = $vsetko['code']; 
  $nazov_get = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kod."'") or die(mysqli_error($con));
 $nazov = mysqli_fetch_assoc($nazov_get);
?>	
</head>
<?php $stranka = "Profil";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">									
							<h2><font color="black">Nastavenia</font></h2>
								
	  <div class="row">
  <div class="col-sm-12">
 <?php  if(isset($_POST['zmen'])){ ?>
  <div class="alert alert-success">
  <strong>Vykonané!</strong> Názvy teplomerov boli úspešne aktualizované!
</div> 
<?php } ?>
<?php  if(isset($_POST['zmenspinanie'])){ ?>
  <div class="alert alert-success">
  <strong>Vykonané!</strong> Spínací teplomer aktualizovaný!
</div> 
<?php } ?>
<?php  if(isset($_POST['zmenmikrokontroler'])){ ?>
  <div class="alert alert-success">
  <strong>Vykonané!</strong> Riadiaci mikrokontróler úspešne zmenený!
</div> 
<?php } ?>
  <h2>Osobné informácie:</h2>
  <li><b>Používateľské meno:</b> <?php echo $vsetko['username']; ?></li>
  <li><b>Hash hesla v DB:</b> <?php echo $vsetko['password']; ?></li>
  <li><b>Mikrokontróler:</b> <?php echo $vsetko['mikrokontroler']; ?></li>
  <li><b>Senzory:</b> <?php echo $vsetko['hardver']; ?></li>
  <li><b>Token:</b> <?php echo $vsetko['code']; ?></li>
  <li><b>Počet záznamov v databáze:</b> <?php echo $rowcount; ?></li>
 <center> <hr><h2>Názvy teplomerov</h2><hr>
 <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
<b>(Upravte pre miestnosť, umiestnenie senzoru)</b><br>
			<input  type="text" name="teplomer1" value="<?php echo  $nazov['teplomer1']; ?>" required><br> 
			<input  type="text" name="teplomer2" value="<?php echo  $nazov['teplomer2']; ?>" required><br> 
			<input  type="text" name="teplomer3" value="<?php echo  $nazov['teplomer3']; ?>" required> <br>
			<input  type="text" name="teplomer4" value="<?php echo  $nazov['teplomer4']; ?>" required> <br>
			<input  type="text" name="teplomer5" value="<?php echo  $nazov['teplomer5']; ?>" required> <br>
			<input  type="text" name="teplomer6" value="<?php echo  $nazov['teplomer6']; ?>" required> <br>
<br>
			<input type="submit" class="btn btn-success" name="zmen" value="Zmeniť">
		   </form> 
		   <hr><h2>Spínací teplomer</h2><hr>
		  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
		   <select name="teplomer">
  <option value="teplomer1" <?php if($nazov['cislo']==1){echo 'selected';}?>><?php echo  $nazov['teplomer1']; ?></option>
  <option value="teplomer2" <?php if($nazov['cislo']==2){echo 'selected';}?>><?php echo  $nazov['teplomer2']; ?></option>
  <option value="teplomer3" <?php if($nazov['cislo']==3){echo 'selected';}?>><?php echo  $nazov['teplomer3']; ?></option>
  <option value="teplomer4" <?php if($nazov['cislo']==4){echo 'selected';}?>><?php echo  $nazov['teplomer4']; ?></option>
  <option value="teplomer5" <?php if($nazov['cislo']==5){echo 'selected';}?>><?php echo  $nazov['teplomer5']; ?></option>
  <option value="teplomer6" <?php if($nazov['cislo']==6){echo 'selected';}?>><?php echo  $nazov['teplomer6']; ?></option>
</select>

		 <input type="submit" class="btn btn-danger" name="zmenspinanie" value="Zmeniť">  
		 </form>
  <hr><h2>Riadiaci mikrokontróler</h2><hr>
  <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
	<select name="mikrokontroler">
  <option value="W5100" <?php if($vsetko['mikrokontroler']=="W5100"){echo 'selected';}?>>Arduino + Ethernet W5100</option>
  <option value="W5500" <?php if($vsetko['mikrokontroler']=="W5500"){echo 'selected';}?>>Arduino + Ethernet W5500</option>
  <option value="ESP8266" <?php if($vsetko['mikrokontroler']=="ESP8266"){echo 'selected';}?>>ESP8266</option>
  <option value="ESP32" <?php if($vsetko['mikrokontroler']=="ESP32"){echo 'selected';}?>>ESP32</option>
</select>
<input type="submit" class="btn btn-danger" name="zmenmikrokontroler" value="Zmeniť">  
		 </form>
		   </center>
  
  </div>

</div>
<hr>
<?php
 include("footer.php");
?> </div></div></div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
</html>
<?php }else{
	header("Location: ../index.php");	
} ?>