<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
area_riservata();
register('id_mod');
?>

<html lang="it" >
<head>
  <?= printHead('Modifica evento'); ?>
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
    $cercato = select("SELECT * FROM eventi WHERE id=$id_mod")[0];
    ?>

    <h2>Modifica evento <?php  $cercato['nome']?></h2>
    <hr>
    <form method="post" action="evento_mod_r.php">
      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <label for="nome_e">Nome</label> <input value="<?= $cercato['nome']?>" name="nome_e" id="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
      <label for="descrizione_e">Descrizione</label> <textarea name="descrizione_e" id="descrizione_e"><?= $cercato['descrizione']?></textarea>
      <label for="durata_e">Durata</label> (inserisci 00:00 per eventi che durano l' intera giornata lavorativa)
      <input  value="<?= $cercato['durata']?>" type="time" id="durata_e" name="durata_e" required/>
      <label for="categoria_e">Categoria</label> <select id="categoria_e" name="categoria_e" required>
        <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
        foreach($categorie as $c){
          echo "<option value=".$c['id']."";
          if($c['id'] == $cercato['categoria_id']) echo " selected ";
          echo ">".$c['nome']."</option>";
        }
        ?>
      </select>
      
      <input type="submit" value="Conferma">
      <input type="reset" value="Annulla">
    </form>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
