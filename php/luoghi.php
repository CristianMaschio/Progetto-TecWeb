<!DOCTYPE html>

<?php
  require_once('php/config.php');
  require_once('php/printTemplate.php');
  register('filter');
?>

<html lang="it" >
<head>
  <?= printHead('Luoghi'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="title"><h2><hr>Luoghi</h2></div>
  <hr>
  <div id="content">
    <p>
      Qui troverai una lista dei luoghi in cui si terranno gli spettacoli per i quali potrai prenotare il tuo biglietto.
    </p>
    <?php
    filter_form($filter,'Cerca un luogo');
    $sql = "SELECT *
    FROM luoghi
    WHERE true ";

    if(isset($filter)) $sql.= " AND nome LIKE '%$filter%' ";
    $sql.=" ORDER BY luoghi.nome ";

    $luoghi=select($sql);
    ?>

    <table>
      <thead>
        <tr>
          <th>Luogo</th>
          <th>Indirizzo</th>
          <th>Telefono</th>
        <tr>
      </thead>
      <tbody>
      <?php
      no_result($luoghi,3);
      foreach($luoghi as $l){
        echo "<tr>";

        echo "<td><a href='luogo_scheda.php?luogo_id=".$l['id']."'>".$l['nome'];
        echo "</a></td>";

        echo "<td>".$l['indirizzo'];
        echo "</a></td>";

        echo "<td>".$l['telefono'];
        echo "</td>";
      }
      ?>
      </tbody>
    </table>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
