<!DOCTYPE html>

<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Home'); ?>
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
  <h1>Categorie di eventi disponibili!</h1>
  <dl>
        <?php $categorie = select("
        	SELECT * 
            FROM categorie
            ORDER BY id DESC
            ");
        foreach($categorie as $c){
			echo "<dt>".$c['nome']."</dt> <dd>".$c['descrizione']."</dd>";	
        }
        ?>
	</dl>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
