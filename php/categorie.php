<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
?>

<html lang="it" >
<head>
  <?= printHead('Categorie'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content">
  <div class="title"><h2>Esplora le categorie</h2></div>
  <div class="content">
  <dl>
        <?php $categorie = select("
        SELECT *
        FROM categorie
        ORDER BY nome
        ");
        foreach($categorie as $c){
          echo "<dt><a href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> <dd>".$c['descrizione']."</dd>";
        }
        ?>
      </dl>
    </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
