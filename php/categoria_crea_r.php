<?php
require_once("php/config.php");
area_riservata();
register('nome_c');
register('descrizione_c');

// TODO: (FAVINHO) : implementare che si metta un'immagine sul database

$sql="INSERT INTO categorie (nome,descrizione) VALUES ('$nome_c','$descrizione_c')";
query($sql);
message("Categoria creata correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>