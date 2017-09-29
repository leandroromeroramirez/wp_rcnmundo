<?php
/*define('WP_DEBUG', true);
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(-1);*/
//if (defined('WPB_VC_VERSION')) {
//======================================== Bullets start here =================================================

if(!class_exists('Sppvc_vap_Listvaplayer')) 
{
	class Sppvc_vap_Listvaplayer
	{
		function __construct()
		{
						
			//add_action('admin_init',array($this,'bullet_list_initiation'));
			add_action( 'vc_before_init',array($this,'videoadplayer_list_initiationmplayer') );
			add_shortcode('vap_vcVideoadplayer',array($this,'mpp_vcvideoadplayer_shortcodemplayer'));
		}
		
		
		function sppmp_dropdown_videoadplayer_settings_fieldmplayer( $settings, $value ){
			$str = '';
			$str .= '<div style="margin-bottom:10px; font-weight:bold;">' . $settings['sppmp_label'] . '</div>';
			$str .= '<select id="'.$settings['sppmp_select_id'].'" name="'.$settings['param_name'].'" class="wpb_vc_param_value '.$settings['param_name'].' '.$settings['type'].'_field" >';
			$postscr = get_posts(
				array(
					'post_type'  => 'vap',
					'numberposts' => -1,
					'orderby' => 'post_date',
					'order'   => 'DESC',
					'post_status' => 'publish'
				)
			);
			
			foreach( $postscr as $p )
			{
				$selected = '';
					if($value==$p->ID) $selected = 'selected="selected"';
				$str .= '<option value="' . $p->ID . '" '.$selected.'>' . esc_html( $p->post_title ) . '</option>';
			}
			/*foreach($settings['sppmp_items'] as $k=>$v){
				$selected = '';
				if($value==$k) $selected = 'selected="selected"';
				$str .= '<option value="'.$k.'" '.$selected.'>'.$v.'</option>';
			}*/
			$str .= '</select>';
			$str .= '<span class="vc_description vc_clearfix">'.$settings['aditional_info'].'</span>';
			return $str;
		}

	
		function videoadplayer_list_initiationmplayer()
		{
			

			if(function_exists('vc_map'))
			{
				add_shortcode_param('vapplistdropdownmplayer', array($this,'sppmp_dropdown_videoadplayer_settings_fieldmplayer'));
				// ================================VC Nav Menu start
				vc_map(
					array(
					   "name" => "Video Ad Player",
					   "base" => "vap_vcVideoadplayer",
					   "class" => "vap_vcVideoadplayer",
					   "icon" => plugins_url( 'images/videoad.png', __FILE__ ),
					   "category" => "MaximaPress",
					   "description" => "Add responsive videos with ads.",
					   "show_settings_on_create" => true,
					   "params" => array(
							// Play with icon selector
							array(
								  "type"        => "vapplistdropdownmplayer",
								  "sppmp_label"     => "Select Video",
								  "value" => '',
								  "param_name"  => "vapp_selectvideo",
								  "sppmp_select_id" => "vapp_selectvideo",
								  "aditional_info" => "Design and select options for video at MaximaPlayer - Video Ads menu and select from above dropdown."
							  )
						)
					)
				);
				// ================================VC Nav Menu end
				
				
			}
		}
		
		function mpp_vcvideoadplayer_shortcodemplayer($atts, $content = null){
			extract(shortcode_atts( array(
				'vapp_selectvideo' => ''
			),$atts));
			$finaloutput = '';
			$finaloutput .= '[videoadplayer id= "'.$vapp_selectvideo.'"]';
			return do_shortcode($finaloutput);	
		}
		
	}
}
?>