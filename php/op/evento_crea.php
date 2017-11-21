<?php
    require_once('config.php');
    area_riservata();
?>

<html>
    <head>
        <?= initialize_head('Crea nuovo evento') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1>Crea nuovo evento</h1><hr>
        <form action="evento_crea_r.php" method="POST" class="panel">
            Nome <input name="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
            Descrizione <textarea name="descrizione_e"></textarea>
            Durata (inserisci 00:00 per eventi che durano l' intera giornata lavorativa) <input type="time" name="durata_e" required/>
            Categoria
            <select name="categoria_e" required>
                <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
                foreach($categorie as $c){
                    echo "<option value=".$c['id'].">".$c['nome']."</option>";
                }
                ?>
            </select>
            <?= submit_reset_buttons() ?>
        </form>
        <?= footer() ?>
    </body>
</html>