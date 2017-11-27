<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
area_riservata();
register('id_mod');
?>

<html lang="it" >
<head>
  <?= printHead('Modifica categoria'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="On">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content" class="box">
    <?php
    $cercato = select("SELECT * FROM categorie WHERE id=$id_mod")[0];
    ?>
    <h2>Modifica categoria <?=  $cercato['nome']?></h2>
    <hr>
    <form method="post" action="categoria_mod_r.php">
      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <label for="nome_c">Nome</label> <input value="<?= $cercato['nome'] ?>" placeholder="Inseri il nome della categoria" type="text" maxlength=50 id="nome_c" name="nome_c" required/>
      <label for="descrizione_c">Descrizione</label> <textarea id="descrizione_c" name="descrizione_c"><?= $cercato['descrizione'] ?></textarea>

      <input type="submit" value="Conferma">
      <input type="reset" value="Annulla">
    </form>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
