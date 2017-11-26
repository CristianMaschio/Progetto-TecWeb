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

  <h2>Crea nuovo luogo</h2>
  <hr>
    <form action="luogo_crea_r.php" method="POST">
        <label for="nome_l">Nome</label> <input type="text" placeholder="Inserisci il nome del luogo" maxlength=50 id="nome_l" name="nome_l" required/>
        <label for="indirizzo_l">Indirizzo</label> <input type="text" id="indirizzo_l" name="indirizzo_l" required/>
        <label for="telefono_l">Telefono</label> <input type="text" maxlength=40 id="telefono_l" name="telefono_l" required/>

        <input type="submit" value="Conferma">
        <input type="reset" value="Annulla">
    </form>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
