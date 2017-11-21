<?php
    require_once('config.php');
    requireLogin();
    area_riservata();
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
        <h1>Amministrazione</h1><hr>
        <div class="row_collapse">
            <a class="large-3 column small button " href="evento_crea.php">Aggiungi Evento</a>
            <a class="large-3 column small button " href="spettacolo_crea.php">Aggiungi Spettacolo</a>
            <a class="large-3 column small button " href="luogo_crea.php">Aggiungi Luogo</a>
            <a class="large-3 column small button " href="categoria_crea.php">Aggiungi Categoria</a>
            <?php if(isAdmin()): ?>
                <a class="large-6 column small button " href="registrazione_operatore.php">Aggiungi Operatore</a>
                <a class="large-6 column small button " href="registrazione_utente_luogo.php">Aggiungi Utente collegato a luogo</a> 
            <?php elseif(isOperatore()): ?>
                <a class="large-12 column small button " href="registrazione_utente_luogo.php">Aggiungi Utente collegato a luogo</a> 
            <?php endif ?>
            
        </div>
        
        <h3>Biglietti</h3><hr>
        <?= filter_form($filter,'Cerca un utente') ?>
        <table>
            <tr>
                <th width=1000px class="text-center" onclick="addlocpar('ord','u')"><a>Utente</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','e')"><a>Evento</a></th>
                <th width=1000px class="text-center" onclick="addlocpar('ord','d')"><a>Data</a></th>
                <th width=1000px class="text-center">Luogo</th>
                <th width=1000px class="text-center">Prezzo</th>
                <th width=500px class="text-center">Codice</th>
            </tr>
            <?php
                $sql = "SELECT * FROM
                (biglietti JOIN utenti ON biglietti.utente_id=utenti.id)
                JOIN spettacoli ON  biglietti.spettacolo_id=spettacoli.id
                JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE TRUE";
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
                        
                        echo "<td><a href=luogo_scheda.php?luogo_id=".$b['luogo_id'].">".get_nome_luogo($b['luogo_id']);
                        echo "</a></td>";
                        
                        echo "<td>".$b['prezzo']."&euro;";
                        echo "</td>";
                        
                        echo "<td>".$b['codice'];
                        echo "</td>";
                    echo "</tr>";
                }
                
            ?>
        </table>
        
        <div class="text-center"><a href="pdf/Manuale utente admin.pdf">Guida all' amministrazione</a></div>
        
        <?= footer() ?>
    </body>
</html>