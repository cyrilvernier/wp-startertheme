        <footer class="l-footer footer bg-dark">
            <div class="container text-white pt-5">
                <div class="row">
                <?php if ( is_active_sidebar( 'aside' ) ) : ?>
                    
                    <?php dynamic_sidebar( 'footer' ); ?>
                
                <?php endif; ?>
                </div>
            </div>
        </footer>