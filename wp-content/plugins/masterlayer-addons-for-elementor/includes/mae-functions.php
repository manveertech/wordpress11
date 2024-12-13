<?php

if (!defined('ABSPATH'))
    exit; // Exit if accessed directly


// Get Settings options of elementor
function mae_get_mod( $settings ) {
	// Get the current post id
	$post_id = get_the_ID();

	// Get the page settings manager
	$page_settings_manager = \Elementor\Core\Settings\Manager::get_settings_managers( 'page' );

	// Get the settings model for current post
	$page_settings_model = $page_settings_manager->get_model( $post_id );

	return  $page_settings_model->get_settings( $settings );
}

// Get List Menu
function mea_get_menu_list() {
	$arr = array('custom' => esc_html__( 'Custom Menu', 'mae' ) );
	$menus = get_registered_nav_menus();
	foreach ( $menus as $location => $description ) {
 
    	echo $location . ': ' . $description . '<br />';
	}

	return $arr;
}

// Get Templates
function mae_get_templates() {
	$args = [
        'post_type' => 'elementor_library',
        'posts_per_page' => -1,
    ];

    $page_templates = get_posts($args);
    $options = [];

    if (!empty($page_templates) && !is_wp_error($page_templates)) {
        foreach ($page_templates as $post) {
            if ($post->post_title !== 'Default Kit')
                $options[$post->ID] = $post->post_title;
        }
    }
    return $options;
}

// Get Image Size
function mae_get_image_sizes() {
    $arr = wp_get_registered_image_subsizes();
    $sizes['default'] = 'Default';
    $sizes['full'] = 'Full';
    foreach ($arr as $id => $item) {
        $text = $id . ' ' . $item['width'] . 'x' . $item['height'];
        $sizes[$id] = $text;
    }

    return $sizes;
}

// Event - List Meta
function mae_event_list_meta() {
    $arr = array(
        ''                  => '',
        'cat'               => __( 'Categories', 'masterlayer' ),
        '_event_location'   => __( 'Location', 'masterlayer' ),
        '_event_start_date' => __( 'Date Start', 'masterlayer' ),
        '_event_end_date'   => __( 'Date End', 'masterlayer' ),
        '_event_start_time' => __( 'Time Start', 'masterlayer' ),
        '_event_end_time'   => __( 'Time End', 'masterlayer' ),
        'custom'            => __( 'Custom', 'masterlayer' ),
    );
    return $arr;
}

// Render URL
function mae_render_url( $url, $settings) {
    $link = $settings;
    if ($link['url_type'] == 'link') {
        $cls = "";
        $cls .= ' icon-' . $link['link_icon_position'];

        $link_icon = '';
        if ($link['link_icon'])  {
            $link_icon = sprintf('<span class="icon %1$s"></span>', $link['link_icon']['value']);
        }
        
        ob_start(); ?>
        <div class="url-wrap">
            <a class="master-link <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>">
                <?php if ( $link['link_icon_position'] == 'left' ) echo $link_icon; ?>
                <span><?php echo $settings['url_text']; ?></span>
                <?php if ( $link['link_icon_position'] == 'right' ) echo $link_icon; ?>
            </a>
        </div>

        <?php
        $return = ob_get_clean();
        return $return;
    } else if ($link['url_type'] == 'button') {
        $button = $link;
        $cls = "";
        $cls .= $button['button_style'] . ' icon-' . $button['button_icon_position'];

        $button_icon = '';
        if ($button['button_icon'])  {
            $button_icon = sprintf('<span class="icon %1$s"></span>', $button['button_icon']['value']);
        }
        
        ob_start(); ?>
        <div class="url-wrap">
            <a class="master-button btn-hover-2 <?php echo esc_attr($cls); ?>" href="<?php echo esc_url($url); ?>" >

                <span class="inner">
                    <span class="content-base">
                        <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                        <span class="text"><?php echo $button['url_text']; ?></span>
                        <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                    </span>

                    <span class="content-hover">
                        <?php if ( $button['button_icon_position'] == 'left' ) echo $button_icon; ?>
                        <span class="text"><?php echo $button['url_text']; ?></span>
                        <?php if ( $button['button_icon_position'] == 'right' ) echo $button_icon; ?>
                    </span>
                </span>

                <?php echo '<span class="bg-hover"></span>'; ?>
            </a>
        </div>

        <?php
        $return = ob_get_clean();
        return $return;
    }
}