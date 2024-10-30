<?php
/*
Plugin Name: Mega Store Companion
Description: Advance Extension For Mega Store Theme. enjoy full functionality of Mega Store theme by installing this plugin.
Author: ThemeFarmer
Author URI: https://www.themefarmer.com/
Domain Path: /lang/
Version: 1.3
Text Domain: mega-store-companion

Mega Store Companion is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 2 of the License, or
any later version.

Mega Store Companion is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with Mega Store Companion. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

define('MEGA_STORE_COMPANION_DIR', plugin_dir_path(__FILE__));
define('MEGA_STORE_COMPANION_URI', plugin_dir_url(__FILE__));
define('MEGA_STORE_COMPANION_VAR', '1.3');

require_once trailingslashit(MEGA_STORE_COMPANION_DIR) . 'fields/fields-init.php';

if (!function_exists('mega_store_companion')) {
	function mega_store_companion() {

	}
}



function mega_store_companion_init() {
	load_plugin_textdomain('mega-store-companion', false, dirname(plugin_basename(__FILE__)) . '/languages');

}
add_action('plugins_loaded', 'mega_store_companion_init');

function mega_store_companion_customize_register($wp_customize) {

	/*Panels Start*/
	$wp_customize->add_panel('mega_store_homepage', array(
		'priority' => 2,
		'title'    => esc_html__('Homepage Options', 'mega-store-companion'),
	));
	/*Panel End*/

/* Sections Start */

	$wp_customize->add_section('mega_store_home_layout_section', array(
		'title'      => esc_html__('Home Section Manager', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 10,
	));

	$wp_customize->add_section('mega_store_home_slider_section', array(
		'title'      => esc_html__('Slider', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 10,
	));

	$wp_customize->add_section('mega_store_home_features_section', array(
		'title'      => esc_html__('Features', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 20,
	));

	$wp_customize->add_section('mega_store_home_about_section', array(
		'title'      => esc_html__('About', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 40,
	));

	$wp_customize->add_section('mega_store_home_products_latest_section', array(
		'title'      => esc_html__('Latest Products', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 40,
	));

	$wp_customize->add_section('mega_store_home_blog_section', array(
		'title'      => esc_html__('Blog', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 50,
	));

	$wp_customize->add_section('mega_store_home_services_section', array(
		'title'      => esc_html__('Services', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 60,
	));

	$wp_customize->add_section('mega_store_home_testimonials_section', array(
		'title'      => esc_html__('Testimonials', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 70,
	));

	$wp_customize->add_section('mega_store_home_brands_section', array(
		'title'      => esc_html__('Brands', 'mega-store-companion'),
		'panel'      => 'mega_store_homepage',
		'capability' => 'edit_theme_options',
		'priority'   => 80,
	));

	$wp_customize->add_section('mega_store_socials_section', array(
		'title'      => esc_html__('Header Social Links', 'mega-store-companion'),
		'capability' => 'edit_theme_options',
		'priority'   => 20,
	));

/* Sections End */

/*home layout*/
	$wp_customize->add_setting('mega_store_home_layout', array(
		'sanitize_callback' => 'themefarmer_field_sortable_sanitize',
		'transport'         => 'refresh',
		'default'           => array('slider', 'hero', 'features', 'products-latest', 'about', 'blog', 'services', 'testimonials', 'brands'),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Sortable($wp_customize, 'mega_store_home_layout', array(
		'label'    => esc_html__('Home Page Layout', 'mega-store-companion'),
		'priority' => 30,
		'section'  => 'mega_store_home_layout_section',
		'choices'  => array(
			'about'           => esc_html__('About', 'mega-store-companion'),
			'blog'            => esc_html__('Blog', 'mega-store-companion'),
			'brands'          => esc_html__('Brands', 'mega-store-companion'),
			'features'        => esc_html__('Features', 'mega-store-companion'),
			'hero'            => esc_html__('Hero Image', 'mega-store-companion'),
			'products-latest' => esc_html__('Latest Products', 'mega-store-companion'),
			'services'        => esc_html__('Services', 'mega-store-companion'),
			'slider'          => esc_html__('Slider', 'mega-store-companion'),
			'testimonials'    => esc_html__('Testimonials', 'mega-store-companion'),
		),
	)));

/*home layout*/

/*Slider start*/

	$wp_customize->add_setting('mega_store_home_slider', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport'         => 'postMessage',
		'default'           => json_encode(array(
			array(
				'heading'      => esc_attr__('Shop With Essentials Prices', 'mega-store-companion'),
				'description'  => esc_attr__('DISCOUNT AVAILABLE', 'mega-store-companion'),
				'image'        => get_template_directory_uri() . '/images/slide1.jpg',
				'button1_text' => esc_attr__('View Details', 'mega-store-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'mega-store-companion'),
				'button2_url'  => '#',
			),
			array(
				'heading'      => esc_attr__('Shop With Essentials Prices', 'mega-store-companion'),
				'description'  => esc_attr__('DISCOUNT AVAILABLE', 'mega-store-companion'),
				'image'        => get_template_directory_uri() . '/images/slide2.jpg',
				'button1_text' => esc_attr__('View Details', 'mega-store-companion'),
				'button1_url'  => '#',
				'button2_text' => esc_attr__('Buy Now', 'mega-store-companion'),
				'button2_url'  => '#',
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_home_slider', array(
		'label'     => esc_html__('Slide', 'mega-store-companion'),
		'section'   => 'mega_store_home_slider_section',
		'priority'  => 30,
		'row_label' => esc_html__('Slide', 'mega-store-companion'),
		'fields'    => array(
			'heading'      => array(
				'type'    => 'text',
				'label'   => esc_attr__('Title', 'mega-store-companion'),
				'default' => esc_attr('Slide Heading', 'mega-store-companion'),
			),
			'description'  => array(
				'type'    => 'textarea',
				'label'   => esc_attr__('Description', 'mega-store-companion'),
				'default' => esc_attr('Awesome Slide Description', 'mega-store-companion'),
			),
			'image'        => array(
				'type'    => 'image',
				'label'   => esc_attr__('Image', 'mega-store-companion'),
				'default' => esc_url(get_template_directory_uri() . '/images/slide1.jpg'),
			),
			'button1_text' => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button Text', 'mega-store-companion'),
				'default' => esc_attr__('Read More', 'mega-store-companion'),
			),
			'button1_url'  => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button URL', 'mega-store-companion'),
				'default' => esc_url('#'),
			),
			'button2_text' => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button Text', 'mega-store-companion'),
				'default' => esc_attr__('Buy Now', 'mega-store-companion'),
			),
			'button2_url'  => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button URL', 'mega-store-companion'),
				'default' => esc_url('#'),
			),

		),
	)));

	$wp_customize->selective_refresh->add_partial('mega_store_home_slider', array(
		'selector'         => '.home-carousel .carousel-caption',
		'fallback_refresh' => false,
	));

/*Slider end*/

/*Services start*/

	$wp_customize->add_setting('mega_store_home_services_heading', array(
		'default'           => esc_html__('Services', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_services_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'mega-store'),
		'section' => 'mega_store_home_services_section',
	));

	$wp_customize->add_setting('mega_store_home_services_desc', array(
		'default'           => esc_html__('Services Description', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport' => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_services_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'mega-store'),
		'section' => 'mega_store_home_services_section',
	));

	$wp_customize->add_setting('mega_store_home_services', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport' => 'postMessage',
		'default'           => json_encode(array(
			array(
				'heading'     => esc_attr__('Awesome Service', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Service Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide1.jpg',
				'icon'        => 'fa-flash',
				'button_text' => esc_attr__('Read More', 'mega-store-companion'),
				'button_url'  => '#',
				'page_id'     => 0,
			),
			array(
				'heading'     => esc_attr__('Awesome Service', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Service Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide2.jpg',
				'icon'        => 'fa-star',
				'button_text' => esc_attr__('Read More', 'mega-store-companion'),
				'button_url'  => '#',
				'page_id'     => 0,
			),
			array(
				'heading'     => esc_attr__('Awesome Service', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Service Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide3.jpg',
				'icon'        => 'fa-star',
				'button_text' => esc_attr__('Read More', 'mega-store-companion'),
				'button_url'  => '#',
				'page_id'     => 0,
			),
			array(
				'heading'     => esc_attr__('Awesome Service', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Service Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide1.jpg',
				'icon'        => 'fa-star',
				'button_text' => esc_attr__('Read More', 'mega-store-companion'),
				'button_url'  => '#',
				'page_id'     => 0,
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_home_services', array(
		'label'     => esc_html__('Services', 'mega-store-companion'),
		'section'   => 'mega_store_home_services_section',
		'priority'  => 30,
		'row_label' => esc_html__('Service', 'mega-store-companion'),
		'fields'    => array(
			'heading'     => array(
				'type'    => 'text',
				'label'   => esc_attr__('Title', 'mega-store-companion'),
				'default' => esc_attr('Service Heading', 'mega-store-companion'),
			),
			'description' => array(
				'type'    => 'textarea',
				'label'   => esc_attr__('Description', 'mega-store-companion'),
				'default' => esc_attr('Service Description', 'mega-store-companion'),
			),
			'image'       => array(
				'type'    => 'image',
				'label'   => esc_attr__('Image', 'mega-store-companion'),
				'default' => esc_url(get_template_directory_uri() . '/images/slide1.jpg'),
			),
			'icon'        => array(
				'type'    => 'icon',
				'label'   => esc_attr__('Icon', 'mega-store-companion'),
				'default' => 'fa-star',
			),
			'button_text' => array(
				'type'    => 'text',
				'label'   => esc_attr__('Button Text', 'mega-store-companion'),
				'default' => esc_attr__('Read More', 'mega-store-companion'),
			),
			'page_id'     => array(
				'type'        => 'dropdown-pages',
				'label'       => esc_attr__('Select Feature Detail Page', 'mega-store-companion'),
				'description' => esc_html__('Leave it unselected if you want to enter custom link', 'mega-store-companion'),
			),
			'button_url'  => array(
				'type'        => 'text',
				'label'       => esc_attr__('Details page  URL', 'mega-store-companion'),
				'description' => esc_html__('Leave it blank if you have to selected Details page above', 'mega-store-companion'),
			),
		),
	)));

	$wp_customize->selective_refresh->add_partial('mega_store_home_services', array(
		'selector'         => '.section-services .service-item',
		'fallback_refresh' => false,
	));
/*Services end*/

/*Features start*/
	$wp_customize->add_setting('mega_store_home_features_heading', array(
		'default'           => esc_html__('Features', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_features_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'mega-store'),
		'section' => 'mega_store_home_features_section',
	));

	$wp_customize->add_setting('mega_store_home_features_desc', array(
		'default'           => esc_html__('Features Description', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_features_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'mega-store'),
		'section' => 'mega_store_home_features_section',
	));

	$wp_customize->add_setting('mega_store_home_features', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport'         => 'postMessage',
		'default'           => json_encode(array(
			array(
				'heading'     => esc_attr__('Awesome Feature', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Feature Description 1', 'mega-store-companion'),
				'icon'        => 'fa-flash',
			),
			array(
				'heading'     => esc_attr__('Awesome Feature', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Feature Description', 'mega-store-companion'),
				'icon'        => 'fa-star',
			),
			array(
				'heading'     => esc_attr__('Awesome Feature', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Feature Description 1', 'mega-store-companion'),
				'icon'        => 'fa-flash',
			),
			array(
				'heading'     => esc_attr__('Awesome Feature', 'mega-store-companion'),
				'description' => esc_attr__('Awesome Feature Description', 'mega-store-companion'),
				'icon'        => 'fa-star',
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_home_features', array(
		'label'     => esc_html__('Features', 'mega-store-companion'),
		'section'   => 'mega_store_home_features_section',
		'priority'  => 30,
		'row_label' => esc_html__('Feature', 'mega-store-companion'),
		'fields'    => array(
			'heading'     => array(
				'type'    => 'text',
				'label'   => esc_attr__('Title', 'mega-store-companion'),
				'default' => esc_attr('Feature Heading', 'mega-store-companion'),
			),
			'description' => array(
				'type'    => 'textarea',
				'label'   => esc_attr__('Description', 'mega-store-companion'),
				'default' => esc_attr('Feature Description', 'mega-store-companion'),
			),
			'icon'        => array(
				'type'    => 'icon',
				'label'   => esc_attr__('Icon', 'mega-store-companion'),
				'default' => 'fa-star',
			),
		),
	)));

	$wp_customize->selective_refresh->add_partial('mega_store_home_features', array(
		'selector'         => '.section-features .feature-item',
		'fallback_refresh' => false,
	));

/*Features end*/

/*About start*/
	$wp_customize->add_setting('mega_store_home_about_heading', array(
		'default'           => esc_html__('About Us', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_about_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'mega-store'),
		'section' => 'mega_store_home_about_section',
	));

	$wp_customize->add_setting('mega_store_home_about_desc', array(
		'default'           => esc_html__('About Us Description', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_about_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'mega-store'),
		'section' => 'mega_store_home_about_section',
	));

	$wp_customize->add_setting('mega_store_home_about_image', array(
		'sanitize_callback' => 'esc_url_raw',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'mega_store_home_about_image', array(
		'label'   => esc_html__('Image', 'mega-store'),
		'section' => 'mega_store_home_about_section',
	)));
/*About end*/

/*Testimonials start*/

	$wp_customize->add_setting('mega_store_home_testimonials_heading', array(
		'default'           => esc_html__('Testimonials', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_testimonials_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'mega-store'),
		'section' => 'mega_store_home_testimonials_section',
	));

	$wp_customize->add_setting('mega_store_home_testimonials_desc', array(
		'default'           => esc_html__('Testimonials Description', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_testimonials_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'mega-store'),
		'section' => 'mega_store_home_testimonials_section',
	));

	$wp_customize->add_setting('mega_store_home_testimonials', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport'         => 'postMessage',
		'default'           => json_encode(array(
			array(
				'heading'     => esc_attr__('Testimonial Heading', 'mega-store-companion'),
				'description' => esc_attr__('Testimonial Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide1.jpg',
				'web_name'    => esc_attr__('example.com', 'mega-store-companion'),
				'web_link'    => '#example.com',
			),
			array(
				'heading'     => esc_attr__('Testimonial Heading', 'mega-store-companion'),
				'description' => esc_attr__('Testimonial Description', 'mega-store-companion'),
				'image'       => get_template_directory_uri() . '/images/slide2.jpg',
				'web_name'    => esc_attr__('example.com', 'mega-store-companion'),
				'web_link'    => '#example.com',
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_home_testimonials', array(
		'label'     => esc_html__('Testimonials', 'mega-store-companion'),
		'section'   => 'mega_store_home_testimonials_section',
		'priority'  => 30,
		'row_label' => esc_html__('Testimonial', 'mega-store-companion'),
		'fields'    => array(
			'heading'     => array(
				'type'              => 'text',
				'label'             => esc_attr__('Title', 'mega-store-companion'),
				'default'           => esc_attr('Awesome Slide Heading', 'mega-store-companion'),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'description' => array(
				'type'              => 'textarea',
				'label'             => esc_attr__('Description', 'mega-store-companion'),
				'default'           => esc_attr('Awesome Slide Description', 'mega-store-companion'),
				'sanitize_callback' => 'sanitize_text_field',
			),
			'image'       => array(
				'type'    => 'image',
				'label'   => esc_attr__('Image', 'mega-store-companion'),
				'default' => esc_url(get_template_directory_uri() . '/images/slide1.jpg'),
			),
		),
	)));

	$wp_customize->selective_refresh->add_partial('mega_store_home_testimonials', array(
		'selector'         => '.section-testimonials .feature-item',
		'fallback_refresh' => false,
	));
/*Testimonials end*/

/*Brands start*/
	$wp_customize->add_setting('mega_store_home_brands_heading', array(
		'default'           => esc_html__('Brands', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_brands_heading', array(
		'type'    => 'text',
		'label'   => esc_html__('Heading', 'mega-store'),
		'section' => 'mega_store_home_brands_section',
	));

	$wp_customize->add_setting('mega_store_home_brands_desc', array(
		'default'           => esc_html__('Brands Description', 'mega-store'),
		'sanitize_callback' => 'sanitize_text_field',
		'transport'         => 'postMessage',
	));

	$wp_customize->add_control('mega_store_home_brands_desc', array(
		'type'    => 'textarea',
		'label'   => esc_html__('Description', 'mega-store'),
		'section' => 'mega_store_home_brands_section',
	));

	$wp_customize->add_setting('mega_store_home_brands', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport'         => 'postMessage',
		'default'           => json_encode(array(
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand1.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand2.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand3.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand4.png',
			),
			array(
				'image' => get_template_directory_uri() . '/images/brands/brand5.png',
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_home_brands', array(
		'label'     => esc_html__('Brands', 'mega-store-companion'),
		'section'   => 'mega_store_home_brands_section',
		'priority'  => 30,
		'row_label' => esc_html__('Brand', 'mega-store-companion'),
		'fields'    => array(
			'image'      => array(
				'type'  => 'image',
				'label' => esc_attr__('Image', 'mega-store-companion'),
			),
			'brand_link' => array(
				'type'  => 'text',
				'label' => esc_attr__('Brand URL', 'mega-store-companion'),
			),
		),
	)));
/*Brands end*/

/*Social Links*/
	$wp_customize->add_setting('mega_store_socials', array(
		'sanitize_callback' => 'themefarmer_field_repeater_sanitize',
		'transport'         => 'postMessage',
		'default'           => json_encode(array(
			array(
				'icon' => 'fa-facebook',
				'link' => '#',
			),
			array(
				'icon' => 'fa-youtube',
				'link' => '#',
			),
			array(
				'icon' => 'fa-instagram',
				'link' => '#',
			),
			array(
				'icon' => 'fa-google-plus',
				'link' => '#',
			),
			array(
				'icon' => 'fa-linkedin',
				'link' => '#',
			),
		)),
	));

	$wp_customize->add_control(new ThemeFarmer_Field_Repeater($wp_customize, 'mega_store_socials', array(
		'label'     => esc_html__('Social Links', 'mega-store-companion'),
		'section'   => 'mega_store_socials_section',
		'priority'  => 30,
		'row_label' => esc_html__('Social Site', 'mega-store-companion'),
		'fields'    => array(
			'icon' => array(
				'type'    => 'icon',
				'label'   => esc_attr__('Icon', 'mega-store-companion'),
				'default' => 'fa-star',
			),
			'link' => array(
				'type'  => 'text',
				'label' => esc_attr__('Social Link', 'mega-store-companion'),
			),
		),
	)));
/*social Links*/




	$partials = array(
		array(
			'heading'     => array(
				'id'    => 'mega_store_home_services_heading',
				'selector' => '.section-services .section-title',
			),
			'description' => array(
				'id'    => 'mega_store_home_services_desc',
				'selector' => '.section-services .section-description',
			),
		),
		array(
			'heading'     => array(
				'id'    => 'mega_store_home_features_heading',
				'selector' => '.section-features .section-title',
			),
			'description' => array(
				'id'    => 'mega_store_home_features_desc',
				'selector' => '.section-features .section-description',
			),
		),
		array(
			'heading'     => array(
				'id'    => 'mega_store_home_testimonials_heading',
				'selector' => '.section-testimonials .section-title',
			),
			'description' => array(
				'id'    => 'mega_store_home_testimonials_desc',
				'selector' => '.section-testimonials .section-description',
			),
		),
		array(
			'heading'     => array(
				'id'    => 'mega_store_home_brands_heading',
				'selector' => '.section-brands .section-title',
			),
			'description' => array(
				'id'    => 'mega_store_home_brands_desc',
				'selector' => '.section-brands .section-description',
			),
		),
		array(
			'heading'     => array(
				'id'    => 'mega_store_home_about_heading',
				'selector' => '.section-about .section-title',
			),
			'description' => array(
				'id'    => 'mega_store_home_about_desc',
				'selector' => '.section-about .section-description',
			),
		),
	);

	foreach ($partials as $key => $partial) {
		foreach ($partial as $key => $item) {
			$wp_customize->selective_refresh->add_partial($item['id'], array(
				'selector'         => $item['selector'],
				'fallback_refresh' => false,
			));
		}
	}

}

$theme = wp_get_theme();
if ( 'Mega Store' === $theme->name || 'Mega Store' === $theme->parent_theme ) {
	add_action('customize_register', 'mega_store_companion_customize_register');
}
   


function mega_store_companion_live_customizer(){
	wp_enqueue_script('mega-store-companion-customizer', MEGA_STORE_COMPANION_URI . 'assets/js/mega-store-companion-customizer.js', array('jquery', 'mega-store-custom-script'), MEGA_STORE_COMPANION_VAR, true);
}
add_action('customize_preview_init', 'mega_store_companion_live_customizer');

register_activation_hook(__FILE__, 'mega_store_companion_activation');
function mega_store_companion_activation() {
	flush_rewrite_rules();
}
