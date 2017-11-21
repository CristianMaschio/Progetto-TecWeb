<?php
    require_once('config.php');
    register('id_mod');
    area_riservata(true,$id_mod);
?>

<html>
    <head>
        <?= initialize_head('Modifica luogo') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="panel">
            <?php 
                $cercato_farlocco=select("SELECT * FROM luoghi WHERE id=$id_mod");
                $cercato = $cercato_farlocco[0];
            ?>
            <h2>Modifica <?=  $cercato['nome']?></h2><hr>
            <form method="post" action="luogo_mod_r.php">
                <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
                Nome <input type="text" value="<?= $cercato['nome'] ?>" maxlength=50 name="nome_l" required/>
                Indirizzo <input value="<?= $cercato['indirizzo']?>" type="text" name="indirizzo_l" required/>
                Telefono <input value="<?= $cercato['telefono']?>" type="text" maxlength=40 name="telefono_l" required/>
                <?= submit_reset_buttons() ?>
            </form>
        </div>
        <?= footer() ?>
    </body>
</html>