<?php
/**
 * The Sidebar containing the main widget areas.
 * @package Grand Hotel
 */
?>
<div id="sidebar">    
    <?php if ( ! dynamic_sidebar( 'sidebar-1' ) ) : ?>
        <aside role="complementary" aria-label="sidebar-1" id="archives" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Archives', 'grand-hotel' ); ?></h3>
            <ul>
                <?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
            </ul>
        </aside>
        <aside role="complementary" aria-label="sidebar-2" id="archives" class="widget">
            <h3 class="widget-title"><?php esc_html_e( 'Meta', 'grand-hotel' ); ?></h3>
            <ul>
                <?php wp_meta(); ?>
            </ul>
        </aside>
    <?php endif; // end sidebar widget area ?>  
</div>