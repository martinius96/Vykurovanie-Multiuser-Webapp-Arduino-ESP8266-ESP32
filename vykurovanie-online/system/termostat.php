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
<title>Termostat pre ovládanie kotla</title>
<?php 
include ("meta.php");
?>	
</head>
<?php $stranka = "Termostat";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">
									
									<?php
$vsetko_get = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $vsetko = mysqli_fetch_assoc($vsetko_get);
 $kod = $vsetko['code']; 
  if(isset($_POST['vypnimanualne'])){ 
   $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='VYP'WHERE `code`='".$kod."'") or die(mysqli_error($con));
  }
  if(isset($_POST['zapnimanualne'])){ 
   $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `stav`='ZAP'WHERE `code`='".$kod."'") or die(mysqli_error($con));
  }






if(isset($_POST['zapnimanual'])){ 
   $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `rezim`='Manual',`stav`='VYP'WHERE `code`='".$kod."'") or die(mysqli_error($con));
  }
  
  
  
  
  if(isset($_POST['zapniauto'])){ 
   $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `rezim`='Automat'WHERE `code`='".$kod."'") or die(mysqli_error($con));
  }




 
  if(isset($_POST['nastavenietermostatu'])){ 
   $referencia = mysqli_real_escape_string($con, $_POST['referencia']);
   $referencia = htmlspecialchars( $referencia, ENT_QUOTES );
   $referencia = trim( $referencia );
   $hystereza = mysqli_real_escape_string($con, $_POST['hystereza']);
   $hystereza = htmlspecialchars( $hystereza, ENT_QUOTES );
   $hystereza = trim( $hystereza );
  
  
   $update = mysqli_query($con,"UPDATE `teplomery_vykurovanie` SET `referencia`='".$referencia."',`hystereza`='".$hystereza."' WHERE `code`='".$kod."'") or die(mysqli_error($con));
  }


   $teplomery_get = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kod."'") or die(mysqli_error($con));
 $teplomer = mysqli_fetch_assoc($teplomery_get);
?>
		<!-- END LEFT SIDEBAR -->
		<!-- MAIN -->
		<div class="main">
			<!-- MAIN CONTENT -->
			<div class="main-content">
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<!-- TABLE STRIPED -->
							<div class="panel">
							<div class="panel-body">
							<h2><font color="black">Termostat - riadený podľa senzora - 
							<?php if($teplomer['cislo']==1){
								echo $teplomer['teplomer1'];
							}else if($teplomer['cislo']==2){
								echo $teplomer['teplomer2'];
							}else if($teplomer['cislo']==3){
								echo $teplomer['teplomer3'];
							} else if($teplomer['cislo']==4){
								echo $teplomer['teplomer4'];
							} else if($teplomer['cislo']==5){
								echo $teplomer['teplomer5'];
							} else if($teplomer['cislo']==6){
								echo $teplomer['teplomer6'];
							}  
							
							
							
							
							?> </font></h2>
								
	  <div class="row">
  <div class="col-sm-12">
  <center>
 <?php if(isset($_POST['zapniauto'])){ ?>
 <div class="alert alert-success">
Automatický režim úspešne zapnutý.
</div>
  <?php } ?>
   <?php if(isset($_POST['zapnimanual'])){ ?>
 <div class="alert alert-success">
Manuálny režim úspešne zapnutý, relé bezpečnostne nastavené na VYP.
</div>
  <?php } ?>
  
     <?php if(isset($_POST['zapnimanualne'])){ ?>
 <div class="alert alert-success">
Kotol úspešne zapnutý manuálne
</div>
  <?php } ?>
  
     <?php if(isset($_POST['vypnimanualne'])){ ?>
 <div class="alert alert-success">
Kotol úspešne vypnutý manuálne
</div>
  <?php } ?>
  
    <?php if(isset($_POST['nastavenietermostatu'])){ ?>
 <div class="alert alert-success">
Termostat úspešne nastavený
</div>
  <?php } ?>
  
  
  
  <?php if($teplomer['rezim']=="Manual"){?>
  	<center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
   <input type="submit" class="btn btn-danger" name="zapniauto" value="Prepnúť do automatického režimu s hysterézou">
   </form>
   </center>
	<?php  }else{ ?>
		
			<center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
   <input type="submit" class="btn btn-success" name="zapnimanual" value="Prepnúť do manuálneho režimu">
   </form>
   </center>
<?php	} ?>
  <h3>Momentálny režim: <?php echo $teplomer['rezim']; ?></h3></center>
  <?php 
  if($teplomer['rezim']=="Manual"){
  if($teplomer['stav']=="VYP"){ ?>
   <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
   <input type="submit" class="btn btn-danger" name="zapnimanualne" value="Zapnúť">
   </form>
   </center>
  <?php }else{ ?>
  	 <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
   <input type="submit" class="btn btn-success" name="vypnimanualne" value="Vypnúť">
   </form>
   </center>
	<?php if($teplomer['stav']=="ZAP"){ ?>
	<div class="alert alert-info"><img src="https://image.flaticon.com/icons/svg/564/564619.svg" width=32px height=32px>
  <strong>Upozornenie!</strong> Kotol vykuruje na dobu neurčitú manuálnym zapnutím!<br>Zvážte prechod na automatický režim, ktorý je kontrolovaný hysterézou a nevyžaduje zvýšenú pozornosť.
</div>
	
	<?php }
	
	?> 
  <?php }}
  if($teplomer['rezim']=="Automat"){?>
  <center><form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
  <b>Požadovaná teplota:</b><br>
   <input type="number" min="5" max="30" step="0.25" value="<?php echo $teplomer['referencia'];?>" name="referencia" required><br>
   <b>Hysteréza ± °C:</b><br>
<input type="number" min="0" max="10" step="0.25" value="<?php echo $teplomer['hystereza'];?>" name="hystereza" required><br>
  <input type="submit" class="btn btn-success" name="nastavenietermostatu" value="Nastaviť">
  <?php
  }
   ?>
</div>
      </div>
      <hr>
<?php
 include("footer.php");
?>  </div>    
</div>
</div>
</div>
</html>
<?php }else{
	header("Location: ../index.php");
	
} ?>


