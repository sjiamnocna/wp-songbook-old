<?php

/**
 * Songbook Admin
 *
 * Adds settings page for WP Songbook
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class songbook_admin extends songbook_data {

    public function __construct() {
        add_action('admin_menu', array($this, 'regadminpage'));
        $this->messages();
    }

    function regadminpage() {
        add_submenu_page('edit.php?post_type=song', __('Settings', 'wp-songbook'), __('Songbook settings', 'wp-songbook'), 'edit_dashboard', 'songbook-settlink', array($this, 'create_adminset'));
    }

    public function create_adminset() {
        if (isset($_GET['reset']) && !isset($_POST['sb_savesets']))
            $this->defs_all();
        if (isset($_POST['sb_savesets']) && isset($_POST['_wpnonce']))
            if (wp_verify_nonce($_POST['_wpnonce'])) {

                if (isset($_POST['songbook'])) {

                    $vals = $_POST['songbook'];

                    if ($vals['shcdefs_listpageid'] === 'autoaddpage') {

                        $title = (!empty($vals['shcdefs_autoadd_pgtitle'])) ? $vals['shcdefs_autoadd_pgtitle'] : __('Songs', 'wp-songbook');
                        if (!get_page_by_title($title)) {
                            $post = array(
                                'menu_order' => '5',
                                'comment_status' => 'closed',
                                'post_author' => 'songbook plugin',
                                'post_content' => ' ',
                                'post_status' => 'publish',
                                'post_title' => $title,
                                'post_type' => 'page'
                            );
                            wp_insert_post($post);
                        }
                        unset($vals['shcdefs_autoload_pgtitle']);
                        if ((isset($title)))
                            $vals['shcdefs_listpageid'] = get_page_by_title($title)->ID;
                        else
                            unset($vals['shcdefs_listpageid']);
                    }
                }

                if (count($vals) > 1)
                    foreach (array_keys($vals) as $pkey) {
                        $this->option($pkey, 'save', $vals[$pkey]);
//                echo $pkey.'&nbsp;'.$_POST['songbook'][$pkey].'<br/>';
                    }
            }

//          define admin pages
        $pages['pluginfo.php'] = __('Plugin info', 'wp-songbook');
        $pages['basic.php'] = __('Songbook settings', 'wp-songbook');
        $pages['capabilities.php'] = __('Capabilities', 'wp-songbook');
//        $pages['modules.php']=__('Plugin modules','wp-songbook');
        $pages['songcontent.php'] = __('Song content', 'wp-songbook');
        $pages['songlist.php'] = __('Song list behavior', 'wp-songbook');
        $pages['language.php'] = __('Language', 'wp-songbook');
        ?>
        <form id="songbook_admin_wrap" method="post">
            <h1><?php _e('WP Songbook plugin settings', 'wp-songbook'); ?></h1>
            <div id="content">
                <form>
                    <div class="left">
                        <?php
                        $files = array_keys($pages);
                        $act = (isset($_GET['cont']) && in_array($_GET['cont'] . '.php', $files)) ? $_GET['cont'] : 'pluginfo';

                        foreach ($files as $page) {

                            $class[] = 'part';
                            if ($act . '.php' === $page)
                                $class[] = 'active';
                            $divclass = ' class="' . implode(' ', $class) . '"';

                            echo"<div $divclass>";
                            echo"<h2>" . $pages[$act . '.php'] . "</h2>";
                            echo'<div class="inside">';
                            include_once 'admin/' . $page;
                            echo'</div>';
                            echo'</div>';

                            unset($class);
                        }
                        wp_nonce_field();
                        ?>
                    </div>
                    <ul class="right">
                        <?php
                        foreach (array_keys($pages) as $item) {

                            $short = str_replace('.php', '', $item);

                            $end = ($item !== 'pluginfo.php') ? '&cont=' . $short : '';
                            $active = ($act === $short) ? ' class="active" ' : '';
                            $url = admin_url('edit.php?post_type=song&page=songbook-settlink' . $end);
                            $text = $pages[$item];

                            echo"<a href=\"$url\" id=\"$short\"$active>$text</a>";
                        }
                        ?>
                    </ul>
                    <input type="submit" class="button-primary" name="sb_savesets" value="<?php _e('Save settings', 'wp-songbook'); ?>"/>
                    <input type="button" class="button-primary button-donate"/>
            </div>
        </form>

        <?php
    }

    function messages() {
        if (isset($_GET['reset']) && !isset($_POST['sb_savesets'])) {
            add_filter('wpsb_notice', function($arr) {
                $arr[] = array(
                    __('All settings were restored to default values', 'wp-songbook'),
                    'update'
                );
                return $arr;
            });
        }
    }

}

$eadmin = new songbook_admin();
