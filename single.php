<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); ?>
<?php global $dalux_options; dalux_setPostViews(get_the_ID());?>
<section class="dalux-latest-article-section dalux-section dalux-single-post-section">
    <div class="container">
        <div class="row">
            <?php
                if (have_posts()) :
                    echo '<div class="dalux-main-content col-md-8 col-sm-8 col-xs-12">';
                    while (have_posts()) : the_post();
                        get_template_part('partials/article');
                        if(isset($dalux_options['author_detail']) && $dalux_options['author_detail']==1)
                            get_template_part('partials/article-author');
                        if(isset($dalux_options['related_post']) && $dalux_options['related_post']==1)
                            get_template_part('partials/article-related-posts');
                        comments_template( '', true );
                    endwhile;
                    echo '</div>';
                endif;?>
            <?php if(isset($dalux_options['single_blog']) && $dalux_options['single_blog']==1):?>
                 <div class="dalux-sidebar-wrapper col-md-4 col-sm-4 col-xs-12">
                    <?php if ( is_active_sidebar( 'dalux-post-sidebar' ) ) {
                        dynamic_sidebar( 'dalux-post-sidebar' );
                     } ?>
                    <div class="dalux-sidebar">
                         <?php if ( is_active_sidebar( 'dalux-widgets-sidebar' ) ) {
                            dynamic_sidebar( 'dalux-widgets-sidebar' );
                         } ?><?php if ( is_active_sidebar( 'dalux-trending-sidebar' ) ) {
                            dynamic_sidebar( 'dalux-trending-sidebar' );
                         } ?>
                    </div>
                </div>
            <?php endif;?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>