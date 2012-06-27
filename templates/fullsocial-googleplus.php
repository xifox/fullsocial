<?php
  $entries = $data['googleplus'][0]['items'];
?>

<div class="wp-fullsocial-widget-<?php echo $id; ?>">
<!-- Place this tag where you want the badge to render. -->
<div class="g-plus" data-width="260" data-href="https://plus.google.com/<?php echo $instance['googleplus_userid'] ?>?rel=publisher"></div>
<!-- Place this render call where appropriate. -->
<script type="text/javascript">gapi.plus.go();</script>
<ul>
  <?php foreach($entries as $entry) : ?>
      <li>
        <h5>
          <a href="<?php echo $entry['url']; ?>" target="_blank">
            <?php echo html_entity_decode($entry['title']); ?>
          </a>
        </h5>
      </li>
    <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
