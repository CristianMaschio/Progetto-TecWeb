<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  area_riservata();
?>

<html lang="it" >
<head>
  <?= printHead('Nuovo amministratore di luogo'); ?>
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
      <div class="title"><h2>Aggiungi nuov utente amministratore di luogo</h2></div>
      <div class="box">
          <form action="registrazione_utente_luogo_r.php" method="POST" name="form">
                <label for="username_r">Username</label> <input type="text" name="username_r" REQUIRED>
                <label for="password_r">Password</label> <input type="password" name="password_r" REQUIRED>
                <label for="nome_r">Nome</label> <input type="text" name="nome_r"  placeholder="Inserisci il nome" REQUIRED>
                <label for="cognome_r">Cognome</label> <input type="text" name="cognome_r" placeholder="Inserisci il cognome" REQUIRED>
                <label for="email_r">Email</label><input type="email" name="email_r" placeholder="esempio@esempio.com" REQUIRED>
                <label for="luogo_r">Luogo</label><select name="luogo_r" required>
                    <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                    foreach($luoghi as $l){
                        echo "<option value=".$l['id'].">".$l['nome']."</option>";
                    }
                    ?>

                    <?php
                        $_SESSION['messaggio_registrazione'] = "Amministratore di luogo aggiunto correttamente";
                        $_SESSION['redirect_registrazione'] = "utente_scheda.php?id_u=".$_SESSION['user_id'];
                    ?>
                <input type="hidden" name="tipo_r" value="L">
                <!-- NON PUOI MANDARE A REGISTRAZIONE_R STA ROBA, DEVI FARE UNA PAGINA R APPOSTA -->
              <div class="boxInline">
                <input type="submit" value="Completa registrazione">
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
