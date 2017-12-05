<!DOCTYPE html>
<!-- TODO: dare link alle parole usate, aggiungere molte immagini esplicative e aggiungere elenchi puntati (che piacciono) -->
<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Informazioni'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

	<div id="content">
        <div class="title"><h2>Informazioni</h2></div>
            <div class="content">
				<h4>Chi siamo</h4>
				<div class="content">
					Benvenuto nella Biglietteria <span xml:lang="eng">Online</span>. Qui potrai prenotare il tuo posto in un ampia fascia di <a href="categorie.php">categorie</a> di eventi, come biglietti per musei, fiere o cinema. 
				</div>

				<h4>Cosa facciamo</h4>
				<div class="content">
					La nostra missione è mettere in comunicazione gli organizzatori di varie tipologie di eventi con le persone interessatate. Vogliamo facilitare il processo di prenotazione di biglietti per migliorare il settore dell'intrattenimento e permettere a tutti di partecipare ad eventi sia di carattere culturale che di svago. Se sei interessato a prenotare un biglietto per un evento ti basterà ricercarlo nel nostro sito, prenotare un posto, stampare il codice che ti daremo e portarlo all'evento. Dopo aver pagato la tua quota potrai entrare e goderti lo spettacolo!
				</div>

				<h4>Come registrarti</h4>
				<div class="content">
					Il primo passo per entrare a far parte del nostro sistema di prenotazione dei biglietti è creare un <span xml:lang="eng">account</span>. Per fare ciò ti basta clickare sul <span xml:lang="eng">link</span> "<span xml:lang="eng">Login</span>/Registrazione" che puoi trovare in alto a destra, proprio sotto la barra di ricerca. Il <span xml:lang="eng">link</span> ti porterà ad una finestra in cui ti verranno chieste le credenziali di accesso. Tu clicka sul <span xml:lang="eng">link</span> "Registrati" in basso per registrarti. Qui ti sarà richiesto di inserire alcuni dati: <span xml:lang="eng">username</span>, <span xml:lang="eng">password</span>, nome, cognome e <span xml:lang="eng">email</span>. Inviando questo modulo il sistema controllerò che il nome utente scelto non sia già occupato, in caso tutto vada bene potrai da subito iniziare a prenotare biglietti per i tuoi eventi preferiti.
				</div>

				<h4>Sei registrato e non sai come entrare?</h4>
				<div class="content">
					Se hai già completato la procedura di registrazione e vuoi entrare nel nostro sistema non devi fare altro che clickare sul <span xml:lang="eng">link</span> "<span xml:lang="eng">Login</span>/Registrazione". Dopodichè dovrai inserire i tuoi dati ed entrerai nel sistema.
				</div>

				<h4>Come ricercare uno spettacolo</h4>
				<div class="content">
					Attraverso la barra di ricerca posta in alto a destra puoi ricercare tutti gli Spettacoli di una certa categoria digitando il nome della categoria (ad esempio: "Cinema"), oppure gli Spettacoli che si svolgeranno in un certo luogo digitando il nome del luogo (ad esempio: "Porto Astra"). Puoi anche ricercare uno Spettacolo direttamente con il suo nome! Dopo aver effetuato la ricerca ti si presenterà davanti una tabella contenente i risultati. Nella tabella puoi clickare sui vari campi per ottenere ulteriori informazioni riguardo il determinato campo. Se ad esempio hai ricercato "Van Gogh" e vuoi ottenere ulteriori informazioni sulla <span xml:lang="eng">location</span> oppure altri eventi in musei ti bastera clickare rispettivamente sulle rispettive voci. Se vuoi procedere ad effettuare una prenotazione invece clicka sul nome dell'evento. Se infine sei interessato a vedere tutti gli Eventi, i Luoghi e le Categorie puoi clickare sul <span xml:lang="eng">link</span> rispettivo proprio sotto il nostro logo.
				</div>

				<h4>Come prenotare</h4>
				<div class="content">
					Dopo aver effettuato una ricerca clicka sul nome dell'evento a cui vuoi partecipare per procedere alla prenotazione di un biglietto. Dopo aver clickato ti si presenterà davanti una tabella contenente tutte le date disponibili. Clicka nel piccolo pulsante con scritto "Prenota" per assicurarti un posto.
				</div>

				<h4>Come vedere e modificare i tuoi dati</h4>
				<div class="content">
					Clicka sul tuo <span xml:lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere i tuoi dati personali. Se vuoi cambiare alcuni dati ti basterà clickare sul <span xml:lang="eng">link</span> "Modifica informazioni utente", da qui potrai cambiare i tuoi dati inserendoli in un piccolo <span xml:lang="eng">form</span> e poi confermando le modifiche.
				</div>

				<h4>Come vedere ed annullare le tue prenotazioni</h4>
				<div class="content">
					Clicka sul tuo <span xml:lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere le tue prenotazioni. Se ne vuoi cancellare qualcuna ti basterà clickare il pulsante "Annulla prenotazione" nella tabella.
				</div>


		<!--
		TODO: cancellare questa vecchia info con pdf come guida
		<div class="content">
            <p>
				Benvenuto nella biglietteria <span xml:lang="eng">online</span>. &Egrave; qui possibile prenotare biglietti riguardanti varie <a href="categorie.php">categorie</a>, come biglietti per musei, fiere o cinema.
                Inoltre se vuoi prenotare un determinato evento potrai cercare se &egrave; disponibile nell' apposita <a href="eventi.php">pagina</a>.
                Utilizzare il nostro servizio ti permette di assicurarti un posto a uno qualunque
                degli spettacoli proposti senza dover pagare in anticipo o recarti a ritirare il biglietto in qualsiasi luogo.
                Se ancora non hai un <span xml:lang="eng">account</span> <a href="registrazione.php">registrati</a> gratuitamente
                per poter prenotare dei biglietti. Una volta eseguito il <span xml:lang="eng">login</span>(grazie al menu a sinistra) potrai prenotare biglietti per gli eventi.
                Ogni biglietto &egrave; identificato da un codice univoco che lo identifica: stampa tale codice con relativo nome utente dell' <span xml:lang="eng">account</span>
                e presentati al posto e all' ora dello spettacolo
                con esso, gli addetti verificheranno le informazioni e potrai immediatamente entrare! Per ultriori informazioni
                &egrave; possibile chiamare il numero +39 340 1234567, inviare un' email a
                <a href="mailto:biglietteria@biglietteria.it">biglietteria@biglietteria.it</a>,
                oppure venire alla nostra sede in Via Garibaldi n.2, Padova PD. Per una guida completa clicca
                <a href="pdf/Manuale utente.pdf">qui</a>.
            <hr><img src="img/biglietto.png">
            <i>Troverai questa tabella nella pagina del profilo utente</i>
            </p>
        </div>
		-->
            </div>
	</div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
