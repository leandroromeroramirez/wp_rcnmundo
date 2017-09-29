<?php
if ( ! defined( 'WPINC' ) ) {
	die;
}

class Vap_Meta_Box {
	protected $plugin_slug;
	protected static $instance = null;
	public static function vapmeta_get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new self;
		}

		return self::$instance;
	}

	public function __construct() {

		//$countdownrocket1 = CountdownRocket::crr_get_instance();
		$this->plugin_slug = 'vap';
		add_action( 'add_meta_boxes', array( $this, 'add_videoadplugin_meta_box' ) );
		add_action( 'save_post', array( $this, 'save_videoadplugin_details' ) );
		if($_GET['post_type'] == 'vap' && $_GET['page'] != 'vap_settings') {
			add_action( 'admin_notices', array( $this, 'show_autorespondercodevap') );
		}

	}
	public function add_videoadplugin_meta_box() {

		add_meta_box(
			'vap_videoadplugin_details',
			__( 'MaximaPlayer - Video Ads Options', 'crr' ),
			array( $this, 'display_videoadplugin_meta_box' ),
			'vap',
			'normal',
			'default'
		);

	}

	
	public function show_autorespondercodevap(){
		remove_meta_box( 'mymetabox_revslider_0', 'vap', 'normal' );
		?>
        <div style="margin: 10px 20px 0 2px;">
        <div style="max-width:100%;float:left;width:100%;" id="settingarrowcursor">
	 <div class="postbox-container" id="postbox-container-1" style="width:100%;">
		<div class="meta-box-sortables ui-sortable" id="normal-sortables">
        	<div class="postbox" id="dashboard_right_now">
				<div title="Click to toggle" class="handlediv handlediv1">
                <br>
                </div>
                <div title="Click to toggle" class="handlediv handlediv2">
                <br>
                </div>
                <h3 class="hndle ui-sortable-handle" style="font-size:14px;padding:8px 12px;margin:0px;">
                	<span>Join Our mailing List</span>
                </h3>
				<div class="inside handledivmaint">
					<div class="main">
                    	<form style="" method="post" action="https://app.getresponse.com/add_contact_webform.html?u=Bi3">
						<h2 style="font-size:16px;">Join our mailing list for tips, tricks, and WordPress secrets.</h2>
						<p><i>Sign up today and receive a free copy of the e-book <b>10 Google SEO Tips You Should Know to Higher Rankings and Traffic.</b></i></p>
						<p style="display:inline-block;"><input type="email" style="font-size:15px;height:auto;padding:8px !important;background-image:none !important; background:none;margin:0px !important;border:2px solid #FFC300;border-radius: 0px 0px 0px 0px;-webkit-border-radius: 0px; -moz-border-radius: 0px;color:#000000;text-align:left;font-style:normal;background-color:#FFFFFF !important;" class="input-block-level" required="" placeholder="Enter A Valid Email Here..." name="email" id="email">
                        <div style="display:none;"><input value="10831102" name="webform_id" type="hidden"></div>
							<div class="form-group" style="margin-bottom:5px;display:inline-block;">
<div class="clearfix break"></div>
<input type="submit" class="btn" id="mc-embedded-subscribe" name="subscribe" value="Subscribe" style="background-image:none !important;background-color:#ed8702;color:#ffffff;padding:10px 20px;border:none;">
</div>
                            </p>
						</form>
					</div>
				</div>
			</div>
        </div>	
   </div>
</div>
</div>
        <?php
	}
	
	/**
	 * Displays the meta box for displaying the 'Flowplayer Video'
	 *
	 * @since      1.0.0
	 */
	
	public function display_videoadplugin_meta_box( $post ) {

		wp_nonce_field( plugin_basename( __FILE__ ), 'vap-nonce' );
		$vap_stored_meta = get_post_meta( $post->ID );
		$baohtmltext 	 = get_post_meta( $post->ID,'vap-baohtmltext',true );
		$baostarttime 	 = get_post_meta( $post->ID,'vap-baostarttime',true );
		$baoendtime 	 = get_post_meta( $post->ID,'vap-baoendtime',true );
		$baoposition 	 = get_post_meta( $post->ID,'vap-baoposition',true );
		$baoverlaywidth  = get_post_meta( $post->ID,'vap-baoverlaywidth',true );
		
		echo '[videoadplayer id="' . get_the_ID() . '"]<p>Copy this shortcode to a post, page or widget to show the player.</p>';
		?>
    <div class="container-fluid menu-hidden sidebar-hidden-phone fluid menu-left" style="padding-left:0px;padding-right:0px;">
		<div id="content">
        	<div class="innerLR" style="padding-left:0px;padding-right:0px;">
		<!-- // Tab START -->
        		<div class="relativeWrap" data-toggle="source-code">
		<div class="widget widget-tabs widget-tabs-double widget-tabs-vertical row-fluid row-merge widget-tabs-gray">
		
			<!-- Tabs Heading -->
			<div class="widget-head spann3">
				<ul>
					<li class="active"><a href="#tab1-1" class="glyphicons user" data-toggle="tab"><i></i><span class="strong">Video/Audio URL</span></a></li>
					<li><a href="#tab2-1" class="glyphicons calculator" data-toggle="tab"><i></i><span class="strong">Video Options</span></a></li>
					<li><a href="#tab3-1" class="glyphicons credit_card" data-toggle="tab"><i></i><span class="strong">Design Options</span></a></li>
					<li><a href="#tab4-1" class="glyphicons circle_ok" data-toggle="tab"><i></i><span class="strong">Ad Options</span></a></li>
                    <li><a href="#tab5-1" class="glyphicons magic" data-toggle="tab"><i></i><span class="strong">Advanced Options</span></a></li>
				</ul>
			</div>
			<!-- // Tabs Heading END -->
			
			<div class="widget-body span9">
				<div class="tab-content">
				
					<!-- Tab content -->
					<div class="tab-pane active" id="tab1-1">
                    	 <div class="skin-square" style="border-bottom: 2px solid #000;padding-bottom: 15px;">	
							<label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap_urltype" value="video_url" <?php if($vap_stored_meta['vap_urltype'][0] == 'video_url' || $vap_stored_meta['vap_urltype'][0] == '') { echo 'checked="checked"'; }?>> Video </label><label style="display: inline-block;font-size: 18px;font-weight: bold;"><input type="radio" name="vap_urltype" value="audio_url" <?php if($vap_stored_meta['vap_urltype'][0] == 'audio_url') { echo 'checked="checked"'; }?>> Audio </label>
                         </div>
                         <script>
						jQuery(document).ready(function(){
						  jQuery('.skin-square input').on('ifChanged ifChecked ifUnchecked', function(event){
              //alert(this.value + ' is ' + event.type.replace('if', '').toLowerCase());
							 if(this.value == 'video_url' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapvid1').style.display = '';
								document.getElementById('vapvid2').style.display = '';
								document.getElementById('vapvid3').style.display = '';
								document.getElementById('vapaud1').style.display = 'none';
							 }
							 if(this.value == 'audio_url' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapvid1').style.display = 'none';
								document.getElementById('vapvid2').style.display = 'none';
								document.getElementById('vapvid3').style.display = 'none';
								document.getElementById('vapaud1').style.display = '';
							 }
            			}).iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						});
						</script>
                        <br>
                        <?php if($vap_stored_meta['vap_urltype'][0] == 'video_url' || $vap_stored_meta['vap_urltype'][0] == '') { $videlementcss=''; $audelementcss = 'display:none;'; }
						if($vap_stored_meta['vap_urltype'][0] == 'audio_url') { $videlementcss='display:none;'; $audelementcss = ''; }?>
                        <div class="form-group" id="vapvid1" style=" <?php echo $videlementcss; ?>">
                        	<label for="vap-mp4url" class="control-label span3">MP4 URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-mp4url" id="vap-mp4url" value="<?php echo $vap_stored_meta['vap-mp4url'][0]; ?>">
                                <span class="help-block">Enter MP4 URL here.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapvid2" style=" <?php echo $videlementcss; ?>">
                        	<label for="vap-webmurl" class="control-label span3">WEBM URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-webmurl" id="vap-webmurl" value="<?php echo $vap_stored_meta['vap-webmurl'][0]; ?>">
                                <span class="help-block">Enter WEBM URL here.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapaud1" style=" <?php echo $audelementcss; ?>">
                        	<label for="vap-mp3url" class="control-label span3">MP3 URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-mp3url" id="vap-mp3url" value="<?php echo $vap_stored_meta['vap-mp3url'][0]; ?>">
                                <span class="help-block">Enter MP3 URL for audio here.</span>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label for="vap-oggurl" class="control-label span3">OGG URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-oggurl" id="vap-oggurl" value="<?php echo $vap_stored_meta['vap-oggurl'][0]; ?>">
                                <span class="help-block">Enter OGG URL here.</span>
                            </div>
                        </div>
                        <div class="form-group">
                        	<label for="vap-posterurl" class="control-label span3">Poster Image URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-posterurl" id="vap-posterurl" value="<?php echo $vap_stored_meta['vap-posterurl'][0]; ?>">
                                <span class="help-block">Enter poster image here.</span>
                            </div>
                        </div>	
                        <div class="form-group" id="vapvid3" style=" <?php echo $videlementcss; ?>">
                        	<label for="vap-steamingurl" class="control-label span3">Streaming Source URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-steamingurl" id="vap-steamingurl" value="<?php echo $vap_stored_meta['vap-steamingurl'][0]; ?>">
                                <span class="help-block">All four RTMP protocols are valid in the src (RTMP, RTMPT, RTMPE, and RTMPS). Enter like rtmp://your.streaming.provider.net/cfx/st/&mp4:path/to/video.mp4 .</span>
                            </div>
                        </div>
                        
					</div>
					<!-- // Tab content END -->
				
                    
					<!-- Tab content -->
					<div class="tab-pane" id="tab2-1">
						<div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-showcontrol" class="control-label span3">Hide Controls</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-showcontrol" name="vap-showcontrol" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-showcontrol'] ) ) checked( $vap_stored_meta['vap-showcontrol'][0], 'true' ); ?> />
                            </div>
                        
                        	<label for="vap-autoplay" class="control-label span3">Auto Play</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-autoplay" name="vap-autoplay" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-autoplay'] ) ) checked( $vap_stored_meta['vap-autoplay'][0], 'true' ); ?> />
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-preloadvid" class="control-label span3">Preload Video</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-preloadvid" name="vap-preloadvid" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-preloadvid'] ) ) checked( $vap_stored_meta['vap-preloadvid'][0], 'true' ); ?> />
                            </div>
                        
                        	<label for="vap-loopvid" class="control-label span3">Loop Video</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-loopvid" name="vap-loopvid" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-loopvid'] ) ) checked( $vap_stored_meta['vap-loopvid'][0], 'true' ); ?> />
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-htoggleplay" class="control-label span3">Hide Toggle Play</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-htoggleplay" name="vap-htoggleplay" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-htoggleplay'] ) ) checked( $vap_stored_meta['vap-htoggleplay'][0], 'true' ); ?> />
                            </div>
                        
                        	<label for="vap-hfullscreen" class="control-label span3">Hide Full Screen</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-hfullscreen" name="vap-hfullscreen" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-hfullscreen'] ) ) checked( $vap_stored_meta['vap-hfullscreen'][0], 'true' ); ?> />
                            </div>
                        </div>
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-htime" class="control-label span3">Hide Time</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-htime" name="vap-htime" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-htime'] ) ) checked( $vap_stored_meta['vap-htime'][0], 'true' ); ?> />
                            </div>
                        
                        	<label for="vap-hvolume" class="control-label span3">Hide Volume</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-hvolume" name="vap-hvolume" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-hvolume'] ) ) checked( $vap_stored_meta['vap-hvolume'][0], 'true' ); ?> />
                            </div>
                        </div>
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-hmutetoggle" class="control-label span3">Hide Mute Toggle</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-hmutetoggle" name="vap-hmutetoggle" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-hmutetoggle'] ) ) checked( $vap_stored_meta['vap-hmutetoggle'][0], 'true' ); ?> />
                            </div>
                            <label for="vap-hprogbar" class="control-label span3">Hide Progress Bar</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-hprogbar" name="vap-hprogbar" class="js-switch" value="true" <?php if ( isset ( $vap_stored_meta['vap-hprogbar'] ) ) checked( $vap_stored_meta['vap-hprogbar'][0], 'true' ); ?> />
                            </div>
                        </div> 	                     
                      <script>
					  jQuery(document).ready(function(){
						  var elems = Array.prototype.slice.call(document.querySelectorAll('.js-switch'));
							elems.forEach(function(html) {
							  var switchery = new Switchery(html,{ size: 'large' });
							});
						});
                      </script>
                      <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                      
                        	<label for="vap-vidaspectratio" class="control-label span3">Aspect Ratio</label>
                            <div class="span3">
                                <select id="vap-vidaspectratio" name="vap-vidaspectratio">
					<option value="169" <?php if ( isset ( $vap_stored_meta['vap-vidaspectratio'] ) ) selected( $vap_stored_meta['vap-videoalign'][0], '169' ); ?>>16 - 9 Ratio</option>
                    <option value="43" <?php if ( isset ( $vap_stored_meta['vap-vidaspectratio'] ) ) selected( $vap_stored_meta['vap-videoalign'][0], '43' ); ?>>4 : 3 Ratio</option>
								</select>
                                <span class="help-block">Select aspect ratio.</span>
                            </div>
                        
                        	<label for="vap-vidaudmaxwidth" class="control-label span3">Maximum Width</label>
                            <div class="span3">
                                <input type="text" class="form-control" name="vap-vidaudmaxwidth" id="vap-vidaudmaxwidth" value="<?php echo $vap_stored_meta['vap-vidaudmaxwidth'][0]; ?>">
                                <span class="help-block">Maximum Width of video/audio.</span>
                            </div>
                            <!--<label for="vap-vidaudwidth" class="control-label span3">Width</label>
                            <div class="span3">
                                <input type="text" class="form-control" name="vap-vidaudwidth" id="vap-vidaudwidth" value="<?php //echo $vap_stored_meta['vap-vidaudwidth'][0]; ?>">
                                <span class="help-block">Width of video/audio.</span>
                            </div>
                        
                        	<label for="vap-vidaudheight" class="control-label span3">Height</label>
                            <div class="span3">
                                <input type="text" class="form-control" name="vap-vidaudheight" id="vap-vidaudheight" value="<?php //echo $vap_stored_meta['vap-vidaudheight'][0]; ?>">
                                <span class="help-block">Height of video/audio.</span>
                            </div>-->
                        </div>
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	
                            <label for="vap-videoalign" class="control-label span3">Alignment</label>
                            <div class="span3">
                                <select id="vap-videoalign" name="vap-videoalign">
					<option value="center" <?php if ( isset ( $vap_stored_meta['vap-videoalign'] ) ) selected( $vap_stored_meta['vap-videoalign'][0], 'center' ); ?>>Center</option>
                    <option value="left" <?php if ( isset ( $vap_stored_meta['vap-videoalign'] ) ) selected( $vap_stored_meta['vap-videoalign'][0], 'left' ); ?>>Left</option>
								</select>
                            </div>
                        </div> 
                        
					</div>
					<!-- // Tab content END -->
					
					<!-- Tab content -->
					<div class="tab-pane" id="tab3-1">
						<div class="form-group" style="overflow:hidden;margin-bottom:35px;display:none !important;">
                        	<label for="vap-playbtnpos" class="control-label span4">Play Button Position</label>
                            <div class="span8">
                                <select id="vap-playbtnpos" name="vap-playbtnpos">
					<option value="topleft" <?php if ( isset ( $vap_stored_meta['vap-playbtnpos'] ) ) selected( $vap_stored_meta['vap-playbtnpos'][0], 'topleft' ); ?>>Top Left</option>
                    <option value="center" <?php if ( isset ( $vap_stored_meta['vap-playbtnpos'] ) ) selected( $vap_stored_meta['vap-playbtnpos'][0], 'center' ); ?>>Center</option>
								</select>
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-controlsize" class="control-label span4">Control Size(%)</label>
                            <div class="span8">
                                <input type="text" class="form-control" id="vap-controlsize" name="vap-controlsize" value="<?php echo $vap_stored_meta['vap-controlsize'][0]; ?>"/>
                                <span class="help-block">Best between 50 to 200. Leave empty for default.</span>
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-controlcolor" class="control-label span3">Controls Color</label>
                            <div class="span3">
                                <input id="vap-controlcolor" name="vap-controlcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-controlcolor'][0] == '') { echo 'cccccc'; } else { echo $vap_stored_meta['vap-controlcolor'][0]; } ?>" class="color">
                            </div>
                            <label for="vap-controlbarcolor" class="control-label span3">ProgressBar Color</label>
                            <div class="span3">
                                <input id="vap-controlbarcolor" name="vap-controlbarcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-controlbarcolor'][0] == '') { echo '66a8cc'; } else { echo $vap_stored_meta['vap-controlbarcolor'][0]; } ?>" class="color">
                            </div>
                        </div> 
                         <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-pbarcolor" class="control-label span3">Controlbar Color</label>
                            <div class="span3">
                                <input id="vap-pbarcolor" name="vap-pbarcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-pbarcolor'][0] == '') { echo '000000'; } else { echo $vap_stored_meta['vap-pbarcolor'][0]; } ?>" class="color">
                            </div>
                            <label for="vap-skins" class="control-label span3">Skins</label>
                            <div class="span3">
                                 <select id="vap-skins" name="vap-skins">
					<!--<option value="skin1" <?php //if ( isset ( $vap_stored_meta['vap-skins'] ) ) selected( $vap_stored_meta['vap-skins'][0], 'skin1' ); ?>>Video Ad Player</option>-->
                    <option value="default" <?php if ( isset ( $vap_stored_meta['vap-skins'] ) ) selected( $vap_stored_meta['vap-skins'][0], 'default' ); ?>>Default</option>                    
                    <option value="skin2" <?php if ( isset ( $vap_stored_meta['vap-skins'] ) ) selected( $vap_stored_meta['vap-skins'][0], 'skin2' ); ?>>Clean Skin</option>
                    <!--<option value="vimess" <?php //if ( isset ( $vap_stored_meta['vap-skins'] ) ) selected( $vap_stored_meta['vap-skins'][0], 'vimess' ); ?>>Vimess Skin</option>-->
								</select>
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-shwidth" class="control-label span3">Shadow Width (Around Video)</label>
                            <div class="span3">
                               <input type="text" class="form-control" id="vap-shwidth" name="vap-shwidth" value="<?php echo $vap_stored_meta['vap-shwidth'][0]; ?>"/>
                            </div>
                            <label for="vap-shcolor" class="control-label span3">Shadow Color (Around Video)</label>
                            <div class="span3">
                                  <input id="vap-shcolor" name="vap-shcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-shcolor'][0] == '') { echo '000000'; } else { echo $vap_stored_meta['vap-shcolor'][0]; } ?>" class="color">
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-bdwidth" class="control-label span3">Border Width (Around Video)</label>
                            <div class="span3">
                               <input type="text" class="form-control" id="vap-bdwidth" name="vap-bdwidth" value="<?php echo $vap_stored_meta['vap-bdwidth'][0]; ?>"/>
                            </div>
                            <label for="vap-bdcolor" class="control-label span3">Border Color (Around Video)</label>
                            <div class="span3">
                                  <input id="vap-bdcolor" name="vap-bdcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-bdcolor'][0] == '') { echo '000000'; } else { echo $vap_stored_meta['vap-bdcolor'][0]; } ?>" class="color">
                            </div>
                        </div> 
                        <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-bdstyle" class="control-label span3">Border Style</label>
                            <div class="span3">
                               <select id="vap-bdstyle" name="vap-bdstyle">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'none' ); ?>>None</option>
                    <option value="dotted" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'dotted' ); ?>>Dotted</option>                    
                    <option value="dashed" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'dashed' ); ?>>Dashed</option>
                    <option value="solid" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'solid' ); ?>>Solid</option>
                    <option value="double" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'double' ); ?>>Double</option>                    
                    <option value="groove" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'groove' ); ?>>Groove</option>
                    <option value="ridge" <?php if ( isset ( $vap_stored_meta['vap-bdstyle'] ) ) selected( $vap_stored_meta['vap-bdstyle'][0], 'ridge' ); ?>>Ridge</option>
								</select>
                            </div>
                        </div>
					</div>
					<!-- // Tab content END -->
					
					<!-- Tab content -->
					<div class="tab-pane" id="tab4-1">
						
                         <div class="skin-square1" style="border-bottom: 2px solid #000;padding-bottom: 15px;">	
							<label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap_adtype" value="noads" <?php if($vap_stored_meta['vap_adtype'][0] == 'noads' || $vap_stored_meta['vap_adtype'][0] == '') { echo 'checked="checked"'; }?>> No Ads </label><label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap_adtype" value="vast" <?php if($vap_stored_meta['vap_adtype'][0] == 'vast') { echo 'checked="checked"'; }?>> VAST 2.0 </label><label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap_adtype" value="vpaid" <?php if($vap_stored_meta['vap_adtype'][0] == 'vpaid') { echo 'checked="checked"'; }?>> VPAID/VAST 3.0</label><label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap_adtype" value="googleima" <?php if($vap_stored_meta['vap_adtype'][0] == 'googleima') { echo 'checked="checked"'; }?>> Google IMA </label><label style="display: inline-block;font-size: 15px;font-weight: bold;"><input type="radio" name="vap_adtype" value="btoads" <?php if($vap_stored_meta['vap_adtype'][0] == 'btoads') { echo 'checked="checked"'; }?>> HTML Overlay Ads </label>
                         </div>
                         <script>
						jQuery(document).ready(function(){
						  jQuery('.skin-square1 input').on('ifChanged ifChecked ifUnchecked', function(event){
              //alert(this.value + ' is ' + event.type.replace('if', '').toLowerCase());
							 if(this.value == 'vast' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad1').style.display = '';
								document.getElementById('vapad2').style.display = '';
								document.getElementById('vapad4').style.display = '';
								document.getElementById('vapad7').style.display = '';
								document.getElementById('vapad8').style.display = '';
								document.getElementById('vapad9').style.display = '';
								document.getElementById('vapad10').style.display = '';
								document.getElementById('vapad11').style.display = '';
								document.getElementById('vapad12').style.display = '';
								document.getElementById('vapad13').style.display = '';
								document.getElementById('vapad14').style.display = 'none';
								/*document.getElementById('vapad5').style.display = '';
								document.getElementById('vapad6').style.display = '';*/
								document.getElementById('vapad3').style.display = 'none';
								document.getElementById('accordion').style.display = 'none';
								document.getElementById('btnAdd').style.display = 'none';
								
								document.getElementById('skiphidetab').style.display = '';
								if(document.getElementById("realskipadbtn").checked==true){
									document.getElementById('vapad2').style.display = 'none';
								}
								if(document.getElementById("realendiscomp").checked==false){
									document.getElementById('vapad8').style.display = 'none';
									document.getElementById('vapad9').style.display = 'none';
									document.getElementById('vapad10').style.display = 'none';
									document.getElementById('vapad11').style.display = 'none';
									document.getElementById('vapad12').style.display = 'none';
									document.getElementById('vapad13').style.display = 'none';
								}
							 }
							 if(this.value == 'googleima' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad1').style.display = 'none';
								document.getElementById('vapad2').style.display = 'none';
								document.getElementById('vapad4').style.display = 'none';
								document.getElementById('vapad7').style.display = 'none';
								document.getElementById('vapad8').style.display = 'none';
								document.getElementById('vapad9').style.display = 'none';
								document.getElementById('vapad10').style.display = 'none';
								document.getElementById('vapad11').style.display = 'none';
								document.getElementById('vapad12').style.display = 'none';
								document.getElementById('vapad13').style.display = 'none';
								document.getElementById('vapad14').style.display = 'none';
								/*document.getElementById('vapad5').style.display = 'none';
								document.getElementById('vapad6').style.display = 'none';*/
								document.getElementById('vapad3').style.display = '';
								document.getElementById('accordion').style.display = 'none';
								document.getElementById('btnAdd').style.display = 'none';
								document.getElementById('skiphidetab').style.display = 'none';
							 }
							 if(this.value == 'noads' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad1').style.display = 'none';
								document.getElementById('vapad2').style.display = 'none';
								document.getElementById('vapad4').style.display = 'none';
								document.getElementById('vapad7').style.display = 'none';
								document.getElementById('vapad8').style.display = 'none';
								document.getElementById('vapad9').style.display = 'none';
								document.getElementById('vapad10').style.display = 'none';
								document.getElementById('vapad11').style.display = 'none';
								document.getElementById('vapad12').style.display = 'none';
								document.getElementById('vapad13').style.display = 'none';
								document.getElementById('vapad14').style.display = 'none';
								/*document.getElementById('vapad5').style.display = 'none';
								document.getElementById('vapad6').style.display = 'none';*/
								document.getElementById('vapad3').style.display = 'none';
								document.getElementById('accordion').style.display = 'none';
								document.getElementById('btnAdd').style.display = 'none';
								document.getElementById('skiphidetab').style.display = 'none';
							 }
							 if(this.value == 'btoads' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad1').style.display = 'none';
								document.getElementById('vapad2').style.display = 'none';
								document.getElementById('vapad4').style.display = 'none';
								document.getElementById('vapad7').style.display = 'none';
								document.getElementById('vapad8').style.display = 'none';
								document.getElementById('vapad9').style.display = 'none';
								document.getElementById('vapad10').style.display = 'none';
								document.getElementById('vapad11').style.display = 'none';
								document.getElementById('vapad12').style.display = 'none';
								document.getElementById('vapad13').style.display = 'none';
								document.getElementById('vapad14').style.display = 'none';
								/*document.getElementById('vapad5').style.display = 'none';
								document.getElementById('vapad6').style.display = 'none';*/
								document.getElementById('vapad3').style.display = 'none';
								document.getElementById('accordion').style.display = '';
								document.getElementById('btnAdd').style.display = '';
								document.getElementById('skiphidetab').style.display = 'none';
							 }
							 if(this.value == 'vpaid' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad1').style.display = 'none';
								document.getElementById('vapad2').style.display = 'none';
								document.getElementById('vapad4').style.display = 'none';
								document.getElementById('vapad7').style.display = 'none';
								document.getElementById('vapad8').style.display = 'none';
								document.getElementById('vapad9').style.display = 'none';
								document.getElementById('vapad10').style.display = 'none';
								document.getElementById('vapad11').style.display = 'none';
								document.getElementById('vapad12').style.display = 'none';
								document.getElementById('vapad13').style.display = 'none';
								document.getElementById('vapad14').style.display = '';
								/*document.getElementById('vapad5').style.display = 'none';
								document.getElementById('vapad6').style.display = 'none';*/
								document.getElementById('vapad3').style.display = 'none';
								document.getElementById('accordion').style.display = 'none';
								document.getElementById('btnAdd').style.display = 'none';
								document.getElementById('skiphidetab').style.display = 'none';
							 }
            			}).iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						  jQuery('.skiphidebtnc').on('ifChanged ifChecked ifUnchecked', function(event){
              //alert(this.value + ' is ' + event.type.replace('if', '').toLowerCase());
							 if(this.value == 'true' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad2').style.display = 'none';
							 }
							 else
							 {
								 document.getElementById('vapad2').style.display = '';
							 }
            			}).iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						  
						  jQuery('.endiscompbtnc').on('ifChanged ifChecked ifUnchecked', function(event){
              //alert(this.value + ' is ' + event.type.replace('if', '').toLowerCase());
							 if(this.value == 'true' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('vapad8').style.display = '';
								document.getElementById('vapad9').style.display = '';
								document.getElementById('vapad10').style.display = '';
								document.getElementById('vapad11').style.display = '';
								document.getElementById('vapad12').style.display = '';
								document.getElementById('vapad13').style.display = '';
							 }
							 else
							 {
								 document.getElementById('vapad8').style.display = 'none';
								 document.getElementById('vapad9').style.display = 'none';
								 document.getElementById('vapad10').style.display = 'none';
								 document.getElementById('vapad11').style.display = 'none';
								 document.getElementById('vapad12').style.display = 'none';
								 document.getElementById('vapad13').style.display = 'none';
							 }
            			}).iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						  
						  
						  
						});
						</script>
                        <br>
                        <?php if($vap_stored_meta['vap_adtype'][0] == 'vast') { $otherservercss=''; $googleimacss = 'display:none;'; $overlayads ='display:none;'; $vpaidcss ='display:none;'; }
						if($vap_stored_meta['vap_adtype'][0] == 'googleima') { $otherservercss='display:none;'; $googleimacss = ''; $overlayads ='display:none;'; $vpaidcss ='display:none;'; }
						if($vap_stored_meta['vap_adtype'][0] == 'noads' || $vap_stored_meta['vap_adtype'][0] == '') { $otherservercss='display:none;'; $googleimacss = 'display:none;'; $overlayads ='display:none;'; $vpaidcss ='display:none;'; }
						if($vap_stored_meta['vap_adtype'][0] == 'btoads') { $otherservercss='display:none;'; $googleimacss = 'display:none;'; $overlayads =''; $vpaidcss ='display:none;'; }
						if($vap_stored_meta['vap_adtype'][0] == 'vpaid') { $otherservercss='display:none;'; $googleimacss = 'display:none;'; $overlayads ='display:none;';  }
                        if($vap_stored_meta['vap-hideskipbtn'][0] == 'true' && $otherservercss == '') { $skipbutnhide='display:none;';}
                        if($vap_stored_meta['vap-endiscomp'][0] != 'true') { $endiscompad='display:none;';} ?>
                        <label style="display: inline-block;font-size: 16px;font-weight: bold;<?php echo $otherservercss;?>" id="skiphidetab"><input type="checkbox" name="vap-hideskipbtn" class="skiphidebtnc" value="true" id="realskipadbtn" <?php if ( isset ( $vap_stored_meta['vap-hideskipbtn'] ) ) checked( $vap_stored_meta['vap-hideskipbtn'][0], 'true' ); ?>> Hide Skip Button <br><br><br></label>
                        <div class="form-group" id="vapad2" style="overflow:hidden;<?php echo $otherservercss; echo $skipbutnhide; ?>">
                        	
                            <label for="vap-skiptime" class="control-label span3" id="vap-skiptimel">Skip Time (Secs)</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-skiptime" id="vap-skiptime" value="<?php echo $vap_stored_meta['vap-skiptime'][0]; ?>">
                                <span class="help-block">How long until the user can skip the ad. Defaults to 5, and a negative number will disable it.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapad1" style="overflow:hidden;<?php echo $otherservercss; ?>">
                        	<label for="vap-vasttagurl" class="control-label span3">Preroll VAST Tag URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-vasttagurl" id="vap-vasttagurl" value="<?php echo $vap_stored_meta['vap-vasttagurl'][0]; ?>">
                                <span class="help-block">Enter vast xml url that will play as preroll.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapad4" style="overflow:hidden;<?php echo $otherservercss; ?>">
                        	<label for="vap-postvasttagurl" class="control-label span3">Postroll VAST Tag URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-postvasttagurl" id="vap-postvasttagurl" value="<?php echo $vap_stored_meta['vap-postvasttagurl'][0]; ?>">
                                <span class="help-block">Enter vast xml url that will play as postroll.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapad7" style="overflow:hidden;<?php echo $otherservercss; ?>">
                        	<label for="vap-postvasttagurl" class="control-label span3">Enable/Disable comapnion Ads</label>
                            <div class="span9">
                                <label style="display: inline-block;font-size: 16px;font-weight: bold;" id="compentab"><input type="checkbox" name="vap-endiscomp" class="endiscompbtnc" value="true" id="realendiscomp" <?php if ( isset ( $vap_stored_meta['vap-endiscomp'] ) ) checked( $vap_stored_meta['vap-endiscomp'][0], 'true' ); ?>> Enable Companion Ads <br><br><br></label>
                                <span class="help-block">If vast tags have companion ads, this option will enable that.</span>
                            </div>
                        </div>
                        
                        <div class="form-group" id="vapad9" style="overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>">
                            <label for="vap-radsize" class="control-label span3">Right Ad Size</label>
                            <div class="span3">
                                 <select id="vap-radsize" name="vap-radsize">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-radsize'] ) ) selected( $vap_stored_meta['vap-radsize'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                            <label for="vap-tadsize" class="control-label span3">Top Ad Size</label>
                            <div class="span3">
                                 <select id="vap-tadsize" name="vap-tadsize">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-tadsize'] ) ) selected( $vap_stored_meta['vap-tadsize'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                        </div>
                        <div class="form-group" id="vapad10" style="overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>">
                            <label for="vap-ladsize" class="control-label span3">Left Ad Size</label>
                            <div class="span3">
                                 <select id="vap-ladsize" name="vap-ladsize">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-ladsize'] ) ) selected( $vap_stored_meta['vap-ladsize'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                         <label for="vap-badsize" class="control-label span3">Bottom Ad Size</label>
                            <div class="span3">
                                 <select id="vap-badsize" name="vap-badsize">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-badsize'] ) ) selected( $vap_stored_meta['vap-badsize'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                        </div>
                        
                        <strong id="vapad13" style="font-size:15px;font-weight:bold;overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>"><u><br>Widget Ads Configuration: <br>
                        <br></u></strong>
                       
                        
                        <div class="form-group" id="vapad11" style="overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>">
                        
                            <label for="vap-wadsize" class="control-label span3">Widget Ad Size</label>
                            <div class="span3">
                                 <select id="vap-wadsize" name="vap-wadsize">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-wadsize'] ) ) selected( $vap_stored_meta['vap-wadsize'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                            <label for="vap-wadsize2" class="control-label span3">Widget2 Ad Size</label>
                            <div class="span3">
                                 <select id="vap-wadsize2" name="vap-wadsize2">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-wadsize2'] ) ) selected( $vap_stored_meta['vap-wadsize2'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                        </div>
                        
                         <div class="form-group" id="vapad12" style="overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>">
                            <label for="vap-wadsize3" class="control-label span3">Widget3 Ad Size</label>
                            <div class="span3">
                                 <select id="vap-wadsize3" name="vap-wadsize3">
					<option value="none" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], 'none' ); ?>>None</option>
                    <option value="728-90" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '728-90' ); ?>>728 * 90</option>
                    <option value="300-250" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '300-250' ); ?>>300 * 250</option>
                    <option value="468-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '468-60' ); ?>>468 * 60</option>
                    <option value="320-50" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '320-50' ); ?>>320 * 50</option>
                    <option value="300-60" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '300-60' ); ?>>300 * 60</option>
                    <option value="300-100" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '300-100' ); ?>>300 * 100</option>
                    <option value="300-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '300-600' ); ?>>300 * 600</option>
                    <option value="180-150" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '180-150' ); ?>>180 * 150</option>
                    <option value="160-600" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '160-600' ); ?>>160 * 600</option>
                    <option value="88-31" <?php if ( isset ( $vap_stored_meta['vap-wadsize3'] ) ) selected( $vap_stored_meta['vap-wadsize3'][0], '88-31' ); ?>>88 * 31</option>
								</select>
                            </div>
                        </div>
                        <div class="form-group" id="vapad8" style="overflow:hidden;<?php echo $otherservercss; echo $endiscompad; ?>">
                        	<label for="vap-compdivid" class="control-label span3">Companion Ad container div ID (Optional)</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-compdivid" id="vap-compdivid" value="<?php echo $vap_stored_meta['vap-compdivid'][0]; ?>">
                                <span class="help-block">This option is optional. If you enter id of div tag here. Companion ad will show in that div otherwise companion ad will show on right side and above video.</span>
                            </div>
                        </div>
                        <!--<div class="form-group" id="vapad5" style=" <?php //echo $otherservercss; ?>">
                        	<label for="vap-midvasttagurl" class="control-label span3">Midroll VAST Tag URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-midvasttagurl" id="vap-midvasttagurl" value="<?php //echo $vap_stored_meta['vap-midvasttagurl'][0]; ?>">
                                <span class="help-block">Enter vast xml url that will play as midroll.</span>
                            </div>
                        </div>
                        <div class="form-group" id="vapad6" style=" <?php //echo $otherservercss; ?>">
                        	<label for="vap-midoffset" class="control-label span3">Midroll Offset (Secs)</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-midoffset" id="vap-midoffset" value="<?php //echo $vap_stored_meta['vap-midoffset'][0]; ?>">
                                <span class="help-block">This is after how many seconds midroll ad will played.</span>
                            </div>
                        </div>-->
                        <div class="form-group" id="vapad14" style="overflow:hidden; <?php echo $vpaidcss; ?>">
                        	<label for="vap-vpaidtagurl" class="control-label span3">PreRoll VPAID/VAST 3.0 Tag URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-vpaidtagurl" id="vap-vpaidtagurl" value="<?php echo $vap_stored_meta['vap-vpaidtagurl'][0]; ?>">
                                
                            </div>
                        </div>
                        
                        
                        <div class="form-group" id="vapad3" style="overflow:hidden; <?php echo $googleimacss; ?>">
                        	<label for="vap-imaadtagurl" class="control-label span3">Ad Tag URL</label>
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-imaadtagurl" id="vap-imaadtagurl" value="<?php echo $vap_stored_meta['vap-imaadtagurl'][0]; ?>">
                                <span class="help-block">Ad tag url from your adsense account.<br> All required parameters like ad_type, client etc supported and optional parameters like videad_start_delay, cust_age etc are not supported. Parameters working here https://developers.google.com/interactive-media-ads/docs/sdks/html5/vastinspector will definitly work with MaximaPlayerVideoAds plugin also. Ad Rules are also supported.</span>
                            </div>
                        </div>
                        
                        <!-- // Overlay Ad START -->
              
					   <?php 
					 /*  $baoposition 	 = get_post_meta( $post->ID,'vap-baoposition',true );
					   $baohtmltext 	 = get_post_meta( $post->ID,'vap-baohtmltext',true );
					   $baostarttime 	 = get_post_meta( $post->ID,'vap-baostarttime',true );
					   $baoendtime 		 = get_post_meta( $post->ID,'vap-baoendtime',true );*/
					   ?>
                       <div id="accordion" style="overflow:hidden;<?php echo $overlayads;?>">
							<?php if ($baohtmltext == '') { ?>
                            <div class="group" style="overflow:hidden;">
                            <h3 class="collheading">Overlay Content<input id="btnDel" class="btnDels" type="button" value="Remove"></h3>
                            
                            <div class="colcontent" style="overflow:hidden;">   
                            	<div class="form-group" style="overflow:hidden;">
                                    <label for="vap-baohtmltext" class="control-label span3" style="overflow:hidden;">HTML Code/Shortcode</label>
                                    <div class="span9" style="overflow:hidden;">
                                    	<textarea rows="6" cols="100" style="width:100%;overflow:hidden;" name="vap-baohtmltext[]" id="vap-baohtmltext"><?php if ( isset ( $vap_stored_meta['vap-baohtmltext'] ) ) echo $vap_stored_meta['vap-baohtmltext'][0]; ?></textarea>
                                        <span class="help-block">Enter any HTML code here including iframe code from revive ad server that you want to overlay</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label for="vap-baostarttime" class="control-label span3">Overlay Start Time (Secs)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baostarttime[]" id="vap-baostarttime" value="<?php if ( isset ( $vap_stored_meta['vap-baostarttime'] ) ) echo $vap_stored_meta['vap-baostarttime'][0]; ?>">
                                        <span class="help-block">Overlay will start display at this time of video. If start time and end time leave empty then overlay will show when  video play and overlay hide when video pause/stop.</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label for="vap-baoendtime" class="control-label span3">Overlay End Time (Secs)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baoendtime[]" id="vap-baoendtime" value="<?php  if ( isset ( $vap_stored_meta['vap-baoendtime'] ) ) echo $vap_stored_meta['vap-baoendtime'][0]; ?>">
                                        <span class="help-block">Overlay will end display at this time of video. If start time and end time leave empty then overlay will show when  video play and overlay hide when video pause/stop.</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label for="vap-baoposition" class="control-label span3">Overlay Position</label>
                                    <div class="span9">
                                        <select id="vap-baoposition" name="vap-baoposition[]">
			<option value="bottom" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'bottom' ); ?>>Bottom Center</option>
            <option value="bottom-left" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'bottom-left' ); ?>>Bottom Left</option>
            <option value="bottom-right" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'bottom-right' ); ?>>Bottom Right</option>
            <option value="top" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'top' ); ?>>Top</option>
            <option value="top-left" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'top-left' ); ?>>Top Left</option>
            <option value="top-right" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'top-right' ); ?>>Top Right</option>
            <option value="left" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'left' ); ?>>Left</option>
            <option value="right" <?php if ( isset ( $vap_stored_meta['vap-baoposition'] ) ) selected( $vap_stored_meta['vap-baoposition'][0], 'right' ); ?>>Right</option>
										</select>
                                        
                                        <span class="help-block"></span>
                                    </div>
                                </div>     
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label span3" for="vap-baoverlaywidth">Overlay Width (%)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baoverlaywidth[]" id="vap-baoverlaywidth" value="<?php  if ( isset ( $vap_stored_meta['vap-baoverlaywidth'] ) ) echo $vap_stored_meta['vap-baoverlaywidth'][0]; ?>">
                                        <span class="help-block">Width of overlay in percentage. Default is 50</span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <?php  } else { 
                                 for ($x=0; $x<count($baoposition); $x++)
                      { ?>
                      <div class="group" style="overflow:hidden;">
                            <h3 class="collheading">Overlay Content<input id="btnDel" class="btnDels" type="button" value="Remove"></h3>
                            
                            <div class="colcontent" style="overflow:hidden;">   
                            	<div class="form-group" style="overflow:hidden;">
                                    <label for="vap-baohtmltext" class="control-label span3" style="overflow:hidden;">HTML Code/Shortcode</label>
                                    <div class="span9" style="overflow:hidden;">
                                    	<textarea rows="6" cols="100" style="width:100%;overflow:hidden;" name="vap-baohtmltext[]" id="vap-baohtmltext"><?php echo $baohtmltext[$x]; ?></textarea>
                                        <span class="help-block">Enter any HTML code here including iframe code from revive ad server that you want to overlay</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label span3" for="vap-baostarttime">Overlay Start Time (Secs)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baostarttime[]" id="vap-baostarttime" value="<?php echo $baostarttime[$x]; ?>">
                                        <span class="help-block">Overlay will start display at this time of video. If start time and end time leave empty then overlay will show when  video play and overlay hide when video pause/stop.</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label span3" for="vap-baoendtime">Overlay End Time (Secs)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baoendtime[]" id="vap-baoendtime" value="<?php echo $baoendtime[$x]; ?>">
                                        <span class="help-block">Overlay will start display at this time of video. If start time and end time leave empty then overlay will show when  video play and overlay hide when video pause/stop.</span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label span3" for="vap-baoposition">Overlay Position</label>
                                    <div class="span9">
                                        <select id="vap-baoposition" name="vap-baoposition[]">
			<option value="bottom" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'bottom' ); ?>>Bottom Center</option>
            <option value="bottom-left" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'bottom-left' ); ?>>Bottom Left</option>
            <option value="bottom-right" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'bottom-right' ); ?>>Bottom Right</option>
            <option value="top" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'top' ); ?>>Top</option>
            <option value="top-left" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'top-left' ); ?>>Top Left</option>
            <option value="top-right" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'top-right' ); ?>>Top Right</option>
            <option value="left" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'left' ); ?>>Left</option>
            <option value="right" <?php if ( isset ( $baoposition[$x] ) ) selected( $baoposition[$x], 'right' ); ?>>Right</option>
										</select>
                                        
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <div class="form-group" style="overflow:hidden;">
                                    <label class="control-label span3" for="vap-baoverlaywidth">Overlay Width (%)</label>
                                    <div class="span9">
                                        <input type="text" class="form-control" name="vap-baoverlaywidth[]" id="vap-baoverlaywidth" value="<?php if($baoverlaywidth[$x] == '') echo '50'; else echo $baoverlaywidth[$x]; ?>">
                                        <span class="help-block">Width of overlay in percentage. Default is 50</span>
                                    </div>
                                </div>     
                            </div>
                      </div>
                      <?php } }
					  
                      ?>
                      
                            </div>
                      <input id="btnAdd" type="button" class="addvideogvp button-primary" value="Add New Overlay" style="margin-top:10px;<?php echo $overlayads;?>">      
                        <!-- // Overlay Ad END -->
                        
                        
					</div>
					<!-- // Tab content END -->
                    
                    <!-- Tab content -->
                    
                    <script>
					  jQuery(document).ready(function(){
						  
							var changeCheckbox = document.querySelector('.js-enablevidschedule');
							if(changeCheckbox.checked == false){
							  	jQuery(".vap-schedule-fields").hide("slow");
							  }
							  else{
								  jQuery(".vap-schedule-fields").show("slow");
							  }
							changeCheckbox.onchange = function() {
							  if(changeCheckbox.checked == false){
							  	jQuery(".vap-schedule-fields").hide("slow");
							  }
							  else{
								  jQuery(".vap-schedule-fields").show("slow");
							  }
							};
							
							jQuery('#vap-scheduledate').datetimepicker({
							  dateFormat: "yy/mm/dd",
							  minDate: "+0m +0d",
							  timeFormat: "HH:mm:ss",
							  showMillisec: false,
							  showMicrosec: false
							});
							
						});
                      </script>
					<div class="tab-pane" id="tab5-1">
                    	<div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-enablevidschedule" class="control-label span5">Enable Video Scheduling</label>
                            <div class="span5">
                                <input type="checkbox" id="vap-enablevidschedule" name="vap-enablevidschedule" class="js-switch js-enablevidschedule" value="true" <?php if ( isset ( $vap_stored_meta['vap-enablevidschedule'] ) ) checked( $vap_stored_meta['vap-enablevidschedule'][0], 'true' ); ?> />
                               
                            </div>
                        </div> 
                        
                        <div class="form-group vap-schedule-fields" style="overflow:hidden;">
                        	<label for="vap-scheduledate" class="control-label span3">Select Date/Time</label>
                            
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-scheduledate" id="vap-scheduledate" value="<?php echo $vap_stored_meta['vap-scheduledate'][0]; ?>">
                                <span class="help-block">Select date/time to play video.</span>
                                
                            </div>
                        </div>
                        
                        <div class="form-group vap-schedule-fields" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-scheduletimezone" class="control-label span3">Select Time Zone</label>
                            
                            <div class="span9">
                                <select name="vap-scheduletimezone" id="vap-scheduletimezone">
								<option  value="-11" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-11' ); ?>>(GMT-11:00) Midway Island, Samoa</option>
                                <option  value="-10" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-10' ); ?>>(GMT-10:00) Hawaii-Aleutian</option>
                                <option  value="-10qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-10qh' ); ?>>(GMT-10:00) Hawaii</option>
                                <option  value="-9.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-9.5' ); ?>>(GMT-09:30) Marquesas Islands</option>
                                <option  value="-9" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-9' ); ?>>(GMT-09:00) Gambier Islands</option>
                                <option  value="-9qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-9qh' ); ?>>(GMT-09:00) Alaska</option>
                                <option  value="-8" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-8' ); ?>>(GMT-08:00) Tijuana, Baja California</option>
                                <option  value="-8qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-8qh' ); ?>>(GMT-08:00) Pitcairn Islands</option>
                                <option  value="-8qu" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-8qu' ); ?>>(GMT-08:00) Pacific Time (US & Canada)</option>
                                <option  value="-7" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-7' ); ?>>(GMT-07:00) Mountain Time (US & Canada)</option>
                                <option  value="-7qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-7qh' ); ?>>(GMT-07:00) Chihuahua, La Paz, Mazatlan</option>
                                <option  value="-7qa" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-7qa' ); ?>>(GMT-07:00) Arizona</option>
                                <option  value="-6" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-6' ); ?>>(GMT-06:00) Saskatchewan, Central America</option>
                                <option  value="-6qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-6qh' ); ?>>(GMT-06:00) Guadalajara, Mexico City, Monterrey</option>
                                <option  value="-6qe" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-6qe' ); ?>>(GMT-06:00) Easter Island</option>
                                <option  value="-6qc" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-6qc' ); ?>>(GMT-06:00) Central Time (US & Canada)</option>
                                <option  value="-5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-5' ); ?>>(GMT-05:00) Eastern Time (US & Canada)</option>
                                <option  value="-5qc" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-5qc' ); ?>>(GMT-05:00) Cuba</option>
                                <option  value="-5qb" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-5qb' ); ?>>(GMT-05:00) Bogota, Lima, Quito, Rio Branco</option>
                                <option  value="-4.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4.5' ); ?>>(GMT-04:30) Caracas</option>
                                <option  value="-4" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4' ); ?>>(GMT-04:00) Santiago</option>
                                <option  value="-4ql" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4ql' ); ?>>(GMT-04:00) La Paz</option>
                                <option  value="-4qf" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4qf' ); ?>>(GMT-04:00) Faukland Islands</option>
                                <option  value="-4qb" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4qb' ); ?>>(GMT-04:00) Brazil</option>
                                <option  value="-4qa" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4qa' ); ?>>(GMT-04:00) Atlantic Time (Goose Bay)</option>
                                <option  value="-4qt" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-4qt' ); ?>>(GMT-04:00) Atlantic Time (Canada)</option>
                                <option  value="-3.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3.5' ); ?>>(GMT-03:30) Newfoundland</option>
                                <option  value="-3" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3' ); ?>>(GMT-03:00) UTC-3</option>
                                <option  value="-3qm" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3qm' ); ?>>(GMT-03:00) Montevideo</option>
                                <option  value="-3qs" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3qs' ); ?>>(GMT-03:00) Miquelon, St. Pierre</option>
                                <option  value="-3qg" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3qg' ); ?>>(GMT-03:00) Greenland</option>
                                <option  value="-3qb" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3qb' ); ?>>(GMT-03:00) Buenos Aires</option>
                                <option  value="-3qr" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-3qr' ); ?>>(GMT-03:00) Brasilia</option>
                                <option  value="-2" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-2' ); ?>>(GMT-02:00) Mid-Atlantic</option>
                                <option  value="-1" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-1' ); ?>>(GMT-01:00) Cape Verde Is.</option>
                                <option  value="-1qa" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '-1qa' ); ?>>(GMT-01:00) Azores</option>
                                <option  value="0" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '0' ); ?>>(GMT) Greenwich Mean Time : Belfast</option>
                                <option  value="0qg" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '0qg' ); ?>>(GMT) Greenwich Mean Time : Dublin</option>
                                <option  value="0ql" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '0ql' ); ?>>(GMT) Greenwich Mean Time : Lisbon</option>
                                <option  value="0qm" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '0qm' ); ?>>(GMT) Greenwich Mean Time : London</option>
                                <option  value="0qr" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '0qr' ); ?>>(GMT) Monrovia, Reykjavik</option>
                                <option  value="1" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '1' ); ?>>(GMT+01:00) Amsterdam, Berlin, Bern, Rome, Stockholm, Vienna</option>
                                <option  value="1qe" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '1qe' ); ?>>(GMT+01:00) Belgrade, Bratislava, Budapest, Ljubljana, Prague</option>
                                <option  value="1qb" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '1qb' ); ?>>(GMT+01:00) Brussels, Copenhagen, Madrid, Paris</option>
                                <option  value="1qw" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '1qw' ); ?>>(GMT+01:00) West Central Africa</option>
                                <option  value="1qf" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '1qf' ); ?>>(GMT+01:00) Windhoek</option>
                                <option  value="2" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2' ); ?>>(GMT+02:00) Beirut</option>
                                <option  value="2qc" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qc' ); ?>>(GMT+02:00) Cairo</option>
                                <option  value="2qg" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qg' ); ?>>(GMT+02:00) Gaza</option>
                                <option  value="2qb" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qb' ); ?>>(GMT+02:00) Harare, Pretoria</option>
                                <option  value="2qj" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qj' ); ?>>(GMT+02:00) Jerusalem</option>
                                <option  value="2qm" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qm' ); ?>>(GMT+02:00) Minsk</option>
                                <option  value="2qs" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '2qs' ); ?>>(GMT+02:00) Syria</option>
                                <option  value="3" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '3' ); ?>>(GMT+03:00) Moscow, St. Petersburg, Volgograd</option>
                                <option  value="3qn" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '3qn' ); ?>>(GMT+03:00) Nairobi</option>
                                <option  value="3.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '3.5' ); ?>>(GMT+03:30) Tehran</option>
                                <option  value="4" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '4' ); ?>>(GMT+04:00) Abu Dhabi, Muscat</option>
                                <option  value="4qy" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '4qy' ); ?>>(GMT+04:00) Yerevan</option>
                                <option  value="4.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '4.5' ); ?>>(GMT+04:30) Kabul</option>
                                <option  value="5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '5' ); ?>>(GMT+05:00) Ekaterinburg</option>
                                <option  value="5qt" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '5qt' ); ?>>(GMT+05:00) Tashkent</option>
                                <option  value="5.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '5.5' ); ?>>(GMT+05:30) Chennai, Kolkata, Mumbai, New Delhi</option>
                                <option  value="5.75" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '5.75' ); ?>>(GMT+05:45) Kathmandu</option>
                                <option  value="6" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '6' ); ?>>(GMT+06:00) Astana, Dhaka</option>
                                <option  value="6qn" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '6qn' ); ?>>(GMT+06:00) Novosibirsk</option>
                                <option  value="6.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '6.5' ); ?>>(GMT+06:30) Yangon (Rangoon)</option>
                                <option  value="7" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '7' ); ?>>(GMT+07:00) Bangkok, Hanoi, Jakarta</option>
                                <option  value="7qk" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '7qk' ); ?>>(GMT+07:00) Krasnoyarsk</option>
                                <option  value="8" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '8' ); ?>>(GMT+08:00) Beijing, Chongqing, Hong Kong, Urumqi</option>
                                <option  value="8qi" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '8qi' ); ?>>(GMT+08:00) Irkutsk, Ulaan Bataar</option>
                                <option  value="8qp" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '8qp' ); ?>>(GMT+08:00) Perth</option>
                                <option  value="8.75" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '8.75' ); ?>>(GMT+08:45) Eucla</option>
                                <option  value="9" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '9' ); ?>>(GMT+09:00) Osaka, Sapporo, Tokyo</option>
                                <option  value="9qs" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '9qs' ); ?>>(GMT+09:00) Seoul</option>
                                <option  value="9qy" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '9qy' ); ?>>(GMT+09:00) Yakutsk</option>
                                <option  value="9.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '9.5' ); ?>>(GMT+09:30) Adelaide</option>
                                <option  value="9.5qd" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '9.5qd' ); ?>>(GMT+09:30) Darwin</option>
                                <option  value="10" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '10' ); ?>>(GMT+10:00) Brisbane</option>
                                <option  value="10qh" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '10qh' ); ?>>(GMT+10:00) Hobart</option>
                                <option  value="10qv" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '10qv' ); ?>>(GMT+10:00) Vladivostok</option>
                                <option  value="10.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '10.5' ); ?>>(GMT+10:30) Lord Howe Island</option>
                                <option  value="11" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '11' ); ?>>(GMT+11:00) Solomon Is., New Caledonia</option>
                                <option  value="11qm" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '11qm' ); ?>>(GMT+11:00) Magadan</option>
                                <option  value="11.5" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '11.5' ); ?>>(GMT+11:30) Norfolk Island</option>
                                <option  value="12" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '12' ); ?>>(GMT+12:00) Anadyr, Kamchatka</option>
                                <option  value="12qa" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '12qa' ); ?>>(GMT+12:00) Auckland, Wellington</option>
                                <option  value="12qf" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '12qf' ); ?>>(GMT+12:00) Fiji, Kamchatka, Marshall Is.</option>
                                <option  value="12.75" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '12.75' ); ?>>(GMT+12:45) Chatham Islands</option>
                                <option  value="13" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '13' ); ?>>(GMT+13:00) Nukualofa</option>
                                <option  value="14" <?php if ( isset ( $vap_stored_meta['vap-scheduletimezone'] ) ) selected( $vap_stored_meta['vap-scheduletimezone'][0], '14' ); ?>>(GMT+14:00) Kiritimati</option>
							</select>
                                
                            </div>
                        </div> 
                        
                        <div class="form-group vap-schedule-fields" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-schedtitletext" class="control-label span3">Schedule Title Text</label>
                            <div class="span3">
                               <input type="text" class="form-control" id="vap-schedtitletext" name="vap-schedtitletext" value="<?php echo $vap_stored_meta['vap-schedtitletext'][0]; ?>"/>
                            </div>
                            <label for="vap-schedtitlecolor" class="control-label span3">Schedule Title Text Color</label>
                            <div class="span3">
                                  <input id="vap-schedtitlecolor" name="vap-schedtitlecolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-schedtitlecolor'][0] == '') { echo 'FFFFFF'; } else { echo $vap_stored_meta['vap-schedtitlecolor'][0]; } ?>" class="color">
                            </div>
                        </div> 
          			<div class="form-group vap-schedule-fields" style="overflow:hidden;margin-bottom:35px;">
                            <label for="vap-schoverbgcolor" class="control-label span3">Schedule Overlay Color</label>
                            <div class="span3">
                                  <input id="vap-schoverbgcolor" name="vap-schoverbgcolor" type="text" style="width: 95%" value="<?php if($vap_stored_meta['vap-schoverbgcolor'][0] == '') { echo '000000'; } else { echo $vap_stored_meta['vap-schoverbgcolor'][0]; } ?>" class="color">
                            </div>
                            <label for="vap-schoverbgopacity" class="control-label span3">Schedule Overlay Opacity(0.01 to 1)</label>
                            <div class="span3">
                               <input type="text" class="form-control" id="vap-schoverbgopacity" name="vap-schoverbgopacity" value="<?php echo $vap_stored_meta['vap-schoverbgopacity'][0]; ?>"/>
                            </div>
                    </div>
                    <div class="skin-squaresc vap-schedule-fields" style="padding-bottom: 15px;padding-top: 15px;">	
							<label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 25px;"> Counter Style :  </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-counterstyle" value="metal" <?php if($vap_stored_meta['vap-counterstyle'][0] == 'metal' || $vap_stored_meta['vap-counterstyle'][0] == '') { echo 'checked="checked"'; }?>> Metal </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-counterstyle" value="crystal" <?php if($vap_stored_meta['vap-counterstyle'][0] == 'crystal') { echo 'checked="checked"'; }?>> Crystal </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-counterstyle" value="flip" <?php if($vap_stored_meta['vap-counterstyle'][0] == 'flip') { echo 'checked="checked"'; }?>> Flip </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-counterstyle" value="slide" <?php if($vap_stored_meta['vap-counterstyle'][0] == 'slide') { echo 'checked="checked"'; }?>> Slide </label>
                            
                    </div>
                    <script>
						jQuery(document).ready(function(){
						  jQuery('.skin-squaresc input').iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						});
						</script> 
                      <div class="skin-squaresc1 vap-schedule-fields" style="padding-bottom: 15px;padding-top: 15px;">	
							<label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 25px;"> Counter Color :  </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-countercolor" value="black" <?php if($vap_stored_meta['vap-countercolor'][0] == 'black' || $vap_stored_meta['vap-countercolor'][0] == '') { echo 'checked="checked"'; }?>> Black </label><label style="display: inline-block;font-size: 18px;font-weight: bold;margin-right: 17px;"><input type="radio" name="vap-countercolor" value="white" <?php if($vap_stored_meta['vap-countercolor'][0] == 'white') { echo 'checked="checked"'; }?>> White </label>
                            
                    </div>
                    <script>
						jQuery(document).ready(function(){
						  jQuery('.skin-squaresc1 input').iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						});
						</script>   
                     <div class="skin-squaresc1 vap-schedule-fields" style="padding-bottom: 15px;padding-top: 15px;">   
                        <label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:17px;"> <input type="checkbox" name="vap-showcountreflection" value="true" <?php if ( isset ( $vap_stored_meta['vap-showcountreflection'] ) ) checked( $vap_stored_meta['vap-showcountreflection'][0], 'true' ); ?>> Show Counter Reflection </label> <label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:17px;"> <input type="checkbox" name="vap-hidelabels" value="true" <?php if ( isset ( $vap_stored_meta['vap-hidelabels'] ) ) checked( $vap_stored_meta['vap-hidelabels'][0], 'true' ); ?>> Hide labels </label>
                     </div>
                     <div class="skin-squaresc1 vap-schedule-fields" style="padding-bottom: 15px;padding-top: 15px;">   
                        <label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:15px;"> <input type="checkbox" name="vap-hidedays" value="true" <?php if ( isset ( $vap_stored_meta['vap-hidedays'] ) ) checked( $vap_stored_meta['vap-hidedays'][0], 'true' ); ?>> Hide Days </label> <label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:15px;"> <input type="checkbox" name="vap-hidehourss" value="true" <?php if ( isset ( $vap_stored_meta['vap-hidehourss'] ) ) checked( $vap_stored_meta['vap-hidehourss'][0], 'true' ); ?>> Hide Hours </label><label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:15px;"> <input type="checkbox" name="vap-hidemins" value="true" <?php if ( isset ( $vap_stored_meta['vap-hidemins'] ) ) checked( $vap_stored_meta['vap-hidemins'][0], 'true' ); ?>> Hide Minutes </label> <label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right:0px;"> <input type="checkbox" name="vap-hidesecs" value="true" <?php if ( isset ( $vap_stored_meta['vap-hidesecs'] ) ) checked( $vap_stored_meta['vap-hidesecs'][0], 'true' ); ?>> Hide Seconds </label>
                     </div>   
                     <div class="form-group vap-schedule-fields" style="overflow:hidden;">
                        	<label for="vap-counterwidth" class="control-label span3">Counter Width</label>
                            
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-counterwidth" id="vap-counterwidth" value="<?php echo $vap_stored_meta['vap-counterwidth'][0]; ?>">
                                
                            </div>
                     </div>   
                     
                     <hr style="height:10px;border:none;color:#000;background-color:#000;margin-top:20px; margin-bottom:20px;" />
                     
                     <script>
                     jQuery(document).ready(function(){
						  
							var changeCheckbox = document.querySelector('.js-enablefbretarget');
							//alert(jQuery('#junaid').iCheck('check'));
							if(changeCheckbox.checked == false){
							  	jQuery(".vap-fbt-fields").hide("slow");
								jQuery(".fbminssecs").hide("slow");
								
							  }
							  else{
								  jQuery(".vap-fbt-fields").show("slow");
								  if(jQuery( "#fbtargettiming1" ).parent().hasClass("checked")){
									  jQuery(".fbminssecs").hide("slow");
								  }
								  if(jQuery( "#fbtargettiming2" ).parent().hasClass("checked")){
									  jQuery(".fbminssecs").show("slow");
								  }
							  }
							changeCheckbox.onchange = function() {
							  if(changeCheckbox.checked == false){
							  	jQuery(".vap-fbt-fields").hide("slow");
								jQuery(".fbminssecs").hide("slow");
							  }
							  else{
								  
								  jQuery(".vap-fbt-fields").show("slow");
								  if(jQuery( "#fbtargettiming1" ).parent().hasClass("checked")){
									  jQuery(".fbminssecs").hide("slow");
								  }
								  if(jQuery( "#fbtargettiming2" ).parent().hasClass("checked")){
									  jQuery(".fbminssecs").show("slow");
								  }
							  }
							};
														
						});
                      </script>
                      
                      
          			<div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-enablevidschedule" class="control-label span5">Enable Facebook Retargeting</label>
                            <div class="span5">
                                <input type="checkbox" id="vap-enablefbretarget" name="vap-enablefbretarget" class="js-switch js-enablefbretarget" value="true" <?php if ( isset ( $vap_stored_meta['vap-enablefbretarget'] ) ) checked( $vap_stored_meta['vap-enablefbretarget'][0], 'true' ); ?> />
                               
                            </div>
                    </div> 
                    <div class="form-group vap-fbt-fields" style="overflow:hidden;">
                        	<label for="vap-fbpixelid" class="control-label span3">Facebook Pixel ID</label>
                            
                            <div class="span9">
                                <input type="text" class="form-control" name="vap-fbpixelid" id="vap-fbpixelid" value="<?php echo $vap_stored_meta['vap-fbpixelid'][0]; ?>">    
                            </div>
                     </div>
                     <div class="skin-squarefb vap-fbt-fields" style="padding-bottom: 15px;padding-top: 15px;">	
							<label style="display: inline-block;font-size: 16px;font-weight: bold;margin-right: 23px;"> Embed Tracking Code At :  </label><label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 15px;"><input type="radio" name="vap-fbcodeembp" id= "fbtargettiming1" value="fbvidstart" <?php if($vap_stored_meta['vap-fbcodeembp'][0] == 'fbvidstart' || $vap_stored_meta['vap-fbcodeembp'][0] == '') { echo 'checked="checked"'; }?>> At Start Of Video </label><label style="display: inline-block;font-size: 15px;font-weight: bold;margin-right: 15px;"><input type="radio" name="vap-fbcodeembp" id= "fbtargettiming2" value="fbvidspec" <?php if($vap_stored_meta['vap-fbcodeembp'][0] == 'fbvidspec') { echo 'checked="checked"'; }?>> At Specific Time </label>
                            
                    </div>
                     <div class="form-group fbminssecs" id="fbretardiv" style="overflow:hidden;margin-bottom:35px;<?php if($vap_stored_meta['vap-fbcodeembp'][0] == 'fbvidstart' || $vap_stored_meta['vap-fbcodeembp'][0] == '') { echo 'display:none;'; }?>">
                        	<label for="vap-fbremin" class="control-label span3">Minutes</label>
                            <div class="span3">
                                <select name="vap-fbremin" id="vap-fbremin">
                                <?php for ($xfb = 0; $xfb <= 60; $xfb++) { ?>
								<option  value="<?php echo $xfb; ?>" <?php if ( isset ( $vap_stored_meta['vap-fbremin'] ) ) selected( $vap_stored_meta['vap-fbremin'][0], $xfb ); ?>><?php echo $xfb; ?></option>
                                <?php } ?>
							</select>
                            </div>
                            <label for="vap-fbresec" class="control-label span3">Seconds</label>
                            <div class="span3">
                                   <select name="vap-fbresec" id="vap-fbresec">
                                <?php for ($xfb1 = 0; $xfb1 <= 60; $xfb1++) { ?>
								<option  value="<?php echo $xfb1; ?>" <?php if ( isset ( $vap_stored_meta['vap-fbresec'] ) ) selected( $vap_stored_meta['vap-fbresec'][0], $xfb1 ); ?>><?php echo $xfb1; ?></option>
                                <?php } ?>
							</select>
                            </div>
                        </div>
                    <script>
						jQuery(document).ready(function(){
						  jQuery('.skin-squarefb input').on('ifChanged ifChecked ifUnchecked', function(event){
              //alert(this.value + ' is ' + event.type.replace('if', '').toLowerCase());
							 if(this.value == 'fbvidstart' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('fbretardiv').style.display = 'none';
							 }
							 if(this.value == 'fbvidspec' && event.type.replace('if', '').toLowerCase() == 'checked'){
								document.getElementById('fbretardiv').style.display = '';
							 }
            			}).iCheck({
							checkboxClass: 'icheckbox_square',
							radioClass: 'iradio_square',
							increaseArea: '20%'
						  });
						});
						</script>   
                        
                        <hr style="height:10px;border:none;color:#000;background-color:#000;margin-top:20px; margin-bottom:20px;" />
                     
                     <script>
                     jQuery(document).ready(function(){
						  
							var changeCheckbox = document.querySelector('.js-enabledimlights');
							//alert(jQuery('#junaid').iCheck('check'));
							if(changeCheckbox.checked == false){
							  	jQuery(".vap-dimlight-fields").hide("slow");
							  }
							  else{
								  
								jQuery(".vap-dimlight-fields").show("slow");
								  
							  }
							changeCheckbox.onchange = function() {
							  if(changeCheckbox.checked == false){
							  	jQuery(".vap-dimlight-fields").hide("slow");
							  }
							  else{
								jQuery(".vap-dimlight-fields").show("slow");
							  }
							};
														
						});
                      </script>
                        
                    <div class="form-group" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-dimlight" class="control-label span5">Enable Dim Light Button</label>
                            <div class="span3">
                                <input type="checkbox" id="vap-dimlight" name="vap-dimlight" class="js-switch js-enabledimlights" value="true" <?php if ( isset ( $vap_stored_meta['vap-dimlight'] ) ) checked( $vap_stored_meta['vap-dimlight'][0], 'true' ); ?> />
                            </div>
                            <span class="help-block" class="span3">Note: Not work with ads.</span>
                    </div>
                    
                    <div class="form-group vap-dimlight-fields" style="overflow:hidden;margin-bottom:35px;">
                        	<label for="vap-dimlighttype" class="control-label span3">Display Type</label>
                            
                            <div class="span9">
                                <select name="vap-dimlighttype" id="vap-dimlighttype" style="width:100%;">
								<option  value="1" <?php if ( isset ( $vap_stored_meta['vap-dimlighttype'] ) ) selected( $vap_stored_meta['vap-dimlighttype'][0], '1' ); ?>>Add bulb in controlbar to enable/disable dim lights</option>
                                <option  value="2" <?php if ( isset ( $vap_stored_meta['vap-dimlighttype'] ) ) selected( $vap_stored_meta['vap-dimlighttype'][0], '2' ); ?>>Enable dim lights on play video and disable on pause/end video.</option>
							</select>
                                
                            </div>
                        </div>  
                    
                    
                      
                    </div>
                    
                    <!-- // Tab content END -->					
				</div>
				
			</div>
		</div>
	</div>  
    <!-- // Tab END -->
    		</div>
      	</div>         
	</div>
	<?php
	}

	public function save_videoadplugin_details( $post_id ) {
		if ( $this->user_can_save( $post_id, 'vap-nonce' ) ) {

			// Checks for input and saves if needed
			
			if( isset( $_POST[ 'vap_urltype' ] ) ) {
				update_post_meta( $post_id, 'vap_urltype', $_POST[ 'vap_urltype' ]);
			}
			
			if( isset( $_POST[ 'vap-mp4url' ] ) ) {
				update_post_meta( $post_id, 'vap-mp4url', $_POST[ 'vap-mp4url' ]);
			}
			
			if( isset( $_POST[ 'vap-webmurl' ] ) ) {
				update_post_meta( $post_id, 'vap-webmurl', $_POST[ 'vap-webmurl' ]);
			}
			
			if( isset( $_POST[ 'vap-oggurl' ] ) ) {
				update_post_meta( $post_id, 'vap-oggurl', $_POST[ 'vap-oggurl' ]);
			}
			
			if( isset( $_POST[ 'vap-posterurl' ] ) ) {
				update_post_meta( $post_id, 'vap-posterurl', $_POST[ 'vap-posterurl' ]);
			}
			
			if( isset( $_POST[ 'vap-steamingurl' ] ) ) {
				update_post_meta( $post_id, 'vap-steamingurl', $_POST[ 'vap-steamingurl' ]);
			}
			
			if( isset( $_POST[ 'vap-mp3url' ] ) ) {
				update_post_meta( $post_id, 'vap-mp3url', $_POST[ 'vap-mp3url' ]);
			}
			
			if( isset( $_POST[ 'vap-showcontrol' ] ) ) {
				update_post_meta( $post_id, 'vap-showcontrol', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-showcontrol', '' );
			}
			
			if( isset( $_POST[ 'vap-autoplay' ] ) ) {
				update_post_meta( $post_id, 'vap-autoplay', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-autoplay', '' );
			}
			
			if( isset( $_POST[ 'vap-preloadvid' ] ) ) {
				update_post_meta( $post_id, 'vap-preloadvid', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-preloadvid', '' );
			}
			
			if( isset( $_POST[ 'vap-loopvid' ] ) ) {
				update_post_meta( $post_id, 'vap-loopvid', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-loopvid', '' );
			}
			
			if( isset( $_POST[ 'vap-loopvid' ] ) ) {
				update_post_meta( $post_id, 'vap-loopvid', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-loopvid', '' );
			}
			
			if( isset( $_POST[ 'vap-htoggleplay' ] ) ) {
				update_post_meta( $post_id, 'vap-htoggleplay', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-htoggleplay', '' );
			}
			
			if( isset( $_POST[ 'vap-hfullscreen' ] ) ) {
				update_post_meta( $post_id, 'vap-hfullscreen', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hfullscreen', '' );
			}
			
			if( isset( $_POST[ 'vap-htime' ] ) ) {
				update_post_meta( $post_id, 'vap-htime', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-htime', '' );
			}
			
			if( isset( $_POST[ 'vap-hvolume' ] ) ) {
				update_post_meta( $post_id, 'vap-hvolume', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hvolume', '' );
			}
			
			if( isset( $_POST[ 'vap-hmutetoggle' ] ) ) {
				update_post_meta( $post_id, 'vap-hmutetoggle', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hmutetoggle', '' );
			}
			
			if( isset( $_POST[ 'vap-hprogbar' ] ) ) {
				update_post_meta( $post_id, 'vap-hprogbar', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hprogbar', '' );
			}
			
			
			if( isset( $_POST[ 'vap-vidaudwidth' ] ) ) {
				update_post_meta( $post_id, 'vap-vidaudwidth', $_POST[ 'vap-vidaudwidth' ]);
			}
			
			if( isset( $_POST[ 'vap-vidaudheight' ] ) ) {
				update_post_meta( $post_id, 'vap-vidaudheight', $_POST[ 'vap-vidaudheight' ]);
			}
			
			if( isset( $_POST[ 'vap-vidaspectratio' ] ) ) {
				update_post_meta( $post_id, 'vap-vidaspectratio', $_POST[ 'vap-vidaspectratio' ]);
			}
			
			if( isset( $_POST[ 'vap-vidaudmaxwidth' ] ) ) {
				update_post_meta( $post_id, 'vap-vidaudmaxwidth', $_POST[ 'vap-vidaudmaxwidth' ]);
			}
			
			if( isset( $_POST[ 'vap-videoalign' ] ) ) {
				update_post_meta( $post_id, 'vap-videoalign', $_POST[ 'vap-videoalign' ]);
			}
			
			if( isset( $_POST[ 'vap-playbtnpos' ] ) ) {
				update_post_meta( $post_id, 'vap-playbtnpos', $_POST[ 'vap-playbtnpos' ]);
			}
			
			if( isset( $_POST[ 'vap-controlsize' ] ) ) {
				update_post_meta( $post_id, 'vap-controlsize', $_POST[ 'vap-controlsize' ]);
			}
			
			if( isset( $_POST[ 'vap-controlcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-controlcolor', $_POST[ 'vap-controlcolor' ]);
			}
			
			if( isset( $_POST[ 'vap-controlbarcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-controlbarcolor', $_POST[ 'vap-controlbarcolor' ]);
			}
			
			if( isset( $_POST[ 'vap-pbarcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-pbarcolor', $_POST[ 'vap-pbarcolor' ]);
			}
			
			if( isset( $_POST[ 'vap-skins' ] ) ) {
				update_post_meta( $post_id, 'vap-skins', $_POST[ 'vap-skins' ]);
			}			
			
			if( isset( $_POST[ 'vap_adtype' ] ) ) {
				update_post_meta( $post_id, 'vap_adtype', $_POST[ 'vap_adtype' ]);
			}
			
			if( isset( $_POST[ 'vap-vasttagurl' ] ) ) {
				update_post_meta( $post_id, 'vap-vasttagurl', $_POST[ 'vap-vasttagurl' ]);
			}
			
			if( isset( $_POST[ 'vap-midvasttagurl' ] ) ) {
				update_post_meta( $post_id, 'vap-midvasttagurl', $_POST[ 'vap-midvasttagurl' ]);
			}
			
			if( isset( $_POST[ 'vap-postvasttagurl' ] ) ) {
				update_post_meta( $post_id, 'vap-postvasttagurl', $_POST[ 'vap-postvasttagurl' ]);
			}
			
			if( isset( $_POST[ 'vap-midoffset' ] ) ) {
				update_post_meta( $post_id, 'vap-midoffset', $_POST[ 'vap-midoffset' ]);
			}
			
			if( isset( $_POST[ 'vap-skiptime' ] ) ) {
				update_post_meta( $post_id, 'vap-skiptime', $_POST[ 'vap-skiptime' ]);
			}
			
			if( isset( $_POST[ 'vap-hideskipbtn' ] ) ) {
				update_post_meta( $post_id, 'vap-hideskipbtn', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hideskipbtn', '' );
			}
			
			if( isset( $_POST[ 'vap-imaadtagurl' ] ) ) {
				update_post_meta( $post_id, 'vap-imaadtagurl', $_POST[ 'vap-imaadtagurl' ]);
			}
			
			if( isset( $_POST[ 'vap-baohtmltext' ] ) ) {
				update_post_meta( $post_id, 'vap-baohtmltext', $_POST[ 'vap-baohtmltext' ] );
			}
			
			if( isset( $_POST[ 'vap-baostarttime' ] ) ) {
				update_post_meta( $post_id, 'vap-baostarttime', $_POST[ 'vap-baostarttime' ] );
			}
			
			if( isset( $_POST[ 'vap-baoendtime' ] ) ) {
				update_post_meta( $post_id, 'vap-baoendtime', $_POST[ 'vap-baoendtime' ] );
			}
			
			if( isset( $_POST[ 'vap-baoposition' ] ) ) {
				update_post_meta( $post_id, 'vap-baoposition', $_POST[ 'vap-baoposition' ] );
			}
			
			if( isset( $_POST[ 'vap-baoverlaywidth' ] ) ) {
				update_post_meta( $post_id, 'vap-baoverlaywidth', $_POST[ 'vap-baoverlaywidth' ] );
			}
			
			if( isset( $_POST[ 'vap-endiscomp' ] ) ) {
				update_post_meta( $post_id, 'vap-endiscomp', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-endiscomp', '' );
			}
			
			if( isset( $_POST[ 'vap-compdivid' ] ) ) {
				update_post_meta( $post_id, 'vap-compdivid', $_POST[ 'vap-compdivid' ] );
			}
			
			if( isset( $_POST[ 'vap-radsize' ] ) ) {
				update_post_meta( $post_id, 'vap-radsize', $_POST[ 'vap-radsize' ] );
			}
			
			if( isset( $_POST[ 'vap-tadsize' ] ) ) {
				update_post_meta( $post_id, 'vap-tadsize', $_POST[ 'vap-tadsize' ] );
			}
			
			if( isset( $_POST[ 'vap-ladsize' ] ) ) {
				update_post_meta( $post_id, 'vap-ladsize', $_POST[ 'vap-ladsize' ] );
			}
			
			if( isset( $_POST[ 'vap-badsize' ] ) ) {
				update_post_meta( $post_id, 'vap-badsize', $_POST[ 'vap-badsize' ] );
			}
			
			if( isset( $_POST[ 'vap-wadsize' ] ) ) {
				update_post_meta( $post_id, 'vap-wadsize', $_POST[ 'vap-wadsize' ] );
			}
			
			if( isset( $_POST[ 'vap-wadsize2' ] ) ) {
				update_post_meta( $post_id, 'vap-wadsize2', $_POST[ 'vap-wadsize2' ] );
			}
			
			if( isset( $_POST[ 'vap-wadsize3' ] ) ) {
				update_post_meta( $post_id, 'vap-wadsize3', $_POST[ 'vap-wadsize3' ] );
			}
			
			if( isset( $_POST[ 'vap-shwidth' ] ) ) {
				update_post_meta( $post_id, 'vap-shwidth', $_POST[ 'vap-shwidth' ] );
			}
			
			if( isset( $_POST[ 'vap-shcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-shcolor', $_POST[ 'vap-shcolor' ] );
			}
			
			if( isset( $_POST[ 'vap-bdwidth' ] ) ) {
				update_post_meta( $post_id, 'vap-bdwidth', $_POST[ 'vap-bdwidth' ] );
			}
			
			if( isset( $_POST[ 'vap-bdcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-bdcolor', $_POST[ 'vap-bdcolor' ] );
			}
			
			if( isset( $_POST[ 'vap-bdstyle' ] ) ) {
				update_post_meta( $post_id, 'vap-bdstyle', $_POST[ 'vap-bdstyle' ] );
			}
			
			if( isset( $_POST[ 'vap-vpaidtagurl' ] ) ) {
				update_post_meta( $post_id, 'vap-vpaidtagurl', $_POST[ 'vap-vpaidtagurl' ] );
			}
			
			if( isset( $_POST[ 'vap-enablevidschedule' ] ) ) {
				update_post_meta( $post_id, 'vap-enablevidschedule', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-enablevidschedule', '' );
			}
			
			if( isset( $_POST[ 'vap-scheduledate' ] ) ) {
				update_post_meta( $post_id, 'vap-scheduledate', $_POST[ 'vap-scheduledate' ] );
			}
			
			if( isset( $_POST[ 'vap-scheduletimezone' ] ) ) {
				update_post_meta( $post_id, 'vap-scheduletimezone', $_POST[ 'vap-scheduletimezone' ] );
			}
			
			if( isset( $_POST[ 'vap-schedtitletext' ] ) ) {
				update_post_meta( $post_id, 'vap-schedtitletext', $_POST[ 'vap-schedtitletext' ] );
			}
			
			if( isset( $_POST[ 'vap-schedtitlecolor' ] ) ) {
				update_post_meta( $post_id, 'vap-schedtitlecolor', $_POST[ 'vap-schedtitlecolor' ] );
			}
			
			if( isset( $_POST[ 'vap-schoverbgopacity' ] ) ) {
				update_post_meta( $post_id, 'vap-schoverbgopacity', $_POST[ 'vap-schoverbgopacity' ] );
			}
			
			if( isset( $_POST[ 'vap-schoverbgcolor' ] ) ) {
				update_post_meta( $post_id, 'vap-schoverbgcolor', $_POST[ 'vap-schoverbgcolor' ] );
			}
			
			if( isset( $_POST[ 'vap-counterstyle' ] ) ) {
				update_post_meta( $post_id, 'vap-counterstyle', $_POST[ 'vap-counterstyle' ]);
			}
			
			if( isset( $_POST[ 'vap-countercolor' ] ) ) {
				update_post_meta( $post_id, 'vap-countercolor', $_POST[ 'vap-countercolor' ]);
			}
			
			if( isset( $_POST[ 'vap-showcountreflection' ] ) ) {
				update_post_meta( $post_id, 'vap-showcountreflection', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-showcountreflection', '' );
			}
			
			if( isset( $_POST[ 'vap-hidelabels' ] ) ) {
				update_post_meta( $post_id, 'vap-hidelabels', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hidelabels', '' );
			}
			
			if( isset( $_POST[ 'vap-hidedays' ] ) ) {
				update_post_meta( $post_id, 'vap-hidedays', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hidedays', '' );
			}
			
			if( isset( $_POST[ 'vap-hidehourss' ] ) ) {
				update_post_meta( $post_id, 'vap-hidehourss', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hidehourss', '' );
			}
			
			if( isset( $_POST[ 'vap-hidemins' ] ) ) {
				update_post_meta( $post_id, 'vap-hidemins', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hidemins', '' );
			}
			
			if( isset( $_POST[ 'vap-hidesecs' ] ) ) {
				update_post_meta( $post_id, 'vap-hidesecs', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-hidesecs', '' );
			}
			
			if( isset( $_POST[ 'vap-counterwidth' ] ) ) {
				update_post_meta( $post_id, 'vap-counterwidth', $_POST[ 'vap-counterwidth' ]);
			}
			
			if( isset( $_POST[ 'vap-enablefbretarget' ] ) ) {
				update_post_meta( $post_id, 'vap-enablefbretarget', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-enablefbretarget', '' );
			}
			
			if( isset( $_POST[ 'vap-fbpixelid' ] ) ) {
				update_post_meta( $post_id, 'vap-fbpixelid', $_POST[ 'vap-fbpixelid' ]);
			}
			
			if( isset( $_POST[ 'vap-fbcodeembp' ] ) ) {
				update_post_meta( $post_id, 'vap-fbcodeembp', $_POST[ 'vap-fbcodeembp' ]);
			}
			
			if( isset( $_POST[ 'vap-fbremin' ] ) ) {
				update_post_meta( $post_id, 'vap-fbremin', $_POST[ 'vap-fbremin' ]);
			}
			
			if( isset( $_POST[ 'vap-fbresec' ] ) ) {
				update_post_meta( $post_id, 'vap-fbresec', $_POST[ 'vap-fbresec' ]);
			}
			
			if( isset( $_POST[ 'vap-dimlight' ] ) ) {
				update_post_meta( $post_id, 'vap-dimlight', 'true' );
			} else {
				update_post_meta( $post_id, 'vap-dimlight', '' );
			}
			
			if( isset( $_POST[ 'vap-dimlighttype' ] ) ) {
				update_post_meta( $post_id, 'vap-dimlighttype', $_POST[ 'vap-dimlighttype' ]);
			}
			
		}

	}
	private function user_can_save( $post_id, $nonce ) {

		$is_autosave = wp_is_post_autosave( $post_id );
		$is_revision = wp_is_post_revision( $post_id );
		$is_valid_nonce = ( isset( $_POST[ $nonce ] ) && wp_verify_nonce( $_POST[ $nonce ], plugin_basename( __FILE__ ) ) ) ? true : false;
		return ! ( $is_autosave || $is_revision) && $is_valid_nonce;

	}

}