<span class="label"><?php _e('Song tempo (BPM)', 'wp-songbook'); ?></span>
<input type="text" name="songbook[tempo]" value="<?php echo $this->getmeta($post->ID,'tempo'); ?>"/>

<span class="label"><?php _e('Song duration (minutes)', 'wp-songbook'); ?></span>
<input type="text" name="songbook[duration]" value="<?php echo $this->getmeta($post->ID,'duration'); ?>"/>