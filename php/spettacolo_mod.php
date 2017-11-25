    <!DOCTYPE html>


<!-- TODO: È DA FIXARE: I PARAMETRI NON VENGONO PASSATI CORRETTAMENTE A spettacolo_mod_r QUINDI NON FUNZIONA LA MODIFICA DI SPETTACOLO-->

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_mod');
$id_luogo_spettacolo =select("SELECT luogo_id FROM spettacoli WHERE id=$id_mod");# è la varabile che indica l'id del luogo in cui sarà ospitato lo spettacolo
area_riservata(true,$id_luogo_spettacolo[0]['luogo_id']);
?>

<html lang="it" >
<head>
  <?= printHead("Modifica spettacolo"); ?>

</head>
<body>
  <header>
    <?= printHeader(); ?>
  </header>
  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>
  <div id="content">
    <?php
    $cercato_farlocco=select("SELECT * FROM spettacoli WHERE id=$id_mod");
    $cercato = $cercato_farlocco[0];

    $data = substr($cercato['data_ora'],0,10);
    $ora = substr($cercato['data_ora'],11,5);
    ?>
    <form method="post" action="spettacolo_mod_r.php">
      <h2>Modifica spettacolo per  <?=get_evento_from_spettacolo($cercato['id'])['nome']?></h2><hr>

      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <?php
      if($_SESSION['user_tipo'] != 'L'): ?> <!-- controllo che sia un utente admin o operatore, altrimenti non può modificare il luogo -->

      <label for="luogo_s" >Luogo</label>

        <select name="luogo_s" required>

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
          <input type="hidden" id="luogo_s" value="<?= $cercato['luogo_id']?>" />
        <?php endif ?>
      </select>

      <label for="data_s">Data</label>
      <input value="<?php echo"$data" ?>" type="date" id="data_s" required/>

      <label for="ora_s">Orario di inizio</label>
      <input value="<?php echo"$ora" ?>" type="time" id="ora_s" required/>

      <label for="posti_s">Posti disponibili</label>
      <input value="<?php echo($cercato['posti_disponibili']); ?>" type="number" id="posti_s" value=0 required/>

      <label for="costo_s">Costo spettacolo</label>
      <input value="<?php echo($cercato['prezzo']); ?>" type="number" step="0.01" id="costo_s" value="0.0" required/>
        
        
      <input type="submit" value="Conferma">
      <input type="reset" value="Annulla">
    </form>
  </div>


  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>