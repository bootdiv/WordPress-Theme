<?php
$photo = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="col-sm-6 col-lg-4 col-xl-3">
    <div class="product_item">
        <img src="<?php echo $photo; ?>" alt="<?php the_title(); ?>" class="img-fluid">
        <div class="pd_desc">
            <h2><?php the_title(); ?></h2>
            <p><?php the_excerpt(); ?></p>
        </div>
    </div>
</div>