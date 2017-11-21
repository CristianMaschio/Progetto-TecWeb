<?php
/*
Nota: inserire gli indirizzi e-mail ripotati in questo esempio con indirizzi reali.
*/
$intestazione = "From: Mario Rossi <miamail@miosito.it>\r\n";
$intestazione .= "Cc: altramail@miosito.it\r\n";
$intestazione .= "CCn: terzamail@altrosito.it\r\n";
$intestazione .= "X-Priority: 3\r\n"; // 2 = urgente, 3 = normale, 4 = bassa priorità
$intestazione .= "X-Mailer: PHP/" . phpversion();

$destinatario = "freppo2@gmail.com";

$oggetto = "Messaggio di prova via PHP";

$messaggio = "Questo e' un messaggio di prova inviato\nusando l'istruzione mail() di PHP.\n\nA presto.";

$parametri = "-f freppo96@gmail.com";

if (mail ($destinatario, $oggetto, $messaggio, $intestazione, $parametri)) echo "Messaggio inviato";
else echo "Messaggio NON inviato";

?>