        <header class="l-header header home-header jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h1 class="display-4"><?php bloginfo('name'); ?></h1>
                <p class="lead font-weight-bold"><?php echo get_bloginfo( 'description', 'display' ); ?></p>
            </div>
            <div class="header-hero">
                <?php the_post_thumbnail( 'large', array('class' => 'header-image') ); ?>
            </div>
        </header>
    
    <?php if ( has_nav_menu( 'main-menu' ) ) : ?>
        <nav class="container l-main-navigation main-navigation navigation">
                <?php wp_nav_menu ( array (
                        'container_class'=> 'row',
                        'theme_location' => 'main-menu',
                        'menu_class' => 'col-12 main-navigation--menu',
                    ) ); ?>
        </nav>
    <?php endif; ?>
