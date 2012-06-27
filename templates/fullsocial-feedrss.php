<?php
  $rss = $data;
  $maxitems = $rss->get_item_quantity($instance['feedrss_count']);
  $items = $rss->get_items(0, $maxitems);
?>

<div class="wp-fullsocial-widget-<?php echo $id; ?>">
  <?php if ($maxitems == 0) : ?>
  <ul>
    <li>No items.</li>
  </ul>
  <?php else : ?>
  <div class="viewport">
    <h4><?php echo $items[0]->get_title(); ?></h4>
    <p class="rss-desc"><?php echo $items[0]->get_description(); ?></p>
  </div>
  <ul>
    <?php foreach ($items as $i => $item) : ?>
    <li class="<?php echo $i == 0 ? 'current' : '' ?>">
      <strong>
        <a class="rss-link" href='<?php echo esc_url( $item->get_permalink() ); ?>'
        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
        <?php echo esc_html( $item->get_title() ); ?></a>
      </strong>
      <p style="display: none"><?php echo $item->get_description(); ?></p>
    </li>

    <?php endforeach; ?>
    <?php endif; ?>
  </ul>
<div class="clear"></div>
</div>
