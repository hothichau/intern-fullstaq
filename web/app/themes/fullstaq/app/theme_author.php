<?php
namespace App;

/**
 * Change login header text to project name
 */
add_filter( 'login_headertext', function () {
    return get_bloginfo('name');
});

/**
 * Change login header url
 */
add_filter( 'login_headerurl', function ($url) {
    return 'https://simplefly.nl/';
});

add_action( 'login_enqueue_scripts', function () {
    wp_enqueue_style( 'admin-login', get_template_directory_uri() . '/assets/styles/admin-login.css', array(), false );
});

add_action('login_footer', function () {
    echo '<div class="custom-footer-link">
        <ul>
            <li><a href="https://www.simplefly.nl/helpdesk/" target="_blank">Helpdesk</a></li>
            <li><a href="https://www.simplefly.nl/contact/" target="_blank">Contact</a></li>
            <li><a href="https://www.simplefly.nl" target="_blank">Simplefly</a></li>
        </ul>
    </div>';
});
