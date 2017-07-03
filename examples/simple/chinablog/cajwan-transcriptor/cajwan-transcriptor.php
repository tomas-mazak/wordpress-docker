<?php
/**
 * Plugin Name: Čajwan transcription converter
 * Plugin URI: http://www.cajwan.cz/
 * comment: Converts between different transcriptions of Chinese
 * Version: 0.1
 * Author: Tomas Mazak
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 */

/**
 * Add function to widgets_init that'll load our widget.
 * @since 0.1
 */
add_action( 'widgets_init', 'transcriptor_load_widgets' );

/**
 * Register our widget.
 * 'Example_Widget' is the widget class used below.
 *
 * @since 0.1
 */
function transcriptor_load_widgets() {
	register_widget( 'Transcriptor_Widget' );
}

function check_widget() {
//    if(is_active_widget( '', '', 'Transcriptor_Widget')){
        wp_enqueue_script('transcriptor-fnct', plugin_dir_url(__FILE__) . '/trans.js');
//    }
}
add_action('init', 'check_widget');

/**
 * Example Widget class.
 * This class handles everything that needs to be handled with the widget:
 * the settings, form, display, and update.  Nice!
 *
 * @since 0.1
 */
class Transcriptor_Widget extends WP_Widget {

	/**
	 * Widget setup.
	 */
	function Transcriptor_Widget() {
		/* Widget settings. */
		$widget_ops = array( 'classname' => 'transcriptor', 'comment' => __('Convert between Pinyin and CZ transcription', 'cajwan-transcriptor') );

		/* Widget control settings. */
		$control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'transcriptor-widget' );

		/* Create the widget. */
		$this->WP_Widget( 'transcriptor-widget', __('Transcriptor Widget', 'cajwan-transcriptor'), $widget_ops, $control_ops );
	}

	/**
	 * How to display the widget on the screen.
	 */
	function widget( $args, $instance ) {
		extract( $args );

		/* Our variables from the widget settings. */
		$title = apply_filters('widget_title', $instance['title'] );
		$comment = $instance['comment'];

		/* Before widget (defined by themes). */
		echo $before_widget;

		/* Display the widget title if one was input (before and after defined by themes). */
		if ( $title )
			echo $before_title . $title . $after_title;

		if ( $comment )
			printf( '<p>%s</p>', $comment );

        ?>
        <div style="text-align: center;">
            <input id="trans-svarny" type="text" placeholder="Český přepis"><br>
            <input id="svarny-to-pinyin" type="button" value="&darr;"><input id="pinyin-to-svarny" type="button" value="&uarr;"><br>
            <input id="trans-pinyin" type="text" placeholder="Pinyin">
            <script>
            jQuery(function($){ // DOM is now read and ready to be manipulated
                $(document).ready(function(){
                    $('#pinyin-to-svarny').click(function(event){
                        conv = pinyin2svarny($("#trans-pinyin").val());
                        if(conv == null) {
                            alert('Input string is not valid pinyin');
                        } else {
                            $("#trans-svarny").val(conv);
                        }
                    });
                    $('#svarny-to-pinyin').click(function(event){
                        conv = svarny2pinyin($("#trans-svarny").val());
                        if(conv == null) {
                            alert('Input string is not valid pinyin');
                        } else {
                            $("#trans-pinyin").val(conv);
                        }
                    });

                }); 
            });
            </script>
        </div>
        <?php

		/* After widget (defined by themes). */
		echo $after_widget;
	}

	/**
	 * Update the widget settings.
	 */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		/* Strip tags for title and name to remove HTML (important for text inputs). */
		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['comment'] =  $new_instance['comment'];

		return $instance;
	}

	/**
	 * Displays the widget settings controls on the widget panel.
	 * Make use of the get_field_id() and get_field_name() function
	 * when creating your form elements. This handles the confusing stuff.
	 */
	function form( $instance ) {

		/* Set up some default widget settings. */
		$defaults = array( 'title' => __('Transcription', 'cajwan-transcriptor'), 'comment' => '');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'hybrid'); ?></label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;">
		</p>
        <p>
			<label for="<?php echo $this->get_field_id( 'comment' ); ?>"><?php _e('Comment:', 'hybrid'); ?></label>
			<textarea id="<?php echo $this->get_field_id( 'comment' ); ?>" name="<?php echo $this->get_field_name( 'comment' ); ?>" value="<?php echo $instance['comment']; ?>" style="width:100%;"></textarea>
		</p>


	<?php
	}
}

?>
