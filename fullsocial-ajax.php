<?php
// header('Content-Type: application/jsonrequest');

include('core/api.php');

$gets = array (
    'type' => $_GET["type"]
  , 'params' => $_GET["params"]
  , 'identifiers' => $_GET["identifiers"]
);

switch ($gets['type']) {
  case "twitter":
    $ids = $gets['identifiers'];
    $id = "twitter";
    $data = array (
      'twitts' => _fs_getTwitts($ids, array(
          'count' => 10
      ))
    );

    include('templates/fullsocial-twitter.php');
  break;
}


//echo getData($params);
