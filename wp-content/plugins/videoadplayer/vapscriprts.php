<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class VideoAdPlayer {
	protected static $instance = null;
	protected $plugin_settings_screen_hook_suffix = null;
	private function __construct() {
		//if(DkQWso_license_valid()){
			add_action( 'admin_menu', array( $this, 'vap_add_plugin_admin_menu' ) );
			add_action( 'admin_enqueue_scripts', array( $this, 'vap_enqueue_admin_stylesscripts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'vap_enqueue_stylesscripts' ) );
			add_action( 'init', array( $this, 'add_vap_customposttype' ) );
			add_filter( 'post_updated_messages', array( $this, 'set_messages' ) );
			add_action( 'admin_init', array( $this, 'vap_register_mysettingss' )  );
			add_filter( 'manage_edit-vap_columns', array( $this, 'my_edit_vap_columns' ) ) ;
			add_action( 'manage_vap_posts_custom_column', array( $this, 'my_manage_vap_columns' ), 10, 2 );
			add_action( 'wp_head',array( $this, 'add_videojs_swf_vap'));
		//}
  }
	public static function vap_get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}
		return self::$instance;
	}
	
	public function add_videojs_swf_vap() {
		echo '
			<script type="text/javascript">
				if(typeof videojs != "undefined") {
					videojs.options.flash.swf = "'. plugins_url( 'video-js/video-js.swf' , __FILE__ ) .'";
				}
				document.createElement("video");document.createElement("audio");document.createElement("track");
			</script>
			';
	}
	public function vap_enqueue_admin_stylesscripts() {
		$current_screen = get_current_screen();
		
		if ( $current_screen->post_type === 'vap' ) {
			
			wp_enqueue_style( 'vap-admin-styles1', plugins_url( '/css/bootstrap.css', __FILE__ ));
			wp_enqueue_style( 'vap-admin-styles2', plugins_url( '/css/responsive.css', __FILE__ ));
			wp_enqueue_style( 'vap-admin-styles3', plugins_url( '/css/glyphicons.css', __FILE__ ));
			wp_enqueue_style( 'vap-admin-styles4', plugins_url( '/css/style-default-menus-dark.css', __FILE__ ));
			wp_enqueue_style( 'vap-admin-styles5', plugins_url( '/css/all.css', __FILE__ ));
			wp_enqueue_style( 'vap-admin-styles6', plugins_url( '/css/switchery.css', __FILE__ ));
			wp_register_style('jquery-customgvp-style', plugins_url( '/js/jquery-ui-1.10.3.custom.css', __FILE__ ), array(), '1', 'screen'); 
			wp_enqueue_style('jquery-customgvp-style');	
			if(get_current_theme() != "Maxima Press"){	
				wp_enqueue_style( 'vap-admin-styles7', plugins_url( '/jcountdown/jquery-ui.css', __FILE__ ));
				wp_enqueue_style( 'vap-admin-styles8', plugins_url( '/jcountdown/jquery.datetimepicker.css', __FILE__ ));
			}
	
			
			wp_enqueue_media();
			wp_enqueue_script('jquery');
			wp_enqueue_script('custom-gvpaccordion1',plugins_url( '/js/jquery-ui-1.10.3.custom.js', __FILE__ ),array('jquery'));
			wp_enqueue_script('custom-gvpaccordion',plugins_url( '/js/accordion.js', __FILE__ ),array('jquery'));			
			wp_enqueue_script('vap-admin-script0', plugins_url( '/jscolor/jscolor.js', __FILE__ ));
			wp_enqueue_script('vap-admin-script1', plugins_url( '/js/bootstrap.min.js', __FILE__ ),array(), true, true);
			wp_enqueue_script('vap-admin-script2', plugins_url( '/js/icheck.js', __FILE__ ),array(), true, false);
			wp_enqueue_script('vap-admin-script3', plugins_url( '/js/switchery.js', __FILE__ ),array(), true, false);
			if(get_current_theme() != "Maxima Press"){	
				wp_enqueue_script('vap-admin-script4',plugins_url( '/jcountdown/jquery-ui.js', __FILE__ ),array('jquery'));
				wp_enqueue_script('vap-admin-script5',plugins_url( '/jcountdown/jquery.datetimepicker.js', __FILE__ ),array('jquery'));
				wp_enqueue_script('vap-admin-script6',plugins_url( '/jcountdown/jquery-ui-sliderAccess.js', __FILE__ ),array('jquery'));
			}
			wp_enqueue_script( 'vap-media', plugins_url( '/js/media.js', __FILE__ ), array(), true, false );
				wp_localize_script( 'vap-media', 'countdownimage',
					array(
						'title'  => __( 'Upload or choose image', 'vap' ), 
						'button' => __( 'Insert Image', 'vap' )              
					)
				);
				if ( $wp_version >= 3.5 ) {
				wp_enqueue_media();
				}
		}
	}
	
	public function vap_enqueue_stylesscripts() {
		
		wp_enqueue_script('jquery');
		
		//wp_enqueue_script( 'videojs0', plugins_url( 'js/modernizr.custom.js' , __FILE__ ) );
		
		wp_enqueue_script( 'videojs1', plugins_url( 'video-js/video.js' , __FILE__ ) );
		wp_register_style( 'videojs2', plugins_url( 'video-js/video-js.css' , __FILE__ ) );
		wp_enqueue_style( 'videojs2' );
		wp_register_script( 'videojs1dev', plugins_url( 'video-js/video.dev.js' , __FILE__ ) );
		wp_enqueue_style( 'videojs3', plugins_url( 'css/vap-video-responsive.css' , __FILE__ ) );
		/*wp_register_style( 'videojs4', plugins_url( 'css/moo.css' , __FILE__ ) );*/
		wp_register_style( 'videojs5', plugins_url( 'css/videojs-sublime-skin.css' , __FILE__ ) );
		wp_enqueue_style( 'videojs6', plugins_url( 'css/plugins/videojs.ads.css' , __FILE__ ) );
		wp_enqueue_style( 'videojs7', plugins_url( 'css/plugins/videojs.vast.css' , __FILE__ ) );
		/*wp_register_script( 'videojs8', plugins_url( 'js/plugins/videojs.ads.old.js' , __FILE__ ) );*/
		wp_enqueue_script( 'videojs8', plugins_url( 'js/plugins/videojs.ads.js' , __FILE__ ) );
		wp_enqueue_script( 'videojs9', plugins_url( 'js/plugins/vast-client.js' , __FILE__ ) );
		wp_enqueue_script( 'videojs10', plugins_url( 'js/plugins/videojs.vast.js' , __FILE__ ) );
		wp_enqueue_script( 'videojs11', plugins_url( 'js/plugins/videojs.ads4ima.js' , __FILE__ ) );
		wp_enqueue_style( 'videojs12', plugins_url( 'css/plugins/videojs.ima.css' , __FILE__ ) );
		if (is_ssl()) {
			wp_enqueue_script( 'videojs13', 'https://imasdk.googleapis.com/js/sdkloader/ima3.js');
		}else{
			wp_enqueue_script( 'videojs13', 'http://imasdk.googleapis.com/js/sdkloader/ima3.js');
		}
		wp_enqueue_script( 'videojs14', plugins_url( 'js/plugins/videojs.ima.js' , __FILE__ ) );
		wp_register_script( 'videojs-youtube1', plugins_url( 'js/plugins/youtube.js' , __FILE__ ) );
		
		wp_enqueue_style( 'videojs15', plugins_url( 'css/plugins/videojs-overlay.css' , __FILE__ ) );
		wp_enqueue_script( 'videojs16', plugins_url( 'js/plugins/videojs-overlay.js' , __FILE__ ) );
		
		wp_enqueue_script( 'videojs21', plugins_url( 'js/plugins/vpaid/swfobject.js' , __FILE__ ) );
		wp_enqueue_style( 'videojs19', plugins_url( 'js/plugins/vpaid/videojs-vast-vpaid.css' , __FILE__ ) );
		wp_enqueue_script( 'videojs20', plugins_url( 'js/plugins/vpaid/videojs-vast-vpaid.js' , __FILE__ ) );
		
		wp_enqueue_style( 'videojs22', plugins_url( 'css/plugins/dimTheLights.css' , __FILE__ ) );
		wp_enqueue_script( 'videojs23', plugins_url( 'js/plugins/dimTheLights.js' , __FILE__ ) );
		wp_enqueue_style( 'videojs24', 'http://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css' );
				
		
		/*wp_register_style( 'videojs17', plugins_url( 'video-js/videoadplayer.css' , __FILE__ ) );*/
		/*wp_register_style( 'videojs18', plugins_url( 'css/vimess-skin.css' , __FILE__ ) );*/
	}
	
/*	public function gvp_global_config_script() {
    gvp_global_config_script_helper();
  } */
	public function vap_add_plugin_admin_menu() {
		/*$this->plugin_settings_screen_hook_suffix = add_submenu_page(
			'edit.php?post_type=crr',
			__( 'Video Ad Player Options', 'vap' ),
			__( 'General Options', 'vap' ),
			'manage_options',
			'vap_settings',
			array( $this, 'vap_display_plugin_admin_page' )
		);*/
	}
	public function gvp_activate_plugin_admin_menu() {
      //add_menu_page('Member Player Plugin', 'Member Player', 'administrator', 'gvp', 'mplayer_not_authorized');
	}
	public function vap_register_mysettingss() {
		
		//register our settings
		
	}
	public function vap_display_plugin_admin_page() { ?>
		<div class="wrap">
	<?php screen_icon(); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
	<?php settings_errors(); ?>
	<form method="post" action="options.php">
	
         
	<?php	submit_button();
	?>
	</form>
		</div>
    <?php }
	
	public function vap_add_action_links( $links ) {
		/* return array_merge(
			array(
				'settings' => '<a href="' . admin_url( 'edit.php?post_type=gvp&page=gvp_settings' ) . '">' . __( 'Settings', 'gvp' ) . '</a>'
			),
			$links
		);*/
	}
	public function add_vap_customposttype() {
		$labels = array(
			'name'                => _x( 'MaximaPlayer - Video Ads', 'Post Type General Name', 'vap' ),
			'singular_name'       => _x( 'MaximaPlayer - Video Ads', 'Post Type Singular Name', 'vap' ),
			'menu_name'           => __( 'MaximaPlayer - Video Ads', 'vap' ),
			'parent_item_colon'   => __( 'Parent Video', 'vap' ),
			'all_items'           => __( 'All Videos', 'vap' ),
			'view_item'           => __( 'View Video', 'vap' ),
			'add_new_item'        => __( 'Add New Video', 'vap' ),
			'add_new'             => __( 'Add New Video', 'vap' ),
			'edit_item'           => __( 'Edit Video', 'vap' ),
			'update_item'         => __( 'Update Video', 'vap' ),
			'search_items'        => __( 'Search Video', 'vap' ),
			'not_found'           => __( 'No video found', 'vap' ),
			'not_found_in_trash'  => __( 'No videos found in Trash', 'vap' ),
		);
		$args = array(
			'label'               => __( 'Video Ad', 'vap' ),
			'description'         => __( 'MaximaPlayer - Video Ads', 'vap' ),
			'labels'              => $labels,
			'supports'            => array( 'title' ),
			'hierarchical'        => false,
			'public'              => false,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_icon'           => 'dashicons-playlist-video',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'query_var'           => 'videoad',
			'rewrite'             => false,
			'capability_type'     => 'page',
		);
		register_post_type( 'vap', $args );
		
		
			
	}
	
		function my_edit_vap_columns( $columns ) {
		
			$columns = array(
				'cb' => '<input type="checkbox" />',
				'title' => __( 'Video Title' ),
				'shortcode' => __( 'Shortcode' ),
				'date' => __( 'Date' )
			);
		
			return $columns;
		}
function my_manage_vap_columns( $column, $post_id ) {
	global $post;
	switch( $column ) {
		/* If displaying the 'duration' column. */
		case 'shortcode' :
				echo '[videoadplayer id= "'.$post_id.'"]';
			break;
		default :
			break;
	}
}
	public function set_messages($messages) {
		global $post;
		$messages['vap'] = array(
			0  => '', // Unused. Messages start at index 1.
			1  => __( 'Video updated.', 'vap' ),
			2  => __( 'Custom field updated.', 'vap' ),
			3  => __( 'Custom field deleted.', 'vap' ),
			4  => __( 'Video updated.', 'vap' ),
			5  => isset( $_GET['revision'] ) ? sprintf( __( $singular . ' restored to revision from %s', 'vap' ), wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6  => __( 'Video published.', 'vap' ),
			7  => __( 'Video saved.', 'vap' ),
			8  => __( 'Video submitted.', 'vap' ),
			9  => sprintf( __( 'Video scheduled for: %1$s', 'vap' ), date_i18n( __( 'M j, Y @ G:i' ), strtotime( $post->post_date ) ) ),
			10 => __( 'Video draft updated.', 'vap' ),
		);
		return $messages;
	}
	
	
}
