<?php get_header(); ?>

    <section id="page">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <?php
                    while ( have_posts() ) : the_post();
                        get_template_part( 'content/content-page' );
                    endwhile;
                    ?>
                </div>           
            </div>
        </div>
    </section>

<?php get_footer(); ?>