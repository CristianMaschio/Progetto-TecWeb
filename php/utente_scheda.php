<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');

// true sse è la pagina dell'utente loggato
function proprietario($user){
  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user['id']) return true;
  else return false;
}
?>

<html lang="it" >
<?php $user=select("SELECT * FROM utenti WHERE id=$id_u")[0]; //come prima cosa leggi di che utente si tratta ?>
<head>
  <?= printHead('Profilo '.$user['username']); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <div id="content">
    Profilo di <?php
    echo $user['username'];
    if(proprietario($user)){
      echo ' <hr /><a href="logout_r.php">logout</a>';
    }?>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
