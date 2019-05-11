<div class="tab" id="songfiles">
    <div class="uploader">
        <div class="button" id="songbook_addfile_button"><?php _e('Add files', 'wp-songbook') ?></div>
        <div class="button" id="songbook_addfile_gdocs"></div>
        <input type="hidden" name="songbook_filebox_noncename" id="songbook_noncename" value="<?php echo wp_create_nonce(plugin_basename(__FILE__)) ?>"/>
    </div>
    <div id="obal">
        <?php
        $files = (get_post_meta($post->ID, 'files', true)) ? get_post_meta($post->ID, 'files', true) : false;

        if (is_array($files) && count($files) > 0) {

            $keys = array_keys($files);
            for ($i = 0; $i < count($keys); $i++) {

                $fid = $keys[$i];

                $file = array(
                    'id' => $fid,
                    'title' => (isset($files[$fid]['title'])) ? $files[$fid]['title'] : basename(wp_get_attachment_url($fid)),
                    'type' => (isset($files[$fid]['type'])) ? $files[$fid]['type'] : false,
                    'private' => (isset($files[$fid]['private'])) ? $files[$fid]['private'] : $this->option('disp_filelistforlogged'),
                    'url' => (isset($files[$fid]['url'])) ? $files[$fid]['url'] : wp_get_attachment_url($fid)
                );

                if (!$file['type']) {
                    $file['type'] = (isset($files[$fid]['ext'])) ? $files[$fid]['ext'] : explode('.', basename(wp_get_attachment_url($fid)))[1];
                }

                $lockclass = (isset($files[$fid]['private']) && $files[$fid]['private'] === 'public') ? 'unlocked' : 'locked';

                $hidden = $files[$fid];

                $inp = '';

                foreach ($hidden as $optname => $hid) {
                    $inp.=$this->add_element('input', array('type' => 'hidden', 'name' => 'songbook[files][' . $fid . '][' . $optname . ']', 'id' => $optname . '_' . $fid, 'value' => $hid), false);
                }
                ?>

                <div class="file" id="file_<?php echo $fid; ?>">
                    <span class="exticon<?php echo (isset($file['type'])) ? ' ' . $file['type'] : ''; ?>">
                    </span>
                    <div class="maininfo">
                        <p class="filetitle"><a id="href_<?php echo $file['id']; ?>" href="<?php echo $file['url']; ?>" target="_blank"><?php echo $file['title']; ?></a></p>

                        <?php
                        echo $inp;
                        ?>

                        <p class="toolbar">
                            <span class="toolspan">
                                <a class="textch" rel="<?php echo $fid; ?>"></a>
                                <a class="lock <?php echo $lockclass ?>" rel="<?php echo $fid; ?>"></a>
                                <a class="remover" rel="<?php echo $fid; ?>"></a>
                            </span>
                        </p>
                    </div>
                </div>
                <?php
            }
        }
        ?>
        <p class="nofile"<?php if ($files || (count($files) === 0)) echo ' style="display:none;"'; ?>>
            <?php
            echo $this->option('text_no_file') . '<br/><br/>' . PHP_EOL;
            _e('Start adding files clicking on "Add files" button above. You can add multiple files holding CTRL key and clicking the files in gallery', 'wp-songbook');
            ?>
        </p>

    </div>
</div>
<div id="dialog_add_gdocs">
    <p class="title">
        <?php _e('Insert url of shared document:', 'wp-songbook'); ?>
    </p>
    <input type="text" id="fileurl"/>
    <div class="subopt" id="pgtitle">
        <p class="title"><?php _e('File title:', 'wp-songbook'); ?></p>
        <input type="text" class="pagetitle"/>
    </div>

    <p class="title"><?php _e('Choose link icon:', 'wp-songbook'); ?></p>
    <div id="selicon">
        <?php
        $arr = array('gdocs', 'gdocs_doc', 'gdocs_exc', 'gdocs_pwp', 'trigp', 'sevenz', 'ae',
            'ai', 'avi', 'bmp', 'doc', 'docx', 'flv', 'html', 'jpg', 'mov', 'mp3', 'mp4',
            'mpeg', 'ogg', 'pdf', 'ppt', 'rar', 'txt', 'wav', 'zip', 'pdf', 'jpg');
        foreach ($arr as $a) {
            echo"<img id=\"url_$a\" class=\"small $a\"/>";
        }
        ?>
    </div>
</div>