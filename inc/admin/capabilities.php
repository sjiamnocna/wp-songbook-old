<div class="field" id="mincap_cpt_display">
    <div class="left">
        <?php _e('Show Songs menu', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to even see the "Songs" menu', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_cpt_display]">
            <option value="manage_options" <?php selected($this->option('mincap_cpt_display'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_cpt_display'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_cpt_display'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_cpt_display'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_cpt_display'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_addfiles">
    <div class="left">
        <?php _e('Add files or video link to songs', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to add files or video links to the songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_addfiles]">
            <option value="manage_options" <?php selected($this->option('mincap_addfiles'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_addfiles'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_addfiles'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_addfiles'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_addfiles'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_seeprivatefiles">
    <div class="left">
        <?php _e('Add files or video link to songs', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to add files or video links to the songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_seeprivatefiles]">
            <option value="manage_options" <?php selected($this->option('mincap_seeprivatefiles'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_seeprivatefiles'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_seeprivatefiles'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_seeprivatefiles'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_seeprivatefiles'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<?php
    //disable whats not needed
    if(1===2):
?>
<div class="field" id="mincap_manauthors">
    <div class="left">
        <?php _e('Add and edit song taxonomies (authors, albums, genres, languages)', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to add and edit song taxonomies like Authors, Albums, Genres or Languages', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_manauthors]">
            <option value="manage_options" <?php selected($this->option('mincap_manauthors'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_manauthors'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_manauthors'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_manauthors'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_manauthors'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>
<?php
    endif;
?>


<?php
    //disable whats not needed
    if(1===2):
?>
<div class="field" id="mincap_ssidebar_control">
    <div class="left">
        <?php _e('Update song widget settings', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to set content of the song widgets', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_ssidebar_control]">
            <option value="manage_options" <?php selected($this->option('mincap_ssidebar_control'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_ssidebar_control'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_ssidebar_control'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_ssidebar_control'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_ssidebar_control'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="mincap_playlists">
    <div class="left">
        <?php _e('Add or edit playlists', 'wp-songbook'); ?>

        <div class="note">
            <?php _e('Choose minimal permission, which user needs to be able to add or edit playlists', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[mincap_playlists]">
            <option value="manage_options" <?php selected($this->option('mincap_playlists'), 'manage_options'); ?>><?php _e('Manage options', 'wp-songbook'); ?>
            <option value="read_private_pages" <?php selected($this->option('mincap_playlists'), 'read_private_pages'); ?>><?php _e('Read private pages', 'wp-songbook'); ?>
            <option value="publish_posts" <?php selected($this->option('mincap_playlists'), 'publish_posts'); ?>><?php _e('Publish posts', 'wp-songbook'); ?>
            <option value="edit_posts" <?php selected($this->option('mincap_playlists'), 'edit_posts'); ?>><?php _e('Edit posts', 'wp-songbook'); ?>
            <option value="read" <?php selected($this->option('mincap_playlists'), 'read'); ?>><?php _e('Read', 'wp-songbook'); ?>
        </select>
    </div>
</div>
<?php
endif;