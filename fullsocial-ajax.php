<?php
// header('Content-Type: application/jsonrequest');
global $wpdb; // this is how you get access to the database
echo 'WPDB: '.$wpdb;

include('core/api.php');

$gets = array (
    'type' => $_GET["type"]
  , 'params' => $_GET["params"]
  , 'identifiers' => $_GET["identifiers"]
  , 'count' => $_GET["count"]
);

//$text_widgets = get_option('widget_text');

switch ($gets['type']) {
  case "twitter":
    $ids = $gets['identifiers'];
    $id = "twitter";
    $data = array (
      'twitts' => _fs_getTwitts($ids, array(
          'count' => $gets['count']
      ))
    );

    include('templates/fullsocial-twitter.php');
  break;
}


//echo getData($params);
