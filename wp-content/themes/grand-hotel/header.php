<?php
/**
 * Display Header.
 * @package Grand Hotel
 */

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">

	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
	<?php if ( function_exists( 'wp_body_open' ) ) {
	    wp_body_open();
	} else {
	    do_action( 'wp_body_open' );
	}?>
	<header role="banner" class="banner">
		<a class="screen-reader-text skip-link" href="#main"><?php esc_html_e( 'Skip to content', 'grand-hotel' ); ?></a>
		<div id="header">
			<div class="top-header">
				<div class="container">
					<div class="row mr-0">
						<div class="col-lg-8 col-md-8 col-sm-9">
							<div class="phonenum">
								<?php 
								$phone_number = get_theme_mod('grand_hotel_headerphoneno', '000-111-2222'); 

								if( $phone_number != '' ){ ?>
									<a href="tel:<?php echo esc_url($phone_number); ?>">
										<i class="fas fa-phone"></i>
										<?php echo esc_html($phone_number); ?>
									</a>
								<?php } ?>
							</div>
							<div class="email">
								<?php 
								$header_email = get_theme_mod('grand_hotel_headeremail', 'hotel@example.com'); // Add default email here

								if( $header_email != '' ){ ?>
									<a href="mailto:<?php echo esc_url($header_email); ?>">
										<i class="far fa-envelope"></i>
										<?php echo esc_html($header_email); ?>
									</a>
								<?php } ?>
							</div>
						</div>
						<div class="col-lg-4 col-md-4 col-sm-3 pd-0">
							<div class="socialicons">
								<a href="<?php echo esc_url(get_theme_mod('grand_hotel_headertwitterlink')); ?>">
									<i class="fa-brands fa-twitter"></i>
								</a>
								<a href="<?php echo esc_url(get_theme_mod('grand_hotel_headerinstagramlink')); ?>">
									<i class="fa-brands fa-instagram"></i>
								</a>
								<a href="<?php echo esc_url(get_theme_mod('grand_hotel_headerpinterestlink')); ?>">
									<i class="fa-brands fa-pinterest-p"></i>
								</a>
								<a href="<?php echo esc_url(get_theme_mod('grand_hotel_headerfacebooklink')); ?>">
									<i class="fab fa-facebook-f"></i>
								</a>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="btmheader">
				<div class="container">
					<div class="header-box">
						<div class="row marrgin-0">
							<div class="col-lg-5 col-md-4 col-sm-1 l-menu"> 
								<!-- <div class="row mr-0">
									<div class="col-lg-9 col-md-4 col-sm-6 col-6"> -->
										<div class="menu-section text-lg-center">
											<!-- <div class="<//?php if( get_theme_mod( 'grand_hotel_sticky_header', false) != '') { ?>sticky-menubox<//?php } else { ?>close-sticky <//?php } ?>"> -->
												<?php get_template_part( 'template-parts/navigation/leftsite', 'nav' ); ?>
											<!-- </div> -->
										</div>
									<!-- </div>
								</div> -->
							</div>
							<div class="col-lg-2 col-md-4 col-sm-8 logobx-out">
								<div class="logobx">
									<!-- <div class="logobxinn"></div> -->
									<?php get_template_part( 'template-parts/header/site', 'branding' ); ?>
								</div>
							</div>
							<div class="col-lg-5 col-md-4 col-sm-3 R-menu"> 
								<!-- <div class="row mr-0">
									<div class="col-lg-9 col-md-4 col-sm-6 col-6"> -->
										<div class="menu-section text-lg-center rightsidemenu">
											<!-- <div class="<//?php if( get_theme_mod( 'grand_hotel_sticky_header', false) != '') { ?>sticky-menubox<//?php } else { ?>close-sticky <//?php } ?>"> -->
												<?php get_template_part( 'template-parts/navigation/site', 'nav' ); ?>
											<!-- </div> -->
										</div>
									<!-- </div>
								</div> -->
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<?php if(is_singular()) {?>
		<div class="inner-head">
			<img src="<?php if ( get_header_image() ){ echo esc_url(get_header_image()); } else { echo esc_url(get_template_directory_uri()) ?>/assets/images/head-bg.jpg<?php }?>" class="head-img" alt="<?php echo esc_html('Header Background Image', 'grand-hotel'); ?>">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 align-self-center">
						<div class="header-content">
							<h1><?php single_post_title(); ?></h1>
							<div class="lt-breadcrumbs">
								<?php grand_hotel_breadcrumb(); ?>
							</div>
						</div>
					</div>
					<?php if(has_post_thumbnail()){?>
						<div class="col-lg-6 col-md-6 align-self-end">
							
						</div>
					<?php }?>
				</div>
				
			</div>
		</div>
	<?php }?>