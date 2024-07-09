<?php
/* Register Sidebar */
if (!function_exists('seine_register_sidebar')) {
	function seine_register_sidebar()
	{
		register_sidebar(array(
			'name' => esc_html__('Main Sidebar', 'seine'),
			'id' => 'main-sidebar',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h4 class="wg-title">',
			'after_title' => '</h4>',
		));
	}
	add_action('widgets_init', 'seine_register_sidebar');
}

/* Add Support Upload Image Type SVG */
function seine_mime_types($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'seine_mime_types');

/* Register Default Fonts */
if (!function_exists('seine_fonts_url')) {
	function seine_fonts_url()
	{
		global $seine_options;
		$base_font = 'Cormorant';
		$head_font = 'DM Sans';

		$font_url = '';
		if ('off' !== _x('on', 'Google font: on or off', 'seine')) {
			$font_url = add_query_arg('family', urlencode($base_font . ':400,400i,600,700|' . $head_font . ':400,400i,500,600,700'), "//fonts.googleapis.com/css");
		}
		return $font_url;
	}
}
/* Enqueue Script */
if (!function_exists('seine_enqueue_scripts')) {
	function seine_enqueue_scripts()
	{
		global $seine_options;

		 if(is_singular('product')) {
			wp_enqueue_script('slick-slider', get_template_directory_uri().'/assets/libs/slick/slick.min.js', array('jquery'), '', true);
			wp_enqueue_style('slick-slider', get_template_directory_uri(). '/assets/libs/slick/slick.css',array(), false);

		 	wp_enqueue_script('zoom-master', get_template_directory_uri().'/assets/libs/zoom-master/jquery.zoom.min.js', array('jquery'), '', true);
		 }

		wp_enqueue_script('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.js', array('jquery'), '', true);
		wp_enqueue_style('select2', get_template_directory_uri() . '/assets/libs/select2/select2.min.css', array(), false);

		/* Fonts */
		wp_enqueue_style('seine-fonts', seine_fonts_url(), false);
		wp_enqueue_style('seine-main', get_template_directory_uri() . '/assets/css/main.css',  array(), false);
		wp_enqueue_style('seine-style', get_template_directory_uri() . '/style.css',  array(), false);
		wp_enqueue_script('seine-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '', true);

		/* Load custom style */
		$custom_style = '';
		$custom_style .= '.test{color: red;}';

		if ($custom_style) {
			wp_add_inline_style('seine-style', $custom_style);
		}

		/* Custom script */
		$custom_script = '';
		if (isset($seine_options['custom_js_code']) && $seine_options['custom_js_code']) {
			$custom_script .= $seine_options['custom_js_code'];
		}
		if ($custom_script) {
			wp_add_inline_script('seine-main', $custom_script);
		}

		/* Options to script */
		$js_options = array(
			'ajax_url' => admin_url('admin-ajax.php'),
			'user_info' => wp_get_current_user(),
		);
		wp_localize_script('seine-main', 'AJ_Options', $js_options);
		wp_enqueue_script('seine-main');
	}
	add_action('wp_enqueue_scripts', 'seine_enqueue_scripts');
}

/* Add Stylesheet And Script Backend */
if (!function_exists('seine_enqueue_admin_scripts')) {
	function seine_enqueue_admin_scripts()
	{
		wp_enqueue_script('seine-admin-main', get_template_directory_uri() . '/assets/js/admin-main.js', array('jquery'), '', true);
		wp_enqueue_style('seine-admin-main', get_template_directory_uri() . '/assets/css/admin-main.css', array(), false);
	}
	add_action('admin_enqueue_scripts', 'seine_enqueue_admin_scripts');
}

/**
 * Theme install
 */
require_once get_template_directory() . '/install/plugin-required.php';
require_once get_template_directory() . '/install/import-pack/import-functions.php';

/* CPT Load */
require_once get_template_directory() . '/framework/cpt-therapist.php';
require_once get_template_directory() . '/framework/cpt-service.php';
require_once get_template_directory() . '/framework/cpt-brand.php';
require_once get_template_directory() . '/framework/cpt-testimonial.php';
require_once get_template_directory() . '/framework/cpt-gallery.php';
/* ACF Options */
require_once get_template_directory() . '/framework/acf-options.php';

/* Shortcodes */
require_once get_template_directory() . '/framework/shortcodes.php';

/* Add Comment Rating */
require_once get_template_directory() . '/framework/comment-rating.php';

/* Template functions */
require_once get_template_directory() . '/framework/template-helper.php';

/* Post Functions */
require_once get_template_directory() . '/framework/templates/post-helper.php';

/* Block Load */
require_once get_template_directory() . '/framework/block-load.php';

/* Widgets Load */
require_once get_template_directory() . '/framework/widget-load.php';

/* Woocommerce functions */
if (class_exists('Woocommerce')) {
	require_once get_template_directory() . '/woocommerce/shop-helper.php';
}

if (function_exists('get_field')) {
	/* Orbit circle effect */
	function seine_body_class($classes)
	{
		$orbit_circle = get_field('effect_orbit_circle', 'options');
		$bg_pattern = get_field('effect_bg_pattern', 'options');
		$bg_buble = get_field('effect_bg_buble', 'options');
		$bg_scroll = get_field('effect_bg_scroll', 'options');
		$img_zoom = get_field('effect_img_zoom', 'options');

		if ($orbit_circle) {
			$classes[] = 'bt-orbit-enable';
		}

		if ($bg_pattern) {
			$classes[] = 'bt-bg-pattern-enable';
		}

		if ($bg_buble) {
			$classes[] = 'bt-bg-buble-enable';
		}

		if ($bg_scroll) {
			$classes[] = 'bt-bg-scroll-enable';
		}

		if ($img_zoom) {
			$classes[] = 'bt-img-zoom-enable';
		}

		return $classes;
	}
	add_filter('body_class', 'seine_body_class');
}

// add js Gform affter Submit
add_action('gform_register_init_scripts', 'bt_custom_gform_init_script', 10, 2);
function bt_custom_gform_init_script($form, $field_values)
{
	$script = "
        function LoadJsAfterSubmit() {
			if (jQuery('.gform_wrapper select').length > 0) {
         	   jQuery('.gform_wrapper select').select2();
			}
			if (jQuery('.gfield_checkbox').length > 0) {
                jQuery('.gfield_checkbox .gchoice').each(function() {
                    jQuery(this).append('<div class=\"checkmark\"></div>');
                });
            }
			if (jQuery('.ginput_container.ginput_container_date').length > 0) {
				var dropdownIcon = '<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"24\" height=\"24\" viewBox=\"0 0 24 24\" fill=\"none\">' +
				'<path d=\"M8 5.75C7.59 5.75 7.25 5.41 7.25 5V2C7.25 1.59 7.59 1.25 8 1.25C8.41 1.25 8.75 1.59 8.75 2V5C8.75 5.41 8.41 5.75 8 5.75Z\" fill=\"white\"/>' +
				'<path d=\"M16 5.75C15.59 5.75 15.25 5.41 15.25 5V2C15.25 1.59 15.59 1.25 16 1.25C16.41 1.25 16.75 1.59 16.75 2V5C16.75 5.41 16.41 5.75 16 5.75Z\" fill=\"white\"/>' +
				'<path d=\"M8.5 14.5001C8.37 14.5001 8.24 14.4701 8.12 14.4201C7.99 14.3701 7.89 14.3001 7.79 14.2101C7.61 14.0201 7.5 13.7701 7.5 13.5001C7.5 13.3701 7.53 13.2401 7.58 13.1201C7.63 13.0001 7.7 12.8901 7.79 12.7901C7.89 12.7001 7.99 12.6301 8.12 12.5801C8.48 12.4301 8.93 12.5101 9.21 12.7901C9.39 12.9801 9.5 13.2401 9.5 13.5001C9.5 13.5601 9.49 13.6301 9.48 13.7001C9.47 13.7601 9.45 13.8201 9.42 13.8801C9.4 13.9401 9.37 14.0001 9.33 14.0601C9.3 14.1101 9.25 14.1601 9.21 14.2101C9.02 14.3901 8.76 14.5001 8.5 14.5001Z\" fill=\"white\"/>' +
				'<path d=\"M12 14.4999C11.87 14.4999 11.74 14.4699 11.62 14.4199C11.49 14.3699 11.39 14.2999 11.29 14.2099C11.11 14.0199 11 13.7699 11 13.4999C11 13.3699 11.03 13.2399 11.08 13.1199C11.13 12.9999 11.2 12.8899 11.29 12.7899C11.39 12.6999 11.49 12.6299 11.62 12.5799C11.98 12.4199 12.43 12.5099 12.71 12.7899C12.89 12.9799 13 13.2399 13 13.4999C13 13.5599 12.99 13.6299 12.98 13.6999C12.97 13.7599 12.95 13.8199 12.92 13.8799C12.9 13.9399 12.87 13.9999 12.83 14.0599C12.8 14.1099 12.75 14.1599 12.71 14.2099C12.52 14.3899 12.26 14.4999 12 14.4999Z\" fill=\"white\"/>' +
				'<path d=\"M15.5 14.4999C15.37 14.4999 15.24 14.4699 15.12 14.4199C14.99 14.3699 14.89 14.2999 14.79 14.2099C14.75 14.1599 14.71 14.1099 14.67 14.0599C14.63 13.9999 14.6 13.9399 14.58 13.8799C14.55 13.8199 14.53 13.7599 14.52 13.6999C14.51 13.6299 14.5 13.5599 14.5 13.4999C14.5 13.2399 14.61 12.9799 14.79 12.7899C14.89 12.6999 14.99 12.6299 15.12 12.5799C15.49 12.4199 15.93 12.5099 16.21 12.7899C16.39 12.9799 16.5 13.2399 16.5 13.4999C16.5 13.5599 16.49 13.6299 16.48 13.6999C16.47 13.7599 16.45 13.8199 16.42 13.8799C16.4 13.9399 16.37 13.9999 16.33 14.0599C16.3 14.1099 16.25 14.1599 16.21 14.2099C16.02 14.3899 15.76 14.4999 15.5 14.4999Z\" fill=\"white\"/>' +
				'<path d=\"M8.5 17.9999C8.37 17.9999 8.24 17.97 8.12 17.92C8 17.87 7.89 17.7999 7.79 17.7099C7.61 17.5199 7.5 17.2599 7.5 16.9999C7.5 16.8699 7.53 16.7399 7.58 16.6199C7.63 16.4899 7.7 16.38 7.79 16.29C8.16 15.92 8.84 15.92 9.21 16.29C9.39 16.48 9.5 16.7399 9.5 16.9999C9.5 17.2599 9.39 17.5199 9.21 17.7099C9.02 17.8899 8.76 17.9999 8.5 17.9999Z\" fill=\"white\"/>' +
				'<path d=\"M12 17.9999C11.74 17.9999 11.48 17.8899 11.29 17.7099C11.11 17.5199 11 17.2599 11 16.9999C11 16.8699 11.03 16.7399 11.08 16.6199C11.13 16.4899 11.2 16.38 11.29 16.29C11.66 15.92 12.34 15.92 12.71 16.29C12.8 16.38 12.87 16.4899 12.92 16.6199C12.97 16.7399 13 16.8699 13 16.9999C13 17.2599 12.89 17.5199 12.71 17.7099C12.52 17.8899 12.26 17.9999 12 17.9999Z\" fill=\"white\"/>' +
				'<path d=\"M15.5 17.9999C15.24 17.9999 14.98 17.8899 14.79 17.7099C14.7 17.6199 14.63 17.5099 14.58 17.3799C14.53 17.2599 14.5 17.1299 14.5 16.9999C14.5 16.8699 14.53 16.7399 14.58 16.6199C14.63 16.4899 14.7 16.3799 14.79 16.2899C15.02 16.0599 15.37 15.9499 15.69 16.0199C15.76 16.0299 15.82 16.0499 15.88 16.0799C15.94 16.0999 16 16.1299 16.06 16.1699C16.11 16.1999 16.16 16.2499 16.21 16.2899C16.39 16.4799 16.5 16.7399 16.5 16.9999C16.5 17.2599 16.39 17.5199 16.21 17.7099C16.02 17.8899 15.76 17.9999 15.5 17.9999Z\" fill=\"white\"/>' +
				'<path d=\"M20.5 9.83984H3.5C3.09 9.83984 2.75 9.49984 2.75 9.08984C2.75 8.67984 3.09 8.33984 3.5 8.33984H20.5C20.91 8.33984 21.25 8.67984 21.25 9.08984C21.25 9.49984 20.91 9.83984 20.5 9.83984Z\" fill=\"white\"/>' +
				'<path d=\"M16 22.75H8C4.35 22.75 2.25 20.65 2.25 17V8.5C2.25 4.85 4.35 2.75 8 2.75H16C19.65 2.75 21.75 4.85 21.75 8.5V17C21.75 20.65 19.65 22.75 16 22.75ZM8 4.25C5.14 4.25 3.75 5.64 3.75 8.5V17C3.75 19.86 5.14 21.25 8 21.25H16C18.86 21.25 20.25 19.86 20.25 17V8.5C20.25 5.64 18.86 4.25 16 4.25H8Z\" fill=\"white\"/>' +
				'</svg>';
				jQuery('.ginput_container.ginput_container_date').append(dropdownIcon);
			}

        }
        LoadJsAfterSubmit(); 
    ";

	// Add the initialization script to Gravity Form
	GFFormDisplay::add_init_script($form['id'], 'bt_custom_gform', GFFormDisplay::ON_PAGE_RENDER, $script);

	// add an AJAX complete
	$complete_script = "
        jQuery(document).ajaxComplete(function(event, xhr, settings) {
            if (settings.url === '" . admin_url('admin-ajax.php') . "') {
                LoadJsAfterSubmit(); 
            }
        });
    ";
	GFFormDisplay::add_init_script($form['id'], 'bt_custom_gform_ajax', GFFormDisplay::ON_PAGE_RENDER, $complete_script);
}
