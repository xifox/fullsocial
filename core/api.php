<?php
/**
 * constants
 */

define('_fs_upload_folder', getcwd().'/wp-content/uploads/wp-fullsocial-plugin/');

/**
 * retieve data from github
 */

function _fs_getData ($url) {
  // retrieve data form Github
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  $response = curl_exec($ch);
  curl_close($ch);

  return $response;
}

function _fs_loadLocalFile ($id) {
  $localFile = _fs_upload_folder.$id.'.txt';
  $handler = fopen($localFile, "r");
  $local = fread($handler, filesize($localFile));
  fclose($handler);

  return $local;
}

function _fs_saveLocalFile ($id, $data) {
  // save local file
  $localFile = _fs_upload_folder.$id.'.txt';
  $fh = fopen($localFile, 'w');
  fwrite($fh, $data);
  fclose($fh);
}

function _fs_localFileExist ($id) {
  $localFile = _fs_upload_folder.$id.'.txt';
  return (file_exists($localFile));
}

function _fs_getTwitts ($ids, $params) {
  $id = 'twitter';
  $ids = explode(',', $ids);

  if (_fs_localFileExist($id) and false) {
    $tws = json_decode(_fs_loadLocalFile($id), true);
  } else {
    $tws = array ();
    foreach($ids as $id) {
      $url = "http://search.twitter.com/search.json?q=%s&rpp=%s";
      $url = sprintf($url, urlencode($id), $params['count']);

      array_push($tws, json_decode(_fs_getData($url), true));
    }

    _fs_saveLocalFile('twitter', json_encode($tws));
  }

  return $tws;
}
