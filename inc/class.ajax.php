<?php

/**
 * Songbook AJAX
 *
 * Uses WP AJAX to get data through Javascript
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */

class songbook_ajax extends songbook_functions {

    public function __construct() {
        add_action('wp_ajax_gdocstitle', array($this, 'gdocstitle'));
    }

    function gdocstitle($url = false) {
        $toret = $this->gettitle($url);


        if (!$toret)
            return $toret;
        else
            echo $toret;
    }

}

$wpsb_ajax = new songbook_ajax();
