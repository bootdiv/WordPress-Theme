<?php
/**
 * The template for displaying product content within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}
$photo = get_the_post_thumbnail_url(get_the_ID(),'full');
?>
<div class="col-sm-6 col-lg-4 col-xl-3">
<div class="product_item">
		<div class="pd_img">
		<?php if ( has_post_thumbnail() ) { ?>
        <img src="<?php echo $photo; ?>" alt="<?php the_title(); ?>" class="img-fluid">
        <?php } else { ?>
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/product0.jpg" alt="<?php the_title(); ?>" class="img-fluid">
        <?php } ?>
			<div class="pd_overly">
				<a class="pd_link" href="<?php echo get_permalink(); ?>">View</a>
	<br>
	<?php
	echo apply_filters(
	'woocommerce_loop_add_to_cart_link', // WPCS: XSS ok.
	sprintf(
		'<a href="%s" data-quantity="%s" class="pd_cart %s" %s>%s</a>',
		esc_url( $product->add_to_cart_url() ),
		esc_attr( isset( $args['quantity'] ) ? $args['quantity'] : 1 ),
		esc_attr( isset( $args['class'] ) ? $args['class'] : 'button' ),
		isset( $args['attributes'] ) ? wc_implode_html_attributes( $args['attributes'] ) : '',
		esc_html( $product->add_to_cart_text() )
	),
	$product,
	$args
);
?>
			</div>
		</div>
        <div class="pd_desc">
            <h2><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h2>
			<?php if ( $price_html = $product->get_price_html() ) : ?>
				<p class="price"><?php echo $price_html; ?></p>
			<?php endif; ?>
        </div>
    </div>	
</div>
