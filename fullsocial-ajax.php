<?php
header('Content-Type: application/jsonrequest');

include('core/api.php');

$params = array (
    'type' => $_GET["type"]
  , 'params' => $_GET["params"]
);

echo _fs_getTwitts(
echo '<pre>';
print_r($params);
echo '</pre>';

//echo getData($params);
