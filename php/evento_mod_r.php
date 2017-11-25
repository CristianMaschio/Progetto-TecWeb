<?php
    require_once("php/config.php");
    area_riservata();
    register('nome_e');
    register('descrizione_e');
    register('durata_e');
    register('categoria_e');
    register('id_mod');
    
    $sql="UPDATE eventi SET 
    nome = '$nome_e', 
    descrizione = '$descrizione_e',
    durata = '$durata_e',
    categoria_id = $categoria_e 
    WHERE id=$id_mod";
    query($sql);
    message("Evento modificato correttamente",1);
    redirect("evento_scheda.php?evt_id=$id_mod");
?>