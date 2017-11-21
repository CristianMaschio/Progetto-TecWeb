<?php
    require_once('config.php');
    register('id_u');
    function proprietario($user){
        if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user['id']) return true;
        else return false;
    }
?>

<html>
    <head>
        <?= initialize_head(get_nome_utente($id_u)) ?>
        <script type="text/javascript" src="functions.js"></script>
    </head>
    <body>
        <?= initialize_body() ?>
        <div class="panel">
            <?php $userz=select("SELECT * FROM utenti WHERE id=$id_u");
            $user=$userz[0];
            ?>
            <h2 class='text-center'><?php if(isAdmin($id_u)) echo "<i>Amministratore </i>"; else if(isOperatore($id_u)) echo "<i>Operatore </i>";?>
            <?=$user['username']?></h2><hr>
            <span id='dialog' class='text-center'></span><br>
                <b>Nome: </b>
                    <?php if(proprietario($user)) echo "
                    <a onclick='ajax(\"ajax_request_modify_where_what.php?table=utenti&field=nome&id=".$user['id']."&new_value=\"+getElementById(\"newname\").value,
                    \"dialog\")'><img src='img/icone/edit.png'></a>
                    <input id='newname' type='text' value=" ?><?= $user['nome'] ?>
                    <?php if(proprietario($user))
                    echo "></input>" ?><br>
                <b>Cognome: </b>
                    <?php if(proprietario($user)) echo "
                    <a onclick='ajax(\"ajax_request_modify_where_what.php?table=utenti&field=cognome&id=".$user['id']."&new_value=\"+getElementById(\"newcognome\").value,
                    \"dialog\")'><img src='img/icone/edit.png'></a>
                    <input id='newcognome' type='text' value=" ?><?= $user['cognome'] ?>
                    <?php if(proprietario($user))
                    echo "></input>" ?><br>
                <b>Email: </b>
                    <?php if(proprietario($user)) echo "
                    <a onclick='ajax(\"ajax_request_modify_where_what.php?table=utenti&field=email&id=".$user['id']."&new_value=\"+getElementById(\"newemail\").value,
                    \"dialog\")'><img src='img/icone/edit.png'></a>
                    <input id='newemail' type='email' value=" ?><?= $user['email'] ?>
                    <?php if(proprietario($user))
                    echo "></input>" ?>
            
            <?php if(isLogged() && $_SESSION['user_id'] == $id_u): ?>
                <hr><h3>Prenotazioni</h3>
                <table>
                    <tr>
                        <th width=1000px class="text-center">Evento</th>
                        <th width=1000px class="text-center">Luogo</th>
                        <th width=1000px class="text-center">Data</th>
                        <th width=1000px class="text-center">Prezzo</th>
                        <th width=1000px class="text-center">Codice*</th>
                    </tr>
                    <?php
                        $sql = "SELECT biglietti.codice AS codice,spettacoli.id AS idspettacolo,spettacoli.evento_id AS idevento,spettacoli.data_ora,spettacoli.prezzo,spettacoli.luogo_id AS idluogo
                        FROM biglietti JOIN spettacoli ON biglietti.spettacolo_id=spettacoli.id
                        WHERE utente_id=".$_SESSION['user_id']."";
                        $biglietti=select($sql);
                        no_result($biglietti,6);
                        foreach($biglietti as $b){
                            echo "<tr>";
                            
                                echo "<td><a href='evento_scheda.php?evt_id=".$b['idevento']."'>".get_nome_evento($b['idevento']);
                                echo "</a></td>";
                                
                                echo "<td><a href=luogo_scheda.php?luogo_id=".$b['idluogo'].">".get_nome_luogo($b['idluogo']);
                                echo "</a></td>";
                                
                                echo "<td>".format_data_ora($b['data_ora']);
                                echo "</td>";
                                
                                echo "<td>".$b['prezzo']."&euro;";
                                echo "</td>";
                                
                                echo "<td>".$b['codice'];
                                echo "</td>";
                            echo "</tr>";
                        }
                    ?>
                </table>
                <i>*Segna il codice e il tuo nome utente (<u><?= $user['username'] ?></u>) per poter entrare allo spettacolo</i>
            <?php endif ?>
            
        </div>
        <?= footer() ?>
    </body>
</html>