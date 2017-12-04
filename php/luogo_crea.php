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

  <div id="content" class="contentBox">
    <div class="box">
  <h2>Crea nuovo luogo</h2>
    <form action="luogo_crea_r.php" method="POST">
      <fieldset>
      <legend>Informazioni sul luogo</legend>
        <label for="nome_l">Nome</label> <input type="text" placeholder="Inserisci il nome del luogo" maxlength=50 id="nome_l" name="nome_l" required/>
        <label for="indirizzo_l">Indirizzo</label> <input type="text" id="indirizzo_l" name="indirizzo_l" required/>
        <label for="telefono_l">Telefono</label> <input type="text" maxlength=40 id="telefono_l" name="telefono_l" required/>
      </fieldset>
      <fieldset>
        <legend>Profilo dell'amministratore del luogo</legend>
        <label for="username_r">Username</label> <input type="text" name="username_r" REQUIRED>
            <label for="password_r">Password</label> <input type="password" name="password_r" REQUIRED>
            <label for="nome_r">Nome</label> <input type="text" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
            <label for="cognome_r">Cognome</label> <input type="text" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>
            <label for="email_r">Email</label><input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
            <input type="hidden" name="tipo_r" value="L"><hr>
      </fieldset>
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
