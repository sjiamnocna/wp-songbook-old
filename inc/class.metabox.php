<?php

/**
 * Songbook metabox
 *
 * Adds metaboxes to custom post types
 *
 * @since       v. 2.0.
 * @version     1.0
 * @author      Sjiamnocna
 * @copyright   (c) 2015 Sjiamnocna
 * 
 */
class songbook_metabox extends songbook_data {

    function __construct() {
        add_action('add_meta_boxes', array($this, 'register_metabox'));
        add_action('save_post', array($this, 'savesongmeta'));

        if ($this->option('enable_playlists') === 'enable')
            add_action('save_post', array($this, 'save_playlist'));
    }

    function register_metabox() {
        add_meta_box('songbook_details', __('Song details', 'wp-songbook'), array($this, 'song_metabox_content'), 'song', 'side', 'high');
        if ($this->option('enable_playlists') === 'enable')
            add_meta_box('playlist_content', __('Playlist', 'wp-songbook'), array($this, 'playlist_content'), 'playlist', 'normal', 'high');
    }

    function song_metabox_content() {
        global $post;
        echo'<div id="song_meta">';

        echo"<script type=\"text/javascript\">";

        $parvars = array(
            'lock' => $this->option('disp_filelistforlogged')
        );

        echo 'var sbfDef = new Object;' . PHP_EOL;
        $keys = array_keys($parvars);
        for ($i = 0; $i < count($keys); $i++)
            echo 'sbfDef.' . $keys[$i] . ' = ' . ( is_int($parvars[$keys[$i]]) ? $parvars[$keys[$i]] : '"' . $parvars[$keys[$i]] . '"') . ';';

        echo"</script>";

        echo '<input type="hidden" name="songbook[nonce]" id="noncefield" value="' . wp_create_nonce(plugin_basename(__FILE__)) . '"/>';

        $files['info'] = __('Details', 'wp-songbook');
        if ($this->option('enable_filelinking') === 'enable')
            $files['files'] = __('Files', 'wp-songbook');
        if ($this->option('enable_setvideolink') === 'enable' && current_user_can($this->option('mincap_addfiles')))
            $files['videos'] = __('Video', 'wp-songbook');
        if ($this->option('enable_playlists') === 'enable')
            $files['playlists'] = __('Playlists', 'wp-songbook');

        $keys = array_keys($files);
        echo'<div class="nav">';
        foreach ($keys as $key) {
            echo $this->add_element('span', array('class' => 'tablink', 'id' => $key), true, $files[$key]);
        }
        echo'</div>';
        unset($files);

        $values = get_post_meta($post->ID);

        foreach ($keys as $key) {
            echo"<div class=\"section\" id=\"$key\">";
            include_once 'metabox/' . $key . '.php';
            echo'</div>';
        }
        echo'</div>';
    }

    function savesongmeta() {
        $data = (isset($_POST['songbook'])) ? $_POST['songbook'] : false;
        if (!$data)
            return;
        $fields = array('files', 'duration', 'tempo', 'video_link');

        if (!$data)
            return 1;
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return 2;
        if (!isset($data['nonce']) || !wp_verify_nonce($data['nonce'], plugin_basename(__FILE__)))
            return 3;

        foreach ($fields as $field) {
            if (!isset($data[$field]))
                continue;
            if (is_array($data[$field]) && count($data[$field]) < 0)
                $fc = 'update';
            else
                $fc = 'delete';
            if (!$data[$field])
                $fc = 'delete';
            else
                $fc = 'update';

            if ($fc === 'delete')
                delete_post_meta(get_the_ID(), $field);
            if ($fc === 'update')
                update_post_meta(get_the_ID(), $field, $data[$field]);
        }
    }

    function playlist_content() {
        echo'Ahoj';

        $data = get_the_content();
    }

    function save_playlist() {
        if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
            return;
    }

}

$wpsb_metabox = new songbook_metabox();
