<div class="wp-fullsocial-widget-<?php echo $social['id']; ?>">
  <?php $twws = $data['twitts']; ?>

  <?php foreach($twws as $tws) : ?>
    <?php $results = $tws['results']; ?>
    <?php foreach($results as $tw) : ?>
      <p>
        <img src="<?php echo $tw['profile_image_url']; ?>" />
        <?php echo html_entity_decode($tw['text']); ?>
      </p>
    <?php endforeach; ?>
  <?php endforeach; ?>
</div>
