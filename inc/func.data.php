<?php

/**
 * Songbook data class
 *
 * Contains functions used for obtaining data for Wordpress plugin WP Songbook
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
abstract class songbook_data extends songbook_functions {

    /**
     * 
     * Checks, if the fields are supported (enabled) and gets each field's content and title for using in songs list.
     * It returns data also for Authors list or other custom setting lists specified by $cont parameter
     * 
     * @param string    $cont
     * @param string    $type
     * @return          array
     */
    function fields($cont, $type = 'header') {

        if ($type === 'header')
            switch ($cont) {
                case'songs':
                    $columns['title'] = __('Title', 'wp-songbook');
                    if ($this->option('shcdefs_dispauthor') === 'display' && $this->option('enable_authorstax') === 'enable')
                        $columns['author'] = __('Author', 'wp-songbook');
                    if ($this->option('shcdefs_dispgenre') === 'display' && $this->option('enable_genrestax') === 'enable')
                        $columns['genre'] = __('Genre', 'wp-songbook');
                    if ($this->option('shcdefs_dispalbum') === 'display' && $this->option('enable_albumstax') === 'enable')
                        $columns['album'] = __('Album', 'wp-songbook');
                    if ($this->option('shcdefs_displang') === 'display' && $this->option('enable_langstax') === 'enable')
                        $columns['lang'] = __('Languages', 'wp-songbook');
                    if ($this->option('shcdefs_dispyear') === 'display')
                        $columns['year'] = __('Year', 'wp-songbook');
                    if ($this->option('disp_videolinkinshc') === 'display')
                        $columns['videolink'] = __('Video', 'wp-songbook');
                    if ($this->option('disp_songfilesinshc') === 'display')
                        $columns['songfiles'] = __('Song files', 'wp-songbook');
                    if ($this->option('shcdefs_dispduration') === 'display')
                        $columns['duration'] = __('Song duration', 'wp-songbook');
                    break;
                default:
                    $columns['title'] = __('Title', 'wp-songbook');
                    $columns['count'] = __('Count', 'wp-songbook');
                    break;
            }
        else if ($type === 'content' && $cont === 'songs') {
            $columns['title'] = '<a href="' . get_the_permalink() . '" title="' . __('Display lyrics for', 'wp-songbook') . ' ' . get_the_title() . '">' . get_the_title() . '</a>';
            if ($this->option('shcdefs_dispauthor') === 'display' && $this->option('enable_authorstax') === 'enable')
                $columns['author'] = (get_the_term_list(get_the_ID(), 'songauthor')) ? get_the_term_list(get_the_ID(), 'songauthor', '', $this->option('tax_separator'), '') : ' ';

            if ($this->option('shcdefs_dispgenre') === 'display' && $this->option('enable_genrestax') === 'enable')
                $columns['genre'] = (get_the_term_list(get_the_ID(), 'songgenre')) ? get_the_term_list(get_the_ID(), 'songgenre', '', $this->option('tax_separator'), '') : ' ';

            if ($this->option('shcdefs_dispalbum') === 'display' && $this->option('enable_albumstax') === 'enable')
                $columns['album'] = (get_the_term_list(get_the_ID(), 'songalbum')) ? get_the_term_list(get_the_ID(), 'songalbum', '', $this->option('tax_separator'), '') : ' ';

            if ($this->option('shcdefs_displang') === 'display' && $this->option('enable_langstax') === 'enable')
                $columns['lang'] = (get_the_term_list(get_the_ID(), 'songlanguage')) ? get_the_term_list(get_the_ID(), 'songlanguage', '', $this->option('tax_separator'), '') : ' ';

            if ($this->option('shcdefs_dispyear') === 'display')
                $columns['year'] = (get_the_time('Y')) ? get_the_time('Y') : ' ';

            if ($this->option('disp_videolinkinshc') === 'display') {
                if (get_post_meta(get_the_ID(), 'songbook_video_link', true)) {
                    $wpsb_ajax = new songbook_ajax();
                    $url = get_post_meta(get_the_ID(), 'songbook_video_link', true);
                    $title = $wpsb_ajax->gdocstitle($url);
                }
                $columns['videolink'] = (isset($url) && isset($title)) ? "<a class=\"file\" href=\"$url\" title=\"$title\" ><span class=\"video\"></span></a>" : false;
            }
            if ($this->option('disp_songfilesinshc') === 'display') {

                $files = (get_post_meta(get_the_ID(), 'files', true));

                if (is_array($files)) {
                    $keys = array_keys($files);

                    $outfiles = '';
                    for ($i = 0; $i < count($keys); $i++) {
                        $url = $files[$keys[$i]]['url'];
                        $title = $files[$keys[$i]]['title'];
                        $type = $files[$keys[$i]]['type'];

                        $hidden = $files[$keys[$i]]['private'];
                        $show = ( $hidden === 'public' || ($hidden === 'private' && is_user_logged_in()) );

                        if ($show)
                            $outfiles .= "<a class=\"file\" href=\"$url\" title=\"$title\" ><span class=\"$type\"></span></a>";
                    }

                    $columns['songfiles'] = $outfiles;
                } else
                    $columns['songfiles'] = false;
            }
            if ($this->option('shcdefs_dispduration') === 'display')
                $columns['duration'] = ($this->getmeta(get_the_ID(), 'duration')) ? $this->getmeta(get_the_ID(), 'duration') : ' ';
        }
        if (isset($columns))
            return $columns;
    }

    /**
     * 
     * Creates song header info block for using in singular song
     * 
     * @return type     array
     */
    function headerinfo() {
        
    }

    /**
     * 
     * Returns array of custom WP admin colors set by user just to personalize WP Songbook settings page
     * 
     * @return array
     */
    function getadmincolors() {
        global $_wp_admin_css_colors;
        $admin_colors = $_wp_admin_css_colors;
        return $admin_colors[get_user_meta(get_current_user_id(), 'admin_color', true)];
    }

    /**
     * 
     * Method makes it simpler and safer to get song meta content
     * 
     * @param int $id
     * @param string $metaname
     * @return boolean
     */
    function getmeta($id, $metaname) {
        $r = get_post_meta($id, $metaname, true);
        if ($r && !is_object($r))
            return $r;
        else
            return false;
    }

}
