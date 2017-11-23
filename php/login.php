<!DOCTYPE html>

<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Login'); ?>
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
    <h3>Login</h3>
      <hr>
      <form method='POST' action='login_r.php'>
          <label lang="en">Username:</label>
          <input type='text' name='username'>
          <label lang="en">Password:</label>
          <input type='password' name='pass'>
          <input id="buttonAccedi" type='submit' value='Accedi'>
      </form>
      <p>
        Non hai un <span lang="en">account</span>? <a href='registrazione.php'>Registrati!</a>
      </p>
    </div>

    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
