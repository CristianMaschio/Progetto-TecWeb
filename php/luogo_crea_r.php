<?php
require_once("php/config.php");
area_riservata();
register('nome_l');
register('indirizzo_l');
register('telefono_l');
$sql="INSERT INTO luoghi (nome,indirizzo,telefono) VALUES ('$nome_l','$indirizzo_l','$telefono_l')";
query($sql);
message("Luogo creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>