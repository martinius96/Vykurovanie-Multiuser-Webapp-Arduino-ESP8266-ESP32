<?php 
$con = mysqli_connect("localhost","POUZIVATEL_DB","HESLO_DB","DATABAZA_MENO");
     mysqli_set_charset($con,"utf8");
     
if (mysqli_connect_errno())
  {
  echo "Problem s napojenim na DB: " . mysqli_connect_error();
  }

 $front_salt=("meteostanice"); 
  
  
   $back_salt=("backend");
?>
