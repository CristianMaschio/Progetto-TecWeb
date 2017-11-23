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

// FUNZIONI DI UTILITÀ GENERALE NEL DATABASE

function get_nome_utente($id){
  $utente=select("SELECT * FROM utenti WHERE id=$id");
  return $utente[0]['username'];
}

function get_nome_categoria($id){
  $cat=select("SELECT nome FROM categorie WHERE id=$id");
  return $cat[0]['nome'];
}

function get_nome_evento($id){
  $evt=select("SELECT nome FROM eventi WHERE id=$id");
  return $evt[0]['nome'];
}

function get_nome_luogo($id){
  $luogo=select("SELECT nome FROM luoghi WHERE id=$id");
  return $luogo[0]['nome'];
}

function evento_has_spettacoli($eventoid){
  $spettacoli = select("SELECT * FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id WHERE eventi.id=$eventoid");
  if($spettacoli == NULL) return false;
  else return true;
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
function is_logged(){
  //eliminato dal mio codice nel primo if ' && $_SESSION['user_id'] != -1',
  //perchè sloggando mettevo -1 all'user id, ma non penso sia necessario in realtà
  if(isset($_SESSION['user_id'])) return true;
  else return false;
}

//RICHIEDE CHE UN UTENTE SIA LOGGATO, ALTRIMENTI RIMANDA ALLA HOME
function require_login($messaggio=''){
  if(!is_logged()){
    //utente non loggato
    if($messaggio != '') message($messaggio,2);
    else message('Ti devi autenticare per questa sezione',2);
    redirect('home.php');
    die();
  }
}

//richiede che l'utente sia loggato e anche che l'id_u che dovrebbe essere quello che viene richiesto dalla pagina
function require_proprietario($id_u){
  require_login();
  if(!isset($id_u)|| $id_u==''){
    message('Sezione privata',2);
    redirect('home.php');
  }

  $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
  if(!isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user['id']) {
    message('Sezione privata',2);
    redirect('home.php');
  }

}

// STAMPA UNA FORM DI RICERCA CHE IN GET AGGIORNA LA PAGINA SU CUI VIENE RICHIAMATA
// stampa un form di filtro: esso se cliccato su submit aggionge alla pagina
// che l'ha richiamato un attributo (filter) con GET per permettere di filtrare
// ciè fatto usando una funzione javascript
function filter_form($filter,$placeholder=''){
  echo "
  <form  id=\"filterform\" action=\"\" method=\"GET\"
  onsubmit=\"return addlocpar('filter', this.filter.value); return false;\">
  <input type=\"submit\" value=\"Cerca\" class=\"postfix button\"/>
  <input type=\"text\" name=\"filter\" value=\"".$filter."\"/ placeholder='$placeholder'>
  <input type=\"submit\" value=\"Tutti\" onclick=\"this.form.filter.value=''\" class=\"prefix button secondary\"/>
  </form>";
}

// FUNZIONI PER FORMATTARE DATI PARTICOLARI

// data una durata grezza dal database la formatta a dovere, nel caso sia nulla
// restituisce 'Giornata lavorativa', che è così per convenzione
function format_durata($durata){
  if($durata == NULL || $durata==0){
    return "Giornata lavorativa";
  }
  else{
    $ret = substr($durata,0,5);
    $ret = str_replace(':','h ',$ret);
    if(substr($ret,0,1) == '0') $ret = substr($ret,1,5);
    $ret = $ret."min";
    return $ret;
  }
}

//formatta un datetime in modo che sia leggibile in italia
function format_data_ora($data){
  $ret= new DateTime($data);
  return $ret->format('j/m/Y, H:i');
}

// FUNZIONE PER STAMPARE UN MESSAGGIO DI TABELLA VUOTA QUANDO LA TABELLA È VUOTA
function no_result($array,$colonne){
  if($array == NULL){
    echo "<tr><td colspan=$colonne >Nessun risultato</td>";
  }
}

?>
