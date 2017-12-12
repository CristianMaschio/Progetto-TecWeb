<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  register('filter');
  register('ord');
?>

<html lang="it" >
<head>
  <?= printHead('Spettacoli'); ?>
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
    <div class="content">
    <?php 
    $sql =
    "SELECT eventi.nome AS evento_nome,
            eventi.id AS evento_id,
            luoghi.nome AS luogo_nome,
            luoghi.id AS luogo_id,
            categorie.nome AS categoria_nome,
            categorie.id AS categoria_id,
            spettacoli.data_ora AS data_ora,
            spettacoli.prezzo AS prezzo,
            spettacoli.id AS spettacolo_id,
            spettacoli.posti_disponibili AS posti_disponibili
    FROM spettacoli JOIN eventi ON eventi.id=spettacoli.evento_id
                    JOIN luoghi ON luoghi.id=spettacoli.luogo_id
                    JOIN categorie ON categorie.id=eventi.categoria_id
    WHERE spettacoli.posti_disponibili > 0 
    ";

    // se è stato impostato un filtro, aggiungo agli spettacoli che voglio vedere il fatto che il parametro di filtro sia contenuto nel nome o dello spettacolo o del luogo o della categoria
    if(isset($filter)) 
      $sql.= " AND ( eventi.nome LIKE '%$filter%'
                  OR luoghi.nome LIKE '%$filter%'
                  OR categorie.nome LIKE '%$filter%') ";
    if(isset($ord)){
      switch($ord){
          case 'e': $sql.= "ORDER BY eventi.nome";
              break;
          case 'l': $sql.= "ORDER BY luoghi.nome";
              break;
          case 'c': $sql.= "ORDER BY categorie.nome";
              break;
          case 'd': $sql.= "ORDER BY spettacoli.data_ora";
              break;
          case 'p': $sql.= "ORDER BY spettacoli.prezzo";
              break;
          default:  $sql.= "ORDER BY eventi.nome";
      }
    } else 
      $sql.= "ORDER BY eventi.nome, luoghi.nome, categorie.nome, spettacoli.data_ora, spettacoli.prezzo";
    $spettacoli = select($sql);
    ?>
    <h2>Spettacoli</h2><hr />
    <!-- In questa pagina non si presentano gli spettacoli che non hanno dei posti disponibili -->
    <p>Qui troverai una lista di tutti gli spettacoli che hanno dei posti disponibili.</p>
    <?php filter_form($filter,'Cerca evento, luogo o categoria'); ?>
    <table>
      <thead>
      <tr>
          <th onclick="addlocpar('ord','e')">Evento</th>
          <th onclick="addlocpar('ord','l')">Luogo</th>
          <th onclick="addlocpar('ord','c')">Categoria</th>
          <th onclick="addlocpar('ord','d')">Data</th>
          <th onclick="addlocpar('ord','p')">Prezzo</th>
          <?php if(is_logged()): ?>
            <th >Prenota</th>
          <?php endif ?>
      </tr>
      </thead>

      <tbody>
      <?php 
        no_result($spettacoli, (is_logged() ? 6 : 5)); //se sei loggato nessun risultato ha 6 colonne, altrimenti 5
        foreach($spettacoli as $s){
          echo "<tr>";

          echo "<td><a href=\"evento_scheda.php?evt_id=".$s['evento_id']."\">".$s['evento_nome']."</a></td>";
          echo "<td><a href=\"luogo_scheda.php?luogo_id=".$s['luogo_id']."\">".$s['luogo_nome']."</a></td>";
          echo "<td><a href=\"categoria_scheda.php?cat_id=".$s['categoria_id']."\">".$s['categoria_nome']."</a></td>";
          echo "<td>".format_data_ora($s['data_ora'])."</td>";
          echo "<td>".$s['prezzo']."&euro;</td>";
          
          if(is_logged()){
            //echo "<td>Prenota</td>";
            print_form_prenotazione($s['spettacolo_id'], $_SESSION['user_id'],$s['posti_disponibili'],$s['evento_nome']);
          }

          echo "</tr>";
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
