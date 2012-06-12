<div class="wp-fullsocial-widget-<?php echo $id; ?>">
  <?php $twws = $data['twitts']; ?>
<ul>
  <?php foreach($twws as $tws) : ?>
    <?php $results = $tws['results']; ?>
    <?php foreach($results as $tw) : ?>
      <li>
        <img src="<?php echo $tw['profile_image_url']; ?>" />
        <?php echo html_entity_decode($tw['text']); ?>
      </li>
    <?php endforeach; ?>
  <?php endforeach; ?>
</ul>
</div>
