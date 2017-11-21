<?php
    require_once("config.php");
    area_riservata();
    register('nome_l');
    register('indirizzo_l');
    register('telefono_l');
    
    $sql="INSERT INTO luoghi (nome,indirizzo,telefono) VALUES ('$nome_l','$indirizzo_l','$telefono_l')";
    query($sql);
    message("Luogo aggiunto correttamente",1);
    redirect('pannello_amministrazione.php');
?>