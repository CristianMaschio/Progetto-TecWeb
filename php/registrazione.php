<!DOCTYPE html>
<?php
/*
TODO: se è già loggato non si può registrare
*/
require_once('php/config.php');
require_once('php/printTemplate.php');
/*
invia in post:
username_r
password_r
nome_r
cognome_r
tipo_r
*/
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

  <div id="contentLogin">
    <h3>Registrazione</h3>
    <hr />

    <form action="registrazione_r.php" method="POST" name="form">
      <label lang="en">Username</label>
        <input type="text" name="username_r" REQUIRED />
      <label lang="en">Password</label>
        <input type="password" name="password_r" REQUIRED />

      <label>Nome</label>
        <input type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>

      <label>Cognome</label>
        <input type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>

      <label lang="en">Email</label>
        <input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>

      <input type="hidden" name="tipo_r" value="U"><hr>
      <input type="submit" value="Completa registrazione">
      <input type="reset" value="Azzera campi">
    </form>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
