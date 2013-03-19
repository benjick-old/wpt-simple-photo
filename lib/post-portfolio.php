<?php
/* */

add_action( 'init', 'post_portfolio' );
function post_portfolio() {

    $labels = array(
        'name'                => _x( 'Portfolio Categories', 'taxonomy general name' ),
        'singular_name'       => _x( 'Portfolio Category', 'taxonomy singular name' ),
        'menu_name'           => __( 'Portfolio Categories' )
    );
    register_taxonomy('portfolio_cat','portfolio', array(
        'hierarchical' => true,
        'show_ui' => true,
        'query_var' => true,
        'labels' => $labels,
    )); // add unique categories to portfolio section

    register_post_type( 'portfolio',
        array(
            'labels' => array(
                'name' => __( 'Portfolio' ),
                'singular_name' => __( 'Portfolio' )
            ),
            'public' => true,
            'has_archive' => true,
            'supports' => array( 'title', 'editor', 'thumbnail' ),
        )
    );
}

add_image_size( 'portfolio-feat', 9999999999, 900 );