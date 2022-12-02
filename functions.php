<?php 
function custom_discount_price( $price, $product ) {

    date_default_timezone_set("Asia/Bangkok");
    $todatDate = date('Y-m-d');
    $todatDate=date('Y-m-d', strtotime($todatDate));
    $contractDateBegin = date('Y-m-d', strtotime(get_field('date-discount','option')));
    $contractDateEnd = date('Y-m-d', strtotime(get_field('date-discount_end','option')));
  
    // if ( is_user_logged_in() ) {
        $turn_discount = get_field('turn_discount', 'option');
        $discount_rate = get_field('percent_discount', 'option')/100; // 10% of discount
        if (!empty($turn_discount)) {
          if (($todatDate >= $contractDateBegin) && ($todatDate <= $contractDateEnd)){
            $product_discounted = get_field('product_discount', 'option');
  
            foreach( $product_discounted as $product_discount ){
  
              if ( $product->get_id() == $product_discount->ID) {
  
                  $regular_price = $product->get_regular_price();
  
                return min( $price, $regular_price - ( $regular_price * $discount_rate ) );
              } //check product
  
            } //foreach
  
          } // check date
        }// check enable
  
    // }
      return $price;
  }
  ?>