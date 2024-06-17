<?php
$job = get_field('job');
$prf_link = get_field('profile_link');
$socials = get_field('socials');

?>
<article <?php post_class('bt-post'); ?>>
  <div class="bt-post--inner">
    <?php if (has_post_thumbnail()){ ?>
      <div class="bt-post--thumbnail">
        <?php echo seine_post_cover_featured_render($args['image-size']); ?>
      </div>
    <?php } ?>

    <div class="bt-post--infor">
    <?php
        if(!empty($job)) {
          echo '<div class="bt-post--job">' . $job . '</div>';
        }
      ?>
      <?php echo seine_post_title_render(); ?>
    </div>
  </div>
</article>
