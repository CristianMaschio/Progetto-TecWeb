<?php
    require_once('config.php');
    area_riservata();
?>

<html>
    <head>
        <?= initialize_head('Aggiungi nuovo luogo') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1>Aggiungi nuovo luogo</h1><hr>
        <form action="luogo_crea_r.php" method="POST" class="panel">
            Nome <input type="text" placeholder="Inserisci il nome del luogo" maxlength=50 name="nome_l" required/>
            Indirizzo <input type="text" name="indirizzo_l" required/>
            Telefono <input type="text" maxlength=40 name="telefono_l" required/>
            <?= submit_reset_buttons() ?>
        </form>
        <?= footer() ?>
    </body>
</html>