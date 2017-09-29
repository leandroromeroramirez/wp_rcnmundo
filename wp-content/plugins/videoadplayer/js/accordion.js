jQuery(document).ready(function($) {
 $( "#accordion" )
.accordion({
collapsible: true,
heightStyle: "content",
header: "> div > h3"
})
.sortable({
axis: "y",
handle: "h3",
stop: function( event, ui ) {
// IE doesn't register the blur when sorting
// so trigger focusout handlers to remove .ui-state-focus
ui.item.children( "h3" ).triggerHandler( "focusout" );
}
});

$('.btnDels').click(function(e){
			var current_del = $(this).parent().parent();
			var myvideogvp = current_del.siblings('.group');
        if (myvideogvp.length === 0) {
            alert("You should atleast have one video.");
            return;
        }
			//current_del.next("div").remove();
          //$(this).parent().remove();
		  current_del.remove();
        });
		
		
		$('.addvideogvp').click(function(e){

		var lastRepeatingGroup = $('.group').last();
		//var lastRepeatingGrouphead = $('.collheading').last();
        var cloned2 = lastRepeatingGroup.clone(true) ;
		//var cloned1 = lastRepeatingGrouphead.clone(true) ;
        cloned2.insertAfter(lastRepeatingGroup);
		//cloned1.insertAfter(lastRepeatingGroup);
        //resetAttributeNames(cloned);
		});
		
		jQuery( '.vapduplicatepagepost' ).click( function( e ) {
		e.preventDefault();
		var data = {
			action: 'vap_pagepost_duplicate',
			original_id: jQuery(this).attr('href'),
			security: jQuery(this).attr('rel')
		};
		jQuery.post( ajaxurl, data, function( response ) {
			location.reload();
		});
		});
		
		 jQuery('.handlediv1').click(function(e){
			jQuery(this).hide("fast");
			jQuery(this).next().show("fast");;
			jQuery(this).siblings('.handledivmaint').css("display","none");
        
		});
		  jQuery('.handlediv2').click(function(e){
			jQuery(this).hide("fast");
			jQuery(this).prev().show("fast");
			jQuery(this).siblings('.handledivmaint').css("display","block");
        
		});
});