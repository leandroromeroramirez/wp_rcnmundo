<?php 

/*Set player to site */
function overwrite_shortcode() 
{ 
  function lamega_wp_audio_shortcode( $attr, $content = '' ) {
      $post_id = get_post() ? get_the_ID() : 0;
	  
	  $min=1;
	  $max=20;
	  $number=rand($min,$max);

    static $instance = 0;
    $instance++;  

    /**
     * Filter the default audio shortcode output.
     *
     * If the filtered output isn't empty, it will be used instead of generating the default audio template.
     *
     * @since 3.6.0
     *
     * @param string $html     Empty variable to be replaced with shortcode markup.
     * @param array  $attr     Attributes of the shortcode. @see wp_audio_shortcode()
     * @param string $content  Shortcode content.
     * @param int    $instance Unique numeric ID of this audio shortcode instance.
     */
    $override = apply_filters( 'wp_audio_shortcode_override', '', $attr, $content, $instance );
    if ( '' !== $override ) {
      return $override;
    } 

    $audio = null;  

    $default_types = wp_get_audio_extensions();
    $defaults_atts = array(
      'src'      => '',
      'loop'     => '',
      'autoplay' => '',
      'preload'  => 'none'
    );
    foreach ( $default_types as $type ) {
      $defaults_atts[$type] = '';
    } 

    $atts = shortcode_atts( $defaults_atts, $attr, 'audio' ); 

    $primary = false;
    if ( ! empty( $atts['src'] ) ) {
      $type = wp_check_filetype( $atts['src'], wp_get_mime_types() );
      if ( ! in_array( strtolower( $type['ext'] ), $default_types ) ) {
        return sprintf( '<a class="wp-embedded-audio" href="%s">%s</a>', esc_url( $atts['src'] ), esc_html( $atts['src'] ) );
      }
      $primary = true;
      array_unshift( $default_types, 'src' );
    } else {
      foreach ( $default_types as $ext ) {
        if ( ! empty( $atts[ $ext ] ) ) {
          $type = wp_check_filetype( $atts[ $ext ], wp_get_mime_types() );
          if ( strtolower( $type['ext'] ) === $ext ) {
            $primary = true;
          }
        }
      }
    } 

    if ( ! $primary ) {
      $audios = get_attached_media( 'audio', $post_id );
      if ( empty( $audios ) ) {
        return;
      } 

      $audio = reset( $audios );
      $atts['src'] = wp_get_attachment_url( $audio->ID );
      if ( empty( $atts['src'] ) ) {
        return;
      } 

      array_unshift( $default_types, 'src' );
    } 
    //$vid_ima = wp_get_attachment_image_src( get_post_thumbnail_id($post_id->ID), full );
      //$vid_ima  = the_post_thumbnail( array(600,400) ) ;
      //$vid_ima = get_thumbnail_cache($post_id->ID,565,350);
    $vid_ima = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
      if(get_post(get_post_thumbnail_id())->post_excerpt){
      $caption_pic = '<div class="caption dev2">'.get_post(get_post_thumbnail_id($post_id->ID))->post_excerpt.'</div>';
      
    }else{
      $caption_pic = '';
    }
    $title_content = urlencode(get_the_title());
    $vadf = rand(10,100);
	$html = '<style>#vap'.$post_id.$vadf.' { font-size:100%; } #vap'.$post_id.$vadf.'.vjs-default-skin { color: #CCCCCC; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-play-progress, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-volume-level { background-color: #0C70B4; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-control-bar, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.7); }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.2333333333333333) } </style>
	
<div style="max-width:640px;width:100%; margin:0 auto;">
	<div class="video-wrapper " style="padding-bottom:56.25%;">
		<video id="vap'.$post_id.$vadf.'" class="video-js vjs-default-skin vjs-big-play-centered" controls preload width="640" height="360" poster="'.$vid_ima.'" data-setup=\'{}\'><source src="'.$atts['src'].'" type=\'video/mp4\' /></video>
	</div>
</div>RCN1';

	$html .= "<script>jQuery(document).ready(function(){
		var vapvid1 = videojs('vap".$post_id.$vadf."');vapvid1.ads();
		vapvid1.vast({
			url: 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNRADIO/VIDEO/RCNRADIO_Video_Preroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]',
			skip: 5,
			posturl: '',
			midurl: '',
			midoffset: 10,
			iscompanion: '1',
			compdiv: '',
			topadw: 'none',
			topadh: 'none',
			bopadw: 'none',
			bopadh: 'none',
			lopadw: 'none',
			lopadh: 'none',
			ropadw: 'none',
			ropadh: 'none',
			wopadw: 'none',
			wopadh: 'none',
			wopadw1: 'none',
			wopadh1: 'none',
			wopadw2: 'none',
			wopadh2: 'none',
			palyerid: ".$post_id.$vadf."}); });
</script>";

	$html .= '<script type="text/javascript">jQuery(document).ready(function(){ var vapvid6 = videojs(\'vap'.$post_id.$vadf.'\'); vapvid6.play(); });  </script>';
	  
	  
	  
	//vapvid6.play();  
    /*$html = '<div class="debuggers llamado1" id="jwplayer-'.$post_id.'-'.$vadf.'"><img src="'.$vid_ima.'" /></div>'.$caption_pic;
    $html .= "<script type='text/javascript'>
      jQuery( document ).ready(function() {
        jwplayer('jwplayer-".$post_id."-".$vadf."').setup({
          primary: 'flash',
          file: '".$atts['src']."',
          image: '".$vid_ima."',
          autostart: false,
          width: '100%',
          aspectratio: '16:9', 
          advertising: {
            client: 'googima',
            tag:'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/62207337/LAMEGA/LAMEGA_video_player/lamega_video_preroll&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1'
          }     

        }); 
      });
      </script>";
      $html .= '<div class="share-poat pull-right-f" style="width: 40%;"><h4>COMPARTIR</h4>
                <a class="fac" rel="nofollow" target="blank" title="facebook" href="http://www.facebook.com/sharer/sharer.php?u='.$atts['src'].'">
              <i class="fa fa-facebook"></i></a>  
              <a class="twi" href="http://twitter.com/home?status='.$title_content.'+'.$atts['src'].'" title="twitter" rel="nofollow" target="blank" ><i class="fa fa-twitter"></i></a>  
                <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?\'http\':\'https\';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+\'://platform.twitter.com/widgets.js\';fjs.parentNode.insertBefore(js,fjs);}}(document, \'script\', \'twitter-wjs\');</script>
              <a class="wapp" rel="nofollow" target="blank" title="whatsapp" href="whatsapp://send?text='.$atts['src'].'&amp;title='.$title_content.'" data-action="share/whatsapp/share"><i class="fa fa-whatsapp"></i></a>
                </div>';*/
    return $html;
  }

  function lamega_wp_embed_shortcode($attr, $content = '' ){
    global $content_width;
    $post_id = get_post() ? get_the_ID() : 0; 

    static $instance = 0;
    $instance++;
    

    $vid_ima = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
      $vid_ima  = preg_replace('/\s+/', '', $vid_ima[0]);
      $vid_ima  = str_replace("<br>","", $vid_ima);
      $vid_url = preg_replace('/\s+/', '', $atts['src']);
      $vid_url = str_replace("<br/>","", $vid_url);
      $vid_url = str_replace("<br>","", $vid_url);
      if(get_post(get_post_thumbnail_id())->post_excerpt){
      $caption_pic = '<div class="caption">'.get_post(get_post_thumbnail_id($post_id->ID))->post_excerpt.'</div>';
    }else{
      $caption_pic = '';
    }
	  $vadf = rand(10,100);
	  
	  
	  
	$html = '<style>#vap'.$post_id.$vadf.' { font-size:100%; } #vap'.$post_id.$vadf.'.vjs-default-skin { color: #CCCCCC; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-play-progress, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-volume-level { background-color: #0C70B4; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-control-bar, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.7); }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.2333333333333333) } </style>
	
<div style="max-width:640px;width:100%; margin:0 auto;">
	<div class="video-wrapper " style="padding-bottom:56.25%;">
		<video id="vap'.$post_id.$vadf.'" class="video-js vjs-default-skin vjs-big-play-centered" controls preload width="640" height="360" poster="'.$vid_ima.'" data-setup=\'{}\'><source src="'.$vid_url.'" type=\'video/mp4\' /></video>
	</div>
</div>RCN2';

	$html .= "<script>jQuery(document).ready(function(){
		var vapvid1 = videojs('vap".$post_id.$vadf."');vapvid1.ads();
		vapvid1.vast({
			url: 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNRADIO/VIDEO/RCNRADIO_Video_Preroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]',
			skip: 5,
			posturl: '',
			midurl: '',
			midoffset: 10,
			iscompanion: '1',
			compdiv: '',
			topadw: 'none',
			topadh: 'none',
			bopadw: 'none',
			bopadh: 'none',
			lopadw: 'none',
			lopadh: 'none',
			ropadw: 'none',
			ropadh: 'none',
			wopadw: 'none',
			wopadh: 'none',
			wopadw1: 'none',
			wopadh1: 'none',
			wopadw2: 'none',
			wopadh2: 'none',
			palyerid: ".$post_id.$vadf."}); });
</script>";

	$html .= '<script type="text/javascript">jQuery(document).ready(function(){ var vapvid6 = videojs(\'vap'.$post_id.$vadf.'\'); vapvid6.play(); });  </script>';	  
	  
	  
	  
    /*$html = '<div id="jwplayer-'.$post_id.'" class="llamado2"></div>'.$caption_pic;
    $html .= "<script type='text/javascript'>
      jwplayer('jwplayer-".$post_id."').setup({
              primary: 'flash',
              file: '".$vid_url."',
              image:'".$vid_ima."',
              autostart: false,
              width: '100%',
              aspectratio: '16:9',
              advertising: {
                client: 'googima',
                tag: 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/62207337/LAMEGA/LAMEGA_video_player/lamega_video_preroll&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1'
              }   

      }); 
      </script>";*/
	  
    return $html;
  }

  function lamega_wp_video_shortcode( $attr, $content = '' ) {
      global $content_width;
    $post_id = get_post() ? get_the_ID() : 0; 

    static $instance = 0;
    $instance++;  

    /**
     * Filter the default video shortcode output.
     *
     * If the filtered output isn't empty, it will be used instead of generating
     * the default video template.
     *
     * @since 3.6.0
     *
     * @see wp_video_shortcode()
     *
     * @param string $html     Empty variable to be replaced with shortcode markup.
     * @param array  $attr     Attributes of the video shortcode.
     * @param string $content  Video shortcode content.
     * @param int    $instance Unique numeric ID of this video shortcode instance.
     */
    $override = apply_filters( 'wp_video_shortcode_override', '', $attr, $content, $instance );
    if ( '' !== $override ) {
      return $override;
    } 

    $video = null;  

    $default_types = wp_get_video_extensions();
    $defaults_atts = array(
      'src'      => '',
      'poster'   => '',
      'loop'     => '',
      'autoplay' => '',
      'preload'  => 'metadata',
      'width'    => 640,
      'height'   => 360,
    );  

    foreach ( $default_types as $type ) {
      $defaults_atts[$type] = '';
    } 

    $atts = shortcode_atts( $defaults_atts, $attr, 'video' ); 

    if ( is_admin() ) {
      // shrink the video so it isn't huge in the admin
      if ( $atts['width'] > $defaults_atts['width'] ) {
        $atts['height'] = round( ( $atts['height'] * $defaults_atts['width'] ) / $atts['width'] );
        $atts['width'] = $defaults_atts['width'];
      }
    } else {
      // if the video is bigger than the theme
      if ( ! empty( $content_width ) && $atts['width'] > $content_width ) {
        $atts['height'] = round( ( $atts['height'] * $content_width ) / $atts['width'] );
        $atts['width'] = $content_width;
      }
    } 

    $is_vimeo = $is_youtube = false;
    $yt_pattern = '#^https?://(?:www\.)?(?:youtube\.com/watch|youtu\.be/)#';
    $vimeo_pattern = '#^https?://(.+\.)?vimeo\.com/.*#';  

    $primary = false;
    if ( ! empty( $atts['src'] ) ) {
      $is_vimeo = ( preg_match( $vimeo_pattern, $atts['src'] ) );
      $is_youtube = (  preg_match( $yt_pattern, $atts['src'] ) );
      if ( ! $is_youtube && ! $is_vimeo ) {
        $type = wp_check_filetype( $atts['src'], wp_get_mime_types() );
        if ( ! in_array( strtolower( $type['ext'] ), $default_types ) ) {
          return sprintf( '<a class="wp-embedded-video" href="%s">%s</a>', esc_url( $atts['src'] ), esc_html( $atts['src'] ) );
        }
      } 

      if ( $is_vimeo ) {
        wp_enqueue_script( 'froogaloop' );
      } 

      $primary = true;
      array_unshift( $default_types, 'src' );
    } else {
      foreach ( $default_types as $ext ) {
        if ( ! empty( $atts[ $ext ] ) ) {
          $type = wp_check_filetype( $atts[ $ext ], wp_get_mime_types() );
          if ( strtolower( $type['ext'] ) === $ext ) {
            $primary = true;
          }
        }
      }
    } 

    if ( ! $primary ) {
      $videos = get_attached_media( 'video', $post_id );
      if ( empty( $videos ) ) {
        return;
      } 

      $video = reset( $videos );
      $atts['src'] = wp_get_attachment_url( $video->ID );
      if ( empty( $atts['src'] ) ) {
        return;
      } 

      array_unshift( $default_types, 'src' );
    } 

    /**
     * Filter the media library used for the video shortcode.
     *
     * @since 3.6.0
     *
     * @param string $library Media library used for the video shortcode.
     */
    $library = apply_filters( 'wp_video_shortcode_library', 'mediaelement' );
    if ( 'mediaelement' === $library && did_action( 'init' ) ) {
      wp_enqueue_style( 'wp-mediaelement' );
      wp_enqueue_script( 'wp-mediaelement' );
    } 

    /**
     * Filter the class attribute for the video shortcode output container.
     *
     * @since 3.6.0
     *
     * @param string $class CSS class or list of space-separated classes.
     */
    $html_atts = array(
      'class'    => apply_filters( 'wp_video_shortcode_class', 'wp-video-shortcode' ),
      'id'       => sprintf( 'video-%d-%d', $post_id, $instance ),
      'width'    => absint( $atts['width'] ),
      'height'   => absint( $atts['height'] ),
      'poster'   => esc_url( $atts['poster'] ),
      'loop'     => wp_validate_boolean( $atts['loop'] ),
      'autoplay' => wp_validate_boolean( $atts['autoplay'] ),
      'preload'  => $atts['preload'],
    );  

    // These ones should just be omitted altogether if they are blank
    foreach ( array( 'poster', 'loop', 'autoplay', 'preload' ) as $a ) {
      if ( empty( $html_atts[$a] ) ) {
        unset( $html_atts[$a] );
      }
    } 

    $attr_strings = array();
    foreach ( $html_atts as $k => $v ) {
      $attr_strings[] = $k . '="' . esc_attr( $v ) . '"';
    } 

    $html = '';
    if ( 'mediaelement' === $library && 1 === $instance ) {
      $html = '<div id="jwplayer-'.$post_id.'" class="llamado3"></div>'.$caption_pic; 
    }
    $fileurl = '';
    $source = '<source type="%s" src="%s" />';
    foreach ( $default_types as $fallback ) {
      if ( ! empty( $atts[ $fallback ] ) ) {
        if ( empty( $fileurl ) ) {
          $fileurl = $atts[ $fallback ];
        }
        if ( 'src' === $fallback && $is_youtube ) {
          $type = array( 'type' => 'video/youtube' );
        } elseif ( 'src' === $fallback && $is_vimeo ) {
          $type = array( 'type' => 'video/vimeo' );
        } else {
          $type = wp_check_filetype( $atts[ $fallback ], wp_get_mime_types() );
        }
        $url = add_query_arg( '_', $instance, $atts[ $fallback ] );
        $video_link =  esc_url( $url );
      }
    } 

    /*if ( ! empty( $content ) ) {
      if ( false !== strpos( $content, "\n" ) ) {
        $content = str_replace( array( "\r\n", "\n", "\t" ), '', $content );
      }
      $html .= trim( $content );
    } */

    if ( 'mediaelement' === $library ) {
	
	$vadf = rand(10,100);
		
	$html .= '<style>#vap'.$post_id.$vadf.' { font-size:100%; } #vap'.$post_id.$vadf.'.vjs-default-skin { color: #CCCCCC; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-play-progress, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-volume-level { background-color: #0C70B4; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-control-bar, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.7); }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.2333333333333333) } </style>
	
<div style="max-width:640px;width:100%; margin:0 auto;">
	<div class="video-wrapper " style="padding-bottom:56.25%;">
		<video id="vap'.$post_id.$vadf.'" class="video-js vjs-default-skin vjs-big-play-centered" controls preload width="640" height="360" poster="'.$vid_ima.'" data-setup=\'{}\'><source src="'.$fileurl.'" type=\'video/mp4\' /></video>
	</div>
</div>RCN3';

	$html .= "<script>jQuery(document).ready(function(){
		var vapvid1 = videojs('vap".$post_id.$vadf."');vapvid1.ads();
		vapvid1.vast({
			url: 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNRADIO/VIDEO/RCNRADIO_Video_Preroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]',
			skip: 5,
			posturl: '',
			midurl: '',
			midoffset: 10,
			iscompanion: '1',
			compdiv: '',
			topadw: 'none',
			topadh: 'none',
			bopadw: 'none',
			bopadh: 'none',
			lopadw: 'none',
			lopadh: 'none',
			ropadw: 'none',
			ropadh: 'none',
			wopadw: 'none',
			wopadh: 'none',
			wopadw1: 'none',
			wopadh1: 'none',
			wopadw2: 'none',
			wopadh2: 'none',
			palyerid: ".$post_id.$vadf."}); });
</script>";

	$html .= '<script type="text/javascript">jQuery(document).ready(function(){ var vapvid6 = videojs(\'vap'.$post_id.$vadf.'\'); vapvid6.play(); });  </script>';		
		
		
      /*//$html .= wp_mediaelement_fallback( $fileurl );
      $html .= "<script type='text/javascript'>
      jwplayer('jwplayer-".$post_id."').setup({
              primary: 'flash',
              file: '".$fileurl."',
              autostart: false,
              width: '100%',
              aspectratio: '16:9',
              advertising: {
                    client: 'googima',
                    tag:'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/62207337/LAMEGA/LAMEGA_video_player/lamega_video_preroll&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1'
              }     

      }); 
      </script>";*/
		
    return $html;
    }
    //$html .= '</video>';  

    $width_rule = '';
    if ( ! empty( $atts['width'] ) ) {
      $width_rule = sprintf( 'width: %dpx; ', $atts['width'] );
    } 
    //$vid_ima = wp_get_attachment_image_src( get_post_thumbnail_id($post_id->ID), full );
    $vid_ima = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ) );
      $vid_ima  = preg_replace('/\s+/', '', $vid_ima[0]);
      $vid_ima  = str_replace("<br>","", $vid_ima);
      $vid_url = preg_replace('/\s+/', '', $url);
      $vid_url = str_replace("<br/>","", $vid_url);
      $vid_url = str_replace("<br>","", $vid_url);
      if(get_post(get_post_thumbnail_id())->post_excerpt){
      $caption_pic = '<div class="caption">'.get_post(get_post_thumbnail_id($post_id->ID))->post_excerpt.'</div>';
    }else{
      $caption_pic = '';
    }
	  
	$vadf = rand(10,100);  
	  
	  
	$html = '<style>#vap'.$post_id.$vadf.' { font-size:100%; } #vap'.$post_id.$vadf.'.vjs-default-skin { color: #CCCCCC; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-play-progress, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-volume-level { background-color: #0C70B4; }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-control-bar, #vap'.$post_id.$vadf.'.vjs-default-skin .vjs-big-play-button { background: rgba(0,0,0,0.7); }#vap'.$post_id.$vadf.'.vjs-default-skin .vjs-slider { background: rgba(0,0,0,0.2333333333333333) } </style>
	
<div style="max-width:640px;width:100%; margin:0 auto;">
	<div class="video-wrapper " style="padding-bottom:56.25%;">
		<video id="vap'.$post_id.$vadf.'" class="video-js vjs-default-skin vjs-big-play-centered" controls preload width="640" height="360" poster="'.$vid_ima.'" data-setup=\'{}\'><source src="'.$vid_url.'" type=\'video/mp4\' /></video>
	</div>
</div>RCN4';

	$html .= "<script>jQuery(document).ready(function(){
		var vapvid1 = videojs('vap".$post_id.$vadf."');vapvid1.ads();
		vapvid1.vast({
			url: 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNRADIO/VIDEO/RCNRADIO_Video_Preroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1&url=[referrer_url]&description_url=[description_url]&correlator=[timestamp]',
			skip: 5,
			posturl: '',
			midurl: '',
			midoffset: 10,
			iscompanion: '1',
			compdiv: '',
			topadw: 'none',
			topadh: 'none',
			bopadw: 'none',
			bopadh: 'none',
			lopadw: 'none',
			lopadh: 'none',
			ropadw: 'none',
			ropadh: 'none',
			wopadw: 'none',
			wopadh: 'none',
			wopadw1: 'none',
			wopadh1: 'none',
			wopadw2: 'none',
			wopadh2: 'none',
			palyerid: ".$post_id.$vadf."}); });
</script>";

	$html .= '<script type="text/javascript">jQuery(document).ready(function(){ var vapvid6 = videojs(\'vap'.$post_id.$vadf.'\'); vapvid6.play(); });  </script>';	
	  
	  
	  

	  
	  
	  
	  
    /*$html = '<div id="jwplayer-'.$post_id.'" class="llamado3"></div>'.$caption_pic;
    $html .= "<script type='text/javascript'>
      jwplayer('jwplayer-".$post_id."').setup({
              primary: 'flash',
              file: '".$vid_url."',
              image:'".$vid_ima."',
              autostart: false,
              width: '100%',
              aspectratio: '16:9',
              advertising: {
                    client: 'googima',
                    tag:'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/62207337/LAMEGA/LAMEGA_video_player/lamega_video_preroll&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1'
              }     

      }); 
      </script>";*/
	  
	  
    return $html;
  }
  remove_shortcode('audio');
  add_shortcode('audio', 'lamega_wp_audio_shortcode' );
  remove_shortcode('video');
  //add_shortcode('video', 'lamega_wp_audio_shortcode' );
  add_shortcode( 'video', 'lamega_wp_video_shortcode' );
}
add_action( 'wp_loaded', 'overwrite_shortcode' );

?>