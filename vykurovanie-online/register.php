<!DOCTYPE html>
<?php  
 include("system/connect.php");
 session_start();
 error_reporting(0);
?>
 <html lang="sk">

<head>
<meta name=description content="Registrácia do webaplikácie vykurovania online">
<title>Registrácia - vykurovanie online</title>
<link rel="icon" type="image/png" href="https://i.nahraj.to/f/29ok.png" />
<meta name=keywords content="vykurovanie, kúrenie, iot, esp32, esp8266, arduino, pec, kotol, registrácia">
<meta name="robots" content="index,follow">
<meta name="revisit-after" content="2 days">
<meta name="rating" content="general">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<script type="text/javascript">
    window.smartlook||(function(d) {
    var o=smartlook=function(){ o.api.push(arguments)},h=d.getElementsByTagName('head')[0];
    var c=d.createElement('script');o.api=new Array();c.async=true;c.type='text/javascript';
    c.charset='utf-8';c.src='https://rec.smartlook.com/recorder.js';h.appendChild(c);
    })(document);
    smartlook('init', 'db50efe9fff280a17db52b82be221240cbbd3dbe');
</script>
    <!-- Global Site Tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-76290977-2"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-76290977-2');
</script>

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
  <li><a class="active" href="register.php">REGISTRÁCIA</a></li>
  <li class="right"><a  href="status.php">STATUS</a></li>
</ul>
</div>
  <?php  
 if(isset($_SESSION['uid'])){  ?>
										<center>
										<div class="login-box animated fadeInUp">
      
			<div class="box-header">
											<h2> STE PRIHLÁSENÝ! </h2>
											<br>
												<br>
												
												<a href='system/index.php'>
													<button type="button"  class="xmiddle green button round">Späť do systému</button>
												</a>
												<a href='system/logout.php'>
													<button type="button"  class="xmiddle red button round">Odhlásiť</button>
												</a> 
                       </div>
					   </div>
											</center>
<?php  } else {
  
?> 
	<div class="container">
		<div class="top">
		
		</div>
		<div class="login-box animated fadeInUp">
      
			<div class="box-header">
				<h2>REGISTRÁCIA</h2>
        
			</div>
     
     <?php
			include("global/functions.php");
function generate_code($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomCode = '';
    for ($i = 0; $i < $length; $i++) {
        $randomCode .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomCode;
}
  
?>
											<?php if(isset($_POST['register'])){
   $username = mysqli_real_escape_string($con, $_POST['username']);
   $username = htmlspecialchars( $username, ENT_QUOTES );
   $username = trim( $username );
   
   
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password = htmlspecialchars( $password, ENT_QUOTES );
    $password = trim( $password );
	
   $email= mysqli_real_escape_string($con, $_POST['email']);
   $email = htmlspecialchars( $email, ENT_QUOTES );
   $email = trim( $email );
   
    $mikrokontroler= mysqli_real_escape_string($con, $_POST['mikrokontroler']);
   $mikrokontroler = htmlspecialchars( $mikrokontroler, ENT_QUOTES );
   $mikrokontroler = trim( $mikrokontroler );

  $hardver= mysqli_real_escape_string($con, $_POST['hardver']);
   $hardver = htmlspecialchars( $hardver, ENT_QUOTES );
   $hardver = trim( $hardver );
   

  if($username == "" || $password == "" || $email == "" || $mikrokontroler == "" || $hardver == ""){
    echo "Na niečo si zabudol!";
  }elseif(strlen($username) > 30){
    echo "Tvoje meno je veľmi dlhé!";
  }elseif(strlen($email) > 100){
    echo "Tvoj e-mail je veľmi dlhý!";
  }else{
    $register1 = mysqli_query($con,"SELECT `id` FROM `user_vykurovanie` WHERE `username`='$username'") or die(mysqli_error($con));
    $register2 = mysqli_query($con,"SELECT `id` FROM `user_vykurovanie` WHERE `email`='$email'") or die(mysqli_error($con));
    if(mysqli_num_rows($register1) > 0){
      echo "Toto meno je už používané!";
    }elseif(mysqli_num_rows($register2) > 0){
      echo "Tento e-mail je už používaný!";
    }else{
      if($mikrokontroler ==  "images/w5100.png"){ $mikrokontroler = "W5100"; }
      elseif($mikrokontroler ==  "images/w5500.png"){ $mikrokontroler = "W5500"; 
      }elseif($mikrokontroler ==  "images/nodemcu.png"){ $mikrokontroler = "ESP8266"; }
     elseif($mikrokontroler ==  "images/esp32.png"){ $mikrokontroler = "ESP32"; 
      } 
      if($hardver ==  "images/ds18b20.jpg"){ $hardver = "DS18B20"; }
	  else if($hardver ==  "images/pt100.jpg"){ $hardver = "PT100"; }
      $code = generate_code();
$ins = mysqli_query($con,"INSERT INTO `user_vykurovanie` (`username`,`password`,`email`,`mikrokontroler`,`hardver`,`activated`,`code`) VALUES ('$username', '".password_hash($password, PASSWORD_DEFAULT)."', '$email','$mikrokontroler','$hardver', 1, '$code')") or die (mysqli_error($con));
$teplomer1 = "Teplomer1";
$teplomer2 = "Teplomer2";
$teplomer3 = "Teplomer3";
$teplomer4 = "Teplomer4";
$teplomer5 = "Teplomer5";
$teplomer6 = "Teplomer6";
$ins = mysqli_query($con,"INSERT INTO `teplomery_vykurovanie` (`teplomer1`,`teplomer2`,`teplomer3`,`teplomer4`,`teplomer5`,`teplomer6`,`cislo`,`referencia`,`hystereza`,`rezim`,`stav`,`code`) VALUES ('$teplomer1', '$teplomer2', '$teplomer3','$teplomer4','$teplomer5', '$teplomer6', 1, 20.25, 0.5,'Manual','VYP','$code')") or die (mysqli_error($con));
 echo "Si úspešne zaregistrovaný!";
    }
  }
  }

?>  
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
		
			<br>
			<input  type="text" name="username"  alt="username" placeholder="Používateľské meno" required style=width:300px />         <br>
                                                                  
<input type="password" name="password" alt="password" placeholder="Heslo" required style=width:300px />
                                                                <br>
         	<input type="text" name="email" alt="email" placeholder=E-mail required style=width:300px />

			<br>    	
<center><b>Mikrokontróler</b></center>
<img id="image" src="images/w5100.png" /><br>
<select id="mikrokontroler" name="mikrokontroler">
    <option value="images/w5100.png">Arduino + Ethernet shield W5100</option>
    <option value="images/w5500.png">Arduino + Ethernet modul W5500</option>
    <option value="images/nodemcu.png">ESP8266</option>
	<option value="images/esp32.png">ESP32</option>
	<option disabled value="images/esp32.png">micro:bit</option>
	<option disabled value="images/esp32.png">RaspBerry Pi</option>
	<option disabled value="images/esp32.png">Bigclown</option>
</select><script>
function setCar() {
    var img = document.getElementById("image");
    img.src = this.value;
    return false;
}
document.getElementById("mikrokontroler").onchange = setCar;
</script>
<br>
<center><b>Hardvér - 6x teploty</b></center>
<img id="imageh" src="images/ds18b20.jpg" /><br>
<select id="hardver" name="hardver">
    <option value="images/ds18b20.jpg">DS18B20</option>
    <option disabled value="images/pt100.jpg">PT100</option>
</select><script>
function setHardware() {
    var img = document.getElementById("imageh");
    img.src = this.value;
    return false;
}
document.getElementById("hardver").onchange = setHardware;
</script><br>
<button type="submit" name="register" class="xmiddle green button round">REGISTROVAŤ</button>
                          
												
		<br> <hr>
      <p>Si už registrovaný?</p> 	<a href="index.php"><button type="button">Prihlásiť sa</button></a>
     
		   </form> 
<?php } ?>
		</div>
	</div>
</body>

