<?php

/**
 * Songbook taxonomies class
 *
 * Adds custom song taxonomies to post type song
 * Constructor enables or disables taxonomy according to plugin options set in Songbook settings
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */

class songbook_taxonomies extends songbook_functions {

    function __construct() {
        if ($this->option('enable_authorstax') === 'enable')
            add_action('init', array($this, 'authors'));
        if ($this->option('enable_genrestax') === 'enable')
            add_action('init', array($this, 'genres'));
        if ($this->option('enable_albumstax') === 'enable')
            add_action('init', array($this, 'albums'));
        if ($this->option('enable_langstax') === 'enable')
            add_action('init', array($this, 'langs'));
    }

    function authors() {
        $labels = array(
            'name' => __('Authors', 'wp-songbook'),
            'singular_name' => __('Author', 'wp-songbook'),
            'search_items' => __('Search authors', 'wp-songbook'),
            'popular_items' => __('Popular authors', 'wp-songbook'),
            'all_items' => __('All authors', 'wp-songbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit author', 'wp-songbook'),
            'update_item' => __('Update author', 'wp-songbook'),
            'add_new_item' => __('Add new author', 'wp-songbook'),
            'new_item_name' => __('New author name', 'wp-songbook'),
            'separate_items_with_commas' => __('Separate authors by commas', 'wp-songbook'),
            'add_or_remove_items' => __('Add or remove authors', 'wp-songbook'),
            'choose_from_most_used' => __('Choose from most used authors', 'wp-songbook'),
            'not_found' => __('No authors found', 'wp-songbook'),
            'menu_name' => __('Song authors', 'wp-songbook'),
        );
        $songbook_taxauthor_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songauthor', 'song', $songbook_taxauthor_args);
    }

    function genres() {
        $labels = array(
            'name' => __('Genres', 'wp-songbook'),
            'singular_name' => __('Genre', 'wp-songbook'),
            'search_items' => __('Search genres', 'wp-songbook'),
            'popular_items' => __('Popular genres', 'wp-songbook'),
            'all_items' => __('All genres', 'wp-songbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit genre', 'wp-songbook'),
            'update_item' => __('Update genre', 'wp-songbook'),
            'add_new_item' => __('Add new genre', 'wp-songbook'),
            'new_item_name' => __('New genre name', 'wp-songbook'),
            'separate_items_with_commas' => __('Separate genres by commas', 'wp-songbook'),
            'add_or_remove_items' => __('Add or remove genres', 'wp-songbook'),
            'choose_from_most_used' => __('Choose from most used genres', 'wp-songbook'),
            'not_found' => __('No genres found', 'wp-songbook'),
            'menu_name' => __('Song genres', 'wp-songbook'),
        );
        $songbook_taxgenre_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songgenre', 'song', $songbook_taxgenre_args);
    }

    function albums() {
        $labels = array(
            'name' => __('Albums', 'wp-songbook'),
            'singular_name' => __('Album', 'wp-songbook'),
            'search_items' => __('Search albums', 'wp-songbook'),
            'popular_items' => __('Popular albums', 'wp-songbook'),
            'all_items' => __('All albums', 'wp-songbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit album', 'wp-songbook'),
            'update_item' => __('Update album', 'wp-songbook'),
            'add_new_item' => __('Add new album', 'wp-songbook'),
            'new_item_name' => __('New album name', 'wp-songbook'),
            'separate_items_with_commas' => __('Separate albums by commas', 'wp-songbook'),
            'add_or_remove_items' => __('Add or remove albums', 'wp-songbook'),
            'choose_from_most_used' => __('Choose from most used albums', 'wp-songbook'),
            'not_found' => __('No albums found', 'wp-songbook'),
            'menu_name' => __('Song albums', 'wp-songbook'),
        );
        $songbook_taxalbum_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songalbum', 'song', $songbook_taxalbum_args);
    }
    
    function langs(){
        $labels = array(
            'name' => __('Languages', 'wp-songbook'),
            'singular_name' => __('Language', 'wp-songbook'),
            'search_items' => __('Search languages', 'wp-songbook'),
            'popular_items' => __('Popular languages', 'wp-songbook'),
            'all_items' => __('All languages', 'wp-songbook'),
            'parent_item' => null,
            'parent_item_colon' => null,
            'edit_item' => __('Edit language', 'wp-songbook'),
            'update_item' => __('Update language', 'wp-songbook'),
            'add_new_item' => __('Add new language', 'wp-songbook'),
            'new_item_name' => __('New language name', 'wp-songbook'),
            'separate_items_with_commas' => __('Separate languages by commas', 'wp-songbook'),
            'add_or_remove_items' => __('Add or remove languages', 'wp-songbook'),
            'choose_from_most_used' => __('Choose from most used languages', 'wp-songbook'),
            'not_found' => __('No languages found', 'wp-songbook'),
            'menu_name' => __('Song languages', 'wp-songbook'),
        );
        $songbook_taxlanguage_args = array(
            'labels' => $labels,
            'show_tagcloud' => FALSE,
            'show_admin_column' => true
        );
        register_taxonomy('songlanguage', 'song', $songbook_taxlanguage_args);
    }

}

$wpsb_taxons = new songbook_taxonomies();
