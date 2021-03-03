<?php
    global $post;
    get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        
        <main class="container l-content content mt-4 mb-4">
            <div class="row">
                <article class="col-md-8 main-content">
                    
                    <h2><?php the_author(); ?></h2>
                    <hr>
                    <?php the_content(); ?>
                    
                </article>
                    
            </div>
        </main>
        
<?php endwhile; endif; ?>
   
<?php get_template_part( 'template-parts/postscript', 'part' ); ?>
    
<?php get_footer(); ?>
