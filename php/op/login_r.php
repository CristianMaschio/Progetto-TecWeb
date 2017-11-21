<?php
    require_once('config.php');
    
    register('username');
    register('pass');
    
    echo("prima della select");

    $utente_trovato = select("
        SELECT * FROM utenti
        WHERE username='$username'
        AND pass=PASSWORD('$pass');
    ");

    echo("dopo la select");
    redirect('home.php');
    
    if(count($utente_trovato) > 0){
        //qualcuno è stato trovato..
        if(count($utente_trovato) > 1){
            //troppi sono stati trovati..strano nè?
        }
        //trovato bene
        $_SESSION['user_id'] = $utente_trovato[0]['id'];
        $_SESSION['user_username'] = $utente_trovato[0]['username'];
        $_SESSION['user_tipo'] = $utente_trovato[0]['tipo'];
        redirect($_SERVER['HTTP_REFERER']);
        //if(isset($_SESSION['redirect'])){
        //    $to=$_SESSION['redirect'];
        //    unset($_SESSION['redirect']);
        //    redirect($to);
        //} else{
        //        redirect('home.php');
        //}
        
    } else { //ne sono stati trovati troppi
        message('Login fallito',3);
        redirect($_SERVER['HTTP_REFERER']);
    }
    //redirect('home.php');
?>