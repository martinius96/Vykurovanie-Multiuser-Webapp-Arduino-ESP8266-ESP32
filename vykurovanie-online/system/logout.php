<?php
error_reporting(0); 
include ('../global/functions.php');
 include ('../global/safe.php'); 
session_start();
session_destroy();
header("Location: ../index.php");
echo 'Boli ste �spe�ne odhl�sen�' ;
 

?>
