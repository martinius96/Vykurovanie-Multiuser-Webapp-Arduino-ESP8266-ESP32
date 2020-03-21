<!DOCTYPE html>
<?php  
 include("system/connect.php");
 session_start();
 error_reporting(0);
?>
 <html lang="sk">

<head>
<meta name=description content="Prihlásenie do webaplikácie vykurovania online">
<link rel="icon" type="image/png" href="https://i.nahraj.to/f/29ok.png" />
<title>Prihlásenie - vykurovanie online</title>
<meta name=keywords content="vykurovanie, kúrenie, iot, esp32, esp8266, arduino, pec, kotol, prihlásenie, login, meno, heslo">
<meta name="robots" content="index,follow">
<meta name="revisit-after" content="2 days">
<meta name="rating" content="general">
<meta name="viewport" content="width=device-width, initial-scale=1">
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
.alert-danger{color:#a94442;background-color:#f2dede;border-color:#ebccd1}
</style>
  </head>
  <body>
  <div>
<ul class="topnav">
  <li><a  class="active" href="index.php">PRIHLÁSENIE</a></li>
  <li><a href="register.php">REGISTRÁCIA</a></li>
  <li class="right"><a  href="status.php">STATUS</a></li>
</ul>
</div>
<?php 
$zaznamy= mysqli_query($con,"SELECT * FROM `data_vykurovanie`") or die(mysqli_error($con));
?>
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
                        <h2><font color="white">Záznamov: <?php echo mysqli_num_rows($zaznamy); ?></font></h2>
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
				<h2>PRIHLÁSENIE</h2>
        
			</div>
 <?php     if(isset($_POST['odoslat'])){   

    $username = mysqli_real_escape_string($con, $_POST['username']);
    $username = trim( $username );
    $username = htmlspecialchars( $username, ENT_QUOTES );
     
    $password = mysqli_real_escape_string($con, $_POST['password']);
    $password = trim( $password );
    $password = htmlspecialchars( $password, ENT_QUOTES );  
  
     $login_check = mysqli_query($con,"SELECT * FROM `user_vykurovanie` WHERE `username`='$username'") or die (mysqli_error($con));
    if(mysqli_num_rows($login_check) > 0){    
      $get_id = mysqli_fetch_assoc($login_check);
      if (password_verify($password, $get_id['password'])) {
        $_SESSION['uid'] = $get_id['id'];
        header("Location: system/index.php");
      }else {
        echo '<div style="color:#a94442; background-color:#f2dede; border-color:#ebccd1;">
  	    <strong>Zlá kombinácia mena a hesla!</strong>
		    </div>';
      } 
    }else{
      echo '<div style="color:#a94442; background-color:#f2dede; border-color:#ebccd1;">
  		<strong>Používateľské meno neevidované!</strong>
		  </div>';       
    } 
}     ?>
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>"  method="post">
		
			<br>
			<input  type="text" name="username"  alt="username" placeholder="Prihlasovacie meno" style=width:300px />         <br>
                                                                  
<input type="password" name="password" alt="password" placeholder="Heslo" style=width:300px />
                                                                <br>

			<br>
			<button type="submit" name="odoslat">Prihlásiť!</button>
      
			<br>
      <h2><font color="black">Záznamov: <?php echo mysqli_num_rows($zaznamy); ?></font></h2>
       <hr>
      <p>Nemáte ešte účet?</p> 	<a href="register.php"><button type="button">Registrovať</button></a>
		   </form> 
<?php } ?>
		</div>
	</div>
</body>

