<?php

/**
 * Songbook public pages
 *
 * Methods arranging WP Songbook publicly visible pages, like song list
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class songbook_public extends songbook_data {

    public function __construct() {
        add_filter('the_content', array($this, 'songlist'), 15, 1);
        add_filter('the_content', array($this, 'songcontent'), 15, 1);
    }

    /**
     * 
     * Creates a list of songs/authors/languages/albums and arranges them into page
     * 
     * @param string    $toedit content of page that is to be kept
     * @return string
     */
    public function songlist($toedit) {
        //check post
        if (get_the_ID() != $this->option('shcdefs_listpageid'))
            return $toedit;
        if ($this->option('showintext') === 'display')
            $return[] = $toedit;

        $a = isset($_GET['type']);
        $b = isset($_GET['tag']);

        if ($a && !$b)
            $list_content = $_GET['type'];
        else if ($a && $b)
            $list_content = 'songs';
        else if (!$a && !$b)
            $list_content = $this->option('shcdefs_dispcont');

        $list_content = (in_array($list_content, array('songs', 'albums', 'genres', 'authors'))) ? $list_content : 'songs';

        $table_content = ($list_content !== 'songs') ? array_keys($this->fields('authors')) : $this->option('shcdefs_tablecont');

        $taxon = (isset($_GET['type'])) ? $_GET['type'] : false;
        $tag = (isset($_GET['type']) && isset($_GET['tag'])) ? $_GET['tag'] : false;

        switch ($taxon) {
            case'authors':
                if ($this->option('enable_authorstax') !== 'enable')
                    $error = $list_content;
                $tax = 'songauthor';
                break;
            case'albums':
                if ($this->option('enable_albumstax') !== 'enable')
                    $error = $list_content;
                $tax = 'songalbum';
                break;
            case'genres':
                if ($this->option('enable_genrestax') !== 'enable')
                    $error = $list_content;
                $tax = 'songgenre';
                break;
            default:
                $tax = false;
                break;
        }

        $items = array();

        if (!isset($error)) {
            switch ($list_content) {
                case'songs':

                    $orderby = (isset($_GET['orderby'])) ? $_GET['orderby'] : $this->option('shcdefs_orderby');

                    //add query
                    $wpsb_query = new WP_Query(array(
                        'post_type' => 'song',
                        'nopaging' => true,
                        'posts_per_page' => -1,
                        'orderby' => $orderby,
                        'order' => (isset($_GET['order'])) ? $_GET['order'] : $this->option('shcdefs_order'),
                        'tax_query' => ($tax && $tag) ? array(array(
                                'taxonomy' => $tax,
                                'field' => 'slug',
                                'terms' => $tag
                            )
                                ) : FALSE
                    ));

                    $i = 0;
                    if ($wpsb_query->have_posts())
                        while ($wpsb_query->have_posts()) {
                            $wpsb_query->the_post();
                            $data = $this->fields('songs', 'content');
                            if (is_array($table_content)) {
                                $keys = array_keys($table_content);
                                for ($j = 0; $j < count($keys); $j++) {
                                    $item = $table_content[$keys[$j]];
                                    if (isset($data[$item]))
                                        $items[$i][] = $data[$item];
                                }
                            }
                            $i++;
                        }

                    break;
                case'authors':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
                case'albums':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
                case'genres':

                    //get all taxonomy terms
                    $terms = get_terms($tax);

                    for ($i = 0; $i < count($terms); $i++) {
                        $link = get_term_link($terms[$i]);

                        $items[$i]['title'] = "<a href=\"$link\">" . $terms[$i]->name . '</a>';
                        $items[$i]['count'] = $terms[$i]->count;
                    }

                    break;
            }
        }




        //if its selected to display table head, gets titles of each column to make 
        if (!isset($error)) {

            $return[] = '<table id="wpsongbook_list">';
            if ($this->option('shcdefs_thead') === 'display') {
                $fields = ($list_content === 'songs') ? $this->fields('songs') : $this->fields('authors');

                if (is_array($table_content) && count($table_content) > 0)
                    for ($i = 0; $i < count($table_content); $i++) {
                        $item = $table_content[$i];
                        $thead[] = (isset($fields[$item])) ? $fields[$item] : NULL;
                    }

                $return[] = $this->multielements($thead, '<td>', '</td>');
            }

            //finally insert rows with content
            if (count($items) >= 1)
                for ($i = 0; $i < count($items); $i++) {
                    $return[] = '<tr>' . $this->multielements($items[$i], '<td>', '</td>') . '</tr>';
                }

            $return[] = '</table>';
        }

        if (isset($error))
            return '<div class="sorry">' . $this->option('text_error_disabled') . '</div>';
        elseif (!isset($error) && count($items) === 0)
            return '<div class="sorry">' . $this->option('text_error_nothingfound') . '</div>';
        else
        if (isset($return))
            return implode(PHP_EOL, $return);
    }

    function songcontent($toedit) {
        global $post;
        if (!is_single() || get_post_type($post->ID) !== 'song')
            return $toedit;

        if ($this->option('disp_lyrelement')) {
            switch ($this->option('disp_lyrelement')) {
                case'div':
                    $sb_wrapper[0] = '<div class="wpsongbook_lyrics">';
                    $sb_wrapper[1] = '</div>';
                    break;
                case'blockquote':
                    $sb_wrapper[0] = '<blockquote class="wpsongbook_lyrics">';
                    $sb_wrapper[1] = '</blockquote>';
                    break;
                case'pre':
                    $sb_wrapper[0] = '<pre class="wpsongbook_lyrics">';
                    $sb_wrapper[1] = '</pre>';
                    break;
                case'code':
                    $sb_wrapper[0] = '<code class="wpsongbook_lyrics">';
                    $sb_wrapper[1] = '</code>';
                    break;
                default:
                    $sb_wrapper[0] = '';
                    $sb_wrapper[1] = '';
                    break;
            }
        }

        $ret = array();

        if ($this->option('disp_backtolistinsong') === 'display')
            $ret[] = $this->backtolist() . PHP_EOL;

        if ($this->option('disp_authorsinsong') === 'display' && $this->option('enable_authorstax') === 'enable')
            $ret[] = '<span class="author">' . get_the_term_list(get_the_ID(), 'songauthor') . '</span>';

        if ($this->option('disp_albumsinsong') === 'display' && $this->option('enable_albumstax') === 'enable')
            $ret[] = '<span class="album">' . get_the_term_list(get_the_ID(), 'songalbum') . '</span>';

        if ($this->option('disp_genresinsong') === 'display' && $this->option('enable_genrestax') === 'enable')
            $ret[] = '<span class="genre">' . get_the_term_list(get_the_ID(), 'songgenre') . '</span>';

        if ($this->option('disp_yearinsong') === 'display')
            $ret[] = '<span class="year">' . get_the_date('Y') . '</span>';

        if ($this->option('disp_filelistinsong') === 'display') {

            $meta_files = $this->getmeta(get_the_ID(), 'files');
            $filecount = 0;

            if (is_array($meta_files)) {
                $files = '<div class="sb_songfiles" title="' . __('Linked files', 'wp-songbook') . '">';
                $keys = array_keys($meta_files);
                for ($i = 0; $i < count($keys); $i++) {

                    if (is_array($meta_files[$keys[$i]])) {
                        $url = ($meta_files[$keys[$i]]['url']) ? $meta_files[$keys[$i]]['url'] : false;
                        $lockedordisplay = ($meta_files[$keys[$i]]['private'] == 'private') ? current_user_can($this->option('mincap_seeprivatefiles')) : true;
                        $title = ($meta_files[$keys[$i]]['title']) ? $meta_files[$keys[$i]]['title'] : false;
                        $extension = ($meta_files[$keys[$i]]['type']) ? $meta_files[$keys[$i]]['type'] : false;
                    }

                    if (isset($url) && $url && isset($lockedordisplay) && $lockedordisplay) {
                        $files .= "<div class=\"file\">
                                        <span class=\"exticon $extension\"></span>
                                        <p class=\"filetitle\">$title</p>
                                        <p class=\"toolbar\"><a href=\"$url\" title=\"See $title file\">Show file</a></p>
                                    </div>" . PHP_EOL;

                        $filecount++;
                    }
                }
                $files .= '</div>';
            }
        }

        $ret[] = $sb_wrapper[0];

        $ret[] = $toedit;

        $ret[] = $sb_wrapper[1];

        if (isset($filecount) && $filecount > 0)
            $ret[] = $files;

        return implode(PHP_EOL, $ret);
    }

}

$wpsb_publicpgs = new songbook_public();
