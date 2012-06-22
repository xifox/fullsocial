<?php
  $rss = $data;
  $maxitems = $rss->get_item_quantity($instance['feedrss_count']);
  $items = $rss->get_items(0, $maxitems);
?>

<div class="wp-fullsocial-widget-<?php echo $id; ?>">
  <ul>
    <?php if ($maxitems == 0) : ?>
    <li>No items.</li>
    <?php else : ?>
    <?php foreach ($items as $item) : ?>

    <li>
      <strong>
        <a href='<?php echo esc_url( $item->get_permalink() ); ?>'
        title='<?php echo 'Posted '.$item->get_date('j F Y | g:i a'); ?>'>
        <?php echo esc_html( $item->get_title() ); ?></a>
      </strong>
      <p><?php echo $item->get_description(); ?></p>
    </li>

    <?php endforeach; ?>
    <?php endif; ?>
  </ul>
<div class="clear"></div>
</div>
