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
<title>Chat webaplikácia</title>
<?php 
include ("meta.php");    
?>	
</head>
<?php $stranka = "Chat";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
$vsetko_get = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
$vsetko = mysqli_fetch_assoc($vsetko_get);
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">									
          	 <?php   if(isset($_POST['odoslat'])){
       $text = mysqli_real_escape_string($con, $_POST['text']);
       $ins = mysqli_query($con,"INSERT INTO `chat_vykurovanie` (`username`,`text`) VALUES ('".$vsetko['username']."', '$text')") or die (mysqli_error($con));	
    }
        ?>
<hr><center><h2>Diskusný chat</h2><hr></center>
			<p id="getspravy"></p>
		<center><form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
		<div class="form-group">
 <input type="text" name="text" placeholder="Napíšte vašu správu" required  style="width: 100%;">
</div>
		
		
		<div class="form-group">
               <input type="submit" name="odoslat" class="btn btn-danger" value="Odoslať"></div>    </form> </center>
<hr>
<footer>
<table style="width: 100%;" border="0">
	<tr>
		<th style="width: 25%;"><center><font color="#566573">Programovo vyhotovil: <a href="mailto:martinius96@gmail.com" id="a">Martin Chlebovec</font></a></center></th>
		<th style="width: 25%;"><center><font color="#566573">Licencia použitia projektu: <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/LICENSE" id="b">MIT</a></font></center></th>
		<th style="width: 25%;"><center><font color="#566573">Frontend + Grid systém: Bootstrap</font></center></th>					
    <th style="width: 25%;"><center><a href="https://www.facebook.com/martin.s.chlebovec"><img src="https://www.flaticon.com/premium-icon/icons/svg/2392/2392485.svg" style="height: 24px; width: 24px;"></a>
    <a href="https://github.com/martinius96/RFID-otvaranie-dveri/blob/master/LICENSE"><img src="https://image.flaticon.com/icons/svg/2111/2111432.svg" style="height: 24px; width: 24px;"></a>
    <a href="https://paypal.me/chlebovec/1"><img src="https://image.flaticon.com/icons/svg/217/217422.svg" style="height: 24px; width: 24px;"></a></center></th>							 
  </tr>
</table>
</footer>  </div>  </div>  </div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
</html>
  <script>
  $(function() {
     $.get('get_spravy.php', function(data){
        $('#getspravy').html(data)
    });
  });
  </script>
  <script>
       setInterval(function(){
   $.get('get_spravy.php', function(data){
        $('#getspravy').html(data)
    });
},10000);   
</script>
<?php }else{
	header("Location: ../index.php");	
} ?>