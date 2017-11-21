<?php
    require_once('config.php');
    register('id_mod');
    $id_luogo_spettacolo =select("SELECT luogo_id FROM spettacoli WHERE id=$id_mod");# è la varabile che indica l'id del luogo in cui sarà ospitato lo spettacolo
    area_riservata(true,$id_luogo_spettacolo[0]['luogo_id']);
?>

<html>
    <head>
        <?= initialize_head('Modifica spettacolo') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="panel">
            <?php 
                $cercato_farlocco=select("SELECT * FROM spettacoli WHERE id=$id_mod");
                $cercato = $cercato_farlocco[0];
                
                $data=substr($cercato['data_ora'],0,10);
                $ora=substr($cercato['data_ora'],11,5);
            ?>
            <h2>Modifica spettacolo per  <?=  get_evento_from_spettacolo($cercato['id'])['nome']?></h2><hr>
            <form method="post" action="spettacolo_mod_r.php">
            <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
            <?php if($_SESSION['user_tipo'] != 'L'): ?> <!-- controllo che sia un utente admin o operatore, altrimentinon può modificare il luogo -->
            Luogo <select name="luogo_s" required>
                <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                foreach($luoghi as $l){
                    echo "<option value=".$l['id']."";
                    if($l['id'] == $cercato['luogo_id']){
                        echo " selected ";
                    }
                    echo ">".$l['nome']."</option>";
                }
                ?>
            <?php else: ?>
            <!-- se un amministratore di luogo richiede di modificare uno spettacolo non potrà modificare il luogo in cui si svolge -->
                <input type="hidden" name="luogo_s" value="<?= $cercato['luogo_id'] ?>" />
            <?php endif ?>
            </select>
            Data <input value="<?= $data ?>" type="date" name="data_s" required/>
            Orario di inizio <input value="<?= $ora ?>" type="time" name="ora_s" required/>
            Posti disponibili <input value="<?= $cercato['posti_disponibili'] ?>" type="number" name="posti_s" value=0 required/>
            Costo spettacolo <input value="<?= $cercato['prezzo'] ?>" type="number" step="0.01" name="costo_s" value="0.0" required/>
                <?= submit_reset_buttons() ?>
            </form>
        </div>
        <?= footer() ?>
    </body>
</html>