<?php
class WPRT_recent_cause extends WP_Widget {
    // Holds widget settings defaults, populated in constructor.
    protected $defaults;

    // Constructor
    function __construct() {
        $this->defaults = array(
            'category'  => [],
            'count'     => 3,
        );

        parent::__construct(
            'widget_cause_post',
            esc_html__( 'Recent Causes', 'masterlayer' ),
            array(
                'classname'   => 'widget_recent_cause',
                'description' => esc_html__( 'Display recent causes.', 'masterlayer' )
            )
        );
    }

    // Display widget
    function widget( $args, $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );
        extract( $instance );
        extract( $args );

        echo $before_widget;

        $item_css = '';

        $query_args = array(
            'post_type' => 'give_forms',
            'posts_per_page' => intval($count)
        );

        if ( ! empty( $category ) )
            $query_args['tax_query'] = array(
                array(
                    'taxonomy' => 'give_forms_category',
                    'field'    => 'slug',
                    'terms'    => $category,
                ),
            );            
       
        $query = new WP_Query( $query_args ); ?>

        <ul class="recent-cause clearfix">
		<?php $i = 0; if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post(); ?>
				<li class="clearfix" style="<?php echo esc_attr( $item_css ); ?>">
                    <div class="recent-cause">
                        <div class="thumb">
                            <a aria-label="<?php echo esc_attr(get_the_title()); ?>" href="<?php echo esc_url( get_the_permalink() ); ?>" class="inner">
                                <?php
                                    $size = 'full';

                                    if ( has_post_thumbnail() ) {
                                        the_post_thumbnail( 'full' );
                                    } elseif ( get_post_format() == 'gallery' ) {

                                        $images = congin_elementor( 'gallery_images' );
                                        if ( ! empty( $images ) ) {
                                            echo wp_get_attachment_image( $images[0]['id'], $size);
                                        }
                                    }
                                ?>
                            </a>

                            <?php 
                            $cat = get_the_terms(get_the_ID(), 'give_forms_category');
                            if ( is_array($cat) ) {
                                if ($cat[0]->slug) {
                                    echo '<a class="cat-item" href="' . esc_url( get_term_link($cat[0]->term_id, 'give_forms_category') ) . '">' . esc_html($cat[0]->name) . '</a>';
                                }
                            } ?>
                        </div>

                        <div class="content-wrap">
                            <h3 class="cause-title"><a href="<?php echo esc_url( get_the_permalink() ); ?>"><?php echo get_the_title(); ?></a></h3>

                            <?php
                            echo do_shortcode('[give_goal id="' . get_the_ID() . '" show_bar="true" show_text="true"]')
                            ?>
                        </div>
                    <?php 
        
                    echo '</div>';

                    ?>
                </li>
			<?php $i++; endwhile; wp_reset_postdata(); ?>
		<?php endif; ?>        
        </ul>
        
		<?php echo $after_widget;
    }

    // Update widget
    function update( $new_instance, $old_instance ) {
        $instance                   = $old_instance;
        $instance['category']       = array_filter( $new_instance['category'] );
        $instance['count']          = intval( $new_instance['count'] );

        return $instance;
    }

    // Widget setting
    function form( $instance ) {
        $instance = wp_parse_args( $instance, $this->defaults );      
        ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>"><?php esc_html_e( 'Count:', 'masterlayer' ); ?></label>
            <input class="widefat" type="number" id="<?php echo esc_attr( $this->get_field_id( 'count' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'count' ) ); ?>" value="<?php echo esc_attr( $instance['count'] ); ?>">
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>"><?php esc_html_e( 'Select Category:', 'masterlayer' ); ?></label>
            <select class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'category' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'category' ) ); ?>[]">
                <option value=""<?php selected( empty( $instance['category'] ) ); ?>><?php esc_html_e( 'All', 'masterlayer' ); ?></option>
                <?php               
                $categories = get_terms(array('taxonomy' => 'give_forms_category'));
                
                foreach ( $categories as $category ) {
                    printf(
                        '<option value="%1$s" %4$s>%2$s (%3$s)</option>',
                        esc_attr( $category->term_id ),
                        $category->name,
                        $category->count,
                        ( in_array( $category->term_id, $instance['category'] ) ) ? 'selected="selected"' : '');
                }               

                ?>
            </select>
        </p>

    <?php
    }
}
add_action( 'widgets_init', 'mae_register_recent_cause' );

// Register widget
function mae_register_recent_cause() {
    register_widget( 'WPRT_recent_cause' );
}


