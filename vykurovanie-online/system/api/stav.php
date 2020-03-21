<?php
	include ("../connect.php");
  $token   = mysqli_real_escape_string($con, $_GET["token"]);
  $username   = mysqli_real_escape_string($con, $_GET["username"]);
	$stav = mysqli_query($con,"SELECT stav FROM `teplomery_vykurovanie` WHERE `code`='".$token."'") or die(mysqli_error($con));
    if(mysqli_num_rows($stav) < 1){   
 echo "Autenzizácia neúspešná! - Zlý/Neexistujúci token";
    }else{   
    $user_get = mysqli_query($con,"SELECT username FROM `user_vykurovanie` WHERE `code`='".$token."'") or die(mysqli_error($con));
    $user = mysqli_fetch_assoc($user_get); 
    if($user['username']!= $username){
    echo "Chyba autentizácie!"; 
    }else{
 $teplota1 = mysqli_fetch_assoc($stav); 
echo $teplota1['stav']; 
}
 }
?>