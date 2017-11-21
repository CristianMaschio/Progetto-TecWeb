<?php
    //devo controllare che la data non sia passata e che il formato dell'input del prezzo sia giusto
    require_once("config.php");
    register('id_mod');
    area_riservata(true,$id_mod);
    register('evento_s');
    register('luogo_s');
    register('data_s');
    register('ora_s');
    register('posti_s');
    register('costo_s');
    
    //controllo la data non sia passata
    if(is_data_passata($data_s)){
        message('Non puoi creare spettacoli in date passate',3);
        redirect('spettacolo_crea.php');
    }
    
    //formatto il costo in modo corretto
    $costo_s = format_costo($costo_s);
    
    $sql="UPDATE spettacoli SET
    luogo_id = $luogo_s,
    data_ora = '$data_s $ora_s:00',
    posti_disponibili = $posti_s,
    prezzo = $costo_s 
    WHERE id=$id_mod";
    query($sql);
    message("Spettacolo modificato correttamente",1);
    redirect($_SESSION['redirect_from_spettacolo']);
?>