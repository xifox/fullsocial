<div class="wp-fullsocial-widget-<?php echo $id; ?>">
<?php $twws = $data['twitts']; ?>
<ul>
  <?php foreach($twws as $tws) : ?>
    <?php $results = $tws['results']; ?>
    <?php foreach($results as $tw) : ?>
      <li>
        <?php
        $t = $tw['text'];
        $t = preg_replace('/(http\:\/\/[a-z,A-Z,0-9,_,-,\.,\/]+)/', '<a href="$1" target="_blank">$1</a>', $t);
        ?>
        <img src="<?php echo $tw['profile_image_url']; ?>" />
        <?php echo html_entity_decode($t); ?>
      </li>
    <?php endforeach; ?>
  <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
