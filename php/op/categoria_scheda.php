<?php
require_once('config.php');
register('cat_id');
register('filter');
?>

<html>
<head>
  <?= initialize_head(get_nome_categoria($cat_id)) ?>
  <script type="text/javascript" src="functions.js"></script>
</head>
<body>
  <?= initialize_body() ?>
  <div class="panel">
    <h1><?= get_nome_categoria($cat_id) ?></h1>
    <div id='messaggio'</div>
      <?php if(isAdmin() || isOperatore()): ?>
        <a href="categoria_mod.php?id_mod=<?= $cat_id ?>"><img src="img/icone/edit.png"></a>
        <a onclick='if(confirm("Eliminare categoria?"))
        ajax("elimina_cosa_dove.php?table=categorie&id=<?= $cat_id ?>","messaggio")'>
        <img src="img/icone/delete.png"></a>
      <?php endif ?>
      <hr>
      <?= filter_form($filter,'Cerca un evento') ?>

      <?php $sql = "SELECT * FROM eventi WHERE categoria_id=$cat_id ";
      if(isset($filter) && $filter!=NULL) $sql.=" AND nome LIKE '%$filter%'";
      $sql.= " ORDER BY nome";
      $eventi = select($sql);
      echo "<table>";
      echo "<tr>";
      echo "<th class=\"text-center\" width=1000px>Nome";
      echo "</th>";
      echo "<th class=\"text-center\" width=1000px>Durata";
      echo "</th>";
      echo "</tr>";
      no_result($eventi,2);
      foreach($eventi as $e){
        echo "<tr>";
        echo "<td><a href='evento_scheda.php?evt_id=".$e['id']."'>".$e['nome'];
        echo "</a></td>";

        echo "<td>".format_durata($e['durata']);
        echo "</td>";
        echo "</tr>";
      }
      echo "</table>";
      ?>
    </div>
    <?= footer() ?>
  </body>
  </html>
