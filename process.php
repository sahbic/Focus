<?php
  $file = dirname(__FILE__).'data/form-data-'.time().'-'.rand(1000,9999);
  file_put_contents($file, json_encode($_REQUEST));
  echo json_encode($_REQUEST);
  exec("cat \"lol\" > data.json")
?>
