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
<?php //<div class="alert alert-danger">
//<strong>Dáta na tento stránke obnovuje na pozadí AJAX každých 15 sekúnd. Zobrazia sa automaticky.</strong>
//</div>  ?>
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
