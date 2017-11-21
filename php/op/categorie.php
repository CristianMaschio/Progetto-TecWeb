<?php
    require_once('config.php');
?>

<html>
    <head>
        <?= initialize_head('Categorie') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1 class="text-center">Categorie</h1><hr>
        <?php $categorie=select("SELECT * FROM categorie");
        foreach($categorie as $c){
            echo "<a href='categoria_scheda.php?cat_id=".$c['id']."'><div class='large-4 column panel text-center'>
            <h4><b>".$c['nome']."</b></h4><i>".$c['descrizione']."</i></div></a>";
        }
        ?>
        <?= footer() ?>
    </body>
</html>