<?php
$photo = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="product_desc">
    <img src="<?php echo $photo; ?>" alt="<?php the_title(); ?>" class="img-fluid img_pd">
    <h2><?php the_title(); ?></h2>
    <p><?php the_excerpt(); ?></p>
</div>