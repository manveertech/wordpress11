<?php
/**
 * Blog setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Posts General
$this->sections['congin_blog_post'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_featured_title',
			'default' => esc_html__( 'Our Blog', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Blog Featured Title', 'congin' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_content_background',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Content Background Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.post-content-wrap',
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_entry_content_padding',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Content Padding', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'padding',
			),
		),
		array(
			'id' => 'blog_entry_bottom_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Entry Bottom Margin', 'congin' ),
				'description' => esc_html__( 'Example: 30px.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry',
				'alter' => 'margin-top',
			),
		),
		array(
			'id' => 'blog_entry_border_width',
			'transport' => 'postMessage',
			'control' => array (
				'type' => 'text',
				'label' => esc_html__( 'Entry Border Width', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0px 2px 0px 0px', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-width',
			),
		),
		array(
			'id' => 'blog_entry_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Entry Border Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-wrap',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_entry_composer',
			'default' => 'meta,title,excerpt_content,readmore',
			'control' => array(
				'label' => esc_html__( 'Entry Content Elements', 'congin' ),
				'type' => 'congin-sortable',
				'object' => 'Congin_Customize_Control_Sorter',
				'choices' => array(
					'meta'            => esc_html__( 'Meta', 'congin' ),
					'title'           => esc_html__( 'Title', 'congin' ),
					'excerpt_content' => esc_html__( 'Excerpt', 'congin' ),
					'readmore'        => esc_html__( 'Read More', 'congin' ),

				),
				'desc' => esc_html__( 'Drag and drop elements to re-order.', 'congin' ),
			),
		),
	),
);

// Blog Posts Media
$this->sections['congin_blog_post_media'] = array(
	'title' => esc_html__( 'Blog Post - Media', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_media_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Bottom Margin', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin-bottom',
			),
		),
	),
);

// Blog Posts Title
$this->sections['congin_blog_post_title'] = array(
	'title' => esc_html__( 'Blog Post - Title', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-title a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_title_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color Hover', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-title a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Meta
$this->sections['congin_blog_post_meta'] = array(
	'title' => esc_html__( 'Blog Post - Meta', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_meta_style',
			'default' => 'simple',
			'control' => array(
				'label'  => esc_html__( 'Style', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'simple' => esc_html__( 'Simple', 'congin' ),
					'style-2' => esc_html__( 'Style 2', 'congin' ),
				)
			),
		),
		array(
			'id' => 'blog_before_author',
			'default' => esc_html__( 'by', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Author', 'congin' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_before_category',
			'default' => esc_html__( 'in', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Text Before Category', 'congin' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'blog_entry_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 20px 0.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id'  => 'blog_entry_meta_items',
			'default' => array( 'author', 'comments', 'date', 'categories' ),
			'control' => array(
				'label' => esc_html__( 'Meta Items', 'congin' ),
				'desc' => esc_html__( 'Click and drag and drop elements to re-order them.', 'congin' ),
				'type' => 'congin-sortable',
				'object' => 'Congin_Customize_Control_Sorter',
				'choices' => array(
					'author'     => esc_html__( 'Author', 'congin' ),
					'comments' => esc_html__( 'Comments', 'congin' ),
					'date'       => esc_html__( 'Date', 'congin' ),
					'categories' => esc_html__( 'Categories', 'congin' ),
				),
			),
		),
		array(
			'id' => 'heading_blog_entry_meta_item',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Item Meta', 'congin' ),
			),
		),
		array(
			'id' => 'blog_entry_meta_item_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_entry_meta_item_link_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Link Color Hover', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-meta .item a:hover',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Excerpt
$this->sections['congin_blog_post_excerpt'] = array(
	'title' => esc_html__( 'Blog Post - Excerpt', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_content_style',
			'default' => 'style-2',
			'control' => array(
				'label' => esc_html__( 'Content Style', 'congin' ),
				'type' => 'select',
				'choices' => array(
					'style-1' => esc_html__( 'Normal', 'congin' ),
					'style-2' => esc_html__( 'Excerpt', 'congin' ),
				),
			),
		),
		array(
			'id' => 'blog_excerpt_length',
			'default' => '50',
			'control' => array(
				'label' => esc_html__( 'Excerpt length', 'congin' ),
				'type' => 'text',
				'desc' => esc_html__( 'This option only apply for Content Style: Excerpt.', 'congin' )
			),
		),
		array(
			'id' => 'blog_excerpt_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Example: 0 0 30px 0.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_excerpt_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-excerpt',
				'alter' => 'color',
			),
		),
	),
);

// Blog Posts Read More
$this->sections['congin_blog_post_read_more'] = array(
	'title' => esc_html__( 'Blog Post - Read More', 'congin' ),
	'panel' => 'congin_blog',
	'settings' => array(
		array(
			'id' => 'blog_entry_button_read_more_text',
			'default' => esc_html__( 'Read More', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Button Text', 'congin' ),
				'type' => 'text',
			),
		),
	),
);

