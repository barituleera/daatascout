<header id="masthead" class="site-header">
    
    <div class="apa-header-main-container apa-container">	
        <?php get_template_part( 'template-parts/header/site-branding' ); ?>
        <?php get_template_part( 'template-parts/header/header-sidebar' ); ?>
    </div><!-- .apa-header-main-container -->

    <?php if ( get_header_image() ) : ?>
        <div class="apa-header-image">
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                <img src="<?php header_image(); ?>" width="<?php echo absint( get_custom_header()->width ); ?>" height="<?php echo absint( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">
            </a>
        </div><!-- .apa-header-image -->
    <?php endif; ?>

    <?php get_template_part( 'template-parts/header/site-nav' ); ?>

</header><!-- #masthead -->