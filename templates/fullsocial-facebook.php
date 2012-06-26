<div class="wp-fullsocial-widget-<?php echo $id; ?>">

<?php if($instance['facebook_include_script']) :?>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
    js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/all.js#xfbml=1&appId=<?php echo $instance['facebook_app_id'] ?>";
      fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<?php endif; ?>
  <div class="fb-like-box" data-href="<?php echo $instance['facebook_url_page'] ?>" data-width="<?php echo $instance['facebook_width'] ?>" data-height="<?php echo $instance['facebook_height'] ?>" data-show-faces="true" data-border-color="white" data-stream="false" data-header="false"></div>
<div class="clear"></div>
</div>
