<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Dalux_leak
 * @since Dalux Lea
 */

?><!DOCTYPE html>
<?php global $dalux_options;?>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php if(isset($dalux_options['meta_author']) && $dalux_options['meta_author']!='') : ?>
    <meta name="author" content="<?php echo esc_attr($dalux_options['meta_author']); ?>">
    <?php else: ?>
    <meta name="author" content="<?php esc_attr(bloginfo('name')); ?>">
    <?php endif; ?>
    <?php if(isset($dalux_options['meta_author']) && $dalux_options['meta_desc']!='') : ?>
    <meta name="description" content="<?php echo esc_attr($dalux_options['meta_desc']); ?>">
    <?php endif; ?>
    <?php if(isset($dalux_options['meta_author']) && $dalux_options['meta_keyword']!='') : ?>
    <meta name="keyword" content="<?php echo esc_attr($dalux_options['meta_keyword']); ?>">
    <?php endif; ?>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php endif; ?>
    <title><?php wp_title( ' | ', true, 'right' );?></title>
    <?php if(isset($dalux_options['favicon']['url'])) :  ?>
    <link rel="shortcut icon" href="<?php echo esc_url($dalux_options['favicon']['url']); ?>">
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<?php if(is_singular()):
    $class="dalux-single-post-template";
  else:
    $class="tbeer-home-template";
endif;?>
<body <?php body_class($class);?>>
  <?php
  $sticky = '';
        if( $dalux_options['sticky'] == 1 ){
          $sticky = __('navbar-fixed-top','dalux');
          $main=__('main-class','dalux');
        }

  ?>
  <header class="tbeer-header">
    <nav class="navbar tbeer-main-menu" role="navigation">
    <!-- Top Bar -->
        <div class="container-fluid">
              <div class="container">
                <div class="row">
                  <!-- Navbar Toggle -->
                    <div class="navbar-header">
                      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                          <span class="icon-bar"></span>
                      </button>
                      <!-- Logo -->
                        <a class="navbar-brand" href="<?php echo esc_url( home_url( '/' ) ); ?>">
                          <?php if($dalux_options['logo']!=""):?>
                              <img class="logo" src="<?php echo esc_url($dalux_options['logo']['url']);?>" data-at2x="<?php echo esc_url($dalux_options['retina']['url']); ?>" alt="<?php bloginfo( 'name' ); ?>">
                          <?php else:?>
                              <?php bloginfo( 'name' ); ?>
                          <?php endif;?>
                        </a>
                    </div>
                     <div id="nav-menu" class="navbar-collapse tbeer-menu-wrapper collapse" role="navigation">                
                      <?php
                        wp_nav_menu( array(
                        'theme_location'    => 'primary',
                        'container'         => '',
                        'container_class'   => '',
                        'container_id'      => 'bs-example-navbar-collapse-1',
                        'menu_class'        => 'nav navbar-nav tbeer-menus',
                        'fallback_cb'       => 'dalux_bootstrap_navwalker::fallback',
                        'walker'            => new dalux_bootstrap_navwalker())
                        );?>
                    </div>
                    <div class="tbeer-social-and-search-wrapper">           
                    <?php
                      $facebook=$dalux_options['social_facebook'];
                      $twitter=$dalux_options['social_twitter'];
                      $google=$dalux_options['social_googlep'];
                      $youtube=$dalux_options['social_youtube'];
                      if($facebook!=""&& $twitter!="" && $google!="" && $youtube!=""):?>
                         <div class="tbeer-social-links">
                            <ul>
                              <?php if($facebook):?>
                                  <li><a href="<?php echo esc_url($facebook);?>" target="_blank" class="tbeer-facebook"><i class="fa fa-facebook"></i></a></li>
                              <?php endif; if($twitter):?>
                                  <li><a href="<?php echo esc_url($twitter);?>" target="_blank" class="tbeer-twitter"><i class="fa fa-twitter"></i></a></li>
                              <?php endif; if($google):?>
                                  <li><a href="<?php echo esc_url($google);?>" target="_blank" class="tbeer-google-plus"><i class="fa fa-google-plus"></i></a></li>
                              <?php endif; if($youtube):?>
                                  <li><a href="<?php echo esc_url($youtube);?>" target="_blank" class="tbeer-youtube"><i class="fa fa-youtube-play"></i></a></li>
                              <?php endif;?>
                            </ul>
                        </div>
                      <?php endif;?>                
                      <!-- Social Icons End -->
                   <?php if(isset($dalux_options['search'])&&$dalux_options['search']==1):?>
                      <div class="tbeer-header-search-wrapper"> 
                          <div class="tbeer-search-form-wrapper">
                            <form role="search" method="get" role="search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                                <input type="text" id="dalux-search" placeholder="Search The Site..." name="s">                            
                              <button type="submit"><i class="ion-ios-search-strong"></i></button>  
                          </form>
                        </div>
                      </div>
                    <?php endif;?>
                      <!-- Social Icons -->
                  </div>
               </div>
            </div>
        </div>        
    </nav>
  </header>