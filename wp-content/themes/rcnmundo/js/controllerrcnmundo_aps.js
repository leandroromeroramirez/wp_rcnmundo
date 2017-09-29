var x2js = new X2JS();
var rcnmundo = angular.module('rcnmundo', ['ngRoute','rcnmundoService','ngDialog','ngSanitize']);

rcnmundo.config(function($routeProvider, $locationProvider) {
  $routeProvider
	  .when('/', {
	    controller: 'HomeidController'
	  })
	  .when('/emisora/:emisoraId/', {
	    controller: 'EmisoraController'
	  })
	  .when('/emisoraid/:emisoraId/:virtualId/', {
	    controller: 'EmisoraidController'
	  })
	  .otherwise({ redirectTo: '/' });

  $locationProvider.html5Mode(true);
});

rcnmundo.directive('resize', function ($window) {
    return function (scope, element) {
        var w = angular.element($window);
        scope.getWindowDimensions = function () {
            return {
                'h': w.height(),
                'w': w.width()
            };
        };
        scope.$watch(scope.getWindowDimensions, function (newValue, oldValue) {
            scope.windowHeight = newValue.h;
            scope.windowWidth = newValue.w;
            console.log(scope.windowWidth);

            if(scope.windowWidth<460){
					scope.tl = false;
					scope.tr = '100%';
			}else{
					scope.tl = true;
					scope.tr = 200;
			}

			/*if(scope.windowWidth<760){
				$('#ml_emisoras').addClass('owl-carousel');
				$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
					var owl = $("#ml_emisoras");
					owl.owlCarousel({navigation : true, navigationText: false, pagination:false, items:4,itemsMobile:[479,4]});
					$("#next2").click(function(){
    					owl.trigger('owl.next');
  					});
  					$("#prev2").click(function(){
    					owl.trigger('owl.prev');
  					});
				});
			}else{
				$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
					validaclass = $("#ml_emisoras").hasClass("owl-theme");
					if(validaclass) {
						$("#ml_emisoras").data('owlCarousel').destroy();
					}
				});
				$('#ml_emisoras').removeClass('owl-carousel');

			}*/

        }, true);

        w.bind('resize', function () {
            scope.$apply();
        });
    }
});

rcnmundo.controller('EmisoraController', function($scope, $sce, rcnmundoCustomization, $http, ngDialog, $routeParams){

	//console.log($scope.listemisoras);
});

rcnmundo.controller('EmisoraidController', function($scope, $sce, rcnmundoCustomization, $http, ngDialog, $routeParams){
	console.log($routeParams.phoneId);

	//console.log($scope.listemisoras);
});


rcnmundo.controller('HomeidController', function($scope, $sce, rcnmundoCustomization, $http, $rootScope, ngDialog){
	console.log('home-----');
	$scope.idcategoryinitial = 11;
	$scope.idcategoryinitialvirtual = 4;
	$scope.listemisoras = [];
	$scope.listemisorasvirtual = [];
	$scope.background = 'laradio';
	$scope.stationname = "RCN RADIO";
	$scope.stationid = "RCN RADIO";
	$scope.idcast = '001';
	$scope.stationradio = "93.9 FM";
	$scope.fb = "https://www.facebook.com/rcnradio";
	$scope.tw = "https://twitter.com/rcnlaradio";
	$scope.site = 'www.rcnradio.com';
	$scope.url_stream = '';
	$scope.objstream = '';
	$scope.imagenlogoradioact = 'http://wp.localhost/wp-content/uploads/2015/09/rcnradio1.png';
	$scope.listnoticias = [];
	$scope.listrecomend = [];
	$scope.listnoticiascatgory = [];
	$scope.titleact = '';
	$scope.descact = '';


	$scope.trustSrc = function(src) {
	    return $sce.trustAsResourceUrl(src);
	  }


	$scope.xmlcall = function($scope, xmlurl){
		//console.log(xmlurl);
		rcnmundoCustomization.getPostsByXml(xmlurl).success(function(adata){
			var xmldata = x2js.xml_str2json(adata);
			//console.log(xmldata.rss.channel);
			$scope.datarss = xmldata.rss.channel;
			angular.forEach($scope.datarss.item, function(value, key) {
				var itemxml = {};
				itemxml['title'] = value.title;
				itemxml['media'] = false;
				$scope.tempvalue = '';
				if(value.enclosure != undefined){
					/*if (value.enclosure._type == "audio/mpeg"){
						$scope.tempvalue = value.enclosure._url;
						itemxml['media'] = true;
					}*/
						if (value.enclosure['_type'] == "image/jpeg"){
							$scope.tempvalue = value.enclosure._url;
							itemxml['media'] = true;
						}
						if (value.enclosure['_type'] == "image/png"){
							$scope.tempvalue = value.enclosure._url;
							itemxml['media'] = true;
						}
						if (value.enclosure['_type'] == ""){
							$scope.tempvalue = value.enclosure._url;
							itemxml['media'] = true;
						}
				}
				itemxml['imagen'] = $scope.tempvalue;
				itemxml['category'] = value.category;
				itemxml['creator'] = value.creator;
				itemxml['descripcion'] = value.description;
				if(value.hasOwnProperty('__text')){
					itemxml['guid'] = value.guid.__text;
				}else{
					itemxml['guid'] = value.guid;
				}

				itemxml['link'] = value.link;
			  this.push(itemxml);
			}, $scope.listnoticias);

		});
	}

	$scope.xmlcallreco = function($scope, xmlurl){
		$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
			validaclass = $("#maskr").hasClass("feed-news-owl");
			if(validaclass) {
				$("#maskr").data('owlCarousel').destroy();
			}
		});
		if(xmlurl !=''){
			rcnmundoCustomization.getPostsByXml(xmlurl).success(function(adata){
				var xmldatareco = x2js.xml_str2json(adata);
				if (xmldatareco.rss){
					$scope.datarss = xmldatareco.rss.channel;
					angular.forEach($scope.datarss.item, function(value, key) {
						var itemxml = {};
						itemxml['title'] = value.title;
						$scope.tempvalue = '';
						itemxml['media'] = false;
						if(value.enclosure != undefined){
							/*if (value.enclosure['_type'] == "audio/mpeg"){
								$scope.tempvalue = value.enclosure['_url'];
								itemxml['media'] = true;
							}*/
							if (value.enclosure['_type'] == "image/jpeg"){
								$scope.tempvalue = value.enclosure['_url'];
								itemxml['media'] = true;
							}
							if (value.enclosure['_type'] == "image/png"){
								$scope.tempvalue = value.enclosure['_url'];
								itemxml['media'] = true;
							}
						}

						itemxml['imagen'] = $scope.tempvalue;
						itemxml['category'] = value.category;
						itemxml['creator'] = value.creator;
						itemxml['descripcion'] = value.description;
						if(value.hasOwnProperty('__text')){
							itemxml['guid'] = value.guid.__text;
						}else{
							itemxml['guid'] = value.guid;
						}
						itemxml['link'] = value.link;
					  this.push(itemxml);
					}, $scope.listrecomend);
					    $.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
					    	$('#maskr').owlCarousel({navigation : true, navigationText: false, autoPlay : false, pagination:false, items:3,itemsTablet:[768,2],theme:'feed-news-owl'});
						});
					//console.log($scope.listrecomend);
				}
			});
		}else{
			$scope.listrecomend = [];
		}
	}

	$scope.changeemisora = function(objemisora){
		$scope.listnoticias = [];
		$scope.listrecomend = [];
		$scope.background = objemisora.background;
		$scope.url_stream = objemisora.url_stream;
		$scope.stationradio = objemisora.station;
		$scope.fb = objemisora.fb;
		$scope.stw= objemisora.tw;
		$scope.site = objemisora.site;
		$scope.stationname = objemisora.name;
		$scope.idcast = objemisora.idcast;
		$scope.imagenlogoradioact = objemisora.imagenorigin;
		$scope.xmlcall($scope, objemisora.rss_noticias);
		$scope.xmlcallreco($scope, objemisora.rss_recomendado);

		if (objemisora.url_stream !='undefined' && objemisora.url_stream != undefined){
			llamado(objemisora.url_stream,objemisora.stationid);

			rcnmundoCustomization.getnewemi(objemisora.idcast).success(function(idata){
				$scope.dataemi = idata;
			});
		}

	}

	$scope.filtro = function(idcategoria){
		$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
			validaclass = $("#ml_emisoras").hasClass("owl-theme");
			if(validaclass) {
				$("#ml_emisoras").data('owlCarousel').destroy();
			}
		});
		//console.log(idcategoria);
		$scope.listemisoras =[];
		$scope.listnoticias = [];
		$scope.listrecomend = [];
		rcnmundoCustomization.getPostsByCategory(idcategoria).success(function(adata){
			$scope.datarcnmundo = adata.posts;
			angular.forEach($scope.datarcnmundo, function(value, key) {
				var itememisora = {};
				itememisora['name'] = value.title;
				itememisora['url'] = value.url;
				$scope.tempsite = '';
				angular.forEach(value.custom_fields.site, function(value, key) {
					$scope.tempsite  = value;
				});
				itememisora['site'] = $scope.tempsite;
				$scope.tempstation = '';
				angular.forEach(value.custom_fields.station, function(value, key) {
					$scope.tempstation  = value;
				});
				$scope.tempfb = '';
				angular.forEach(value.custom_fields.fb, function(value, key) {
					$scope.tempfb  = value;
				});
				$scope.temptw = '';
				angular.forEach(value.custom_fields.tw, function(value, key) {
					$scope.temptw  = value;
				});
				itememisora['station'] = $scope.tempstation;
				itememisora['fb'] = $scope.tempfb;
				itememisora['tw'] = $scope.temptw;
				itememisora['imagen'] = value.thumbnail_images.full.url;
				itememisora['imagenorigin'] = value.thumbnail_images.full.url;
				$scope.tempsteam = '';
				angular.forEach(value.custom_fields.url_stream, function(value, key) {
					$scope.tempsteam  = value;
				});
				itememisora['url_stream'] = $scope.tempsteam;
				$scope.temprss_noticias = 'https://www.rcnradio.com/feed';
				angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
					$scope.temprss_noticias  = value;
				});
				//itememisora['rss_noticias'] = 'https://www.rcnradio.com/feed';
				itememisora['rss_noticias'] = $scope.temprss_noticias;
				/*$scope.xmlcall($scope, $scope.temprss_noticias);
				$scope.temprss_recomendado = '';
				angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
					$scope.temprss_recomendado  = value;
				});*/
				itememisora['rss_recomendado'] = 'http://wp.localhost/page.php';
				//itememisora['rss_recomendado'] = $scope.temprss_recomendado;
				$scope.xmlcallreco($scope, $scope.temprss_recomendado);
				itememisora['background'] = value.slug;
			  this.push(itememisora);
			}, $scope.listemisoras);
				wmain = $(window).outerWidth();
			if(wmain<760){
				$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
					var owl = $("#ml_emisoras");
					owl.owlCarousel({navigation : true, navigationText: false, pagination:false, items:4,itemsMobile:[479,4],itemsCustom:[550,6]});
					$("#next2").click(function(){
    					owl.trigger('owl.next');
  					});
  					$("#prev2").click(function(){
    					owl.trigger('owl.prev');
  					});
				});
			}
			//console.log('test_658');
			//console.log($scope.listemisoras);
		});

	}



	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitial).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		$scope.xmlcall($scope, 'https://www.rcnradio.com/feed/');
		$scope.xmlcallreco($scope, 'http://wp.localhost/page.php');
		angular.forEach($scope.datarcnmundo, function(value, key) {
			var itememisora = {};
			itememisora['name'] = value.title;
			itememisora['url'] = value.url;
			$scope.tempsite = '';
			angular.forEach(value.custom_fields.site, function(value, key) {
				$scope.tempsite  = value;
			});
			itememisora['site'] = $scope.tempsite;
			$scope.tempstation = '';
			angular.forEach(value.custom_fields.station, function(value, key) {
				$scope.tempstation  = value;
			});
			itememisora['station'] = $scope.tempstation;
			if (value.thumbnail_images.full != 'undefined' && value.thumbnail_images.full != null){
				itememisora['imagen'] = value.thumbnail_images.full.url;
			}else{
				itememisora['imagen'] = '';
			}

			// if (value.thumbnail_images.full != 'undefined' && value.thumbnail_images.full != null){
			// 	itememisora['imagenorigin'] = value.thumbnail_images.full;
			// }else{
			// 	iitememisora['imagenorigin'] = '';
			// }
			itememisora['imagenorigin'] = value.thumbnail_images.full.url;
			$scope.tempsteam = '';
			angular.forEach(value.custom_fields.url_stream, function(value, key) {
				$scope.tempsteam  = value;
			});
			itememisora['fb'] = $scope.tempfb;
			$scope.tempfb = '';
			angular.forEach(value.custom_fields.fb, function(value, key) {
				$scope.tempfb  = value;
			});
			itememisora['tw'] = $scope.temptw;
			$scope.temptw = '';
			angular.forEach(value.custom_fields.tw, function(value, key) {
				$scope.temptw  = value;
			});
			itememisora['url_stream'] = $scope.tempsteam;
			$scope.temprss_noticias = 'https://www.rcnradio.com/feed/';
			angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
				$scope.temprss_noticias  = value;
			});
			//itememisora['rss_noticias'] = 'https://www.rcnradio.com/feed/';
			itememisora['rss_noticias'] = $scope.temprss_noticias;
			/*$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});*/
			itememisora['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisora['rss_recomendado'] = 'http://wp.localhost/page.php';
			//itememisora['rss_recomendado'] = $scope.temprss_recomendado;
			itememisora['idcast'] = $scope.tempidcast;
			itememisora['background'] = value.slug;
			itememisora['stationid'] = value.id;
		  this.push(itememisora);
		}, $scope.listemisoras);
			wmain = $(window).outerWidth();
			if(wmain<760){
				$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
					var owl = $("#ml_emisoras");
					owl.owlCarousel({navigation : true, navigationText: false, pagination:false, items:4,itemsMobile:[479,4],itemsCustom:[550,6]});
					$("#next2").click(function(){
    					owl.trigger('owl.next');
  					});
  					$("#prev2").click(function(){
    					owl.trigger('owl.prev');
  					});
				});
			}
		//console.log('test_378');
		//console.log($scope.listemisoras);
	});

	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitialvirtual).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		angular.forEach($scope.datarcnmundo, function(value, key) {
			var itememisoravirtual = {};
			itememisoravirtual['name'] = value.title;
			itememisoravirtual['url'] = value.url;
			$scope.tempsite = '';
			angular.forEach(value.custom_fields.site, function(value, key) {
				$scope.tempsite  = value;
			});
			itememisoravirtual['site'] = $scope.tempsite;
			$scope.tempstation = '';
			angular.forEach(value.custom_fields.station, function(value, key) {
				$scope.tempstation  = value;
			});
			itememisoravirtual['station'] = $scope.tempstation;
			if (value.thumbnail_images.full != 'undefined' && value.thumbnail_images.full != null){
				itememisoravirtual['imagen'] = value.thumbnail_images.full.url;
			}else{
				itememisoravirtual['imagen'] = '';
			}
			itememisoravirtual['imagenorigin'] = value.thumbnail_images.full.url;
			$scope.tempsteam = '';
			angular.forEach(value.custom_fields.url_stream, function(value, key) {
				$scope.tempsteam  = value;
			});
			itememisoravirtual['url_stream'] = $scope.tempsteam;
			$scope.temprss_noticias = '';
			angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
				$scope.temprss_noticias  = value;
			});
			//itememisoravirtual['rss_noticias'] = 'https://www.rcnradio.com/feed/';
			itememisoravirtual['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = 'https://www.rcnradio.com/feed/';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisoravirtual['idcast'] = $scope.tempidcast;
			/*$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});*/
			itememisoravirtual['rss_recomendado'] = 'http://wp.localhost/page.php';
			//itememisoravirtual['rss_recomendado'] = $scope.temprss_recomendado;
			itememisoravirtual['idcast'] = $scope.tempidcast;
			itememisoravirtual['background'] = value.slug;
			itememisoravirtual['stationradio'] = value.custom_fields.station;
			itememisoravirtual['stationid'] = value.id;
			itememisoravirtual['idcast'] = value.custom_fields.idcast;
		  this.push(itememisoravirtual);
		}, $scope.listemisorasvirtual);
			$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/owl.carousel.js", function () {
				var owl = $("#mask");
				owl.owlCarousel({slideBy: 4,navigation : true, navigationText: false, pagination:false, items:4,itemsMobile:[479,4],itemsCustom:[550,6]});
				$("#next").click(function(){
    				owl.trigger('owl.next');
  				});
  				$("#prev").click(function(){
    				owl.trigger('owl.prev');
  				});
			});
		//console.log($scope.listemisorasvirtual);
	});

	$scope.clickToOpen = function (objselect) {
		//console.log(objselect);
        ngDialog.open({
        	template: 'templatenoticias',
        	controller: ['$scope', function($scope) {
        		$scope.titleact = objselect.title;
        		$scope.imagesact = objselect.imagen;
        		$scope.descact = objselect.descripcion;
        	}]
        });
     	$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.mCustomScrollbar.concat.min.js", function () {
		    console.log('del');
		    $('#content_node').mCustomScrollbar({setHeight:490,documentTouchScroll:false});
		});
		calltagsdfp();
    };

	//console.log($scope.listemisoras);
});



