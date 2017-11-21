<?php
    require_once('config.php');
?>

<html>
    <head>
        <?= initialize_head('titolo pagina!') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <?php
        user_linked_to_luogo($_SESSION['user_id'],9);
        ?>
        <?= footer() ?>
    </body>
</html>