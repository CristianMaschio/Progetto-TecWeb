<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Crea nuovo evento'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" >
      <div class="title"><h2>Crea nuovo evento</h2></div>
      <div class="box">

    <form action="evento_crea_r.php" method="POST">
        <!-- TODO: ripensare al fatto che per la giornata lavorativa vada messo 00:00, magari in JS -->
        <label for="nome_e">Nome</label> <input name="nome_e" id="nome_e" placeholder="Inserisci il nome dell' evento" type="text" maxlength="50" required/>
        <label for="descrizione_e">Descrizione</label> <textarea id="descrizione_e" name="descrizione_e"></textarea>
        <label for="durata_e">Durata</label> (inserisci 00:00 per eventi che durano l' intera giornata lavorativa) <input type="time" id="durata_e" name="durata_e" required/>
        <label for="categoria_e">Categoria</label>
        <select id="categoria_e" name="categoria_e" required>
            <?php $categorie = select("SELECT * FROM categorie ORDER BY nome ASC");
            foreach($categorie as $c){
                echo "<option value=".$c['id'].">".$c['nome']."</option>";
            }
            ?>
        </select>
        <div class="boxInline">
            <input type="submit" value="Conferma">
            <input id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
