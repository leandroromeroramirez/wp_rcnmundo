<?php
/** 
 * Plugin Name: MaximaPlayer - Video Ads
 * Plugin URI:  http://www.maximaplayer.com/maxima-ads
 * Description: A fully responsive that have all available options that you can think. Supports ads, social sharing and ton of more options etc.
 * Version:     1.0.6
 * Author:      Mark Dulisse
 * Author URI:  http://markdulisse.com/blog
 */
if ( ! defined( 'WPINC' ) ) {
	die;
}
//Here's how you can add query arguments to the URL.
require_once( plugin_dir_path( __FILE__ ) . 'vapscriprts.php' );
require_once( plugin_dir_path( __FILE__ ) . 'includes/addvapmetabox.php' );
require_once( plugin_dir_path( __FILE__ ) . 'widget/vap-companion.php' );
//load_template( plugins_url( '/widget/vap-companion.php', __FILE__ ) );
function vap_addvideojs_header($vapadtypecheckget,$vpaidtagurlcheckget){
		if($vapadtypecheckget == 'vpaid' && $vpaidtagurlcheckget != ''){
			//wp_enqueue_script('videojs1dev');
			//wp_enqueue_script('videojs1');
			wp_enqueue_script('videojs21');
			wp_enqueue_style('videojs19');
			wp_enqueue_script('videojs20');		
		}
		else{
			//wp_enqueue_script('videojs1');
		}
		//wp_enqueue_script('videojs-youtube1');
	
	}

$shortcode_counter = 0;
function add_vap_shortcode($atts, $content = null) {
	if ( isset( $atts['id'] ) ) {
		$vapadtypecheck   	= get_post_meta( $atts['id'], 'vap_adtype', true);
		$vpaidtagurlcheck     = get_post_meta( $atts['id'],'vap-vpaidtagurl',true );
		vap_addvideojs_header($vapadtypecheck,$vpaidtagurlcheck);
		
		$id = $atts['id'];
		
		// get the meta from the post type
		$splash         = get_post_meta( $id, 'vap-posterurl', true );
		$mp4            = get_post_meta( $id, 'vap-mp4url', true );
		$webm           = get_post_meta( $id, 'vap-webmurl', true );
		$ogg            = get_post_meta( $id, 'vap-oggurl', true) ;
		$urltype        = get_post_meta( $id, 'vap_urltype', true) ;
		$streamingurl   = get_post_meta( $id, 'vap-steamingurl', true);
		$mp3url         = get_post_meta( $id, 'vap-mp3url', true);
		
		$hidecontrol    = get_post_meta( $id, 'vap-showcontrol', true);
		$autoplay       = get_post_meta( $id, 'vap-autoplay', true);
		$preloadvid     = get_post_meta( $id, 'vap-preloadvid', true);
		$loopvid        = get_post_meta( $id, 'vap-loopvid', true);
		$htoggleplay    = get_post_meta( $id, 'vap-htoggleplay', true);
		$hfullscreen    = get_post_meta( $id, 'vap-hfullscreen', true);
		$htime          = get_post_meta( $id, 'vap-htime', true);
		$hvolume        = get_post_meta( $id, 'vap-hvolume', true);
		$hmutetoggle    = get_post_meta( $id, 'vap-hmutetoggle', true);
		$vidaudwidth    = get_post_meta( $id, 'vap-vidaudwidth', true);
		$vidaudheight   = get_post_meta( $id, 'vap-vidaudheight', true);
		$vidaudmaxwidth = get_post_meta( $id, 'vap-vidaudmaxwidth', true);
		$vidaspectratio = get_post_meta( $id, 'vap-vidaspectratio', true);
		$hprogbar       = get_post_meta( $id, 'vap-hprogbar', true);
		$videoalign     = get_post_meta( $id, 'vap-videoalign', true);
		
		$playbtnpos     = get_post_meta( $id, 'vap-playbtnpos', true);
		$controlsize    = get_post_meta( $id, 'vap-controlsize', true);
		$controlcolor   = get_post_meta( $id, 'vap-controlcolor', true);
		$ctrlbarcolor   = get_post_meta( $id, 'vap-controlbarcolor', true);
		$pbarcolor      = get_post_meta( $id, 'vap-pbarcolor', true);
		$skinsvap       = get_post_meta( $id, 'vap-skins', true);
		
		$vapadtype   	= get_post_meta( $id, 'vap_adtype', true);
		$vasttagurl     = get_post_meta( $id, 'vap-vasttagurl', true);
		$skiptime       = get_post_meta( $id, 'vap-skiptime', true);
		$midvasttagurl  = get_post_meta( $id, 'vap-midvasttagurl', true);
		$postvasttagurl = get_post_meta( $id, 'vap-postvasttagurl', true);
		$midoffset      = get_post_meta( $id, 'vap-midoffset', true);
		
		$imatagurl      = get_post_meta( $id, 'vap-imaadtagurl', true);
		
		$baohtmltext 	 = get_post_meta( $id,'vap-baohtmltext',true );
		$baostarttime 	 = get_post_meta( $id,'vap-baostarttime',true );
		$baoendtime 	 = get_post_meta( $id,'vap-baoendtime',true );
		$baoposition 	 = get_post_meta( $id,'vap-baoposition',true );
		$baoverlaywidth  = get_post_meta( $id,'vap-baoverlaywidth',true );
		$hideskipbtn     = get_post_meta( $id,'vap-hideskipbtn',true );	
		
		$endiscomp  	 = get_post_meta( $id,'vap-endiscomp',true );
		$compdivid       = get_post_meta( $id,'vap-compdivid',true );
		$radsize       	 = get_post_meta( $id,'vap-radsize',true );
		$tadsize       	 = get_post_meta( $id,'vap-tadsize',true );
		$ladsize       	 = get_post_meta( $id,'vap-ladsize',true );
		$badsize       	 = get_post_meta( $id,'vap-badsize',true );
		$wadsize       	 = get_post_meta( $id,'vap-wadsize',true );
		$wadsize2        = get_post_meta( $id,'vap-wadsize2',true );
		$wadsize3        = get_post_meta( $id,'vap-wadsize3',true );
		
		$shwidth         = get_post_meta( $id,'vap-shwidth',true );
		$shcolor         = get_post_meta( $id,'vap-shcolor',true );
		$bdwidth         = get_post_meta( $id,'vap-bdwidth',true );
		$bdcolor         = get_post_meta( $id,'vap-bdcolor',true );
		$bdstyle         = get_post_meta( $id,'vap-bdstyle',true );
		$vpaidtagurl     = get_post_meta( $id,'vap-vpaidtagurl',true );
		
		$envidschedule   = get_post_meta( $id,'vap-enablevidschedule',true );
		$scheduledate    = get_post_meta( $id,'vap-scheduledate',true );
		$scheimezone     = get_post_meta( $id,'vap-scheduletimezone',true );
		$schedtitletext  = get_post_meta( $id,'vap-schedtitletext',true );
		$schedtitlecolor = get_post_meta( $id,'vap-schedtitlecolor',true );
		$schoverbgcolor  = get_post_meta( $id,'vap-schoverbgcolor',true );
		$schoverbgopa    = get_post_meta( $id,'vap-schoverbgopacity',true );
		$counterstyle    = get_post_meta( $id,'vap-counterstyle',true );
		$countercolor    = get_post_meta( $id,'vap-countercolor',true );
		$showcountrefl   = get_post_meta( $id,'vap-showcountreflection',true );
		$hidelabels      = get_post_meta( $id,'vap-hidelabels',true );
		$hidedays        = get_post_meta( $id,'vap-hidedays',true );
		$hidehourss      = get_post_meta( $id,'vap-hidehourss',true );
		$hidemins        = get_post_meta( $id,'vap-hidemins',true );
		$hidesecs        = get_post_meta( $id,'vap-hidesecs',true );
		$counterwidth    = get_post_meta( $id,'vap-counterwidth',true );
		
		$enfbretarget    = get_post_meta( $id,'vap-enablefbretarget',true );
		$fbpixelid       = get_post_meta( $id,'vap-fbpixelid',true );
		$fbcodeembp      = get_post_meta( $id,'vap-fbcodeembp',true );
		$fbremin         = get_post_meta( $id,'vap-fbremin',true );
		$fbresec         = get_post_meta( $id,'vap-fbresec',true );
		
		$dimlight        = get_post_meta( $id,'vap-dimlight',true );
		$dimlighttype    = get_post_meta( $id,'vap-dimlighttype',true );
		
		
		/*return  '<video id="example_video_1" class="video-js vjs-default-skin"
         controls preload="auto" width="640" height="264"
         poster="http://video-js.zencoder.com/oceans-clip.png"
         data-setup=\'{
                  "plugins": {
                          "vastClient":{
                              "url": "http://ad3.liverail.com/?LR_PUBLISHER_ID=1331&LR_CAMPAIGN_ID=229&LR_SCHEMA=vast2-vpaid",
                              "adsCancelTimeout": 50000,
                              "adsEnabled": true
                          }
                  }
             }\'>
      <source src="http://video-js.zencoder.com/oceans-clip.mp4" type=\'video/mp4\'/>
      <source src="http://video-js.zencoder.com/oceans-clip.webm" type=\'video/webm\'/>
      <source src="http://video-js.zencoder.com/oceans-clip.ogv" type=\'video/ogg\'/>
      <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a
              href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p></video>';*/
		
   		$title = get_the_title($id);
		$vapadplayerstr = '';
		$vapvideotag = '';
		$vapaudiotag = '';
		$vapaudiocss = '';
		
		$skin1class = '';
		$skin2class = '';
		$skindefaultclass = ''; 
		
		if($skinsvap == 'skin1'){
			wp_enqueue_style( 'videojs17');
			//$skin1class = ' moo-css';
		}
		if($skinsvap == 'skin2'){
			wp_enqueue_style( 'videojs5');
			$skin2class = ' vjs-sublime-skin';
		}
		if($skinsvap == 'default' || $skinsvap == 'skin1'){
			$skindefaultclass = ' vjs-default-skin';
		}
		
		if($skinsvap == 'vimess'){
			wp_enqueue_style( 'videojs18');
			$skin2class = ' vjs-sublime-skin';
		}
		
		if($dimlight == 'true'){
			wp_enqueue_style( 'videojs24');
			wp_enqueue_style( 'videojs22');
			wp_enqueue_script('videojs23');
		}
		
		$shadowcss = '';
		$bordercss1 = '';
		if($shwidth != '')
		{
			$shadowcss = 'box-shadow:0 0 '.$shwidth.'px #'.$shcolor.' !important;-moz-box-shadow:0 0 '.$shwidth.'px #'.$shcolor.' !important;-webkit-box-shadow:0 0 '.$shwidth.'px #'.$shcolor.' !important;';
		}
		
		if($bdwidth != '')
		{
			$bordercss1 = 'border:'.$bdwidth.'px '.$bdstyle.' #'.$bdcolor.' !important;';
		}
		
		if($controlsize != '')
			$controlsize_src = 'font-size:'.$controlsize.'%;';
		else
			$controlsize_src = '';
		
		$vapaudiocss .= '<style>';
		if($controlsize_src != ''){
			$vapaudiocss .= '#vap'.$id.' { '.$controlsize_src.' } ';
		}
		
		$mpmy_theme = wp_get_theme();
		if($mpmy_theme->get('Name') == 'OptimizePress' && $mpmy_theme->get('Version') > 2){
			$vapaudiocss .= '.vjs-default-skin .vjs-big-play-button:before { line-height: 2.4em !important; } ';
		}
		elseif($mpmy_theme->get('Name') == 'Metro Magazine'){
			$vapaudiocss .= '.vjs-default-skin .vjs-big-play-button:before { line-height: 2.4em !important; } ';
		}
		if($vapadtype == 'googleima' && $imatagurl != ''){
			/*$vapaudiocss .= '#vap'.$id.' #ima-ad-container, #vap'.$id.' #ima-ad-container + div, #vap'.$id.' #ima-ad-container iframe { width:100% !important; height:100% !important; } ';*/
		}
		$autohideaddcss = '';
		if(strtoupper($controlcolor) != "CCCCCC" || strtoupper($ctrlbarcolor) != "66A8CC" || strtoupper($pbarcolor) != "000000") {
			$color3 = vap_hex2RGB($pbarcolor, true); //Background color is rgba
			$vapaudiocss .= '#vap'.$id.'.vjs-default-skin { color: #' . $controlcolor . '; }';
			$vapaudiocss .= '#vap'.$id.'.vjs-default-skin .vjs-play-progress, #vap'.$id.'.vjs-default-skin .vjs-volume-level { background-color: #' . $ctrlbarcolor . '; }';
		$vapaudiocss .= '#vap'.$id.'.vjs-default-skin .vjs-control-bar, #vap'.$id.'.vjs-default-skin .vjs-big-play-button { background: rgba(' . $color3 . ',0.7); }';
		$vapaudiocss .= '#vap'.$id.'.vjs-default-skin .vjs-slider { background: rgba(' . $color3 . ',0.2333333333333333) } ';
		}
		if ($hidecontrol == 'true'){
			$vapaudiocss .= '#vap'.$id.' .vjs-control-bar { display:none !important; } ';
			$autohideaddcss = 'ctrlhideclass';
		}
		$vapaudiocss .= '</style>';
		$vapadplayerstr .= $vapaudiocss;
		if ($splash)
			$poster_attribute = ' poster="'.$splash.'"';
		else
			$poster_attribute = '';
			
		if ($streamingurl)
			$stream_source = '<source src="'.$streamingurl.'" type=\'rtmp/mp4\' />';
		else
			$stream_source = '';
		
		if ($mp4)
			$mp4_source = '<source src="'.$mp4.'" type=\'video/mp4\' />';
		else
			$mp4_source = '';
	
		// WebM Source Supplied
		if ($webm)
			$webm_source = '<source src="'.$webm.'" type=\'video/webm\' />';
		else
			$webm_source = '';
	
		// Ogg source supplied
		if ($ogg)
			$ogg_source = '<source src="'.$ogg.'" type=\'video/ogg\' />';
		else
			$ogg_source = '';
			
		if ($mp3url)
			$mp3_source = '<source src="'.$mp3url.'" type=\'audio/mp3\' />';
		else
			$mp3_source = '';
		
		if ($hidecontrol == 'true'){
			//$hidecontrol_src = '"children": { "controlBar": false }';
			
		}else{
			$precontrolsetup = '"children": { "controlBar": { "children": { ';
			$postcontrolsetup = '} } } ';
			$maincontrolsetup = '';
			
			 
			if($htoggleplay == 'true'){
				if($maincontrolsetup == '') { $maincontrolsetup .= '"playToggle": false'; } else { $maincontrolsetup .= ',"playToggle": false'; }
			}
			if($hfullscreen == 'true'){
				if($maincontrolsetup == '') { $maincontrolsetup .= '"fullscreenToggle": false'; } else { $maincontrolsetup .= ',"fullscreenToggle": false'; }
			}
			if($hvolume == 'true'){
				if($maincontrolsetup == '') { $maincontrolsetup .= '"volumeControl": false'; } else { $maincontrolsetup .= ',"volumeControl": false'; }
			}
			if($hmutetoggle == 'true'){
				if($maincontrolsetup == '') { $maincontrolsetup .= '"muteToggle": false'; } else { $maincontrolsetup .= ',"muteToggle": false'; }
			}
			if($hprogbar == 'true'){
			if($maincontrolsetup == '') { $maincontrolsetup .= '"progressControl": false'; } else { $maincontrolsetup .= ',"progressControl": false'; }
			}
			if($htime == 'true'){
				if($maincontrolsetup == '') { $maincontrolsetup .= '"currentTimeDisplay": false,"timeDivider": false,"durationDisplay": false'; } else { $maincontrolsetup .= ',"currentTimeDisplay": false,"timeDivider": false,"durationDisplay": false'; }
			}
			if($maincontrolsetup != ''){
				$hidecontrol_src = $precontrolsetup.$maincontrolsetup.$postcontrolsetup;
			}
			else{
				$hidecontrol_src = '';
			}
			
		}
		
		if ($autoplay == 'true')
			$autoplay_src = 'autoplay="true" ';
		else
			$autoplay_src = '';
			
		if ($preloadvid == 'true')
			$preload_src = 'preload ';
		else
			$preload_src = '';
			
		if ($loopvid == 'true')
			$loopvid_src = 'loop ';
		else
			$loopvid_src = '';
			
		if ($vidaudwidth != '')
			$vidaudwidth_src = $vidaudwidth;
		else
			$vidaudwidth_src = '640';
			
		if ($vidaudheight != '')
			$vidaudheight_src = $vidaudheight;
		else
			$vidaudheight_src = '360';
			
		if ($vidaudmaxwidth)
			$vidaudmaxwidth_src = $vidaudmaxwidth;
		else
			$vidaudmaxwidth_src = '640';	
			
		//if ($playbtnpos == 'center')
			$playbtnpos_src = ' vjs-big-play-centered';
		//else
			//$playbtnpos_src = '';
		
		
		
		
		$vasttagurl_src = '';
		$midvasttagurl_src = '';
		$postvasttagurl_src = '';
		$imatagurl_src = '';
		$endiscomp_src = '';
		if($vapadtype == 'vast'){
			if($vasttagurl == '' && $midvasttagurl == '' && $postvasttagurl == ''){
			}
			else
			{
				wp_enqueue_style('videojs6');
				wp_enqueue_style('videojs7');
				wp_enqueue_script('videojs8');
				wp_enqueue_script('videojs9');
				wp_enqueue_script('videojs10');
				$vasttagurl_src = $vasttagurl;
				$midvasttagurl_src = $midvasttagurl;
				$postvasttagurl_src = $postvasttagurl;
				if($midoffset == ''){
					$midoffset_src = 10;
				}
				else{
					$midoffset_src = $midoffset;
				}
				
				if($skiptime != ''){
					$skiptime_src = $skiptime;
				}else{
					$skiptime_src = 5;
				}
				if($hideskipbtn == 'true'){
					$skiptime_src = -1;
				}
				
				if($endiscomp == 'true'){
					$endiscomp_src = '1';
				}
				else{
					$endiscomp_src = '0';
				}
		
			}
		}
		elseif($vapadtype == 'googleima'){
			wp_enqueue_style('videojs6');
			wp_enqueue_style('videojs12');
			wp_enqueue_script('videojs13');
			wp_enqueue_script('videojs11');
			wp_enqueue_script('videojs14');
			$imatagurl_src = $imatagurl;
		}
		if($baoposition != ''){
			wp_enqueue_style('videojs15');
			wp_enqueue_script('videojs16');
		}
		
		
		
		
		//$ratio = $vidaudheight_src/$vidaudwidth_src*100; Set the aspect ratio (default 16:9)
		$ratio = '';
		if($vidaspectratio == '169'){
			$ratio = '56.25';
		}
		elseif($vidaspectratio == '43'){
			$ratio = '75';
		}
		
		$maxwidth = $vidaudmaxwidth_src;
		
		$vidtagheight = '';
		$vidtagwidth = '';
		$vidtagwidth = $vidaudmaxwidth_src;
		$vidtagheight = round(($ratio*$vidaudmaxwidth_src)/100);
		
		if ($vidtagwidth == '') $vidtagwidth = '640';
			
		if ($vidtagheight == '') $vidtagheight = '360';
		
		/*$vpaidcss_src = '';	
			
		if($hidecontrol_src == ''){
			$vpaidcss_src = '"plugins": {
                          "vastClient":{
                              "url": "'.$vpaidtagurl.'"
                          }
                  }';
		}else{
			$vpaidcss_src = ',"plugins": {
                          "vastClient":{
                              "url": "'.$vpaidtagurl.'"
                          }
                  }';
		}*/
		
		$vapvideotag .= '<video id="vap'.$id.'" class="video-js'.$skindefaultclass.$skin2class.$playbtnpos_src.'" controls '.$preload_src.$loopvid_src.'width="'.$vidtagwidth.'" height="'.$vidtagheight.'" '.$poster_attribute.' data-setup=\'{'.$hidecontrol_src.'}\'>';	
		$vapvideotag .= $stream_source;
		$vapvideotag .= $mp4_source;
		$vapvideotag .= $webm_source;
		$vapvideotag .= $ogg_source;
		$vapvideotag .= '</video>';	
	
		
		
		if($videoalign == 'center' || $videoalign == ''){
			$vidaudioalign = 'margin:0 auto;';
			$vidaudioalign2 = 'center';
		}
		else{
			$vidaudioalign = '';
			$vidaudioalign2 = 'left';
		}
		
		// companion width height
		if($tadsize != 'none' && $tadsize != ''){
			$tadsize_comp = explode("-", $tadsize);
		}
		else{
			$tadsize_comp = '0';
		}
		if($ladsize != 'none' && $ladsize != ''){
			$ladsize_comp = explode("-", $ladsize);
		}
		else{
			$ladsize_comp = '0';
		}
		if($radsize != 'none' && $radsize != ''){
			$radsize_comp = explode("-", $radsize);
		}
		else{
			$radsize_comp = '0';
		}
		if($badsize != 'none' && $badsize != ''){
			$badsize_comp = explode("-", $badsize);
		}
		else{
			$badsize_comp = '0';
		}
		if($wadsize != 'none' && $wadsize != ''){
			$wadsize_comp = explode("-", $wadsize);
		}
		else{
			$wadsize_comp = '0';
		}
		
		if($wadsize2 != 'none' && $wadsize2 != ''){
			$wadsize_comp2 = explode("-", $wadsize2);
		}
		else{
			$wadsize_comp2 = '0';
		}
		if($wadsize3 != 'none' && $wadsize3 != ''){
			$wadsize_comp3 = explode("-", $wadsize3);
		}
		else{
			$wadsize_comp3 = '0';
		}
		
		
		
		
		// end companion width height
		
		$videoinlineb ='';
		if($urltype == 'video_url') {
			if($endiscomp_src == '1' && $vapadtype == 'vast'){
				if($tadsize != 'none' || $badsize != 'none' || $ladsize != 'none' || $radsize != 'none'){
					$videoinlineb = 'display:inline-block;';
					$vapadplayerstr .= '<div id="mcom'.$id.'" style="width:100%;text-align:'.$vidaudioalign2.';">';
				}
			}
			if($tadsize != 'none' && $endiscomp_src == '1' && $vapadtype == 'vast'){			
				$vapadplayerstr .= '<div id="2com'.$id.'"style="display:inline-block;background-color:#ddd;width:'.$tadsize_comp[0].'px;height:'.$tadsize_comp[1].'px; margin-bottom:5px;"></div><div style="clear:both;"></div>';
			}
			if($ladsize != 'none' && $endiscomp_src == '1' && $vapadtype == 'vast'){
				$vapadplayerstr .= '<div id="4com'.$id.'" style="background-color:#ddd;display:inline-block;vertical-align: top;margin:0 auto;margin-right:5px;width:'.$ladsize_comp[0].'px;height:'.$ladsize_comp[1].'px;"></div>';
			}
			$vapadplayerstr .= '<div style="max-width:'.$maxwidth.'px;width:100%;'.$videoinlineb.$vidaudioalign.$shadowcss.$bordercss1.'">';
			$vapadplayerstr .= '<div class="video-wrapper '.$autohideaddcss.'" style="padding-bottom:'.$ratio.'%;">';
			$vapadplayerstr .= $vapvideotag;
			$vapadplayerstr .= '</div>';
			$vapadplayerstr .= '</div>';
			if($radsize != 'none' && $endiscomp_src == '1' && $vapadtype == 'vast'){
				$vapadplayerstr .= '<div id="1com'.$id.'" style="background-color:#ddd;display:inline-block;vertical-align: top;margin:0 auto;margin-left:5px;width:'.$radsize_comp[0].'px;height:'.$radsize_comp[1].'px;"></div>';
			}
			if($badsize != 'none' && $endiscomp_src == '1' && $vapadtype == 'vast'){
				$vapadplayerstr .= '<div id="3com'.$id.'" style="background-color:#ddd;vertical-align: top;margin:0 auto;margin-top:5px;width:'.$badsize_comp[0].'px;height:'.$badsize_comp[1].'px;"></div>';
			}
			if($endiscomp_src == '1' && $vapadtype == 'vast'){
				if($tadsize != 'none' || $badsize != 'none' || $ladsize != 'none' || $radsize != 'none'){
					$vapadplayerstr .= '</div>';
				}
			}
			
			$vapadplayerstr .= '<script>';
			if($vapadtype == 'vast'){
				if($vasttagurl_src == '' && $midvasttagurl_src == '' && $postvasttagurl_src == ''){
				}
				else
				{
					
					$vapadplayerstr .= 'jQuery(document).ready(function(){';
					$vapadplayerstr .= 'var vapvid1 = videojs(\'vap'.$id.'\');';
					$vapadplayerstr .= 'vapvid1.ads();';
					$vapadplayerstr .= 'vapvid1.vast({';
					$vapadplayerstr .= 'url: \''.$vasttagurl_src.'\',';
					$vapadplayerstr .= 'skip: '.$skiptime_src.',';
					$vapadplayerstr .= 'posturl: \''.$postvasttagurl_src.'\',';
					$vapadplayerstr .= 'midurl: \''.$midvasttagurl_src.'\',';
					$vapadplayerstr .= 'midoffset: '.$midoffset_src.',';
					$vapadplayerstr .= 'iscompanion: \''.$endiscomp_src.'\',';
					$vapadplayerstr .= 'compdiv: \''.$compdivid.'\',';
					if($tadsize != 'none' && $tadsize != ''){
						$vapadplayerstr .= 'topadw: \''.$tadsize_comp[0].'\',';
						$vapadplayerstr .= 'topadh: \''.$tadsize_comp[1].'\',';
					}
					else{
						$vapadplayerstr .= 'topadw: \'none\',';
						$vapadplayerstr .= 'topadh: \'none\',';
					}
					if($badsize != 'none' && $badsize != ''){
						$vapadplayerstr .= 'bopadw: \''.$badsize_comp[0].'\',';
						$vapadplayerstr .= 'bopadh: \''.$badsize_comp[1].'\',';
					}
					else{
						$vapadplayerstr .= 'bopadw: \'none\',';
						$vapadplayerstr .= 'bopadh: \'none\',';
					}
					if($ladsize != 'none' && $ladsize != ''){
						$vapadplayerstr .= 'lopadw: \''.$ladsize_comp[0].'\',';
						$vapadplayerstr .= 'lopadh: \''.$ladsize_comp[1].'\',';
					}
					else{
						$vapadplayerstr .= 'lopadw: \'none\',';
						$vapadplayerstr .= 'lopadh: \'none\',';
					}
					if($radsize != 'none' && $radsize != ''){
						$vapadplayerstr .= 'ropadw: \''.$radsize_comp[0].'\',';
						$vapadplayerstr .= 'ropadh: \''.$radsize_comp[1].'\',';
					}
					else{
						$vapadplayerstr .= 'ropadw: \'none\',';
						$vapadplayerstr .= 'ropadh: \'none\',';
					}
					if($wadsize != 'none' && $wadsize != ''){
						$vapadplayerstr .= 'wopadw: \''.$wadsize_comp[0].'\',';
						$vapadplayerstr .= 'wopadh: \''.$wadsize_comp[1].'\',';
					}
					else{
						$vapadplayerstr .= 'wopadw: \'none\',';
						$vapadplayerstr .= 'wopadh: \'none\',';
					}
					if($wadsize2 != 'none' && $wadsize2 != ''){
						$vapadplayerstr .= 'wopadw1: \''.$wadsize_comp2[0].'\',';
						$vapadplayerstr .= 'wopadh1: \''.$wadsize_comp2[1].'\',';
					}
					else{
						$vapadplayerstr .= 'wopadw1: \'none\',';
						$vapadplayerstr .= 'wopadh1: \'none\',';
					}
					if($wadsize3 != 'none' && $wadsize3 != ''){
						$vapadplayerstr .= 'wopadw2: \''.$wadsize_comp3[0].'\',';
						$vapadplayerstr .= 'wopadh2: \''.$wadsize_comp3[1].'\',';
					}
					else{
						$vapadplayerstr .= 'wopadw2: \'none\',';
						$vapadplayerstr .= 'wopadh2: \'none\',';
					}
					$vapadplayerstr .= 'palyerid: '.$id;
					
					$vapadplayerstr .= '}); });';
					
				}
			}
			elseif($vapadtype == 'googleima' && $imatagurl_src != ''){
				
				$vapadplayerstr .= 'jQuery(document).ready(function(){';
				$vapadplayerstr .= "var player = videojs('vap".$id."');

var options = {
  id: 'vap".$id."',
  adTagUrl: '".$imatagurl_src ."'
};

player.ima(options);

// Remove controls from the player on iPad to stop native controls from stealing
// our click
var contentPlayer =  document.getElementById('vap".$id."_html5_api');
if ((navigator.userAgent.match(/iPad/i) ||
      navigator.userAgent.match(/Android/i)) &&
    contentPlayer.hasAttribute('controls')) {
  contentPlayer.removeAttribute('controls');
}

// Initialize the ad container when the video player is clicked, but only the
// first time it's clicked.
var startEvent = 'click';
if (navigator.userAgent.match(/iPhone/i) ||
    navigator.userAgent.match(/iPad/i) ||
    navigator.userAgent.match(/Android/i)) {
  startEvent = 'tap';
}

player.one(startEvent, function() {
    player.ima.initializeAdDisplayContainer();
    player.ima.requestAds();
    player.play();
});
";
				/*$vapadplayerstr .= 'var player = videojs(\'vap'.$id.'\');';
				$vapadplayerstr .= 'var options = {';
				$vapadplayerstr .= 'id: \'vap'.$id.'\',';
				$vapadplayerstr .= 'adTagUrl: \''.$imatagurl_src .'\'';
				$vapadplayerstr .= '};';
				$vapadplayerstr .= 'player.ima(options);';
				$vapadplayerstr .= 'var contentPlayer =  document.getElementById(\'vap'.$id.'_html5_api\');';
				$vapadplayerstr .= ' if ((navigator.userAgent.match(/iPad/i) || ';
				$vapadplayerstr .= 'navigator.userAgent.match(/Android/i)) && ';
				$vapadplayerstr .= 'contentPlayer.hasAttribute(\'controls\')) {';
				$vapadplayerstr .= 'contentPlayer.removeAttribute(\'controls\');';
				$vapadplayerstr .= '}';
				$vapadplayerstr .= 'var clickedOnce = false;';
				$vapadplayerstr .= 'var startEvent = \'click\';';
				$vapadplayerstr .= ' if (navigator.userAgent.match(/iPhone/i) || ';
				$vapadplayerstr .= 'navigator.userAgent.match(/iPad/i) || ';
				$vapadplayerstr .= 'navigator.userAgent.match(/Android/i)) { alert("junaid"); ';
				$vapadplayerstr .= 'startEvent = \'tap\';';
				$vapadplayerstr .= '}';
				if ($autoplay != 'true'){
					$vapadplayerstr .= 'player.on(startEvent, function() { ';
				}
				$vapadplayerstr .= 'if (!clickedOnce) { ';
				$vapadplayerstr .= 'player.ima.initializeAdDisplayContainer();';
				$vapadplayerstr .= 'player.ima.requestAds();';
				$vapadplayerstr .= 'player.play();';
				$vapadplayerstr .= 'clickedOnce = true;';
				$vapadplayerstr .= '}';
				if ($autoplay != 'true'){
					$vapadplayerstr .= ' }); ';
				}*/
				$vapadplayerstr .= ' }); ';
				
			}
			elseif($vapadtype == 'vpaid' && $vpaidtagurl != ''){
				$vapadplayerstr .= 'jQuery(document).ready(function(){';
				$vapadplayerstr .= 'var player1 = videojs(\'vap'.$id.'\');';
				$vapadplayerstr .= 'var vastPlugin = player1.vastClient({ ';
     			$vapadplayerstr .= 'url: "'.$vpaidtagurl . '",';
				$vapadplayerstr .= ' adCancelTimeout: 30000, ';
				$vapadplayerstr .= ' vpaidFlashLoaderPath :"'.plugins_url().'/videoadplayer/js/plugins/vpaid/VPAIDFlash.swf" ';
   				$vapadplayerstr .= '}); ';
				/*$vapadplayerstr .= 'player1.on(\'reset\', function () { ';
       			$vapadplayerstr .= 'if (!vastPlugin.isEnabled()) { ';
         		$vapadplayerstr .= 'vastPlugin.enable(); ';
      			$vapadplayerstr .= ' } else { ';
         		$vapadplayerstr .= ' vastAd.disable(); ';
       			$vapadplayerstr .= ' } ';
			    $vapadplayerstr .= ' }); ';*/
				$vapadplayerstr .= ' }); ';
			}
			if($baoposition != ''){
				if(count($baoposition) == 1 && $baohtmltext[0] == ''){
				}
				else
				{
				$vapadplayerstr .= 'jQuery(document).ready(function(){';
				$vapadplayerstr .= 'var vapplayer = videojs(\'vap'.$id.'\');';
				$vapadplayerstr .= 'vapplayer.overlay({';
      			$vapadplayerstr .= 'overlays: [';
				for ($p=0; $p<count($baoposition); $p++){
					if($baostarttime[$p] == ''){
						$baostarttime[$p] = '\'play\'';
					}
					if($baoendtime[$p] == ''){
						$baoendtime[$p] = '\'pause\'';
					}
					if($p == 0){
						$vapadplayerstr .= '{ ';
					}
					else{
						$vapadplayerstr .= ' ,{ ';
					}
					$vapadplayerstr .= 'content: \''. str_replace("'","\'",str_replace(array("\r\n","\n\r","\r", "\n"), '', stripslashes(do_shortcode($baohtmltext[$p])))).'\',';
					$vapadplayerstr .= 'start: '.$baostarttime[$p].',';
					$vapadplayerstr .= 'end: '.$baoendtime[$p].',';
					$vapadplayerstr .= 'align: \''.$baoposition[$p].'\',';
					$vapadplayerstr .= 'owidth: '.$baoverlaywidth[$p];
					$vapadplayerstr .= ' } '; 
				}
	  $vapadplayerstr .= ']';
				$vapadplayerstr .= ' }); }); ';
			}
				}
			$vapadplayerstr .= '</script>';
		
	if($envidschedule == "true"){	
			
			$zonepieces = explode('q', $scheimezone);
			$countdowncss = plugins_url( 'jcountdown/jcountdown.css' , __FILE__ );
			$countdownjs  = plugins_url( 'jcountdown/jquery.jcountdown.min.js' , __FILE__ );		
			$vapadplayerstr .= '<link media="all" type="text/css" href="'.$countdowncss.'" rel="stylesheet">
			<script src="'.$countdownjs.'"></script>';	
			
			$vapadplayerstr .= '<script type="text/javascript">';
			/*$abc = plugins_url( 'video-js/video-js.swf' , __FILE__ );
			$vapadplayerstr .= 'videojs.options.flash.swf = '.$abc.';';
	*/
	
	
			$vapadplayerstr .= 'jQuery(document).ready(function(){ ';
			$vapadplayerstr .= 'var maximaadplayer_source = videojs(\'vap'.$id.'\'); ';
			
		//	$vapadplayerstr .= ' alert("junaid"); ';
		
			//$vapadplayerstr .= 'maximaadplayer_source.src({ type: "video/mp4" , "src": "http://d2k73fu83k71cw.cloudfront.net/videos/maxima_2.mp4"});';

				$schbgcolors = vap_hex2RGB($schoverbgcolor, true);
				$schoverbgopavar = '';
				if($schoverbgopa == '') {
					$schoverbgopavar = '1';
				}
				else{
					$schoverbgopavar = $schoverbgopa;
				}
				
		
		/*$showcountrefl   = get_post_meta( $id,'vap-showcountreflection',true );
		$hidelabels      = get_post_meta( $id,'vap-hidelabels',true );
		$hidedays        = get_post_meta( $id,'vap-hidedays',true );
		$hidehourss      = get_post_meta( $id,'vap-hidehourss',true );
		$hidemins        = get_post_meta( $id,'vap-hidemins',true );
		$hidesecs        = get_post_meta( $id,'vap-hidesecs',true );*/
		
		if($showcountrefl != "true"){
			$showcountrefl = "false";
		}
		if($hidelabels == "true"){
			$hidelabels = "false";
		}
		else{
			$hidelabels = "true";
		}
		
		if($hidedays == "true"){
			$hidedays = "false";
		}
		else{
			$hidedays = "true";
		}
		
		if($hidehourss == "true"){
			$hidehourss = "false";
		}
		else{
			$hidehourss = "true";
		}
		
		if($hidemins == "true"){
			$hidemins = "false";
		}
		else{
			$hidemins = "true";
		}
		
		if($hidesecs == "true"){
			$hidesecs = "false";
		}
		else{
			$hidesecs = "true";
		}
		
		if($counterwidth == ''){
			$counterwidth = '350';
		}
		
	$vapadplayerstr .= ' var mpcountdownstring = \'<div id="mpCountDownMainDiv" style="width:100%;background: rgba(' . $schbgcolors . ','.$schoverbgopavar.');"><div class="mpCountDownTopText" style="color:#'.$schedtitlecolor.' !important;" >'.$schedtitletext.' <br /> <div class="mpCountDownMainDivIn" style="display:inline-block;"><div class="mpliveCountDownDigits" style="display:inline-block;"></div></div></div></div>\';
			
			var mpcountermainwidth = '.$counterwidth.';
			var mptextGroupSpace = 15;
			
			if( /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
				
				mpcountermainwidth = 200;
				mptextGroupSpace = 10;
				
			}
			
			jQuery("#vap'.$id.' .vjs-control-bar").after(mpcountdownstring);
			
			
//alert(dateStartLiveStr);
dateStartLiveStr = \''.$scheduledate.'\';
			jQuery(".mpliveCountDownDigits").jCountdown({
				timeText:dateStartLiveStr,
				timeZone : '.$zonepieces[0].',
				style:"'.$counterstyle.'",
				color:"'.$countercolor.'",
				width:mpcountermainwidth,
				mptextGroupSpace:mptextGroupSpace,
				textSpace:0,
				reflection:'.$showcountrefl.',
				reflectionOpacity:10,
				reflectionBlur:0,
				dayTextNumber:2,
				displayDay:'.$hidedays.',
				displayHour:'.$hidehourss.',
				displayMinute:'.$hidemins.',
				displaySecond:'.$hidesecs.',
				displayLabel:'.$hidelabels.',
				onFinish:function(){
					//alert("junaid");
					jQuery("#mpCountDownMainDiv").remove();
					jQuery("#mpCountDownMainDiv").hide();
					maximaadplayer_source.currentTime(0)
					maximaadplayer_source.play();
					/*mobileStrat();
					jQuery("#preRunHtml").hide();
					jQuery("#liveStream").show();*/
				}
			});	
	';
$vapadplayerstr .= '});';
	
			$vapadplayerstr .= '</script>';
			}
			
			// start facebook tracking
		
		if($enfbretarget == "true"){	
			
            $vapadplayerstr .= '<script type="text/javascript">';
			$vapadplayerstr .= 'jQuery(document).ready(function(){ ';
			$vapadplayerstr .= 'var maximaadplayer_source2 = videojs(\'vap'.$id.'\'); ';
			$vapadplayerstr .= "var appTrack = '(function() { '+
				' var _fbq = window._fbq || (window._fbq = []); '+
				' if (!_fbq.loaded) { '+
				 '  var fbds = document.createElement(\'script\'); '+
				 '  fbds.async = true; '+
				 '  fbds.src = \'//connect.facebook.net/en_US/fbds.js\'; '+
				 '  var s = document.getElementsByTagName(\'script\')[0]; '+
				 '  s.parentNode.insertBefore(fbds, s); '+
				 '  _fbq.loaded = true; '+
				 '} '+
				' _fbq.push([\'addPixelId\', \'".$fbpixelid."\']); '+
				'})(); '+
				'window._fbq = window._fbq || []; '+
				'window._fbq.push([\'track\', \'PixelInitialized\', {}]); ';";
			/*$vapadplayerstr .= 'var appTrack = \'(function() { \'+
				\' var _fbq = window._fbq || (window._fbq = []); \'+
				\' if (!_fbq.loaded) { \'+
				 \'  var fbds = document.createElement("script"); \'+
				 \'  fbds.async = true; \'+
				 \'  fbds.src = \'//connect.facebook.net/en_US/fbds.js\'; \'+
				 \'  var s = document.getElementsByTagName("script")[0]; \'+
				 \'  s.parentNode.insertBefore(fbds, s); \'+
				 \'  _fbq.loaded = true; \'+
				 \'} \'+
				\' _fbq.push(["addPixelId", "'.$fbpixelid .'"]); \'+
				\'})(); \'+
				\'window._fbq = window._fbq || []; \'+
				\'window._fbq.push(["track", "PixelInitialized", {}]); } \';';*/

					$vapadplayerstr .= ' var mppixelentered = false; ';
					$aftertime = '';	
					if($fbcodeembp == 'fbvidstart'){
						$aftertime = 0;
					}
					else{
						$aftertime = intval($fbremin)*60+intval($fbresec);
					}
						
					$vapadplayerstr .= '	maximaadplayer_source2.on("timeupdate", function(){ if(maximaadplayer_source2.currentTime() > '.$aftertime.' && !mppixelentered){ var mpscript   = document.createElement("script"); mpscript.type  = "text/javascript"; mpscript.text  = appTrack; document.body.appendChild(mpscript); mppixelentered = true; } ';
					$vapadplayerstr .= ' }); }); ';	
					$vapadplayerstr .= ' </script> ';      
					  
			}
			$vapadplayerstr .= '<script type="text/javascript">';
				$vapadplayerstr .= 'jQuery(document).ready(function(){ ';
				$vapadplayerstr .= 'var vapvid6 = videojs(\'vap'.$id.'\');';
				if ($autoplay == 'true'){
					$vapadplayerstr .= ' vapvid6.play(); ';
				}
				$vapadplayerstr .= ' }); ';	
				$vapadplayerstr .= ' </script> '; 
			//end facebook tracking
			if($dimlight == 'true'){
			
				$vapadplayerstr .= '<script type="text/javascript">';
				$vapadplayerstr .= 'jQuery(document).ready(function(){ ';
				
				$vapadplayerstr .= ' var dimthelightdiv = \'<div class="vjs-dim-overlay"></div>\';';
				
				
				$vapadplayerstr .= ' setTimeout( function(){ jQuery("#vap'.$id.'").after(dimthelightdiv); } , 50 ); jQuery("#vap'.$id.'").addClass("vjs-dim-fc");';
				
				$vapadplayerstr .= 'var vapvid5 = videojs(\'vap'.$id.'\');';
				
				if($dimlighttype == '1'){
					$vapadplayerstr .= ' vapvid5.dimTheLights({ }); ';
				}
				else{
				//$vapadplayerstr .= 'videojs(\'vap'.$id.'\', {plugins: {dimTheLights: {}}}); ';
					
					$vapadplayerstr .= ' vapvid5.on("play", function(){  setTimeout( function(){ jQuery(".vjs-dim-fc").addClass("vjs-dim-focus"); jQuery(".vjs-dim-overlay").css("display", "block"); jQuery(".vjs-dim-overlay:first").addClass("vjs-dim-off"); } , 100 ); });';
					$vapadplayerstr .= ' vapvid5.on("pause", function(){ jQuery(".vjs-dim-fc").removeClass("vjs-dim-focus"); jQuery(".vjs-dim-overlay").css("display", "none"); setTimeout( function(){ jQuery(".vjs-dim-overlay:first").removeClass("vjs-dim-off"); } , 15 ); });';
					$vapadplayerstr .= ' vapvid5.on("ended", function(){ jQuery(".vjs-dim-fc").removeClass("vjs-dim-focus"); jQuery(".vjs-dim-overlay").css("display", "none"); setTimeout( function(){ jQuery(".vjs-dim-overlay:first").removeClass("vjs-dim-off"); } , 15 ); });';
				}
				$vapadplayerstr .= ' }); ';	
				$vapadplayerstr .= ' </script> '; 
			}
			
			//end dimlights
					
    }else{
			if ($ogg)
				$ogg_source = '<source src="'.$ogg.'" type=\'audio/ogg\' />';
			else
				$ogg_source = '';
			$vapaudiotag .= '<audio id="vap'.$id.'" class="video-js'.$skindefaultclass.$skin2class.$playbtnpos_src.'" controls '.$autoplay_src.$preload_src.$loopvid_src.'width="640" height="360" '.$poster_attribute.' data-setup=\'{'.$hidecontrol_src.'}\'>';	
			$vapaudiotag .= $mp3_source;
			$vapaudiotag .= $ogg_source;
			$vapaudiotag .= '</audio>';
			$vapadplayerstr .= '<div style="max-width:'.$maxwidth.'px;'.$vidaudioalign.$shadowcss.$bordercss1.'">';
			$vapadplayerstr .= '<div class="video-wrapper" style="padding-bottom:'.$ratio.'%;">';
			$vapadplayerstr .= $vapaudiotag;
			$vapadplayerstr .= '</div>';
			$vapadplayerstr .= '</div>';
		}
		
		return $vapadplayerstr;
	}
}

add_shortcode('videoadplayer', 'add_vap_shortcode');

function vap_hex2RGB($hexStr, $returnAsString = false, $seperator = ',') {
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); // Gets a proper hex string
    $rgbArray = array();
    if (strlen($hexStr) == 6) { //If a proper hex code, convert using bitwise operation. No overhead... faster
        $colorVal = hexdec($hexStr);
        $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
        $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
        $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
        $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
        $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
        $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else {
        return false; //Invalid hex color code
    }
    return $returnAsString ? implode($seperator, $rgbArray) : $rgbArray; // returns the rgb string or the associative array
}

if ( is_admin() ) {
add_action( 'wp_ajax_vap_pagepost_duplicate', 'vap_pagepost_duplicate' );
	function vap_pagepost_duplicate() {
		global $wpdb;
		check_ajax_referer( 'm4c_ajax_file_nonce', 'security' );
		$original_id  = $_POST['original_id'];
		$duplicate = get_post( $original_id, 'ARRAY_A' );
		$duplicate['post_title'] = $duplicate['post_title'].' Duplicate';
		$timestamp = strtotime($duplicate['post_date']);
		$duplicate['post_date'] = date('Y-m-d H:i:s', $timestamp);
		unset( $duplicate['ID'] );
		unset( $duplicate['guid'] );
		unset( $duplicate['comment_count'] );
		$duplicate_id = wp_insert_post( $duplicate );
		$taxonomies = get_object_taxonomies( $duplicate['post_type'] );
		foreach( $taxonomies as $taxonomy ) {
			$terms = wp_get_post_terms( $original_id, $taxonomy, array('fields' => 'names') );
			wp_set_object_terms( $duplicate_id, $terms, $taxonomy );
		}
		$custom_fields = get_post_custom( $original_id );
	  foreach ( $custom_fields as $key => $value ) {
			add_post_meta( $duplicate_id, $key, maybe_unserialize($value[0]) );
	  }
	  
		echo 'Duplicate Post Created!';
		die();
	}
	
	
	
	
	add_filter( 'post_row_actions', 'vap_duplicate_action_row', 10, 2 );
	function vap_duplicate_action_row( $actions, $post ){
		$post_type = get_post_type_object( $post->post_type );
		if($post_type->labels->singular_name == 'MaximaPlayer - Video Ads')
		{
		$nonce = wp_create_nonce( 'm4c_ajax_file_nonce' ); 
	  $actions['duplicate_post'] = '<a class="vapduplicatepagepost" rel="'.$nonce.'" href="'.$post->ID.'">Duplicate '.$post_type->labels->singular_name.'</a>';
	}
		return $actions;
	}
}
 if (function_exists ('wpoptinpro_unautop')) {

	add_filter ('widget_text', 'wpoptinpro_unautop');

  }

add_filter ('widget_text', 'do_shortcode');
VideoAdPlayer::vap_get_instance();
Vap_Meta_Box::vapmeta_get_instance();

include('vappvcintegration.php');
if(class_exists('Sppvc_vap_Listvaplayer'))
{
	$Sppvc_vap_Listvaplayer = new Sppvc_vap_Listvaplayer;
}