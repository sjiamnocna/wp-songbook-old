<div class="field" id="text_backtolist">
    <?php _e('Back to list link text', 'wp-songbook'); ?>

    <div class="note">
        <?php _e('Sets the back to list link text', 'wp-songbook'); ?>
    </div>

    <textarea name="songbook[text_backtolist]"><?php echo $this->option('text_backtolist'); ?></textarea>

</div>

<div class="field" id="text_error_nothingfound">
    <?php _e('Nothing found text', 'wp-songbook'); ?>

    <div class="note">
        <?php _e('Sets text displayed when nothing was found for selected condition', 'wp-songbook'); ?>
    </div>

    <textarea name="songbook[text_error_nothingfound]"><?php echo $this->option('text_error_nothingfound'); ?></textarea>

</div>

<div class="field" id="text_list_default">
    <?php _e('Return back to list of songs', 'wp-songbook'); ?>

    <div class="note">
        <?php _e('Text of link displayed, to return to the list of all songs (if its displaying eg. songs of current author)', 'wp-songbook'); ?><br/>
        <?php _e('Leave blank if you don\'t want to show the link', 'wp-songbook'); ?>
    </div>

    <textarea name="songbook[text_list_default]"><?php echo $this->option('text_list_default'); ?></textarea>

</div>

<div class="field" id="text_error_disabled">
    <?php _e('Function disabled text', 'wp-songbook'); ?>

    <div class="note">
        <?php _e('Sets text displayed when required function of plugin is disabled at the moment', 'wp-songbook'); ?>
    </div>

    <textarea name="songbook[text_error_disabled]"><?php echo $this->option('text_error_disabled'); ?></textarea>

</div>

<div class="field" id="text_no_file">
    <?php _e('No file linked to song', 'wp-songbook'); ?>

    <div class="note">
        <?php _e('Sets text displayed instead of file list when no file is linked with song', 'wp-songbook'); ?>
    </div>

    <textarea name="songbook[text_no_file]"><?php echo $this->option('text_no_file'); ?></textarea>

</div>