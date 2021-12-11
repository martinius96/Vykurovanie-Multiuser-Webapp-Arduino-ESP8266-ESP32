<?php
error_reporting(0);
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
?>	
</head>
<?php $stranka = "Dashboard";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">									
<?php 
if(isset($_POST['zapis_hodnoty'])){
$vsetko_get = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
$vsetko = mysqli_fetch_assoc($vsetko_get);
$teplota1 = mysqli_real_escape_string($con, $_POST["teplomer1"]);
$teplota2 = mysqli_real_escape_string($con, $_POST["teplomer2"]);
$teplota3  = mysqli_real_escape_string($con, $_POST["teplomer3"]);
$teplota4  = mysqli_real_escape_string($con, $_POST["teplomer4"]);
$teplota5  = mysqli_real_escape_string($con, $_POST["teplomer5"]);
$teplota6  = mysqli_real_escape_string($con, $_POST["teplomer6"]);
$kodik = $vsetko['code'];
$ins = mysqli_query($con,"INSERT INTO `data_vykurovanie` (`teplota1`,`teplota2`,`teplota3`,`teplota4`,`teplota5`,`teplota6`,`code`) VALUES ('$teplota1', '$teplota2', '$teplota3', '$teplota4', '$teplota5', '$teplota6', '$kodik')") or die (mysqli_error($con));
?>
<div class="alert alert-info">
<b>Teploty zapísané!</b>
</div>
<?php
}
?>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer1" required><br> 
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer2" required><br> 
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer3" required> <br>
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer4" required> <br>
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer5" required> <br>
			<input  type="number" min=-30 max=75 step=0.5 name="teplomer6" required> <br>
			<input type="submit" class="btn btn-success" name="zapis_hodnoty" value="Zapísať" disabled>
</form>
<div class="alert alert-success">
<strong>Teplota v zelenom rámiku predstavuje riadiacu teplotu pre termostat.</strong>
</div> 
<div id="tabulka"></div>		 
</div>
</div>
<hr>
<?php
 include("footer.php");
?>  </div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
 <script>
$(function() {
        $.get('logika.php', function(data){
        	$('#logika').text(data)
    	});
	$.get('get_tabulka.php', function(data){
        	$('#tabulka').html(data)
    	});
  }); 
</script>
</html>
<?php }else{
	header("Location: ../index.php");	
} ?>
