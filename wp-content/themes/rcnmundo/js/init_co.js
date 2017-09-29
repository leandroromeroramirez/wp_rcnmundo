function calltagsdfp(){
    $.dfp({dfpID: 62207337});

} 
var playerInstance = jwplayer("stream");
function llamado(idmedia,idstationr){
    $('.zocalo').hide();
    var wmaint = document.body.clientWidth;
    currenthjw = $('#media').outerWidth()*9 / 16;
    hlsstation = currenthjw -72;
    $('#news ul').css('height',hlsstation+'px');
    newurlw = 'station?id='+idstationr;
    var vghe = currenthjw;
    if(wmaint<960){
        vghe = 350;
        $(document).scrollTop(300);
    }
    $('#btn_large').hide();
    $('#station').fadeOut();
    $('#btn_large').click(function(){
        openWin(newurlw);
    });
    playerInstance.setup({
        primary:'flash',
        file: idmedia ,
        autostart: true,
        width: "100%",
        height: vghe,
        skin: "stormtrooper",
        /*advertising: {
            client: "vast",
            tag:['https://ad4.liverail.com/?LR_PUBLISHER_ID=94018&LR_SCHEMA=vast2-vpaid&LR_URL=rcnradio.com','https://ad4.liverail.com/?LR_PUBLISHER_ID=94018&LR_SCHEMA=vast2&LR_URL=rcnradio.com']
        },*/
        events: {
            onPlay: function (event) {
                correct();
                $('#station').fadeIn('fast');
                if(wmaint>960){
                    $('#news').fadeIn('fast');
                    $('#news ul').mCustomScrollbar();
                    $('#btn_large').fadeIn('fast');
                }
                if(wmaint>1100){
                    $('.zocalo').show();
                }
            }
       }
    });
    $('div#coverradiomb').click(function(){
        playerInstance.play();
        $(this).fadeOut('fast');
    });
}
function openWin(idwindow){
    widthtp = document.body.clientWidth-330;
    playerInstance.stop();
    myWindow = window.open(idwindow, "myWindow", "toolbar=no, scrollbars=no, resizable=no, top=0, left="+widthtp+", width=330, height=460");    
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
        //$('.nowstation p').html(data.nowstation.title);
        $('.nowstation p').html('El Tren de la Tarde');
        /*if(imapic){
            $('.logoRadio').attr('src',imapic);
        }*/
        $('.logoRadio').attr('src','http://www.rcnmundo.com/img/coverplayer.png');
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
        playerInstance.resize('100%',350); 
        $('#news').hide();
        $('#btn_large').hide();
    }else{
        playerInstance.resize('100%',newjw); 
        $('#news').fadeIn();
        $('#btn_large').fadeIn();
    }
    if(wmain>1200){
        $('.zocalo').show();
    }else{
        $('.zocalo').hide();
    }
    if(wmain<760){
        callcarrusel();
    }else{
        $('#ml_emisoras').trigger("destroy");
    }
});
$( document ).ready(function() {
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
    vcontrol = 1;
    var callingclm = setInterval(function(){ 
        callcarrusel(); 
        vcontrol++; 
        if(vcontrol > 5){
            clearInterval(callingclm);
        }
    },700);
   
    });
$('#mask').carouFredSel({
    scroll : {
        easing            : "elastic",
        duration        : 1200,
        pauseOnHover    : true
    },
    prev: '#prev',
    next: '#next',
    responsive: true,
        width: '100%',
        scroll: 3,
        items: {
                                        width: 80,
                                        visible: {
                                            min: 3,
                                            max: 10
                                        }
                                    },
                                    swipe: {
             onMouse: true,
             onTouch: true
         }
});
function vrmask(){
    $('#maskr').carouFredSel({ 
        auto:false,
        prev: '#prev_r',
        next: '#next_r',
        swipe:true,
        responsive: true,
        scroll: 3,
        items: {
            width: 200,
            visible: {
                min: 1,
                max: 4
            }
        },
        swipe: {
             onMouse: true,
             onTouch: true
         }
    });   
}
function callscroll(){
    $('#content_node').mCustomScrollbar();
}
function callcarrusel(){
    gmain = $(window).outerWidth();
    if(gmain < 760){
    $('#ml_emisoras').carouFredSel({
            auto:false,
            prev: '#prev2',
            next: '#next2',
            responsive: true,
            height:90,
            width:'100%',
            scroll: 3,
            items: {
                width: 80,
                visible: {
                    min: 3,
                    max: 10
                }
            },
            swipe: {
             onMouse: true,
             onTouch: true
         }
    });
    }
}
vrmask();
calltagsdfp();
llamado('http://live.rcnmundo.com/rcnlaradio.mp3',4);
setInterval(function(){ nowstation();},5000);
setInterval(function(){ calltagsdfp();},1200000);
var hgl = $(window).outerHeight() - 50;
$('.gn-menu-wrapper').css('height',hgl+'px');
$('.gn-menu-wrapper').mCustomScrollbar();
$('.gn-icon-menu').click(function(){
        var comprueba = $('.gn-menu-wrapper').hasClass( "gn-open-all" );
        if(comprueba){
            $('.gn-menu-wrapper').removeClass('gn-open-all');
        }else{
            $('.gn-menu-wrapper').addClass('gn-open-all');
        }
    });
});
$('.gn-menu-wrapper li').click(function(){
    var comprueba = $('.gn-menu-wrapper').hasClass( "gn-open-all" );
    if(comprueba){
        $('.gn-menu-wrapper').removeClass('gn-open-all');
    }else{
        $('.gn-menu-wrapper').addClass('gn-open-all');
    }
    vcontrol = 1;
    var callingclm = setInterval(function(){ 
        callcarrusel(); 
        vcontrol++; 
        if(vcontrol > 5){
            clearInterval(callingclm);
        }
    },700);
});