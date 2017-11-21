<?php
    require_once('config.php');
    requireLogin();
    register('luogo_id');
    require_user_linked_to_luogo($luogo_id);
    register('filter');
    register('ord');
?>

<html>
    <head>
        <?= initialize_head('Amministrazione') ?>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1>Amministrazione <?= get_nome_luogo($luogo_id)?></h1><hr>
        <div class="row_collapse">
            <a class="large-12 column small button " href="luogo_mod.php?id_mod=<?=$luogo_id?>">Modifica informazioni luogo</a>
        </div>
        
        <h3>Spettacoli</h3><hr>
            <?php
                $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli
                JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id ";
                #if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
                $spettacoli = select($sql);
            ?>
            <table>
                <tr>
                    <th width=1000px class="text-center" onclick="addlocpar('ord','e')"><a>Evento</a></th>
                    <th width=1000px class="text-center" onclick="addlocpar('ord','d')"><a>Data</a></th>
                    <th width=1000px class="text-center" >Prezzo</th>
                    <th width=1000px class="text-center"></th>
                </tr>
                <?php
                    no_result($spettacoli,6);
                    foreach($spettacoli as $s){
                        echo "<tr>";
                        
                            echo "<td><a href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                            echo "</a></td>";
                            
                            echo "<td>".format_data_ora($s['data_ora']);
                            echo "</td>";
                            
                            echo "<td>".$s['prezzo']."&euro;";
                            echo "</td>";
                            
                                echo "<td>";
                                echo "<div class='text-center'><a href=\"spettacolo_mod.php?id_mod=".$s['id']."\"><img src=\"img/icone/edit.png\"></a></div>";
                                echo "</td>";
                        
                        echo "</tr>";
                    }
                ?>
            </table>
        
        
        <h3>Biglietti</h3><hr>
        <div id='msg'></div>
        <?= filter_form($filter,'Cerca un utente') ?>
        <table>
            <tr>
                <th width=1000px class="text-center" onclick="addlocpar('ord','u')"><a>Utente</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','e')"><a>Evento</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','d')"><a>Data</a></th>
                <th width=1000px class="text-center">Prezzo</th>
                <th width=500px class="text-center">Codice</th>
                <th width=500px class="text-center">Utilizzato</th>
            </tr>
            <?php
                $sql = "SELECT *,biglietti.id AS idbiglietto FROM
                (biglietti JOIN utenti ON biglietti.utente_id=utenti.id)
                JOIN spettacoli ON  biglietti.spettacolo_id=spettacoli.id
                JOIN eventi ON spettacoli.evento_id=eventi.id
                JOIN luoghi ON spettacoli.luogo_id=luoghi.id 
                WHERE luoghi.id=$luogo_id";
                if($filter != NULL) $sql.= " AND (utenti.username LIKE '%$filter%') ";
                if($ord != NULL){ //controllo se si vuole ordinare per qualche campo
                    switch($ord){
                        case 'u': $sql.=" ORDER BY utenti.username";
                            break;
                        case 'e': $sql.=" ORDER BY eventi.nome";
                            break;
                        case 'd': $sql.=" ORDER BY spettacoli.data_ora";
                            break;
                    }
                }
                else  $sql.=" ORDER BY spettacoli.data_ora";
                $biglietti=select($sql);
                no_result($biglietti,7);
                foreach($biglietti as $b){
                    echo "<tr>";
                        echo "<td><a href='utente_scheda.php?id_u=".$b['utente_id']."'>".get_nome_utente($b['utente_id']);
                        echo "</a></td>";
                        
                        
                        $e=get_evento_from_spettacolo($b['spettacolo_id']);
                        echo "<td><a href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
                        echo "</a></td>";
                        
                        echo "<td>".format_data_ora($b['data_ora']);
                        echo "</td>";
                        
                        echo "<td>".$b['prezzo']."&euro;";
                        echo "</td>";
                        
                        echo "<td>".$b['codice'];
                        echo "</td>";
                        
                        echo "<td>";
                        if($b['utilizzato']=='no'){
                        echo "<select onchange=\"ajax('biglietto_modifica_stato_r.php?stato='+this.options[this.selectedIndex].value+'&idbiglietto='+".$b['idbiglietto']."+'&idluogo='+".$luogo_id.",'msg')\">";
                            echo "<option ";
                            if($b['utilizzato']=='si') echo " selected ";
                            echo">Si</option>";
                            echo "<option ";
                            if($b['utilizzato']=='no') echo " selected ";
                            echo">No</option>";
                        echo "<select>";
                        }
                        else echo "Si";
                        echo "</td>";
                        
                    echo "</tr>";
                }
                
            ?>
        </table>
        
        <div class="text-center"><a href="pdf/Manuale utente admin.pdf">Guida all' amministrazione</a></div>
        
        <?= footer() ?>
    </body>
</html>