<?php
/*
Plugin Name: Custom City
Description: Custom city form.
Version: 1.0
Author: Ben Pause
*/

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}


/**
 * The function `custom_city_form_shortcode` displays a city selection form for logged-in users using a
 * shortcode in WordPress.
 */
function custom_city_form_shortcode() {
    if (!is_user_logged_in()) {
        return '<p>' . esc_html__('A város kiválasztásához be kell jelentkezni.', 'custom-city') . '</p>';
    }

    ob_start();
    include plugin_dir_path( __FILE__ ) . 'templates/form.php';
    return ob_get_clean();
}
add_shortcode('custom_city_form', 'custom_city_form_shortcode');


/**
 * The function `custom_city_handle_form` handles form submission to save a selected city for a
 * logged-in user, performing security checks and updating user meta accordingly.
 */
function custom_city_handle_form() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['city']) && $_POST['city'] !="") {

        if (!isset($_POST['custom_city_nonce']) || !wp_verify_nonce($_POST['custom_city_nonce'], 'custom_city_nonce_action')) {
            wp_die(esc_html__('A biztonsági ellenőrzés sikertelen.', 'custom-city'));
        }

        if (!is_user_logged_in()) {
            wp_die(esc_html__('A város mentéséhez be kell jelentkezni.', 'custom-city'));
        }

        $allowed_cities = array('debrecen', 'budapest', 'sopron');
        $city = isset($_POST['city']) ? sanitize_text_field($_POST['city']) : '';

        if (!in_array($city, $allowed_cities)) {
            wp_die(esc_html__('Érvénytelen városválasztás.', 'custom-city'));
        }

        $user_id = get_current_user_id();
        update_user_meta($user_id, 'custom_city', $city);

        wp_redirect(add_query_arg('city_saved', '1', wp_get_referer()));
        exit;
    }
}
add_action('init', 'custom_city_handle_form');

