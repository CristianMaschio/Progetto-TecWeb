<!DOCTYPE html>

<?php require_once('php/config.php'); ?>
<?php require_once('php/printTemplate.php') ?>

<html lang="it" >
<head>
  <?= printHead('Home'); ?>
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
    <div id="title"><h2>Home</h2></div>
      <div class="content">
      <h3>Informazioni</h3>
      <p>Benvenuto su BiglietteriaOnline, il portale che ti permette di prenotare online biglietti per <a href="eventi.php">eventi</a> di varie <a href="categorie.php">categorie</a>. Per maggiori informazioni consulta la sezione <a href="info.php"><abbr title="Informazioni">info</abbr></a>
      </p>

      <h3>Prossimi eventi in programma</h3>
<?php 
$sql = "
	  SELECT eventi.nome AS nome_evento, eventi.id AS id_evento,
	    spettacoli.data_ora AS data_ora,
	    luoghi.nome AS nome_luogo, luoghi.id AS id_luogo
	  FROM eventi JOIN spettacoli ON eventi.id = spettacoli.evento_id
		      JOIN luoghi ON luoghi.id = spettacoli.luogo_id
	  WHERE spettacoli.data_ora >= NOW() 
	    AND spettacoli.posti_disponibili > 0 
	  ORDER BY spettacoli.data_ora ASC
	  LIMIT 6";
$prossimi_eventi = select($sql); //seleziona solamente eventi che hanno spettacoli, 6 al più e li ordina sulla data in modo descrescente
?>

      <table>
	<thead>
	  <tr>
	    <th>Evento</th>
	    <th>Luogo</th>
	    <th>Data</th>
	  </tr>
	</thead>

	<tbody>
<?php 
no_result($prossimi_eventi,3);
foreach($prossimi_eventi as $e){
	echo "<tr><td><a href=\"evento_scheda.php?evt_id=".$e['id_evento']."\">".$e['nome_evento']."</a></td><td><a href=\"luogo_scheda.php?luogo_id=".$e['id_luogo']."\">".$e['nome_luogo']."</a></td><td>".format_data_ora($e['data_ora'])."</td></tr>";
}
?>
	</tbody>
      </table>

      <h3>Categorie disponibili</h3>
      <dl>
<?php $categorie = select("
	SELECT *
	FROM categorie
	ORDER BY nome
	");
	foreach($categorie as $c){
	  echo "<dt><a href=\"categoria_scheda.php?cat_id=".$c['id']."\">".$c['nome']."</a></dt> <dd>".$c['descrizione']."</dd>";
	}
	?>
      </dl>


    </div>

  </div>


<footer>
  <?= printFooter(); ?>
</footer>
</body>
</html>
