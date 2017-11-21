<?php
    require_once('config.php');
    area_riservata();
    register('id_mod');
?>

<html>
    <head>
        <?= initialize_head('Modifica categoria') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="panel">
            <?php 
                $cercato_farlocco=select("SELECT * FROM categorie WHERE id=$id_mod");
                $cercato = $cercato_farlocco[0];
            ?>
            <h2>Modifica <?=  $cercato['nome']?></h2><hr>
            <form method="post" action="categoria_mod_r.php">
                <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
                Nome <input value="<?= $cercato['nome'] ?>" placeholder="Inseri il nome della categoria" type="text" maxlength=50 name="nome_c" required/>
                Descrizione <textarea name="descrizione_c"><?= $cercato['descrizione'] ?></textarea>
                <?= submit_reset_buttons() ?>
            </form>
        </div>
        <?= footer() ?>
    </body>
</html>