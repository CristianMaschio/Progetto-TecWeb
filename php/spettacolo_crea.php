<!DOCTYPE html>

<?php
require_once('php/config.php');
require_once('php/printTemplate.php');
if(!is_admin() && !is_operatore() && !is_gestore_luogo()){
    message('Area riservata',2);
    redirect('home.php');
    die();
}
?>

<html lang="it" >
<head>
  <?= printHead('Crea nuovo spettacolo'); ?>
</head>
<body>

  <header>
    <?= printHeader(); ?>
  </header>

  <nav id="nav" class="Off">
    <?= printNavBar(); ?>
  </nav>

  <?php echo consumeMessage(); ?>

  <div id="corpo" >
      <div class="title"><h2>Crea nuovo spettacolo</h2></div>
      <div class="box">

    <form action="spettacolo_crea_r.php" method="POST">
        <label for="evento_s">Evento</label> <select name="evento_s" required>
        <!-- TODO: qui gli eventi dovrebbero essere raggruppati PRIMA per categoria e solo dopo ordinati per nome (non mi ricordo come si chiami l'attributo per fare questo ma esiste ed è anche molto importante fare questa cosa) -->
            <?php $eventi = select("SELECT * FROM eventi ORDER BY nome ASC");
            foreach($eventi as $e){
                echo "<option value=".$e['id'].">".$e['nome']."</option>";
            }
            ?>
        </select>
        
        <?php if(is_admin() || is_operatore()): ?>
        <!-- se sei admin o operatore puoi scegliere dove mettere lo spettacolo -->
            <label for="luogo_s">Luogo</label> <select id="luogo_s" name="luogo_s" required>
                <?php $luoghi = select("SELECT * FROM luoghi ORDER BY nome ASC");
                foreach($luoghi as $l){
                    echo "<option value=".$l['id'].">".$l['nome']."</option>";
                }
                ?>
            </select>
        <?php else: ?>
                <!-- sei la'mministratore del luogo e dunque non puoi decidere dove metterlo -->
                <?php
                    $id_luogo_amministrato = id_luogo_amministrato($_SESSION['user_id']);
                ?>
                <input type="hidden" name="luogo_s" value=<?php echo $id_luogo_amministrato; ?> />
        <?php endif ?>

        <label for="data_s">Data</label> <input type="date" name="data_s" required/>
        <label for="ora_s">Orario di inizio</label> <input type="time" name="ora_s" required/>
        <label for="posti_s">Posti disponibili</label> <input type="number" name="posti_s" value=0 required/>
        <label for="costo_s">Costo spettacolo</label> <input type="number" step="0.01" name="costo_s" value="0.0" required/>
        <div class="boxInline">
            <input type="submit" value="Conferma">
            <input id="buttonRight" type="reset" value="Annulla">
        </div>
    </form>
      </div>
  </div>

  <footer>
    <?= printFooter(); ?>
  </footer>
</body>
</html>
