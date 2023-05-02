<?php
/**
 * The template for displaying product search form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/product-searchform.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="pd_search woocommerce-product-search" role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="row g-2">
		<div class="col-12 col-lg-4">
			<?php
			$args = array(
				'show_option_all' => 'Name',
				'taxonomy'        => 'product_cat',
				'name'            => 'product_cat',
				'class'           => 'pd_ser form-select',
				'orderby'         => 'parent',
				'order'           => 'ASC',
				'selected'        => isset( $_GET['product_cat'] ) ? $_GET['product_cat'] : '',
				'hierarchical'    => true,
				'depth'           => 3,
				'show_count'      => false,
				'hide_empty'      => false,
				'value_field'     => 'slug',
			);
			$pd_tag = wp_dropdown_categories( $args );
			?>
		</div>
		<div class="col-12 col-lg-4">
			<input class="pd_ser form-control search-field" type="search" id="woocommerce-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" placeholder="Search" value="<?php echo get_search_query(); ?>" name="s" />
		</div>
		<div class="col-12 col-lg-4">	
			<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'woocommerce' ); ?>" class="pd_btn <?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ); ?>">Search</button>
			<input type="hidden" name="post_type" value="product" />
		</div>
	</div>
</form>