<!DOCTYPE>
<html>
<head>
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	<meta http-equiv="content-type" content="text/html; charset=utf-8">
    <link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
<?php wp_head();?>


    <!-- Begin comScore Tag -->
    <script>
      var _comscore = _comscore || [];
      _comscore.push({ c1: "2", c2: "14444496" });
      (function() {
        var s = document.createElement("script"), el = document.getElementsByTagName("script")[0]; s.async = true;
        s.src = (document.location.protocol == "https:" ? "https://sb" : "http://b") + ".scorecardresearch.com/beacon.js";
        el.parentNode.insertBefore(s, el);
      })();
    </script>
    <noscript>
      <img src="http://b.scorecardresearch.com/p?c1=2&c2=14444496&cv=2.0&cj=1" />
    </noscript>
    <!-- End comScore Tag -->
    
    
	<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/servicesrcnmundo.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular-route.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/player/jwplayer.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/controllerrcnmundo.js"></script>
<script type="text/javascript">jwplayer.key="mzqFXqxXUk6JypE7VjMtK/bWFFPLfrELwYWoNg==";</script>
</head>
<body ng-controller="HomeidController" style="background-color:{{background}}">
	<header>
		<div class="container">
        	<div class="col-md-3">
            	<div id="logo"><a href="<?php bloginfo( 'url' ); ?>"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" /></a></div>
            	<div class="box_city">SELECCIONAR CIUDAD</div>
            </div>
            <div id="top_ads" class="col-md-9">
            	<div class="leaderboard"><div class="adunit" data-adunit="RCNRADIO/RCNRADIO_Home/RCNRADIO_Home_728x90" data-dimensions="728x90"></div></div>
            </div>
        </div>
	</header>