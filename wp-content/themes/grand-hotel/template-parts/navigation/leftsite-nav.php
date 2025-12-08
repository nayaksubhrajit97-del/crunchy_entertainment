<?php  
/* * Display Theme menus */  
?> 
<div class="header">
    <div class="menubox">
        <?php if (has_nav_menu('primary')): ?>
            <div class="toggle-menu responsive-menu">
                <button role="tab" class="resToggle">
                    <i class="fas fa-bars"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Open Menu', 'grand-hotel'); ?></span>
                </button>
            </div>
        <?php endif; ?>

        <div id="menu-sidebar" class="nav sidebar">
            <nav id="primary-site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e('Top Menu', 'grand-hotel'); ?>">
                <?php
                // Load the full menu (no PHP filtering)
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu-navigation clearfix',
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="primary-menu" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                ));
                ?>
                
                <a href="javascript:void(0)" class="closebtn responsive-menu pt-0">
                    <i class="fas fa-times"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Close Menu', 'grand-hotel'); ?></span>
                </a>
            </nav>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    function updateMenu() {
        let menuItems = document.querySelectorAll("#primary-menu > li");
        let windowWidth = window.innerWidth;
        
        if (windowWidth > 768) { // Desktop view
            menuItems.forEach((item, index) => {
                item.style.display = (index < 3) ? "block" : "none"; // Show only first 3
            });
        } else { // Mobile view
            menuItems.forEach(item => {
                item.style.display = "block"; // Show all menu items
            });
        }
    }

    updateMenu(); // Run on page load

    window.addEventListener("resize", updateMenu); // Run on resize
});
</script>
