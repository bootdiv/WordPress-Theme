<?php get_header(); ?>

    <section id="page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-8">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content/content-single' );
                    endwhile;
                    ?>
                </div>           
            </div>
        </div>
    </section>

<?php get_footer(); ?>