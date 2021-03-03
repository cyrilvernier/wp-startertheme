        <header class="l-header header jumbotron jumbotron-fluid">
            <div class="container text-white">
                <h2><a href="<?php echo get_site_url(); ?>" class="text-white"><?php echo bloginfo('name'); ?></a></h2>
                <h1 class="display-4"><?php single_post_title(); ?></h1>
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
