<?php
    global $post;
    get_header();
?>

<?php get_template_part( 'template-parts/prologue', 'part' ); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <main class="container l-content content mt-4 mb-4">
            <div class="row">
                <article class="col-md-8 main-content">
                    
                    <?php the_content(); ?>
                    
                </article>
                
                <?php if ( is_active_sidebar( 'aside' ) ) : ?>
                <aside class="col-md-4 main-content">
                    
                    <?php dynamic_sidebar( 'aside' ); ?>
                
                </aside>
                <?php endif; ?>

            </div>
        </main>
        
<?php endwhile; endif; ?>
   
<?php get_footer(); ?>
