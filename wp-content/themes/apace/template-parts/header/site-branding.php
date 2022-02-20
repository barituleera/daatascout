<div class="site-branding apa-site-branding">
    
    <div class="apa-logo-container">
        <?php the_custom_logo(); ?>
    </div>

    <div class="apa-site-title-container">
        <?php
        if ( is_front_page() && is_home() ) :
            ?>
            <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
            <?php
        else :
            ?>
            <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
            <?php
        endif;
        $apace_description = get_bloginfo( 'description', 'display' );
        if ( $apace_description || is_customize_preview() ) :
            ?>
            <p class="site-description"><?php echo $apace_description; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></p>
        <?php endif; ?>
    </div><!-- .apa-site-title-container -->

</div><!-- .site-branding -->