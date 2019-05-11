<div class="content">
    <div class="left">
        <div class="text">
            <?php
            $items=array(
                array(wp_count_posts('song')->publish,__('songs published','wp-songbook')),
                ($this->option('enable_authorstax')==='enable')?array(wp_count_terms('songauthor'),(wp_count_terms('songauthor')>1)?__('Authors','wp-songbook'):__('Author','wp-songbook')):false,
                ($this->option('enable_albumstax')==='enable')?array(wp_count_terms('songalbum'),(wp_count_terms('songalbum')>1)?__('Albums','wp-songbook'):__('Album','wp-songbook')):false,
                ($this->option('enable_genrestax')==='enable')?array(wp_count_terms('songgenre'),(wp_count_terms('songgenre')>1)?__('Genress','wp-songbook'):__('Genre','wp-songbook')):false
            );
            
            echo'<table>';
                
                for($i=0;$i<count($items);$i++){
                    if($items[$i])echo'<tr><td>'.$items[$i][0].'</td><td>'.$items[$i][1].'</td></tr>';
                }
            
            echo'</table>';
            ?>
        </div>
        <div class="text">
            <p class="title"><?php _e('Wordpress Songbook', 'wp-songbook'); ?> v. <?php echo(WPSB_VERSION); ?></p>
            <?php _e('You may use these pages to set the behavior of the plugin. Just choose part that you would like to change on the right.', 'wp-songbook'); ?>
        </div>
    </div>
    <div class = "right">
        
    </div>
</div>