<?php
/**
 * Template Name: MIN WIDTH STATION
 */
?>
<!doctype html>
<html ng-app='rcnmundo'>
<head>
<meta charset="UTF-8">
<title><?php wp_title( '|', true, 'right' ); ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link href="<?php echo get_template_directory_uri();?>/style.css?vcs=1.03" rel="stylesheet" type="text/css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/player/7_8/jwplayer.js"></script>
<script type="text/javascript">jwplayer.key="mzqFXqxXUk6JypE7VjMtK/bWFFPLfrELwYWoNg==";</script>
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
<?php 
$post = get_post($_GET['id']); 
$id = $post->ID;
$slug = $post->post_name;
$name = $post->post_title;
$station = get_post_meta($id, 'station',true);
$url = get_post_meta($id, 'site',true);
$urlstream = get_post_meta($id, 'url_stream',true);
$idcast = get_post_meta($id, 'idcast',true);
$picstation =  wp_get_attachment_image_src( get_post_thumbnail_id($id), 'thumbnail' );
?>
<style>
#logo{ padding: 10px 0px 5px 0px;}
div.item .nowstation{ width: 55%;}
div.item .nowstation{ min-height: 90px;}
.ticker_station{ background:rgba(0,0,0,0.6); color: #FFF; font-size: 13px; padding: 10px 0px; margin-top: 5px; height: 30px;}
.ticker_station a{ color: #FFF;}
.ticker_station h1{ float: left; padding: 0px 10px;
    border-right: 2px #fff solid;
    margin-right: 15px;}
.ticker_station marquee{ float: left;     width: 67%;}
.carousel-indicators{ bottom: 10px;}
</style>
<body class="tagwindow radio-<?php echo $slug; ?>">
	<div class="container">
    	<div class="row">
            <main>
                <div id="media">
                    <?php if(!$_GET['player']): ?>
                        <div id="stream"></div>
                    <?php endif; ?>
                    <div id="station">
                        <div id="info_station" >
                            <div id="myCarousel" class="carousel slide" data-ride="carousel">
                                <!-- Indicators -->
                                <ol class="carousel-indicators">
                                  <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
                                  <li data-target="#myCarousel" data-slide-to="1"></li>
                                </ol>
                            
                                <!-- Wrapper for slides -->
                                <div class="carousel-inner" role="listbox">
                                  <div class="item active">
                                    <div class="sm_station">
                                        <?php
                                        if(!empty($picstation)){ ?>
                                            <img src="<?php echo $picstation[0]; ?>" class="logoRadio" />
                                        <?php }
                                        ?>
                                            <div class="nowstation"><p></p></div>
                                            <div class="panelradio">
                                                <h1><?php echo $station; ?></h1><h2><?php echo $name; ?></h2>
                                                <span><a href="http://<?php echo $url; ?>" target="_blank"><?php echo $url; ?></a></span>
                                            </div>
                                            <div class="zocalo">
                                                <div class="adunit" data-adunit="RCNMUNDO/RCNMUNDO_segmentado/Mediobanner_desktop" data-dimensions="320x50"></div>
                                            </div>
                                        </div>
                                  </div>
                                  <div class="item">
                                    <div class="mediumrectangle_station">
                                        <div class="adunit" data-adunit="RCNRADIO/RCNRADIO_Home/RCNRADIO_Home_300x250" data-dimensions="300x250"></div>
                                        <div class="adunit" data-adunit="RCNRADIO/RCNRADIOMOBILE/RCNRADIO_MOBILE_300X250" data-dimensions="300x250"></div>
                                    </div>
                                  </div>
                                </div>
                              </div>
                        </div>
                    </div>
                    <div id="btn_large"><img src="<?php echo get_template_directory_uri();?>/img/btn_large.png?v=2" /></div>
                </div>
            </main>
            <div id="logo"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" /></div>            
            <?php /*?><div class="ticker_station">
                <h1>NOTICIAS</h1>
                <marquee>
                <?php 
                    $url = "http://rcnmundo.cimacast.com/page.php";
                    $xml = simplexml_load_file($url);
                    foreach ($xml->channel->item as $elx) { ?>
                        <a href="<?php echo $elx->link; ?>" target="_blank"><?php echo $elx->title; ?></a> &bull; 
                    <?php }
                ?>
                </marquee>
            </div><?php */?>
        </div>
    </div>
<script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
<script src="<?php echo get_template_directory_uri();?>/js/jquery.dfp.js"></script>
<?php if(!$_GET['player']): ?>
    <script type="text/javascript">
        $.dfp({dfpID: 62207337});
        function correct(){
            var hstation = $('#stream').outerHeight() - 34;
            var wstation = $('#media').outerWidth()-2;
            $('#station').css('width',wstation+'px');
            $('#info_station').css('height',hstation+'px');
            $('.item').css('height',hstation+'px');
        }
        function nowstation(){
            $.ajax({
              type:     "GET",
              url:      "http://www.rcnmundo.com/cover_new.php?id=<?php echo $_GET['id']; ?>",
              success: function(data){
                var nowinfostation = data;
                console.log(nowinfostation);
                imapic = nowinfostation.nowstation.pic;
                text = nowinfostation.nowstation.title;
                if(text.length> 3){
                    $('.nowstation p').html(text);
                }else{
                    $('.nowstation p').html('Estás escuchando...');
                }
                if(imapic){
                    $('.logoRadio').attr('src',imapic);
                }
              }
            });    

        }       

        var playerInstance = jwplayer("stream");
        playerInstance.setup({
                primary:'html5',
                file: '<?php echo $urlstream; ?>' ,
                autostart: true,
                width: "100%",
                height: 350,
                skin: "stormtrooper",
                mute:true,
                advertising: {
                    client: "googima",
                    tag:'https://pubads.g.doubleclick.net/gampad/ads?sz=400x300|640x480&iu=/205320464/RCNMUNDO/VIDEO/RCNMUNDO_Video_Prerroll_DM&impl=s&gdfp_req=1&env=vp&output=vast&unviewed_position_start=1'
                },
                events: {
                    onPlay: function (event) {
                        correct();
                        $('#station').fadeIn('fast');
                        nowstation();
                    }       

               }
            });
        setInterval(function(){ nowstation(<?php echo $idcast ?>);},5000);
    </script>
<?php else: ?>
    <script type="text/javascript">
        $.dfp({dfpID: 62207337});
        function correct(){
            var hstation = '316';
            $('#station').css('width','100%');
            $('#info_station').css('height',hstation+'px');
            $('.item').css('height',hstation+'px');
            $('#station').css('display','block');
        }
        function nowstation(){
            $.ajax({
              type:     "GET",
              url:      "http://www.rcnmundo.com/cover_new.php?id=<?php echo $_GET['id']; ?>",
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
                if(imapic){
                    $('.logoRadio').attr('src',imapic);
                }
              }
            });    

        }       
        nowstation();
    </script>
<?php endif; ?>
</body>
</html>
