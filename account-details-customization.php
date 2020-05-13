<?php 
function customize_my_account_field() {
	do_action('customize_my_account_field');
}
/**
 * Step 1. Add your field
 */
add_action( 'customize_my_account_field', 'add_phone_number_form' );
function add_phone_number_form() {
 
	woocommerce_form_field(
		'billing_phone',
		array(
			'type'        => 'text',
			'required' => true,
			'label'       => 'Phone Number'
		),
		get_user_meta( get_current_user_id(), 'billing_phone', true ) // get the data
	);
 
}
 
/**
 * Step 2. Save field value
 */
add_action( 'woocommerce_save_account_details', 'save_account_details' );
function save_account_details( $user_id ) {
 
	update_user_meta( $user_id, 'billing_phone', sanitize_text_field( $_POST['billing_phone'] ) );
 
}
 
/**
 * Step 3. Make it required
 */
add_filter('woocommerce_save_account_details_required_fields', 'make_field_required');
function make_field_required( $required_fields ){
	$required_fields['billing_phone'] = 'Phone Number';
	return $required_fields;
}
?>