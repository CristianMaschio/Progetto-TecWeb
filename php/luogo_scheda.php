<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('luogo_id');
register('filter');
register('ord');
register('user_id');
$_SESSION['redirect_from_spettacolo'] = 'luogo_scheda.php?luogo_id='.$luogo_id; // quando modificherà uno spettacolo verrà rimandato alla pagina del luogo da cui proviene
?>

<html lang="it" >
<head>
  <?= printHead(get_nome_luogo($luogo_id)) ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo">
    <?php
    $luogo = select("SELECT * FROM luoghi WHERE id=$luogo_id")[0];
    ?>
    <div class="title"><h2><?= $luogo['nome'] ?></h2> </div>
      <div class="content">
          <aside>
              <dl>
                  <dt>Indirizzo</dt><dd><?= $luogo['indirizzo'] ?></dd>
                  <dt>Telefono</dt><dd><?= $luogo['telefono'] ?></dd>
              </dl>

              <?php if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)): ?>
                  <p class="linkDestra">
                      <a href="luogo_mod.php?id_mod= <?= $luogo_id ?>">Modifica Luogo</a>
                      <!-- TODO: riprendere da qui per gestire le eliminazioni di cose:  o fai una pagina php muta tipo op oppure fai una funzione php -->
                      <?php if(is_admin() || is_operatore()): ?>
                          <!-- metto questo solo ad admin e operatori in quanto un amministratore di luogo non dovrebbe essere in grado di eliminare il suo luogo -->
                          <a onclick='return confirm("Confermi di voler eliminare questo luogo?")' href ="luogo_elimina.php?id=<?php echo $luogo_id;?>">Elimina luogo</a>
                      <?php endif ?>
                  </p>
              <?php endif ?>
          </aside>
          <?php filter_form($filter,'Cerca un evento'); ?>
          <table>

              <thead>
              <tr>
                  <th onclick="addlocpar('ord','e')"><a>Evento</a></th>
                  <th onclick="addlocpar('ord','d')"><a>Data</a></th>
                  <th onclick="addlocpar('ord','p')"><a>Prezzo</a></th>
                  <?php if(is_logged()): ?>
                      <th>Prenotazione</th>
                  <?php endif ?>
                  <!-- TODO: proba  bilmente nel prossimo controllo ci varrà anche || user_linked_to_luogo($_SESSION['user_id'],$luogo_id)) -->
                  <?php if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)) : ?>
                      <th>Posti Disponibili</th>
                      <th>Modifica</th>
                      <th>Elimina</th>
                  <?php endif ?>
              </tr>
              <thead>
              <tbody>

              <?php //qui carico i varispettacoli
              $sql = "SELECT spettacoli.data_ora,spettacoli.prezzo,spettacoli.id,eventi.nome,eventi.id as idevento,spettacoli.posti_disponibili
                FROM spettacoli JOIN eventi ON spettacoli.evento_id=eventi.id
                WHERE spettacoli.luogo_id=$luogo_id AND spettacoli.data_ora >= NOW() ";
              if($filter != NULL) $sql.= " AND eventi.nome LIKE '%$filter%' ";
              if(isset($ord)){
                  switch($ord){
                      case 'e': $sql.= "ORDER BY eventi.nome";
                          break;
                      case 'd': $sql.= "ORDER BY spettacoli.data_ora ASC";
                          break;
                      case 'p':  $sql.= "ORDER BY spettacoli.prezzo";
                  }
              } else {
                    $sql.=" ORDER BY eventi.nome";
              }
              $spettacoli = select($sql);


              if ( is_admin() || is_operatore() || user_linked_to_luogo($luogo_id))	{
                  // TODO: e forse qui il controllo di prima andrebbe aggiunto (quello nel precedente todo), se lo implementi anche prima
                  no_result($spettacoli,7);
              } else if ( is_logged()) {
                  no_result($spettacoli,4);
              }else {
                  no_result($spettacoli,3);
              }
              foreach($spettacoli as $s){
                  echo "<tr>";

                  echo "<td><a href='evento_scheda.php?evt_id=".$s['idevento']."'>".$s['nome'];
                  echo "</a></td>";

                  echo "<td>".format_data_ora($s['data_ora']);
                  echo "</td>";

                  echo "<td>".$s['prezzo']."&euro;";
                  echo "</td>";

                  if(is_logged()){
                      print_form_prenotazione($s['id'], $_SESSION['user_id'],$s['posti_disponibili'],get_evento_from_spettacolo($s['id'])['nome']);
                  }
                  if(is_admin() || is_operatore() || user_linked_to_luogo($luogo_id)){
                      echo "<td>".$s['posti_disponibili']."</td>";
                      echo "<td><a href=\"spettacolo_mod.php?id_mod=".$s['id']."\">edit</a></td>";
                      echo "<td><a href=\"spettacolo_elimina.php?id_s=".$s['id']."\" >delete</a></td>";
                  }

                  echo "</tr>";
              }
              ?>
              <tbody>

          </table>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
