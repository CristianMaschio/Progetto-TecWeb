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
      <div class="title"><h2>Crea nuovo luogo</h2></div>
    <div class="box">

    <form action="luogo_crea_r.php" method="POST">
      <fieldset>
      <legend>Informazioni sul luogo</legend>
        <label for="nome_l">Nome</label>
        <input tabindex="10" type="text" placeholder="Inserisci il nome del luogo" maxlength=50 id="nome_l" name="nome_l" required/>
        <label for="indirizzo_l">Indirizzo</label>
        <input tabindex="20"  type="text" id="indirizzo_l" name="indirizzo_l" required/>
        <label for="telefono_l">Telefono</label>
        <input tabindex="30" type="text" maxlength=40 id="telefono_l" name="telefono_l" required/>
      </fieldset>
      <fieldset>
        <legend>Profilo dell'amministratore del luogo</legend>
        <label for="username_r">Username</label>
        <input tabindex="40" type="text" id="username_r" name="username_r" REQUIRED>
        <label for="password_r">Password</label>
        <input tabindex="50"  type="password" id="password_r" name="password_r" REQUIRED>
        <label for="nome_r">Nome</label>
        <input tabindex="60" type="text" id="nome_r" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
        <label for="cognome_r">Cognome</label>
        <input tabindex="70" type="text" id="cognome_r" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>

        <label for="email_r">Email</label>
        <input tabindex="80" type="email" id="email_r" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
        <input type="hidden"  name="tipo_r" value="L">
      </fieldset>
        <div class="boxInline">
            <input tabindex="90" type="submit" value="Conferma">
            <input tabindex="100" id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
    </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
