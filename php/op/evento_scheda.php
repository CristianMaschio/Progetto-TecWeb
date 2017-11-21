<?php
    require_once('config.php');
    clean_spettacoli();
    register('evt_id');
    register('ord');
    $_SESSION['redirect_from_spettacolo'] = 'evento_scheda.php?evt_id='.$evt_id;
?>

<html>
    <head>
        <?= initialize_head(get_nome_evento($evt_id)) ?>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <?= initialize_body() ?>
        <?php
        $eventi=select("SELECT * FROM eventi WHERE id=$evt_id");
        $evento = $eventi[0];
        ?>
        
        <h1><?= $evento['nome'] ?></h1><hr>
		<div id="messaggio"></div>
        <div id='confirmid'></div>
        <div class='large-9 column'><?= $evento['descrizione'] ?></div>
        <div class='large-3 column panel'>
            <b>Durata</b>: <?= format_durata($evento['durata']) ?>
            <b>Categoria</b>: <a href='categoria_scheda.php?cat_id=<?= $evento['categoria_id'] ?>'><?= get_nome_categoria($evento['categoria_id']) ?></a>
            <?php if(isAdmin() || isOperatore()): ?>
                <br><br><div  class="text-center">
                    <a href="evento_mod.php?id_mod=<?= $evento['id'] ?>"><img src="img/icone/edit.png"></a>
					<a onclick='if(confirm("Eliminare evento?"))
					ajax("elimina_cosa_dove.php?table=eventi&id=<?= $evt_id ?>","messaggio")'>
						<img src="img/icone/delete.png"></a>
                </div>
            <?php endif ?>
        <br></div>
        
        <div class='large-12 column left'><i><h4>Biglietti</h4></i>
        <hr>
        <table>
            <tr>
                <th width=1000px class="text-center">Luogo</th>
                <th width=1000px class="text-center">Data</th>
                <th width=1000px class="text-center">Prezzo</th>
                <?php if(isLogged()): ?>
                    <th width=500px class="text-center"></th>
                <?php endif ?>
                <?php if(isAdmin() || isOperatore()): ?>
                    <th width=1000px class="text-center">Posti</th>
                    <th width=1000px class="text-center"></th>
                <?php endif ?>
            </tr>
        <?php //qui carico i varispettacoli
        
        $spettacoli = select("SELECT * FROM spettacoli WHERE evento_id=".$evento['id']." ORDER BY data_ora");
        no_result($spettacoli,7);
        foreach($spettacoli as $s){
            echo "<tr>";
                echo "<td><a href=luogo_scheda.php?luogo_id=".$s['luogo_id'].">".get_nome_luogo($s['luogo_id']);
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
                    echo "<td nowrap>";
                    echo "<div class='text-center'>
		    <a href=\"spettacolo_mod.php?id_mod=".$s['id']."\">
		    <img src=\"img/icone/edit.png\"></a>";
		    echo "<a onclick='if(confirm(\"Eliminare spettacolo?\"))
			    ajax(\"elimina_cosa_dove.php?table=spettacoli
			    &id=".$s['id']."\",\"messaggio\")'>
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