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
?>	
</head>
<?php $stranka = "Grafy";?>
 <body onload="myFunction()">
<?php 
include ("menu.php");
?>	
  <div class="container" style="max-width: 100%;">
      <div class="row">
        <div class="col-lg-12">									
	<?php  $kod_get = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $kod = mysqli_fetch_assoc($kod_get);
 $kodik = $kod['code']; 
 
 
 $nazov_get = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kodik."'") or die(mysqli_error($con));
 $nazov = mysqli_fetch_assoc($nazov_get);
$result = mysqli_query($con,"SELECT * FROM `data_vykurovanie` WHERE `code`='".$kodik."' AND  date(time) = CURDATE()") or die(mysqli_error($con));
$rows = array();
$table = array();
$table['cols'] = array(
    array('label' => 'time', 'type' => 'string'),
    array('label' => $nazov['teplomer1'], 'type' => 'number'),
	 array('label' => $nazov['teplomer2'], 'type' => 'number'),
	  array('label' => $nazov['teplomer3'], 'type' => 'number'),
	   array('label' => $nazov['teplomer4'], 'type' => 'number'),
	    array('label' => $nazov['teplomer5'], 'type' => 'number'),
		 array('label' => $nazov['teplomer6'], 'type' => 'number')
	);
    foreach($result as $r) {
$cas = strtotime($r['time']);
	$cas = date('H:i',$cas);
        $temp = array();
        // The following line will be used to slice the Pie chart
        $temp[] = array('v' => (string) $cas);
        $temp[] = array('v' => (float) $r['teplota1']);
		 $temp[] = array('v' => (float) $r['teplota2']);
		  $temp[] = array('v' => (float) $r['teplota3']);
		   $temp[] = array('v' => (float) $r['teplota4']);
		    $temp[] = array('v' => (float) $r['teplota5']);
			 $temp[] = array('v' => (float) $r['teplota6']);
       // $temp[] = array('v' => (float) $r['teplota2']);
        $rows[] = array('c' => $temp);
        }
$table['rows'] = $rows;
$jsonTable = json_encode($table);?>	
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <script type="text/javascript">
    google.load('visualization', '1', {'packages':['corechart']});
    google.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = new google.visualization.DataTable(<?=$jsonTable?>);
      var options = {
          title: 'Aktuálny deň - teplota',
		  	  colors: ['red','black','yellow','orange','blue','green'],
			  pointSize: 1
          //is3D: 'true',
       //   width: 800,
         // height: 400
        };
      var chart = new google.visualization.LineChart(document.getElementById('chart_div'));
      chart.draw(data, options);

    }
    </script>
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
							<h2><font color="black">Grafy</font></h2>
								
	  <div class="row">
  <div class="col-sm-12">
   <div id="chart_div" style="display: block; width: 100%; height: 400px;"></div>
  
  
  </div>

</div>
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
</footer>   </div>    
	
	<!-- END WRAPPER -->
	<!-- Javascript -->	
</html>
<?php }else{
	header("Location: ../index.php");	
} ?>