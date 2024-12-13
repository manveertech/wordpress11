<?php
/**
 * Blog Single setting for Customizer
 *
 * @package congin
 * @version 3.8.9
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Blog Single General
$this->sections['congin_blog_single_general'] = array(
	'title' => esc_html__( 'General', 'congin' ),
	'panel' => 'congin_blogsingle',
	'settings' => array(
		array(
			'id' => 'congin_blog_single_featured_title',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Feature Title', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title',
			'default' => '',
			'control' => array(
				'label' => esc_html__( 'Title', 'congin' ),
				'type' => 'text',
				'description' => esc_html__( 'If empty, it will be blog title by default.', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_featured_title_background_img',
			'control' => array(
				'type' => 'image',
				'label' => esc_html__( 'Background Image', 'congin' ),
				'active_callback' => 'congin_cac_has_featured_title',
			),
		),
		array(
			'id' => 'congin_blog_single_media_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Media', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_media',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Media on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_media_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Media Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-media',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'congin_blog_single_meta_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Meta', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_meta',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Meta on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_meta_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Meta Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-meta',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'congin_blog_single_title_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Title', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_title',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Title on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_title_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left. Default: 0 0 10px 0.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-content-single-wrap .post-title',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-content-single-wrap .post-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'congin_blog_single_tags_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Tags', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_tags',
			'default' => true,
			'control' => array(
				'label' => esc_html__( 'Enable Post Tags on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_tags_text',
			'default' => esc_html__( 'Tags', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Tags Text', 'congin' ),
				'type' => 'text',
			),
		),
		array(
			'id' => 'congin_blog_single_social_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Social Share', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_social_share',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Social Share after Post Tags (need install WP Social)', 'congin' ),
				'type' => 'checkbox',
				'active_callback' => 'congin_cac_has_wp_social'
			),
		),
		array(
			'id' => 'congin_blog_single_custom_date_heading',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Custom Post Date', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_custom_post_date',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Custom Post Date on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
	),
);

// Blog Single Post Author
$this->sections['congin_blog_single_post_author'] = array(
	'title' => esc_html__( 'Blog Single Post - Author', 'congin' ),
	'panel' => 'congin_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_author_margin',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Margin', 'congin' ),
				'description' => esc_html__( 'Top Right Bottom Left.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author',
				'alter' => 'margin',
			),
		),
		array(
			'id' => 'blog_single_author_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .name',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-desc > p',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Width', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.hentry .post-author .author-avatar',
					'.hentry .post-author .author-avatar a'
				),
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Right Margin', 'congin' ),
				'description' => esc_html__( 'Example: 40px.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_author_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Image Rounded', 'congin' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.hentry .post-author .author-avatar a, .hentry .post-author .author-avatar a img',
				'alter' => 'border-radius',
			),
		),
	),
);

// Blog Single Comment
$this->sections['congin_blog_single_post_comment'] = array(
	'title' => esc_html__( 'Blog Single Post - Comment', 'congin' ),
	'panel' => 'congin_blogsingle',
	'settings' => array(
		array(
			'id' => 'heading_comment_title',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Title', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_comment_title_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Title Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_title_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Title Bottom Margin', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.comments-area .comments-title',
					'.comments-area .comment-reply-title'
				),
				'alter' => 'margin-bottom',
			),
		),
		// Comment List
		array(
			'id' => 'heading_comment_list',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Comment List', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Width', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'width',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_margin_right',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Right Margin', 'congin' ),
				'description' => esc_html__( 'Example: 30px.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'margin-right',
			),
		),
		array(
			'id' => 'blog_single_comment_avatar_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Avatar Rounded', 'congin' ),
				'description' => esc_html__( 'Example: 10px. 0px is square.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article .gravatar',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_article_margin_bottom',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Article Bottom Margin', 'congin' ),
				'description' => esc_html__( 'Example: 40px.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-list article',
				'alter' => 'margin-bottom',
			),
		),
		array(
			'id' => 'blog_single_comment_name_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Name Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-author, .comment-author a',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_time_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Date Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-time',
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_comment_text_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Text Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.comment-text',
				'alter' => 'color',
			),
		),
		// Comment Form
		array(
			'id' => 'heading_comment_form',
			'control' => array(
				'type' => 'congin-heading',
				'label' => esc_html__( 'Comment Form', 'congin' ),
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Form Border Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-color',
			),
		),
		array(
			'id' => 'blog_single_comment_form_rounded',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Rounded', 'congin' ),
				'description' => esc_html__( 'Example: 3px. 0px is square.', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-radius',
			),
		),
		array(
			'id' => 'blog_single_comment_form_border_width',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'text',
				'label' => esc_html__( 'Form Border Width', 'congin' ),
			),
			'inline_css' => array(
				'target' => '.name-wrap input, .email-wrap input, .message-wrap textarea',
				'alter' => 'border-width',
			),
		),
	),
);

// Blog Single Prev-Next Links
$this->sections['congin_blog_single_prev_next_links'] = array(
	'title' => esc_html__( 'Blog Single Post - Previous Next Links', 'congin' ),
	'panel' => 'congin_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_prev_next_links',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a',
				),
				'alter' => 'background-color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_color_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Color : Hover', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'color',
			),
		),
		array(
			'id' => 'blog_single_prev_next_links_bg_hover',
			'transport' => 'postMessage',
			'control' => array(
				'type' => 'color',
				'label' => esc_html__( 'Links Background : Hover', 'congin' ),
			),
			'inline_css' => array(
				'target' => array(
					'.nav-links a:hover',
				),
				'alter' => 'background-color',
			),
		),
	),
);


// Blog Single Related
$this->sections['congin_blog_single_related'] = array(
	'title' => esc_html__( 'Blog Single Post - Related Post', 'congin' ),
	'panel' => 'congin_blogsingle',
	'settings' => array(
		array(
			'id' => 'blog_single_related',
			'default' => false,
			'control' => array(
				'label' => esc_html__( 'Enable Related Posts on Single Post', 'congin' ),
				'type' => 'checkbox',
			),
		),
		array(
			'id' => 'blog_single_related_header',
			'default' => esc_html__( 'Related Articles', 'congin' ),
			'control' => array(
				'label' => esc_html__( 'Title', 'congin' ),
				'type' => 'text',
				
				'active_callback' => 'congin_cac_has_related_post',
			),
		),
	),
);
