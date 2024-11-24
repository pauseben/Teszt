<?php
/*
Plugin Name: Custom Post Type
Description: Custom post-type.
Version: 1.0
Author: Ben Pause
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

/**
 * The function `create_blog_post_type` registers a custom post type for blogs in WordPress with
 * specific labels, settings, and support features.
 */
function create_blog_post_type() {
    $labels = array(
        'name'               => __( 'Blogok', 'pause' ),
        'singular_name'      => __( 'Blog', 'pause' ),
        'menu_name'          => __( 'Blogok', 'pause' ),
        'add_new'            => __( 'Új blog hozzáadása', 'pause' ),
        'add_new_item'       => __( 'Új blog hozzáadása', 'pause' ),
        'edit_item'          => __( 'Blog szerkesztése', 'pause' ),
        'new_item'           => __( 'Új blog', 'pause' ),
        'view_item'          => __( 'Blog megtekintése', 'pause' ),
        'search_items'       => __( 'Blogok keresése', 'pause' ),
        'not_found'          => __( 'Nincs találat', 'pause' ),
        'not_found_in_trash' => __( 'Nincs találat a kukában', 'pause' ),
        'all_items'          => __( 'Összes blog', 'pause' ),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'has_archive'        => true,
        'rewrite'            => array( 'slug' => 'blog' ),
        'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
        'show_in_rest'       => false, 
        'menu_icon'          => 'dashicons-edit', 
    );

    register_post_type( 'blog', $args );
}
add_action( 'init', 'create_blog_post_type' );

/**
 * The function `custom_post_type_enqueue_styles` enqueues a custom post type style CSS file in
 * WordPress.
 */

 function custom_post_type_enqueue_styles() {
    wp_enqueue_style( 'custom-post-type-style', plugin_dir_url( __FILE__ ) . 'assets/css/style.css', array(), '1.0' );

}
add_action( 'wp_enqueue_scripts', 'custom_post_type_enqueue_styles' );

/**
 * The function `custom_post_type_enqueue_scripts` is used to enqueue a custom JavaScript file named
 * `script.js` with jQuery as a dependency on WordPress frontend.
 */
function custom_post_type_enqueue_scripts() {
    wp_enqueue_script( 'custom-post-type-script', plugin_dir_url( __FILE__ ) . 'assets/js/script.js', array( 'jquery' ), '1.0', true );
    wp_localize_script( 'custom-post-type-script', 'blogData', array(
        'deleteConfirmation' => __( 'Biztosan törölni szeretnéd ezt a bejegyzést?', 'pause' ),
    ) );
}
add_action( 'wp_enqueue_scripts', 'custom_post_type_enqueue_scripts' );


/**
 * The function `display_blog_posts` includes and returns the content of the 'blog-list.php' template
 * file when the shortcode 'blog_list' is used.
 */
function display_blog_posts() {
    ob_start();
    include plugin_dir_path( __FILE__ ) . 'templates/blog-list.php';
    return ob_get_clean();
}
add_shortcode( 'blog_list', 'display_blog_posts' );


/**
 * The function `handle_blog_post_deletion` is triggered on page load, checks if a blog post deletion
 * request is valid, deletes the post, sends an email notification to the admin, and redirects back to
 * the page with a success message.
 */
function handle_blog_post_deletion() {
    if ( isset( $_POST['delete_post_id'] ) && $_POST['delete_post_id'] != "") {

        if ( ! current_user_can( 'delete_posts' ) ) {
            wp_die( __( 'Nincs jogosultságod a bejegyzés törlésére.', 'pause' ) );
        }

        if ( ! isset( $_POST['_wpnonce'] ) || ! wp_verify_nonce( $_POST['_wpnonce'], 'delete_blog_post' ) ) {
            wp_die( __( 'Érvénytelen kérés.', 'pause' ) );
        }

        $post_id = intval( $_POST['delete_post_id'] );

        if ( get_post_type( $post_id ) === 'blog' ) {
            $post_title = get_the_title( $post_id );
            $post_author_id = get_post_field( 'post_author', $post_id );
            $post_author = get_the_author_meta( 'display_name', $post_author_id );

            wp_trash_post( $post_id ); 


            $admin_email = get_option( 'admin_email' ); 
            $subject = sprintf( __( 'Blog bejegyzés törölve: %s', 'pause' ), $post_title );
            $message = sprintf(
                __( "Egy blog bejegyzést töröltek.\n\nBejegyzés címe: %s\nSzerző: %s", 'pause' ),
                $post_title,
                $post_author
            );

            wp_mail( $admin_email, $subject, $message );

            wp_redirect( esc_url( add_query_arg( 'deleted', 'true', $_SERVER['REQUEST_URI'] ) ) );
            exit;
        } else {
            wp_die( __( 'Érvénytelen bejegyzés.', 'pause' ) );
        }
    }
}
add_action( 'init', 'handle_blog_post_deletion' );

