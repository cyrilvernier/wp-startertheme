<?php
    global $post;
    get_header();

$category = get_queried_object();
$current_category = $category->term_id;
$current_category_name = $category->name;

$movies_query = new WP_Query( array(
    'post_type' => 'movie',
    'cat' => $current_category,
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC'
) );

if ( $movies_query -> have_posts() ) :
?>

        <section class="container l-content mt-4 mb-4">
            <div class="row">
               
                <div class="col-12">
                    <hr class="border-4">
                </div>
                
                <div class="col-12 mt-5 mb-5">
                    <h2>tous les articles de la catégorie <mark><?php echo $current_category_name; ?></mark></h2>
                </div>
                
            <?php while ( $movies_query -> have_posts() ) : $movies_query -> the_post(); ?>
                <section class="card col-12 col-sm-6 col-lg-4 col-xl-3 p-10 border-0 mb-4">
                    <a href="<?php the_permalink(); ?>" class="shadow-sm rounded-lg text-reset text-decoration-none">
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
    
<?php get_footer(); ?>
