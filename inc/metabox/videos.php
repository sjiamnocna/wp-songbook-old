<?php
$link = get_post_meta($post->ID,'video_link',true);
?>
<span class="label"><?php _e('Enter video URL', 'wp-songbook'); ?></span>
<input type="text" name="songbook[video_link]" value="<?php if($link) echo $link; ?>" class="url"/>