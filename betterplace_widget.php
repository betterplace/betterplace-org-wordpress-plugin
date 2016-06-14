<?php

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
	
/**
 * Adds the betterplace.org widget.
 */
class betterplace_widget extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'betterplace_widget', // Base ID
			__('betterplace.org Widget', 'text_domain'), // Name
			array( 'description' => __( 'Zeigt das offizielle betterplace.org Projekt-Widget an', 'text_domain' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
		
		echo $args['before_widget'];
		//Get title, if there is one
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		if ( ! empty( $instance['pid'] ) ) {
			//remove p from project ID, if given
			$pID = str_replace("p", "", $instance['pid']);
			
			//create iFrame URL for betterplace.org widget
			//use project id from widget options
			$iframe = '<iframe frameborder="0" marginheight="0" marginwidth="0" src="https://www.betterplace-widget.org/projects/'.$pID.'?l=de" width="100%" height="320" style="border: 0; padding:0; margin:0;">Informieren und spenden: <a href="http://www.betterplace.org/p44016" target="_blank">Projekt</a> auf betterplace.org öffnen.</iframe>';
			echo $iframe;
		}
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		if ( isset( $instance[ 'pid' ] ) ) {
			$pid = $instance[ 'pid' ];
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Titel:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'pid' ); ?>"><?php _e( 'Projekt ID:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'pid' ); ?>" name="<?php echo $this->get_field_name( 'pid' ); ?>" type="text" value="<?php echo esc_attr( $pid ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['pid'] = ( ! empty( $new_instance['pid'] ) ) ? strip_tags( $new_instance['pid'] ) : '';
		
		return $instance;
	}

} // class betterplace_widget


/**
 * Adds the betterplace.org widget shortcode with project ID as parameter
 */
function bporg_widget_shortcode( $atts ) {
 
    $output = '';
 
    $get_atts = shortcode_atts( array(
        'projekt' => '0',
		'width'	  => '220',
    ), $atts );
	$pID = $get_atts[ 'projekt' ];
	
	if($pID != "0"){
		//remove p from project ID, if given
		$pID = str_replace("p", "", $pID);
		
		//create iFrame URL for betterplace.org widget
		//use project id from widget options
		$iframe = '<iframe frameborder="0" marginheight="0" marginwidth="0" src="https://www.betterplace-widget.org/projects/'.$pID.'?l=de" width="'.$get_atts[ 'width' ].'" height="320" style="border: 0; padding:0; margin:0;">Informieren und spenden: <a href="http://www.betterplace.org/p44016" target="_blank">Projekt</a> auf betterplace.org öffnen.</iframe>';

	   $output .= $iframe;
	}
	else{
		$output .= "<p>Es wurde keine betterplace Projekt ID angegeben.</p>";
	}	
   
   return $output;
 
}
add_shortcode( 'betterplace-widget', 'bporg_widget_shortcode' );
