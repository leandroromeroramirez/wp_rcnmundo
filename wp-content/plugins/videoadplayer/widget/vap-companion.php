<?php
/*
	MaximaPressPosts Widget
*/

class VapCompanion extends WP_Widget {

/*  Constructor
/* ------------------------------------ */
	function Vapcompanion() {
		parent::__construct( false, 'VapCompanion', array('description' => 'Display comapnion ad for Video Ad Player', 'classname' => 'vap_comp_wid') );;	
	}
	
/*  Widget
/* ------------------------------------ */
	public function widget($args, $instance) {
		extract( $args );
		$instance['title']?NULL:$instance['title']='';
		$title = apply_filters('widget_title',$instance['title']);
		$output = $before_widget."\n";
		if($title)
			$output .= $before_title.$title.$after_title;
		ob_start();
	
?>

	<div class="widget-container">			
    <?php if($instance['adsize'] != 'none'){
			$tadsize_comp = explode("-", $instance['adsize']);
		}
		else{
			$tadsize_comp = '0';
		} if($tadsize_comp != '0') { ?>
    <div id="vapcompaniw<?php echo $instance['adsize']; ?>" <?php if($instance['adspace'] == 'yes') { ?> style="width:<?php echo $tadsize_comp[0]; ?>px;height:<?php echo $tadsize_comp[1]; ?>px;" <?php }?>>
			
	</div>
    <?php } ?>
	
    <div class="clear"></div>
	</div>
<?php
		$output .= ob_get_clean();
		$output .= $after_widget."\n";
		echo $output;
	}
	
/*  Widget update
/* ------------------------------------ */
	public function update($new,$old) {
		$instance = $old;
		$instance['title'] = strip_tags($new['title']);
	// Posts
		$instance['adsize'] = $new['adsize'];
		
		$instance['adspace'] = $new['adspace'];
		
		return $instance;
	}

/*  Widget form
/* ------------------------------------ */
	public function form($instance) {
		// Default widget settings
		$defaults = array(
			'title' 			=> '',
		// Posts
			'adsize' 		=> '',
			'adspace' 		=> ''
	);
		$instance = wp_parse_args( (array) $instance, $defaults );
?>

	
	
	<div class="vap-options-posts">
		<p>
			<label style="" for="<?php echo $this->get_field_id("adsize"); ?>">Ad Size</label>
            <select class="widefat" id="<?php echo $this->get_field_id('adsize'); ?>" name="<?php echo $this->get_field_name('adsize'); ?>">
					<option value="none" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"] , 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $instance["adsize"] ) ) selected( $instance["adsize"], '88-31' ); ?>>88 * 31</option>
								</select>
					</p>
                    
                    <p>
			<label style="" for="<?php echo $this->get_field_id("adspace"); ?>">Show Empty Ad Space</label>
            <select class="widefat" id="<?php echo $this->get_field_id('adspace'); ?>" name="<?php echo $this->get_field_name('adspace'); ?>">
					<option value="yes" <?php if ( isset ( $instance["adspace"] ) ) selected( $instance["adspace"] , 'yes' ); ?>>Yes</option>
                    <option value="no" <?php if ( isset ( $instance["adspace"] ) ) selected( $instance["adspace"], 'no' ); ?>>No</option>
			</select>
					</p>
        
        
		
	</div>
<?php
}

}

/*  Register widget
/* ------------------------------------ */
if ( ! function_exists( 'videoadplayer_register_widget_aboutme' ) ) {

	function videoadplayer_register_widget_aboutme() { 
		register_widget( 'VapCompanion' );
	}
	
}
add_action( 'widgets_init', 'videoadplayer_register_widget_aboutme' );
