<div class="wp-fullsocial-widget-<?php echo $id; ?>">
<?php $twws = $data['twitts']; ?>
<a href="https://twitter.com/BechtelSummit" class="twitter-follow-button" data-show-count="false" data-size="large" data-dnt="true">Follow @BechtelSummit</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<ul>
  <?php foreach($twws as $tws) : ?>
    <?php $results = $tws['results']; ?>
    <?php foreach($results as $tw) : ?>
      <li>
        <?php
        $t = $tw['text'];
        $t = preg_replace('/(http\:\/\/[a-z,A-Z,0-9,_,-,\.,\/]+)/', '<a href="$1">$1</a>', $t);
        ?>
        <img src="<?php echo $tw['profile_image_url']; ?>" />
        <?php echo html_entity_decode($t); ?>
      </li>
    <?php endforeach; ?>
  <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
