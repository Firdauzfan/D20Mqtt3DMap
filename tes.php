<?php
$str = file_get_contents('results.json');
$json = json_decode($str, true);
print_r($json);
?>