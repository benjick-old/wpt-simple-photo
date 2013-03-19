<?php

function load_scripts() {
    wp_enqueue_script( 'mousewheel',get_template_directory_uri() . '/js/jquery.mousewheel.min.js', array( 'jquery' ) );
}

add_action( 'wp_enqueue_scripts', 'load_scripts' );