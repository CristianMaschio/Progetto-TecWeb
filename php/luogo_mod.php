<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_mod');
area_riservata(true,$id_mod);
?>

<html lang="it" >
<head>
  <?= printHead('Modifica luogo'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content" class="box">
    <?php
    $cercato = select("SELECT * FROM luoghi WHERE id=$id_mod")[0];
    ?>
    <h2>Modifica informazioni <?=  $cercato['nome']?></h2>

    <form method="post" action="luogo_mod_r.php">
      <input type="hidden" name="id_mod" value="<?= $id_mod ?>"/>
      <label for="nome_l">Nome</label> <input type="text" value="<?= $cercato['nome'] ?>" maxlength=50 name="nome_l" id="nome_l" required/>
      <label for="indirizzo_l">Indirizzo</label> <input value="<?= $cercato['indirizzo']?>" type="text" name="indirizzo_l" id="indirizzo_l" required/>
      <label for="telefono_l">Telefono</label> <input value="<?= $cercato['telefono']?>" type="text" maxlength=40 name="telefono_l" id="telefono_l" required/>
      <input type="submit" value="Conferma">
      <input type="reset" value="Annulla">
    </form>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
