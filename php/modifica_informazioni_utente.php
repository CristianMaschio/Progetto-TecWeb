<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');
//non solo devi essere loggato ma l'id della pagina deve essere il tuo
require_proprietario($id_u);
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
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
