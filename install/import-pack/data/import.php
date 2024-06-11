<?php
/**
 * Import pack data package demo
 *
 */
$plugin_includes = array(
  array(
    'name'     => __( 'Elementor Website Builder', 'seine' ),
    'slug'     => 'elementor',
  ),
  array(
    'name'     => __( 'Elementor Pro', 'seine' ),
    'slug'     => 'elementor-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'elementor-pro.zip',
  ),
  array(
    'name'     => __( 'Advanced Custom Fields PRO', 'seine' ),
    'slug'     => 'advanced-custom-fields-pro',
    'source'   => IMPORT_REMOTE_SERVER_PLUGIN_DOWNLOAD . 'advanced-custom-fields-pro.zip',
  ),
  array(
    'name'     => __( 'Newsletter', 'seine' ),
    'slug'     => 'newsletter',
  ),
  array(
    'name'     => __( 'WooCommerce', 'seine' ),
    'slug'     => 'woocommerce',
  ),

);

return apply_filters( 'seine/import_pack/package_demo', [
    [
        'package_name' => 'seine-main',
        'preview' => get_template_directory_uri() . '/screenshot.jpg',
        'url_demo' => 'https://seine.beplusthemes.com/',
        'title' => __( 'Seine Demo', 'seine' ),
        'description' => __( 'Seine main demo.', 'seine' ),
        'plugins' => $plugin_includes,
    ],
] );
