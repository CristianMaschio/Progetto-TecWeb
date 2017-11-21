<?php
    require_once('config.php');
    register('idluogo');
    area_riservata(true,$idluogo);
    register('idbiglietto');
    register('stato');
    query("UPDATE biglietti SET utilizzato='$stato' WHERE id=$idbiglietto");
    echo "<div class='button round expand success'>Stato del biglietto cambiato correttamente<div>"
?>