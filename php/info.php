<!DOCTYPE html>

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

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

	<div id="content">
		<h1>Informazioni</h1>
		<p>
			Benvenuto nella biglietteria <span xml:lang="eng">online</span>. &Egrave; qui possibile prenotare biglietti riguardanti varie <a href="categorie.php">categorie</a>, come
			biglietti per musei, fiere o cinema. Inoltre se vuoi prenotare un determinato evento potrai cercare se &egrave; disponibile nell' apposita <a href="eventi.php">pagina</a>.
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

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
