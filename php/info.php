<!DOCTYPE html>
<!-- TODO: dare link alle parole usate, aggiungere molte immagini esplicative (quando si è raggiunta la grafica definitiva magari) e aggiungere elenchi puntati (che piacciono) -->
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
	<div id="corpo">
        <div class="title"><h2>Informazioni</h2></div>
            <div class="content">

				<h4>Chi siamo</h4>
					<p>Benvenuto nella Biglietteria <span lang="eng">Online</span>. Qui potrai prenotare il tuo posto in un ampia fascia di <a href="categorie.php">categorie</a> di eventi, come biglietti per musei, fiere o cinema. </p>


				<h4>Cosa facciamo</h4>
					<p>La nostra missione è mettere in comunicazione gli organizzatori di varie tipologie di eventi con le persone interessatate. Vogliamo facilitare il processo di prenotazione di biglietti per migliorare il settore dell'intrattenimento e permettere a tutti di partecipare ad eventi sia di carattere culturale che di svago. Se sei interessato a prenotare un biglietto per un evento ti basterà ricercarlo nel nostro sito, prenotare un posto, stampare il codice che ti daremo e portarlo all'evento. Dopo aver pagato la tua quota potrai entrare e goderti lo spettacolo!</p>

				<h4>Spettacoli, eventi e luoghi</h4>
				<p>Ecco alcuni chiarimenti sulle terminologie utilizzate in questa piattaforma:
				<dl>
					<dt>Evento</dt>
						<dd>un evento è la descrizione di ciò che sarà possibile andare a vedere effettivamente, che si tratti di un film piuttosto che di un'opera teatrale . Non è possibile prenotare un biglietto per un <em>evento</em>, in quanto ad esso non sono associati un luogo ed un prezzo. Piuttosto è possibile prenotare biglietti per uno <em>spettacolo</em>. </dd>
					<dt>Spettacolo</dt>
						<dd>uno spettacolo è un'occorrenza di un evento in un luogo preciso, con una data ed un prezzo ad esso associati. Quando si effettua la prenotazione di un biglietto, essa è associata ad uno specifico spettacolo. </dd>
					<dt>Luogo</dt>
						<dd>un luogo è un posto nel quale si svolgono gli spettacoli.</dd>
				</dl>
				</p>


				<h4>Come cercare uno spettacolo</h4>
				<!-- TODO: vedere se è abbastnza chiara la differenza spettacolo/evento-->
					<p><span style="color:red">AGGIORNARE QUANDO ESISTERANNO LA RICERCA SPECIFICA E LA RICERCA PER SPETTACOLO, CON IMMAGINI</span>
					Attraverso la barra di ricerca posta in alto a destra puoi ricercare tutti gli Spettacoli di una certa categoria digitando il nome della categoria (ad esempio: "Cinema"), oppure gli Spettacoli che si svolgeranno in un certo luogo digitando il nome del luogo (ad esempio: "Porto Astra"). Puoi anche ricercare uno Evento direttamente con il suo nome! Dopo aver effetuato la ricerca ti si presenterà davanti una tabella contenente i risultati. Nella tabella puoi cliccare sui vari campi per ottenere ulteriori informazioni riguardo il determinato campo. Se ad esempio hai ricercato "Van Gogh" e vuoi ottenere ulteriori informazioni sulla <span lang="eng">location</span> oppure altri eventi in musei ti bastera cliccare rispettivamente sulle rispettive voci. Se vuoi procedere ad effettuare una prenotazione invece clicca sul nome dell'evento. Se infine sei interessato a vedere tutti gli <a href="eventi.php">Eventi</a>, i <a href="luoghi.php">Luoghi</a> e le <a href="categorie.php">Categorie</a> puoi cliccare sul <span lang="eng">link</span> rispettivo proprio sotto il nostro logo nella barra dei menu.</p>


				<h4>Come prenotare un biglietto</h4>
					<p>
					Dopo aver effettuato una ricerca clicca sul nome dell'evento a cui vuoi partecipare per procedere alla prenotazione di un biglietto. Dopo aver cliccato ti si presenterà davanti una tabella contenente tutte le date disponibili. Clicca nel piccolo pulsante con scritto "Prenota" per assicurarti un posto.</p>


				<h4>Come vedere ed annullare le tue prenotazioni di biglietti</h4>
					<p>
					Clicca sul tuo <span lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere le tue prenotazioni. Se ne vuoi cancellare qualcuna ti basterà cliccare il pulsante "Annulla prenotazione" nella tabella.</p>


				<h4>Come registrarti</h4>
					<p>
					Il primo passo per entrare a far parte del nostro sistema di prenotazione dei biglietti è creare un <span lang="eng">account</span>. Per fare ciò ti basta cliccare sul <span lang="eng">link</span> "<span lang="eng">Login</span>/Registrazione" che puoi trovare in alto a destra, proprio sotto la barra di ricerca. Il <span lang="eng">link</span> ti porterà ad una finestra in cui ti verranno chieste le credenziali di accesso. Tu clicca sul <span lang="eng">link</span> "Registrati" in basso per arrivare alla schermata apposita, oppure clicca direttamente <a href="registrazione.php">qui</a>. In questa pagina ti verrà richiesto di inserire alcuni dati: <span lang="eng">username</span>, <span lang="eng">password</span>, nome, cognome e <span lang="eng">email</span>. Inviando questo modulo il sistema controllerà che il nome utente scelto non sia già occupato, in caso tutto vada bene potrai da subito iniziare a prenotare biglietti per i tuoi eventi preferiti.</p>


				<h4>Sei registrato e non sai come entrare?</h4>
					<p>
					Se hai già completato la procedura di registrazione e vuoi entrare nel nostro sistema non devi fare altro che cliccare sul <span lang="eng">link</span> "<span lang="eng">Login</span>/Registrazione". Puoi anche cliccare <a href="login.php">qui</a> per arrivare direttamente alla pagina di <span lang="eng">login</span>. Dopodichè dovrai inserire i tuoi dati ed entrerai nel sistema.</p>


				<h4>Come vedere e modificare i tuoi dati</h4>
					<p>
					Clicca sul tuo <span lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere i tuoi dati personali. Se vuoi cambiare alcuni dati ti basterà cliccare sul <span lang="eng">link</span> "Modifica informazioni utente", da qui potrai cambiare i tuoi dati inserendoli in un piccolo <span lang="eng">form</span> e poi confermando le modifiche.</p>

            </div>
	</div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
