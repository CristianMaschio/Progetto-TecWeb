<?php
    require_once('config.php');
    area_riservata();
    /*
    
    invia in post:
    username_r
    password_r
    tipo_r
    
    */
?>

<html>
    <head>
        <?= initialize_head('Registrazione utente luogo') ?>
        <script src='angular.js'></script>
    </head>
    <body ng-app>
        <?= initialize_body() ?>
        <div class="text-center panel">
        <h1>Registra un account che amministri un luogo</h1>
        <hr>
        <?= message()?>
        <form action="registrazione_utente_luogo_r.php" method="POST" name="form">
            <b>Username</b>: <input type="text" name="username_r" REQUIRED>
            <b>Password</b>: <input type="password" name="password_r" REQUIRED>
            <b>Nome</b>: <input type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>
            <b>Cognome</b>: <input type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>
            <b>Email</b>: <input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
            <b>Luogo</b>: <select name="luogo_r" required>
                <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                foreach($luoghi as $l){
                    echo "<option value=".$l['id'].">".$l['nome']."</option>";
                }
                ?>
            <input type="hidden" name="tipo_r" value="L"><hr>
            <input type="submit" class="round button expand">
            <input type="reset" class="round button expand secondary">
        </form>
        </div>
        <?= footer() ?>
    </body>
</html>