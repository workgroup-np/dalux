<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); global $dalux_options;?>
 <section class="dalux-latest-article-section dalux-section dalux-category-post-section">
    <div class="container">
        <div class="row">
            <div class="dalux-latest-article-details">
                    <?php if (have_posts()) : ?>
                        <?php while (have_posts()) : the_post(); ?>
                            <span class="dalux-news-post-excerpt"><?php the_content(); ?>   </span>                         
                        <?php endwhile; ?>
                    <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>