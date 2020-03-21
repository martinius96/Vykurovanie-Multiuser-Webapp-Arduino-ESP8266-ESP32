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
<?php $stranka = "Teploty";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
?>	
  <div class="container">
      <div class="row">
        <div class="col-lg-12">							
<h2><font color="black">História teplôt v čase</font></h2>
		<?php						
	  $kod_get = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $kod = mysqli_fetch_assoc($kod_get);
 $kodik = $kod['code']; 
 $teplomery = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kodik."'") or die(mysqli_error($con));
 $teplomer = mysqli_fetch_assoc($teplomery); 
	  ?>
	<table style="width: 100%; border: 1px solid black;">
									 <tr  style="border: 1px solid black;">
									 <th style="width: 14.28%; border: 1px solid black;">Čas</th>
									 <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer1']; ?></th>
									  <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer2']; ?></th>
									   <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer3']; ?></th>
									    <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer4']; ?></th>
										 <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer5']; ?></th>
										  <th style="width: 14.28%; border: 1px solid black;"><?php  echo $teplomer['teplomer6']; ?></th>
									 
									 </tr>
<?php


 	$teploty = mysqli_query($con,"SELECT * FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER by `time` DESC LIMIT 100") or die(mysqli_error($con));
  	$teploty2 = mysqli_query($con,"SELECT * FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER by `time` DESC LIMIT 100") or die(mysqli_error($con)); 
		mysqli_fetch_assoc($teploty2);
		 while(($line = mysqli_fetch_assoc($teploty))&&($line2 = mysqli_fetch_assoc($teploty2))){
			echo "<tr style='border: 1px solid black;'>";
			$casik = date('d. M H:i',strtotime($line['time']));	
       $vysledok1 = $line['teplota1']- $line2['teplota1'];
       if($vysledok1==0.00){
         $vysledok1 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok1, 2, '.', '')." °C'>";
       }else if($vysledok1>0.00){  
           $vysledok1 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok1, 2, '.', '')." °C'>";
       }else if($vysledok1<0.00){
          $vysledok1 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok1, 2, '.', '')." °C'>";
       }
       
       $vysledok2 = $line['teplota2']- $line2['teplota2'];
       if($vysledok2==0.00){
         $vysledok2 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok2, 2, '.', '')." °C'>";
       }else if($vysledok2>0.00){  
           $vysledok2 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok2, 2, '.', '')." °C'>";
       }else if($vysledok2<0.00){
          $vysledok2 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok2, 2, '.', '')." °C'>";
       }
       
       $vysledok3 = $line['teplota3']- $line2['teplota3'];
       if($vysledok3==0.00){
         $vysledok3 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok3, 2, '.', '')." °C'>";
       }else if($vysledok3>0.00){  
           $vysledok3 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok3, 2, '.', '')." °C'>";
       }else if($vysledok3<0.00){
          $vysledok3 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok3, 2, '.', '')." °C'>";
       }
       
       $vysledok4 = $line['teplota4']- $line2['teplota4'];
       if($vysledok4==0.00){
         $vysledok4 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok4, 2, '.', '')." °C'>";
       }else if($vysledok4>0.00){  
           $vysledok4 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok4, 2, '.', '')." °C'>";
       }else if($vysledok4<0.00){
          $vysledok4 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok4, 2, '.', '')." °C'>";
       }
       
       $vysledok5 = $line['teplota5']- $line2['teplota5'];
       if($vysledok5==0.00){
         $vysledok5 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok5, 2, '.', '')." °C'>";
       }else if($vysledok5>0.00){  
           $vysledok5 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok5, 2, '.', '')." °C'>";
       }else if($vysledok5<0.00){
          $vysledok5 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok5, 2, '.', '')." °C'>";
       }
       
       $vysledok6 = $line['teplota6']- $line2['teplota6'];
       if($vysledok6==0.00){
         $vysledok6 = "<img src='https://image.flaticon.com/icons/svg/179/179385.svg' height='32px' width='32px' title='Ustálená hodnota: ".number_format((float)$vysledok6, 2, '.', '')." °C'>";
       }else if($vysledok6>0.00){  
           $vysledok6 = "<img src='https://cdn3.iconfinder.com/data/icons/musthave/256/Stock%20Index%20Up.png' height='32px' width='32px' title='Stúpajúca tendencia o: ".number_format((float)$vysledok6, 2, '.', '')." °C'>";
       }else if($vysledok6<0.00){
          $vysledok6 = "<img src='http://www.stickpng.com/assets/images/58f8bd2e0ed2bdaf7c128309.png' height='32px' width='32px' title='Klesajúca tendencia o: ".number_format((float)$vysledok6, 2, '.', '')." °C'>";
       }
       echo "<td style='border: 1px solid black;'><b>". $casik . "</b></td>";
			echo "<td style='border: 1px solid black;'><i>" .$vysledok1.$line['teplota1'] . " °C".  "</i></td>";
			echo "<td style='border: 1px solid black;'><i>" .$vysledok2.$line['teplota2'] . " °C".  "</i></td>";
      echo "<td style='border: 1px solid black;'><i>" .$vysledok3.$line['teplota3'] . " °C".  "</i></td>";
      echo "<td style='border: 1px solid black;'><i>" .$vysledok4.$line['teplota4'] . " °C".  "</i></td>";
      echo "<td style='border: 1px solid black;'><i>" .$vysledok5.$line['teplota5'] . " °C".  "</i></td>";
      echo "<td style='border: 1px solid black;'><i>" .$vysledok6.$line['teplota6'] . " °C".  "</i></td>";
			echo "</tr>";
		}  ?> </tbody></table>
    <hr>
<?php
 include("footer.php");
?>  </div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
 <script>
$(function() {
    $.get('get_tabulka.php', function(data){
        $('#tabulka').html(data)
    });
    $.get('logika.php', function(data){
        $('#logika').text(data)
    });
  }); 
</script>
<script>
setInterval(function(){
  $.get('get_tabulka.php', function(data){
  $('#tabulka').html(data)
  });
  $.get('logika.php', function(data){
  $('#logika').text(data)
  });
  },15000);   
</script>
</html>
<?php }else{
	header("Location: ../index.php");	
} ?>
