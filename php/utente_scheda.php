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
<?php $user=select("SELECT * FROM utenti WHERE id=$id_u")[0]; //come prima cosa leggi di che utente si tratta ?>
<head>
  <?= printHead('Profilo '.$user['username']); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content">
    <h2>Profilo di
      <?php
      echo $user['username']."</h2><hr />".
      "<dl>
      <dd>Nome</dd><dt>".$user['nome']."</dt>
      <dd>Cognome</dd><dt>".$user['cognome']."</dt>
      <dd><span lang=\"en\">Email</span></dd><dt>".$user['email']."</dt>
      </dl>";
      ?>

      <?php if(is_logged() && proprietario($user)): ?>
        <hr><h3>Prenotazioni</h3>
        <table>
          <tr>
            <th>Evento</th>
            <th>Luogo</th>
            <th>Data</th>
            <th>Prezzo</th>
            <th>Codice</th>
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
          }
          ?>
        </table>
        <em>Segna il codice e il tuo nome utente (<?= $user['username'] ?>) per poter entrare allo spettacolo</em>
        <hr />
        <a href="logout_r.php">Logout</a>
        <a href="utente_modifica_informazioni.php?id_u=<?=$id_u?>">Modifica informazioni</a>
      <?php endif ?>
    </div>

    <footer>
      <?= printFooter(); ?>
    </footer>
  </body>
  </html>
