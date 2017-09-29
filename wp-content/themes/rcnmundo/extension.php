<?php /* Template Name: extension */ ?>
<!doctype html>
<html ng-app='rcnmundo'>
<head>
<meta charset="UTF-8">
<title>Radio de Colombia | RCN MUNDO | Emisoras de RCN Radio</title>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<link href='https://fonts.googleapis.com/css?family=Lato:100,300,400,700' rel='stylesheet' type='text/css'>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/bootstrap.min.css">
<link href="<?php echo get_template_directory_uri();?>/style.css?cv=2.3" rel="stylesheet" type="text/css">
<link href="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.css" rel="stylesheet" type="text/css"/>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.26/angular-sanitize.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/ngDialog.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/xml2json.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/servicesrcnmundo.js?v=0.4"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/angular-route.min.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/player/jwplayer.js"></script>
<script language="JavaScript" type="text/javascript" src="<?php echo get_template_directory_uri();?>/js/controllerrcnmundo_extension.js?v=1299"></script>
<script type="text/javascript">jwplayer.key="mzqFXqxXUk6JypE7VjMtK/bWFFPLfrELwYWoNg==";</script>
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-default.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-theme-plain.css">
<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/ngDialog-custom-width.css">
<?php wp_head();?>

</head>

<body ng-controller="HomeidController" class="radio-{{background}}">
<div class="container" style="width:400px !important;">
    <section class="header_station">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="row">
                    <div id="logo" class="logo"><img src="<?php echo get_template_directory_uri();?>/img/logo.png" /></div>
                    <div id="dd" class="wrapper-dropdown-1 box_city" tabindex="1">
                            <span>SELECCIONAR CIUDAD</span>
                        <ul class="dropdown" tabindex="1" id="ciudades">
                            <?php
                            $args = array('child_of' => 2);
                            $categories = get_categories( $args );
                            foreach($categories as $category) { ?>
                                <li ng-click="filtro(<?php echo($category->term_id); ?>)"  style="color:black;"><?php echo $category->name; ?></li> 
                           <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--header-->
    <section class="content_station">
        <div class="row">
            <nav class="col-md-12 col-sm-12">
                <div class="row">
                    <ul >
                        <li ng-repeat="objlist in listemisoras"><img src="{{objlist.imagen}}" ng-click="changeemisora(objlist)"/></li>
                    </ul>
                    <div class="virtual col-md-12">
                        <h1>EMISORAS VIRTUALES</h1>
                        <div class="e_station">
                            <div id="prev"><span class="glyphicon glyphicon-chevron-left"></span></div>
                            <div id="next"><span class="glyphicon glyphicon-chevron-right"></span></div>
                            <div id="mask">
                                <div class="item_e" ng-repeat="listvirtualobj in listemisorasvirtual">
                                    <img ng-src="{{listvirtualobj.imagen}}" ng-click="changeemisora(listvirtualobj)"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </div>
    </section>
    <div id="stream-url" stream=""></div>
    <iframe id="station-iframe" src="" width="100%" height="100%" frameborder="0"></iframe>
    <div id="back" style="display:none; cursor:pointer;" ng-click="back_start()"><b>Volver</b></div>       
</div>
<?php wp_footer();?>
    <script src="<?php echo get_template_directory_uri();?>/js/bootstrap.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.dfp.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.carouFredSel.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/jquery.mCustomScrollbar.concat.min.js"></script>
    <script src="<?php echo get_template_directory_uri();?>/js/init_extension.js?cv=4."></script>
</body>
</html>
