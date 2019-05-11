<?php

/**
 * Songbook hooks
 *
 * Other methods modifying the way of Wordpress is working for WP Songbook needs
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class songbook_hooks extends songbook_data {

    function __construct() {
        add_filter('the_title', array($this, 'songtitle'));
        add_filter('post_type_link', array($this, 'songarchlink'), 10, 2);
        add_filter('term_link', array($this, 'taxlinks'), 10, 3);

        add_filter('plugin_row_meta', array($this, 'pluginmetalinks'), 10, 2);
        add_filter('plugin_action_links_' . WPSB_DIRNAME . '/wp-songbook.php', array($this, 'pluginspagelink'), 10, 2);

        add_action('admin_head', array($this, 'adminhed'));

        add_action('admin_print_scripts', array($this, 'disable_drafts_script'));
        add_action('admin_init', array($this, 'disable_drafts'));

        if ($this->option('disp_prevnext') === 'true') {
            add_filter('previous_post_link', array($this, 'remove_nextprev_links'), 10, 2);
            add_filter('next_post_link', array($this, 'remove_nextprev_links'), 10, 2);
        }
    }

    function adminhed() {
        $songbook_enq_page = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
        $songbook_getpage = (isset($_GET['page'])) ? $_GET['page'] : false;
        if ( !preg_match('/^(edit\.php|post-new\.php|post\.php).*/', $songbook_enq_page) || !in_array(get_post_type(get_the_ID()), array('song', 'playlist'))) return;
        ?>
        <style type="text/css">
            #songbook_admin_wrap #content ul.right{
                background:<?php echo $this->getadmincolors()->colors[1]; ?>;
            }
            #songbook_admin_wrap #content ul.right a{
                background:<?php echo $this->getadmincolors()->colors[0]; ?>;
                color:<?php echo $this->getadmincolors()->icon_colors['base']; ?>;
            }
            #songbook_admin_wrap #content ul.right a:hover{
                color:<?php echo $this->getadmincolors()->icon_colors['focus']; ?>;
                border-left:2px solid <?php echo $this->getadmincolors()->colors[2]; ?>;
            }
            #songbook_admin_wrap > #content > ul.right a.active{
                border-left-color:<?php echo $this->getadmincolors()->colors[2]; ?>;
                color:<?php echo $this->getadmincolors()->icon_colors['current']; ?>;
            }
            #songbook_admin_wrap > #content > ul.right a.active:hover{
                border-left:4px solid <?php echo $this->getadmincolors()->colors[2]; ?>;
            }
        </style>
        <?php
    }

    function disable_drafts_script() {
        global $post;
        $songbook_enq_page = basename($_SERVER['PHP_SELF']) . "?" . $_SERVER['QUERY_STRING'];
        $songbook_getpage = (isset($_GET['page'])) ? $_GET['page'] : false;

        if (get_the_ID())
            if (preg_match('/^(edit\.php|post-new\.php|post\.php).*/', $songbook_enq_page) && in_array(get_post_type(get_the_ID()), array('song', 'playlist'))) {
                wp_dequeue_script('autosave');
            }
    }

    function disable_drafts() {
        remove_post_type_support('song', 'revisions');
        remove_post_type_support('playlist', 'revisions');
    }

    function pluginspagelink($links) {
        $songbook_pluginlinks = array(
            'edit.php?post_type=song&page=songbook-settlink' => __('Settings', 'wp-songbook')
        );
        foreach (array_keys($songbook_pluginlinks) as $songbook_pluginlinkkey) {
            $songbook_link = '<a href="' . $songbook_pluginlinkkey . '">' . $songbook_pluginlinks[$songbook_pluginlinkkey] . '</a>';
            array_push($links, $songbook_link);
        }
        return $links;
    }

    function pluginmetalinks($links, $file) {
        if ($file != 'wp-songbook/wordpress-songbook.php')
            return$links;
        $songbook_pluginlinks = array(
            admin_url('edit.php?post_type=song&page=songbook-settlink') => __('Songbook settings', 'wp-songbook'),
            'https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=65SS8NS48FPFQ&lc=CZ&item_name=%c5%a0imon%20Jan%c4%8da&currency_code=CZK&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted' => __('Donate me', 'wp-songbook')
        );
        foreach (array_keys($songbook_pluginlinks) as $songbook_pluginlinkkey) {
            if ($songbook_pluginlinks[$songbook_pluginlinkkey])
                $songbook_link = '<a href="' . $songbook_pluginlinkkey . '">' . $songbook_pluginlinks[$songbook_pluginlinkkey] . '</a>';
            if (!$songbook_pluginlinks[$songbook_pluginlinkkey])
                $songbook_link = $songbook_pluginlinkkey;
            array_push($links, $songbook_link);
        }
        return $links;
    }

    function songarchlink($url, $post) {
        return $url;
        if ('song' == $post->post_type)
            return get_the_permalink($post);
        return $url;
    }

    function taxlinks($url, $term, $taxonomy) {

        $term_con = $term;
        $listurl = get_permalink($this->option('shcdefs_listpageid'));
        if (!in_array($taxonomy, array('songauthor', 'songalbum', 'songgenre')))
            return $url;

        $ending = '';
        switch ($taxonomy) {
            case'songauthor':
                $ending = 'type=authors&tag=' . $term_con->slug;
                break;
            case'songgenre':
                $ending = 'type=genres&tag=' . $term_con->slug;
                break;
            case'songalbum':
                $ending = 'type=albums&tag=' . $term_con->slug;
                break;
        }

        if (stripos($listurl, '?'))
            $ending_f = '&' . $ending;
        else
            $ending_f = '?' . $ending;
        return $listurl . $ending_f;
    }

    function songtitle($toedit) {
        return $toedit;
    }

    function remove_nextprev_links($format, $link) {
        if (is_singular('song'))
            return false;
    }

}

$wpsb_hooks = new songbook_hooks();