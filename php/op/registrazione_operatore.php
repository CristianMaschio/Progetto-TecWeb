<?php
    require_once('config.php');
    if(!isAdmin()) {
        message('Area riservata',3);
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
        <h1>Registra nuovo operatore</h1>
        <hr>
        <?= message()?>
        <form action="registrazione_operatore_r.php" method="POST" name="form">
            <b>Username</b>: <input type="text" name="username_r" REQUIRED>
            <b>Password</b>: <input type="password" name="password_r" REQUIRED>
            <b>Nome</b>: <input type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>
            <b>Cognome</b>: <input type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>
            <b>Email</b>: <input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
            <input type="hidden" name="tipo_r" value="O"><hr>
            <input type="submit" class="round button expand">
            <input type="reset" class="round button expand secondary">
        </form>
        </div>
        <?= footer() ?>
    </body>
</html>