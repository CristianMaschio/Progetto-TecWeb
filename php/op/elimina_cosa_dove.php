<?php
	require_once('config.php');
	area_riservata();
	register('table');
	register('id');
	query("DELETE FROM $table WHERE id=$id");
	echo "<div class='small button round success expand'>Eliminato correttamente</div>";
?>
