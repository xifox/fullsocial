<?php $plugin_path = get_bloginfo('url').'/wp-content/plugins/fullsocial'; ?>

<div class="widget-container wp-fullsocial-widget" data-path="<?php echo $plugin_path; ?>">
  <div class="wp-fullsocial-widget-tabs">
    <ul>
    <?php $c = 0; ?>
    <?php foreach($this->schema() as $k => $social) : ?>
    <?php $data = $this->getDataSocial($social, $instance) ?>
      <?php if ($data['enabled']) : ?>
      <li
        class="<?php echo $data['name'].($c == 0 ? ' current"' : ''); ?>" 
        data-n="<?php echo $c; ?>"
        data-type="<?php echo $social['id']; ?>"
        <?php
          switch ($social['id']) {
            case "twitter":
              echo 'data-ids="'.$instance['twitter_identifiers'].'" ';
            break;
          }
        ?>
      >
        <?php echo substr($data['name'], 0, 1); ?>
      </li>
      <?php endif; ?>
    <?php $c++; ?>
    <?php endforeach; ?>
    </ul>
  </div>

  <div class="wp-fullsocial-blocks">
    <ul>
      <?php $c = 0; ?>
      <?php foreach($this->schema() as $k => $social) : ?>
        <li class="wp-fullsocial-block <?php echo $c == 0 ? ' current' : '' ?>">
          <?php $data = $this->getDataSocial($social, $instance) ?>
          <?php include($social['front-tmp']); ?>
        </li>
      <?php $c++; ?>
      <?php endforeach; ?>
    </ul>
  </div>

