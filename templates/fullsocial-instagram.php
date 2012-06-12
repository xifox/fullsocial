<div class="wp-fullsocial-widget-blocks instagrams">
  <?php $instagrams = $data['instams'];
        $instams = $instagrams[0]['data'];
  ?>

<ul>
  <?php foreach($instams as $its) : ?>
    <?php $results = $its['images']; ?>
       <li>
        <img src="<?php echo $results['thumbnail']['url']; ?>" />
       </li>
   <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
