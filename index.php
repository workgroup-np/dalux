<?php 
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} get_header(); global $dalux_options; ?>
<?php if ( is_active_sidebar( 'dalux-banner-sidebar' ) ) : 
    dynamic_sidebar('dalux-banner-sidebar');
endif;
$trending_args=array('posts_per_page'=>4,'meta_key'=>'post_views_count','orderby'=>'meta_value_num','order'=>'DESC');
global $wpdb;
$trending_query= new WP_Query($trending_args);
if($trending_query->have_posts()): 
echo '<section class="dalux-trending-news-section"><h3 class="dalux-section-heading">Trending Now</h3>
<div class="dalux-trending-news-wrapper"><ul id="dalux-news-ticker">';
            while($trending_query->have_posts()):
                $trending_query->the_post();
                    $view=get_post_meta(get_the_ID(),'post_views_count',true);
                    if($view!=0)
                    echo '<li><a href="'.get_the_permalink().'">'.get_the_title().'</a></li>';

            endwhile;
        echo '</ul></div></section>';
endif; wp_reset_postdata();?>
  <!-- LATEST ARTICLE SECTION -->
        <section class="dalux-latest-article-section dalux-section">
            <div class="container">
                <div class="row">
                    <?php $posts_per_page=6;
                    $latest_args = array( 'posts_per_page' => $posts_per_page, 'order'=> 'DESC', 'orderby' => 'date' );
                    $lateset_posts = new WP_Query( $latest_args );
                    if($lateset_posts->have_posts()): 
                        echo '<div class="dalux-main-content col-md-8 col-sm-8 col-xs-12">
                                <h3 class="dalux-section-title">Latest Articles</h3>
                                    <div id="latest_post" class="dalux-latest-article-wrapper">';
                                        while ( $lateset_posts->have_posts()) : $lateset_posts->the_post();?>
                                             <!-- Latest Article -->
                                            <div class="dalux-latest-article">
                                            <?php
                                                $thumbnail = get_post_thumbnail_id($post->ID);
                                                $img_url = wp_get_attachment_image_src( $thumbnail,'full');
                                                $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
                                            if($img_url):
                                                $n_img = aq_resize( $img_url[0], $width =315, $height = 315, $crop = true, $single = true, $upscale = true ); ?>
                                                <div class="dalux-image-wrapper">
                                                    <img src="<?php echo esc_url($n_img);?>" alt="<?php echo esc_attr($alt);?>">
                                                </div>
                                            <?php else:
                                            $img_url=get_template_directory_uri().'/assets/images/no-image.png';
                                            $n_img = aq_resize( $img_url, $width =315, $height = 315, $crop = true, $single = true, $upscale = true );?>
                                                <div class="dalux-image-wrapper">
                                                    <img src="<?php echo esc_url($img_url);?>" alt="No image">
                                                </div>
                                            <?php endif;?>
                                                <div class="dalux-latest-article-details">
                                                    <div class="dalux-category-meta"> <?php if (get_the_category()) : ?><?php the_category(' / ');endif; ?></div>
                                                    <h3 class="dalux-news-post-heading">
                                                        <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                    </h3>
                                                    <p class="dalux-news-post-excerpt"><?php echo robto_the_excerpt_max_charlength(150);?></p>
                                                    <div class="dalux-news-post-meta">
                                                        <span class="dalux-news-post-date"><?php echo date("m.d.y");  ?></span>
                                                        <div class="dalux-news-post-author"><?php the_author_posts_link(); ?></div>
                                                    </div>
                                                </div>
                                                <!-- End -->
                                            </div>
                                            <!-- End -->
                                        <?php 
                                        endwhile;
                                    echo '</div>';
                                if($lateset_posts->found_posts<=$posts_per_page)
                                {
                                  $style="display:none";
                                }
                                $total_post = $lateset_posts->found_posts;
                                $raw_page = $total_post%$posts_per_page;
                                if($raw_page==0){$page_count_raw = $total_post/$posts_per_page; }else{$page_count_raw = $total_post/$posts_per_page+1;}
                                   $page_count = floor($page_count_raw);
                                          ?>
                                <div class="dalux-load-more-wrapper" id="loadmore" style="<?php echo $style;?>">
                                    <input type="hidden" value="2" id="paged">
                                    <input type="hidden" value="<?php echo $posts_per_page?>" id="post_per_page">
                                    <input type="hidden" value="<?php echo $page_count;?>" id="max_paged">
                                    <a href="javascript:void(0);" class="dalux-btn dalux-outline-btn dalux-load-more">Load More</a>
                                </div><?php
                            echo'</div>';
                    endif;
                    wp_reset_postdata();?>
                    <!-- Sidebar -->
                    <div class="dalux-sidebar-wrapper col-md-4 col-sm-4 col-xs-12">
                        <div class="dalux-sidebar">
                            <?php if ( is_active_sidebar( 'dalux-widgets-sidebar' ) ) : 
                                dynamic_sidebar('dalux-widgets-sidebar');
                            endif;
                            if ( is_active_sidebar( 'dalux-trending-sidebar' ) ) : 
                                dynamic_sidebar('dalux-trending-sidebar');
                            endif;
                            ?>
                        </div>
                    </div>
                    <!-- End -->
                </div>
            </div>
        </section>
        <!-- LATEST ARTICLE SECTION END -->
         <!-- MUST READ SECTION -->
         <?php if(isset($dalux_options['must_read'])&& $dalux_options['must_read']==1):?>
            <section class="dalux-must-read-news-section dalux-section">
                <div class="container">
                    <div class="row">
                        <div class="dalux-section-title-wrapper">
                            <h3 class="dalux-section-btn-style-title"><?php _e('Must Read','robto');?></h3>
                        </div>
                        <div class="dalux-main-content">
                             <?php
                             $header_args=array(
                                'post_type'=>'post',
                                'posts_per_page'=>esc_attr($dalux_options['right_must_read']),
                                'orderby' => 'date',
                                'order'   => 'DESC',
                                'meta_query' => array(
                                    array(
                                        'key'     => '_dalux_must',
                                        'value'   => 'on',
                                        'compare' => '=',
                                    ),
                                ),
                            );
                            $header_query= new WP_Query($header_args);
                                $header_query= new WP_Query($header_args);
                                if($header_query->have_posts()):$i=1;
                                    echo ' <div class="dalux-numbered-news-post-wrapper col-md-5 col-sm-6 col-xs-12">';
                                    while($header_query->have_posts()):
                                    $header_query->the_post(); ?>
                                        <div class="dalux-numbered-news-post">
                                            <span class="dalux-post-number"><?php echo $i;?></span>
                                            <h3 class="dalux-news-post-heading">
                                                <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                            </h3>
                                        </div>
                                     <?php $i++;
                                    endwhile;
                                echo '</div>';
                            endif;
                            wp_reset_postdata();
                             $header_args=array(
                                'post_type'=>'post',
                                'posts_per_page'=>esc_attr($dalux_options['left_must_read']),
                                'orderby' => 'date',
                                'order'   => 'DESC',
                                'offset' =>esc_attr($dalux_options['right_must_read']),
                                'meta_query' => array(
                                    array(
                                        'key'     => '_dalux_must',
                                        'value'   => 'on',
                                        'compare' => '=',
                                    ),
                                ),
                            );
                            $header_query= new WP_Query($header_args);
                                $header_query= new WP_Query($header_args);
                                if($header_query->have_posts()):$i=1;
                                    echo '<div class="dalux-must-read-news-wrapper col-md-7 col-sm-6 col-xs-12">';
                                    while($header_query->have_posts()):
                                    $header_query->the_post(); ?>
                                        <div class="dalux-must-read-news">
                                            <!-- Image -->
                                            <?php
                                                $thumbnail = get_post_thumbnail_id($post->ID);
                                                $img_url = wp_get_attachment_image_src( $thumbnail,'full');
                                                $alt = get_post_meta($thumbnail, '_wp_attachment_image_alt', true);
                                            if($img_url):
                                                $n_img = aq_resize( $img_url[0], $width =220, $height = 220, $crop = true, $single = true, $upscale = true ); ?>
                                                <div class="dalux-image-wrapper">
                                                    <img class="hidden-xs hidden-sm" src="<?php echo esc_url($url);?>" alt="<?php echo esc_attr($alt);?>">
                                                    <img class="hidden-md" src="<?php echo esc_url($img_url[0]);?>" alt="<?php echo esc_attr($alt);?>">                                                  
                                                </div>
                                            <?php else:
                                            $img_url=get_template_directory_uri().'/assets/images/no-image.png';
                                            $n_img = aq_resize( $img_url[0], $width =220, $height = 220, $crop = true, $single = true, $upscale = true );?>
                                            <div class="dalux-image-wrapper">
                                                    <img class="hidden-xs hidden-sm" src="<?php echo esc_url($url);?>" alt="<?php echo esc_attr($alt);?>">
                                                    <img class="hidden-md" src="<?php echo esc_url($img_url);?>" alt="<?php echo esc_attr($alt);?>">
                                            </div>
                                            <?php endif;?>
                                            <div class="dalux-must-read-news-details">
                                                <span class="dalux-category-meta"> <?php if (get_the_category()) : ?><?php the_category(' / ');endif; ?></span>
                                                <h3 class="dalux-news-post-heading">
                                                    <a href="<?php the_permalink();?>"><?php the_title();?></a>
                                                </h3>
                                                <div class="dalux-news-post-meta">
                                                    <span class="dalux-news-post-date"><?php echo date("m.d.y");  ?></span>
                                                    <div class="dalux-news-post-author"><?php the_author_posts_link(); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                     <?php $i++;
                                    endwhile;
                                echo '</div>';
                            endif;
                            wp_reset_postdata();                          
                            ?>                      
                        </div>
                    </div>
                </div>
            </section>
        <?php endif;?>
<?php get_footer(); ?>