<?php

/*
  Plugin Name: bulk_post_author_update
  Description: Your Plugin Description Here
  Version: 1.0
  Author: Azizul Raju
  Author URI: https://facebook.com/azizulDev
*/

if (!defined('ABSPATH')) exit; // Exit if accessed directly

add_shortcode('bulk_post_author_update', 'bulk_post_author_update');

function bulk_post_author_update($atts, $content = null)
{

  $atts = shortcode_atts(
    array(
      'per_page' => 100,
      'paged' => 1,

    ),
    $atts
  );

  $per_page = $atts['per_page'];
  $paged = $atts['paged'];

  $query_args = [];
  $query_args['post_type'] = ['post'];
  $query_args['post_status'] = 'publish';
  $query_args['posts_per_page'] = $per_page;
  $query_args['paged'] = $paged;


  $post_grid_wp_query = new WP_Query($query_args);


  if ($post_grid_wp_query->have_posts()) :

    while ($post_grid_wp_query->have_posts()) : $post_grid_wp_query->the_post();
      $post_id = get_the_ID();


      $arg = array(
        'ID' => $post_id,
        'post_author' => 32500,
      );
      wp_update_post($arg);



    endwhile;
  endif;
}
