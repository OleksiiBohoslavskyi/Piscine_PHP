<?php
foreach ($_GET as $id => $name) {
  file_put_contents('list.csv', $id . ";" . $name . "\n", FILE_APPEND | LOCK_EX);
}
?>
