<div class="wp-fullsocial-widget-<?php echo $id; ?>">
<?php $twws = $data['twitts']; ?>
<a href="https://twitter.com/BechtelSummit" class="twitter-follow-button" data-show-count="false" data-size="large" data-show-screen-name="true" data-dnt="true">Follow @BechtelSummit</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
<ul>
  <?php foreach($twws as $tws) : ?>
    <?php $results = $tws['results']; ?>
    <?php foreach($results as $tw) : ?>
      <li>
        <?php

        // replace links
        $t = $tw['text'];
        $t = preg_replace('/(http\:\/\/[a-z,A-Z,0-9,_,-,\.,\/]+)/', '<a href="$1" target="_blank">$1</a>', $t);

        // twitter hostname
        $tw_host = 'https://twitter.com/#!/';

        // replace @user
        $t = preg_replace('/(@[a-z,A-Z,0-9,_]+)/', '<a href="'.$tw_host.'$1" target="_blank">$1</a>', $t);

        //replace #hashtag
        $pattern = '/(#[a-z,A-Z,0-9,_]+)/';
        $hashtag = preg_match_all($pattern, $t, $matches);
        if (count($matches) > 0) {
          foreach ($matches[0] as $hash) {
            $hashtag_link = $tw_host.'search/'.urlencode($hash);
            $t = preg_replace($pattern, '<a href="'.$hashtag_link.'" target="_blank">$1</a>', $t);
          }
        }

        ?>
        <img src="<?php echo $tw['profile_image_url']; ?>" />
        <?php echo html_entity_decode($t); ?>
      </li>
    <?php endforeach; ?>
  <?php endforeach; ?>
</ul>
<div class="clear"></div>
</div>
