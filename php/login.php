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

  <div id="content">
    <h1>Login</h3>
      <hr>
    <form method='POST' action='login_r.php'>
    Username:
    <input type='text' name='username'>
    Password:
    <input type='password' name='pass'>
    <input type='submit' value='Accedi'>
    </form>
    Non hai un account? <a href='registrazione.php'>Registrati!</a>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
