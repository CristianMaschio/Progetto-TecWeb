<?php
require_once("php/config.php");
area_riservata();

//registrazione attributi del luogo
register('nome_l');
register('indirizzo_l');
register('telefono_l');

//registrazione degli attributi del profilo dell'amministratore del luogo
register('username_r');
register('password_r');
register('nome_r');
register('cognome_r');
register('tipo_r');
register('email_r');

$sql="INSERT INTO luoghi (nome,indirizzo,telefono) VALUES ('$nome_l','$indirizzo_l','$telefono_l')";
query($sql);
$id_nuovo_luogo = last_inserted_id(); //ultimo id inserito dalla connessione creato da AUTOINCREMENT (id del luogo)
$sql = "INSERT INTO utenti (username,pass,nome,cognome,tipo,email,luogo_id)
VALUES ('$username_r',PASSWORD('$password_r'),'$nome_r','$cognome_r','$tipo_r','$email_r',$id_nuovo_luogo)";
query($sql);
message("Luogo creato correttamente",1);
redirect('utente_scheda.php?id_u='.$_SESSION['user_id']);
?>