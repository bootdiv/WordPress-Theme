<?php 
/*
    Template Name: Template Blank
*/
get_header(); ?>

    <section id="page">

        <div class="container">

            <div class="row justify-content-center">

                <div class="col-12 col-lg-10">
                    <div class="page">

                    <?php

                    while ( have_posts() ) : the_post();

                        the_content();

                    endwhile;

                    ?>
                    </div>
                </div>           

            </div>

        </div>

    </section>

<?php get_footer(); ?>