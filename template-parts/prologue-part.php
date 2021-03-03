<?php 
$article_query = new WP_Query( array(
    'post_type' => 'movie',
    //'category_name' => 'science-fiction',
//    'orderby' => 'date',
//    'order' => 'DESC'
    'meta_key' => 'post_views_count',
    'orderby' => 'meta_value_num',
    'order' => 'DESC',
    'posts_per_page' => 4,
) );

if ( $article_query -> have_posts() ) :
?>

        <section class="container l-content mt-4 mb-4">
            <div class="row">
                
                <div class="col-12 mt-5 mb-5">
                    <h2>top movies</h2>
                </div>
                
                <?php while ( $article_query -> have_posts() ) : $article_query -> the_post();
                    $categories = get_the_category();
                ?>
                    <a href="<?php the_permalink(); ?>" class="shadow-sm rounded-lg text-reset text-decoration-none">
                    <section class="card col-12 col-sm-6 col-lg-4 col-xl-3 p-10 border-0 mb-4 category-<?php echo $categories[0]->slug; ?>">
                        <?php the_post_thumbnail( 'medium', array('class' => 'card-img-top') ); ?>
                        <div class="card-body">
                            <h4 class="card-title"><?php the_title(); ?></h4>
                            <p class="card-text">année : <?php echo get_field('movie-year'); ?></p>
                            <p class="card-text">durée : <?php echo get_field('movie-duration'); ?> min.</p>
                            <p class="card-text"><?php the_category(); ?></p>
                            <p class="card-text"><?php echo gt_get_post_view(); ?> vues</p>
                            <p class="card-text"><?php the_excerpt(); ?></p>
                        </div>
                    </section>
                    </a>
                <?php endwhile; ?>
                
            </div>
        </section>
   
    <?php wp_reset_postdata(); ?>
 
<?php endif; ?>
