<!doctype html>
<html ng-app='rcnmundo' resize>
<head>
<meta charset="UTF-8">
<title>Radio de Colombia | RCN MUNDO | Emisoras de RCN Radio</title>
<link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
<link rel="icon" href="/favicon.ico" type="image/x-icon">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link href="<?php echo get_template_directory_uri();?>/style.css?vcs=1.35" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-default.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-plain.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-custom-width.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/owl-carousel/owl.theme.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/player/7_8/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="mzqFXqxXUk6JypE7VjMtK/bWFFPLfrELwYWoNg==";</script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/ngDialog.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/xml2json.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/servicesrcnmundo.js?v=1.3"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular-route.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/controllerrcnmundo_single.js?v=1.3"></script>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/owl.carousel.js?v=1.2"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
<?php wp_head();?>
<script type="text/javascript">
 var googletag = googletag || {};
 googletag.cmd = googletag.cmd || [];
 (function() {
   var gads = document.createElement("script");
   gads.async = true;
   gads.type = "text/javascript";
   var useSSL = "https:" == document.location.protocol;
   gads.src = (useSSL ? "https:" : "http:") + "//www.googletagservices.com/tag/js/gpt.js";
   var node =document.getElementsByTagName("script")[0];
   node.parentNode.insertBefore(gads, node);
  })();
</script>
<script type="text/javascript">

	var arrmeme = new Array('4', '696', '7', '21', '24', '27', '10', '64', '33', '67');

    var memId = 24;
	//var memId = arrmeme[Math.floor(Math.random() * ((arrmeme.length - 1) - 0 + 1))];
    var categoriainicial = 11;
    var categoriavirtual = 4;
    var categoriaafiliada = 73;
    var urlinit = '<?php echo get_post_meta(24, 'url_stream', true); ?>';

</script>
<!-- Analytics -->
	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-3017383-1', 'auto');
	  ga('create', 'UA-54490095-15', 'auto','secondaccount');

	  ga('send', 'pageview');
	  ga('secondaccount.send', 'pageview');
	</script>
<!-- Cxense script begin -->
<script type="text/javascript">
var cX = cX || {}; cX.callQueue = cX.callQueue || [];
cX.callQueue.push(['setSiteId', '1146324860938903932']);
cX.callQueue.push(['sendPageViewEvent']);
</script>
<script type="text/javascript">
(function(d,s,e,t){e=d.createElement(s);e.type='text/java'+s;e.async='async';
e.src='http'+('https:'===location.protocol?'s://s':'://')+'cdn.cxense.com/cx.js';
t=d.getElementsByTagName(s)[0];t.parentNode.insertBefore(e,t);})(document,'script');
</script>
<!-- Cxense script end -->
</head>

<body ng-controller="HomeidController" class="radio-{{background}}">
<div id='div-gpt-ad-1454097059958-2'></div>
<div class="top_mobile">
   <div id='div-gpt-ad-1454097176162-1'></div>
</div>
<div id="wrapper"  ng-init="emisoraini(memId)" style="background-image:url(<?php echo get_template_directory_uri();?>/img/380.gif); background-repeat:no-repeat; background-position:center center">
<div class="overlay"></div>
<div id="sidebar-wrapper">
            <ul class="nav sidebar-nav">
            <?php
        $args = array('child_of' => 2);
        $categories = get_categories( $args );
        foreach($categories as $category) { ?>
            <li ng-click="filtro(<?php echo($category->term_id); ?>)"  style="color:#fff;"><?php echo $category->name; ?></li>
        <?php }
        ?>
    </ul>
</div>

<div class="container" style="display:none">
    <section class="header_station">
        <button type="button" class="hamburger is-closed" data-toggle="offcanvas">
                <span class="hamb-top"></span>
                <span class="hamb-middle"></span>
                <span class="hamb-bottom"></span>
        </button>
        <div class="row">
            <div class="col-md-3 col-sm-4">
                <div class="row">
                    <div id="logo" class="logo"><a href="<?php echo bloginfo('url');?>"><img src="<?php echo get_template_directory_uri();?>/img/logo.png?v=1" /></a></div>
                    <div id="dd" class="wrapper-dropdown-1 box_city" tabindex="1">
                            <span>SELECCIONAR CIUDAD</span>
                        <ul class="dropdown" tabindex="1" id="ciudades">
                            <?php
                            $args = array('child_of' => 2);
                            $categories = get_categories( $args );
                            foreach($categories as $category) { ?>
                                <li ng-click="filtro(<?php echo($category->term_id); ?>)"  style="color:#fff;"><?php echo $category->name; ?></li>
                           <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
            <div id="top_ads" class="col-md-9 col-sm-8">
                <div class="row">
                    <div class="leaderboard">
                        <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_BarraExpander_DM -->
<div id='div-gpt-ad-1490918175179-0'
' style='height:90px; width:728px;'>
                        </div>
                        <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_horizontal -->
                        <div id='div-gpt-ad-1454097301091-0' style='height:90px; width:728px;'></div>

                        <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_vertical -->
                        <div id='div-gpt-ad-1454097301091-1' style='height:70px; width:620px;'></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header-->
    <section class="content_station">
        <div class="row">
            <nav class="col-md-3 col-sm-4">
                <div class="row">
                    <div class="stationlist">
                        <h1 class="tt_stations">SISTEMAS DE RADIO</h1>
                        <div id="prev2"><span class="glyphicon glyphicon-chevron-left"></span></div>
                        <div id="next2"><span class="glyphicon glyphicon-chevron-right"></span></div>
                        <ul id="ml_emisoras">
                            <li ng-repeat="objlist in listemisoras"><img ng-src="{{objlist.imagen}}" ng-click="changeemisora(objlist)"/></li>
                        </ul>
                    </div>
                    <div class="virtual col-md-12">
                        <h1>EMISORAS VIRTUALES</h1>
                        <div class="e_station">
                            <div id="prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
                            <div id="next"><span class="glyphicon glyphicon-chevron-right"></span></div>
                            <div id="mask" class="owl-carousel">
                                <div class="item_e" ng-repeat="listvirtualobj in listemisorasvirtual">
                                    <img ng-src="{{listvirtualobj.imagen}}" ng-click="changeemisora(listvirtualobj)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--<div class="virtual col-md-12">
                        <h1>ALIADOS INTERNACIONALES</h1>
                        <div class="i_station">
                            <div id="prev3"><span class="glyphicon glyphicon-chevron-left"></span></div>
                            <div id="next3"><span class="glyphicon glyphicon-chevron-right"></span></div>
                            <div id="maski" class="owl-carousel">
                                <div class="item_e" ng-repeat="listafiliadalobj in listemisorasafiliadas">
                                    <img ng-src="{{listafiliadalobj.imagen}}" ng-click="changeemisora(listafiliadalobj)"/>
                                </div>
                            </div>
                        </div>
                    </div>-->

                </div>
            </nav>
            <main class="col-md-9 col-sm-8">
                <div id="media">
                    <audio id="emisoraaudio" controls style="z-index:1; position:absolute; top:30px; left:3px; display:none; width:1px;"><source src="" type="audio/mpeg"  id="radio_main_channel" /></audio>
                    <div id="stream"></div>
                    <div id="coverradiomb">
                        <img ng-src="{{imagenlogoradioact}}" />
                        <div class="panelradio">
                            <h1>{{stationradio}}</h1><h2>{{stationname}}</h2>
                            <div class="btn_play">PLAY</div>
                            <div class="btn_stop">STOP</div>
                        </div>
                    </div>
                    <div id="station">
                        <div id="info_station" class="col-md-7">

                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#myCarousel" data-slide-to="1"></li>
                                </ol>

                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  <div class="item active">
                                    <div id="coverradio">
                                        <a href="{{site}}" target="_blank"><img ng-src="{{imagenlogoradioact}}" class="logoRadio" /></a>
                                        <div class="nowstation" data-id="{{idcast}}">
                                            <p>{{dataemi}}</p>
                                            <div class="socialradio">
                                                <!--<a href="{{fb}}" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/fb.png" /></a>
                                                <a href="{{tw}}" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/tw.png" /></a>-->
                                                <a href="https://www.facebook.com/dialog/share?app_id=437128813159994&href=http://wp.localhost/{{background}}&display=popup" title="Compartir en Facebook" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;">
                                                <img src="<?php echo get_template_directory_uri();?>/img/fb.png" /></a>
                                                <a href="https://twitter.com/intent/tweet?text=Escuchando {{stationname}} &amp;url=http://wp.localhost/{{background}}" target="_blank">
                                                <img src="<?php echo get_template_directory_uri();?>/img/tw.png" /></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelradio">
                                        <h1>{{stationradio}}</h1><h2>{{stationname}}</h2>
                                        <span><a href="{{site}}" target="_blank"><p>{{site}}</p></a></span>
                                        </div>
                                    <div class="zocalo" style="display:none">
                                      <div id='div-gpt-ad-1454097059958-3'>

                                        </div>
                                    </div>
                                  </div>
                                  <div class="item">
                                  	<h4 class="tt_ads">Publicidad</h4>
                                    <div class="mediumrectangle_station">

                                    </div>
                                  </div>
                                </div>

                              </div>
                        </div>
                        <div id="news" class="col-md-5">
                            <!--<h1>ÚLTIMAS NOTICIAS</h1>-->
                            <div class="mensajero">
                                <div class="content_marquee">
                                   <p></p>
                                </div>
                                <img src="<?php echo get_template_directory_uri();?>/img/ico_mensajero.png" id="btn_mensajero" />
                                <div class="clearfix"></div>
                            </div>
                            <ul ng-show="listnoticias.length != 0">
                                <li ng-repeat="noticiasobj in listnoticias">
                                    <a href="{{noticiasobj.link}}" class="tt_news" target="_blank">
                                    <img ng-src="{{noticiasobj.imagen}}" />
                                    <p>{{noticiasobj.title}} </p>
                                    </a>
                                    <span class="glyphicon glyphicon-chevron-right"></span>
                                    <div class="clearfix"></div>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div id="btn_large"><a data-toggle="tooltip" title=""><img src="<?php echo get_template_directory_uri();?>/img/btn_large.png?v=2" /></a></div>
                </div>
            </main>
        </div>
    </section>
    <section class="featured">


                                                    <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina1_300x250_DM -->
                                        <div id='div-gpt-ad-1490918175179-2'>
                                        <script>
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-2'); });
                                        </script>
                                        </div>

            <div class="post">
                    <h1 class="btn_windowstation">RECOMENDADOS</h1>
                    <div id="recomended">
                        <div id="0f4123ebdd227c693bd84f9a051da87b" class="cimacast"></div>
                        <script type="text/javascript" src="https://cimahub.com/dist/js/cimacastWidget.js"></script>
                    </div>
            </div>
            <div id="mediumrectangle">
                    <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina2_300x250_DM -->
                    <div id='div-gpt-ad-1490918175179-3'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-3'); });
                    </script>
                    </div>
            </div>
            <div class="clearfix"></div>

    </section>
    <section class="midle_ad">
       <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Footerbanner_desktop -->
        <div id='div-gpt-ad-1454097059958-1'></div>
    </section>
    <footer>
            <ul>
                <li id="redportales"><img src="<?php echo get_template_directory_uri();?>/img/rcn.gif" /></li>
                <li><a href="http://www.rcnmundo.com/atencionaloyente" target="_blank">Atención al Oyente</a></li>
                <li><a href="">Términos y condiciones</a></li>
                <li><a href="">Política de privacidad</a></li>
                <li>Copyright RCN Radio © 2015</li>
                <li><a href="http://www.cimacast.com" target="_blank">Powered By Cimacast</a></li>
            </ul>
            <div id="listadoportales">
                <ul>
                    <li><a href="http://www.rcnradio.com.co" target="_blank">RCN Radio</a></li>
                    <li><a href="http://www.lamega.com.co" target="_blank">La Mega</a></li>
                    <li><a href="http://www.lafm.com.co" target="_blank">La F.M.</a></li>
                    <li><a href="http://www.rumba.com.co" target="_blank">Rumba</a></li>
                    <li><a href="http://www.radio1.com.co" target="_blank">Radio 1</a></li>
                    <li><a href="http://www.antena2.com.co" target="_blank">Antena 2</a></li>
                    <li><a href="http://www.fantastica.com.co" target="_blank">Fantástica</a></li>
                    <li><a href="http://www.lacariñosa.com" target="_blank">La Cariñosa</a></li>
                    <li><a href="http://www.amor1044.com" target="_blank">Amor Estéreo</a></li>
                    <li><a href="http://www.elsol.com.co" target="_blank">El Sol</a></li>
                    <li><a href="http://www.radiored.com.co" target="_blank">Radio Red</a></li>
                </ul>
            </div>
    </footer>
</div>
</div>
<div id="fijoalscroll">
    <div id='div-gpt-ad-1454097176162-5'>
    </div>
</div>
<div id='div-gpt-ad-1454097059958-0' style='height:1px; width:1px;'></div>
<script src="<?php echo get_template_directory_uri();?>/js/init.js?vb=4.22"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/gnmenu.js"></script>
    <script type="text/javascript">
    googletag.cmd.push(function() {
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/1x1_tracking_code_desktop', [1, 1], 'div-gpt-ad-1454097059958-0').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Footerbanner_desktop', [970, 90], 'div-gpt-ad-1454097059958-1').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineOutOfPageSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Intersticial_fueradepagina', 'div-gpt-ad-1454097059958-2').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Mediobanner_desktop', [320, 50], 'div-gpt-ad-1454097059958-3').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_top_desktop', [728, 90], 'div-gpt-ad-1454097059958-4').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_1', [300, 250], 'div-gpt-ad-1454097059958-5').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_2', [300, 250], 'div-gpt-ad-1454097059958-6').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineOutOfPageSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Intersticial_fueradepagina', 'div-gpt-ad-1454097176162-0').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/MegaBanner_mobile', [320, 50], 'div-gpt-ad-1454097176162-1').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_mobile', [300, 250], 'div-gpt-ad-1454097176162-2').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_mobile_2', [300, 250], 'div-gpt-ad-1454097176162-3').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/1x1_tracking_code_mobile', [1, 1], 'div-gpt-ad-1454097176162-4').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Banner_fijoalscroll_mobile', [320, 50], 'div-gpt-ad-1454097176162-5').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_horizontal', [728, 90], 'div-gpt-ad-1454097301091-0').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());
        googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_vertical', [620, 70], 'div-gpt-ad-1454097301091-1').setTargeting('verticales', []).setTargeting('rcnmundo', []).addService(googletag.pubads());



//nuevos ads
googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_BarraExpander_DM', [[320, 100], [320, 50], [728, 90]], 'div-gpt-ad-1490918175179-0').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_FooterBanner_970x90_D', [[320, 100], [320, 50], [728, 90], [990, 90], [970, 90]], 'div-gpt-ad-1490918175179-1').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina1_300x250_DM', [[320, 100], [300, 250], [320, 50]], 'div-gpt-ad-1493223195217-0').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina2_300x250_DM', [[320, 100], [320, 50], [300, 250]], 'div-gpt-ad-1490918175179-3').addService(googletag.pubads());
	googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_FooterBanner_970x90_D', [[320, 100], [320, 50], [728, 90], [990, 90], [970, 90]], 'div-gpt-ad-1490918175179-1').addService(googletag.pubads());

        googletag.pubads().enableSingleRequest();
        googletag.pubads().collapseEmptyDivs();
        googletag.enableServices();
        googletag.display('div-gpt-ad-1454097059958-0');
        googletag.display('div-gpt-ad-1454097059958-1');
        googletag.display('div-gpt-ad-1454097059958-2');
        googletag.display('div-gpt-ad-1454097059958-3');
        googletag.display('div-gpt-ad-1454097059958-4');
        googletag.display('div-gpt-ad-1454097059958-5');
        googletag.display('div-gpt-ad-1454097059958-6');
        googletag.display('div-gpt-ad-1454097176162-0');
        googletag.display('div-gpt-ad-1454097176162-1');
        googletag.display('div-gpt-ad-1454097176162-2');
        googletag.display('div-gpt-ad-1454097176162-3');
        googletag.display('div-gpt-ad-1454097176162-4');
        googletag.display('div-gpt-ad-1454097176162-5');
        googletag.display('div-gpt-ad-1454097301091-0');
        googletag.display('div-gpt-ad-1454097301091-1');
    });
    jQuery('.btn_windowstation').click(function(){
        calltagsdfp();
    });
    function closeBottomDfp(){
    $('#fijoalscroll').hide();
    }
    $(document).ready(function() {
        setTimeout(closeBottomDfp, 20000);
        $('#fijoalscroll').css({'position':'fixed', 'bottom': '0', 'left' : '0', 'padding-top' : '36px', 'width' : '100%','z-index':'9999'});
        $('#fijoalscroll').append('<div id="closeDfpBottom" style="width:30px; height:30px; position:absolute; top:0; left:50%; margin-left:-15px;-webkit-border-radius: 15px; -moz-border-radius: 15px;border-radius: 15px; color:#999; border:2px solid #999; overflow:hidden; background:#ddd; text-align:center; font-size:20px; line-height:28px; cursor:pointer">X</div>');
        $('#closeDfpBottom').click(closeBottomDfp);
    });
    </script>
    <?php wp_footer();?>
</body>
</html>
