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

  /**
   * Constuctor
   */

  function __construct()  {

    // create tmp folder
    $upload_dir = wp_upload_dir();
    $tmp_folder = $upload_dir['basedir'].'/_wp-fullsocial-plugin';

    $wp_plugin_folder = get_bloginfo('url').'/wp-content/plugins/fullsocial';

    // add stylesheet file
    wp_enqueue_style('wp-github', $wp_plugin_folder.'/public/fullsocial.css');

    // add javascript file
    wp_enqueue_script('wp-github', $wp_plugin_folder.'/public/fullsocial.js', array('jquery'));

    // creates upload plugin folder
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
   * redenring function used to async requests
   */

  function renderSocialBlock ($type, $number) {
    $type = (isset($type) and strlen($type) > 0) ? $type : $_GET['type'];
    $number = isset($number) ? $number : $_GET['number'];

    $instances = $this->get_settings();
    $instance = $instances[$number];

    $socials = $this->schema();
    $social = $socials[$type];

    // print widget block
    $data = $this->getDataSocial($social, $instance, $number);
    $id = $social['id'];
    include('templates/'.$social['front-tmp']);
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
                )
            , 'front-tmp'             => 'fullsocial-twitter.php'
            , 'back-tmp'              => 'fullsocial-twitter.php'
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
            )
        , 'front-tmp'             => 'fullsocial-instagram.php'
        , 'back-tmp'              => 'fullsocial-instagram.php'
      )
      // Facebook
      , 'facebook'           => array(
          'name'                  => 'Facebook'
        , 'id'                    => 'Facebook'
        , 'description'           => 'Facebook social network'
        , 'fields'                  => array (
                 'app_id'         => array (
                      'name'          =>  'app_id'
                    , 'type'          =>  'text'
                    , 'desc'          =>  'Facebook app Id. Visit https://developers.facebook.com/apps to get yours'
                    , 'value'         =>  ''
                  )
                  , 'width'           => array (
                      'name'          =>  'width'
                    , 'type'          =>  'input'
                    , 'desc'          =>  ''
                    , 'value'         =>  '10'
                  )
                  , 'height'           => array (
                      'name'          =>  'height'
                    , 'type'          =>  'input'
                    , 'desc'          =>  ''
                    , 'value'         =>  '10'
                  )
                , 'enabled'         => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable Facebook tab'
                    , 'value'         =>  'on'
                  )
            )
        , 'front-tmp'             => 'fullsocial-facebook.php'
        , 'back-tmp'              => 'fullsocial-facebook.php'
      )

        // google+
      , 'googleplus'          => array(
          'name'                  => 'Google+'
        , 'id'                    => 'google+'
        , 'description'           => 'Google plus social network'
        , 'fields'                  => array (
                  'key'              => array (
                      'name'            =>  'key'
                    , 'type'            =>  'text'
                    , 'desc'            =>  'google API key'
                    , 'value'           =>  ''
                  )

                , 'userid'              => array (
                      'name'            =>  'userid'
                    , 'type'            =>  'text'
                    , 'desc'            =>  'google User ID'
                    , 'value'           =>  ''
                  )

                , 'enabled'         => array (
                      'name'          =>  'enabled'
                    , 'type'          =>  'checkbox'
                    , 'desc'          =>  'Enable google plus tab'
                    , 'value'         =>  'on'
                  )
            )
        , 'front-tmp'             => 'fullsocial-googleplus.php'
        , 'back-tmp'              => 'fullsocial-googleplus.php'
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

  function getDataSocial ($social, $instance, $number) {
    // default data
    $data = array(
        'name'              => $social['name']
      , 'enabled'           => $instance[$social['id'].'_enabled'] == 'on'
    );

    switch ($social['id']) {
      case "twitter":
        $data['twitts'] = _fs_getTwitts($instance['twitter_identifiers'], array(
            'count' => $instance[$social['id'].'_count']
          , 'number' => $number
        ));
      break;

      case "instagram":
        $data['instams'] = _fs_getInstagrams ($instance['instagram_identifiers'], array(
            'count' => $instance[$social['id'].'_count']
          , 'client_id' => $instance[$social['id'].'_client_id']

        ));
      break;

      case "facebook":
        $data['facebook'] = _fs_getFacebook ($instance['facebook_identifiers'], array(
            'width' => $instance[$social['id'].'_width']
          , 'app_id' => $instance[$social['id'].'_app_id']
          , 'height' => $instance[$social['id'].'_height']

        ));
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

    include('templates/container.php');
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
      include('core/templates/'.$social['back-tmp']);
    }
  }

}

function widget_wp_fullsocial() {
  $coco = register_widget('WP_fullSocial_Widget');
  return $coco;
}


add_action('widgets_init', 'widget_wp_fullsocial');


?>
