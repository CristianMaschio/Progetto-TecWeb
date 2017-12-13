<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  
  register('luogo_id');
  area_riservata(true,$luogo_id);
  register('filter');
  register('ord');
  $_SESSION['redirect_from_spettacolo'] = 'pannello_amministrazione_luogo.php?luogo_id='.$luogo_id;
?>

<html lang="it" >
<head>
  <?= printHead('Amministra luogo'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo">
  <div class="content">
  <h2>Amministrazione <?= get_nome_luogo($luogo_id)?></h2><hr>

  <ul>
    <a href="luogo_mod.php?id_mod=<?=$luogo_id?>">Modifica informazioni luogo</a>
    <a href="spettacolo_crea.php">Crea nuovo spettacolo</a>
  </ul>
        <h3>Spettacoli</h3><hr>
            <?php
                $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli
                JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id 
                ORDER BY spettacoli.data_ora";
                #if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
                $spettacoli = select($sql);
            ?>
            <table>
            <thead>
                <tr>
                    <th >Evento</th>
                    <th >Data</th>
                    <th >Prezzo</th>
                    <th >Posti disponibili</th>
                    <th >Modifica</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    no_result($spettacoli,5);
                    foreach($spettacoli as $s){
                        echo "<tr>";
                        
                            echo "<td><a href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                            echo "</a></td>";
                            
                            echo "<td>".format_data_ora($s['data_ora']);
                            echo "</td>";
                            
                            echo "<td>".$s['prezzo']."&euro;";
                            echo "</td>";

                            echo "<td>".$s['posti_disponibili']."</td>";
                            
                                echo "<td>";
                                echo "<div class='text-center'><a href=\"spettacolo_mod.php?id_mod=".$s['id']."\">Modifica</a></div>";
                                echo "</td>";
                        
                        echo "</tr>";
                    }
                ?>
                </tbody>
            </table>
        
        
        <h3>Biglietti degli utenti</h3><hr>
        <div id='messaggioAjax' class='message-success'></div>
        <?= filter_form($filter,'Cerca un utente') ?>
        <table>
        <thead>
            <tr>
                <th onclick="addlocpar('ord','u')">Utente</th>
                <th onclick="addlocpar('ord','e')">Evento</th>
                <th onclick="addlocpar('ord','d')">Data</th>
                <th >Prezzo</th>
                <th >Codice</th>
                <th >Utilizzato</th>
            </tr>
            </thead>
            <tbody>
            <?php
                $sql = "SELECT *,biglietti.id AS idbiglietto FROM
                (biglietti JOIN utenti ON biglietti.utente_id=utenti.id)
                JOIN spettacoli ON  biglietti.spettacolo_id=spettacoli.id
                JOIN eventi ON spettacoli.evento_id=eventi.id
                JOIN luoghi ON spettacoli.luogo_id=luoghi.id 
                WHERE luoghi.id=$luogo_id";
                if($filter != NULL) $sql.= " AND (utenti.username LIKE '%$filter%') ";
                $sql .=" ORDER BY biglietti.utilizzato DESC, "; // metti prima quelli non utlizzati epoi quelli utilizzati, a priori
                if($ord != NULL){ //controllo se si vuole ordinare per qualche campo
                    switch($ord){
                        case 'u': $sql.=" utenti.username";
                            break;
                        case 'e': $sql.="  eventi.nome";
                            break;
                        case 'd': $sql.="  spettacoli.data_ora";
                            break;
                    }
                }
                else  $sql.="  spettacoli.data_ora";
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

                        echo "<select onchange=\"ajax('biglietto_modifica_stato_r.php?stato='+this.options[this.selectedIndex].value+'&idbiglietto='+".$b['idbiglietto']."+'&idluogo='+".$luogo_id.",'messaggioAjax')\">";
                            echo "<option ";
                            if($b['utilizzato']=='si') echo " selected ";
                            echo">Si</option>";
                            echo "<option ";
                            if($b['utilizzato']=='no') echo " selected ";
                            echo">No</option>";
                        echo "<select>";
                        
                    echo "</tr>";
                }
                
            ?>
            </tbody>
        </table>

     
        </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
