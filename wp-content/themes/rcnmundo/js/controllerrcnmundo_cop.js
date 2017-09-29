var x2js = new X2JS();
var rcnmundo = angular.module('rcnmundo', ['ngRoute','rcnmundoService','ngDialog','ngSanitize']);

rcnmundo.config(function($routeProvider, $locationProvider) {
  $routeProvider
  .when('/emisora/:emisoraId/', {
    controller: 'EmisoraController'
  })
  .when('/emisoraid/:emisoraId/:virtualId/', {
    controller: 'EmisoraidController'
  })
  .when('/', {
    controller: 'HomeidController'
  });

});


rcnmundo.controller('HomeidController', function($scope, $sce, rcnmundoCustomization, $http, ngDialog){
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

						$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.carouFredSel.js", function () {
							$('#mask').carouFredSel({
							    scroll : {
							        easing            : "elastic",
							        duration        : 1200,
							        pauseOnHover    : true
							    },
							    prev: '#prev',
							    next: '#next',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 80,
							            visible: {
							                min: 4,
							                max: 10
							            }
							        }
							});
							$('#maskr').carouFredSel({
							    auto:false,
							    prev: '#prev_r',
							    next: '#next_r',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 200,
							            visible: {
							                min: 1,
							                max: 3
							            }
							        }
							});
					    });
					//console.log($scope.listrecomend);
				}
			});
		}else{
			$scope.listrecomend = [];
		}
	}

	$scope.changeemisora = function(objemisora){
		console.log(objemisora);
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
				itememisora['imagen'] = value.thumbnail_images.medium.url;
				itememisora['imagenorigin'] = value.thumbnail_images.full.url;
				$scope.tempsteam = '';
				angular.forEach(value.custom_fields.url_stream, function(value, key) {
					$scope.tempsteam  = value;
				});
				itememisora['url_stream'] = $scope.tempsteam;
				$scope.temprss_noticias = '';
				angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
					$scope.temprss_noticias  = value;
				});
				itememisora['rss_noticias'] = $scope.temprss_noticias;
				$scope.xmlcall($scope, $scope.temprss_noticias);
				$scope.temprss_recomendado = '';
				angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
					$scope.temprss_recomendado  = value;
				});
				itememisora['rss_recomendado'] = $scope.temprss_recomendado;
				$scope.xmlcallreco($scope, $scope.temprss_recomendado);
				itememisora['background'] = value.slug;
			  this.push(itememisora);
			}, $scope.listemisoras);
			//console.log('test');
			//console.log($scope.listemisoras);
			var w = angular.element($window);

       $scope.getWindowDimensions = function () {
           return {
               'h': w.height(),
               'w': w.width()
           };
       };

       $scope.$watch($scope.getWindowDimensions, function (newValue, oldValue) {
           $scope.windowHeight = newValue.h;
           $scope.windowWidth = newValue.w;

           console.log($scope.windowWidth);

           if($scope.windowWidth<760){
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

       }, true);

       w.bind('resize', function () {
           $scope.$apply();
       });
		});

	}



	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitial).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		$scope.xmlcall($scope, 'http://wp.localhost/page_e.php');
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
			console.log(value);
			if (value.thumbnail_images.medium != 'undefined' && value.thumbnail_images.medium != null){
				itememisora['imagen'] = value.thumbnail_images.medium.url;
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
			$scope.temprss_noticias = '';
			angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
				$scope.temprss_noticias  = value;
			});
			itememisora['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisora['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisora['rss_recomendado'] = $scope.temprss_recomendado;
			itememisora['idcast'] = $scope.tempidcast;
			itememisora['background'] = value.slug;
			itememisora['stationid'] = value.id;
		  this.push(itememisora);
		}, $scope.listemisoras);
		wmain = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
			if(wmain<760){
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
		//console.log('test');
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
			itememisoravirtual['imagen'] = (typeof value.thumbnail_images.medium.url !== 'undefined' && value.thumbnail_images.medium.url !== null)?value.thumbnail_images.medium.url:'';
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
			itememisoravirtual['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisoravirtual['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisoravirtual['rss_recomendado'] = $scope.temprss_recomendado;
			itememisoravirtual['idcast'] = $scope.tempidcast;
			itememisoravirtual['background'] = value.slug;
			itememisoravirtual['stationradio'] = value.custom_fields.station;
			itememisoravirtual['stationid'] = value.id;
			itememisoravirtual['idcast'] = value.custom_fields.idcast;
		  this.push(itememisoravirtual);
		}, $scope.listemisorasvirtual);
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
        calltagsdfp();
        $.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.mCustomScrollbar.concat.min.js", function () {
        	$('#content_node').mCustomScrollbar();
        });

    };

	//console.log($scope.listemisoras);
});

rcnmundo.controller('EmisoraController', function($scope, $sce, rcnmundoCustomization, $http, ngDialog, $routeParams){

	console.log($routeParams.phoneId);
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

						$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.carouFredSel.js", function () {
							$('#mask').carouFredSel({
							    scroll : {
							        easing            : "elastic",
							        duration        : 1200,
							        pauseOnHover    : true
							    },
							    prev: '#prev',
							    next: '#next',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 80,
							            visible: {
							                min: 4,
							                max: 10
							            }
							        }
							});
							$('#maskr').carouFredSel({
							    auto:false,
							    prev: '#prev_r',
							    next: '#next_r',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 200,
							            visible: {
							                min: 1,
							                max: 3
							            }
							        }
							});
					    });
					//console.log($scope.listrecomend);
				}
			});
		}else{
			$scope.listrecomend = [];
		}
	}

	$scope.changeemisora = function(objemisora){
		console.log(objemisora);
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
				itememisora['imagen'] = value.thumbnail_images.medium.url;
				itememisora['imagenorigin'] = value.thumbnail_images.full.url;
				$scope.tempsteam = '';
				angular.forEach(value.custom_fields.url_stream, function(value, key) {
					$scope.tempsteam  = value;
				});
				itememisora['url_stream'] = $scope.tempsteam;
				$scope.temprss_noticias = '';
				angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
					$scope.temprss_noticias  = value;
				});
				itememisora['rss_noticias'] = $scope.temprss_noticias;
				$scope.xmlcall($scope, $scope.temprss_noticias);
				$scope.temprss_recomendado = '';
				angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
					$scope.temprss_recomendado  = value;
				});
				itememisora['rss_recomendado'] = $scope.temprss_recomendado;
				$scope.xmlcallreco($scope, $scope.temprss_recomendado);
				itememisora['background'] = value.slug;
			  this.push(itememisora);
			}, $scope.listemisoras);
			//console.log('test');
			//console.log($scope.listemisoras);
			var w = angular.element($window);

       $scope.getWindowDimensions = function () {
           return {
               'h': w.height(),
               'w': w.width()
           };
       };

       $scope.$watch($scope.getWindowDimensions, function (newValue, oldValue) {
           $scope.windowHeight = newValue.h;
           $scope.windowWidth = newValue.w;

           console.log($scope.windowWidth);

           if($scope.windowWidth<760){
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

       }, true);

       w.bind('resize', function () {
           $scope.$apply();
       });
		});

	}



	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitial).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		$scope.xmlcall($scope, 'http://wp.localhost/page_e.php');
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
			console.log(value);
			if (value.thumbnail_images.medium != 'undefined' && value.thumbnail_images.medium != null){
				itememisora['imagen'] = value.thumbnail_images.medium.url;
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
			$scope.temprss_noticias = '';
			angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
				$scope.temprss_noticias  = value;
			});
			itememisora['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisora['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisora['rss_recomendado'] = $scope.temprss_recomendado;
			itememisora['idcast'] = $scope.tempidcast;
			itememisora['background'] = value.slug;
			itememisora['stationid'] = value.id;
		  this.push(itememisora);
		}, $scope.listemisoras);
		wmain = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
			if(wmain<760){
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
		//console.log('test');
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
			itememisoravirtual['imagen'] = (typeof value.thumbnail_images.medium.url !== 'undefined' && value.thumbnail_images.medium.url !== null)?value.thumbnail_images.medium.url:'';
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
			itememisoravirtual['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisoravirtual['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisoravirtual['rss_recomendado'] = $scope.temprss_recomendado;
			itememisoravirtual['idcast'] = $scope.tempidcast;
			itememisoravirtual['background'] = value.slug;
			itememisoravirtual['stationradio'] = value.custom_fields.station;
			itememisoravirtual['stationid'] = value.id;
			itememisoravirtual['idcast'] = value.custom_fields.idcast;
		  this.push(itememisoravirtual);
		}, $scope.listemisorasvirtual);
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
        calltagsdfp();
        $.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.mCustomScrollbar.concat.min.js", function () {
        	$('#content_node').mCustomScrollbar();
        });

    };

	//console.log($scope.listemisoras);
});

rcnmundo.controller('EmisoraidController', function($scope, $sce, rcnmundoCustomization, $http, ngDialog, $routeParams){
	console.log('entroooo')
	console.log($routeParams.phoneId);
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

						$.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.carouFredSel.js", function () {
							$('#mask').carouFredSel({
							    scroll : {
							        easing            : "elastic",
							        duration        : 1200,
							        pauseOnHover    : true
							    },
							    prev: '#prev',
							    next: '#next',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 80,
							            visible: {
							                min: 4,
							                max: 10
							            }
							        }
							});
							$('#maskr').carouFredSel({
							    auto:false,
							    prev: '#prev_r',
							    next: '#next_r',
							    swipe: {
						             onMouse: true,
						             onTouch: true
						         },
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 200,
							            visible: {
							                min: 1,
							                max: 3
							            }
							        }
							});
					    });
					//console.log($scope.listrecomend);
				}
			});
		}else{
			$scope.listrecomend = [];
		}
	}

	$scope.changeemisora = function(objemisora){
		console.log(objemisora);
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
				itememisora['imagen'] = value.thumbnail_images.medium.url;
				itememisora['imagenorigin'] = value.thumbnail_images.full.url;
				$scope.tempsteam = '';
				angular.forEach(value.custom_fields.url_stream, function(value, key) {
					$scope.tempsteam  = value;
				});
				itememisora['url_stream'] = $scope.tempsteam;
				$scope.temprss_noticias = '';
				angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
					$scope.temprss_noticias  = value;
				});
				itememisora['rss_noticias'] = $scope.temprss_noticias;
				$scope.xmlcall($scope, $scope.temprss_noticias);
				$scope.temprss_recomendado = '';
				angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
					$scope.temprss_recomendado  = value;
				});
				itememisora['rss_recomendado'] = $scope.temprss_recomendado;
				$scope.xmlcallreco($scope, $scope.temprss_recomendado);
				itememisora['background'] = value.slug;
			  this.push(itememisora);
			}, $scope.listemisoras);
			//console.log('test');
			//console.log($scope.listemisoras);
			var w = angular.element($window);

       $scope.getWindowDimensions = function () {
           return {
               'h': w.height(),
               'w': w.width()
           };
       };

       $scope.$watch($scope.getWindowDimensions, function (newValue, oldValue) {
           $scope.windowHeight = newValue.h;
           $scope.windowWidth = newValue.w;

           console.log($scope.windowWidth);

           if($scope.windowWidth<760){
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

       }, true);

       w.bind('resize', function () {
           $scope.$apply();
       });
		});

	}



	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitial).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		$scope.xmlcall($scope, 'http://wp.localhost/page_e.php');
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
			console.log(value);
			if (value.thumbnail_images.medium != 'undefined' && value.thumbnail_images.medium != null){
				itememisora['imagen'] = value.thumbnail_images.medium.url;
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
			$scope.temprss_noticias = '';
			angular.forEach(value.custom_fields.rss_noticias, function(value, key) {
				$scope.temprss_noticias  = value;
			});
			itememisora['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisora['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisora['rss_recomendado'] = $scope.temprss_recomendado;
			itememisora['idcast'] = $scope.tempidcast;
			itememisora['background'] = value.slug;
			itememisora['stationid'] = value.id;
		  this.push(itememisora);
		}, $scope.listemisoras);
		wmain = window.innerWidth || document.documentElement.clientWidth || document.body.clientWidth;
			if(wmain<760){
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
		//console.log('test');
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
			itememisoravirtual['imagen'] = (typeof value.thumbnail_images.medium.url !== 'undefined' && value.thumbnail_images.medium.url !== null)?value.thumbnail_images.medium.url:'';
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
			itememisoravirtual['rss_noticias'] = $scope.temprss_noticias;
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisoravirtual['idcast'] = $scope.tempidcast;
			$scope.tempidcast = '';
			angular.forEach(value.custom_fields.idcast, function(value, key) {
				$scope.tempidcast  = value;
			});
			itememisoravirtual['rss_recomendado'] = $scope.temprss_recomendado;
			itememisoravirtual['idcast'] = $scope.tempidcast;
			itememisoravirtual['background'] = value.slug;
			itememisoravirtual['stationradio'] = value.custom_fields.station;
			itememisoravirtual['stationid'] = value.id;
			itememisoravirtual['idcast'] = value.custom_fields.idcast;
		  this.push(itememisoravirtual);
		}, $scope.listemisorasvirtual);
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
        calltagsdfp();
        $.getScript("http://wp.localhost/wp-content/themes/rcnmundo/js/jquery.mCustomScrollbar.concat.min.js", function () {
        	$('#content_node').mCustomScrollbar();
        });

    };

	//console.log($scope.listemisoras);
});

