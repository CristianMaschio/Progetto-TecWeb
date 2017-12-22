<!DOCTYPE html>

<?php
require_once('php/config.php');
register('evt_id');
register('ord');
$_SESSION['redirect_from_spettacolo'] = 'evento_scheda.php?evt_id='.$evt_id;
?>
<?php
require_once('php/printTemplate.php')
?>

<html lang="it" >
<head>
  <?= printHead(get_nome_evento($evt_id)); ?>
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
      $eventi=select("SELECT * FROM eventi WHERE id=$evt_id");
      $evento = $eventi[0];
      ?>
      <div class="title"><h2><?= $evento['nome'] ?></h2></div>
      <div class="content">
              <dl>
                  <dt>Durata</dt><dd><?= format_durata($evento['durata'])?></dd>
                  <dt>Categoria</dt><dd><a href='categoria_scheda.php?cat_id=<?= $evento['categoria_id'] ?>'><?= get_nome_categoria($evento['categoria_id']) ?></a></dt>
              </dl>

              <?php if(is_admin() || is_operatore()): ?>
                  <p class="linkDestra">
                      <a href="evento_mod.php?id_mod= <?= $evt_id ?>">Modifica Evento</a>
                      <!-- TODO: riprendere da qui per gestire le eliminazioni di cose:  o fai una pagina php muta tipo op oppure fai una funzione php -->
                      <a onclick='return confirm("Confermi di voler eliminare questo evento?")' href ="evento_elimina.php?id=<?php echo $evt_id;?>">Elimina evento</a>
                  </p>
              <?php endif ?>


              <p><?= $evento['descrizione'] ?></p>


          <table>
              <thead>
              <tr>
                  <th onclick="addlocpar('ord','l')"><a>Luogo</a></th>
                  <th onclick="addlocpar('ord','d')"><a>Data</a></th>
                  <th onclick="addlocpar('ord','p')"><a>Prezzo</a></th>
                  <?php if(is_logged()): ?>
                      <th>Prenotazione</th>
                  <?php endif ?>
                  <?php if(is_admin() || is_operatore()): ?>
                      <th>Posti Disponibili</th>
                      <th>Modifica</th>
                      <th>Elimina</th>
                  <?php endif ?>
              </tr>
              </thead>
              <tbody>
              <?php //leggo i vari spettacoli
              $spettacoli_query = "SELECT * 
              FROM spettacoli JOIN eventi ON eventi.id=spettacoli.evento_id
              JOIN luoghi ON luoghi.id=spettacoli.luogo_id
              WHERE evento_id=".$evento['id']." 
              AND spettacoli.data_ora >= NOW() ";
              

              if(isset($ord)){
                switch($ord){
                case 'l': $spettacoli_query.= "ORDER BY luoghi.nome";
                break;
                case 'c': $spettacoli_query.= "ORDER BY spettacoli.data_ora DESC";
                break;
                case 'p': $spettacoli_query.= "ORDER BY spettacoli.prezzo ASC";
                
                }
            } else {
                $spettacoli_query .= " ORDER BY data_ora";
            }
            $spettacoli = select($spettacoli_query);
              if ( is_admin() || is_operatore() )	{
                  no_result($spettacoli,7);
              } elseif ( is_logged()) {
                  no_result($spettacoli,4);
              }else {
                  no_result($spettacoli,3);
              }
              foreach($spettacoli as $s){
                  echo "<tr>";
                  echo "<td><a href=luogo_scheda.php?luogo_id=".$s['luogo_id'].">".get_nome_luogo($s['luogo_id']);
                  echo "</a></td>";
                  echo "<td>".format_data_ora($s['data_ora']);
                  echo "</td>";
                  echo "<td>".$s['prezzo']."&euro;";
                  echo "</td>";
                  if(is_logged()){
                      print_form_prenotazione($s['id'], $_SESSION['user_id'],$s['posti_disponibili'],get_evento_from_spettacolo($s['id'])['nome']);
                  }

                  if(is_admin() || is_operatore()){
                      echo "<td>".$s['posti_disponibili']."</td>";
                      echo "<td>";
                      echo "<a href=\"spettacolo_mod.php?id_mod=".$s['id']."\">edit";
                      echo "</td>";
                      echo "<td><a href=\"spettacolo_elimina.php?id_s=".$s['id']."\" >delete</a></td>";
                  }

              }
              ?>
              </tbody>
          </table>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
