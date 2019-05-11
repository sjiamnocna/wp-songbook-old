<?php

/**
 * Songbook functions class
 *
 * Contains functions and workarounds for the WP Songbook Wordpress plugin
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
abstract class songbook_functions {

    /**
     * 
     * Creates a HTML tag with parameters and fills it with content.
     * 
     * @param string    $html       specifies tag name
     * @param array     $pars       associative array of HTML arguments
     * @param boolean   $pair       if it's or it's not pair HTML element, if yes the closing tag will be added
     * @param string    $content    adds content between opening and closing tag - works only if $pair is true
     * @return string
     */
    function add_element($html, $pars = array(), $pair = true, $content = '') {
        if (!isset($html))
            return;

        $ret = '<' . $html;

        $param = '';
        $keys = array_keys($pars);
        $i = 0;
        while ($i < count($keys)) {

            $param.=' ' . $keys[$i] . '="' . $pars[$keys[$i]] . '"';
            $i++;
        }

        $ret.=$param;
        $ret.=($pair) ? '>' : '/>';
        $ret.=$content;
        if ($pair)
            $ret.="</$html>";
        return $ret;
    }

    /**
     * 
     * Checks if specified plugin files are included to protect against errors
     * 
     * @param array     $files  array of filenames relative to plugin's root dir
     * @return mixed    boolean or array
     */
    function areincluded($files = array()) {
        if (!isset($files))
            return;

        $files = array_unique($files);
        $ok = 0;
        $missing = array();

        for ($i = 0; $i < count($files); $i++) {
            if (in_array(WPSB_PLUGPATH . $files[$i], get_included_files()))
                $ok++;
            else
                $missing[] = $files[$i];
        }
        if ($ok === count($files))
            return true;
        else
            return $missing;
    }

    /**
     * 
     * Returns the button "Back to song list" for using in singular songs and template
     * 
     * @param string $linkclass     adds class to link element
     * @param type $bef             adds content before the link
     * @param type $aft             adds content after the link
     * @param type $force           forces function to add link again, even it was already used
     * @return string or null
     */
    function backtolist($linkclass = 'backtolist', $bef = '', $aft = '', $force = false) {

        if (defined('WPSB_BCKLINK') && !$force)
            return null;

        $ret = $bef;
        $link = get_the_permalink($this->option('shcdefs_listpageid'));
        $ret.="<a href=\"$link\" class=\"$linkclass\">";
        $ret.=$this->option('text_backtolist');
        $ret.='</a>';
        $ret.=$aft;

        define('WPSB_BCKLINK', true);
        return $ret;
    }

    /**
     * Compares two versions. Edited to return just '=', '<', or '>'
     * @param type $v1
     * @param type $v2
     * @return string
     */
    function version_compare($v1, $v2) {
        if (!$v1 || !$v2)
            return;

// DON'T USE VERSION COMPARE OF PHP
        $v1 = explode('.', $v1);
        $v2 = explode('.', $v2);

        $count = (count($v1) > count($v2)) ? count($v1) : count($v2);

        for ($i = 0; $i < $count; $i++) {

            $i1 = ( isset($v1[$i]) && is_numeric($v1[$i]) ) ? intval($v1[$i]) : 0;
            $i2 = ( isset($v2[$i]) && is_numeric($v2[$i]) ) ? intval($v2[$i]) : 0;

            if ($i1 > $i2) {
                return '>';
            } elseif ($i1 < $i2) {
                return '<';
            }
        }
        return '=';
    }

    /**
     * 
     * Contains a list of all plugin"s options to simplify saving, resetting, checking or getting values
     * 
     * @param string $optname
     * @return array or string of default value
     */
    function defs($optname = false) {
//default option values without prefixes
        $defs = array(
            'enable_filelinking' => 'disable',
            'enable_setvideolink' => 'disable',
            'enable_authorstax' => 'enable',
            'enable_albumstax' => 'disable',
            'enable_genrestax' => 'disable',
            'enable_langstax' => 'disable',
            'enable_comments' => 'disable',
            'enable_playlists' => 'disable',
            'enable_sbwidget' => 'disable',
            'enable_sswidget' => 'disable',
            'mincap_cpt_display' => 'read',
//            'mincap_addfiles' => 'edit_posts',
            'mincap_manauthors' => 'edit_posts',
            'mincap_playlists' => 'edit_posts',
            'mincap_ssidebar_control' => 'publish_posts',
            'text_backtolist' => __('Go back to the song list', 'wp-songbook'),
            'text_error_nothingfound' => __('We are sorry but nothing was found for selected conditions. An (probably green) alien from space have stolen everything similar this morning. Please, try something different', 'wp-songbook'),
            'text_error_disabled' => __('We are sorry, but this features are disabled on this site', 'wp-songbook'),
            'text_no_file' => __('No files were added to the song yet', 'wp-songbook'),
            'text_list_default' => __('Show list of all songs', 'wp-songbook'),
            'disp_backtolistinsong' => 'display',
            'disp_filelistinsong' => 'display',
            'disp_filelistforlogged' => 'private',
            'disp_videolinkinsong' => 'false',
            'disp_authorsinsong' => 'display',
            'disp_genresinsong' => 'false',
            'disp_albumsinsong' => 'false',
            'disp_lyrelement' => 'none',
            'disp_videolinkinshc' => 'display',
            'disp_songfilesinshc' => 'false',
            'disp_yearinsong' => 'false',
            'disp_prevnext' => 'false',
            'shcdefs_listpageid' => 0,
            'shcdefs_dispcont' => 'songs',
            'shcdefs_tablecont' => array('title','author'),
            'shcdefs_orderby' => 'title',
            'shcdefs_order' => 'asc',
            'shcdefs_thead' => 'display',
            'shcdefs_dispauthor' => 'display',
            'shcdefs_dispgenre' => 'false',
            'shcdefs_dispalbum' => 'false',
            'shcdefs_displang' => 'false',
            'tax_separator' => ', ',
            'shcdefs_dispyear' => 'false',
            'shcdefs_yeartype' => 'display',
            'shcdefs_dispsongcount' => 'display',
            'old' => null,
            'version' => null,
            'updated' => null,
            'cpt' => null
        );
        if (!$optname)
            return $defs;
        if (isset($optname) && isset($defs[$optname]))
            return $defs[$optname];
        else
            return '';
    }

    /**
     * Uses defs() method to get all option names and default values and sets all options values to default
     */
    function defs_all() {
        foreach (array_keys($this->defs()) as $key) {
            $this->option($key, 'setdef');
        }
    }

    /**
     * Gets title of a page specified by $URL
     * 
     * @param string $url   URL of the page to get title
     * @return string or boolean on failure
     */
    function gettitle($url) {

        if ($url)
            $return = true;
        if (!$url)
            $url = (strpos($_POST['url'], 'http') > -1) ? $_POST['url'] : 'http://' . $_POST['url'];

        $page = file_get_contents($url);

        preg_match("/\<title\>(.*)\<\/title\>/i", $page, $title);
        if (isset($title[1]))
            $toret = $title[1];
        else
            $toret = $url;

        return $toret;
    }

    /**
     * 
     * Creates string from each $arr array value and wrapps all with same strings $bef and $aft. Then it adds lineend (default PHP_EOL)
     * 
     * @param array $arr    the content to wrap
     * @param type $bef     wrapper before content
     * @param type $aft     wrapper after content
     * @param type $lineend lineend characters - PHP_EOL default but <br/> or other tags may be used if needed
     * 
     * @return string
     */
    function multielements($arr, $bef, $aft, $lineend = PHP_EOL) {
        if (!is_array($arr) || !$bef || !$aft)
            return;

        $ret = '';
        foreach ($arr as $el) {
            if ($el === false)
                $el = ' ';
            if (!empty($el))
                $ret.=$bef . $el . $aft . $lineend;
        }
        return $ret;
    }

    /**
     * 
     * Updates, resets default or retrieves option's value using plugin prefix and if option doesn't exist returns default value
     * 
     * @param string    $optname
     * @param string    $action type of action to do (only 'get', 'save' or 'setdef')
     * @param mixed     $newvalue differs by option type
     * @return mixed    differs by option type - mostly string
     */
    function option($optname, $action = 'get', $newvalue = false) {
        $prefix = 'songbook_';
        $default = ($action === 'def' || $action === 'setdef') ? true : false;
        $val = $newvalue;
        if (!$optname)
            return;
        if ($action === 'get')
            $val = apply_filters('chkval_' . $optname, get_option($prefix . $optname));
        if ($action === 'save') {
            $val = apply_filters('chkval_' . $optname, $val);
            $val = update_option($prefix . $optname, $val);
        }

        if (!$val || $default)
            $val = $this->defs($optname);

        if ($action === 'setdef')
            update_option($prefix . $optname, $val);

        return $val;
    }

    function upgradeold() {
        $oldver = '1.6';
        switch ($oldver) {
            case '1.6':
                $songs = new WP_Query(array('post_type' => 'song', 'posts_per_page' => -1));
                if ($songs->have_posts())
                    while ($songs->have_posts()) {
// set up $post
                        $songs->the_post();
//get meta files
                        $files = get_post_meta(get_the_ID(), 'songbook_files', true);
                        $files = unserialize($files);
                        if ($files && is_array($files) && count($files) > 0) {
                            //get files keys (to use in for loop)
                            $keys = array_keys($files);
                            //update each file meta
                            for ($i = 0; $i < count($keys); $i++) {
                                $filei = $keys[$i];
                                $file = array(
                                    'id' => $filei,
                                    'title' => (isset($files[$filei]['title'])) ? $files[$filei]['title'] : basename(wp_get_attachment_url($filei)),
                                    'type' => (isset($files[$filei]['type'])) ? $files[$filei]['type'] : false,
                                    'private' => (isset($files[$filei]['private'])) ? $files[$filei]['private'] : $this->option('disp_filelistforlogged'),
                                    'url' => (isset($files[$filei]['url'])) ? $files[$filei]['url'] : wp_get_attachment_url($filei)
                                );
                                $files[$filei] = $file;
                            }
                        }
                        
                        delete_post_meta(get_the_ID(), 'songbook_files');
                        update_post_meta(get_the_ID(), 'files', $files);

                        $videolink = (get_post_meta(get_the_ID(), 'songbook_video_link', true)) ? get_post_meta(get_the_ID(), 'songbook_video_link', true) : get_post_meta(get_the_ID(), 'video_link', true);
                        delete_post_meta(get_the_ID(), 'songbook_video_link');
                        update_post_meta(get_the_ID(), 'video_link', $videolink);
                    }
                    $this->option('version', 'save', WPSB_VERSION);
                break;
        }
    }

    public function write_log($log) {
        if (is_array($log) || is_object($log)) {
            error_log(print_r($log, true));
        } else {
            error_log($log);
        }
    }

}
