<div class="bt-car-sidebar">
  <form class="bt-car-filter-form" action="" method="get">
    <div class="bt-car-filter-fields">
      <!--Sort order-->
      <input type="hidden" class="bt-car-sort-order" name="sort_order" value="<?php if(isset($_GET['sort_order'])) echo $_GET['sort_order']; ?>">

      <!--View type-->
      <input type="hidden" class="bt-car-view-type" name="view_type" value="<?php if(isset($_GET['view_type'])) echo $_GET['view_type']; ?>">

      <!--View current page-->
      <input type="hidden" class="bt-car-current-page" name="current_page" value="<?php echo isset($_GET['current_page']) ? $_GET['current_page'] : ''; ?>">

      <!--Car Dealer-->
      <input type="hidden" class="bt-car-dealer" name="car_dealer" value="<?php if(isset($_GET['car_dealer'])) echo $_GET['car_dealer']; ?>">

      <div class="bt-form-field bt-field-type-search">
        <input type="text" name="search_keyword" value="<?php if(isset($_GET['search_keyword'])) echo $_GET['search_keyword']; ?>" placeholder="<?php esc_html_e('Search …', 'seine'); ?>">
        <a href="#">
          <svg xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" width="512" height="512" x="0" y="0" viewBox="0 0 6.35 6.35" fill="currentColor">
            <path d="M2.894.511a2.384 2.384 0 0 0-2.38 2.38 2.386 2.386 0 0 0 2.38 2.384c.56 0 1.076-.197 1.484-.523l.991.991a.265.265 0 0 0 .375-.374l-.991-.992a2.37 2.37 0 0 0 .523-1.485C5.276 1.58 4.206.51 2.894.51zm0 .53c1.026 0 1.852.825 1.852 1.85S3.92 4.746 2.894 4.746s-1.851-.827-1.851-1.853.825-1.852 1.851-1.852z"></path>
          </svg>
        </a>
      </div>

      <?php
        // $field_title = __('Filter by Year', 'seine');
        // $field_min_value = (isset($_GET['car_year_min'])) ? $_GET['car_year_min'] : '';
        // $field_max_value = (isset($_GET['car_year_max'])) ? $_GET['car_year_max'] : '';
        // seine_cars_field_slider_html('car_year', $field_title, $field_min_value, $field_max_value);

        $field_title = __('Year', 'seine');
        $field_value = (isset($_GET['car_year'])) ? $_GET['car_year'] : '';
        seine_cars_field_select_number_html('car_year', $field_title, $field_value);

        // $field_title = __('Filter by Price ($)', 'seine');
        // $field_min_value = (isset($_GET['car_price_min'])) ? $_GET['car_price_min'] : '';
        // $field_max_value = (isset($_GET['car_price_max'])) ? $_GET['car_price_max'] : '';
        // seine_cars_field_slider_html('car_price', $field_title, $field_min_value, $field_max_value);

        $field_title = __('Price ($)', 'seine');
        $field_value = (isset($_GET['car_price'])) ? $_GET['car_price'] : '';
        $field_step = 1000;
        seine_cars_field_select_range_html('car_price', $field_title, $field_value, $field_step);

        // $field_title = __('Filter by Mileage (km)', 'seine');
        // $field_min_value = (isset($_GET['car_mileage_min'])) ? $_GET['car_mileage_min'] : '';
        // $field_max_value = (isset($_GET['car_mileage_max'])) ? $_GET['car_mileage_max'] : '';
        // seine_cars_field_slider_html('car_mileage', $field_title, $field_min_value, $field_max_value);

        $field_title = __('Mileage (km)', 'seine');
        $field_value = (isset($_GET['car_mileage'])) ? $_GET['car_mileage'] : '';
        $field_step = 10;
        seine_cars_field_select_range_html('car_mileage', $field_title, $field_value, $field_step);

        $field_name = __('Condition', 'seine');
        $field_value = (isset($_GET['car_condition'])) ? $_GET['car_condition'] : '';
        seine_cars_field_select_html('car_condition', $field_name, $field_value);

        $field_title = __('Body', 'seine');
        $field_value = (isset($_GET['car_body'])) ? $_GET['car_body'] : '';
        seine_cars_field_multiple_html('car_body', $field_title, $field_value);

        $field_name = __('Make', 'seine');
        $field_value = (isset($_GET['car_make'])) ? $_GET['car_make'] : '';
        seine_cars_field_select_html('car_make', $field_name, $field_value);

        $field_name = __('Model', 'seine');
        $field_value = (isset($_GET['car_model'])) ? $_GET['car_model'] : '';
        seine_cars_field_select_html('car_model', $field_name, $field_value);

        $field_name = __('Fuel Type', 'seine');
        $field_value = (isset($_GET['car_fuel_type'])) ? $_GET['car_fuel_type'] : '';
        seine_cars_field_select_html('car_fuel_type', $field_name, $field_value);

        $field_name = __('Transmission', 'seine');
        $field_value = (isset($_GET['car_transmission'])) ? $_GET['car_transmission'] : '';
        seine_cars_field_select_html('car_transmission', $field_name, $field_value);

        $field_name = __('Number of Doors', 'seine');
        $field_value = (isset($_GET['car_door'])) ? $_GET['car_door'] : '';
        seine_cars_field_select_html('car_door', $field_name, $field_value);

        $field_name = __('Engine', 'seine');
        $field_value = (isset($_GET['car_engine'])) ? $_GET['car_engine'] : '';
        seine_cars_field_select_html('car_engine', $field_name, $field_value);

        $field_name = __('Body Color', 'seine');
        $field_value = (isset($_GET['car_color'])) ? $_GET['car_color'] : '';
        seine_cars_field_multiple_html('car_color', $field_name, $field_value);

        $field_title = __('Category', 'seine');
        $field_value = (isset($_GET['car_categories'])) ? $_GET['car_categories'] : '';
        seine_cars_field_multiple_html('car_categories', $field_title, $field_value);

      ?>
      <div class="bt-form-action">
        <a href="#" class="bt-reset-btn disable">
          <?php echo esc_html__('Reset All', 'seine'); ?>
        </a>
      </div>
    </div>
  </form>
</div>

<div class="bt-sidebar-overlay"></div>
