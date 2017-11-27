<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Pagina template'); ?>
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

  <h2>Crea nuova categoria</h2>
  <hr>
    <form action="categoria_crea_r.php" method="POST">
        <label for="nome_c">Nome</label> <input placeholder="Inseri il nome della categoria" type="text" maxlength=50 id="nome_c" name="nome_c" required/>
        <label for="descrizione_c">Descrizione</label> <textarea name="descrizione_c" id="descrizione_c"></textarea>
        <input type="submit" value="Conferma">
        <input type="reset" value="Annulla">
    </form>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>