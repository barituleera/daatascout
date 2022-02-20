<nav id="site-navigation" class="main-navigation">
    <div class="apa-container">

        <button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false" aria-label="<?php esc_attr_e( 'Menu', 'apace' ); ?>">
            <span class="apa-menu-bars"><?php apace_the_icon_svg( 'menu-bars' ); ?></span>
            <span class="apa-menu-close"><?php apace_the_icon_svg( 'close' ); ?></span>
        </button>

        <?php
            if ( has_nav_menu( 'menu-1' ) ) {
                wp_nav_menu( array(
                    'theme_location' => 'menu-1',
                    'menu_id'        => 'primary-menu',
                    'show_toggles'   => true
                ) );
            } else {
                wp_page_menu( array(
                    'title_li'      => '',
                    'show_toggles'  => true,
                    'walker'        => new Apace_Walker_Page()
                ) );
            }
        ?>
    </div><!-- .apa-container -->
</nav><!-- #site-navigation -->