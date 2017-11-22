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
    <h1>Home e logo</h1>
    ");
}

function printNavBar(){
    echo("
    <ul>
        <li lang=\"en\">Home</li>
        <li><abbr>Info</abbr></li>
        <li></li>
        <li></li>
    </ul>
    ");
}

function printFooter(){
    echo("
    <hr />
    <small>footer</small>
    ");
}

?>
