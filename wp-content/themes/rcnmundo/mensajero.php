<?php
/**
 * Template Name: MENSAJERO
 */
$post = get_post($_GET['id']); 
$idr = $post->ID;
$slugr = $post->post_name;
$namer = $post->post_title;
?>
<!doctype html>
<html ng-app='rcnmundo'>
<head>
<meta charset="UTF-8">
<title>MENSAJERO RCN MUNDO | <?php echo $title; ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link href="<?php echo get_template_directory_uri();?>/style.css?vcs=1.03" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<meta property="og:site_name" content="RCN MUNDO" />
<meta property="og:url" content="<?php echo get_bloginfo('url'); ?>/mensajero-rcnmundo/?id=<?php echo $idr; ?>" />
<meta property="og:title" content="MENSAJERO RCN MUNDO | <?php echo $namer;?>" />
<meta property="og:description" content="MENSAJERO RCN MUNDO." />
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
</head>
<body class="tagwindow radio-<?php echo $slugr; ?>">
    <div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/es_LA/sdk.js#xfbml=1&version=v2.5&appId=443823855811130";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
	<div class="container">
    	<div class="row">
            <div id="logo"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" /></div>
            <section id="formmensajero">
                <div class="ads_mensajero">
                    <div class="adunit" data-adunit="RCNMUNDO/RCNMUNDO_segmentado/Megabanner_top_desktop" data-dimensions="728x90"></div>
                </div>
                <div class="form_msj">
                    <h1>MENSAJERO EN <?php echo $namer; ?></h1>
                    <h3>Ahora su mensaje aparecerá por Sistema de Radio</h3>
                    <div class="form_msj_stream">
                       <div class="fb-comments" data-href="<?php echo get_bloginfo('url').'/'.$slugr; ?>" data-width="540" data-numposts="1" data-colorscheme="dark"  
data-order-by="reverse_time"></div>
                    </div>
                    <div class="text_form">
                    <?php while ( have_posts() ) : the_post(); 
                        the_content(); 
                    endwhile; ?>
                    </div>
                </div>
            </section>
        </div>
    </div>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.dfp.js"></script>
<script type="text/javascript">
    $.dfp({dfpID: 62207337});
</script>
</body>
</html>
