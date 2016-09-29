<?php
require_once("../../../../wp-load.php");
global $wpdb;
$html="";$height="";$width="";
$paged=$_POST['paged'];
if($_POST['action_type'] == 'loadmore' ){    
     $posts_per_page=6; $h='315';$w='315';
    $args_ajax = array(
        'posts_per_page'   => $posts_per_page,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'paged' => $paged,
        'post_type'        => 'post',

    );
}
if($_POST['action_type'] == 'loadmore_cat' ){    
    $posts_per_page=6; $h='315';$w='315';
    $cat_id=$_POST['cat_id'];
    $args_ajax = array(
        'posts_per_page'   => $posts_per_page,
        'orderby'          => 'date',
        'order'            => 'DESC',
        'paged' => $paged,
        'post_type'        => 'post',
        'cat'=>$cat_id

    );
}

    $query_ajax = new WP_Query($args_ajax);
    while($query_ajax->have_posts()): $query_ajax->the_post();
        $image=wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()),'full');
        $thumb_id = get_post_thumbnail_id(get_the_ID());
        $alt = get_post_meta($thumb_id, '_wp_attachment_image_alt', true);
        $categories = get_the_category();
        $separator = ' / ';
        $output = '';
        if ( ! empty( $categories ) ) {
            foreach( $categories as $category ) {
                $output .= '<a class="dalux-category-meta" href="' . esc_url( get_category_link( $category->term_id ) ) . '" alt="' . esc_attr( sprintf( __( 'View all posts in %s', 'dalux' ), $category->name ) ) . '">' . esc_html( $category->name ) . '</a>' . $separator;
            }
        }
        if($image){
          $url = aq_resize( $image[0], $width =$w, $height = $h, $crop = true, $single = true, $upscale = true );
          $text=$alt;
        }
        else{
          $url=get_template_directory_uri().'/assets/images/no-image.png';
          $text='No Image';
        }
        $html=' <div class="dalux-latest-article"><div class="dalux-image-wrapper"><img src="'.esc_url($url).'" alt="'.esc_attr($text).'"></div><div class="dalux-latest-article-details">'.trim( $output, $separator ).'<h3 class="dalux-news-post-heading"><a href="'.get_the_permalink().'">'.get_the_title().'</a></h3><p class="dalux-news-post-excerpt">'.robto_the_excerpt_max_charlength(150).'</p><div class="dalux-news-post-meta"><span class="dalux-news-post-date">'.date("m.d.y").'</span><div class="dalux-news-post-author">'.get_the_author_posts_link().'</div></div></div></div>';

    endwhile;
    echo $html;
    wp_reset_postdata();