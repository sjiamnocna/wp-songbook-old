<div class="field" id="disp_backtolistinsong">
    <div class="left">
        <?php _e('Display link back to songlist', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Adds link to the page set for the song list above the lyrics', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_backtolistinsong]">
            <option value="false" <?php selected($this->option('disp_backtolistinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_backtolistinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_yearinsong">
    <div class="left">
        <?php _e('Display year', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Displays year of publication of the song', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_yearinsong]">
            <option value="false" <?php selected($this->option('disp_yearinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_yearinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_filelistinsong">
    <div class="left">
        <?php _e('Display attached files', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Shows attached file list in songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_filelistinsong]">
            <option value="false" <?php selected($this->option('disp_filelistinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_filelistinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_filelistforlogged">
    <div class="left">
        <?php _e('Display files only for members', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Files after inserting into song will automatically get set to show to public visitors or only to logged-in members (it can be changed for each file)', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_filelistforlogged]">
            <option value="private" <?php selected($this->option('disp_filelistforlogged'), 'private'); ?>><?php _e('To users only','wp-songbook'); ?>
            <option value="public" <?php selected($this->option('disp_filelistforlogged'), 'public'); ?>><?php _e('To all visitors','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_videolinkinsong">
    <div class="left">
        <?php _e('Display video link', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Choose to display video link and where', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_videolinkinsong]">
            <option value="none" <?php selected($this->option('disp_videolinkinsong'), 'none'); ?>><?php _e('Dont display', 'wp-songbook'); ?>
            <option value="head" <?php selected($this->option('disp_videolinkinsong'), 'head'); ?>><?php _e('Display in songs head (together with authors etc.)', 'wp-songbook'); ?>
            <option value="embed_below" <?php selected($this->option('disp_videolinkinsong'), 'embed_below'); ?>><?php _e('Embed (below lyrics)', 'wp-songbook'); ?>
            <option value="within_files" <?php selected($this->option('disp_videolinkinsong'), 'within_files'); ?>><?php _e('In the file list', 'wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_authorsinsong">
    <div class="left">
        <?php _e('Display authors in songs', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Display authors in songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_authorsinsong]">
            <option value="false" <?php selected($this->option('disp_authorsinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_authorsinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_genresinsong">
    <div class="left">
        <?php _e('Display genres in song lyrics page', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Display genres in songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_genresinsong]">
            <option value="false" <?php selected($this->option('disp_genresinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_genresinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_albumsinsong">
    <div class="left">
        <?php _e('Display albums in songs', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Display album in songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_albumsinsong]">
            <option value="false" <?php selected($this->option('disp_albumsinsong'), 'false'); ?>><?php _e('Don\'t display','wp-songbook'); ?>
            <option value="display" <?php selected($this->option('disp_albumsinsong'), 'display'); ?>><?php _e('Display','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_lyrelement">
    <div class="left">
        <?php _e('Lyrics wrapper', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Select element which should wrap the song lyrics', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_lyrelement]">
            <option value="none" <?php selected($this->option('disp_lyrelement'), 'none'); ?>><?php _e('No element','wp-songbook'); ?>
            <option value="div" <?php selected($this->option('disp_lyrelement'), 'div'); ?>><?php _e('Div','wp-songbook'); ?>
            <option value="blockquote" <?php selected($this->option('disp_lyrelement'), 'blockquote'); ?>><?php _e('Blockquote','wp-songbook'); ?>
            <option value="pre" <?php selected($this->option('disp_lyrelement'), 'pre'); ?>><?php _e('Preformated','wp-songbook'); ?>
            <option value="code" <?php selected($this->option('disp_lyrelement'), 'code'); ?>><?php _e('Code','wp-songbook'); ?>
        </select>
    </div>
</div>

<div class="field" id="disp_prevnext">
    <div class="left">
        <?php _e('Remove prev/next post links', 'wp-songbook'); ?>
               
        <div class="note">
        <?php _e('Allows you to remove the default theme\'s built-in Previous and Next post links when displaying songs', 'wp-songbook'); ?>
        </div>
    </div>
    <div class="right">
        <select name="songbook[disp_prevnext]">
            <option value="false" <?php selected($this->option('disp_prevnext'), 'false'); ?>><?php _e('Keep it','wp-songbook'); ?>
            <option value="true" <?php selected($this->option('disp_prevnext'), 'true'); ?>><?php _e('Remove it','wp-songbook'); ?>
        </select>
    </div>
</div>