<?php
    require_once('config.php');
    clean_spettacoli();
    register('luogo_id');
    register('filter');
    register('ord');
    register('user_id');
    $_SESSION['redirect_from_spettacolo'] = 'luogo_scheda.php?luogo_id='.$luogo_id;
?>

<html>
    <head>
        <?= initialize_head(get_nome_luogo($luogo_id)) ?>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <?= initialize_body() ?>
        <h1><?= get_nome_luogo($luogo_id) ?></h1><hr>
		<div id="messaggio"></div>
        <?php $luogo_farlocco = select("SELECT * FROM luoghi WHERE id=$luogo_id");
        $luogo = $luogo_farlocco[0];
        ?>
        <div class="large-4 column panel right">
            <b>Indirizzo: </b><?= $luogo['indirizzo'] ?><br>
            <b>Telefono: </b><?= $luogo['telefono'] ?>
			<div  class="text-center">
            <?php if(isAdmin() || isOperatore() || user_linked_to_luogo($_SESSION['user_id'],$luogo_id)): ?>
                <br><br>
                    <a href="luogo_mod.php?id_mod=<?= $luogo['id'] ?>"><img src="img/icone/edit.png"></a>
            <?php endif; ?>
			
			<?php if(isAdmin() || isOperatore()): ?>
					<a onclick='if(confirm("Eliminare luogo?"))
					ajax("elimina_cosa_dove.php?table=luoghi&id=<?= $luogo_id ?>","messaggio")'>
						<img src="img/icone/delete.png"></a>
            <?php endif ?>
			</div>
        </div>
        
        <div class="large-8 column left">
            <div id='confirmid'></div>
            <?php
                $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli
                JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id ";
                if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
                if(isset($ord)){
                    switch($ord){
                        case 'n': $sql.= "ORDER BY eventi.nome";
                            break;
                        case 'd': $sql.= "ORDER BY spettacoli.data_ora ASC";
                            break;
                        default:  $sql.= "ORDER BY eventi.nome";
                }
        }
                $spettacoli = select($sql);
                filter_form($filter,'Cerca un evento');
            ?>
            <table>
                <tr>
                    <th width=1000px class="text-center" onclick="addlocpar('ord','e')"><a>Evento</a></th>
                    <th width=1000px class="text-center" onclick="addlocpar('ord','d')"><a>Data</a></th>
                    <th width=1000px class="text-center" >Prezzo</th>
                    <?php if(isLogged()): ?>
                        <th width=500px class="text-center"></th>
                    <?php endif ?>
                    <?php if(isAdmin() || isOperatore()): ?>
                      <th width=1000px class="text-center">Posti</th>
                      <th width=2500px class="text-center"></th>
                    <?php endif ?>
                </tr>
                <?php
                no_result($spettacoli,7);
                    foreach($spettacoli as $s){
                        echo "<tr>";
                        
                            echo "<td><a href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                            echo "</a></td>";
                            
                            echo "<td>".format_data_ora($s['data_ora']);
                            echo "</td>";
                            
                            echo "<td>".$s['prezzo']."&euro;";
                            echo "</td>";
                            
                            if(isLogged()){
                                
                                if($s['posti_disponibili']>0)
                                    echo "<td><a class='small button expand' onclick='if(confirm(\"Confermare prenotazione?\"))
                                    ajax(\"prenota.php?spettacolo_b=".$s['id']."&user_b=".$_SESSION['user_id']."\",\"confirmid\");'>
                                    Prenota ora</a></td>";
                                else
                                    echo "<td>Non ci sono posti disponibili</td>";
                                
                            }
                            
                             if(isAdmin() || isOperatore()){
                                echo "<td>".$s['posti_disponibili']."</td>";
                                echo "<td>";
                                echo "<div class='text-center'><a href=\"spettacolo_mod.php?id_mod=".$s['id']."\"><img src=\"img/icone/edit.png\"></a>";
								echo "<a onclick='if(confirm(\"Eliminare spettacolo?\"))
					ajax(\"elimina_cosa_dove.php?table=spettacoli&id=".$s['id']."\",\"messaggio\")'>
						<img src=\"img/icone/delete.png\"></a></div>";
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