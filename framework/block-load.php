<?php
function seine_register_layout_category( $categories ) {

	$categories[] = array(
		'slug'  => 'bt-custom-block',
		'title' => 'Custom Block'
	);

	return $categories;
}
add_filter( 'block_categories_all', 'seine_register_layout_category' );

function seine_acf_init() {

    // check function exists
    if( function_exists('acf_register_block') ) {
        acf_register_block(array(
            'name'              => 'widget-recent-posts',
            'title'             => __('Widget - Recent Posts', 'seine'),
            'description'       => __('Widget - Recent Posts block.', 'seine'),
            'render_callback'   => 'seine_acf_block_render_callback',
            // 'enqueue_assets' => 'seine_acf_block_assets_callback',
            'category'          => 'bt-custom-block',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>',
            'keywords'          => array( 'Recent Posts', 'Posts' ),
        ));

				acf_register_block(array(
            'name'              => 'widget-make-appointment',
            'title'             => __('Widget - Make Appointment', 'seine'),
            'description'       => __('Widget - Make Appointment block.', 'seine'),
            'render_callback'   => 'seine_acf_block_render_callback',
            // 'enqueue_assets' => 'seine_acf_block_assets_callback',
            'category'          => 'bt-custom-block',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>',
            'keywords'          => array( 'Make Appointment', 'Make', 'Appointment' ),
        ));

				acf_register_block(array(
            'name'              => 'widget-instagram-posts',
            'title'             => __('Widget - Instagram Posts', 'seine'),
            'description'       => __('Widget - Instagram Posts block.', 'seine'),
            'render_callback'   => 'seine_acf_block_render_callback',
            // 'enqueue_assets' => 'seine_acf_block_assets_callback',
            'category'          => 'bt-custom-block',
            'icon'              => '<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path fill="none" d="M0 0h24v24H0V0z" /><path d="M19 13H5v-2h14v2z" /></svg>',
            'keywords'          => array( 'Instagram Posts', 'Instagram' ),
        ));

    }
}
add_action('acf/init', 'seine_acf_init');

function seine_acf_block_render_callback( $block ) {
  // convert name ("acf/testimonial") into path friendly slug ("testimonial")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "block-parts/block" folder
  if( file_exists( get_stylesheet_directory() . "/framework/block-parts/{$slug}.php" ) ) {
      include get_stylesheet_directory() . "/framework/block-parts/{$slug}.php" ;
  }
}

function seine_acf_block_assets_callback($block) {

  // convert name ("acf/block-name") into path friendly slug ("block-name")
  $slug = str_replace('acf/', '', $block['name']);

  // include a template part from within the "block-parts/block" folder
  if( file_exists( get_stylesheet_directory() . "/framework/block-parts/{$slug}.css" ) ) {
      wp_enqueue_style( "block-{$slug}", get_stylesheet_directory_uri() . "/framework/block-parts/{$slug}.css" );
  }
  if( file_exists( get_stylesheet_directory() . "/framework/block-parts/{$slug}.js" ) ) {
      wp_enqueue_script( "block-{$slug}", get_stylesheet_directory_uri() . "/framework/block-parts/{$slug}.js", array('jquery'), '', true );
  }
}
