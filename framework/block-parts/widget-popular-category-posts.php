<?php

/**
 * Block Name: Widget - Popular Category Posts
 **/
$number_category = get_field('number_category');
$popular_categories = get_field('popular_category');
?>
<div id="<?php echo 'bt_block--' . $block['id']; ?>" class="widget widget-block bt-block-popular-category-posts">
  <ul class="bt-popular-category-posts">
    <?php
    if ($popular_categories) {
      $count = 0;
      foreach ($popular_categories as $popular_category) {
        if ($count >= $number_category) {
          break;
        }
        echo '<li class="bt-popular-category-posts--item"><a href="' . get_category_link($popular_category->term_id) . '">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.3333 9.95843C18.3333 10.4584 18.0833 10.9584 17.6666 11.2917L11.1667 16.3751C11 16.5418 10.8334 16.6251 10.6667 16.6251C10.25 16.6251 9.91668 16.2918 9.83336 15.8751L9.58336 13.2084C9.58336 12.7917 9.25004 12.5417 8.83336 12.4584L3.41668 11.8751C3.16668 11.8751 3.08336 11.8751 3 11.7918C2.25 11.6251 1.66668 11.0418 1.66668 10.2918V9.87511V9.45843C1.75 8.70843 2.25 8.12511 3 7.95843C3.08332 7.95843 3.16668 7.95843 3.41668 7.87511L8.83336 7.29179C9.25004 7.29179 9.50004 6.95847 9.58336 6.54179L9.83336 3.87511C9.91668 3.45843 10.25 3.12511 10.6667 3.12511C10.8334 3.12511 11 3.20843 11.1667 3.29179L17.6667 8.37511C18.0833 8.95843 18.3333 9.45843 18.3333 9.95843ZM18.6667 12.6251C19.5 11.9584 20 10.9584 20 9.95843C20 8.87511 19.5 7.95843 18.6667 7.29175L12.1667 2.20843C11.75 1.87511 11.1667 1.70843 10.5834 1.70843C9.33336 1.70843 8.25004 2.70843 8.08336 3.95843L7.91668 5.95843L3.16668 6.45843C3 6.45843 2.83336 6.45843 2.66668 6.54175C1.16668 6.79175 0.0833588 8.04175 0 9.54175C0 9.70843 0 9.79175 0 10.0417V9.95843C0 10.1251 0 10.2917 0 10.4584C0.0833206 11.9584 1.25 13.2084 2.66668 13.4584C2.83336 13.4584 2.91668 13.4584 3.16668 13.5417L7.91668 14.0417L8.08336 16.0417C8.33336 17.2917 9.41668 18.2917 10.6667 18.2917C11.25 18.2918 11.75 18.1251 12.25 17.7918L18.6667 12.6251Z" fill="#E96CA7"/></svg>';
        echo $popular_category->name . '</a></li>';
        $count++;
      }
    } else {
      $args = array(
        'number' => $number_category,
      );
      $all_categories = get_categories($args);

      foreach ($all_categories as $category) {
        echo '<li class="bt-popular-category-posts--item"><a href="' . get_category_link($category->term_id) . '">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none"><path fill-rule="evenodd" clip-rule="evenodd" d="M18.3333 9.95843C18.3333 10.4584 18.0833 10.9584 17.6666 11.2917L11.1667 16.3751C11 16.5418 10.8334 16.6251 10.6667 16.6251C10.25 16.6251 9.91668 16.2918 9.83336 15.8751L9.58336 13.2084C9.58336 12.7917 9.25004 12.5417 8.83336 12.4584L3.41668 11.8751C3.16668 11.8751 3.08336 11.8751 3 11.7918C2.25 11.6251 1.66668 11.0418 1.66668 10.2918V9.87511V9.45843C1.75 8.70843 2.25 8.12511 3 7.95843C3.08332 7.95843 3.16668 7.95843 3.41668 7.87511L8.83336 7.29179C9.25004 7.29179 9.50004 6.95847 9.58336 6.54179L9.83336 3.87511C9.91668 3.45843 10.25 3.12511 10.6667 3.12511C10.8334 3.12511 11 3.20843 11.1667 3.29179L17.6667 8.37511C18.0833 8.95843 18.3333 9.45843 18.3333 9.95843ZM18.6667 12.6251C19.5 11.9584 20 10.9584 20 9.95843C20 8.87511 19.5 7.95843 18.6667 7.29175L12.1667 2.20843C11.75 1.87511 11.1667 1.70843 10.5834 1.70843C9.33336 1.70843 8.25004 2.70843 8.08336 3.95843L7.91668 5.95843L3.16668 6.45843C3 6.45843 2.83336 6.45843 2.66668 6.54175C1.16668 6.79175 0.0833588 8.04175 0 9.54175C0 9.70843 0 9.79175 0 10.0417V9.95843C0 10.1251 0 10.2917 0 10.4584C0.0833206 11.9584 1.25 13.2084 2.66668 13.4584C2.83336 13.4584 2.91668 13.4584 3.16668 13.5417L7.91668 14.0417L8.08336 16.0417C8.33336 17.2917 9.41668 18.2917 10.6667 18.2917C11.25 18.2918 11.75 18.1251 12.25 17.7918L18.6667 12.6251Z" fill="#E96CA7"/></svg>';
        echo $category->name . '</a></li>';
      }
    }
    ?>
  </ul>
</div>