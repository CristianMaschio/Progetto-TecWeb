<?php
    require_once("config.php");
    area_riservata();
    register('nome_c');
    register('descrizione_c');
    
    $sql="INSERT INTO categorie (nome,descrizione) VALUES ('$nome_c','$descrizione_c')";
    query($sql);
    message("Categoria creata correttamente",1);
    redirect('pannello_amministrazione.php');
?>