<?php

function printHead($title){
  echo("
  <title>".$title."</title>
  <meta charset=\"UTF-8\">
  <meta name=\"description\" content=\"Servizio di prenotazione biglietti per eventi di vario genere\">
  <meta name=\"keywords\" content=\"eventi, spettacoli, cinema, teatro, cultura, eventi sportivi, fiere, musei, musica\">
  <meta name=\"author\" content=\"Gruppo di progetto Tecnologie Web\">
  <script type=\"text/javascript\" src=\"js/functions.js\"></script>
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/screen.css\" >
  <link rel=\"stylesheet\" type=\"text/css\" media=\"(max-width: 540px)\" href=\"css/mobile.css\">
  <link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"css/print.css\">
  ");
}

function printHeader(){
  echo("
  <div id='logoTitle'>
  <img src=\"img/icone/view.png\" alt=\"Logo della biglietteria online\" title=\"Logo\" >
  <a href=\"javascript:void(0);\" class=\"icon\" onclick=\"menuResponsive()\">&#9776;</a>
  <h1>Biglietteria</h1>
  </div>

  <div id='findAll'>
  <input type=\"text\" name=\"fname\" placeholder='Cerca'>
  </div>
  ");
  //consima sotto l'header (per ora messaggi) se ce ne sono

}

function printNavBar(){
  //bisognerà discriminare il fatto che l' utente sia loggato o meno
  //TODO: non vanno messi span?
  echo("
  <ul>
  <li lang=\"en\"><a href=\"home.php\">Home</a></li>
  <li lang=\"it\"><a href=\"info.php\"><abbr title=\"Informazioni\">Info</abbr></a></li>
  <li lang=\"it\"><a href=\"eventi.php\">Eventi</a></li>
  <li lang=\"it\"><a href=\"luoghi.php\">Luoghi</a></li>
  </ul>
  ");
  if(!is_logged()){
    //utente non loggato: mostriamo la pagina di login
    echo("<div id='navLog'>
    <a href=\"login.php\"><span lang=\"en\">Login</span>/Registrazione</a>
    </div>
    ");
  } else {
    //utente loggato: mostriamo pagina del profilo
    echo("<div id='navLog'>
    <a href=\"utente_scheda.php?id_u=".$_SESSION['user_id']."\">".$_SESSION['user_username']."</a>
    </div>
    ");
  }
}

function printFooter(){
  echo("
<div class='footer'>

  <a href=\"http://www.w3.org/html/logo/\">
  <img src=\"https://www.w3.org/html/logo/badge/html5-badge-h-css3.png\" width=\"133\" height=\"64\" alt=\"HTML5 Powered with CSS3 / Styling\" title=\"HTML5 Powered with CSS3 / Styling\">
  </a>

  <address>
  BigliettiOnline <br />
  +39 340 1234567 <br />
  Via Garibaldi n.2, Padova PD <br />
  <a href=\"mailto:biglietteria@biglietteria.it\">biglietteria@biglietteria.it</a>
  </address>
</div>

  ");
}

?>
