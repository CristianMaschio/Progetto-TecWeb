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

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" class="contentBox">
      <div class="box">
    <h2>Login</h2>
      <form method='POST' action='login_r.php'>
          <label lang="en" for="username">Username:</label>
          <input id="username" type='text' name='username'>
          <label lang="en" for="password">Password:</label>
          <input id="password" type='password' name='pass'>
          <input id="buttonAccedi" type='submit' value='Accedi'>
      </form>
      <p>
        Non hai un <span lang="en">account</span>? <a href='registrazione.php'>Registrati!</a>
      </p>
    </div>
  </div>
    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
