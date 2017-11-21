<?php
    require_once('config.php');
    area_riservata();
?>

<html>
    <head>
        <?= initialize_head('Crea nuovo spettacolo') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1>Crea nuovo spettacolo</h1><hr>
        <form action="spettacolo_crea_r.php" method="POST" class="panel">
            Evento <select name="evento_s" required>
                <?php $eventi = select("SELECT * FROM eventi ORDER BY nome ASC");
                foreach($eventi as $e){
                    echo "<option value=".$e['id'].">".$e['nome']."</option>";
                }
                ?>
            </select>
            Luogo <select name="luogo_s" required>
                <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                foreach($luoghi as $l){
                    echo "<option value=".$l['id'].">".$l['nome']."</option>";
                }
                ?>
            </select>
            Data <input type="date" name="data_s" required/>
            Orario di inizio <input type="time" name="ora_s" required/>
            Posti disponibili <input type="number" name="posti_s" value=0 required/>
            Costo spettacolo <input type="number" step="0.01" name="costo_s" value="0.0" required/>
            <?= submit_reset_buttons() ?>
        </form>
        <?= footer() ?>
    </body>
</html>