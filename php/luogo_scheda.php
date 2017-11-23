<!DOCTYPE html>

<?php
    require_once('php/config.php');
    register('luogo_id');
    register('filter');
    register('ord');
    register('user_id');
    $_SESSION['redirect_from_spettacolo'] = 'luogo_scheda.php?luogo_id='.$luogo_id;
?>
<?php
  require_once('php/printTemplate.php');
?>

<html lang="it" >
<head>
  <?= printHead(get_nome_luogo($luogo_id)) ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content">
		<div id="messaggio"></div>
        <?php 
        $luoghi = select("SELECT * FROM luoghi WHERE id=$luogo_id");
        $luogo = $luoghi[0];
        ?>
        <h1><?= $luogo['nome'] ?></h1><hr>
		<aside>
			<dl>
				<dt>Indirizzo:<?= $luogo['indirizzo'] ?></dt>
				<dt>Telefono:<?= $luogo['telefono'] ?></dt>
			</dl>
		</aside>
        <?php if(is_admin() || is_operatore() || user_linked_to_luogo($_SESSION['user_id'],$luogo_id)) { 
            echo "<a href= >edit</a>";
        }
        if(is_admin() || is_operatore()) {
            echo "<a href= >delete</a>"; 
        }   
		?>
        </section>
            
		<table>
            <tr>
                <th><a>Evento</a></th>
                <th><a>Data</a></th>
                <th>Prezzo</th>
                <?php if(is_logged()): ?>
                    <th>Prenotazione</th>
                <?php endif ?>
                <?php if(is_admin() || is_operatore()): ?>
                    <th>Posti Disponibili</th>
                    <th>Modifica</th>
                    <th>Elimina</th>
                <?php endif ?>
            </tr>

            <?php //qui carico i varispettacoli
                $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli JOIN eventi ON spettacoli.evento_id=eventi.id
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

                if ( is_admin() || is_operatore() )	{
                    no_result($spettacoli,7);
                } else if ( is_logged()) {
                    no_result($spettacoli,4);
                }else {
                    no_result($spettacoli,3);
                }
                foreach($spettacoli as $s){
                    echo "<tr>";
                            
                    echo "<td><a href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                    echo "</a></td>";
                                
                    echo "<td>".format_data_ora($s['data_ora']);
                    echo "</td>";
                                
                    echo "<td>".$s['prezzo']."&euro;";
                    echo "</td>";
                                
                    if(is_logged()){
                                    
                        if($s['posti_disponibili']>0)
                            echo "<td><a href=>Prenota ora</a></td>";
                        else
                            echo "<td>Non ci sono posti disponibili</td>";
                    }
                    if(is_admin() || is_operatore()){
                        echo "<td>".$s['posti_disponibili']."</td>";
                        echo "<td><a href= >edit</a></td>";
                        echo "<td><a href= >delete</a></td>";
                    }
                            
                    echo "</tr>";
                }
            ?>
		</table>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
