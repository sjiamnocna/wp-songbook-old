<?php

/**
 * Songbook base class
 *
 * Methods allowing all functionality - registering and enqueuing scripts, setting localizations etc.
 *
 * @since       v. 2.0.
 * @version     1.3
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class wp_songbook extends songbook_functions {

    function __construct($key = '') {
        if (!$this->check_wp_version())
            return;
        load_plugin_textdomain('wp-songbook', false, WPSB_DIRNAME . '/langs/');

        $this->wpsb_version_change();

        if (isset($_GET['sbupgrade']) && $_GET['sbupgrade'])
            add_action('init', array($this, 'upgradeold'),0,15);

        add_action('init', array($this, 'regenqfiles'));
        add_action('wp_enqueue_scripts', array($this, 'enq_public'));
        add_action('admin_enqueue_scripts', array($this, 'enq_admin'));
    }

    function check_wp_version($minver = WPSB_MINWPVER) {
        global $wp_version;

        $res = $this->version_compare($minver, $wp_version);

        if (in_array($res, array('=', '<'))) {
            $ok = true;
        } else {
            add_filter('wpsb_notice', function($m) {
                global $wp_version;
                $m[] = sprintf(__('Wordpress version is too low to use WP Songbook. You are using version %1$s and WP Songbook requires at least version %2$s.<br/><b>Please upgrade your Wordpress to use the plugin</b>.', 'wp-songbook'), $wp_version, WPSB_MINWPVER);
                return $m;
            });
            $ok = false;
        }
        return $ok;
    }

    function regenqfiles() {
        wp_register_script('songbook_files_functions', plugins_url() . '/' . WPSB_DIRNAME . '/files/js/files_fcs.js', array('jquery'));
        wp_register_script('songbook_filebox_script', plugins_url() . '/' . WPSB_DIRNAME . '/files/js/filescript.js', array('jquery', 'songbook_files_functions'));
        wp_register_script('songbook_settings_script', plugins_url() . '/' . WPSB_DIRNAME . '/files/js/settings.js', array('jquery'));
        wp_register_script('songbook_metabox_script', plugins_url() . '/' . WPSB_DIRNAME . '/files/js/metabox.js', array('jquery'));

        wp_register_style('songbook_jqueryuistyle', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/jqueryui_customstyle.css');
        wp_register_style('songbook_filebox_style', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/filestyle.css');
        wp_register_style('songbook_metabox_css', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/metabox.css');
        wp_register_style('songbook_filetypes_css', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/filetypes.css');
        wp_register_style('songbook_settings_style', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/settstyle.css');
        wp_register_style('songbook_songlist_style', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/songlist.css');
        wp_register_style('songbook_songbase_style', plugins_url() . '/' . WPSB_DIRNAME . '/files/css/songbasics.css');


        $songbook_filebox_functions_translation = array(
            'unlink_confirm' => __('Really unlink file from song?', 'wp-songbook'),
            'new_title' => __('New title:', 'wp-songbook')
        );
        $songbook_filebox_script_translation = array(
            'choosefiles' => __('Choose files to link', 'wp-songbook'),
            'selectfiles_butt' => __('Link files', 'wp-songbook'),
            'docs_nocontent' => __('You must fill in URL and choose an icon to add the file. If you doesn\'t want to, than click close button above', 'wp-songbook')
        );
        $songbook_tooltips_script_translation = array(
            'textch' => __('Set new title for the file (will be shown instead of filename)', 'wp-songbook'),
            'lock' => __('Set file publicly visible or visible to users only', 'wp-songbook'),
            'remover' => __('Unlink file from song', 'wp-songbook'),
            'songbook_addfile_button' => __('Click to link files to song', 'wp-songbook'),
            'songbook_tempo_meta' => __('Set song speed', 'wp-songbook')
        );
        wp_localize_script('songbook_files_functions', 'songbook_filebox_func', $songbook_filebox_functions_translation);
        wp_localize_script('songbook_filebox_script', 'songbook_filebox_script', $songbook_filebox_script_translation);
        wp_localize_script('songbook_tooltips_script', 'songbook_tooltips_script', $songbook_tooltips_script_translation);
    }

    function enq_public() {
        $sb_listpageid = get_option('songbook_shcdefs_listpageid');
        if ($sb_listpageid == get_the_ID()) {
            wp_enqueue_style('songbook_songlist_style');
            wp_enqueue_style('songbook_filetypes_css');
            wp_enqueue_script('jquery-ui-tooltip');
        }
        if (is_single() && get_post_type() == 'song') {
            wp_enqueue_style('songbook_songbase_style');
            wp_enqueue_style('songbook_filetypes_css');
        }
    }

    function enq_admin() {
        $songbook_enq_page = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
        $songbook_getpage = (isset($_GET['page'])) ? $_GET['page'] : false;
        if ((preg_match('/^(edit\.php|post-new\.php|post\.php).*/', $songbook_enq_page) && get_post_type() == 'song')) {
            wp_enqueue_media();


            wp_enqueue_style('songbook_filebox_style');
            wp_enqueue_style('songbook_jqueryuistyle');
            wp_enqueue_style('songbook_filetypes_css');
            wp_enqueue_style('songbook_metabox_css');
            wp_enqueue_script('jquery-ui-sortable');
            wp_enqueue_script('jquery-ui-tooltip');
            wp_enqueue_script('jquery-ui-dialog');
            wp_enqueue_script('songbook_tooltips_script');
            wp_enqueue_script('songbook_files_functions');
            wp_enqueue_script('songbook_filebox_script');
            wp_enqueue_script('songbook_metabox_script');
        } elseif ($songbook_getpage == 'songbook-settlink') {

            wp_enqueue_style('songbook_settings_style');
            wp_enqueue_script('songbook_settings_script');
            wp_enqueue_script('jquery-ui-sortable');
        }
    }

    function wpsb_version_change() {
        $wpsb_ver = $this->option('version');

        $songbook_enq_page = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
        $songbook_getpage = (isset($_GET['page'])) ? $_GET['page'] : false;

        if ($this->version_compare(WPSB_VERSION, $wpsb_ver) == '>') {
            add_filter('wpsb_notice', function($m) {
                $m[] = sprintf(__('Now you successfully upgraded your WordPress Songbook plugin to the newest version %2$s. Be happy for you can now enjoy all new features of this version! :)', 'wp-songbook'), $this->option('old'), WPSB_VERSION);
                return $m;
            });
        } elseif ($this->version_compare(WPSB_VERSION, $wpsb_ver) == '<') {
            add_filter('wpsb_notice', function($m) {
                //downgrade
                return $m;
            });
        } else if ((preg_match('/^(edit\.php|post-new\.php|post\.php|plugins\.php).*/', $songbook_enq_page) || get_post_type() == 'song'))
            add_filter('wpsb_notice', function($m) {
                global $wpsb_ver;
                $m[] = sprintf(__('You are using WP songbook plugin, v. %1$s. <br/><b>Please support this plugin by voting 5 stars in Wordpress plugin repositories and telling that it works!</b> <br/>Of course you can support the development by donating me some money :) <br/>%2$s %3$s', 'wp-songbook'), ((!$wpsb_ver) ? WPSB_VERSION : $wpsb_ver), '<a class="button-primary" target="blank" href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted" title="' . __('Donate me!', 'wp-songbook') . '">' . __('Donate me!', 'wp-songbook') . '</a>', '<a class="button-primary" target="blank" href="https://wordpress.org/plugins/wp-songbook/stats/" title="' . __('Vote now! Tell others that it works!', 'wp-songbook') . '">' . __('Vote now! Tell others that it works!', 'wp-songbook') . '</a>');
                return $m;
            });
        if ($this->version_compare(WPSB_VERSION, $wpsb_ver) != '=') {
            $this->option('old', 'save', $wpsb_ver);
            $this->option('updated', 'save', date('Y-m-d-G-i-s'));
            add_filter('wpsb_notice', function($m) {
                $m[] = array('notice', sprintf(__('If you upgraded from lower version, you may want to <a href="$s%1">update the database by clicking here</a> to fit new functions. If you are new to WP Songbook please ignore this. ', 'wp-songbook'), admin_url('edit.php?post_type=song&sbupgrade=1')));
            });
        }
    }

}

$wpsb = new wp_songbook();
