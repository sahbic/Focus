<?php
  $file = dirname(__FILE__).'data/form-data-'.time().'-'.rand(1000,9999);
  file_put_contents($file, json_encode($_REQUEST));
  echo json_encode($_REQUEST);
?>
<!--
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
{"ID":"","Type":"Top","Color":"","Thickness":"","Formality":"","Length":"","Attractiveness":"","Fitness":""}
    $filters=array(
        "ID",
        "Type",
        "Color",
        "Thickness",
        "Formality",
        "Length",
        "Attractiveness",
        "Fitness"
    );

    $final=array();

    foreach ($filters as $filter) {
        $final[$filter]=$_POST[$filter]?$_POST[$filter]:"";
    } -->
