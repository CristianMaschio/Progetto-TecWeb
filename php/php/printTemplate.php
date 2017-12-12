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
  <link rel=\"stylesheet\" type=\"text/css\" media=\"(max-width: 480px)\" href=\"css/mobile.css\">
  <link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"css/print.css\">
  ");
}

function printHeader(){
  echo("
  <div id='logoTitle'>
  <a href=\"home.php\"><img src=\"img/pass.svg\" alt=\"Logo della biglietteria online\" title=\"Logo\" ></a>
  <a href=\"javascript:void(0);\" id=\"hamburgerMenu\"class=\"icon\" onclick=\"menuResponsive()\">&#9776;</a>
  <h1>Biglietteria</h1>
  </div>

  <div id='findAll'>
  <form method=\"GET\" action=\"cerca.php\">
   <input type=\"text\" name=\"filtro\" placeholder='Cerca'>
  </form>
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
  <li lang=\"it\"><a href=\"categorie.php\">Categorie</a></li>
  <li lang=\"it\"><a href=\"spettacoli.php\">Spettacoli</a></li>
  <li lang=\"it\"><a href=\"eventi.php\">Eventi</a></li>
  <li lang=\"it\"><a href=\"luoghi.php\">Luoghi</a></li>
  <li lang=\"it\"><a href=\"info.php\"><abbr title=\"Informazioni\">Info</abbr></a></li>
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
    echo(
    "<div id='navLog'>
    <ul>
      <li><a href=\"utente_scheda.php?id_u=".$_SESSION['user_id']."\">".$_SESSION['user_username']."</a> </li>
      <li><a href=logout_r.php >Logout</a> <li>
    </ul>
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
