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

  <div id="content">
    <h2>Registrazione</h2>
    <hr />

    <form action="registrazione_r.php" method="POST" name="form">
      <label><span lang="en">Username</span>
        <input type="text" name="username_r" REQUIRED />
      </label>
      <label><span lang="en">Password</span>
        <input type="password" name="password_r" REQUIRED />
      </label>
      <label>Nome
        <input type="text" name="nome_r"  placeholder="Inserisci il tuo nome" REQUIRED>
      </label>
      <label>Cognome
        <input type="text" name="cognome_r" placeholder="Inserisci il tuo cognome" REQUIRED>
      </label>
      <label><span lang="en">Email</span>
        <input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
      </label>
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
