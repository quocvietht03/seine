<?php
// WooCommerce custom hooks
add_action('seine_woocommerce_template_loop_product_link_open', 'woocommerce_template_loop_product_link_open', 10);
add_action('seine_woocommerce_template_loop_product_link_close', 'woocommerce_template_loop_product_link_close', 5);
add_action('seine_woocommerce_show_product_loop_sale_flash', 'woocommerce_show_product_loop_sale_flash', 10);
add_action('seine_woocommerce_template_loop_product_thumbnail', 'woocommerce_template_loop_product_thumbnail', 10);
add_action('seine_woocommerce_template_loop_product_title', 'woocommerce_template_loop_product_title', 10);
add_action('seine_woocommerce_template_loop_rating', 'woocommerce_template_loop_rating', 5);
add_action('seine_woocommerce_template_loop_price', 'woocommerce_template_loop_price', 10);
add_action('seine_woocommerce_template_loop_add_to_cart', 'woocommerce_template_loop_add_to_cart', 10);

add_action('seine_woocommerce_template_single_title', 'woocommerce_template_single_title', 5);
add_action('seine_woocommerce_template_single_rating', 'woocommerce_template_single_rating', 10);
add_action('seine_woocommerce_template_single_price', 'woocommerce_template_single_price', 10);
add_action('seine_woocommerce_template_single_excerpt', 'woocommerce_template_single_excerpt', 20);
add_action('seine_woocommerce_template_single_add_to_cart', 'woocommerce_template_single_add_to_cart', 30);
add_action('seine_woocommerce_template_single_meta', 'woocommerce_template_single_meta', 40);
add_action('seine_woocommerce_template_single_sharing', 'woocommerce_template_single_sharing', 50);


add_action('seine_woocommerce_shop_loop_item_subtitle', 'seine_woocommerce_template_loop_subtitle', 10, 2);

if (function_exists('get_field')) {
  $enable_related_posts = get_field('enable_related_posts', 'options');
  if (!$enable_related_posts) {
    remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20);
  }
}
function seine_woocommerce_template_loop_subtitle()
{
  $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);

  if (!empty($subtitle)) {
    echo '<span class="woocommerce-loop-product__subtitle">' . $subtitle . '</span>';
  }

  return;
}

add_action('woocommerce_single_product_summary', 'seine_woocommerce_template_single_subtitle', 3);
function seine_woocommerce_template_single_subtitle()
{
  $subtitle = get_post_meta(get_the_ID(), '_subtitle', true);

  if (!empty($subtitle)) {
    echo '<span class="woocommerce-product-subtitle">' . $subtitle . '</span>';
  }

  return;
}

// WooCommerce percentage flash
add_filter('woocommerce_sale_flash', 'seine_woocommerce_percentage_sale', 10, 3);
function seine_woocommerce_percentage_sale($html, $post, $product)
{
  if ($product->is_type('variable')) {
    $percentages = array();

    // Get all variation prices
    $prices = $product->get_variation_prices();

    // Loop through variation prices
    foreach ($prices['price'] as $key => $price) {
      // Only on sale variations
      if ($prices['regular_price'][$key] !== $price) {
        // Calculate and set in the array the percentage for each variation on sale
        $percentages[] = round(100 - ($prices['sale_price'][$key] / $prices['regular_price'][$key] * 100));
      }
    }
    // We keep the highest value
    $percentage = max($percentages) . '%';
  } elseif ($product->is_type('grouped')) {
    $percentages = array();

    foreach ($product->get_children() as $child_id) {
      $child = wc_get_product($child_id);
      if (!empty($child->get_sale_price())) {
        $regular_price = $child->get_regular_price();
        $sale_price = $child->get_sale_price();
        $percentages[] = round(100 - ($sale_price / $regular_price * 100));
      }
    }

    $percentage = max($percentages) . '%';
  } else {
    $regular_price = (float) $product->get_regular_price();
    $sale_price = (float) $product->get_sale_price();

    $percentage = round(100 - ($sale_price / $regular_price * 100)) . '%';
  }

  return '<span class="onsale">' . $percentage . '</span>';
}

add_filter('woocommerce_pagination_args', 'seine_woocommerce_pagination_args');
function seine_woocommerce_pagination_args()
{
  $total   = isset($total) ? $total : wc_get_loop_prop('total_pages');
  $current = isset($current) ? $current : wc_get_loop_prop('current_page');
  $base    = isset($base) ? $base : esc_url_raw(str_replace(999999999, '%#%', remove_query_arg('add-to-cart', get_pagenum_link(999999999, false))));
  $format  = isset($format) ? $format : '';

  if ($total <= 1) {
    return;
  }

  return array(
    'base'     => $base,
    'format'   => $format,
    'total'    => $total,
    'current'  => $current,
    'mid_size' => 1,
    'add_args' => false,
    'prev_text' => '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                      <path d="M9.71889 15.782L10.4536 15.0749C10.6275 14.9076 10.6275 14.6362 10.4536 14.4688L4.69684 8.92851L17.3672 8.92852C17.6131 8.92852 17.8125 8.73662 17.8125 8.49994L17.8125 7.49994C17.8125 7.26326 17.6131 7.07137 17.3672 7.07137L4.69684 7.07137L10.4536 1.53101C10.6275 1.36366 10.6275 1.0923 10.4536 0.924907L9.71889 0.2178C9.545 0.0504438 9.26304 0.0504438 9.08911 0.2178L1.31792 7.69691C1.14403 7.86426 1.14403 8.13562 1.31792 8.30301L9.08914 15.782C9.26304 15.9494 9.545 15.9494 9.71889 15.782Z"/>
                    </svg> ' . esc_html__('Prev', 'seine'),
    'next_text' => esc_html__('Next', 'seine') . '<svg width="19" height="16" viewBox="0 0 19 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path d="M9.28111 0.217951L8.54638 0.925058C8.37249 1.09242 8.37249 1.36377 8.54638 1.53117L14.3032 7.07149L1.63283 7.07149C1.38691 7.07149 1.18752 7.26338 1.18752 7.50006L1.18752 8.50006C1.18752 8.73674 1.38691 8.92863 1.63283 8.92863L14.3032 8.92863L8.54638 14.469C8.37249 14.6363 8.37249 14.9077 8.54638 15.0751L9.28111 15.7822C9.455 15.9496 9.73696 15.9496 9.91089 15.7822L17.6821 8.30309C17.856 8.13574 17.856 7.86438 17.6821 7.69699L9.91086 0.217952C9.73696 0.0505587 9.455 0.0505586 9.28111 0.217951Z"/>
                  </svg>',
  );
}

// WooCommerce availability
add_filter('woocommerce_get_availability', 'seine_woocommerce_show_in_stock', 10, 2);
function seine_woocommerce_show_in_stock($availability, $product)
{
  if (!$product->managing_stock() && $product->is_in_stock()) {
    $availability['availability'] = __('In Stock', 'seine');
  }

  $availability['availability'] = __('Availability: ', 'seine') . '<span>' . $availability['availability'] . '</span>';

  return $availability;
}

// WooCommerce ralated params
add_filter('woocommerce_output_related_products_args', 'seine_woocommerce_related_products_args', 20);
function seine_woocommerce_related_products_args($args)
{
  if (function_exists('get_field')) {
    $related_posts = get_field('product_related_posts', 'options');
    $args['posts_per_page'] = !empty($related_posts['number_posts']) ? $related_posts['number_posts'] : 4;
  } else {
    $args['posts_per_page'] = 4;
  }

  $args['columns'] = 4;

  return $args;
}

// WooCommerce custom field
add_action('woocommerce_product_options_general_product_data', 'seine_woocommerce_custom_field');
function seine_woocommerce_custom_field()
{
  global $post;

  woocommerce_wp_text_input(
    array(
      'id'          => '_subtitle',
      'label'       => __('Subtitle', 'seine'),
      'description' => ''
    )
  );
}

add_action('woocommerce_process_product_meta', 'seine_woocommerce_custom_field_save');
function seine_woocommerce_custom_field_save($post_id)
{
  $subtitle = $_POST['_subtitle'];
  if (!empty($subtitle)) {
    update_post_meta($post_id, '_subtitle', esc_attr($subtitle));
  } else {
    update_post_meta($post_id, '_subtitle', '');
  }
}
/* Sold Product */
function seine_woocommerce_item_sold($product_id)
{
  $args = array(
    'status' => 'completed',
    'limit'  => -1,
  );
  $orders = wc_get_orders($args);

  $total_quantity_sold = 0;
  if (!empty($orders)) {
    foreach ($orders as $order) {
      foreach ($order->get_items() as $item) {
        if ($item->get_product_id() == $product_id) {
          $total_quantity_sold += $item->get_quantity();
        }
      }
    }
  }
  echo '<div class="woocommerce-loop-product__sold">';
  echo $total_quantity_sold . ' ' . esc_html__('Item Sold', 'seine');
  echo '</div>';
}
add_action('seine_woocommerce_shop_loop_item_sold', 'seine_woocommerce_item_sold', 10, 2);
/* Add Sold Product affer Quanty Single Product */
function seine_display_sold_after_quantity()
{
  global $product;
  seine_woocommerce_item_sold($product->get_id());
}
add_action('woocommerce_after_add_to_cart_quantity', 'seine_display_sold_after_quantity');

/* Remove the additional information tab */
add_filter('woocommerce_product_tabs', 'seine_woocommerce_remove_additional_information_tabs', 98);

function seine_woocommerce_remove_additional_information_tabs($tabs)
{
  unset($tabs['additional_information']);
  return $tabs;
}
/* Add additional information to the bottom of the description */
add_filter('the_content', 'seine_woocommerce_add_additional_information');
function seine_woocommerce_add_additional_information($content)
{
  global $product;
  if (is_product()) {
    ob_start();
    do_action('woocommerce_product_additional_information', $product);
    $additional_info_content = ob_get_clean();
    $content .= '<h3>' . esc_html__('Additional Information:', 'seine') . '</h3>' . $additional_info_content;
  }
  return $content;
}
/* Custom the "Description" title */
add_filter('woocommerce_product_description_heading', 'seine_woocommerce_custom_description_heading');
function seine_woocommerce_custom_description_heading()
{
  return esc_html__('Key Ingredient:', 'seine');
}
/* Custom the "Review" tab title */
add_filter('woocommerce_product_tabs', 'seine_woocommerce_custom_reviews_tab_title');
function seine_woocommerce_custom_reviews_tab_title($tabs)
{
  if (isset($tabs['reviews'])) {
    global $product;
    $review_count = $product->get_review_count();
    $tabs['reviews']['title'] = sprintf(__('Reviews <span>%d</span>', 'seine'), $review_count);
  }
  return $tabs;
}
