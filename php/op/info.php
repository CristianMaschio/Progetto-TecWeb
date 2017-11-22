<?php
    require_once('config.php');
?>

<html>
    <head>
        <?= initialize_head('Info') ?>
    </head>
    <body>
        <?= initialize_body() ?>
            <h1 class="text-center"><b>Informazioni</b></h1><hr>
            <p>
                Benvenuto nella biglietteria online. &Egrave; qui possibile prenotare biglietti riguradanti varie <a href="categorie.php">categorie</a>, come
                biglietti per musei, fiere o cinema. Inoltre se vuoi prenotare un determinato evento potrai cercare se &egrave; disponibile
                nell' apposita <a href="eventi.php">pagina</a>.Utilizzare il nostro servizio ti permette di assicurarti un posto a uno qualunque
                degli spettacoli proposti senza dover pagare in anticipo o recarti a ritirare il biglietto in qualsiasi luogo.
                Se ancora non hai un account <a href="registrazione.php">registrati</a> gratuitamente
                per poter prenotare dei biglietti. Una volta eseguito il login(grazie al menu a sinistra) prenotare biglietti per gli eventi.
                Ogni biglietto &egrave; identificato da un codice univoco che lo identifica: stampa tale codice con relativo nome utente dell' account
                e presentati al posto e all' ora dello spettacolo
                con esso, gli addetti verificheranno le informazioni e potrai immediatamente entrare! Per ultriori informazioni
                &egrave; possibile chiamare il numero +39 340 1233243, inviare un email a
                <a href="mailto:biglietteria@biglietteria.it">biglietteria@biglietteria.it</a>,
                oppure venire alla nostra sede in Via Garibaldi n.2, Desenzano del Garda BS. Per una guida completa clicca
                <a href="pdf/Manuale utente.pdf">qui</a>.
                <hr><img src="img/biglietto.png">
                <i>Troverai questa tabella nella pagina del profilo utente</i>
            </p>
        <?= footer() ?>
    </body>
</html>