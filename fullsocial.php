<?php
/*
Plugin Name: fullSocial plugin 
Plugin URI: http://www.xifox.net/wp-plugins/full-social
Description: full social connect
Author: Laura Melo
Version: 0.0.1
Author URI: http://www.tuerta.com.ar
Licence: A "Slug" license name e.g. GPL2
*/

/*  Copyright 2012  Damian Suarez  (email : rdsuarez@gmail.com)

    This program is free software; you can redistribute it and/or modify
    it under the terms of the GNU General Public License, version 2, as 
    published by the Free Software Foundation.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program; if not, write to the Free Software
    Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

/**
 * Translation support
 */

load_plugin_textdomain('wp_github_plugin', false, basename( dirname( __FILE__ ) ) . '/languages' );

// include('core/constants.php');
include('core/api.php');

/**
 * wordpress widget social class
 */

class WP_fullSocial_Widget extends WP_Widget {

  var $plugin_dirname = 'fullsocial';

  /**
   * Constuctor
   */

  function __construct()  {
    $wp_plugin_folder = get_bloginfo('url').'/wp-content/plugins/'.$this->plugin_dirname;

    // add stylesheet file
    wp_enqueue_style('wp-github', $wp_plugin_folder.'/public/fullsocial.css');

    // add javascript file
    wp_enqueue_script('wp-github', $wp_plugin_folder.'/public/fullsocial.js', array('jquery'));

    // creates upload plugin folder
    $upload_dir = wp_upload_dir();
    $tmp_folder = $upload_dir['basedir'].'/_wp-fullsocial-plugin';
    if (!file_exists($tmp_folder)) {
      mkdir($tmp_folder, 0777);
    }

    $opciones = array(
        'classname'     => 'WP_fullSocial_Plugin'
      , 'description'   => 'wordpress full social connect plugin'
    );

    add_action('wp_ajax_render_social', array($this, 'renderSocialBlock'));
    parent::__construct('wp-fullsocial-plugin', 'fullSocial', $opciones);
  }

  /**
   * update update date property for each social
   */

  function updateUpdatedDate ($type, $number, $all_instances, $instance) {
    $instance[$type.'_updated'] = date('c');
    $all_instances[$number] = $instance;

    $this->save_settings($all_instances);
    $this->updated = true;
  }

  /**
   * redering function used for async requests
   */

  function renderSocialBlock ($type, $number) {
    $type = (isset($type) and strlen($type) > 0) ? $type : $_GET['type'];
    $number = isset($number) ? $number : $_GET['number'];
    
    $all_instances = $this->get_settings();
    $instance = $all_instances[$number];

    $retrieve = true;

    $updated_field = $instance[$type.'_updated'];

    if (!isset($updated_field)) {
      $this->updateUpdatedDate($type, $number, $all_instances, $instance);
    } else {
      if (strlen($updated_field) < 1) {
        $this->updateUpdatedDate($type, $number, $all_instances, $instance);
      } else {

        $prev_date = strtotime($updated_field);
        $now = strtotime('now');
        $diff = $now - $prev_date;

        if ($diff > 30) {
          $this->updateUpdatedDate($type, $number, $all_instances, $instance);
        } else {
          $retrieve = false;
        }

      }
    }

    $socials = $this->schema();
    $social = $socials[$type];
    $data = $this->getDataSocial($social, $instance, $number, $retrieve, false);
    $id = $social['id'];

    // load templates
    $tpl = 'templates/'.$social['front-tpl'];
    $custom_tpl = get_template_directory().'/'.$this->plugin_dirname.'/'.$social['front-tpl'];

    if (file_exists($custom_tpl)) {
      include($custom_tpl);
    } else {
      include($tpl);
    }

  }

  /**
   * data structure
   */

  function schema () {
    return array (

        // Twitter
        'twitter'             => array(
              'name'              => 'Twitter'
            , 'id'                => 'twitter'
            , 'description'       => 'Twitter social network'
            , 'fields'              => array (
                  'enabled'           => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable twitter tab'
                    , 'value'         =>  'on'
                  )

                , 'count'           => array (
                      'name'          =>  'count'
                    , 'type'          =>  'input'
                    , 'desc'          =>  'Amount of twitts'
                    , 'value'         =>  '10'
                  )

                , 'identifiers'     => array (
                      'name'          =>  'identifiers'
                    , 'type'          =>  'textarea'
                    , 'desc'          =>  'Add the terms to show, can be an account (@account) or hashtag (#hashtag) separate by coma.'
                    , 'value'         =>  '@summitbechtel, #jamboree'
                  )

                , 'updated'         => array (
                      'name'          =>  'updated'
                    , 'type'          =>  'hidden'
                    , 'desc'          =>  'updating date'
                    , 'value'         =>  '' 
                  )
                )

            , 'front-tpl'             => 'fullsocial-twitter.php'
            , 'back-tpl'              => 'fullsocial-twitter.php'
          )

        // Instagram
      , 'instagram'           => array(
          'name'                  => 'Instagram'
        , 'id'                    => 'instagram'
        , 'description'           => 'Instagram social network'
        , 'fields'                  => array (
                'identifiers'            => array (
                      'name'            =>  'identifiers'
                    , 'type'            =>  'textarea'
                    , 'desc'            =>  'Add the terms to show, can be an account (@account) or hashtag (#hashtag) separate by coma.'
                    , 'value'           =>  '@summit, #summit'
                  )

                , 'client_id'         => array (
                      'name'          =>  'client_id'
                    , 'type'          =>  'text'
                    , 'desc'          =>  'Instagram Client Id. Visit http://instagram.com/developer/register/ to get yours'
                    , 'value'         =>  '12f66edc57124e2c966a7582e39472a2'
                  )
               
                  , 'count'           => array (
                      'name'          =>  'count'
                    , 'type'          =>  'input'
                    , 'desc'          =>  'Amount of Instagrams'
                    , 'value'         =>  '10'
                  )

                , 'enabled'         => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable Instagram tab'
                    , 'value'         =>  'on'
                  )

                , 'updated'         => array (
                      'name'          =>  'updated'
                    , 'type'          =>  'hidden'
                    , 'desc'          =>  'updating date'
                    , 'value'         =>  '' 
                  )
            )
        , 'front-tpl'             => 'fullsocial-instagram.php'
        , 'back-tpl'              => 'fullsocial-instagram.php'
      )

      // Facebook
      , 'facebook'           => array(
          'name'                  => 'Facebook'
        , 'id'                    => 'facebook'
        , 'description'           => 'Facebook social network'
        , 'fields'                  => array (
                  'app_id'         => array (
                      'name'          =>  'app_id'
                    , 'type'          =>  'text'
                    , 'desc'          =>  'Facebook app Id. Visit https://developers.facebook.com/apps to get yours'
                    , 'value'         =>  ''
                  )
                  , 'url_page'         => array (
                      'name'          =>  'url_page'
                    , 'type'          =>  'text'
                    , 'desc'          =>  'Facebook page url'
                    , 'value'         =>  ''
                  )
                  , 'include_script'         => array (
                      'name'          =>  'include_script'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Insert facebook script'
                    , 'value'         =>  'on'
                  )
                  , 'width'           => array (
                      'name'          =>  'width'
                    , 'type'          =>  'input'
                    , 'desc'          =>  ''
                    , 'value'         =>  '220'
                  )
                  , 'height'           => array (
                      'name'          =>  'height'
                    , 'type'          =>  'input'
                    , 'desc'          =>  ''
                    , 'value'         =>  '400'
                  )
                  , 'enabled'         => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable Facebook tab'
                    , 'value'         =>  'on'
                  )

                , 'updated'         => array (
                      'name'          =>  'updated'
                    , 'type'          =>  'hidden'
                    , 'desc'          =>  'updating date'
                    , 'value'         =>  '' 
                  ) 
            )
        , 'front-tpl'             => 'fullsocial-facebook.php'
        , 'back-tpl'              => 'fullsocial-facebook.php'
      )

        // google+
      , 'googleplus'          => array(
          'name'                  => 'Google+'
        , 'id'                    => 'googleplus'
        , 'description'           => 'Google plus social network'
        , 'fields'                  => array (
                  'key'              => array (
                      'name'            =>  'key'
                    , 'type'            =>  'text'
                    , 'desc'            =>  'google API key'
                    , 'value'           =>  '103540267989268320816'
                  )

                , 'userid'              => array (
                      'name'            =>  'userid'
                    , 'type'            =>  'text'
                    , 'desc'            =>  'google User ID'
                    , 'value'           =>  'AIzaSyCgG-xlB3WKvJ8Oz3BgnXcM0A1O4SLh0tw'
                  )

                , 'enabled'         => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable google plus tab'
                    , 'value'         =>  'on'
                  )

                , 'updated'         => array (
                      'name'          =>  'updated'
                    , 'type'          =>  'hidden'
                    , 'desc'          =>  'updating date'
                    , 'value'         =>  '' 
                  )
            )
        , 'front-tpl'             => 'fullsocial-googleplus.php'
        , 'back-tpl'              => 'fullsocial-googleplus.php'
      )

    );
  }

  function getFields () {
    $fields = array();

    foreach($this->schema() as $k => $social) {
      foreach($social['fields'] as $l => $field) {
        $name = $social['id'].'_'.$field['name'];
        $fields[$name] = $field['value']; 
      }
    }

    return $fields;
  }

  /*
   * return data for each social
   */

  function getDataSocial ($social, $instance, $number, $retrieve, $only_headers) {
    // default data
    $data = array(
        'name'              => $social['name']
      , 'id'                => $social['id']
      , 'enabled'           => $instance[$social['id'].'_enabled'] == 'on'
      , 'number'            => $number
    );

    if ($only_headers) {
      return $data;
    }

    $params = array(
        'number'        => $number
      , 'id'            => $social['id']
      , 'retrieve'      => $retrieve
    );

    switch ($social['id']) {
      case "twitter":
        $params['count'] = $instance[$social['id'].'_count'];

        $data['twitts'] = _fs_getTwitts($instance['twitter_identifiers'], $params);
      break;

      case "instagram":
        $params['count'] = $instance[$social['id'].'_count'];
        $params['client_id'] = $instance[$social['id'].'_client_id'];

        $data['instams']    = _fs_getInstagrams ($instance['instagram_identifiers'], $params);
      break;

      case "googleplus":
        $params['userid'] = $instance[$social['id'].'_userid'];

        $data['googleplus'] = _fs_getGoogleplus ($instance['googleplus_userid'], $instance['googleplus_key'], $params);
      break;
    }

    return $data;
  }

  /**
   * Widget markup
   */

  function widget($args, $instance) {
    extract($args);
    extract($instance);

    include('templates/loader.php');
    echo $after_widget;
  }

  /**
   * update widget data
   */

  function update($new_instance, $old_instance) {
    $data = array();
    foreach($this->getFields() as $k => $field) {
      $data[$k] = strip_tags($new_instance[$k]);
    }
    return $data;
  }

  /**
   * form rendering - backend
   */

  function form($instance) {
    $instance = wp_parse_args((array) $instance, $this->getFields());

    foreach($this->schema() as $k => $social) {
      $fields = $social['fields'];
      include('core/templates/'.$social['back-tpl']);
    }
  }

}

function widget_wp_fullsocial() {
  return register_widget('WP_fullSocial_Widget');
}
add_action('widgets_init', 'widget_wp_fullsocial');


?>
