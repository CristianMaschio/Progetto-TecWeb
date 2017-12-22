<!DOCTYPE html>

<?php require_once('php/config.php');
require_once('php/printTemplate.php');
register('filter');
register('ord');
?>

<html lang="it" >
<head>
<?= printHead('Eventi'); ?>
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
      <div class="title"><h2>Esplora Eventi</h2></div>
      <div class="content">
          <p>Qui troverai una lista di tutti gli eventi per i quali potrai prenotare un biglietto</p>
          <?php
          /*

TODO: per l'accessibilità se ordiniamo una tabella forse dovremmo farlo con dei bottoni
e non semplicemente toccando un th, cosa che facciamo per ora

TODO: quando si legge qualcosa con un accento lo visualizza male, problemi con la codfica (nella tabella seridò)

 */

filter_form($filter,'Cerca un evento');

$sql = "SELECT eventi.*,categorie.nome AS nome_categoria,categorie.id AS id_categoria
	FROM eventi JOIN categorie ON eventi.categoria_id=categorie.id
	WHERE true ";

//aggiunge filtro per nome se è impostato
if(isset($filter)) $sql.= " AND eventi.nome LIKE '%$filter%' ";
//aggiunge filtro per categoria se è impostato:
// n - nome dell'evento
// c - nome della categoria
// d - durata dell'evento in senso decrescente
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
//altrimenti ordina per nome dell'evento
else $sql.= "ORDER BY eventi.nome";
//esegue la query
$eventi=select($sql);
?>

<table>
<thead>
<tr>
<th onclick="addlocpar('ord','n')"><a>Nome</a></th>
<th onclick="addlocpar('ord','c')"><a>Categoria</a></th>
<th onclick="addlocpar('ord','d')"><a>Durata</a></th>
<th >Spettacoli disponibili</th>
</tr>
</thead>
<tbody>
<?php //riempimento della tabella
no_result($eventi,4);
foreach($eventi as $e){
	echo "<tr>";

	echo "<td><a href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
	echo "</a></td>";

	echo "<td><a href=categoria_scheda.php?cat_id=".$e['id_categoria'].">".get_nome_categoria($e['categoria_id']);
	echo "</a></td>";

	echo "<td>".format_durata($e['durata']);
	echo "</td>";

	echo "<td>";
	if(!evento_has_spettacoli($e['id'])) echo "No";
	else echo "Si";
	echo "</td>";
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
