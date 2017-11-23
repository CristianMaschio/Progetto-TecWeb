<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');

//non solo devi essere loggato ma l'id della pagina deve essere il tuo
require_proprietario($id_u);
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

    <?php
    $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
    ?>
    <h2>Modifica le tue informazioni, <?php echo $user['username']; ?></h2> <hr />

    <form method='POST' action='utente_modifica_informazioni_r.php'>
      <label>
        <span>Nome:</span>
        <input type='text' name='nome_u'>
      </label>
      <label>
        <span lang="en">Password:</span>
        <input type='password' name='pass'>
      </label>
      <input type='submit' value='Accedi'>
    </form>


  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
