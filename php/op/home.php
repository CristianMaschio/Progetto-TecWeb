<?php
    require_once('config.php');
?>

<html>
    <head>
        <?= initialize_head('BigliettiOnline') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1 class="text-center">Eventi da poco disponibili!</h1><hr>
        <?php $spettacoli = select("
        SELECT * 
            FROM spettacoli 
            JOIN eventi ON spettacoli.evento_id=eventi.id
            ORDER BY evento_id DESC
            LIMIT 6
            ");
        foreach($spettacoli as $s){
            echo "<a href='evento_scheda.php?evt_id=".get_evento_from_spettacolo($s['id'])['id']."'><div class='panel'>";
            echo "<b><h3 class='text-center'>".get_evento_from_spettacolo($s['id'])['nome']."</h3></b><br>";
            echo "<b>Categoria: </b>".get_nome_categoria(get_evento_from_spettacolo($s['id'])['categoria_id'])."<br>";
            echo "<b>Durata: </b>".format_durata(get_evento_from_spettacolo($s['id'])['durata'])."<br>";
            echo "<i>".get_evento_from_spettacolo($s['id'])['descrizione']."</i><br>";
            echo "</div class='panel'></a>";
        }
        ?>
        <table>
            <tr>
                
            </tr>
        </table>
        <?= footer() ?>
    </body>
</html>