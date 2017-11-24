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

  <div id="content" class="box">

    <?php
    // TODO: aggiungere un javascript in questa pagina che prima di committare chieda all'utente se è sicuro di fare le modifiche?
    $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
    ?>
    <h3>Modifica le tue informazioni, <?php echo $user['username']; ?></h3> <hr />

    <form method='POST' action='utente_modifica_informazioni_r.php'>
        <label for="nome">Nome:</label>
        <input id="nome" type='text' value="<?php echo $user['nome']; ?>" name='nome_u'>

        <label for="cognome">Cognome</label>
        <input id="cognome" type='text' value="<?php echo $user['cognome']; ?>" name='cognome_u'>

        <label for="email" lang="en">Email</label>
        <input id="email" type='email' value="<?php echo $user['email']; ?>" name='email_u'>

      <input type="hidden" value="<?php echo $user['id']; ?>" name='id_u'>
      <input type='submit' value='Conferma'>
      <input type='reset' value='Annulla'>
    </form>


  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
