<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

function mega_store_companion_fields_register($wp_customize) {

	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/sortable/class/class-themefarmer-field-sortable.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/repeater/class/class-themefarmer-field-repeater.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/font-selector/class/class-themefarmer-field-font-selector.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/tabs/class/class-themefarmer-field-tabs.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/range/class/class-themefarmer-field-range.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/image-select/class/class-themefarmer-field-image-select.php';
	require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/switch/class/class-themefarmer-field-switch.php';
}
add_action('customize_register', 'mega_store_companion_fields_register');


function themefarmer_field_repeater_sanitize($input){
	$input_decoded = json_decode($input, true);
	
	if(!empty($input_decoded)) {
		foreach ($input_decoded as $boxk => $box ){
			foreach ($box as $key => $value){
					if(is_array($value)){
						foreach ($value as $skey => $svalue) {
							foreach ($svalue as $sikey => $sivalue) {
								$input_decoded[$boxk][$key][$skey][$sikey] = wp_kses_post( force_balance_tags( $sivalue ) );
							}
						}
					}else{
						$input_decoded[$boxk][$key] = wp_kses_post( force_balance_tags( $value ) );
					}

			}
		}
		return json_encode($input_decoded);
	}
	return $input;
}

function themefarmer_field_sortable_sanitize($input){
	if(is_string($input) && is_array(json_decode($input, true))){
		$input = json_decode($input, true);
	}
	$output = array();
	if(!empty($input)){
		foreach ($input as $key => $value) {
			$output[] = sanitize_text_field($value);
		}
		$output;
	}
	return $input;
}