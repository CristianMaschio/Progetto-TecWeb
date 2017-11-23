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

  <div id="content">

    <h1>Luoghi</h1>
    <hr>

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
      <tr>
        <th>Nome</th>
        <th>Indirizzo</th>
        <th>Telefono</th>

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
    </table>
  </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
