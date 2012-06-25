<?php
  wp_enqueue_script('WP_fullSocial_Widget', plugins_url().'/fullsocial/templates/js/jquery.colorbox-min.js', array('jquery'));
  wp_enqueue_style('WP_fullSocial_Widget', plugins_url().'/fullsocial/templates/css/colorbox.css');
?>
<script type="text/javascript">
(function($) {
  $(document).ready(function(){
    $(".group1").colorbox({rel:'group1'});
  });
})(jQuery);
</script>
<div class="wp-fullsocial-widget-blocks instagrams">
<h1><img src="<?php echo plugins_url();?>/fullsocial/templates/images/Instagram_Logo_Small.png" class="instagram-logo" alt="Instagram" /> | <?php echo $instance['instagram_identifiers']; ?></h1>
  <?php $instagrams = $data['instams'];
  $instams = $instagrams[0]['data'];
  $count = $instance['instagram_count'];

  ?>
<ul>
<?php
    $loop=0;
    foreach($instams as $its) : ?>
    <?php $results = $its['images'];
          $caption = $its['caption'];
    ?>
       <li>
       <a class="group1" href="<?php echo $results['standard_resolution']['url']; ?>" title="<?php echo $caption['text']; ?>"><img src="<?php echo $results['thumbnail']['url']; ?>" /></a>
       </li>
    <?php
      $loop++;
      if($count==$loop) break; 
    endforeach; ?>
</ul>
<div class="clear"></div>
</div>
