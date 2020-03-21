	<?php
	error_reporting(0);
session_start();
	include ("connect.php");
	$kod_get = mysqli_query($con,"SELECT code FROM `user_vykurovanie` WHERE `id`='".$_SESSION['uid']."'") or die(mysqli_error($con));
 $kod = mysqli_fetch_assoc($kod_get);
 $kodik = $kod['code']; 
	$get_teplota = mysqli_query($con,"SELECT * FROM `data_vykurovanie` WHERE `code`='".$kodik."' ORDER BY `time` DESC LIMIT 1") or die(mysqli_error($con));
 $teploty = mysqli_fetch_assoc($get_teplota); 
 $get_riadiaca_teplota = mysqli_query($con,"SELECT * FROM `teplomery_vykurovanie` WHERE `code`='".$kodik."'") or die(mysqli_error($con));
 $riadiaca_teplota = mysqli_fetch_assoc($get_riadiaca_teplota); 
 ?>
<h2>Údaje</h2>
<table class="table table-striped" style="color: black;">
  <thead>
  <tr>
    <th><strong>Umiestnenie</strong></th>
    <th><strong>Hodnota</strong></th>
  </tr>
  <tr <?php if($riadiaca_teplota['cislo']==1){ ?> style="background: #52BE80;" <?php } ?>>
    <td><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer1']; ?> </b></font></h3></td>
    <td><?php echo $teploty['teplota1']. " °C"; ?></td>
  </tr>
  <tr <?php if($riadiaca_teplota['cislo']==2){ ?> style="background: #52BE80;" <?php } ?>>
    <td><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer2']; ?>	</b></font></h3></td>
    <td><?php echo $teploty['teplota2']. " °C"; ?></td>
  </tr>
  <tr <?php if($riadiaca_teplota['cislo']==3){ ?> style="background: #52BE80;" <?php } ?>>
    <td ><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer3']; ?> </b></font></h3></td>
    <td><?php echo $teploty['teplota3']. " °C"; ?></td>
  </tr>
  <tr <?php if($riadiaca_teplota['cislo']==4){ ?> style="background: #52BE80;" <?php } ?>>
    <td ><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer4']; ?> </b></font></h3></td>
    <td><?php echo $teploty['teplota4']. " °C"; ?></td>
    </tr>
  <tr <?php if($riadiaca_teplota['cislo']==5){ ?> style="background: #52BE80;" <?php } ?>>
    <td ><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer5']; ?> </b></font></h3></td>
    <td><?php echo $teploty['teplota5']. " °C"; ?></td>
  </tr>
  <tr <?php if($riadiaca_teplota['cislo']==6){ ?> style="background: #52BE80;" <?php } ?>>
    <td ><h3 ><font color="black"><img src="https://image.flaticon.com/icons/svg/603/603463.svg" width=32px height=32px> <b><?php echo $riadiaca_teplota['teplomer6']; ?> </b></font></h3></td>
    <td><?php echo $teploty['teplota6']. " °C"; ?></td>
  </tr>  
  </thead>
</table>
<h2>Vykurovanie</h2>
<table class="table table-striped" style="color: black;">
  <thead>
  <tr>
    <th><strong>Teplota (riadiaci teplomer)</strong></th>
    <th><strong>Stav</strong></th>
    <th><strong>Režim</strong></th>
    <th><strong>Referencia</strong></th>
    <th><strong>Hysteréza</strong></th>
  </tr>
  <tr>
    <td><h3 ><font color="black"><img src="https://i.nahraj.to/f/29ok.png" width=32px height=32px> <b><?php echo $teploty["teplota".$riadiaca_teplota['cislo']]. " °C"; ?></b></font></h3></td>
    <td><?php echo $riadiaca_teplota['stav']; ?> </td>
    <td><?php echo $riadiaca_teplota['rezim']; ?> </td>
    <td><?php echo $riadiaca_teplota['referencia']. " °C"; ?></td>
    <td><?php echo "± ".$riadiaca_teplota['hystereza']. " °C"; ?> </td>
  </tr>  
  </thead>
</table>
<?php
$prevedeny = strtotime($teploty['time']);
$teraz = date("d. M H:i:s", $prevedeny );  
?>
<center><h3><font color="black">Posledný online záznam: </h3><h3><?php echo $teraz; ?></font></h3></center>