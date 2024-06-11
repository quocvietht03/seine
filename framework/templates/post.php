<article <?php post_class('bt-post'); ?>>
	<?php
		echo seine_post_featured_render('full');
		echo seine_post_publish_render();
		if(is_single()){
      echo seine_single_post_title_render();
		}else{
      echo seine_post_title_render();
		}
		echo seine_post_meta_render();
		echo seine_post_content_render();
	?>
</article>
