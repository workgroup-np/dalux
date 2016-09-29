<?php // Exit if accessed directly



if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} ?>
 <!-- Author Details -->
    <div class="dalux-author-details-section">
        <h3 class="dalux-wrapper-title"><?php _e('About The Author','dalux');?></h3>

        <div class="dalux-author-wrapper dalux-single-wrapper">
            <div class="dalux-author-img">
                <?php echo str_replace('avatar-130', 'media-object pull-left', get_avatar(get_the_author_meta('email'),130 )); ?>
            </div>

            <div class="dalux-author-details">
                <h3>
                    <?php the_author(); ?>
                </h3>
                <p><?php the_author_meta('description'); ?></p>
            </div>
        </div>
    </div>
    <!-- Author Details End -->