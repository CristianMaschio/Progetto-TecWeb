<?php
    require_once('config.php');
    requireLogin();
    register('spettacolo_b');
    register('user_b');
    
    $ripeti = true;
    $codice='';
    
    while($ripeti){
        $codice = uniqid();
        $codice_estratto =
        select("SELECT * FROM biglietti WHERE codice='$codice'");
        if($codice_estratto != NULL)
        $codice = uniqid('',true); 
        else $ripeti=false;
    }
    
    $sql="INSERT INTO biglietti (utente_id,spettacolo_id,codice)
    VALUES ($user_b,$spettacolo_b,'$codice')";
    query($sql);
    echo "<div class='button round expand success'>
    Biglietto prenotato con successo</div>";
?>