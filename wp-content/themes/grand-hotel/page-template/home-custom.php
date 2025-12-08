<?php
/**
 * Template Name: Home Custom Page
 */
?>

<?php get_header(); ?>

<main id="main" role="main">
  <?php do_action( 'grand_hotel_above_slider' ); ?>

  <?php
    $grand_hotel_content_pages = array();
    for ($count = 1; $count <= 3; $count++) {
        $mod = intval(get_theme_mod('grand_hotel_slider_page' . $count));
        if ('page-none-selected' != $mod) {
            $grand_hotel_content_pages[] = $mod;
        }
    }

    if (!empty($grand_hotel_content_pages)) {
        $args = array(
            'post_type' => 'page',
            'post__in' => $grand_hotel_content_pages,
            'orderby' => 'post__in'
        );
        $query = new WP_Query($args);
    }
  ?>

  <section id="slider" class="m-0 p-0 "> 
    <div class="thumbnail_slider">
      <div id="primary_slider">
          <div class="splide__track">
              <ul class="splide__list">
                  <?php if ($query && $query->have_posts()): ?>
                      <?php while ($query->have_posts()): $query->the_post(); ?>
                          <li class="splide__slide">
                              <?php the_post_thumbnail(); ?>
                              <div class="slide-oly"></div>
                              <div class="slide-brd"></div>
                              <div class="slider-content">
                                <h2><?php the_title(); ?></h2>
                                <div class="brd1"></div>
                                  <p><?php echo esc_html(wp_trim_words(get_the_excerpt(), 20)); ?></p>
                                  <div class="R_more">
                                    <a href="<?php echo esc_url(get_theme_mod('grand_hotel_sliderbuttonlink')); ?>">
                                      <?php echo esc_html('Book Now', 'grand-hotel'); ?>
                                    </a>
                                  </div>
                              </div>
                          </li>
                      <?php endwhile; wp_reset_postdata(); ?>
                  <?php endif; ?>
              </ul>
          </div>
      </div>

      <div id="thumbnail_slider">
          <div class="splide__track">
              <ul class="splide__list">
                  <?php if ($query && $query->have_posts()): ?>
                      <?php while ($query->have_posts()): $query->the_post(); ?>
                          <li class="splide__slide">
                              <?php the_post_thumbnail('thumbnail'); ?>
                          </li>
                      <?php endwhile; wp_reset_postdata(); ?>
                  <?php endif; ?>
              </ul>
          </div>
      </div>
    </div>
  </section>


  <?php do_action( 'grand_hotel_below_slider' ); ?>

    <section id="services">
      <div class="container">
      
        <!-- </?php if(get_theme_mod('grand_hotel_btn_servicesheading') != ''){ ?> -->
          <div class="services-head">
            <h3> <i class="fa fa-circle" ></i> <?php echo esc_html(get_theme_mod('grand_hotel_btn_servicesheading')); ?>
            </h3>
          </div>
        <!-- </?php }?> -->
        <div class="servicesbx">
            <!-- <div id="services-con" >  -->
              <?php $grand_hotel_content_pages_services = array();
                for ( $count = 1; $count <= 4; $count++ ) {

                  $mod = intval( get_theme_mod( 'grand_hotel_services_page' . $count ));
                  if ( 'page-none-selected' != $mod ) {
                    $grand_hotel_content_pages_services[] = $mod;
                  }
                }
                if( !empty($grand_hotel_content_pages_services) ) :
                  $args = array(
                    'post_type' => 'page',
                    'post__in' => $grand_hotel_content_pages_services,
                    'orderby' => 'post__in'
                  );
                  $query = new WP_Query( $args );
                if ( $query->have_posts() ) :
                  $i = 1;

              ?>     

              <div class="row mr-0">
                <?php  while ( $query->have_posts() ) : $query->the_post(); ?>
                  <div class="col-lg-3 col-md-6 col-sm-6 feabx">
                      <div class="feabxinn">  
                          <div class="single-fea">               
                              <div class="imagebx">
                                  <?php the_post_thumbnail(); ?>
                              </div>
                              <div class="content">
                                  <h2><?php the_title(); ?></h2>
                                  <p>
                                    <?php $grand_hotel_excerpt = get_the_excerpt(); echo esc_html( grand_hotel_string_limit_words( $grand_hotel_excerpt,20 ) ); ?>
                                  </p>
                                  <div class="bttn">
                                    <a href="<?php echo esc_url(get_permalink()); ?>">
                                      <?php echo esc_html('Read More', 'grand-hotel'); ?>
                                      
                                      <i class="fa fa-long-arrow-right" aria-hidden="true"></i>
                                    </a>
                                  </div>
                              </div>
                            </div>
                      </div>
                  </div>
                <?php $i++; endwhile; 
                wp_reset_postdata();?>
              </div>
              <?php else : ?>
                <div class="no-postfound"></div>
              <?php endif;
              endif;?>
            <!-- </div>    -->
        </div>
        <div class="clearfix"></div>
      </div>
    </section>

  <?php do_action( 'grand_hotel_below_services' ); ?>

  <section id="aboutus">
    <div class="container">
      <div class="row">
        <div class="abt-imgbx">
            <div class="abt-img">
              <?php 
                $aboutus_image = get_theme_mod('aboutus_image');

                if(!empty($aboutus_image)){
                  echo '<img alt="'. esc_html(get_the_title()) .'" src="'.esc_url($aboutus_image).'" class="img-responsive secondry-bg-img" />';
                }else{
                  echo '<img alt="aboutus_image" src="' . esc_url(get_template_directory_uri() . '/assets/images/about.jpg') . '" class="img-responsive" />';
                }
              ?>
            </div>
        </div>
        <div class="conbx">
          <h4>
            <i class="fa fa-circle" ></i> <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_heading','About Us')); ?>
          </h4>
          <h5>
            <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_subheading','There are many variations of passages majority have suffered')); ?>
          </h5>
          <p>
            <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_description','There are many variations of passages of Lorem Ipsum available, but have suffered alteration in some form, by injected humour, words which dont look even slightly believable. need to be sure there isnt anything embarrassing hidden in the middle of text.')); ?>
          </p>
          <div class="list row">
              <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                <ul>
                  <li>
                    <i class="fa-regular fa-star"></i>
                    <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_list1','7,000 Sq. Ft. Paradise')); ?>
                  </li>
                  <li>
                    <i class="fa-regular fa-star"></i>
                    <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_list2','Well Garden Area')); ?>
                  </li>
                </ul>
              </div>
              <div class="col-lg-6 col-md-6 col-sm-12 pl-0">
                <ul>
                  <li>
                    <i class="fa-regular fa-star"></i>
                    <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_list1','12 Bedrooms & Master rooms')); ?>
                  </li>
                  <li>
                    <i class="fa-regular fa-star"></i>
                    <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_list2','Walking Area')); ?>
                  </li>
                </ul>
              </div>
          </div>
          <div class="row aboutuscontact">
            <div class="abtbtn">
              <a href="<?php echo esc_url(get_theme_mod('grand_hotel_aboutus_btnlink', '#')); ?>">
                <?php echo esc_html(get_theme_mod('grand_hotel_aboutus_btntext','Read More')); ?>
              </a>
            </div>
          </div>
          <div class="clearfix"></div>
        </div>
        
      </div>
    </div>
  </section>

  <?php do_action( 'grand_hotel_below_aboutus'); ?>

  <div class="container entry-content py-4">
    <?php while ( have_posts() ) : the_post(); ?>
      <?php the_content(); ?>
    <?php endwhile; // end of the loop. ?>
  </div>
</main>
<?php get_footer(); ?>