   <nav class="navbar navbar-expand-lg navbar-dark bg-dark static-top">
      <div class="container">
      <a class="navbar-brand" href="index.php">Vykurovanie - webapp</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
           <ul class="navbar-nav ml-auto">
             <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">
      <img src="https://image.flaticon.com/icons/png/512/354/354574.png" width=32px height=32px>Rozhranie
    </button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if ($stranka == "Dashboard"){ echo "active";} ?>" href="index.php">Prehľad</a>
      <a class="dropdown-item nav-item <?php if ($stranka == "Termostat"){ echo "active";} ?>" href="termostat.php">Termostat</a>
      <a class="dropdown-item nav-item <?php if ($stranka == "Teploty"){ echo "active";} ?>" href="data.php">História</a>
      <a class="dropdown-item nav-item <?php if ($stranka == "Grafy"){ echo "active";} ?>" href="grafy.php">Grafy</a>
    </div>
  </div>
  <div class="dropdown">
    <button type="button" class="btn btn-secondary dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" style="border-radius: 50px; background-color: #D35400;">
      <img src="https://image.flaticon.com/icons/svg/149/149071.svg" width=32px height=32px>Používateľ
    </button>
    <div class="dropdown-menu" style="background-color: #C0392B;">
      <a class="dropdown-item nav-item <?php if ($stranka == "Profil"){ echo "active";} ?>" href="profil.php">Profil a nastavenia</a>
      <a class="dropdown-item nav-item <?php if ($stranka == "Chat"){ echo "active";} ?>" href="chat.php">Chat</a>
      <a class="dropdown-item nav-item <?php if ($stranka == "Kod"){ echo "active";} ?>" href="kod.php">Zdrojový kód</a>
      <a class="dropdown-item nav-item " href="logout.php">Odhlásiť sa</a>
    </div>
  </div>
<li class="nav-item" id="right">
            <a href="https://www.paypal.me/chlebovec" class="btn btn-success" role="button" style="border-radius: 25px;"><img src="https://image.flaticon.com/icons/svg/888/888870.svg" width=32px height=32px>Podpora</a>
            </li>
          </ul>        </div>
      </div>
    </nav>

