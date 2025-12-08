<?php 

	$grand_hotel_custom_css = '';

	// Site Title Color
	$grand_hotel_site_title_color = get_theme_mod('grand_hotel_site_title_color');
	$grand_hotel_custom_css .= '.logo h1 a, .logo p.site-title a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_site_title_color) . ';';
	$grand_hotel_custom_css .= '}';

	// Site Tagline Color
	$grand_hotel_site_tagline_color = get_theme_mod('grand_hotel_site_tagline_color');
	$grand_hotel_custom_css .= '.logo p.site-description {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_site_tagline_color) . ';';
	$grand_hotel_custom_css .= '}';



	
	//Header

	$grand_hotel_header_topbg = get_theme_mod('grand_hotel_header_topbg');
	$grand_hotel_custom_css .= ' .top-header {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_header_topbg) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_topphonemailcolor = get_theme_mod('grand_hotel_header_topphonemailcolor');
	$grand_hotel_custom_css .= ' #header .phonenum a, #header .email a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_topphonemailcolor) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_topphonemailhvrcolor = get_theme_mod('grand_hotel_header_topphonemailhvrcolor');
	$grand_hotel_custom_css .= ' #header .phonenum a:hover, #header .email a:hover {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_topphonemailhvrcolor) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_socialiconcolor = get_theme_mod('grand_hotel_header_socialiconcolor');
	$grand_hotel_custom_css .= ' #header .socialicons i {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_socialiconcolor) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_socialiconhvrcolor = get_theme_mod('grand_hotel_header_socialiconhvrcolor');
	$grand_hotel_custom_css .= ' #header .socialicons a:hover i {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_socialiconhvrcolor) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_menu_col = get_theme_mod('grand_hotel_header_menu_col');
	$grand_hotel_custom_css .= '.primary-navigation a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_menu_col) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_menuactivehover_col = get_theme_mod('grand_hotel_header_menuactivehover_col');
	$grand_hotel_custom_css .= '.primary-navigation .current_page_item a,.primary-navigation a:hover {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_menuactivehover_col) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_submenu_color = get_theme_mod('grand_hotel_header_submenu_color');
	$grand_hotel_custom_css .= '.primary-navigation ul ul a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_submenu_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_submenu_bg_col = get_theme_mod('grand_hotel_header_submenu_bg_col');
	$grand_hotel_custom_css .= '.primary-navigation ul ul a {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_header_submenu_bg_col) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_submenu_txthovercolor = get_theme_mod('grand_hotel_header_submenu_txthovercolor');
	$grand_hotel_custom_css .= '.primary-navigation ul ul a:hover {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_header_submenu_txthovercolor) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_header_submenubg_hover = get_theme_mod('grand_hotel_header_submenubg_hover');
	$grand_hotel_custom_css .= '.primary-navigation ul ul a:hover {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_header_submenubg_hover) . ';';
	$grand_hotel_custom_css .= '}';



	// Slider
	$grand_hotel_slider_opacity = get_theme_mod('grand_hotel_slider_opacity');
	$grand_hotel_custom_css .= ' #slider .slide-oly {';
		$grand_hotel_custom_css .= 'opacity: ' . esc_attr($grand_hotel_slider_opacity) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_title_color = get_theme_mod('grand_hotel_slider_title_color');
	$grand_hotel_custom_css .= ' #slider .slider-content h2 {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_slider_title_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_border_color = get_theme_mod('grand_hotel_slider_border_color');
	$grand_hotel_custom_css .= ' #slider .slider-content .brd1, #slider .slider-content .brd1:after {';
		$grand_hotel_custom_css .= 'border-color: ' . esc_attr($grand_hotel_slider_border_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_borderball_color = get_theme_mod('grand_hotel_slider_borderball_color');
	$grand_hotel_custom_css .= ' #slider .slider-content .brd1:before {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_slider_borderball_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_description_color = get_theme_mod('grand_hotel_slider_description_color');
	$grand_hotel_custom_css .= ' #slider .slider-content p {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_slider_description_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_btn_color = get_theme_mod('grand_hotel_slider_btn_color');
	$grand_hotel_custom_css .= ' #slider .R_more a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_slider_btn_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_btnbg_color = get_theme_mod('grand_hotel_slider_btnbg_color');
	$grand_hotel_custom_css .= ' #slider .R_more a {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_slider_btnbg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_btntexthrv_color = get_theme_mod('grand_hotel_slider_btntexthrv_color');
	$grand_hotel_custom_css .= ' #slider .R_more a:hover {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_slider_btntexthrv_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_btnbghrv_color = get_theme_mod('grand_hotel_slider_btnbghrv_color');
	$grand_hotel_custom_css .= ' #slider .R_more a:hover {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_slider_btnbghrv_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_arrow_color = get_theme_mod('grand_hotel_slider_arrow_color');
	$grand_hotel_custom_css .= ' #slider .splide__arrow--prev svg, #slider .splide__arrow--next svg {';
		$grand_hotel_custom_css .= 'fill: ' . esc_attr($grand_hotel_slider_arrow_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_arrowbg_color = get_theme_mod('grand_hotel_slider_arrowbg_color');
	$grand_hotel_custom_css .= ' #slider .splide__arrow:before {';
		$grand_hotel_custom_css .= 'outline: ' . esc_attr($grand_hotel_slider_arrowbg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_arrowbg_color = get_theme_mod('grand_hotel_slider_arrowbg_color');
	$grand_hotel_custom_css .= ' #slider .splide__arrow--prev:after, #slider .splide__arrow--next:after {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_slider_arrowbg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_slider_outerborder_color = get_theme_mod('grand_hotel_slider_outerborder_color');
	$grand_hotel_custom_css .= ' #slider .slide-brd {';
		$grand_hotel_custom_css .= 'border-color: ' . esc_attr($grand_hotel_slider_outerborder_color) . ';';
	$grand_hotel_custom_css .= '}';



	//services
	$grand_hotel_services_heading_color = get_theme_mod('grand_hotel_services_heading_color');
	$grand_hotel_custom_css .= '#services .services-head h3 {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_services_heading_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_headingdot_color = get_theme_mod('grand_hotel_services_headingdot_color');
	$grand_hotel_custom_css .= '#services .services-head h3 i {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_services_headingdot_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_title_color = get_theme_mod('grand_hotel_services_title_color');
	$grand_hotel_custom_css .= ' #services .content h2 {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_services_title_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_description_color = get_theme_mod('grand_hotel_services_description_color');
	$grand_hotel_custom_css .= '#services .content p {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_services_description_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_readmoretext_color = get_theme_mod('grand_hotel_services_readmoretext_color');
	$grand_hotel_custom_css .= ' #services .bttn a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_services_readmoretext_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_readmorebg_color = get_theme_mod('grand_hotel_services_readmorebg_color');
	$grand_hotel_custom_css .= ' #services .bttn a {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_services_readmorebg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_services_readmorebghrv_color = get_theme_mod('grand_hotel_services_readmorebghrv_color');
	$grand_hotel_custom_css .= ' #services .bttn a:hover {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_services_readmorebghrv_color) . ';';
	$grand_hotel_custom_css .= '}';


	// aboutus

	$grand_hotel_aboutus_heading_color = get_theme_mod('grand_hotel_aboutus_heading_color');
	$grand_hotel_custom_css .= ' #aboutus .conbx h4 {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_aboutus_heading_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_subheading_color = get_theme_mod('grand_hotel_aboutus_subheading_color');
	$grand_hotel_custom_css .= ' #aboutus .conbx h5 {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_aboutus_subheading_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_description_color = get_theme_mod('grand_hotel_aboutus_description_color');
	$grand_hotel_custom_css .= ' #aboutus .conbx p {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_aboutus_description_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_lists_color = get_theme_mod('grand_hotel_aboutus_lists_color');
	$grand_hotel_custom_css .= ' #aboutus .list li, #aboutus .list li i {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_aboutus_lists_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_btntext_color = get_theme_mod('grand_hotel_aboutus_btntext_color');
	$grand_hotel_custom_css .= ' #aboutus .abtbtn a {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_aboutus_btntext_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_btnbg_color = get_theme_mod('grand_hotel_aboutus_btnbg_color');
	$grand_hotel_custom_css .= ' #aboutus .abtbtn a {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_aboutus_btnbg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_aboutus_btnbghrv_color = get_theme_mod('grand_hotel_aboutus_btnbghrv_color');
	$grand_hotel_custom_css .= ' #aboutus .abtbtn a:hover {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_aboutus_btnbghrv_color) . ';';
	$grand_hotel_custom_css .= '}';


	//footer
	$grand_hotel_footer_copyright_color = get_theme_mod('grand_hotel_footer_copyright_color');
	$grand_hotel_custom_css .= '#footer-section .copyright p {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_footer_copyright_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_copyrightbg_color = get_theme_mod('grand_hotel_footer_copyrightbg_color');
	$grand_hotel_custom_css .= '.copyright {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_footer_copyrightbg_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_title_color = get_theme_mod('grand_hotel_footer_title_color');
	$grand_hotel_custom_css .= '#footer-section h3.widget-title {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_footer_title_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_text_color = get_theme_mod('grand_hotel_footer_text_color');
	$grand_hotel_custom_css .= '#footer-section h1,#footer-section h2,
	#footer-section h3,#footer-section h4,#footer-section h5,
	#footer-section h6,#footer-section p,#footer-section a, .footersec .widget li {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_footer_text_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_icon_color = get_theme_mod('grand_hotel_footer_icon_color');
	$grand_hotel_custom_css .= '#footer-section li:before, #footer-section i {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_footer_icon_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_activemenu_color = get_theme_mod('grand_hotel_footer_activemenu_color');
	$grand_hotel_custom_css .= '#footer-section .current-menu-item a,#footer-section .current-menu-item:before {';
		$grand_hotel_custom_css .= 'color: ' . esc_attr($grand_hotel_footer_activemenu_color) . ';';
	$grand_hotel_custom_css .= '}';

	$grand_hotel_footer_mainbg_color = get_theme_mod('grand_hotel_footer_mainbg_color');
	$grand_hotel_custom_css .= '#footer-section .footer-overlay {';
		$grand_hotel_custom_css .= 'background: ' . esc_attr($grand_hotel_footer_mainbg_color) . ';';
	$grand_hotel_custom_css .= '}';
