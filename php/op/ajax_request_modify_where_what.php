<?php
    require_once('config.php');
    register('table');
    register('field');
    register('id');
    register('new_value');
    query("UPDATE $table SET $field='$new_value' WHERE id=$id");
    echo "<div class='alert-box success round'>$field modificato</div>";
?>