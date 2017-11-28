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

  <nav id="nav" class="On">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content" class="box">
    <h2>Registrazione</h2>

    <form action="registrazione_r.php" method="POST" name="form">
      <label lang="en" for="username">Username</label>
        <input id="username" type="text" name="username_r" REQUIRED />
      <label lang="en" for="password">Password</label>
        <input id="password" type="password" name="password_r" REQUIRED />

      <label for="nome">Nome</label>
        <input id="nome" type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>

      <label for="cognome">Cognome</label>
        <input id="cognome" type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>

      <label lang="en" for="email">Email</label>
        <input id="email" type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>

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
