<div class="widget-container wp-fullsocial-widget" data-number="<?php echo $this->number; ?>">
  <h3>Connect</h3>
  <div class="wp-fullsocial-widget-tabs">
    <ul>
    <?php $c = 0; ?>
    <?php foreach($this->schema() as $k => $social) : ?>
    <?php $data = $this->getDataSocial($social, $instance, $this->number, false, true) ?>
      <?php if ($data['enabled']) : ?>
      <li 
        class="<?php echo $data['id'].($c == 0 ? ' current' : ''); ?>" 
        data-type="<?php echo $social['id']; ?>" 
      >
        <?php echo substr($data['name'], 0, 1); ?>
      </li>
      <?php $c++; ?>
      <?php endif; ?>
    <?php endforeach; ?>
    </ul>
  </div>

  <div class="wp-fullsocial-blocks">
    <ul>
      <?php $c = 0; ?>
      <?php foreach($this->schema() as $k => $social) : ?>
        <?php if ($instance[$social['id'].'_enabled'] == 'on') : ?>
        <li class="wp-fullsocial-block <?php echo $social['id'] ?><?php echo $c == 0 ? ' current' : '' ?>">
        <?php $this->renderSocialBlock($social['id'], $this->number); ?>
        </li>
        <?php endif; ?>
      <?php $c++; ?>
      <?php endforeach; ?>
    </ul>
  </div>
</div>
