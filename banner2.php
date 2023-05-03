<section id="banner">

    <div class="container">

        <div class="row justify-content-center">

            <div class="col-12 col-lg-10">

                <div class="pd_banner">
                    <h2><?php the_archive_title(); ?></h2>

                    <p><?php the_archive_description(); ?></p>

                </div>

                <?php echo get_product_search_form(); ?>

            </div>

        </div>

    </div>

</section>