<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
	exit;
}

if (!class_exists('WP_Customize_Control')) {
	return;
}


require_once trailingslashit(MEGA_STORE_COMPANION_DIR).'fields/font-selector/inc/functions.php';

class ThemeFarmer_Field_Font_Selector extends WP_Customize_Control {

	public $type    = 'themefarmer-font-selector';
	

	/**
	 * Class constructor
	 */
	public function __construct($manager, $id, $args = array()) {
		parent::__construct($manager, $id, $args);
	}

	public function enqueue() {

		wp_enqueue_style('themefarmer-select2', MEGA_STORE_COMPANION_URI . 'assets/css/select2.min.css');
		wp_enqueue_style('themefarmer-font-selector', MEGA_STORE_COMPANION_URI . 'fields/font-selector/css/themefarmer-font-selector.css');
		wp_enqueue_script('themefarmer-select2', MEGA_STORE_COMPANION_URI . 'assets/js/select2.min.js', array('jquery'), null, true);
		wp_enqueue_script('themefarmer-font-selector', MEGA_STORE_COMPANION_URI . 'fields/font-selector/js/themefarmer-font-selector.js', array('jquery','themefarmer-select2'), null, true);
	}
	

	protected function render_content() {
		$value = $this->value(); 
		$standerd_fonts = themefarmer_get_standard_fonts();
		$google_fonts = themefarmer_get_google_fonts();
		?>
		<label>
			<?php if ( ! empty( $this->label ) ) : ?>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php endif; ?>
			<?php if ( ! empty( $this->description ) ) : ?>
				<span class="description customize-control-description"><?php echo wp_kses_post( $this->description ); ?></span>
			<?php endif; ?>
			<select class="themefarmer-select themefarmer-typography-select" id="themefarmer-font-selector-<?php echo esc_attr($this->id); ?>" <?php $this->link(); ?>>
				<option value="" <?php selected($value, ''); ?> ><?php esc_html_e('Default', 'mega-store-companion') ?></option>
				<?php if(!empty($standerd_fonts)):?>
					<optgroup label="<?php esc_html_e( 'Standard Fonts', 'mega-store-companion' ); ?>">
					<?php foreach ($standerd_fonts as $key => $font): ?>
						<option value="<?php echo esc_attr($font); ?>" <?php selected($font, $value); ?>><?php echo esc_html($font); ?></option>
					<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
				<?php if(!empty($google_fonts)):?>
					<optgroup label="<?php esc_html_e( 'Google Fonts', 'mega-store-companion' ); ?>">
					<?php foreach ($google_fonts as $key => $font): ?>
						<option value="<?php echo esc_attr($font); ?>" <?php selected($font, $value); ?>><?php echo esc_html($font); ?></option>
					<?php endforeach; ?>
					</optgroup>
				<?php endif; ?>
			</select>
		</label>
		<?php
	}
}