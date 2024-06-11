<?php
/*
 * Packages CPT
 */

function seine_packages_register() {

	$cpt_slug = get_theme_mod('seine_packages_slug');

	if(isset($cpt_slug) && $cpt_slug != ''){
		$cpt_slug = $cpt_slug;
	} else {
		$cpt_slug = 'packages';
	}

	$labels = array(
		'name'               => esc_html__( 'Packages', 'seine' ),
		'singular_name'      => esc_html__( 'Packages', 'seine' ),
		'add_new'            => esc_html__( 'Add New', 'seine' ),
		'add_new_item'       => esc_html__( 'Add New Packages', 'seine' ),
		'all_items'          => esc_html__( 'All Packages', 'seine' ),
		'edit_item'          => esc_html__( 'Edit Packages', 'seine' ),
		'new_item'           => esc_html__( 'Add New Packages', 'seine' ),
		'view_item'          => esc_html__( 'View Item', 'seine' ),
		'search_items'       => esc_html__( 'Search Packages', 'seine' ),
		'not_found'          => esc_html__( 'No packages(s) found', 'seine' ),
		'not_found_in_trash' => esc_html__( 'No packages(s) found in trash', 'seine' )
	);

  $args = array(
		'labels'          => $labels,
		'public'          => true,
		'show_ui'         => true,
		'capability_type' => 'post',
    'publicly_queryable' => false,
		'hierarchical'    => false,
		'menu_icon'       => 'dashicons-admin-post',
		'rewrite'         => array('slug' => $cpt_slug), // Permalinks format
		'supports'        => array('title', 'thumbnail')
  );

  add_filter( 'enter_title_here',  'seine_packages_change_default_title');

  register_post_type( 'packages' , $args );
}
add_action('init', 'seine_packages_register', 1);


function seine_packages_taxonomy() {

	register_taxonomy(
		"packages_categories",
		array("packages"),
		array(
			"hierarchical"   => true,
			"label"          => "Categories",
			"singular_label" => "Category",
			"rewrite"        => true
		)
	);

	register_taxonomy(
        'packages_tag',
        'packages',
        array(
            'hierarchical'  => false,
            'label'         => __( 'Tags', 'seine' ),
            'singular_name' => __( 'Tag', 'seine' ),
            'rewrite'       => true,
            'query_var'     => true
        )
    );

}
add_action('init', 'seine_packages_taxonomy', 1);


function seine_packages_change_default_title( $title ) {
	$screen = get_current_screen();

	if ( 'packages' == $screen->post_type )
		$title = esc_html__( "Enter the packages's name here", 'seine' );

	return $title;
}


function seine_packages_edit_columns( $packages_columns ) {
	$packages_columns = array(
		"cb"                     => "<input type=\"checkbox\" />",
		"title"                  => esc_html__('Title', 'seine'),
		"thumbnail"              => esc_html__('Thumbnail', 'seine'),
		"packages_categories" 			 => esc_html__('Categories', 'seine'),
		"date"                   => esc_html__('Date', 'seine'),
	);
	return $packages_columns;
}
add_filter( 'manage_edit-packages_columns', 'seine_packages_edit_columns' );

function seine_packages_column_display( $packages_columns, $post_id ) {

	switch ( $packages_columns ) {

		// Display the thumbnail in the column view
		case "thumbnail":
			$width = (int) 64;
			$height = (int) 64;
			$thumbnail_id = get_post_meta( $post_id, '_thumbnail_id', true );

			// Display the featured image in the column view if possible
			if ( $thumbnail_id ) {
				$thumb = wp_get_attachment_image( $thumbnail_id, array($width, $height), true );
			}
			if ( isset( $thumb ) ) {
				echo $thumb; // No need to escape
			} else {
				echo esc_html__('None', 'seine');
			}
			break;

		// Display the packages tags in the column view
		case "packages_categories":

		if ( $category_list = get_the_term_list( $post_id, 'packages_categories', '', ', ', '' ) ) {
			echo $category_list; // No need to escape
		} else {
			echo esc_html__('None', 'seine');
		}
		break;
	}
}
add_action( 'manage_packages_posts_custom_column', 'seine_packages_column_display', 10, 2 );
