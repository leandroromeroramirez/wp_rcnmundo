//refresh ADs
function calltagsdfp(){
	if (window.googletag && googletag.loaded) {
	   if (googletag.pubads()){
    	   googletag.pubads().refresh();
	   }
	}
    return false;
} 
//Mobile detection
function mobilecheck() {
      var check = false;
      (function(a){if(/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino/i.test(a)||/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0,4))) check = true;})(navigator.userAgent||navigator.vendor||window.opera);
      return check;
}
var aud = document.getElementById("emisoraaudio");
var tagad = 'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNMUNDO/VIDEO/RCNMUNDO_Video_Prerroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1';
/*var tagad = '';*/
var playerInstance = jwplayer("stream");
var error = false;
var adinit = 0;
var checkplayerw = $('#stream').width();
if(checkplayerw<300){
    var wmaint = $(window).outerWidth();
    var jww = Math.round(wmaint * 0.65);
    $('#stream').css('width',jww+'px');
}else{
    $('#stream').css('width','100%');
}
function llamado(idmedia,idstationr){
    var displayonce = false;
    $('.zocalo').hide();
    var wmaint = $(window).outerWidth();
    newurlw = 'station-rcnmundo?id='+idstationr;
    nurlm = 'mensajero-rcnmundo?id='+idstationr;
    vaspect = '16:9';
    if(wmaint<960){
        $(document).scrollTop(300);
        aud.pause();
        $('#radio_main_channel').attr('src','');
        $('#media').css('height','auto');
        if(mobilecheck()){
            $('div#coverradiomb').show();
            $('.btn_play').show();
            $('.btn_stop').hide(); 
        }
        vaspect = '4:3';
    }
    $('#btn_large').removeClass('appearbtn');
    $('#station').fadeOut();
    $('#btn_large').click(function(){
        openWin(newurlw);
    });
    $('#btn_mensajero').click(function(){
        openWinM(nurlm);
    });
    if(mobilecheck()){
        $('div#coverradiomb').css('position','relative');
    }else{
        if(error){
            tagad = '';
        }
        playerInstance.setup({ 
            file: idmedia ,
            autostart: true,
            width: "100%",
            aspectratio: vaspect,
            skin: "stormtrooper",
            ga: {},
            advertising: { 
                client: 'googima',
                schedule: {
                    "preroll": {
                        "offset": "pre",
                        "tag": tagad
                        }
                    }
                }
            });
        }
        playerInstance.on("play",function(){
            correct();
            $('#station').fadeIn('fast');
            if(wmaint>959){
                $('#news').fadeIn('fast');
                $('#news ul').mCustomScrollbar();
                $('#btn_large').addClass('appearbtn');
            }
            if(wmaint>1100){
                $('.zocalo').show();
            }
        });
        playerInstance.on("play",function(){
            var hmb = $('#media').height();
            $('#coverradiomb').css('height',hmb+'px');
        });
        playerInstance.on('error', function() {
            error = true;
            tagad = '';
            var n = idmedia.search("aac");
            if(n != -1){
                var res = idmedia.replace("aac", "mp3");
            }else{
                var res = idmedia;
            }
            $('#station').hide();
            playerInstance.load({
                file: res
            });
            playerInstance.play(true);
        });
        playerInstance.on('adImpression',function(event){
            currentad = true;
            adh = $('#stream_ad iframe').attr('height');
            if(adh==0){
                $('#stream_ad iframe').attr('width',$('#stream').width());
                $('#stream_ad iframe').attr('height',$('#stream').height());
            }
        });
        playerInstance.on('adComplete',function(event){
            displayonce = true;
        });
        /*playerInstance.on('buffer', function(e) {
        	setTimeout(function(){ 
        		 if (playerInstance.getState() != "playing") {
        		 	if(e.newstate == "buffering" && displayonce == false){
        				error = true;
                        tagad = '';
        				playerInstance.load({
                			file: idmedia
		            	});
		            	playerInstance.play(true);
		            	//console.log('refresh');
        			}
        		 }
        	}, 6000);
        });*/
        $('.btn_play').click(function(){
            if(mobilecheck()){
                playerInstance.remove();
                $('#radio_main_channel').attr('src',idmedia);
                $('.btn_play').hide();
                $('.btn_stop').show();
                aud.load();
                aud.play();
                aud.onerror = function() {
                    aud.pause();
                    $('#radio_main_channel').attr('src',idmedia);
                     aud.play();
                     //console.log('e');
                }
                //requestAds();
            }else{
                $('#emisoraaudio').hide();
                playerInstance.play();
                $('div#coverradiomb').fadeOut('fast');
            }
        });
        $('.btn_stop').click(function(){
            $('.btn_play').show();
            $('.btn_stop').hide();
            aud.pause();
        });
        adinit = adinit + 1; 
    }
function reloadPlayer(){
    if (playerInstance.getState() == "playing") {
        var newdf = playerInstance.getPlaylistItem(0);
        llamado(newdf.file);
       // console.log('des');
    }
}
$('.btn_windowstation').click(function(){
    reloadPlayer();
});
function openWin(idwindow){
    widthtp = document.body.clientWidth-330;
    playerInstance.stop();
    myWindow = window.open(idwindow, "myWindow", "toolbar=no, scrollbars=no, resizable=no, top=0, left="+widthtp+", width=330, height=460");    
}
function openWinM(idwindow){
    widthtpl = (document.body.clientWidth / 2) - 365;
    myWindow = window.open(idwindow, "myWindow", "toolbar=no, scrollbars=no, resizable=no, top=0, left="+widthtpl+", width=728, height=530");    
}

function correct(){
    hstation = $('#stream').outerHeight() - 34;
    wstation = $('#media').outerWidth();
    hstation2 = hstation-37;
    $('#info_station').css('height',hstation+'px');
    $('.item').css('height',hstation+'px');
    $('#news ul').css('height',hstation2+'px');
}
function nowstation(idccr){
    idccr = $('.nowstation').attr('data-id');
    $.ajax({
      type:     "GET",
      url:      "http://www.rcnmundo.com/cover_new.php?id="+idccr,
      success: function(data){
        var nowinfostation = data;
        //console.log(data.nowstation.title);
        imapic = data.nowstation.pic;
        text = data.nowstation.title;
        if(text.length> 3){
            $('.nowstation p').html(text);
        }else{
            $('.nowstation p').html('Estás escuchando...');
        }
        //$('.nowstation p').html(data.nowstation.title);
        /*if(imapic){
            $('.logoRadio').attr('src',imapic);
        }*/
        //$('.logoRadio').attr('src','http://www.rcnmundo.com/img/coverplayer.png');
      }
    });
}
function mesages(slugradio){
    $('.content_marquee p').html('');
    var urlbase = 'http://graph.facebook.com/comments/?id=http://www.rcnmundo.com/'+slugradio+'&order=chronological'; 
    $.ajax({
      type: "GET",
      url: urlbase,
      success: function(data){
        var mens = '';
        $.each( data.data, function( key, val ) {
            mens = mens+val.message+' &bull; '
        });
        $('.content_marquee p').prepend(mens);
      }
    });   
}
$( window ).resize(function() {
    wmain = $(window).outerWidth();
    hstation = $('#stream').outerHeight() - 34;
    hstation2 = hstation-37;
    wstation = $('#media').outerWidth();
    newjw = $('#media').outerWidth()*9 / 16;
    $('#info_station').css('height',hstation+'px');
    $('.item').css('height',hstation+'px');
    $('#news ul').css('height',hstation2+'px');
    if(wmain<960){
        //playerInstance.resize('100%',350); 
        $('#news').hide();
        $('#btn_large').removeClass('appearbtn');
    }else{
        //playerInstance.resize('100%',newjw); 
        $('#news').fadeIn();
        $('#btn_large').addClass('appearbtn');
    }
    if(wmain>1200){
        $('.zocalo').show();
    }else{
        $('.zocalo').hide();
    }

    if(wmain<760){
                $('#ml_emisoras').addClass('owl-carousel');
                    var owl = $("#ml_emisoras");
                    owl.owlCarousel({navigation : true, navigationText: false, pagination:false, items:4,itemsMobile:[479,8]});
                    $("#next2").click(function(){
                        owl.trigger('owl.next');
                    });
                    $("#prev2").click(function(){
                        owl.trigger('owl.prev');
                    });
            }else{
                    validaclass = $("#ml_emisoras").hasClass("owl-theme");
                    if(validaclass) {
                        $("#ml_emisoras").data('owlCarousel').destroy();
                    }
                $('#ml_emisoras').removeClass('owl-carousel');
                
    }
    /*if(wmain<570){
        $('.container').css('width',wmain+'px');
    }*/
    if(wmain>570){
        anchoeftt = $('.container').outerWidth();
        respondww = anchoeftt - 330;
        $('.post').css('width',respondww +'px');
    }
    if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
        $('.container').css('width',wmain+'px');
    }
});
$( document ).ready(function() {
    hlmaint = $(window).outerHeight();
    $('#wrapper').css('min-height',hlmaint+'px');
    wmain = $(window).outerWidth();
    if(wmain<570){
        $('.container').css('width',wmain+'px');
        $('.post').css('width','100%');
        $('.featured').fadeIn();
    }
    if(wmain>570){
        anchoeft = $('.container').outerWidth(true);
        respondw = anchoeft - 330;
        $('.post').css('width',respondw +'px');
        $('.featured').fadeIn();
    }
    function DropDown(el) {
        this.dd = el;
        this.placeholder = this.dd.children('span');
        this.opts = this.dd.find('ul.dropdown > li');
        this.val = '';
        this.index = -1;
        this.initEvents();
    }
    DropDown.prototype = {
        initEvents : function() {
            var obj = this;

            obj.dd.on('click', function(event){
                $(this).toggleClass('active');
                return false;
            });

            obj.opts.on('click',function(){
                var opt = $(this);
                obj.val = opt.text();
                obj.index = opt.index();
                obj.placeholder.text('Ciudad: ' + obj.val);
            });
        },
        getValue : function() {
            return this.val;
        },
        getIndex : function() {
            return this.index;
        }
    }

    $(function() {

        var dd = new DropDown( $('#dd') );
        var dd2 = new DropDown( $('#dd2') );

        $(document).click(function() {
            // all dropdowns
            $('.wrapper-dropdown-1').removeClass('active');
        });  
    });
    setTimeout(function(){ appearit() },1000);
    function appearit(){
        $('.container').fadeIn(); 
        $('#wrapper').css('background','none'); 
    }
    
    $('.cimacast').click(function(){
        if((navigator.userAgent.match(/iPhone/i)) || (navigator.userAgent.match(/iPod/i))) {
            $('.btn_play').show();
            $('.btn_stop').hide();
            aud.pause();
        }else{
            playerInstance.stop();
        }
        
    });
    $('.close').click(function(){
        playerInstance.play();
    });
    refreshADS = setInterval(function(){ calltagsdfp(); }, 300000);
    //refreshAUD = setInterval(function(){ reloadPlayer(); }, 900000);
    $('#redportales').click(function(){
        $('#listadoportales').toggleClass('showlist');
    });
    
});
setInterval(function(){ nowstation();},5000);
setInterval(function(){ calltagsdfp();},1200000);
var hgl = $(window).outerHeight() - 80;
$('#sidebar-wrapper').css('height',hgl+'px');
$('#sidebar-wrapper').mCustomScrollbar();
var trigger = $('.hamburger'),
      overlay = $('.overlay'),
     isClosed = false;

    trigger.click(function () {
      hamburger_cross();      
    });

    function hamburger_cross() {

      if (isClosed == true) {          
        overlay.hide();
        trigger.removeClass('is-open');
        trigger.addClass('is-closed');
        isClosed = false;
      } else {   
        overlay.show();
        trigger.removeClass('is-closed');
        trigger.addClass('is-open');
        isClosed = true;
      }
  }
  
  $('[data-toggle="offcanvas"]').click(function () {
        $('#wrapper').toggleClass('opened');
  });
  overlay.click(function () {
       hamburger_cross();
       $('#wrapper').toggleClass('opened');
  });
  $('.sidebar-nav li').click(function () {
  		hamburger_cross();
        $('#wrapper').toggleClass('opened');
  });

