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

						<span style="color: red">Errori in tutta la pagina: l'attributo lingua negli span non è xml:lang (che è di XHTML), ma lang e basta. clicka in italiano si scrive clicca.</span>
				<h4>Chi siamo</h4>
				<div class="content">
					Benvenuto nella Biglietteria <span xml:lang="eng">Online</span>. Qui potrai prenotare il tuo posto in un ampia fascia di <a href="categorie.php">categorie</a> di eventi, come biglietti per musei, fiere o cinema. 
				</div>

				<h4>Cosa facciamo</h4>
				<div class="content">
					La nostra missione è mettere in comunicazione gli organizzatori di varie tipologie di eventi con le persone interessatate. Vogliamo facilitare il processo di prenotazione di biglietti per migliorare il settore dell'intrattenimento e permettere a tutti di partecipare ad eventi sia di carattere culturale che di svago. Se sei interessato a prenotare un biglietto per un evento ti basterà ricercarlo nel nostro sito, prenotare un posto, stampare il codice che ti daremo e portarlo all'evento. Dopo aver pagato la tua quota potrai entrare e goderti lo spettacolo!
				</div>

				<h4>Come cercare uno spettacolo</h4>
				<span style="color: red">chiarisci il concetto di spettacolo: istanziazione di evento</span>
				<div class="content">
					Attraverso la barra di ricerca posta in alto a destra puoi ricercare tutti gli Spettacoli di una certa categoria digitando il nome della categoria (ad esempio: "Cinema"), oppure gli Spettacoli che si svolgeranno in un certo luogo digitando il nome del luogo (ad esempio: "Porto Astra"). Puoi anche ricercare uno Spettacolo direttamente con il suo nome! <span style="color: red">gli spettacoli non hanno un nome, sono l'incrocio dei due assi eventi e luoghi</span> Dopo aver effetuato la ricerca ti si presenterà davanti una tabella contenente i risultati. Nella tabella puoi clickare sui vari campi per ottenere ulteriori informazioni riguardo il determinato campo. Se ad esempio hai ricercato "Van Gogh" e vuoi ottenere ulteriori informazioni sulla <span xml:lang="eng">location</span> oppure altri eventi in musei ti bastera clickare rispettivamente sulle rispettive voci. Se vuoi procedere ad effettuare una prenotazione invece clicka sul nome dell'evento. Se infine sei interessato a vedere tutti gli <a href="eventi.php">Eventi</a>, i <a href="luoghi.php">Luoghi</a> e le <a href="categorie.php">Categorie</a> puoi clickare sul <span xml:lang="eng">link</span> rispettivo proprio sotto il nostro logo nella barra dei menu.
				</div>

				<h4>Come prenotare un biglietto</h4>
				<div class="content">
					Dopo aver effettuato una ricerca clicka sul nome dell'evento a cui vuoi partecipare per procedere alla prenotazione di un biglietto. Dopo aver clickato ti si presenterà davanti una tabella contenente tutte le date disponibili. Clicka nel piccolo pulsante con scritto "Prenota" per assicurarti un posto.
				</div>

				<h4>Come vedere ed annullare le tue prenotazioni di biglietti</h4>
				<div class="content">
					Clicka sul tuo <span xml:lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere le tue prenotazioni. Se ne vuoi cancellare qualcuna ti basterà clickare il pulsante "Annulla prenotazione" nella tabella.
				</div>

				<h4>Come registrarti</h4>
				<div class="content">
					Il primo passo per entrare a far parte del nostro sistema di prenotazione dei biglietti è creare un <span xml:lang="eng">account</span>. Per fare ciò ti basta clickare sul <span xml:lang="eng">link</span> "<span xml:lang="eng">Login</span>/Registrazione" che puoi trovare in alto a destra, proprio sotto la barra di ricerca. Il <span xml:lang="eng">link</span> ti porterà ad una finestra in cui ti verranno chieste le credenziali di accesso. Tu clicka sul <span xml:lang="eng">link</span> "Registrati" in basso per registrarti. Qui ti sarà richiesto di inserire alcuni dati: <span xml:lang="eng">username</span>, <span xml:lang="eng">password</span>, nome, cognome e <span xml:lang="eng">email</span>. Inviando questo modulo il sistema controllerò che il nome utente scelto non sia già occupato, in caso tutto vada bene potrai da subito iniziare a prenotare biglietti per i tuoi eventi preferiti.
				</div>

				<h4>Sei registrato e non sai come entrare?</h4>
				<div class="content">
					Se hai già completato la procedura di registrazione e vuoi entrare nel nostro sistema non devi fare altro che clickare sul <span xml:lang="eng">link</span> "<span xml:lang="eng">Login</span>/Registrazione". Dopodichè dovrai inserire i tuoi dati ed entrerai nel sistema.
				</div>

				<h4>Come vedere e modificare i tuoi dati</h4>
				<div class="content">
					Clicka sul tuo <span xml:lang="eng">username</span> in alto a destra sotto la barra di ricerca: ti si aprirà la tua pagina personale. Qui potrai vedere i tuoi dati personali. Se vuoi cambiare alcuni dati ti basterà clickare sul <span xml:lang="eng">link</span> "Modifica informazioni utente", da qui potrai cambiare i tuoi dati inserendoli in un piccolo <span xml:lang="eng">form</span> e poi confermando le modifiche.
				</div>
            </div>
	</div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
