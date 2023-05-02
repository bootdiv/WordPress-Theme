<?php
// After theme setup
function mytheme_setup_theme() {

    add_theme_support( 'post-thumbnails' );
    add_theme_support( 'woocommerce' );


    // Register menu
    register_nav_menus( array(
        'main-menu' => __( 'Main Menu', 'textdomain' ),
    ) );
}
add_action( 'after_setup_theme', 'mytheme_setup_theme' );

// Sets the product default price to 0.
function set_product_default_price( $post_id, $post ) {
	$product     = wc_get_product( $post_id );
	$already_set = get_post_meta( $post_id, '_set_default_price', true );
	$price       = $product->get_price();

	if ( 'yes' !== $already_set && empty( $price ) ) {
		$product->set_regular_price( '0' );
		$product->save();

		update_post_meta( $post_id, '_set_default_price', 'yes' );
	}
}
add_action( 'woocommerce_process_product_meta', 'set_product_default_price', 999, 2 );

// Excerpt length
function custom_excerpt_length( $length ) {
    return 15;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

// Excerpt more
function mytheme_excerpt_more( $more ) {
	if ( ! is_single() ) {
		$more = sprintf('');
	}
	return $more;
}
add_filter( 'excerpt_more', 'mytheme_excerpt_more' );

// Include files
include_once 'include/bootstrap_nav_walker.php';
include_once 'include/bootstrap_pagination_walker.php';

// Enqueue the main stylesheet
function mytheme_enqueue_styles() {
    wp_enqueue_style( 'bootstrap-style', get_template_directory_uri() . '/assets/css/bootstrap.min.css', array(), '5.3.0', 'all' );
    wp_enqueue_style( 'wptheme-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_styles' );

// Enqueue the main script
function mytheme_enqueue_scripts() {
    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'bootstrap-script', get_template_directory_uri() . '/assets/js/bootstrap.bundle.min.js', array( 'jquery' ), '5.3.0', true );
}

add_action( 'wp_enqueue_scripts', 'mytheme_enqueue_scripts' );

// Customizer options
function mytheme_customize_register( $wp_customize ) {

    $wp_customize->add_section( 'header_section', array(
        'title'=> __( 'Homepage Options', 'textdomain' ),
        'priority' => 120,
    ) );

    // Upload logo
    $wp_customize->add_setting( 'site_logo', array (
        'default' => get_bloginfo('template_directory') . '/assets/images/logo.png',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'site_logo', array(
        'label' => __( 'Upload Logo', 'textdomain' ),
        'description' => __( 'Upload logo image here', 'textdomain' ),
        'section' => 'header_section',
        'settings' => 'site_logo',
    ) ) );;

    // Search title
    $wp_customize->add_setting( 'search_title', array (
        'default' => ''
    ) );

    $wp_customize->add_control( 'search_title', array(
        'label' => __( 'Search Title', 'textdomain' ),
        'section' => 'header_section',
    ) );


    // Search details
    $wp_customize->add_setting( 'search_desc', array (
        'default' => ''
    ) );

    $wp_customize->add_control( 'search_desc', array(
        'label' => __( 'Search Title', 'textdomain' ),
        'section' => 'header_section',
        'type' => 'textarea'
    ) );

    // Copyright text
    $wp_customize->add_setting( 'copyright_text', array (
        'default' => 'Copyright © 2023 | All right reserved.'
    ) );

    $wp_customize->add_control( 'copyright_text', array(
        'label' => __( 'Copyright Text', 'TextDomain' ),
        'section' => 'header_section',
        'type' => 'textarea'
    ) );

}
add_action( 'customize_register', 'mytheme_customize_register' );

// Registration page extra field
function mytheme_extra_register_fields() {?>
    <p class="form-row form-row-first">
    <label for="reg_billing_first_name"><?php _e( 'First name', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_first_name" id="reg_billing_first_name" value="<?php if ( ! empty( $_POST['billing_first_name'] ) ) esc_attr_e( $_POST['billing_first_name'] ); ?>" />
    </p>

    <p class="form-row form-row-last">
    <label for="reg_billing_last_name"><?php _e( 'Last name', 'woocommerce' ); ?><span class="required">*</span></label>
    <input type="text" class="input-text" name="billing_last_name" id="reg_billing_last_name" value="<?php if ( ! empty( $_POST['billing_last_name'] ) ) esc_attr_e( $_POST['billing_last_name'] ); ?>" />
    </p>

    <p class="form-row form-row-wide">
    <label for="reg_billing_company"><?php _e( 'Company', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="billing_company" id="reg_billing_company" value="<?php esc_attr_e( $_POST['billing_company'] ); ?>" />
    </p>

    <p class="form-row form-row-wide">
    <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
    <input type="text" class="input-text" name="billing_phone" id="reg_billing_phone" value="<?php esc_attr_e( $_POST['billing_phone'] ); ?>" />
    </p>

    <div class="clear"></div>
    <?php
}
add_action( 'woocommerce_register_form_start', 'mytheme_extra_register_fields' );

// register fields Validating
function mytheme_validate_extra_register_fields( $username, $email, $validation_errors ) {

    if ( isset( $_POST['billing_first_name'] ) && empty( $_POST['billing_first_name'] ) ) {

           $validation_errors->add( 'billing_first_name_error', __( '<strong>Error</strong>: First name is required!', 'woocommerce' ) );

    }

    if ( isset( $_POST['billing_last_name'] ) && empty( $_POST['billing_last_name'] ) ) {

           $validation_errors->add( 'billing_last_name_error', __( '<strong>Error</strong>: Last name is required!.', 'woocommerce' ) );

    }
       return $validation_errors;
}

add_action( 'woocommerce_register_post', 'mytheme_validate_extra_register_fields', 10, 3 );

// save extra fields.
function mytheme_save_extra_register_fields( $customer_id ) {
    if ( isset( $_POST['billing_phone'] ) ) {
                 // Phone input filed which is used in WooCommerce
                 update_user_meta( $customer_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
          }
    if ( isset( $_POST['billing_company'] ) ) {
                    // Phone input filed which is used in WooCommerce
                    update_user_meta( $customer_id, 'billing_company', sanitize_text_field( $_POST['billing_company'] ) );
            }
      if ( isset( $_POST['billing_first_name'] ) ) {
             //First name field which is by default
             update_user_meta( $customer_id, 'first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
             // First name field which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_first_name', sanitize_text_field( $_POST['billing_first_name'] ) );
      }
      if ( isset( $_POST['billing_last_name'] ) ) {
             // Last name field which is by default
             update_user_meta( $customer_id, 'last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
             // Last name field which is used in WooCommerce
             update_user_meta( $customer_id, 'billing_last_name', sanitize_text_field( $_POST['billing_last_name'] ) );
      }

}
add_action( 'woocommerce_created_customer', 'mytheme_save_extra_register_fields' );

// after existing fields
function _edit_account_form() {
    $user = wp_get_current_user();
    ?>
     <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_billing_company"><?php _e( 'Company', 'woocommerce' ); ?></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_company" id="reg_billing_company" value="<?php echo esc_attr( $user->billing_company ); ?>" />
    </p>

     <p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
        <label for="reg_billing_phone"><?php _e( 'Phone', 'woocommerce' ); ?></label>
        <input type="text" class="woocommerce-Input woocommerce-Input--phone input-text" name="billing_phone" id="reg_billing_phone" value="<?php echo esc_attr( $user->billing_phone ); ?>" />
    </p>
    <?php
}
add_action( 'woocommerce_edit_account_form_start', 'mytheme_edit_account_form' );

// check and validate the mobile phone
function wooc_field_validation( $args ){
    if ( isset($_POST['billing_phone']) && empty($_POST['billing_phone']) )
        $args->add( 'error', __( 'Please fill in your phone number', 'woocommerce' ),'');
    if ( isset($_POST['billing_company']) && empty($_POST['billing_company']) )
        $args->add( 'error', __( 'Please fill in your company name', 'woocommerce' ),'');
}
add_action( 'woocommerce_save_account_details_errors','wooc_field_validation', 20, 1 );

// Save the mobile phone value to user data
function my_account_saving_new_fields( $user_id ) {
    if( isset($_POST['billing_phone']) && ! empty($_POST['billing_phone']) )
        update_user_meta( $user_id, 'billing_phone', sanitize_text_field($_POST['billing_phone']) );
    if( isset($_POST['billing_company']) && ! empty($_POST['billing_company']) )
        update_user_meta( $user_id, 'billing_company', sanitize_text_field($_POST['billing_company']) );
}
add_action( 'woocommerce_save_account_details', 'my_account_saving_new_fields', 20, 1 );