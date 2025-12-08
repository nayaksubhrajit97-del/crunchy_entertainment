<?php
/**
 * Grand Hotel Theme Customizer
 *
 * @package Grand Hotel
 */

/**
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */

/**
 * Singleton class for handling the theme's customizer integration.
 *
 * @since  1.0.0
 * @access public
 */
final class Grand_Hotel_Customize {

	/**
	 * Returns the instance.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return object
	 */
	public static function get_instance() {

		static $instance = null;

		if ( is_null( $instance ) ) {
			$instance = new self;
			$instance->setup_actions();
		}

		return $instance;
	}

	/**
	 * Constructor method.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function __construct() {}

	/**
	 * Sets up initial actions.
	 *
	 * @since  1.0.0
	 * @access private
	 * @return void
	 */
	private function setup_actions() {

		// Register panels, sections, settings, controls, and partials.
		add_action( 'customize_register', array( $this, 'sections' ) );

		// Register scripts and styles for the controls.
		add_action( 'customize_controls_enqueue_scripts', array( $this, 'enqueue_control_scripts' ), 0 );
	}

	/**
	 * Sets up the customizer sections.
	 *
	 * @since  1.0.0
	 * @access public
	 * @param  object  $manager
	 * @return void
	 */
	public function sections( $manager ) {

		// Load custom sections.
		load_template( trailingslashit( get_template_directory() ) . '/inc/section-pro.php' );

		// Register custom section types.
		$manager->register_section_type( 'Grand_Hotel_Customize_Section_Pro' );

		// Register sections.
		$manager->add_section(
			new Grand_Hotel_Customize_Section_Pro(
				$manager,
				'example_1',
				array(
					'priority' => 9,
					'title'    => esc_html__( 'Grand Hotel Pro', 'grand-hotel' ),
					'pro_text' => esc_html__( 'Go Pro', 'grand-hotel' ),
					'pro_url'  => esc_url( 'https://www.logicalthemes.com/products/premium-grand-hotel-wordpress-theme' ),
				)
			)
		);
	}

	/**
	 * Loads theme customizer CSS.
	 *
	 * @since  1.0.0
	 * @access public
	 * @return void
	 */
	public function enqueue_control_scripts() {

		wp_enqueue_script( 'grand-hotel-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/js/customize-controls.js', array( 'customize-controls' ) );

		wp_enqueue_style( 'grand-hotel-customize-controls', trailingslashit( esc_url(get_template_directory_uri()) ) . '/assets/css/customize-controls.css' );
	}
}

function mega_customizer_offer_popup_script() {
    ?>
    <style>
        #mega-offer-backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background: rgba(0, 0, 0, 0.4);
            backdrop-filter: blur(4px);
            z-index: 999998;
            display: none;
        }
        #mega-offer-popup {
            position: fixed;
            top: 45%;
            left: 50%;
            transform: translate(-50%, -50%) scale(0.8);
            opacity: 0;
            background: #fff;
            border: 2px solid #0073aa;
            padding: 25px 25px 20px;
            z-index: 999999;
            box-shadow: 0 0 30px rgba(0,0,0,0.2);
            max-width: 420px;
            text-align: center;
            font-family: sans-serif;
            border-radius: 10px;
            transition: all 0.4s ease;
        }
        #mega-offer-popup.show {
            opacity: 1;
            transform: translate(-50%, -50%) scale(1);
        }
        #offer-close-icon {
            position: absolute;
            top: 10px;
            right: 12px;
            font-size: 20px;
            color: #333;
            cursor: pointer;
            font-weight: bold;
        }
        #offer-close-icon:hover {
            color: red;
        }
    </style>

    <script>
        (function () {
            document.addEventListener('DOMContentLoaded', function () {
                // Only show once per login session
                if (
                    !sessionStorage.getItem('mega_customizer_offer_shown') &&
                    !document.getElementById('mega-offer-popup') &&
                    !document.getElementById('mega-offer-backdrop')
                ) {
                    const backdrop = document.createElement('div');
                    backdrop.id = 'mega-offer-backdrop';

                    const popup = document.createElement('div');
                    popup.id = 'mega-offer-popup';
                    popup.innerHTML = `
						<div id="offer-close-icon" style="position: absolute; top: 10px; right: 12px; font-size: 20px; font-weight: bold; color: #333; cursor: pointer;">&times;</div>

						<div style="border: 2px solid #0073aa; border-radius: 10px; overflow: hidden; font-family: sans-serif; max-width: 600px; background: white;">

							<div style="background: #4CAF50; color: white; padding: 12px 20px; font-size: 18px; font-weight: bold; text-align: center;">
								🎁 Mega Offer Alert
							</div>

							<div style="display: flex; flex-wrap: wrap; justify-content: center; align-items: center; padding: 20px; gap: 20px;">
								<img src="<?php echo get_theme_file_uri('screenshot.png'); ?>" alt="Theme Preview" style="width: 250px; max-width: 100%; border: 1px solid #ccc; border-radius: 6px;" />

								<div>
									<h3 style="margin: 0 0 10px; font-size: 18px; color: #000;">Grand Hotel Theme Pro</h3>
									<div style="border: 2px dashed red; border-radius: 10px; padding: 15px; background: #fff5f5; text-align: center;">
										<div style="font-size: 18px; color: red; font-weight: bold;">Get 15% OFF</div>
										<div style="font-size: 14px; color: #555;">Use Code Below:</div>
										<div style="background: red; color: white; padding: 8px 16px; font-weight: bold; margin-top: 8px; display: inline-block; border-radius: 4px;">
											FREEWORDTHEME
										</div>
									</div>
								</div>
							</div>

							<div style="background: #4CAF50; text-align: center;">
								<a href="https://www.logicalthemes.com/products/premium-grand-hotel-wordpress-theme/" target="_blank" style="display: inline-block; padding: 12px 25px; color: white; font-weight: bold; text-decoration: none; font-size: 16px;">Upgrade Now</a>
							</div>
						</div>
					`;

                    document.body.appendChild(backdrop);
                    document.body.appendChild(popup);

                    setTimeout(() => {
                        backdrop.style.display = 'block';
                        popup.classList.add('show');
                    }, 100);

                    popup.querySelector('#offer-close-icon').addEventListener('click', () => {
                        popup.remove();
                        backdrop.remove();
                    });

                    // Only for this session (until logout or browser closed)
                    sessionStorage.setItem('mega_customizer_offer_shown', 'true');
                }
            });
        })();
    </script>
    <?php
}
add_action('customize_controls_print_footer_scripts', 'mega_customizer_offer_popup_script');

// Doing this customizer thang!
Grand_Hotel_Customize::get_instance();

function grand_hotel_customize_register( $wp_customize ) {	

	//add home page setting pannel
	$wp_customize->add_panel( 'grand_hotel_panel_id', array(
	    'priority' => 10,
	    'capability' => 'edit_theme_options',
	    'theme_supports' => '',
	    'title' => esc_html__( 'LT Settings', 'grand-hotel' ),
	) );

	//Layout Setting
	$wp_customize->add_section( 'grand_hotel_left_right' , array(
    	'title'      => esc_html__( 'General Settings', 'grand-hotel' ),
		'priority'   => null,
		'panel' => 'grand_hotel_panel_id'
	) );

	$wp_customize->add_setting('grand_hotel_theme_options',array(
        'default' => 'One Column',
        'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control('grand_hotel_theme_options',array(
        'type' => 'radio',
        'description' => __( 'Choose sidebar between different options', 'grand-hotel' ),
        'label' => esc_html__( 'Post Sidebar Layout.', 'grand-hotel' ),
        'section' => 'grand_hotel_left_right',
        'choices' => array(
            'One Column' => esc_html__('One Column ','grand-hotel'),
            'Three Columns' => esc_html__('Three Columns','grand-hotel'),
            'Four Columns' => esc_html__('Four Columns','grand-hotel'),
            'Right Sidebar' => esc_html__('Right Sidebar','grand-hotel'),
            'Left Sidebar' => esc_html__('Left Sidebar','grand-hotel'),
            'Grid Layout' => esc_html__('Grid Layout','grand-hotel')
        ),
	));

	$grand_hotel_font_array = array(
        '' =>'No Fonts',
        'Abril Fatface' => 'Abril Fatface',
        'Acme' =>'Acme', 
        'Anton' => 'Anton', 
        'Architects Daughter' =>'Architects Daughter',
        'Arimo' => 'Arimo', 
        'Arsenal' =>'Arsenal',
        'Arvo' =>'Arvo',
        'Alegreya' =>'Alegreya',
        'Alfa Slab One' =>'Alfa Slab One',
        'Averia Serif Libre' =>'Averia Serif Libre', 
        'Bangers' =>'Bangers', 
        'Boogaloo' =>'Boogaloo', 
        'Bad Script' =>'Bad Script',
        'Bitter' =>'Bitter', 
        'Bree Serif' =>'Bree Serif', 
        'BenchNine' =>'BenchNine',
        'Cabin' =>'Cabin',
        'Cardo' =>'Cardo', 
        'Courgette' =>'Courgette', 
        'Cherry Swash' =>'Cherry Swash',
        'Cormorant Garamond' =>'Cormorant Garamond', 
        'Crimson Text' =>'Crimson Text',
        'Cuprum' =>'Cuprum', 
        'Cookie' =>'Cookie',
        'Chewy' =>'Chewy',
        'Days One' =>'Days One',
        'Dosis' =>'Dosis',
        'Droid Sans' =>'Droid Sans', 
        'Economica' =>'Economica', 
        'Fredoka One' =>'Fredoka One',
        'Fjalla One' =>'Fjalla One',
        'Francois One' =>'Francois One', 
        'Frank Ruhl Libre' => 'Frank Ruhl Libre', 
        'Gloria Hallelujah' =>'Gloria Hallelujah',
        'Great Vibes' =>'Great Vibes', 
        'Handlee' =>'Handlee', 
        'Hammersmith One' =>'Hammersmith One',
        'Inconsolata' =>'Inconsolata',
        'Indie Flower' =>'Indie Flower', 
        'IM Fell English SC' =>'IM Fell English SC',
        'Julius Sans One' =>'Julius Sans One',
        'Josefin Slab' =>'Josefin Slab',
        'Josefin Sans' =>'Josefin Sans',
        'Kanit' =>'Kanit',
        'Lobster' =>'Lobster',
        'Lato' => 'Lato',
        'Lora' =>'Lora', 
        'Libre Baskerville' =>'Libre Baskerville',
        'Lobster Two' => 'Lobster Two',
        'Merriweather' =>'Merriweather',
        'Monda' =>'Monda',
        'Montserrat' =>'Montserrat',
        'Muli' =>'Muli',
        'Marck Script' =>'Marck Script',
        'Noto Serif' =>'Noto Serif',
        'Open Sans' =>'Open Sans',
        'Overpass' => 'Overpass', 
        'Overpass Mono' =>'Overpass Mono',
        'Oxygen' =>'Oxygen',
        'Orbitron' =>'Orbitron',
        'Patua One' =>'Patua One',
        'Pacifico' =>'Pacifico',
        'Padauk' =>'Padauk',
        'Playball' =>'Playball',
        'Playfair Display' =>'Playfair Display',
        'PT Sans' =>'PT Sans',
        'Philosopher' =>'Philosopher',
        'Permanent Marker' =>'Permanent Marker',
        'Poiret One' =>'Poiret One',
        'Quicksand' =>'Quicksand',
        'Quattrocento Sans' =>'Quattrocento Sans',
        'Raleway' =>'Raleway',
        'Rubik' =>'Rubik',
        'Rokkitt' =>'Rokkitt',
        'Russo One' => 'Russo One', 
        'Righteous' =>'Righteous', 
        'Slabo' =>'Slabo', 
        'Source Sans Pro' =>'Source Sans Pro',
        'Shadows Into Light Two' =>'Shadows Into Light Two',
        'Shadows Into Light' =>  'Shadows Into Light',
        'Sacramento' =>'Sacramento',
        'Shrikhand' =>'Shrikhand',
        'Tangerine' => 'Tangerine',
        'Ubuntu' =>'Ubuntu',
        'VT323' =>'VT323',
        'Varela Round' =>'Varela Round',
        'Vampiro One' =>'Vampiro One',
        'Vollkorn' => 'Vollkorn',
        'Volkhov' =>'Volkhov',
        'Yanone Kaffeesatz' =>'Yanone Kaffeesatz'
    );

	//Typography
	$wp_customize->add_section( 'grand_hotel_typography', array(
    	'title'      => __( 'Typography', 'grand-hotel' ),
		'priority'   => null,
		'panel' => 'grand_hotel_panel_id'
	) );
	
	// This is Paragraph Color picker setting
	$wp_customize->add_setting( 'grand_hotel_paragraph_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_paragraph_color', array(
		'label' => __('Paragraph Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_paragraph_color',
	)));

	//This is Paragraph FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_paragraph_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_paragraph_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'Paragraph Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	$wp_customize->add_setting('grand_hotel_paragraph_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_paragraph_font_size',array(
		'label'	=> __('Paragraph Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_paragraph_font_size',
		'type'	=> 'text'
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'grand_hotel_atag_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_atag_color', array(
		'label' => __('"a" Tag Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_atag_color',
	)));

	//This is "a" Tag FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_atag_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_atag_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( '"a" Tag Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	// This is "a" Tag Color picker setting
	$wp_customize->add_setting( 'grand_hotel_li_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_li_color', array(
		'label' => __('"li" Tag Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_li_color',
	)));

	//This is "li" Tag FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_li_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_li_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( '"li" Tag Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	// This is H1 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h1_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h1_color', array(
		'label' => __('H1 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h1_color',
	)));

	//This is H1 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h1_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h1_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H1 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H1 FontSize setting
	$wp_customize->add_setting('grand_hotel_h1_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h1_font_size',array(
		'label'	=> __('H1 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h1_font_size',
		'type'	=> 'text'
	));

	// This is H2 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h2_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h2_color', array(
		'label' => __('H2 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h2_color',
	)));

	//This is H2 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h2_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h2_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H2 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H2 FontSize setting
	$wp_customize->add_setting('grand_hotel_h2_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h2_font_size',array(
		'label'	=> __('H2 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h2_font_size',
		'type'	=> 'text'
	));

	// This is H3 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h3_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h3_color', array(
		'label' => __('H3 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h3_color',
	)));

	//This is H3 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h3_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h3_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H3 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H3 FontSize setting
	$wp_customize->add_setting('grand_hotel_h3_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h3_font_size',array(
		'label'	=> __('H3 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h3_font_size',
		'type'	=> 'text'
	));

	// This is H4 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h4_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h4_color', array(
		'label' => __('H4 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h4_color',
	)));

	//This is H4 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h4_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h4_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H4 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H4 FontSize setting
	$wp_customize->add_setting('grand_hotel_h4_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h4_font_size',array(
		'label'	=> __('H4 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h4_font_size',
		'type'	=> 'text'
	));

	// This is H5 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h5_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h5_color', array(
		'label' => __('H5 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h5_color',
	)));

	//This is H5 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h5_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h5_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H5 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H5 FontSize setting
	$wp_customize->add_setting('grand_hotel_h5_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h5_font_size',array(
		'label'	=> __('H5 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h5_font_size',
		'type'	=> 'text'
	));

	// This is H6 Color picker setting
	$wp_customize->add_setting( 'grand_hotel_h6_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_h6_color', array(
		'label' => __('H6 Color', 'grand-hotel'),
		'section' => 'grand_hotel_typography',
		'settings' => 'grand_hotel_h6_color',
	)));

	//This is H6 FontFamily picker setting
	$wp_customize->add_setting('grand_hotel_h6_font_family',array(
	  'default' => '',
	  'capability' => 'edit_theme_options',
	  'sanitize_callback' => 'grand_hotel_sanitize_choices'
	));
	$wp_customize->add_control(
	    'grand_hotel_h6_font_family', array(
	    'section'  => 'grand_hotel_typography',
	    'label'    => __( 'H6 Fonts','grand-hotel'),
	    'type'     => 'select',
	    'choices'  => $grand_hotel_font_array,
	));

	//This is H6 FontSize setting
	$wp_customize->add_setting('grand_hotel_h6_font_size',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_h6_font_size',array(
		'label'	=> __('H6 Font Size','grand-hotel'),
		'section'	=> 'grand_hotel_typography',
		'setting'	=> 'grand_hotel_h6_font_size',
		'type'	=> 'text'
	));

	//Topbar section
	$wp_customize->add_section('grand_hotel_topbar',array(
		'title'	=> esc_html__('Header','grand-hotel'),
		'priority'	=> null,
		'panel' => 'grand_hotel_panel_id',
	));

	// $wp_customize->add_setting( 'grand_hotel_sticky_header',array(
	// 	'default'	=> false,
    //   	'sanitize_callback'	=> 'grand_hotel_sanitize_checkbox'
    // ) );
    // $wp_customize->add_control('grand_hotel_sticky_header',array(
    // 	'type' => 'checkbox',
    // 	'description' => __( 'Click on the checkbox to enable sticky header.', 'grand-hotel' ),
    //     'label' => __( 'Sticky Header','grand-hotel' ),
    //     'section' => 'grand_hotel_topbar'
    // ));

	$wp_customize->add_setting('grand_hotel_headerphoneno',array(
		'default'	=> '000-111-2222',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headerphoneno',array(
		'label'	=> __('Phone Number','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_headeremail',array(
		'default'	=> 'hotel@example.com',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headeremail',array(
		'label'	=> __('Phone Number','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_headertwitterlink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headertwitterlink',array(
		'label'	=> __('Twitter Icon Link','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_headerinstagramlink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headerinstagramlink',array(
		'label'	=> __('Instagram Icon Link','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_headerpinterestlink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headerpinterestlink',array(
		'label'	=> __('Pinterest Icon Link','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_headerfacebooklink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_headerfacebooklink',array(
		'label'	=> __('Facebook Icon Link','grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'type'	 => 'text'
	));

	$wp_customize->add_setting( 'grand_hotel_header_topbg', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_topbg', array(
		'label' => __('Top BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_topbg',
	)));


	$wp_customize->add_setting( 'grand_hotel_header_topphonemailcolor', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_topphonemailcolor', array(
		'label' => __('Phone Number & Mail Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_topphonemailcolor',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_topphonemailhvrcolor', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_topphonemailhvrcolor', array(
		'label' => __('Phone Number & Mail Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_topphonemailhvrcolor',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_socialiconcolor', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_socialiconcolor', array(
		'label' => __('Social Icons Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_socialiconcolor',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_socialiconhvrcolor', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_socialiconhvrcolor', array(
		'label' => __('Social Icons Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_socialiconhvrcolor',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_menu_col', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_menu_col', array(
		'label' => __('Menu Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_menu_col',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_menuactivehover_col', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_menuactivehover_col', array(
		'label' => __('Menu Active & Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_menuactivehover_col',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_submenu_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_submenu_color', array(
		'label' => __('Submenu Text Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_submenu_color',
	)));


	$wp_customize->add_setting( 'grand_hotel_header_submenu_bg_col', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_submenu_bg_col', array(
		'label' => __('Submenu BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_submenu_bg_col',
	)));

	$wp_customize->add_setting( 'grand_hotel_header_submenu_txthovercolor', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_submenu_txthovercolor', array(
		'label' => __('Submenu Text Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_submenu_txthovercolor',
	)));


	$wp_customize->add_setting( 'grand_hotel_header_submenubg_hover', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_header_submenubg_hover', array(
		'label' => __('Submenu BG Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_topbar',
		'settings' => 'grand_hotel_header_submenubg_hover',
	)));

	
	
	//home page slider
	$wp_customize->add_section( 'grand_hotel_slidersettings' , array(
    	'title'      => esc_html__( 'Slider Settings', 'grand-hotel' ),
		'priority'   => null,
		'panel' => 'grand_hotel_panel_id'
	) );

	for ( $count = 1; $count <= 3; $count++ ) {
		$wp_customize->add_setting( 'grand_hotel_slider_page' . $count, array(
			'default'           => '',
			'sanitize_callback' => 'grand_hotel_sanitize_dropdown_pages'
		) );
		$wp_customize->add_control( 'grand_hotel_slider_page' . $count, array(
			'label'    => esc_html__( 'Select Slider Page', 'grand-hotel' ),
			'section'  => 'grand_hotel_slidersettings',
			'type'     => 'dropdown-pages'
		) );
	}

	$wp_customize->add_setting('grand_hotel_sliderbuttonlink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_sliderbuttonlink',array(
		'label'	=> __('Button Link','grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_slider_opacity',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_slider_opacity',array(
		'label'	=> __('Overlay Opacity','grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'type'	 => 'range',
		'input_attrs' => array(
			'min' => 0,
			'max' => 1,
			'step' => 0.1,
		)
	));

	$wp_customize->add_setting( 'grand_hotel_slider_title_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_title_color', array(
		'label' => __('Title Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_title_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_border_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_border_color', array(
		'label' => __('Border Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_border_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_borderball_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_borderball_color', array(
		'label' => __('Border Ball Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_borderball_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_description_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_description_color', array(
		'label' => __('Description Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_description_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_btn_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_btn_color', array(
		'label' => __('Button Text Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_btn_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_btnbg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_btnbg_color', array(
		'label' => __('Button Background Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_btnbg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_btntexthrv_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_btntexthrv_color', array(
		'label' => __('Button Text Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_btntexthrv_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_btnbghrv_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_btnbghrv_color', array(
		'label' => __('Button Background Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_btnbghrv_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_arrow_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_arrow_color', array(
		'label' => __('Arrows Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_arrow_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_arrowbg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_arrowbg_color', array(
		'label' => __('Arrows BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_arrowbg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_slider_outerborder_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_slider_outerborder_color', array(
		'label' => __('Outer Border Color', 'grand-hotel'),
		'section' => 'grand_hotel_slidersettings',
		'settings' => 'grand_hotel_slider_outerborder_color',
	)));
	
	
	//home page services
	$wp_customize->add_section( 'grand_hotel_servicessettings' , array(
    	'title'      => esc_html__( 'Services Settings', 'grand-hotel' ),
		'priority'   => null,
		'panel' => 'grand_hotel_panel_id'
	) );

	$wp_customize->add_setting('grand_hotel_btn_servicesheading',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_btn_servicesheading',array(
		'label'	=> __('Heading','grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'type'	 => 'text'
	));
	
	$wp_customize->add_setting( 'grand_hotel_services_page1', array(
		'default'           => '',
		'sanitize_callback' => 'grand_hotel_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'grand_hotel_services_page1', array(
		'label'    => esc_html__( 'Select services Page', 'grand-hotel' ),
		'section'  => 'grand_hotel_servicessettings',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'grand_hotel_services_page2', array(
		'default'           => '',
		'sanitize_callback' => 'grand_hotel_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'grand_hotel_services_page2', array(
		'label'    => esc_html__( 'Select services Page', 'grand-hotel' ),
		'section'  => 'grand_hotel_servicessettings',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'grand_hotel_services_page3', array(
		'default'           => '',
		'sanitize_callback' => 'grand_hotel_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'grand_hotel_services_page3', array(
		'label'    => esc_html__( 'Select services Page', 'grand-hotel' ),
		'section'  => 'grand_hotel_servicessettings',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'grand_hotel_services_page4', array(
		'default'           => '',
		'sanitize_callback' => 'grand_hotel_sanitize_dropdown_pages'
	) );
	$wp_customize->add_control( 'grand_hotel_services_page4', array(
		'label'    => esc_html__( 'Select services Page', 'grand-hotel' ),
		'section'  => 'grand_hotel_servicessettings',
		'type'     => 'dropdown-pages'
	) );

	$wp_customize->add_setting( 'grand_hotel_services_heading_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_heading_color', array(
		'label' => __('Heading Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_heading_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_headingdot_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_headingdot_color', array(
		'label' => __('Heading Dot Icon Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_headingdot_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_title_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_title_color', array(
		'label' => __('Title Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_title_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_description_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_description_color', array(
		'label' => __('Description Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_description_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_readmoretext_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_readmoretext_color', array(
		'label' => __('Button Text Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_readmoretext_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_readmorebg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_readmorebg_color', array(
		'label' => __('Button BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_readmorebg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_services_readmorebghrv_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_services_readmorebghrv_color', array(
		'label' => __('Button BG Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_servicessettings',
		'settings' => 'grand_hotel_services_readmorebghrv_color',
	)));



	//home page Aboutus
	$wp_customize->add_section( 'grand_hotel_aboutussettings' , array(
		'title'      => esc_html__( 'About Us Settings', 'grand-hotel' ),
		'priority'   => null,
		'panel' => 'grand_hotel_panel_id'
	) );

	$wp_customize->add_setting(
    	'aboutus_image',
	    array(
	        'sanitize_callback' => 'esc_url_raw'
	    )
	);
	$wp_customize->add_control(
	    new WP_Customize_Image_Control(
	        $wp_customize,
	        'aboutus_image',
	        array(
			    'label'   		=> __('Image','grand-hotel'),
				'description'   		=> __('Image size 542*770','grand-hotel'),
	            'section' => 'grand_hotel_aboutussettings',
	            'settings' => 'aboutus_image',
	        )
	    )
	);

	$wp_customize->add_setting('grand_hotel_aboutus_heading',array(
		'default'	=> 'About Us',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_heading',array(
		'label'	=> __('Heading','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_subheading',array(
		'default'	=> 'There are many variations of passages majority have suffered',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_subheading',array(
		'label'	=> __('Sub Heading','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));
	
	$wp_customize->add_setting('grand_hotel_aboutus_description',array(
		'default'	=> 'There are many variations of passages of Lorem Ipsum available, but have suffered alteration in some form, by injected humour, words which dont look even slightly believable. need to be sure there isnt anything embarrassing hidden in the middle of text.',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_description',array(
		'label'	=> __('Description','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));
	
	$wp_customize->add_setting('grand_hotel_aboutus_list1',array(
		'default'	=> '7,000 Sq. Ft. Paradise Well Garden Area',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_list1',array(
		'label'	=> __('List 1','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_list2',array(
		'default'	=> 'Well Garden Area',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_list2',array(
		'label'	=> __('List 2','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_list3',array(
		'default'	=> '12 Bedrooms & Master rooms Walking Area',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_list3',array(
		'label'	=> __('List 3','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_list4',array(
		'default'	=> 'Walking Area',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_list4',array(
		'label'	=> __('List 4','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_btntext',array(
		'default'	=> 'About Us',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_btntext',array(
		'label'	=> __('Button Text','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting('grand_hotel_aboutus_btnlink',array(
		'default'	=> '#',
		'sanitize_callback'	=> 'sanitize_text_field'
	));
	$wp_customize->add_control('grand_hotel_aboutus_btnlink',array(
		'label'	=> __('Button Link','grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'type'	 => 'text'
	));

	$wp_customize->add_setting( 'grand_hotel_aboutus_heading_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_heading_color', array(
		'label' => __('Heading Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_heading_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_aboutus_subheading_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_subheading_color', array(
		'label' => __('Sub Heading Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_subheading_color',
	)));


	$wp_customize->add_setting( 'grand_hotel_aboutus_description_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_description_color', array(
		'label' => __('Description Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_description_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_aboutus_lists_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_lists_color', array(
		'label' => __('Lists Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_lists_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_aboutus_btntext_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_btntext_color', array(
		'label' => __('Button Text Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_btntext_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_aboutus_btnbg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_btnbg_color', array(
		'label' => __('Button BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_btnbg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_aboutus_btnbghrv_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_aboutus_btnbghrv_color', array(
		'label' => __('Button BG Hover Color', 'grand-hotel'),
		'section' => 'grand_hotel_aboutussettings',
		'settings' => 'grand_hotel_aboutus_btnbghrv_color',
	)));


	//footer
	$wp_customize->add_section('grand_hotel_footer_section',array(
		'title'	=> esc_html__('Footer Settings','grand-hotel'),
		'panel' => 'grand_hotel_panel_id'
	));
		
	$wp_customize->add_setting('grand_hotel_footer_copy',array(
		'default'	=> '',
		'sanitize_callback'	=> 'sanitize_text_field'
	));	
	$wp_customize->add_control('grand_hotel_footer_copy',array(
		'label'	=> esc_html__('Copyright Text','grand-hotel'),
		'section'	=> 'grand_hotel_footer_section',
		'type'		=> 'text'
	));

	$wp_customize->add_setting( 'grand_hotel_footer_copyright_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_copyright_color', array(
		'label' => __('Copyright Text Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_copyright_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_copyrightbg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_copyrightbg_color', array(
		'label' => __('Copyright BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_copyrightbg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_title_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_title_color', array(
		'label' => __('Title Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_title_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_text_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_text_color', array(
		'label' => __('Menu Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_text_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_icon_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_icon_color', array(
		'label' => __('Icon Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_icon_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_activemenu_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_activemenu_color', array(
		'label' => __('Active Menu Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_activemenu_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_footer_mainbg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_footer_mainbg_color', array(
		'label' => __('Footer BG Color', 'grand-hotel'),
		'section' => 'grand_hotel_footer_section',
		'settings' => 'grand_hotel_footer_mainbg_color',
	)));


	//Wocommerce Shop Page
	$wp_customize->add_section('grand_hotel_woocommerce_shop_page',array(
		'title'	=> __('Woocommerce Shop Page','grand-hotel'),
		'panel' => 'grand_hotel_panel_id'
	));

	$wp_customize->add_setting( 'grand_hotel_products_per_column' , array(
		'default'           => 3,
		'transport'         => 'refresh',
		'sanitize_callback' => 'grand_hotel_sanitize_choices',
	) );
	$wp_customize->add_control( 'grand_hotel_products_per_column', array(
		'label'    => __( 'Product Per Columns', 'grand-hotel' ),
		'description'	=> __('How many products should be shown per Column?','grand-hotel'),
		'section'  => 'grand_hotel_woocommerce_shop_page',
		'type'     => 'select',
		'choices'  => array(
			'2' => '2',
			'3' => '3',
			'4' => '4',
			'5' => '5',
		),
	)  );

	$wp_customize->add_setting('grand_hotel_products_per_page',array(
		'default'	=> 9,
		'sanitize_callback'	=> 'grand_hotel_sanitize_float',
	));	
	$wp_customize->add_control('grand_hotel_products_per_page',array(
		'label'	=> __('Product Per Page','grand-hotel'),
		'description'	=> __('How many products should be shown per page?','grand-hotel'),
		'section'	=> 'grand_hotel_woocommerce_shop_page',
		'type'		=> 'number'
	));

	

	$wp_customize->add_setting( 'grand_hotel_product_btn_bg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_product_btn_bg_color', array(
		'label' => __('Button Background Color', 'grand-hotel'),
		'section' => 'grand_hotel_woocommerce_shop_page',
		'settings' => 'grand_hotel_product_btn_bg_color',
	)));

	
	$wp_customize->add_setting( 'grand_hotel_product_btn_hover_bg_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_product_btn_hover_bg_color', array(
		'label' => __('Button Hover Background Color', 'grand-hotel'),
		'section' => 'grand_hotel_woocommerce_shop_page',
		'settings' => 'grand_hotel_product_btn_hover_bg_color',
	)));

	$wp_customize->add_setting( 'grand_hotel_product_sale_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_product_sale_color', array(
		'label' => __('Sale Badge Color', 'grand-hotel'),
		'section' => 'grand_hotel_woocommerce_shop_page',
		'settings' => 'grand_hotel_product_sale_color',
	)));


	// logo site title
	$wp_customize->add_setting('grand_hotel_site_title_tagline',array(
       'default' => true,
       'sanitize_callback'	=> 'grand_hotel_sanitize_checkbox'
    ));
    $wp_customize->add_control('grand_hotel_site_title_tagline',array(
       'type' => 'checkbox',
       'label' => __('Display Site Title and Tagline in Header','grand-hotel'),
       'section' => 'title_tagline'
    ));

    $wp_customize->add_setting( 'grand_hotel_site_title_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_site_title_color', array(
		'label' => __('Site Title Color', 'grand-hotel'),
		'section' => 'title_tagline',
		'settings' => 'grand_hotel_site_title_color',
	)));

    $wp_customize->add_setting( 'grand_hotel_site_tagline_color', array(
		'default' => '',
		'sanitize_callback'	=> 'sanitize_hex_color'
	));
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'grand_hotel_site_tagline_color', array(
		'label' => __('Site Tagline Color', 'grand-hotel'),
		'section' => 'title_tagline',
		'settings' => 'grand_hotel_site_tagline_color',
	)));
}
add_action( 'customize_register', 'grand_hotel_customize_register' );