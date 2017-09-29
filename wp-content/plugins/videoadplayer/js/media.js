/**
 * Display Settings
 *
 * @package   Flowplayer 5 for Wordpress
 * @author    Ulrich Pogson <ulrich@pogson.ch>
 * @license   GPL-2.0+
 * @link      http://flowplayer.org/
 * @copyright 2013 Flowplayer Ltd
 
 * @since    1.0.0
 */

jQuery(document).ready(function($){
// Add Splash Image
    
// Settings Page
// Add Logo
    var crr_countdownimage_frame;

    $(document.body).on('click.gvpOpenMediaManager', '.crr_settings_upload_button', function(e){
        e.preventDefault();

        if ( crr_countdownimage_frame ) {
            crr_countdownimage_frame.open();
            return;
        }

        crr_countdownimage_frame = wp.media.frames.crr_countdownimage_frame = wp.media({
            className: 'media-frame crr-media-frame',
            frame: 'select',
            multiple: false,
            title: countdownimage.title,
            library: {
                type: 'image'
            },
            button: {
                text:  countdownimage.button
            }
        });

        crr_countdownimage_frame.on('select', function(){
            var media_attachment = crr_countdownimage_frame.state().get('selection').first().toJSON();

            $('.crrimage_upload_field').val(media_attachment.url);
            $('.crr_settings_upload_preview').attr('src',media_attachment.url);
        });

        crr_countdownimage_frame.open();
    });
});