<?php
$avatar = get_field('avatar');
$job = get_field('job');
$desc = get_field('description');
$signature = get_field('signature');
?>
<article <?php post_class('bt-post'); ?>>


  <div class="bt-post--inner">
    <?php if (!empty($desc)) { ?>
        <?php
        echo '<div class="bt-post--desc">' . $desc . '</div>';
        ?>
    <?php
    }
    ?>
    <div class="bt-post--infor">
      <div class="bt-post--avatar">
        <?php
        if (!empty($avatar)) {
          echo '<img src="' . esc_url($avatar['url']) . '" alt="' . esc_attr($avatar['title']) . '" />';
        }
        ?>
      </div>
      <div class="bt-post--title-wrap">
        <div class="bt-post--signature">
          <?php
          if (!empty($signature)) {
            echo '<img src="' . esc_url($signature['url']) . '" alt="' . esc_attr($signature['title']) . '" />';
          }
          ?>
        </div>
        <?php
        if (!empty($job)) {
          echo '<div class="bt-post--title-job">' . get_the_title() . ' - ' . $job . '</div>';
        }
        ?>
      </div>
    </div>
  </div>

</article>