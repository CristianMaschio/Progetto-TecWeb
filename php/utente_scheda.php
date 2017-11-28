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

  <nav id="nav" class="On">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="title"><h2><hr>Profilo di <?php echo $user['username']?></h2></div>
  <hr>
  <div id="content">

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
        <a href="logout_r.php">Logout</a>
        <a href="utente_modifica_informazioni.php?id_u=<?=$id_u?>">Modifica informazioni utente</a>
      <?php endif ?>
    </div>

    <?php if(is_admin() || is_operatore()): ?>
      <a href="categoria_crea.php">Crea categoria</a>
      <a href="evento_crea.php">Crea evento</a>
      <a href="luogo_crea.php">Crea luogo</a>
      <a href="spettacolo_crea.php">Crea spettacolo</a>
    <?php endif ?>

    <?php if(is_gestore_luogo()): ?>
      <a href="spettacolo_crea.php">Crea spettacolo</a>
    <?php endif ?>

    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
