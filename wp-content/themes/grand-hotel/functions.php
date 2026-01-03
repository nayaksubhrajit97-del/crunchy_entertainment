<?php
/**
 * Grand Hotel functions and definitions
 * @package Grand Hotel
 */

/* Theme Setup */
if ( ! function_exists( 'grand_hotel_setup' ) ) :

function grand_hotel_setup() {

	$GLOBALS['content_width'] = apply_filters( 'grand_hotel_content_width', 640 );

	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'woocommerce' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'title-tag' );
	add_theme_support( 'custom-logo', array(
		'height'      => 240,
		'width'       => 240,
		'flex-height' => true,
	) );

	add_image_size('grand-hotel-homepage-thumb',240,145,true);
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'grand-hotel' ),
	) );

	add_theme_support( 'custom-background', array(
		'default-color' => 'f1f1f1'
	) );
	
	/*
	 * Enable support for Post Formats.
	 *
	 * See: https://codex.wordpress.org/Post_Formats
	 */
	add_theme_support(
		'post-formats', array(
			'image',
			'video',
			'gallery',
			'audio',
		)	
	);

	add_theme_support( 'html5', array(
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );

	add_theme_support('responsive-embeds');

	add_editor_style( array( 'assets/css/editor-style.css', grand_hotel_font_url() ) );
	
}
endif; // grand_hotel_setup
add_action( 'after_setup_theme', 'grand_hotel_setup' );

/* Breadcrumb Begin */
function grand_hotel_breadcrumb() {
	if (!is_home()) {
		echo '<a href="';
			echo esc_url(home_url());
		echo '">';
			bloginfo('name');
		echo "</a> ";
		if (is_category() || is_single()) {
			echo "&nbsp;&#187;&nbsp;";
			the_category(', ');
			if (is_single()) {
				echo "&nbsp;&#187;&nbsp;";
				echo " <span> ";
					the_title();
				echo "</span>";
			}
		} elseif (is_page()) {
			echo "&nbsp;&#187;&nbsp;";
			echo " <span>";
				the_title();
			echo "</span> ";
		}
	}
}

/*radio button sanitization*/
function grand_hotel_sanitize_choices( $input, $setting ) {
    global $wp_customize;
    $control = $wp_customize->get_control( $setting->id );
    if ( array_key_exists( $input, $control->choices ) ) {
        return $input;
    } else {
        return $setting->default;
    }
}

function grand_hotel_sanitize_phone_number( $phone ) {
	return preg_replace( '/[^\d+]/', '', $phone );
}

function grand_hotel_sanitize_checkbox( $input ) {
	return ( ( isset( $input ) && true == $input ) ? true : false );
}

function grand_hotel_sanitize_float( $input ) {
	return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
}

// Change number or products per row to 3
add_filter('loop_shop_columns', 'grand_hotel_loop_columns');
if (!function_exists('grand_hotel_loop_columns')) {
	function grand_hotel_loop_columns() {
		$columns = get_theme_mod( 'grand_hotel_products_per_column', 3 );
		return $columns; // 3 products per row
	}
}

//Change number of products that are displayed per page (shop page)
add_filter( 'loop_shop_per_page', 'grand_hotel_shop_per_page', 20 );
function grand_hotel_shop_per_page( $cols ) {
  	$cols = get_theme_mod( 'grand_hotel_products_per_page', 9 );
	return $cols;
}

function grand_hotel_sanitize_dropdown_pages( $page_id, $setting ) {
  	// Ensure $input is an absolute integer.
  	$page_id = absint( $page_id );
  	// If $page_id is an ID of a published page, return it; otherwise, return the default.
  	return ( 'publish' == get_post_status( $page_id ) ? $page_id : $setting->default );
}

/* Excerpt Limit Begin */
function grand_hotel_string_limit_words($string, $word_limit) {
	$words = explode(' ', $string, ($word_limit + 1));
	if(count($words) > $word_limit)
	array_pop($words);
	return implode(' ', $words);
}

/* Theme Widgets Setup */
function grand_hotel_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears on blog page sidebar', 'grand-hotel' ),
		'id'            => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	
	register_sidebar( array(
		'name'          => esc_html__( 'Posts and Pages Sidebar', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears on posts and pages', 'grand-hotel' ),
		'id'            => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar 3', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears on posts and pages', 'grand-hotel' ),
		'id'            => 'sidebar-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 1', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears in footer', 'grand-hotel' ),
		'id'            => 'footer-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 2', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears in footer', 'grand-hotel' ),
		'id'            => 'footer-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 3', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears in footer', 'grand-hotel' ),
		'id'            => 'footer-3',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer 4', 'grand-hotel' ),
		'description'   => esc_html__( 'Appears in footer', 'grand-hotel' ),
		'id'            => 'footer-4',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'grand_hotel_widgets_init' );


/* Theme Font URL */
function grand_hotel_font_url(){
	$font_url = '';
	$font_family = array();
	$font_family[] = 'PT Sans:400,400i,700,700i';
	$font_family[] = 'Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i';
	$font_family[] = 'Roboto Condensed:400,700';
	$font_family[] = 'Open Sans:300,300i,400,400i,500,500i,600,600i,700,700i,800,800i';
	$font_family[] = 'Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i';
	$font_family[] = 'Overpass';
	$font_family[] = 'Montserrat:300,400,600,700,800,900';
	$font_family[] = 'Playball:300,400,600,700,800,900';
	$font_family[] = 'Alegreya:300,400,600,700,800,900';
	$font_family[] = 'Julius Sans One';
	$font_family[] = 'Arsenal';
	$font_family[] = 'Slabo';
	$font_family[] = 'Lato';
	$font_family[] = 'Overpass Mono';
	$font_family[] = 'Source Sans Pro';
	$font_family[] = 'Raleway';
	$font_family[] = 'Merriweather';
	$font_family[] = 'Droid Sans';
	$font_family[] = 'Rubik';
	$font_family[] = 'Lora';
	$font_family[] = 'Ubuntu';
	$font_family[] = 'Cabin';
	$font_family[] = 'Arimo';
	$font_family[] = 'Playfair Display';
	$font_family[] = 'Quicksand';
	$font_family[] = 'Padauk';
	$font_family[] = 'Muli';
	$font_family[] = 'Inconsolata';
	$font_family[] = 'Bitter';
	$font_family[] = 'Pacifico';
	$font_family[] = 'Indie Flower';
	$font_family[] = 'VT323';
	$font_family[] = 'Dosis';
	$font_family[] = 'Frank Ruhl Libre';
	$font_family[] = 'Fjalla One';
	$font_family[] = 'Oxygen';
	$font_family[] = 'Arvo';
	$font_family[] = 'Noto Serif';
	$font_family[] = 'Lobster';
	$font_family[] = 'Crimson Text';
	$font_family[] = 'Yanone Kaffeesatz';
	$font_family[] = 'Anton';
	$font_family[] = 'Libre Baskerville';
	$font_family[] = 'Bree Serif';
	$font_family[] = 'Gloria Hallelujah';
	$font_family[] = 'Josefin Sans';
	$font_family[] = 'Abril Fatface';
	$font_family[] = 'Varela Round';
	$font_family[] = 'Vampiro One';
	$font_family[] = 'Shadows Into Light';
	$font_family[] = 'Cuprum';
	$font_family[] = 'Rokkitt';
	$font_family[] = 'Vollkorn';
	$font_family[] = 'Francois One';
	$font_family[] = 'Orbitron';
	$font_family[] = 'Patua One';
	$font_family[] = 'Acme';
	$font_family[] = 'Satisfy';
	$font_family[] = 'Josefin Slab';
	$font_family[] = 'Quattrocento Sans';
	$font_family[] = 'Architects Daughter';
	$font_family[] = 'Russo One';
	$font_family[] = 'Monda';
	$font_family[] = 'Righteous';
	$font_family[] = 'Lobster Two';
	$font_family[] = 'Hammersmith One';
	$font_family[] = 'Courgette';
	$font_family[] = 'Permanent Marker';
	$font_family[] = 'Cherry Swash';
	$font_family[] = 'Cormorant Garamond';
	$font_family[] = 'Poiret One';
	$font_family[] = 'BenchNine';
	$font_family[] = 'Economica';
	$font_family[] = 'Handlee';
	$font_family[] = 'Cardo';
	$font_family[] = 'Alfa Slab One';
	$font_family[] = 'Averia Serif Libre';
	$font_family[] = 'Cookie';
	$font_family[] = 'Chewy';
	$font_family[] = 'Great Vibes';
	$font_family[] = 'Coming Soon';
	$font_family[] = 'Philosopher';
	$font_family[] = 'Days One';
	$font_family[] = 'Kanit';
	$font_family[] = 'Shrikhand';
	$font_family[] = 'Tangerine';
	$font_family[] = 'IM Fell English SC';
	$font_family[] = 'Boogaloo';
	$font_family[] = 'Bangers';
	$font_family[] = 'Fredoka One';
	$font_family[] = 'Bad Script';
	$font_family[] = 'Volkhov';
	$font_family[] = 'Shadows Into Light Two';
	$font_family[] = 'Marck Script';
	$font_family[] = 'Sacramento';
	$font_family[] = 'Unica One';
	$font_family[] = 'Kaisei HarunoUmi:wght@400;500;700';
	$font_family[] = 'Yeseva One';

	$query_args = array(
		'family'	=> rawurlencode(implode('|',$font_family)),
	);
	$font_url = add_query_arg($query_args,'//fonts.googleapis.com/css');
	return $font_url;
	$contents = wptt_get_webfont_url( esc_url_raw( $fonts_url ) );
}	

/* Theme enqueue scripts */
function grand_hotel_scripts() {
	wp_enqueue_style( 'grand-hotel-font', grand_hotel_font_url(), array() );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/css/bootstrap.css');
	wp_enqueue_style( 'grand-hotel-basic-style', get_stylesheet_uri() );
	wp_style_add_data( 'grand-hotel-style', 'rtl', 'replace' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/assets/css/font-awesome.css' );
	wp_enqueue_style( 'font-awesome-css', get_template_directory_uri().'/assets/css/fontawesome-all.css' );

	wp_enqueue_style( 'splide-css', get_template_directory_uri().'/assets/css/splide.min.css' );

	// Paragraph
    $grand_hotel_paragraph_color = get_theme_mod('grand_hotel_paragraph_color', '');
    $grand_hotel_paragraph_font_family = get_theme_mod('grand_hotel_paragraph_font_family', '');
    $grand_hotel_paragraph_font_size = get_theme_mod('grand_hotel_paragraph_font_size', '');
	// "a" tag
	$grand_hotel_atag_color = get_theme_mod('grand_hotel_atag_color', '');
    $grand_hotel_atag_font_family = get_theme_mod('grand_hotel_atag_font_family', '');
	// "li" tag
	$grand_hotel_li_color = get_theme_mod('grand_hotel_li_color', '');
    $grand_hotel_li_font_family = get_theme_mod('grand_hotel_li_font_family', '');
	// H1
	$grand_hotel_h1_color = get_theme_mod('grand_hotel_h1_color', '');
    $grand_hotel_h1_font_family = get_theme_mod('grand_hotel_h1_font_family', '');
    $grand_hotel_h1_font_size = get_theme_mod('grand_hotel_h1_font_size', '');
	// H2
	$grand_hotel_h2_color = get_theme_mod('grand_hotel_h2_color', '');
    $grand_hotel_h2_font_family = get_theme_mod('grand_hotel_h2_font_family', '');
    $grand_hotel_h2_font_size = get_theme_mod('grand_hotel_h2_font_size', '');
	// H3
	$grand_hotel_h3_color = get_theme_mod('grand_hotel_h3_color', '');
    $grand_hotel_h3_font_family = get_theme_mod('grand_hotel_h3_font_family', '');
    $grand_hotel_h3_font_size = get_theme_mod('grand_hotel_h3_font_size', '');
	// H4
	$grand_hotel_h4_color = get_theme_mod('grand_hotel_h4_color', '');
    $grand_hotel_h4_font_family = get_theme_mod('grand_hotel_h4_font_family', '');
    $grand_hotel_h4_font_size = get_theme_mod('grand_hotel_h4_font_size', '');
	// H5
	$grand_hotel_h5_color = get_theme_mod('grand_hotel_h5_color', '');
    $grand_hotel_h5_font_family = get_theme_mod('grand_hotel_h5_font_family', '');
    $grand_hotel_h5_font_size = get_theme_mod('grand_hotel_h5_font_size', '');
	// H6
	$grand_hotel_h6_color = get_theme_mod('grand_hotel_h6_color', '');
    $grand_hotel_h6_font_family = get_theme_mod('grand_hotel_h6_font_family', '');
    $grand_hotel_h6_font_size = get_theme_mod('grand_hotel_h6_font_size', '');

	$grand_hotel_custom_css ='
		p,span{
		    color:'.esc_html($grand_hotel_paragraph_color).'!important;
		    font-family: '.esc_html($grand_hotel_paragraph_font_family).';
		    font-size: '.esc_html($grand_hotel_paragraph_font_size).'px ;
		}
		a{
		    color:'.esc_html($grand_hotel_atag_color).'!important;
		    font-family: '.esc_html($grand_hotel_atag_font_family).';
		}
		li{
		    color:'.esc_html($grand_hotel_li_color).'!important;
		    font-family: '.esc_html($grand_hotel_li_font_family).';
		}
		h1{
		    color:'.esc_html($grand_hotel_h1_color).'!important;
		    font-family: '.esc_html($grand_hotel_h1_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h1_font_size).'px !important;
		}
		h2{
		    color:'.esc_html($grand_hotel_h2_color).'!important;
		    font-family: '.esc_html($grand_hotel_h2_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h2_font_size).'px !important;
		}
		h3{
		    color:'.esc_html($grand_hotel_h3_color).'!important;
		    font-family: '.esc_html($grand_hotel_h3_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h3_font_size).'px !important;
		}
		h4{
		    color:'.esc_html($grand_hotel_h4_color).'!important;
		    font-family: '.esc_html($grand_hotel_h4_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h4_font_size).'px !important;
		}
		h5{
		    color:'.esc_html($grand_hotel_h5_color).'!important;
		    font-family: '.esc_html($grand_hotel_h5_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h5_font_size).'px !important;
		}
		h6{
		    color:'.esc_html($grand_hotel_h6_color).'!important;
		    font-family: '.esc_html($grand_hotel_h6_font_family).'!important;
		    font-size: '.esc_html($grand_hotel_h6_font_size).'px !important;
		}

	';
	wp_add_inline_style( 'grand-hotel-basic-style',$grand_hotel_custom_css );

	wp_enqueue_script( 'bootstrap-js', get_template_directory_uri() . '/assets/js/bootstrap.js', array('jquery') ,'',true);
	wp_enqueue_script( 'grand-hotel-custom-jquery', get_template_directory_uri() . '/assets/js/custom.js', array('jquery') );
	wp_enqueue_script( 'jquery-superfish', get_template_directory_uri() . '/assets/js/jquery.superfish.js', array('jquery') ,'',true);

	wp_enqueue_script( 'splide-js', get_template_directory_uri() . '/assets/js/splide.min.js', array('jquery') ,'',true);
	wp_enqueue_script( 'slider-script', get_template_directory_uri() . '/assets/js/sliderscript.js', array('jquery') );

	require get_parent_theme_file_path( '/lt-inline-style.php' );
	wp_add_inline_style( 'grand-hotel-basic-style',$grand_hotel_custom_css );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'grand_hotel_scripts' );

require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/wptt-webfont-loader.php';

add_action('admin_notices', 'grand_hotel_global_promo_notice');

function grand_hotel_global_promo_notice() {
    // Only show if the theme exists in wp-content/themes/
    $theme_dir = WP_CONTENT_DIR . '/themes/grand-hotel';
    if (!file_exists($theme_dir)) return;

    // Optional: only for admin users
    if (!current_user_can('manage_options')) return;

    $screenshot = content_url('/themes/grand-hotel/screenshot.png');
    ?>
    <div class="notice grand-hotel-notice">
		<strong style="font-size:24px;">Use this coupon code to get 15% off: <span style="background: #ff0000;color: #fff;padding: 5px 10px;">FREEWORDTHEME</span> </strong>
        <div style="display:flex; align-items:center; gap:20px;margin-top: 15px;">
            <img src="<?php echo esc_url($screenshot); ?>" alt="Grand Hotel Theme" style="max-width:180px; height:auto; border:1px solid #ccc; border-radius:6px;">
            <div style="flex:1;">
                <strong style="font-size:16px;">Try The Grand Hotel Theme Pro!</strong><br>
                Unlock Premium Features, Layouts, Banner Slider, Fully Responsive, Woocommerce Support, Multilanguage, Theme Options and Priority Support.
                <div style="margin-top:10px;">
                    <a href="https://www.logicaldemo.com/grand-hotel/" target="_blank" class="button button-primary" style="background:#000; color:#fff;">View Demo</a>
                    <a href="https://www.logicalthemes.com/products/premium-grand-hotel-wordpress-theme/" target="_blank" class="button" style="background:#0073aa; color:#fff;padding: 0px 27px; font-weight: 700;border:1px solid #ff0000ff;">Get Premium</a>
                </div>
            </div>
        </div>
    </div>
    <style>
        .grand-hotel-notice {
            border-left-color: #ff5f5f !important;
            background: #fff;
            padding: 15px 20px;
            margin-top: 15px;
        }
    </style>
    <?php
}

function logical_theme_setup_notice() {
    ?>
    <style>
        .logical-notice .button-primary {
            background-color: #0073aa;
            border-color: #006799;
            box-shadow: none;
            text-decoration: none;
            padding: 8px 16px;
            font-size: 14px;
            border-radius: 4px;
            transition: all 0.2s ease;
        }
        .logical-notice .button-primary:hover {
            background-color: #006799;
            border-color: #005a87;
        }
    </style>
    <div class="notice notice-success logical-notice"> <!-- ❌ removed 'is-dismissible' -->
        <h2>🎉 Thank You for Installing <strong>logical Theme</strong>!</h2>
        <p>We're excited to help you build your website. Let's get started by setting up your theme.</p>
        <p>
            <a href="<?php echo esc_url( admin_url( 'customize.php' ) ); ?>" target="_blank" class="button button-primary">
                🚀 Setup Your Theme
            </a>
        </p>
    </div>
    <?php
}
add_action( 'admin_notices', 'logical_theme_setup_notice' );


function logical_create_home_page_on_activation() {
    $page_title = 'Home';
    $home_page_id = 0;

    // Check if "Home" page already exists
    $existing_page = new WP_Query( array(
        'post_type'      => 'page',
        'title'          => $page_title,
        'posts_per_page' => 1,
        'post_status'    => 'any',
    ) );

    if ( $existing_page->have_posts() ) {
        $existing_page->the_post();
        $home_page_id = get_the_ID();
    } else {
        // Create "Home" page
        $home_page_id = wp_insert_post( array(
            'post_title'    => $page_title,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_content'  => '',
        ) );
    }

    wp_reset_postdata();

    // Set template and homepage options
    if ( $home_page_id ) {
        // Set page template - use relative path from theme root
        update_post_meta( $home_page_id, '_wp_page_template', 'page-template/home-custom.php' );
        
        // Set as static homepage
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page_id );
    }
}
add_action( 'after_switch_theme', 'logical_create_home_page_on_activation' );

// Alternative method - using init hook with higher priority
function logical_create_home_page_alternative() {
    // Only run once after theme activation
    if ( get_option( 'logical_home_page_created' ) ) {
        return;
    }

    $page_title = 'Home';
    $home_page_id = 0;

    // Check if "Home" page already exists
    $existing_page = get_page_by_title( $page_title );
    
    if ( $existing_page ) {
        $home_page_id = $existing_page->ID;
    } else {
        // Create "Home" page
        $home_page_id = wp_insert_post( array(
            'post_title'    => $page_title,
            'post_status'   => 'publish',
            'post_type'     => 'page',
            'post_content'  => '',
        ) );
    }

    // Set template and homepage options
    if ( $home_page_id ) {
        // Set page template
        update_post_meta( $home_page_id, '_wp_page_template', 'page-template/custom-home-page.php' );
        
        // Set as static homepage
        update_option( 'show_on_front', 'page' );
        update_option( 'page_on_front', $home_page_id );
        
        // Mark as created
        update_option( 'logical_home_page_created', true );
    }
}
// Uncomment below line if main function doesn't work
// add_action( 'init', 'logical_create_home_page_alternative' );