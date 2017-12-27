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

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" >
      <div class="title"><h2>Crea nuova categoria</h2></div>
      <div class="box">
            <form enctype="multipart/form-data" action="categoria_crea_r.php" method="POST">
                <label for="nome_c">Nome</label> <input placeholder="Inseri il nome della categoria" type="text" maxlength=50 id="nome_c" name="nome_c" required/>
                <label for="descrizione_c">Descrizione</label>
                <textarea tabindex=20 name="descrizione_c" id="descrizione_c"></textarea>
                
                <label for="immagine_c">Immagine</label>
                <input type="file" name="i_c" id="i_c" accept="image/*" REQUIRED/>

                <div class="boxInline">
                    <input tabindex=40 type="submit" value="Conferma">
                    <input tabindex=50 id="buttonRight" type="reset" value="Annulla">
                </div>
            </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
