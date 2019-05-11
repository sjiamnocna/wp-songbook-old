<?php

/**
 * Plugin Name: WP Songbook
 * Description: Plugin for simple managing songs, song authors, lyrics and everything is needed for it.
 * Version: 2.0.11
 * Text Domain: wp-songbook
 * Domain Path: /langs
 * Author: Sjiamnocna
 * Author URI: http://sjiamnocna.com/wp-songbook
 */

/**
 * WPSB_VERSION - current version of WP Songbook plugin
 */
define('WPSB_VERSION', '2.0.11');

/**
 * WPSB_MINWPVER - required Wordpress version for using WP Songbook
 */
define('WPSB_MINWPVER', '3.6');

/**
 * WPSB_MAINPATH - path to the plugins main file
 */
define('WPSB_MAINPATH', __FILE__);

/**
 * splits the directory path string to select the directory name
 * Defines server type (WIN/LIN)
 */
$dirname = __DIR__;
if (stripos($dirname, ':\\') > -1){
    define('WPSB_SERVER', 'WIN');
    $dirname = explode('\\', $dirname);
} else {
    define('WPSB_SERVER', 'LIN');
    $dirname = explode('/', $dirname);
}
/**
 * WPSB_DIRNAME - plugins directory name in wp-content/plugins
 */
define('WPSB_DIRNAME', $dirname[count($dirname) - 1]);

/**
 * WPSB_PLUGPATH - path to the main directory
 */
define('WPSB_PLUGPATH', plugin_dir_path(__FILE__));

include_once 'inc/func.functions.php';
include_once 'inc/func.data.php';
include_once 'inc/filter.optcheck.php';
include_once 'inc/class.mess.php';
include_once 'inc/class.base.php';
include_once 'inc/class.ajax.php';
include_once 'inc/class.posttypes.php';
include_once 'inc/class.metabox.php';
include_once 'inc/class.taxonomies.php';
include_once 'inc/class.admin.php';
include_once 'inc/class.hooks.php';
include_once 'inc/class.public.php';
