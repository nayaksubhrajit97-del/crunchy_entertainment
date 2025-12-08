<?php 
/*
* Display Theme menus
*/
?>
<div class="header">
    <div class="menubox">
        <?php 
        if(has_nav_menu('primary')) { ?>
            <div class="toggle-menu responsive-menu">
                <button role="tab" class="resToggle">
                    <i class="fas fa-bars"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Open Menu','grand-hotel'); ?></span>
                </button>
            </div>
        <?php } ?>
        <div id="menu-sidebar" class="nav sidebar">
            <nav id="primary-site-navigation" class="primary-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Top Menu', 'grand-hotel' ); ?>">
                <?php
                add_filter('wp_nav_menu_objects', function($items) {
                    $filtered_items = [];
                    $count = 0;
                    $start_from = 4; // Start from the 4th main menu item
                    $end_at = 6; // End at the 6th main menu item
                    $allowed_parents = [];

                    // First, identify the main menu items and select only 4th, 5th, and 6th
                    foreach ($items as $item) {
                        if ($item->menu_item_parent == 0) { // Only count main menu items
                            $count++;
                            if ($count >= $start_from && $count <= $end_at) {
                                $allowed_parents[] = $item->ID; // Store allowed main menu IDs
                            }
                        }
                    }

                    // Now, add only those main items and their children
                    foreach ($items as $item) {
                        if (in_array($item->menu_item_parent, $allowed_parents) || in_array($item->ID, $allowed_parents)) {
                            $filtered_items[] = $item;
                        }
                    }

                    return $filtered_items;
                });

                wp_nav_menu(array( 
                    'theme_location' => 'primary',
                    'container_class' => 'main-menu-navigation clearfix',
                    'menu_class' => 'clearfix',
                    'items_wrap' => '<ul id="%1$s" class="%2$s mobile_nav">%3$s</ul>',
                    'fallback_cb' => 'wp_page_menu',
                ));

                remove_filter('wp_nav_menu_objects', 'limit_menu_items');
                ?>
                <a href="javascript:void(0)" class="closebtn responsive-menu pt-0">
                    <i class="fas fa-times"></i>
                    <span class="screen-reader-text"><?php esc_html_e('Close Menu','grand-hotel'); ?></span>
                </a>
            </nav>
        </div>
    </div>
</div>
