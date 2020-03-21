<?php 
 include("system/connect.php");
 ?>
 <html lang="sk">

<head>
<meta name=description content="Status služieb webaplikácie vykurovania online">
<title>Status služieb - vykurovanie online</title>
<meta name=keywords content="vykurovanie, kúrenie, iot, esp32, esp8266, arduino, pec, kotol, služby, uptime, down, up">
<link rel="icon" type="image/png" href="https://i.nahraj.to/f/29ok.png" />
<meta name="robots" content="index,follow">
<meta name="revisit-after" content="2 days">
<meta name="rating" content="general">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<!-- Start Google Analytics -->

<!-- End Google Analytics -->
	<title></title>
<!-- Google Fonts -->
	<link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700|Lato:400,100,300,700,900' rel='stylesheet' type='text/css'>
  <!-- End Google Fonts -->
  <!-- Custom Stylesheet -->
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/style_index.css">
<style>
body {margin: 0;}

ul.topnav {
    list-style-type: none;
    margin: 0;
    padding: 0;
    overflow: hidden;
    background-color: #333;
}

ul.topnav li {float: left;}

ul.topnav li a {
    display: block;
    color: white;
    text-align: center;
    padding: 14px 16px;
    text-decoration: none;
}

ul.topnav li a:hover:not(.active) {background-color: #111;}

ul.topnav li a.active {background-color: #4CAF50;}

ul.topnav li.right {float: right;}

@media screen and (max-width: 600px){
    ul.topnav li.right, 
    ul.topnav li {float: none;}
}
</style>
  </head>
  <body>
  <div>
<ul class="topnav">
  <li><a  href="index.php">PRIHLÁSENIE</a></li>
  <li><a href="register.php">REGISTRÁCIA</a></li>
  <li class="right"><a class="active" href="status.php">STATUS</a></li>
</ul>
</div>
<?php 
$zaznamy = mysqli_query($con,"SELECT * FROM `data_vykurovanie`") or die(mysqli_error($con));
$pouzivatelia = mysqli_query($con,"SELECT * FROM `user_vykurovanie`") or die(mysqli_error($con));
?>
  <?php
  
//Page Variables 
  $online='<td style="background-color:#00FF00; padding:5px;">' . "Beží". '</td>';
 
    $offline='<td style="background-color:#FF0000; padding:5px;">' .  "Nebeží" . '</td>';
//Functions 
    function servercheck($server,$port){ 
        //Check that the port value is not empty 
        if(empty($port)){ 
            $port=80; 
        } 
        //Check that the server value is not empty 
        if(empty($server)){ 
            $server='localhost'; 
        } 
        //Connection 
        $fp=@fsockopen($server, $port, $errno, $errstr, 1); 
            //Check if connection is present 
            if($fp){ 
                //Return Alive 
                return 1; 
            } else{ 
                //Return Dead 
                return 0; 
            } 
        //Close Connection 
        fclose($fp); 
    } 
//Ports and Services to check 
$services=array( 
    "HTTP spojenie" => array($_SERVER['SERVER_NAME'] => 80), 
    "HTTPS spojenie" => array($_SERVER['SERVER_NAME'] => 443),
    "Databáza" => array('localhost' => 3306)  
   
); 
?> 

	<div class="container">
		<div class="top">
		
		</div>
		<div class="login-box animated fadeInUp">
      
			<div class="box-header">
				<h2>STATUS SLUŽIEB</h2>
        
			</div>
     
       <table width="300px"> 
<?php 
//Check All Services 
foreach($services as $name => $server){ 
?> 
    <tr> 
    <td><?php echo $name; ?></td> 
<?php 
    foreach($server as $host => $port){ 
        if(servercheck($host,$port)){ echo $online; }else{ echo $offline; } 
    } 
?> 
    </tr> 
<?php 
} 
?>
 
</table>
  <h3><font color="black">Záznamov: <?php echo mysqli_num_rows($zaznamy); ?></font></h3>
  <h3><font color="black">Registrovných používateľov: <?php echo mysqli_num_rows($pouzivatelia); ?></font></h3>
		</div>
	</div>
</body>

