<?php
    require_once('config.php');
    if(isLogged()) {
        message('Non puoi registrarti, sei già loggato!',3);
        redirect('home.php');
        die();
    }
    /*

    invia in post:
    username_r
    password_r
    tipo_r

    */
?>

<html>
    <head>
        <?= initialize_head('Registrazione') ?>
        <script src='angular.js'></script>
    </head>
    <body ng-app>
        <?= initialize_body() ?>
        <div class="text-center panel">
        <h1>Registrati</h1>
        <hr>
        <?= message()?>
        <i>Completa tutti i campi</i><br><br>
        <form action="registrazione_r.php" method="POST" name="form">
            <b title="Insersci l'username che sar&agrave; associato al tuo account">Username</b>: <input type="text" name="username_r" REQUIRED>
            <b title="Inserisci una password per accedere al tuo account">Password</b>: <input type="password" name="password_r" REQUIRED>
            <b title="Inserisci il tuo nome reale">Nome</b>: <input type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>
            <b title="Inserisci il tuo cognome reale">Cognome</b>: <input type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>
            <b title="Inserisci il tuo indirizzo e-mail">Email</b>: <input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
            <input type="hidden" name="tipo_r" value="U"><hr>
            <input type="submit" value="Completa registrazione" class="round button expand">
            <input type="reset" class="round button expand secondary">
        </form>
        </div>
        <?= footer() ?>
    </body>
</html>
