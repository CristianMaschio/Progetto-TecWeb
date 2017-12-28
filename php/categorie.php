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

  <div id="corpo">
  <div class="title"><h2>Esplora le categorie</h2></div>
  <div class="content">
  <dl class="expandedCategories">
        <?php $categorie = select("
        SELECT *
        FROM categorie
        ORDER BY nome
        ");
        foreach($categorie as $c){
          
          ===QUI SOTTO MIO
          echo "<div class=\"categoryBox\">";
          echo '<div class="categoryImg"><img class="categoryImg" src="data:image/jpeg;base64,'.base64_encode( $c['immagine'] ).'"/></div>';
          echo "<div class=\"categoryText\">
          <dt><a title=\"Vai alla categoria\" href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> <dd>".$c['descrizione']."</dd>
          </div>";
          
          === QUI SOTTO SUL MASTER
          echo "<dt><a href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> <dd>".$c['descrizione'];
          echo '<img src="data:image/jpeg;base64,'.base64_encode( $c['immagine'] ).'"/>';
          //echo "<img src=\"" . $c['immagine'] . "\" alt=\"" . $c['nome'] . "\">";
          echo "</dd>\n";
          
          echo "</div>";

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
