<?php

/**
 * WP Songbook base - adds custom post types according to options ("song" CPT is added always)
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */

class songbook_customtypes extends songbook_functions {
    
    /**
     *
     * @var array   array of the plugin's registered post types
     */
    public $post_types;

    function __construct() {
        
        $this->post_types = $this->option('cpt');
        $this->post_types = (is_array($this->post_types)) ? $this->post_types : array();
        
        add_action('init', array($this, 'addcpts'));

        add_action('admin_menu', array($this, 'cptremoveboxes'));
    }
    
    function addcpts(){
        $this->cpt_songs();
        if ($this->option('enable_playlists') === 'enable')
            $this->cpt_playlists();
        flush_rewrite_rules();
    }

    /**
     * Adds custom post type Song
     */
    
    function cpt_songs() {
        $args = array(
            'labels' => array(
                'name' => __('Songs', 'wp-songbook'),
                'singular_name' => __('Song', 'wp-songbook'),
                'add_new' => __('Add new', 'wp-songbook'),
                'add_new_item' => __('Add new song', 'wp-songbook'),
                'edit_item' => __('Edit song', 'wp-songbook'),
                'new_item' => __('New song', 'wp-songbook'),
                'all_items' => __('All songs', 'wp-songbook'),
                'view_item' => __('View song', 'wp-songbook'),
                'search_items' => __('Search songs', 'wp-songbook'),
                'not_found' => __('No song found', 'wp-songbook'),
                'not_found_in_trash' => __('No song found in trash', 'wp-songbook'),
                'parent_item_colon' => '',
                'menu_name' => __('Songs', 'wp-songbook')
            ),
            'public' => true,
            'menu_position' => 5,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_admin_bar' => true,
            'capability_type' => $this->option('mincap_cpt_display'),
            'query_var' => true,
            'rewrite' => array('slug' => 'song'),
            'capability_type' => 'post',
            'menu_icon' => (get_bloginfo('version') < 3.8) ? plugins_url('../files/img/menu_black.png', __FILE__) : plugins_url('../files/img/icon.svg', __FILE__),
            'has_archive' => false,
            'hierarchical' => false,
            'menu_position' => 10,
            'supports' => array('title', 'editor', 'thumbnail', ($this->option('enable_comments') === 'enable') ? 'comments' : false)
        );
        
        $pt = 'song';
        register_post_type($pt, $args);
        if ( !in_array( $pt, $this->post_types ) ) $this->option('cpt', 'save', array_push($this->post_types, $pt));
    }

    /**
     * Adds custom post playlist that allows using custom ordered lists of songs
     */
    
    function cpt_playlists() {
        $args = array(
            'labels' => array(
                'name' => __('Playlists', 'wp-songbook'),
                'singular_name' => __('Playlist', 'wp-songbook'),
                'add_new' => __('Add new', 'wp-songbook'),
                'add_new_item' => __('Add new playlist', 'wp-songbook'),
                'edit_item' => __('Edit playlist', 'wp-songbook'),
                'new_item' => __('New playlist', 'wp-songbook'),
                'all_items' => __('Playlists', 'wp-songbook'),
                'view_item' => __('View playlist', 'wp-songbook'),
                'search_items' => __('Search playlists', 'wp-songbook'),
                'not_found' => __('No playlist found', 'wp-songbook'),
                'not_found_in_trash' => __('No playlist found in trash', 'wp-songbook'),
                'parent_item_colon' => '',
                'menu_name' => __('Playlists', 'wp-songbook')
            ),
            'public' => true,
            'menu_position' => 5,
            'publicly_queryable' => true,
            'show_ui' => true,
            'show_in_menu' => 'edit.php?post_type=song',
            'show_in_admin_bar' => true,
            'query_var' => true,
            'rewrite' => array('slug' => 'song'),
            'capability_type' => 'post',
            'menu_icon' => (get_bloginfo('version') < 3.8) ? plugins_url('../files/img/menu_black.png', __FILE__) : plugins_url('../files/img/menu_white.png', __FILE__),
            'has_archive' => true,
            'hierarchical' => false,
            'menu_position' => 10,
            'supports' => array('title',($this->option('enable_comments') === 'enable') ? 'comments' : false)
        );
        
        $pt = 'playlist';
        register_post_type($pt, $args);
        if ( !in_array( $pt, $this->post_types ) ) $this->option('cpt', 'save', array_push($this->option('cpt'), $pt));
        
    }
    
    /**
     * Removes unnecessary and disturbing meta boxes from these post types
     */

    function cptremoveboxes() {
        remove_meta_box('postexcerpt', 'song', 'normal'); //removes post excerpt field for songs
        remove_meta_box('postimagediv', 'song', 'normal'); //removes featured images
        remove_meta_box('authordiv', 'song', 'normal'); //removes author
        
        if ($this->option('enable_playlists') === 'enable'){
            remove_meta_box('authordiv', 'playlist', 'normal'); //removes author
            remove_meta_box('postexcerpt', 'playlist', 'normal'); //removes post excerpt field from playlists
            remove_meta_box('postimagediv', 'playlist', 'normal'); //removes featured images
        }
    }

}

$wpsb_cpt_song = new songbook_customtypes();
