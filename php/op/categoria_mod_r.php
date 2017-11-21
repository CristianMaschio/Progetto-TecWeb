<?php
    require_once("config.php");
    area_riservata();
    register('id_mod');
    register('nome_c');
    register('descrizione_c');
    
    $sql="UPDATE categorie SET 
    nome = '$nome_c', 
    descrizione = '$descrizione_c' 
    WHERE id=$id_mod";
    query($sql);
    message("Categoria modificata correttamente",1);
    redirect("categoria_scheda.php?cat_id=$id_mod");
?>