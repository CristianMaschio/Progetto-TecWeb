<?php

function printHead($title){
    echo("
        <title>".$title."</title>
    		<meta charset=\"UTF-8\">
    		<meta name=\"description\" content=\"Sito su una biglietteria\">
    		<meta name=\"keywords\" content=\"\">
    		<meta name=\"author\" content=\"Gruppo tecweb\">
        <link rel=\"stylesheet\" type=\"text/css\" href=\"stile.css\" >
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
    <small>footer</small>
    ");
}

?>
