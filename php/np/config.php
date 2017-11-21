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

function printNavBar(){
    echo("
    <ul>
        <li>Home</li>
        <li></li>
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