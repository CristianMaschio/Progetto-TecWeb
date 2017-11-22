<!doctype html>

<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Template page'); ?>
</head>
<body>
  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <section id="content">
  </section>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
