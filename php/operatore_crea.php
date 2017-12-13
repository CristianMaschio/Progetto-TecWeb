<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
if(!is_admin()) {
    message('Area riservata',2);
    redirect('home.php');
    die();
}
?>

<html lang="it" >
<head>
  <?= printHead('Crea un nuovo operatore'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" class="contentBox">
      <div class="box">
      <h2>Crea un nuovo operatore</h2>
        <form action="registrazione_r.php" method="POST" name="form">
                    <label for="username_r">Username</label><input type="text" id="username_r" name="username_r" REQUIRED>
                    <label for="password_r">Password</label><input type="password" id="password_r" name="password_r" REQUIRED>
                    <label for="nome_r">Nome</label><input type="text" id="nome_r" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
                    <label for="cognome_r">Cognome</label> <input type="text" id="cognome_r" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>
                    <label for="email_r">Email</label><input type="email" id="email_r" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
                    <input type="hidden" name="tipo_r" value="O"><hr>
                    <?php
                        $_SESSION['messaggio_registrazione'] = "Operatore registrato correttamente";
                        $_SESSION['redirect_registrazione'] = "utente_scheda.php?id_u=".$_SESSION['user_id'];
                    ?>
            <div class="boxInline">
                <input type="submit" value="Conferma">
                <input id="buttonRight" type="reset" value="Azzera campi">
            </div>
                </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
