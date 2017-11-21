<?php
    require_once('config.php');
    register('filter');
    register('ord');
?>

<html>
    <head>
        <?= initialize_head('Eventi') ?>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="">
        <h1 class="text-center">Eventi</h1><hr>
        
        <?php 
        filter_form($filter,'Cerca un evento');
        $sql = "SELECT eventi.*,categorie.nome AS nome_categoria,categorie.id AS id_categoria
        FROM eventi JOIN categorie ON eventi.categoria_id=categorie.id
        WHERE true ";
        if(isset($filter)) $sql.= " AND eventi.nome LIKE '%$filter%' ";
        if(isset($ord)){
            switch($ord){
                case 'n': $sql.= "ORDER BY eventi.nome";
                    break;
                case 'c': $sql.= "ORDER BY categorie.nome";
                    break;
                case 'd': $sql.= "ORDER BY eventi.durata DESC";
                    break;
                default:  $sql.= "ORDER BY eventi.nome";
            }
        }
        else $sql.= "ORDER BY eventi.nome";
    
        $eventi=select($sql);
        ?>
        
        <table>
            <tr>
                <th width=1000px class="text-center" onclick="addlocpar('ord','n')"><a>Nome</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','c')"><a>Categoria</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','d')"><a>Durata</a></th>
                <?php if(cisonoeventisenzaspettacoli()): ?>
                    <th></th>
                <?php endif ?>
            </tr>
            <?php
            $scrivitd=cisonoeventisenzaspettacoli();
            no_result($eventi,5);
            foreach($eventi as $e){
                echo "<tr>";
                
                    echo "<td><a href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
                    echo "</a></td>";
                
                    echo "<td><a href=categoria_scheda.php?cat_id=".$e['id_categoria'].">".get_nome_categoria($e['categoria_id']);
                    echo "</a></td>";
                
                    echo "<td>".format_durata($e['durata']);
                    echo "</td>";
                    
                    if($scrivitd){
                        echo "<td>";
                        if(!evento_has_spettacoli($e['id'])) echo "<small>Attualmente nessuno spettacolo previsto</small>";
                        echo "</td>";
                    }
                    
                echo "</tr>";
            }
            ?>
        </table>
            
        </div>
        <?= footer() ?>
    </body>
</html>