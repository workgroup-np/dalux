<?php // Exit if accessed directly
if (!defined('ABSPATH')) {echo '<h1>Forbidden</h1>'; exit();} $pageid=get_the_ID();global $dalux_options;  ?>
    <!-- FOOTER -->
        <footer>
            <!-- Footer Top -->
            <div class="dalux-footer-top">
                <div class="container">
                    <div class="row">
                        <!-- Fixed Widget -->
                        <div class="dalux-fixed-widget col-md-7 col-sm-6 col-xs-12">
                            <!-- About Us widget -->
                            
                            <div class="dalux-about-us-widget">
                                <?php if($dalux_options['footer_logo']['url']):?>
                                  <div class="dalux-logo-wrapper">
                                        <a href="<?php echo site_url('/');?>"><img src="<?php echo esc_url($dalux_options['footer_logo']['url']);?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
                                  </div>
                                <?php endif;?>         
                                <div class="dalux-about-details-wrapper">
                                     <p><?php echo wp_kses_post($dalux_options['footer_text']);?></p>
                                </div>
                                <?php if(isset($dalux_options['footer_icons']) && $dalux_options['footer_icons']==1):
                                $facebook=$dalux_options['social_facebook'];
                                $twitter=$dalux_options['social_twitter'];
                                $google=$dalux_options['social_googlep'];
                                $youtube=$dalux_options['social_youtube'];?>
                                <div class="dalux-social-links">
                                    <ul>
                                      <?php if($facebook):?>
                                          <li><a href="<?php echo esc_url($facebook);?>" target="_blank" class="dalux-facebook"><i class="fa fa-facebook"></i></a></li>
                                      <?php endif; if($twitter):?>
                                          <li><a href="<?php echo esc_url($twitter);?>" target="_blank" class="dalux-twitter"><i class="fa fa-twitter"></i></a></li>
                                      <?php endif; if($google):?>
                                          <li><a href="<?php echo esc_url($google);?>" target="_blank" class="dalux-google-plus"><i class="fa fa-google-plus"></i></a></li>
                                      <?php endif; if($youtube):?>
                                          <li><a href="<?php echo esc_url($youtube);?>" target="_blank" class="dalux-youtube"><i class="fa fa-youtube-play"></i></a></li>
                                      <?php endif;?>
                                    </ul>
                                </div>
                              <?php endif;?>
                            </div>
                            <!-- End -->
                        </div>
                        <!-- End -->

                        <!-- Footer Widget -->
                        <div class="dalux-footer-widgets-area col-md-5 col-sm-6 col-xs-12">
                             <?php if (!function_exists('dynamic_sidebar') || !dynamic_sidebar('dalux-widgets-footer-block-1')) : ?>
                                <?php get_sidebar('dalux-widgets-footer-block-1');?>
                            <?php endif; ?> 
                        </div>
                        <!-- End -->
                    </div>
                </div>
            </div>
            <!-- Footer Top End -->

            <!-- Footer Bottom -->
            <div class="dalux-footer-bottom">
                <div class="container">
                    <div class="row">
                     <?php if($dalux_options['footer_copyright']):?>
                        <div class="dalux-copyright-info">
                            <p><?php echo wp_kses_post($dalux_options['footer_copyright']);?></p>
                        </div>
                    <?php endif;?>
                        <div class="dalux-footer-menu">
                            <?php
                                wp_nav_menu( array(
                                'theme_location'    => 'secondary',
                                'container'         => '',
                                'container_class'   => '',
                                'container_id'      => 'bs-example-navbar-collapse-1',
                                'menu_class'        => '',
                                'fallback_cb'       => 'dalux_bootstrap_navwalker::fallback',
                                'walker'            => new dalux_bootstrap_navwalker())
                                );
                            ?> 
                        </div>
                    </div>
                </div>
            </div>
            <!-- End -->
        </footer>
        <!-- FOOTER END -->
</div>
<?php if(isset($dalux_options['meta_javascript']) && $dalux_options['meta_javascript']!='')
echo wp_kses_post($dalux_options['meta_javascript']); ?>
<?php wp_footer(); ?>
<script type="text/javascript">
jQuery('body').on('click','#loadmore a',function(){
    var paged = jQuery('#paged').val();
    var next_num =parseInt(paged)+1;
    jQuery('#paged').val(next_num);
    var max_paged =jQuery('#max_paged').val();
    console.log(max_paged);
    if(parseInt(paged)>parseInt(max_paged))
    {
      return false;
    }
      jQuery.ajax({
        url: '<?php echo esc_url( get_template_directory_uri() );?>/inc/ajax.php',
        type: 'POST',
        data: 'action_type=loadmore&paged='+paged,
        beforeSend:function(xhr){
          jQuery('#loadmore a').html('Loading..');
        }
      })
      .done(function(result) {
        console.log(result);
        jQuery("#latest_post").append(result);
        if (parseInt(paged) == parseInt(max_paged))
        {
          jQuery("#loadmore a").hide();
          jQuery("#loadmore a").html('Load More');
        }
        else
        {
          jQuery("#loadmore a").show();
          jQuery("#loadmore a").html('Load More');
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
});
jQuery('body').on('click','#loadmore_cat a',function(){
    var paged = jQuery('#paged').val();var cat_id = jQuery('#cat_id').val();
    var next_num =parseInt(paged)+1;
    jQuery('#paged').val(next_num);
    var max_paged =jQuery('#max_paged').val();
    console.log(max_paged);
    if(parseInt(paged)>parseInt(max_paged))
    {
      return false;
    }
      jQuery.ajax({
        url: '<?php echo esc_url( get_template_directory_uri() );?>/inc/ajax.php',
        type: 'POST',
        data: 'action_type=loadmore_cat&cat_id='+cat_id+'&paged='+paged,
        beforeSend:function(xhr){
          jQuery('#loadmore_cat a').html('Loading..');
        }
      })
      .done(function(result) {
        console.log(result);
        jQuery("#latest_post").append(result);
        if (parseInt(paged) == parseInt(max_paged))
        {
          jQuery("#loadmore_cat a").hide();
          jQuery("#loadmore_cat a").html('Load More');
        }
        else
        {
          jQuery("#loadmore_cat a").show();
          jQuery("#loadmore_cat a").html('Load More');
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
});
</script>
    </body>
</html>