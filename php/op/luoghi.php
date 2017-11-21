<?php
    require_once('config.php');
    register('filter');
?>

<html>
    <head>
        <?= initialize_head('Luoghi') ?>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="">
        <h1 class='text-center'>Luoghi</h1><hr>
        
        <?php 
        filter_form($filter,'Cerca un luogo');
        $sql = "SELECT *
        FROM luoghi
        WHERE true ";
        if(isset($filter)) $sql.= " AND nome LIKE '%$filter%' ";
        $sql.=" ORDER BY luoghi.nome ";
    
        $luoghi=select($sql);
        ?>
        
        <table>
            <tr>
                <th width=1000px class="text-center" >Nome</th>
                <th width=1000px class="text-center">Indirizzo</th>
                <th width=1000px class="text-center">Telefono</th>
            </tr>
            <?php
            no_result($luoghi,3);
            foreach($luoghi as $l){
                echo "<tr>";
                
                    echo "<td><a href='luogo_scheda.php?luogo_id=".$l['id']."'>".$l['nome'];
                    echo "</a></td>";
                
                    echo "<td>".$l['indirizzo'];
                    echo "</a></td>";
                
                    echo "<td>".$l['telefono'];
                    echo "</td>";
                
                echo "</tr>";
            }
            ?>
        </table>
        </div>
        <?= footer() ?>
    </body>
</html>