<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('id_u');

// true sse è la pagina dell'utente loggato
function proprietario($user){
  if(isset($_SESSION['user_id']) && $_SESSION['user_id'] == $user['id']) return true;
  else return false;
}

?>

<html lang="it" >
<?php
  //come prima cosa leggi di che utente si tratta
  $user=select("SELECT * FROM utenti WHERE id=$id_u")[0];
?>
<head>
  <?= printHead('Profilo '.$user['username']); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content">
      <div class="title"><h2>Profilo di <?php echo $user['username']?></h2></div>
      <div class="content">
          <?php
          echo
              "<dl>
      <dt>Nome</dt><dd>".$user['nome']."</dd>
      <dt>Cognome</dt><dd>".$user['cognome']."</dd>
      <dt><span lang=\"en\">Email</span></dt><dd>".$user['email']."</dd>
      </dl>";
          ?>

          <?php if(is_logged() && proprietario($user)): ?>
              <hr><h3>Prenotazioni</h3>
              <table>

                  <thead>
                  <tr>
                      <th>Evento</th>
                      <th>Luogo</th>
                      <th>Data</th>
                      <th>Prezzo</th>
                      <th>Codice</th>
                      <th>Annulla prenotazione</th>
                  </tr>
                  </thead>
                  </tbody>
                  <?php
                  $sql = "SELECT biglietti.codice AS codice,spettacoli.id AS idspettacolo,spettacoli.evento_id AS idevento,spettacoli.data_ora,spettacoli.prezzo,spettacoli.luogo_id AS idluogo, biglietti.id AS idbiglietto
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

                      print_form_anullamento($b['idbiglietto'],get_nome_evento($b['idevento']));
                  }
                  ?>
                  </tbody>
              </table>
              <em>Segna il codice e il tuo nome utente (<?= $user['username'] ?>) per poter entrare allo spettacolo</em>
              <hr />
              <a href="utente_modifica_informazioni.php?id_u=<?=$id_u?>">Modifica informazioni utente</a>
          <?php endif ?>

          <div id="amministrazione">
              <div class="title"><h3>Pannello Amministazione</h3></div>
              <div id="panAmm" class="panOn">
                  <?php if(is_admin() || is_operatore()): ?>
                      <ul>
                          <li><a href="categoria_crea.php">Crea categoria</a></li>
                          <li><a href="evento_crea.php">Crea evento</a></li>
                          <li><a href="luogo_crea.php">Crea luogo</a></li>
                          <li><a href="spettacolo_crea.php">Crea spettacolo</a></li>
                          <?php if(is_admin()): ?>
                            <li><a href="operatore_crea.php">Crea operatore</a></li>
                          <?php endif ?>
                      </ul>
                  <?php endif ?>

                  <?php if(is_gestore_luogo()): ?>
                      <ul>
                          <li><a href="spettacolo_crea.php">Crea spettacolo</a></li>
                      </ul>
                  <?php endif ?>
              </div>
          </div>

      </div>



    </div>





    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
