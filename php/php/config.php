<?php
//faccio partire la sessione
session_start();

// TODO: sarà da togliere prima di consegnare, lo metto finchè scriviamo per avere un feedback
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

/*
VARIABILI IN SESSIONE CON UTENTE LOGGATO

user_id
user_username
user_tipo

*/

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

function get_evento_from_spettacolo($id_spettacolo){
  $ret=select("SELECT eventi.* FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id
    WHERE spettacoli.id=$id_spettacolo");
    $ritorno = $ret[0];
    return $ritorno;
  }


function evento_has_spettacoli($eventoid){
  $spettacoli = select("SELECT * FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id WHERE eventi.id=$eventoid");
  if($spettacoli == NULL) return false;
  else return true;
}

// ritorna l'ultimo id inserito nel db
function last_inserted_id(){
  // TODO 
  global $conn;
  if($conn == null)
    return null;
  return $conn->insert_id;
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
    // <input id="cookie-hide" class="cookie-hide" onclick="this.parentNode.parentNode.style.display = 'none'" value="I understand" type="button">

    $return = "<div id='topMessage'class='$tipo_messaggio'> ".$_SESSION['message']." <input title=\"Chiudi messaggio\"type=\"button\" class=\"messageCloseButton\" value=\"Chiudi\" onclick=\"document.getElementById('topMessage').classList.add('messageOff');\"></div>";
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

// CONTROLLA CHE L'UTENTE LOGGATO SIA PROPRIETARIO DELL'ID PASSATO COME ARGOMENTO: true sse l'utente loggato ha id uguale a quello passato
function proprietario($id_user){
  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $id_user) return true;
  else return false;
}

//RICHIEDE CHE UN UTENTE SIA LOGGATO, ALTRIMENTI RIMANDA ALLA HOME
function require_login($messaggio=''){
  if(!is_logged()){
    //utente non loggato
    message('Ti devi autenticare per la sezione',2);
    redirect('home.php');
    die();
  }
}

//richiede che l'utente sia loggato e anche che l'id_u che dovrebbe essere quello che viene richiesto dalla pagina
// function require_proprietario($id_u){
//   // TODO: NON DOVREBBE USARE LA FUNZIONE PROPRIETARIO?
//   require_login();
//   if(!isset($id_u) || $id_u==''){
//     message('Sezione privata',2);
//     redirect('home.php');
//   }

//   $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
//   if(!isset($user) || !isset($_SESSION['user_id']) || $_SESSION['user_id'] != $user['id']) {
//     message('Sezione privata',2);
//     redirect('home.php');
//   }

// }

function require_proprietario($id_u){
  if(!proprietario($id_u)){
    message('Sezione privata',2);
    redirect('home.php');
    die();
  }
}

// FUNZIONI CHE CONTROLLANO CHE L UTENTE SIA AMMINISTRATORE O OPERATORE. se non vengono passati parametri si assume che si intenda l'utente loggato, per avere informazioni su altri usare il parametro

function is_admin($id_a=NULL) {
  //l' inizializzazione serve perchè se non si passano parametri si da per scontato che l' utente richiesto sia quello loggato
  if($id_a == NULL)
  if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'A') return true;
  else return false;
  else
  $utente=select("SELECT * FROM utenti WHERE id=$id_a");
  if($utente[0]['tipo'] == 'A') return true;
  else return false;
}

function is_gestore_luogo($id_a=NULL) {
  //l' inizializzazione serve perchè se non si passano parametri si da per scontato che l' utente richiesto sia quello loggato
  if($id_a == NULL)
  if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'L') return true;
  else return false;
  else
  $utente=select("SELECT * FROM utenti WHERE id=$id_a");
  if($utente[0]['tipo'] == 'L') return true;
  else return false;
}

function is_operatore($id_o=NULL) {
  if($id_o == NULL)
  if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'O') return true;
  else return false;
  else
  $utente=select("SELECT * FROM utenti WHERE id=$id_o");
  if($utente[0]['tipo'] == 'O') return true;
  else return false;
}

function user_linked_to_luogo($idluogo){
  // TODO: mettere controllo su tipologie utente="L"
  if(!is_logged()) return false;
  if($_SESSION['user_id'] != NULL){
    $user_link = select("SELECT luogo_id FROM utenti WHERE id=".$_SESSION['user_id']);
    if($user_link[0]['luogo_id']==$idluogo) return true;
    else return false;
  }
  else return false;
}

// se è un amministratore di luogo ritorna l 'id del luogo amministrato, altrimentin NULL
function id_luogo_amministrato($id_user){
  if(!is_gestore_luogo($id_user))
    return NULL;
  //è un amministratore di luogo
  $id_l = select(
    "SELECT *
    FROM utenti
    WHERE id=".$id_user
  )[0]['luogo_id'];
  return $id_l;
}

// STAMPA UNA FORM DI RICERCA CHE IN GET AGGIORNA LA PAGINA SU CUI VIENE RICHIAMATA
// stampa un form di filtro: esso se cliccato su submit aggionge alla pagina
// che l'ha richiamato un attributo (filter) con GET per permettere di filtrare
// ciè fatto usando una funzione javascript
function filter_form($filter,$placeholder=''){
  echo "
  <form  id=\"filterform\" action=\"\" method=\"GET\"
  onsubmit=\"return addlocpar('filter', this.filter.value); return false;\">
  <input  id=\"cercaText\" type=\"text\" name=\"filter\" value=\"".$filter."\"/ placeholder='$placeholder'>
  <input id=\"cercaButton\" type=\"submit\" value=\"Cerca\" class=\"postfix button\"/>
  <input  id=\"tuttiButton\" type=\"submit\" value=\"Tutti\" onclick=\"this.form.filter.value=''\" class=\"prefix button secondary\"/>
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


function is_data_passata($data){
  //creo un oggetto con la data di oggi
  $stringa_oggi = date('Y-m-d');

  //trasformo in oggetto la stringa passata
  $data_oggetto = new DateTime($data);
  
  $data_formattata = $data_oggetto->format('Y-m-d');

  if($data_formattata < $stringa_oggi)
    return true; #data non disponibile
  else
    return false; #data disponibile
}

function format_costo($costo){
  $ret = str_replace(',','.',$costo);
  //controllo che sia stato inserito il valore decimale
  if(strpos($ret,'.') == false) $ret = $ret.'.00';

  //controllo che non abbia un solo decimale
  if(substr($ret,strlen($ret)-2,1) == '.'){
    //ha un solo decimale
    $ret = $ret.'0';
  }
  return $ret;
}




// FUNZIONE PER STAMPARE UN MESSAGGIO DI TABELLA VUOTA QUANDO LA TABELLA È VUOTA
function no_result($array,$colonne){
  if($array == NULL){
    echo "<tr><td colspan=$colonne >Nessun risultato</td>";
  }
}

//la variabile deve essere impostata a a valore true se si vuole che l admin di un luogo possa accadere a un' area riservata.
//in tal caso deve essere impostata anche la variabile che indica l' id del luogo a cui si deve accedere

function area_riservata($allow_admin_luogo=false,$id_luogo=NULL){
  // TODO: Pprobabilmente mettere un redirect ad http referer e non home
  require_login();
  if($allow_admin_luogo){
    if(!user_linked_to_luogo($id_luogo)
    && !is_admin() && !is_operatore()){
      message('Area riservata',2);
      redirect('home.php');
      die();
    }
  } else if(!is_admin() && !is_operatore()){
      message('Area riservata',2);
      redirect('home.php');
      die();
  }
}

// STAMPA IL FORM PER LA PRENOTAZIONE DI UN BIGLIETTO, DENTRO UN TD

function print_form_prenotazione($id_spettacolo,$id_user,$posti_disponibili,$nome_spettacolo){
  if($posti_disponibili>0)
  echo"<td>
  <form method=\"POST\" class=\"singleFieldForm\" action=\"prenota.php\" onsubmit=\"return confirm('Confermi di voler prenotare un biglietto per $nome_spettacolo?');\" >
    <input type=\"hidden\" name=\"spettacolo_b\" value=\"".$id_spettacolo."\">
    <input type=\"hidden\" name=\"user_b\" value=\"".$id_user."\">
    <input type=\"submit\" value=\"Prenota\" class=\"singleButton\" >
  </form>
  </td>";
  else
  echo "<td>Non ci sono posti disponibili</td>";
}

//STAMPA IL FORM PER L'ANNULLAMENTO DELLA PRENOTAZIONE DI UN BIGLIETTO

function print_form_anullamento($id_biglietto,$nome_spettacolo){
  echo"<td>
  <form method=\"POST\" action=\"annulla_prenotazione.php\" onsubmit=\"return confirm('Confermi di voler annullare la prenotazione per $nome_spettacolo?');\" >
    <input type=\"hidden\" name=\"id_b\" value=\"".$id_biglietto."\">
    <input type=\"submit\" value=\"Annulla prenotazione\">
  </form>
  </td>";
}

?>
