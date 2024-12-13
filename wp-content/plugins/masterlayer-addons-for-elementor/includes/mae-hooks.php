<?php

// Add new image size
function mae_custom_image_sizes() {	
	add_image_size( 'mae-project-single', 770, 475, true );
	add_image_size( 'mae-project', 370, 467, true );
	add_image_size( 'mae-news', 370, 250, true );
}
add_action( 'after_setup_theme', 'mae_custom_image_sizes' );

// Add new animation
function mea_add_animation_elementor() {
	return $animations = [
		'Fading' => [
			'fadeIn' => 'Fade In',
			'fadeInDown' => 'Fade In Down',
			'fadeInLeft' => 'Fade In Left',
			'fadeInRight' => 'Fade In Right',
			'fadeInUp' => 'Fade In Up',
			'fadeInUpSmall' => 'Fade In Up Small',
			'fadeInDownSmall' => 'Fade In Down Small',
			'fadeInLeftSmall' => 'Fade In Left Small',
			'fadeInRightSmall' => 'Fade In Right Small',
		],
		'Reveal' => [
			'revealTop' => 'reveal Top',
			'revealBottom' => 'reveal Bottom',
			'revealLeft' => 'reveal Left',
			'revealRight' => 'reveal Right',
			'reveal revealTop2' => 'reveal Top 2',
			'reveal revealBottom2' => 'reveal Bottom 2',
			'reveal revealLeft2' => 'reveal Left 2',
			'reveal revealRight2' => 'reveal Right 2',
		]
	];

}
add_filter( 'elementor/controls/animations/additional_animations', 'mea_add_animation_elementor');

// Permarlink for GiveWP
// Init Settings
function mae_givewp_permalink_settings_init() {
    add_settings_section( 'masterlayer-permalink-givewp',  esc_html__( 'Cause permalinks', 'masterlayer' ), 'mae_givewp_permalink_settings', 'permalink' );
}
add_action( 'admin_init', 'mae_givewp_permalink_settings_init' );

function mae_givewp_permalink_settings( $section ) {
    echo wpautop( __( 'If you like, you may enter custom structures for your cause URLs here. For example, using <code>cause</code> would make your product links like <code>' . esc_url(get_home_url()) .'/cause/single-cause/</code>. This setting affects cause URLs only, not things such as cause categories.', 'masterlayer' ));

    $permalinks = get_option('mae_givewp_permalink_settings');
    if(!$permalinks) $permalinks = array();
    $permalinks['cause_permalink_base'] = empty($permalinks['cause_permalink_base']) ? esc_html__('cause', 'masterlayer') : $permalinks['cause_permalink_base'];
    ?>

    <table class="form-table">
        <tbody>
        <tr>
            <th><?php echo __('Custom Base', 'masterlayer'); ?></th>
            <td>
                <?php $option_id = 'cause_permalink_base'; ?>
                <input name="<?php echo $option_id; ?>" id="<?php echo $option_id; ?>" type="text" value="<?php echo esc_attr($permalinks[$option_id]); ?>" class="regular-text code"> <span class="description"><?php esc_html_e( 'Enter a custom base to use. A base must be set or WordPress will use default instead.', 'masterlayer' ); ?></span>
            </td>
        </tr>
        </tbody>
    </table>
    
    <?php
}

// Save Settings
function mae_givewp_permalink_settings_save() {
    if (defined('DOING_AJAX') && DOING_AJAX) return;

    $permalinks = get_option('mae_givewp_permalink_settings');
    if(!$permalinks) $permalinks = array();

    if(isset($_POST['cause_permalink_base'])) {
        $permalinks['cause_permalink_base'] = untrailingslashit(esc_html($_POST['cause_permalink_base']));
    }

    update_option('mae_givewp_permalink_settings', $permalinks);
}   
add_action('admin_init', 'mae_givewp_permalink_settings_save');

// Change Permalink for Give WP
function mae_theme_setup() {
	if (class_exists('Give')) {
		$permalinks = get_option('mae_givewp_permalink_settings');
	    if(!$permalinks) $permalinks = array();
	    $permalinks['cause_permalink_base'] = empty($permalinks['cause_permalink_base']) ? esc_html__('cause', 'masterlayer') : $permalinks['cause_permalink_base'];
	    define('GIVE_SLUG', $permalinks['cause_permalink_base']);
	}
}
add_action( 'after_setup_theme', 'mae_theme_setup' );

// Update notice
function mae_plugin_update_message( $data, $response ) {
    echo '</br>' . $data['upgrade_notice'];
}
add_action( 'in_plugin_update_message-masterlayer-addons-for-elementor/masterlayer-addons-for-elementor.php', 'mae_plugin_update_message', 10, 2 );