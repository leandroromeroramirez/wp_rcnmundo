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
<link href="<?php echo get_template_directory_uri();?>/style.css?vcs=1.86" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/ngDialog.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/xml2json.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/servicesrcnmundo.js?v=0.3"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular-route.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/controllerrcnmundo.js?vea=1.60"></script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-default.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-plain.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-custom-width.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/owl-carousel/owl.carousel.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/owl-carousel/owl.theme.css">
<?php wp_head();?>
<script type='text/javascript'>
  (function() {
    var useSSL = 'https:' == document.location.protocol;
    var src = (useSSL ? 'https:' : 'http:') +
        '//www.googletagservices.com/tag/js/gpt.js';
    document.write('<scr' + 'ipt src="' + src + '"></scr' + 'ipt>');
  })();
</script>
<script type='text/javascript'>
  googletag.cmd.push(function() {
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_top_desktop', [728, 90], 'div-gpt-ad-1448544849910-4').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_1', [300, 250], 'div-gpt-ad-1448544849910-5').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Mediobanner_desktop', [320, 50], 'div-gpt-ad-1448544849910-3').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_2', [300, 250], 'div-gpt-ad-1448544849910-6').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Footerbanner_desktop', [[970, 90], [728, 90]], 'div-gpt-ad-1448544849910-1').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_horizontal', [728, 90], 'div-gpt-ad-1449187323721-0').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_vertical', [620, 70], 'div-gpt-ad-1449187323721-1').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_mobile_2', [300, 250], 'div-gpt-ad-1449085812675-0').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/MegaBanner_mobile', [320, 50], 'div-gpt-ad-1448545222458-2').addService(googletag.pubads());
    googletag.defineSlot('/62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_mobile', [300, 250], 'div-gpt-ad-1448545222458-3').addService(googletag.pubads());
	
	
//nuevos ads	
googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_BarraExpander_DM', [[320, 100], [320, 50], [728, 90]], 'div-gpt-ad-1490918175179-0').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_FooterBanner_970x90_D', [[320, 100], [320, 50], [728, 90], [990, 90], [970, 90]], 'div-gpt-ad-1490918175179-1').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina1_300x250_DM', [[320, 100], [300, 250], [320, 50]], 'div-gpt-ad-1493223195217-0').addService(googletag.pubads());
    googletag.defineSlot('/205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina2_300x250_DM', [[320, 100], [320, 50], [300, 250]], 'div-gpt-ad-1490918175179-3').addService(googletag.pubads());
	
		
	
    googletag.pubads().enableSingleRequest();
    googletag.pubads().enableSingleRequest();
    googletag.pubads().collapseEmptyDivs();
    googletag.pubads().enableSyncRendering();
    googletag.enableServices();
  });
</script>
</head>

<body ng-controller="HomeidController" class="radio-{{background}}">
<div class="top_mobile">
   <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/MegaBanner_mobile -->
    <div id='div-gpt-ad-1448545222458-2'>
    <script type='text/javascript'>
    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1448545222458-2'); });
    </script>
    </div>
</div>
<div id="wrapper" style="background-image:url(<?php echo get_template_directory_uri();?>/img/380.gif); background-repeat:no-repeat; background-position:center center">
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
                        <div id='div-gpt-ad-1490918175179-0'>
                        <script>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-0'); });
                        </script>
                        </div>
                        <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_horizontal -->
                        <div id='div-gpt-ad-1449187323721-0' style='height:90px; width:728px;'>
                        <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1449187323721-0'); });
                        </script>
                        </div>
                        <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Megabanner_tablet_vertical -->
                        <div id='div-gpt-ad-1449187323721-1' style='height:70px; width:620px;'>
                        <script type='text/javascript'>
                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1449187323721-1'); });
                        </script>
                        </div>
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
                            <li ng-repeat="objlist in listemisoras"><img src="{{objlist.imagen}}" ng-click="changeemisora(objlist)"/></li>
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
                    <div class="mensajero col-md-12">
                        <marquee behavior="scroll" direction="left">
                            Que nada haga cambiar lo maravilloso que hay en ti Olga Fernanda Flandes Tolima 
                            &bull; Los EE UU intervienen . forman los conflictos y se los dejan al resto del mundo
                            &bull; ELFUTBALL PROGRAMA PARA RAZAS DE BAJO COEFICIENTA OBRERAS
                            &bull; Hola a todos Un saludo desde Lanzarote, Islas Canarias. Viva Buga ;-)
                            &bull; GOBIERNO COLOMBIANO ARRODILLADO ANTE LA FARC
                            &bull; lo unico bueno de mexico son los mariachis y el chavo del ocho olvidamos muy fac
                            &bull; Fuga de cerebros en Venezuela? Cuidado se fuga Maduro y llega a Colombia.
                        </marquee>
                        <img src="<?php echo get_template_directory_uri();?>/img/ico_mensajero.png" />
                    </div>
                </div>
            </nav>
            <main class="col-md-9 col-sm-8">
                <div id="media">
                    <div id="stream"></div>
                    <div id="coverradiomb">
                        <img ng-src="{{imagenlogoradioact}}" />
                        <div class="panelradio">
                            <h1>{{stationradio}}</h1><h2>{{stationname}}</h2>
                            <div class="btn_play">PLAY</div>
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
                                        <img ng-src="{{imagenlogoradioact}}" class="logoRadio" />
                                        <div class="nowstation" data-id="{{idcast}}">
                                            <p>{{dataemi}}</p>
                                            <div class="socialradio">
                                                <!--<a href="{{fb}}" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/fb.png" /></a>
                                                <a href="{{tw}}" target="_blank"><img src="<?php echo get_template_directory_uri();?>/img/tw.png" /></a>-->
                                                <a href="http://www.facebook.com/share.php?s=100&p[url]=http://www.rcnmundo.com/&p[images][0]=http://www.rcnmundo.com/movil/img/p.gif&p[title]=Escuchando  -  en @ por www.rcnmundo.com/" title="Compartir en Facebook" onClick="javascript:window.open(this.href, '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=400,width=600');return false;">
                                                <img src="<?php echo get_template_directory_uri();?>/img/fb.png" /></a>
                                                <a href="https://twitter.com/intent/tweet?text=Escuchando  -  en @ por @rcnmundo&amp;url=http://www.rcnmundo.com/" target="_blank">
                                                <img src="<?php echo get_template_directory_uri();?>/img/tw.png" /></a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="panelradio">
                                        <h1>{{stationradio}}</h1><h2>{{stationname}}</h2>
                                        <span><a href="{{site}}" target="_blank">{{site}}</a></span>
                                        </div>
                                    <div class="zocalo" style="display:none">
                                       <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Mediobanner_desktop -->
                                        <div id='div-gpt-ad-1448544849910-3'>
                                        <script type='text/javascript'>
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1448544849910-3'); });
                                        </script>
                                        </div>
                                    </div>
                                  </div>
                                  <div class="item">
                                  	<h4 class="tt_ads">Publicidad</h4>
                                    <div class="mediumrectangle_station">
                                                                               
                                        <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina1_300x250_DM -->
                                        <div id='div-gpt-ad-1490918175179-2'>
                                        <script>
                                        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-2'); });
                                        </script>
                                        </div>
                                        
                                        
                                    </div>
                                  </div>
                                </div>
                            
                              </div>
                        </div>
                        <div id="news" class="col-md-5" ng-show="listnoticias.length != 0">
                            <h1>ÚLTIMAS NOTICIAS</h1>
                            <ul style="overflow: scroll;">
                                <li ng-repeat="noticiasobj in listnoticias">
                                    <a href="{{noticiasobj.link}}" class="pic_news" target="_blank">
                                        <div ng-if="noticiasobj.media == true">
                                            <img ng-src="{{noticiasobj.imagen}}" />
                                        </div>
                                    </a>
                                    <a href="{{noticiasobj.link}}" class="tt_news" target="_blank">{{noticiasobj.title}} </a>
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
        
            <div class="col-md-8 col-sm-7 post">
               <div class="row">
                    <h1 class="btn_windowstation">RECOMENDADOS</h1>
                    <div id="recomended">
                        <div id="prev_r"><img src="<?php echo get_template_directory_uri();?>/img/arrow_left.png" /></div>
                        <div id="next_r"><img src="<?php echo get_template_directory_uri();?>/img/arrow_right.png" /></div>
                        <div id="maskr" class="owl-carousel">
                            <div class="post_f" ng-repeat="objrecom in listrecomend">
                                <a href="#" ng-click="clickToOpen(objrecom)">
                                    <div class="wrapimg"><img ng-src="{{objrecom.imagen}}" /></div>
                                    <div class="tt">
                                        <h3>{{objrecom.title}}</h3>  
                                    </div>
                                </a>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-5" id="mediumrectangle">
                <div class="row">
                    <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_Robapagina2_300x250_DM -->
                    <div id='div-gpt-ad-1490918175179-3'>
                    <script>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-3'); });
                    </script>
                    </div>
                    <!-- /62207337/RCNMUNDO/RCNMUNDO_segmentado/Robapagina_mobile -->
                    <div id='div-gpt-ad-1448545222458-3' class="mobile">
                    <script type='text/javascript'>
                    googletag.cmd.push(function() { googletag.display('div-gpt-ad-1448545222458-3'); });
                    </script>
                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
       
    </section>
    <section class="midle_ad">
        <!-- /205320464/RCNMUNDO/HOME/RCNMUNDO_Home_FooterBanner_970x90_D -->
        <div id='div-gpt-ad-1490918175179-1'>
        <script>
        googletag.cmd.push(function() { googletag.display('div-gpt-ad-1490918175179-1'); });
        </script>
        </div>
    </section>
    <footer>
        <div class="row">
            <ul>
                <li><a href="">Atención al Oyente</a></li>
                <li><a href="">Términos y condiciones</a></li>
                <li><a href="">Política de privacidad</a></li>
                <li><a href="">Copyright RCN Radio © 2015</a></li>
            </ul>
        </div>        
    </footer>
</div>
</div>
<?php wp_footer();?>
    <script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
    <!--<script src="<?php echo get_template_directory_uri();?>/js/jquery.dfp.js"></script>-->
    <script src="<?php echo get_template_directory_uri();?>/js/owl.carousel.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/player/jwplayer.js"></script>
    <script type="text/javascript">jwplayer.key="mzqFXqxXUk6JypE7VjMtK/bWFFPLfrELwYWoNg==";</script>
    <script src="<?php echo get_template_directory_uri();?>/js/init.js?vea=4.75"></script>
    <script type="text/ng-template" id="templatenoticias">
       <div id="content_node">
        <div class="contenido_node">
            <div>
                <h1>{{titleact}}</h1>
            </div>
            <div>
                <img ng-src="{{imagesact}}" alt="" style="width: 100%;margin-top: 15px; margin-bottom: 15px;">
            </div>
            <div ng-bind-html="descact"></div>
            <div>
                <p>{{contact}}</p>
            </div>
        </div>
       </div>
    </script>
    <script src="<?php echo get_template_directory_uri();?>/js/modernizr.custom.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/gnmenu.js"></script>
</body>
</html>
