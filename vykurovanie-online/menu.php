<!-- NAVBAR -->
		<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="index.php"><img src="assets/img/logo-dark.png" alt="Klorofil Logo" class="img-responsive logo"></a>
			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
					<button type="button" class="btn-toggle-fullwidth"><img src="https://image.flaticon.com/icons/svg/148/148795.svg" width=32px height=32px></button>
				</div>
				
			
		
			</div>
		</nav>
		<!-- END NAVBAR -->
		<!-- LEFT SIDEBAR -->
		<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="index.php" class="<?php if ($stranka == "Dashboard"){ echo "active";} ?>"><img src="https://image.flaticon.com/icons/png/512/354/354574.png" width=32px height=32px> <span>Prehľad</span></a></li>
						<li><a href="data.php" class="<?php if ($stranka == "Teploty"){ echo "active";} ?>"><img src="https://image.flaticon.com/icons/svg/305/305101.svg" width=32px height=32px> <span>História meraní</span></a></li>
						<li><a href="grafy.php" class="<?php if ($stranka == "Grafy"){ echo "active";} ?>"><img src="https://image.flaticon.com/icons/svg/265/265740.svg" width=32px height=32px> <span>Grafy</span></a></li>
						<li><a href="kod.php" class="<?php if ($stranka == "Kod"){ echo "active";} ?>"><img src="https://image.flaticon.com/icons/svg/25/25185.svg" width=32px height=32px> <span>Zdrojový kód</span></a></li>
						<li><a href="profil.php" class="<?php if ($stranka == "Profil"){ echo "active";} ?>"><img src="https://image.flaticon.com/icons/svg/149/149071.svg" width=32px height=32px> <span>Profil</span></a></li>
						<li><a href="logout.php" class=""><img src="https://www.flaticon.com/premium-icon/icons/svg/709/709026.svg" width=32px height=32px> <span>Odhlásiť sa</span></a></li>
					</ul>
				</nav>
			</div>
		</div>

