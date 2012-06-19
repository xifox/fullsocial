<?php
  $entries = $data['googleplus'][0]['items'];
?>

<div class="wp-fullsocial-widget-<?php echo $id; ?>">
<ul>
  <?php foreach($entries as $entry) : ?>
      <li>
        <a href="<?php echo $entry['url']; ?>" target="_blank">
          <?php echo html_entity_decode($entry['title']); ?>
        </a>
      </li>
    <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
