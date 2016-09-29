 <?php get_header(); global $dalux_options; ?>
 <section class="dalux-latest-article-section dalux-section dalux-category-post-section">
    <div class="container">
        <div class="row">
         <?php
          $category=get_queried_object(); $paged = (get_query_var('paged')) ? get_query_var('paged') : 1; 
          $total_pages=$wp_query->max_num_pages;
          $posts_per_page=6;
          $cat_args=array('posts_per_page' => $posts_per_page, 'order'=> 'DESC', 'orderby' => 'date','cat'=>$category->term_id );
			$cat_query= new WP_Query($cat_args);
			if($cat_query->have_posts()):
            echo '<div class="dalux-main-content col-md-8 col-sm-8 col-xs-12">
                    <h3 class="dalux-section-title">Category: '.$category->name.'</h3>
                      <div id="latest_post" class="dalux-latest-article-wrapper">';
                    while ($cat_query->have_posts()) :$cat_query->the_post();?>
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
          if($cat_query->found_posts<=$posts_per_page)
                  {
                    $style="display:none";
                  }
                  $total_post = $cat_query->found_posts;
                  $raw_page = $total_post%$posts_per_page;
                  if($raw_page==0){$page_count_raw = $total_post/$posts_per_page; }else{$page_count_raw = $total_post/$posts_per_page+1;}
                     $page_count = floor($page_count_raw);
                            ?>
                  <div class="dalux-load-more-wrapper" id="loadmore_cat" style="<?php echo $style;?>">
                      <input type="hidden" value="2" id="paged">
                      <input type="hidden" value="<?php echo $category->term_id;?>" id="cat_id">
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
<?php get_footer(); ?>