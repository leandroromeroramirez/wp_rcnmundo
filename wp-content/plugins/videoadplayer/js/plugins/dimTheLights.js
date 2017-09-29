        function dimTheLights(){
			//this.mainEl_.className += ' vjs-dim-focus';
			jQuery(".vjs-dim-fc").addClass("vjs-dim-focus");
			jQuery(".vjs-dim-overlay").css("display", "block");
			//document.getElementsByClassName("vjs-dim-overlay").style.display = 'block';
			setTimeout( function(){ jQuery(".vjs-dim-overlay:first").addClass("vjs-dim-off"); } , 15 );
			
			jQuery(".vjs-dim-the-lights").addClass("vjs-dim-toggle");
			//setTimeout( videojs.bind( this, function() { this.overlay_.className += ' vjs-dim-off'; } ), 10 );
			
			//this.el_.className += ' vjs-dim-toggle';
		}
		function raiseTheLights(){
			jQuery(".vjs-dim-fc").removeClass("vjs-dim-focus");
			jQuery(".vjs-dim-overlay").css("display", "none");
			//document.getElementsByClassName("vjs-dim-overlay").style.display = 'block';
			setTimeout( function(){ jQuery(".vjs-dim-overlay:first").removeClass("vjs-dim-off"); } , 15 );
			
			jQuery(".vjs-dim-the-lights").removeClass("vjs-dim-toggle");
			
		}
		function dimLightstoggle() {
           var isDim = false;
		   /* It is the variable which tells us that that HD video is getting played or not.
			  HD1 = false ---> video is not HD
			  HD1 = true ----> video is HD */
          
             videojs.dimthelightclass = videojs.Button.extend({
           /* @constructor */
               init: function(player, options){
                 videojs.Button.call(this, player, options);
                 this.on('click', this.onClick);
               }
             });
            
			/* Changing sources by clicking on HD button */
			/* This function is called when HD button is clicked */
            videojs.dimthelightclass.prototype.onClick = function() {
				 if ( !isDim ) {
					 dimTheLights();
					isDim=true;
					
					
					/*videojs.one( document, 'keyup', videojs.bind(this, function(evt) {
						if ( evt.keyCode == 27 ) {
							raiseTheLights();
						}
					}) );*/
					
				} else {
					raiseTheLights();
					isDim=false;
					
				}
         	
         };
         
		 /* Create HD button */
		 var createdlbButton = function() {
               var props = {
                   className: 'vjs-dim-the-lights vjs-control',
                   innerHTML: '<i class="vjs-control-content fa fa-lightbulb-o"></i>',
                   role: 'button',
                   'aria-live': 'polite', 
                   tabIndex: 0
                 };
               
               return videojs.Component.prototype.createEl(null, props);
             };
         
		 /* Add HD button to the control bar */
         var dimthelightsobj;
             videojs.plugin('dimTheLights', function() {
               var options = { 'el' : createdlbButton() };
               dimthelightsobj = new videojs.dimthelightclass(this, options);
               this.controlBar.el().appendChild(dimthelightsobj.el());
             });
         
          /* Set Up Video.js Player */
		 /*var vid = videojs("example_video_1", {
              plugins : { HD : {} }
            });*/
             
}
    dimLightstoggle();
