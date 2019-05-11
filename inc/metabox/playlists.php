<span class="label">
    <?php
    $taggedin = $values['playlist'];
    $playlists = get_posts(array(
        'post_type' => 'playlist',
        'posts_per_page' => 5
    ));
    
    if ($taggedin)
        _e('Song is already a part of these playlists:', 'wp-songbook');
    else
        _e('Song hasn\'t been added to any playlist yet', 'wp-songbook');
    ?>
</span>