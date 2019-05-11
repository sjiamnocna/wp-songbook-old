<div class="field" id="shcdefs_listpageid">
    <div class="left">
        <?php _e('Song list page', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose page on which should be the list printed', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_listpageid]">
            <?php
            query_posts(array('post_type' => 'page', 'nopaging' => true, 'orderby' => 'title'));

            $songbook_pageselect = '<option value="autoaddpage">' . __('Autoadd new page', 'wp-songbook') . PHP_EOL;
            if (have_posts())
                while (have_posts()):the_post();

                    $songbook_selected = ($this->option('shcdefs_listpageid') == get_the_ID()) ? 'selected="selected"' : '';
                    $songbook_pageselect.='<option value="' . get_the_ID() . '" ' . $songbook_selected . '>&nbsp;' . get_the_title() . PHP_EOL;
                endwhile;

            echo$songbook_pageselect;
            ?>
        </select>
        <?php
        if ($this->option('shcdefs_listpageid') > 0) {
            $title = get_the_title($this->option('shcdefs_listpageid'));
            $permalink = get_the_permalink($this->option('shcdefs_listpageid'));
            echo __('Visit page:', 'wp-songbook') . "&nbsp; <a href=\"$permalink\" target=\"_blank\">$title</a>";
        }
        ?>
        <input type="text"<?php if ($this->option('shcdefs_listpageid') > 0) echo' class="hidden"'; ?> id="shcdefs_autoadd_pgtitle" name="songbook[shcdefs_autoadd_pgtitle]" placeholder="<?php _e('Fill in your new page title', 'wp-songbook'); ?>">
    </div>
</div>

<div class="field" id="shcdefs_dispcont">
    <div class="left">
<?php _e('Display first', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Sets what will the list contain. You may set, the list will contain names of all authors with link to list of their songs etc.', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispcont]">
            <option value="songs" <?php selected($this->option('shcdefs_dispcont'), 'songs'); ?>><?php _e('Songs', 'wp-songbook'); ?>
            <option value="authors" <?php selected($this->option('shcdefs_dispcont'), 'authors'); ?>><?php _e('Authors', 'wp-songbook'); ?>
            <option value="albums" <?php selected($this->option('shcdefs_dispcont'), 'albums'); ?>><?php _e('Albums', 'wp-songbook'); ?>
            <option value="genres" <?php selected($this->option('shcdefs_dispcont'), 'genres'); ?>><?php _e('Genres', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_tablecont">
<?php
_e('Songlist table content', 'wp-songbook');
?>

    <div class="note">
    <?php _e('Allows to set order of collumns in the song list table', 'wp-songbook'); ?>
    </div>
<?php

$columns=$this->fields($this->option('shcdefs_dispcont'));

?>
    <div class="sortable-x">
        <?php
            $keys=($this->option('shcdefs_tablecont'))?$this->option('shcdefs_tablecont'):array_keys($columns);
            $i=0;
            
            while($i<count($keys)){
                
                if(isset($columns[$keys[$i]])){
                    echo'<div class="tbitem" id='.$keys[$i].'>';
                    echo'<input type="hidden" name="songbook[shcdefs_tablecont][]" value="'.$keys[$i].'"/>';
                    echo $columns[$keys[$i]];
                    echo'</div>';
                }                
                
                $i++;
            }
            
            if(array_diff(array_keys($columns),$keys)){
                $keys=array_diff(array_keys($columns),$keys);
                $k=array_keys($keys);
                $i=0;
            while($i<count($keys)){
                
                    echo'<div class="tbitem" id='.$keys[$k[$i]].'>';
                    echo'<input type="hidden" name="songbook[shcdefs_tablecont][]" value="'.$keys[$k[$i]].'"/>';
                    echo $columns[$keys[$k[$i]]];
                    echo'</div>';
                    $i++;
                }
            
            }
        ?>
    </div>
</div>

<div class="field" id="shcdefs_orderby">
    <div class="left">
<?php _e('Order songs by', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('This will order the songs by selected term', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_orderby]">
            <option value="title" <?php selected($this->option('shcdefs_orderby'), 'title'); ?>><?php _e('Song title', 'wp-songbook'); ?>
            <option value="authors" <?php selected($this->option('shcdefs_orderby'), 'authors'); ?>><?php _e('Song author', 'wp-songbook'); ?>
            <option value="albums" <?php selected($this->option('shcdefs_orderby'), 'albums'); ?>><?php _e('Song album', 'wp-songbook'); ?>
            <option value="genres" <?php selected($this->option('shcdefs_orderby'), 'genres'); ?>><?php _e('Song genre', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_order">
    <div class="left">
<?php _e('List order', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Sets ascending or descending ordering by the term above', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_order]">
            <option value="asc" <?php selected($this->option('shcdefs_order'), 'asc'); ?>><?php _e('Ascending', 'wp-songbook'); ?>
            <option value="desc" <?php selected($this->option('shcdefs_order'), 'desc'); ?>><?php _e('Descending', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_thead">
    <div class="left">
<?php _e('Display table head', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Display each column\'s description in the song list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_thead]">
            <option value="false" <?php selected($this->option('shcdefs_thead'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_thead'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_displang">
    <div class="left">
<?php _e('Display language', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Display language of the song', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_displang]">
            <option value="false" <?php selected($this->option('shcdefs_displang'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_displang'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispauthor">
    <div class="left">
<?php _e('Display author', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Display author(s) of each song in the list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispauthor]">
            <option value="false" <?php selected($this->option('shcdefs_dispauthor'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispauthor'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispgenre">
    <div class="left">
<?php _e('Display genre', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Display genre of each song in the list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispgenre]">
            <option value="false" <?php selected($this->option('shcdefs_dispgenre'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispgenre'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispalbum">
    <div class="left">
<?php _e('Display album', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Display album of each song in the list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispalbum]">
            <option value="false" <?php selected($this->option('shcdefs_dispalbum'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispalbum'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispyear">
    <div class="left">
<?php _e('Display year', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Adds column to display song year - you have to set it as publishing time of the song in the "publish" tab of editor', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispyear]">
            <option value="false" <?php selected($this->option('shcdefs_dispyear'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispyear'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispduration">
    <div class="left">
<?php _e('Display the song duration', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Adds column to display song duration in the list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispduration]">
            <option value="false" <?php selected($this->option('shcdefs_dispduration'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispduration'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="shcdefs_dispsongcount">
    <div class="left">
<?php _e('Display song count', 'wp-songbook'); ?>

        <div class="note">
        <?php _e('Displays count of the songs contained in current term (Author, Album or Genre) - useful e.g. when you set a list of authors', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[shcdefs_dispsongcount]">
            <option value="false" <?php selected($this->option('shcdefs_dispsongcount'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('shcdefs_dispsongcount'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_videolinkinshc">
    <div class="left">
<?php _e('Display video link', 'wp-songbook'); ?>

        <div class="note">
<?php _e('Whether to display video link in the song list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_videolinkinshc]">
            <option value="false" <?php selected($this->option('disp_videolinkinshc'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_videolinkinshc'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_songfilesinshc">
    <div class="left">
<?php _e('Display linked files', 'wp-songbook'); ?>

        <div class="note">
<?php _e('Whether to display linked files (as filetype icons) in the song list', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_songfilesinshc]">
            <?php if($this->option('enable_filelinking')!=='enable')$this->option('disp_songfilesinshc','save','false'); ?>
            <option value="false" <?php selected($this->option('disp_songfilesinshc'), 'false'); ?>><?php _e('Don\'t display', 'wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_songfilesinshc'), 'display'); ?>><?php _e('Display', 'wp-songbook'); ?>
        </select>
    </div>
</div>