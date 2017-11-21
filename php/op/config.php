 <?php
    
    /*
    
    VARIABILI IN SESSIONE CON UTENTE LOGGATO
    
    user_id
    user_username
    user_tipo
    
    DA AGGIUNGERE NEL CONCEPT
    gli admin o gli operatori aggiungono eventi e spettacoli, gli utenti che amministrano un luogo aggiungono spettacoli per quel luogo, leggono le informazioni
    dei biglietti e modificano le informazioni solo del loro luogo.
    aggiungere che lo stato dei biglietto lo può cambiare solo il luogo. aggiungere che il luogo non può aggiungere rimuovere o robe simili spettacoli, ma solo modificarli.
    aggiungere la cosa dell update quando qualcuno visualizza la pagina web: gli spettacoli passati si cancellano in modo automatico.
    
    CIO' CHE DEVO AFFRONTARE:
    -se uno ha già una prenotazione per un evento e lo riprenota, magari in giorni diversi. oppure uguali, vedi te
    -biglietti per più persone
    -agiungere nella pagina di ogni utente un avviso sul segnarsi il codice su un foglio di carta. se avrò tempo magari crea anche il pdf
    -motivare nel concept che potrebbero esserci due spettacoli lo stesso giorno la stessa ora lo stesso posto
    perchè potrebbero esserci nelle csale cinematografiche film uguali in sale diverse, magari per la capienza ristretta di una
    -formattare come dio comanda l inserimento dei numeri di telefono e indirizzi
    -aggiungere nel concept che si sceglie che il biglietto non si vende direttamente online ma si stampa la prenotazione perchè l' asiae rompe
    -se si aggiunge una serie di eventi consecutivi nei giorni, per esempio una fiera
    -se avrai tempo controllare che uno non possa eliminare delle occorrenze tipoluogo o evento se esistono degli spettacoli collegati, cioè controllare l integrità referenziale
    -recuper password
    
    */
    
    //FACCIO PARTIRE LA SESSIONE
    session_start();
    
    //VARIABILI CONFIGURAZIONE GLOBALI
    
    define('redirect',true); //attiva/disattiva i redirect
    
    $host = '127.0.0.1';
    $user_db = 'root';
    $pass_db = 'root';
    $dbnm = 'biglietteria';
    //Apro la connessione al db
    $conn=null;

    //FUNZIONI RIGUARDATI I DATABASE
    
    function connect(){
	global $conn, $host, $user_db, $pass_db, $dbnm;
    	$conn = new mysqli($host, $user_db, $pass_db, $dbnm);

        if(!$conn){
            echo "Connessione fallita: ";
            die;
        }
    }
    
    function query($sql){ //fa una query al database e ritorna il risultato
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
    
    function select($sql){ //fa una query, solamente che il risultato viene ritornato in una tabella
	$res=query($sql);
	$table = Array();
	while ($row= mysqli_fetch_assoc($res)){
	    $table[]=$row;
	}
	return $table;
    }
    
    function clean_spettacoli(){
	query("DELETE FROM spettacoli WHERE spettacoli.data_ora < NOW()");
    }
    
    //TEMPLATE INTERFACCIA
    
    function initialize_head($title){
        echo"
            <title>$title</title>
            <link rel=\"stylesheet\" href=\"foundation.min.css\">
	    <link rel=\"stylesheet\" href=\"foundation-icons/foundation-icons.css\" />
	    <meta charset=\"UTF-8\">
	    <link rel=\"shortcut icon\" href=\"img/films.png\"></link>
        ";
    }
    
    function initialize_body(){ //intestazione delle pagine
        echo "
	    <div class='fixed'>
		<nav class=\"top-bar\" data-topbar role=\"navigation\">
                    <ul class=\"title-area\">
			<li class=\"name\"><h1><a>BigliettiOnline</a></h1></li>
		    </ul>
		    <section class=\"top-bar-section\"> <ul class=\"left\">
			<li class=\"divider\"></li>
                        <li><a href=\"home.php\" title='Home'> &nbsp;<i class='step fi-home size-24'></i></a></li>
			
			<li class=\"divider\"></li>
		        <li><a href=\"info.php\" title='Info'>&nbsp;<i class='step fi-info size-24'></i></a></li>
			
			<li class=\"divider\"></li>
		        <li><a href=\"categorie.php\" title='Categorie'>&nbsp;<i class='step fi-thumbnails size-24'></i></a></li>
                
			<li class=\"divider\"></li>
		        <li><a href=\"eventi.php\" title='Eventi'>&nbsp;<i class='step fi-list size-24'></i></a></li>
                
			<li class=\"divider\"></li>
		        <li><a href=\"luoghi.php\" title='Luoghi'>&nbsp;<i class='step fi-map size-24'></i></a></li>
			
			<li class=\"divider\"></li>
                        <li>";

	echo "
		</nav>
		</div>
		<br><br><br>
            </div>
        ";
	//sidebar
	echo "<div class=\"row\">";
	echo "<div class=\"large-3 columns panel\">
	    ".sidebar()."
	    
	</div>";
	
	//inizio la pagine larga 9 colonne
	echo "<div class=\"large-9 column\">
	";
    }
    
    function sidebar(){
	$side = "";
	if(!isLogged()){
	    $side.="<h3 class='text-center'>Login <i class='step fi-unlock size-24'></i></h3><hr>".message()."
	    <form method='POST' action='login_r.php'>
	    Username:
	    <input type='text' name='username'>
	    Password:
	    <input type='password' name='pass'>
	    <input type='submit' value='Accedi' class='small button round expand'>
	    </form>
	    <small>Non hai un account? <a href='registrazione.php'>Registrati!</a></small>
	    ";
	}
	else {
	    $side.="<h5 class='text-center'>Benvenuto, ";
	    if(isAdmin()) $side.="<i> amministratore </i>";
	    else if(isOperatore()) $side.="<i> operatore </i>";
	    $side.='<b>'.$_SESSION['user_username'].'</b>';
	    $side.='</h5><hr>'.message().'';
	    if(isAdmin() || isOperatore()) $side.='<a class=\'small button round expand\' href=\'pannello_amministrazione.php\'>Amministrazione</a>';
	    if(isAdminLuogo()){
		$id_luogo=select("SELECT luogo_id FROM utenti WHERE id=".$_SESSION['user_id']."");
		$side.='<a class=\'small button round expand\' href=\'pannello_amministrazione_luogo.php?luogo_id='.$id_luogo[0]['luogo_id'].'\'>Amministra luogo</a>';
	    }
	    $side.='<a class=\'small button round expand\' href=\'utente_scheda.php?id_u='.$_SESSION['user_id'].'\'>Profilo</a>
	    <a class=\'small button round expand secondary\' href=\'logout_r.php\'>Logout</a>';

	}
	return $side;
    }
    
    function footer(){ //il footer oltre a stamparsi chiuse anche il div principale
        echo " </div></div><br>
            <footer class=\"row\">
            <hr>
            BigliettiOnline<br>
            <i class='step fi-telephone size-24'></i> +39 340 1233243 <br>
            <address><i class='step fi-marker size-24'></i> Via Garibaldi n.2, Desenzano del Garda BS<br>
	    <i class='step fi-mail size-24'></i>&nbsp;<a href=\"mailto:biglietteria@biglietteria.it\">biglietteria@biglietteria.it</a>
	    <br><br>
            </footer>
        ";
    }
    
    function filter_form($filter,$placeholder=''){
	echo "        <form  id=\"filterform\" action=\"\" method=\"GET\" 
	    onsubmit=\"return addlocpar('filter', this.filter.value); return false;\">
	    <div class=\"row collapse\">
	    
	    <div class=\"large-2 column\">
		<input type=\"submit\" value=\"Cerca\" class=\"postfix button\"/></div>
	    
	    <div class=\"large-9 column\">
		<input type=\"text\" name=\"filter\" value=\"".$filter."\"/ placeholder='$placeholder'></div>
	    
	    <div class=\"large-1 column\">
		<input type=\"submit\" value=\"X\" onclick=\"this.form.filter.value=''\" class=\"prefix button secondary\"/></div>
	    
	    </div>
	</form>";
    }
    
    //FUNZIONI VARIE
    
    function register($varname){ //registra una variabile nella pagina che richiama questa funzione. se non � registrata la imposta a vuota
	global $$varname;
	if(isset($_REQUEST[$varname])){
	    $$varname= addslashes(stripslashes($_REQUEST[$varname]));
	} else {
	    $$varname=NULL;
	}
    }
    
    function message($msg='',$type=''){
	if ($msg==''){
	    if(isset($_SESSION['message'])){
		$tipo_messaggio='warning';
		if(isset($_SESSION['msg_type']) && $_SESSION['msg_type'] != '')
		{
		    //valori da 1 a 3: 1 verde 2 giallo 3 rosso
		    switch($_SESSION['msg_type']){
			case 1: $tipo_messaggio='alert-box success round';
			    break;
			case 2: $tipo_messaggio='alert-box warning round';
			    break;
			case 3: $tipo_messaggio='alert-box alert round';
			    break;
			
		    }
		}
		$return = "<div class='$tipo_messaggio text-center'> ".$_SESSION['message']."</div>";
		unset($_SESSION['message']);
		unset($_SESSION['msg_type']);
		return $return;
	    }
	}
	else{
	    $_SESSION['message']=$msg;
	    $_SESSION['msg_type']=$type;
	}
    }
    
    function redirect($url){
	if(redirect){
	    header('location: '. $url);
	} else {
	    echo "<a href='$url'> should go to $url </a>";
	}
    }
    
    function requireLogin(){
	if(!isLogged()){
	    //utente non loggato
	    message('Ti devi autenticare per questa sezione!',2);
	    redirect('home.php');
	    die();
	}
    }
    
    function isLogged(){
	if(isset($_SESSION['user_id']) && $_SESSION['user_id'] != -1) return true;
	else return false;
    }
    
    function isAdmin($id_a=NULL) {
	//l' inizializzazione serve perchè se non si passano parametri si da per scontato che l' utente richiesto sia quello loggato
	if($id_a == NULL)
	    if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'A') return true;
	    else return false;
	else
	    $utente=select("SELECT * FROM utenti WHERE id=$id_a");
	    if($utente[0]['tipo'] == 'A') return true;
	    else return false;
    }
    
    function isOperatore($id_o=NULL) {
	if($id_o == NULL)
	    if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'O') return true;
	    else return false;
	else
	    $utente=select("SELECT * FROM utenti WHERE id=$id_o");
	    if($utente[0]['tipo'] == 'O') return true;
	    else return false;
    }
    
    function isAdminLuogo($id_a=NULL){
	if($id_a == NULL)
	    if(isset($_SESSION['user_tipo']) && $_SESSION['user_tipo'] == 'L') return true;
	    else return false;
	else
	    $utente=select("SELECT * FROM utenti WHERE id=$id_a");
	    if($utente[0]['tipo'] == 'L') return true;
	    else return false;
    }
    
    function user_linked_to_luogo($iduser,$idluogo){
	if($iduser != NULL && $iduser != -1){
	    $user_link = select("SELECT luogo_id FROM utenti WHERE id=$iduser");
	    if($user_link[0]['luogo_id']==$idluogo) return true;
	    else return false;
	}
	else return false;
    }
    
    function require_user_linked_to_luogo($idluogo){
	if(!user_linked_to_luogo($_SESSION['user_id'],$idluogo)){
	    message('Area riservata',3);
	    redirect('home.php');
	    die();
	}
    }
    
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
    
    function no_result($array,$colonne){
	if($array == NULL){
	    echo "<tr><td colspan=$colonne class='text-center'><b>Nessun risultato</b></td></tr>";
	}
    }
    
    function evento_has_spettacoli($eventoid){
	$spettacoli = select("SELECT * FROM eventi JOIN spettacoli ON eventi.id=spettacoli.evento_id WHERE eventi.id=$eventoid");
	if($spettacoli == NULL) return false;
	else return true;
    }
    
    function cisonoeventisenzaspettacoli(){
	$spettacoli = select("SELECT * FROM
	(SELECT spettacoli.* FROM eventi LEFT OUTER JOIN spettacoli 
	ON eventi.id=spettacoli.evento_id) as r
	WHERE ISNULL(id)");
	if($spettacoli != NULL){ return true;}
	else{ return false;}
    }

    //la variabile deve essere impostata a a valore true se si vuole che l admin di un luogo possa accadere a un' area riservata.
    //in tal caso deve essere impostata anche la variabile che indica l' id del luogo a cui si deve accedere 
    
    function area_riservata($allow_admin_luogo=false,$id_luogo=NULL){
        requireLogin();
	if($allow_admin_luogo){
	    if(!user_linked_to_luogo($_SESSION['user_id'],$id_luogo)
	       && !isAdmin() && !isOperatore()){
		message('Area riservata',2);
		redirect('home.php');
		die();
	    }
	} else if(!isAdmin() && !isOperatore()){
            message('Area riservata',2);
            redirect('home.php');
            die();
        }
    }

    function submit_reset_buttons(){
        echo "<div class=\"row\">
                <div class=\"large-6 column\">
                <input type=\"submit\" class=\"small button round expand\"/></div>
                <div class=\"large-6 column\">
                <input type=\"reset\" class=\"small button round expand secondary\"/></div>
            </div>";
    }

?>