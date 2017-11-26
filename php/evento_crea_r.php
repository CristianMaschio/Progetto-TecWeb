<?php
require_once("php/config.php");
area_riservata();
register('nome_e');
register('descrizione_e');
register('durata_e');
register('categoria_e');
$sql="INSERT INTO eventi (nome,descrizione,durata,categoria_id) VALUES ('$nome_e','$descrizione_e','$durata_e:00',$categoria_e)";
echo $sql;
query($sql);
message("Evento creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>