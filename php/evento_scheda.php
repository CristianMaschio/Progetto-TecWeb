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

  <nav>
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="content">
    <?php
    $eventi=select("SELECT * FROM eventi WHERE id=$evt_id");
    $evento = $eventi[0];
    ?>
    <h1><?= $evento['nome'] ?></h1><hr>
    <section><?= $evento['descrizione'] ?></section>
    <aside>
      <dl>
        <dt>Durata:<?= format_durata($evento['durata'])?></dt>
        <dt>Categoria: <a href='categoria_scheda.php?cat_id=<?= $evento['categoria_id'] ?>'><?= get_nome_categoria($evento['categoria_id']) ?></a></dt>
        <!-- TODO: manca modifica ed eliminazione dell evento da parte di un amministratore o operatore -->
        <?php if(is_admin() || is_operatore() ) {
          echo "<a href=\"evento_mod.php?id_mod=$evt_id\" >edit</a>";
        }
        if(is_admin() || is_operatore()) {
          echo "<a href= >delete</a>";
        }
        ?>
        <?
      </dl>
    </aside>


    <table>
      <tr>
        <th>Luogo</th>
        <th>Data</th>
        <th>Prezzo</th>
        <?php if(is_logged()): ?>
          <th>Prenotazione</th>
        <?php endif ?>
        <?php if(is_admin() || is_operatore()): ?>
          <th>Posti Disponibili</th>
          <th>Modifica</th>
          <th>Elimina</th>
        <?php endif ?>
      </tr>

      <?php //leggo i vari spettacoli
      $spettacoli = select("SELECT * FROM spettacoli WHERE evento_id=".$evento['id']." ORDER BY data_ora");
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
          if($s['posti_disponibili']>0)
          echo"<td><a>Prenota ora</a></td>";
          else
          echo "<td>Non ci sono posti disponibili</td>";
        }

        if(is_admin() || is_operatore()){
          echo "<td>".$s['posti_disponibili']."</td>";
          echo "<td>";
          echo "<a href=\"spettacolo_mod.php?id_mod=".$s['id']."\">edit";
          echo "</td>";
          echo "<td>";
          echo "<a href= >delete</a>";
          echo "</td>";
        }

      }
      ?>
    </table>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
