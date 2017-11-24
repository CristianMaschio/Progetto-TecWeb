<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
register('cat_id');
register('filter');
?>

<html lang="it" >
<head>
  <?= printHead(get_nome_categoria($cat_id)); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="title"><h2><hr><?= get_nome_categoria($cat_id) ?></h2></div>
  <hr>
  <div id="content">
    <p> <?php
    $sql = "
    SELECT descrizione
    FROM categorie
    WHERE id = $cat_id
    ";
    echo(select($sql)[0]['descrizione']);
    ?></p>

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

    <?php if(is_admin() || is_operatore()): ?>
      <a href="categoria_mod.php?id_mod=<?php $cat_id ?>">Modifica categoria</a>
      <!-- TODO: riprendere da qui per gestire le eliminazioni di cose:  o fai una pagina php muta tipo op oppure fai una funzione php -->
      <a onclick='if(confirm("Eliminare categoria?"))
      ajax("elimina_cosa_dove.php?table=categorie&id=<?php $cat_id ?>","messaggio")' href ="">Elimina categoria</a>
    <?php endif ?>

  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
