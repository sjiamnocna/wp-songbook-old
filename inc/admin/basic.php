<div class="field" id="enable_authorstax">
    <div class="left">
        <?php _e('Allow using authors', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds "Authors" taxonomy to sort songs by its author', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_authorstax]">
            <option value="disable" <?php selected($this->option('enable_authorstax'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_authorstax'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_albumstax">
    <div class="left">
        <?php _e('Allow using albums', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds "Albums" taxonomy to sort songs by its album', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_albumstax]">
            <option value="disable" <?php selected($this->option('enable_albumstax'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_albumstax'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_genrestax">
    <div class="left">
        <?php _e('Allow using genres', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds "Genre" taxonomy to sort songs by its genre', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_genrestax]">
            <option value="disable" <?php selected($this->option('enable_genrestax'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_genrestax'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_langstax">
    <div class="left">
        <?php _e('Allow using languages', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds "Languages" taxonomy tags to sort songs by its languages', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_langstax]">
            <option value="disable" <?php selected($this->option('enable_langstax'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_langstax'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="tax_separator">
    <div class="left">
        <?php _e('Taxonomy terms separator', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Characters dividing taxonomy terms', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <input type="text" name="songbook[tax_separator]" value="<?php echo $this->option('tax_separator'); ?>">
    </div>
</div>

<div class="field" id="enable_comments">
    <div class="left">
        <?php _e('Enable song comments', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Allows users to add comments to song (it may be set also differently for each song, if this is enabled)', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_comments]">
            <option value="disable" <?php selected($this->option('enable_comments'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_comments'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_filelinking">
    <div class="left">
        <?php _e('Allow file linking', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds extra field for attaching files to the song', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_filelinking]">
            <option value="disable" <?php selected($this->option('enable_filelinking'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_filelinking'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_setvideolink">
    <div class="left">
        <?php _e('Allow adding video link', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds extra field for song video link (Youtube)', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_setvideolink]">
            <option value="disable" <?php selected($this->option('enable_setvideolink'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_setvideolink'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<?php
if(1===2){
    //disable planned features
?>

<div class="field" id="enable_playlists">
    <div class="left">
        <?php _e('Allow using playlists', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', 'wp-songbook'); ?><br/><br/>
        <?php _e('Adds new post type, that may make song lists (more songs together in custom order)', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_playlists]">
            <option value="disable" <?php selected($this->option('enable_playlists'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_playlists'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_sbwidget">
    <div class="left">
        <?php _e('Allow using sidebar widget', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', 'wp-songbook'); ?><br/><br/>
        <?php _e('Adds new widget to display songbook info. You can find it on the Themes -> Widgets page', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_sbwidget]">
            <option value="disable" <?php selected($this->option('enable_sbwidget'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_sbwidget'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="enable_sswidget">
    <div class="left">
        <?php _e('Allow Songside widgets', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Still in development, use at your own risk :)', 'wp-songbook'); ?><br/><br/>
        <?php _e('Adds opportunity to add useful informations to the bottom of the song content (you can specify here and also in editor for current song)', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[enable_sswidget]">
            <option value="disable" <?php selected($this->option('enable_sswidget'), 'disable'); ?>><?php _e('Disable','wp-songbook'); ?>
            <option value="enable" <?php selected($this->option('enable_sswidget'), 'enable'); ?>><?php _e('Enable','wp-songbook'); ?>
        </select>
    </div>
</div>
<?php
}