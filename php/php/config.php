<?php

/*
VARIABILI IN SESSIONE CON UTENTE LOGGATO

user_id
user_username
user_tipo

*/

//faccio partire la sessione
session_start();

//VARIABILI CONFIGURAZIONE GLOBALI
define('redirect',true); //attiva/disattiva i redirect

//CREDENZIALI DATABASE
$host = '127.0.0.1';
$user_db = 'root';
$pass_db = 'root';
$dbnm = 'biglietteria';

$conn=null;

// REGISTRAZIONE VARIABILI DA FORM
// registra una variabile nella pagina che richiama questa funzione, la variabile arriva da una form
// se non è registrata la imposta a vuota
function register($varname){
  global $$varname;
  if(isset($_REQUEST[$varname])){
    $$varname= addslashes(stripslashes($_REQUEST[$varname])); // previene SQL injection
  } else {
    $$varname=NULL;
  }
}

// FUNZIONI PER INTERFACCIARSI AL DATABASE

// si connette al database
function connect(){
  global $conn, $host, $user_db, $pass_db, $dbnm;
  $conn = new mysqli($host, $user_db, $pass_db, $dbnm);
  if ($conn->connect_error) {
    die("Connessione fallita: " . $conn->connect_error);
  }
}

//fa una query al database e ritorna il risultato
function query($sql){
  global $conn;
  if($conn == null){
    connect();
  }
  $res=mysqli_query($conn, $sql);
  //Esegue la query sul db.
  if(!$res){
    echo "Query fallita: ";
    echo mysqli_error($conn);
    die;
  }
  return $res;
}

//fa una query, solamente che il risultato viene ritornato in una tabella
function select($sql){
  $res=query($sql);
  $table = Array();
  while ($row= mysqli_fetch_assoc($res)){
    $table[]=$row;
  }
  return $table;
}

// FUNZIONE DI REDIRECT
function redirect($url){
  if(redirect){
    header('location: '. $url);
  } else {
    echo "<a href='$url'> should go to $url </a>";
  }
}

// IMPOSTA MESSAGGIO
// imposta un messaggio con relativo codice (per nostra convenzione) che idealmente
// dovrà essere visualizzato dalla pagina a successiva ad un redirect:
// 1 - successo
// 2 - warning
// 3 - fail
function message($msg,$type){
  if ($msg!=''){
    $_SESSION['message']=$msg;
    $_SESSION['msg_type']=$type;
  }
}

// CONSUMA MESSAGGIO
// se è stato impostato in sessione una variabile message (dalla funzione precedente)
// ritorna una stringa che contiene il div di classe appropriata (così da poterla mostrare), con MESSAGGIO
// ed elimina dalla sessione (con unset) la variabile message
function consumeMessage(){
  if(isset($_SESSION['message'])){
    $tipo_messaggio='warning';
    if(isset($_SESSION['msg_type']) && $_SESSION['msg_type'] != '')
    {
      //valori da 1 a 3: 1 verde 2 giallo 3 rosso
      switch($_SESSION['msg_type']){
        case 1: $tipo_messaggio='message-success';
        break;
        case 2: $tipo_messaggio='message-warning';
        break;
        case 3: $tipo_messaggio='message-fail';
        break;
        default: $tipo_messaggio='message-warning'; //se mal settato il tipo è warning
      }
    }
    $return = "<div class='$tipo_messaggio'> ".$_SESSION['message']."</div>";
    unset($_SESSION['message']);
    unset($_SESSION['msg_type']);
    return $return;
  }
}

// CONTROLLARE CHE UN UTENTE SIA LOGGATO
function isLogged(){
  //eliminato dal mio codice nel primo if ' && $_SESSION['user_id'] != -1',
  //perchè sloggando mettevo -1 all'user id, ma non penso sia necessario in realtà
  if(isset($_SESSION['user_id'])) return true;
  else return false;
}

?>
