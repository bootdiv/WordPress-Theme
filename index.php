<?php get_header(); ?>

<?php echo get_template_part( 'banner' ); ?>

    <section id="product">
        <div class="container">
            <div class="row">
            <?php
            if ( have_posts() ) {
                while ( have_posts() ) { the_post();
                    get_template_part('content/content-product');
                }

                // Pagination
                if ( function_exists('bootstrap_pagination') )
                bootstrap_pagination();

            } else {
                // No posts found
                get_template_part('content/content-none');
            }
            ?>            
            </div>
        </div>
    </section>

<?php get_footer(); ?>