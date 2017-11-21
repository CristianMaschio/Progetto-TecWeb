<?php
    require_once('config.php');
    area_riservata();
    register('id_mod');
?>

<html>
    <head>
        <?= initialize_head('Modifica evento') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="panel">
            <?php 
                $cercato_farlocco=select("SELECT * FROM eventi WHERE id=$id_mod");
                $cercato = $cercato_farlocco[0];
            ?>
            <h2>Modifica <?=  $cercato['nome']?></h2><hr>
            <form method="post" action="evento_mod_r.php">
                <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
                Nome <input value="<?= $cercato['nome']?>" name="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
                Descrizione <textarea name="descrizione_e"><?= $cercato['descrizione']?></textarea>
                Durata (inserisci 00:00 per eventi che durano l' intera giornata lavorativa) 
                <input  value="<?= $cercato['durata']?>" type="time" name="durata_e" required/>
                Categoria <select name="categoria_e" required>
                <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
                foreach($categorie as $c){
                    echo "<option value=".$c['id']."";
                    if($c['id'] == $cercato['categoria_id']) echo " selected ";
                    echo ">".$c['nome']."</option>";
                }
                ?>
                </select>
                <?= submit_reset_buttons() ?>
            </form>
        </div>
        <?= footer() ?>
    </body>
</html>