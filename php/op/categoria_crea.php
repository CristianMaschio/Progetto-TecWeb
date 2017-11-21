<?php
    require_once('config.php');
    area_riservata();
?>

<html>
    <head>
        <?= initialize_head('Crea nuova categoria') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1>Crea nuova categoria</h1><hr>
        <form action="categoria_crea_r.php" method="POST" class="panel">
            Nome <input placeholder="Inseri il nome della categoria" type="text" maxlength=50 name="nome_c" required/>
            Descrizione <textarea name="descrizione_c"></textarea>
            <?= submit_reset_buttons() ?>
        </form>
        <?= footer() ?>
    </body>
</html>