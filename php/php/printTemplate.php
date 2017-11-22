<?php

function printHead($title){
  echo("
  <title>".$title."</title>
  <meta charset=\"UTF-8\">
  <meta name=\"description\" content=\"Servizio di prenotazione biglietti per eventi di vario genere\">
  <meta name=\"keywords\" content=\"eventi, spettacoli, cinema, teatro, cultura, eventi sportivi, fiere, musei, musica\">
  <meta name=\"author\" content=\"Gruppo di progetto Tecnologie Web\">
  <link rel=\"stylesheet\" type=\"text/css\" href=\"css/screen.css\" >
  <link rel=\"stylesheet\" type=\"text/css\" media=\"(max-width: 480px)\" href=\"css/mobile.css\">
  <link rel=\"stylesheet\" type=\"text/css\" media=\"print\" href=\"css/print.css\">
  ");
}

function printHeader(){
    echo("
    <div id='logoTitle'>
        <img src=\"img/icone/view.png\" alt=\"Logo della biglietteria online\" title=\"Logo\" >
        <h1>Home e logo</h1>
    </div>
   
    <div id='findAll'>
        <img src=\"img/icone/view.png\" alt=\"Logo della biglietteria online\" title=\"Logo\" >
        <input type=\"text\" name=\"fname\">
    </div>
    ");
}

function printNavBar(){
    echo("
    <ul>
        <li lang=\"en\"><img src=\"\">Home</li>
        <li lang=\"en\"><img src=\"\"><abbr>Info</abbr></li>
        <li lang=\"it\"><img src=\"\">Eventi</li>
        <li lang=\"it\"><img src=\"\">Luoghi</li>
    </ul>
    <div id='navLog'>
        <a>Login/Registrazione</a>
    </div>
    ");
}

function printFooter(){
  echo("
  <hr />

  <a href=\"http://www.w3.org/html/logo/\">
  <img src=\"https://www.w3.org/html/logo/badge/html5-badge-h-css3.png\" width=\"133\" height=\"64\" alt=\"HTML5 Powered with CSS3 / Styling\" title=\"HTML5 Powered with CSS3 / Styling\">
  </a>

  <address>
    BigliettiOnline <br />
    +39 340 1234567 <br />
    Via Garibaldi n.2, Padova PD <br />
    <a href=\"mailto:biglietteria@biglietteria.it\">biglietteria@biglietteria.it</a>
  </address>

  ");
}

?>
