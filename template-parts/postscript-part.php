<?php 
$article_query = new WP_Query( array(
    'post_type' => 'post',
    'posts_per_page' => 4,
    'orderby' => 'date',
    'order' => 'DESC'
) );

if ( $article_query -> have_posts() ) :
?>

        <section class="container l-content mt-4 mb-4">
            <div class="row">
               
                <div class="col-12">
                    <hr class="border-4">
                </div>
                
                <div class="col-12 mt-5 mb-5">
                    <h2>articles</h2>
                </div>
                
    <?php while ( $article_query -> have_posts() ) : $article_query -> the_post(); ?>
                <section class="card col-12 col-sm-6 col-lg-4 col-xl-3 p-10 border-0 mb-4">
                    <a href="<a href="<?php echo get_permalink(); ?>">" class="shadow-sm rounded-lg text-reset text-decoration-none">
                        <?php the_post_thumbnail( 'medium', array('class' => 'card-img-top') ); ?>
                        <div class="card-body">
                            <h4 class="card-title"><?php the_title(); ?></h4>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                        </div>
                    </a>
                </section>
    <?php endwhile; ?>
            
            </div>
        </section>
 
    <?php wp_reset_postdata(); ?>
 
<?php endif; ?>
