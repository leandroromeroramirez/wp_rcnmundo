var x2js = new X2JS();
var rcnmundo = angular.module('rcnmundo', ['ngRoute','rcnmundoService']);

rcnmundo.config(function($routeProvider, $locationProvider) {
  $routeProvider
  .when('/emisora/:emisoraId/', {
    controller: 'EmisoraidController'
  })
  .when('/', {
    controller: 'HomeidController'
  });

});


rcnmundo.controller('HomeidController', function($scope, $sce, rcnmundoCustomization, $http){
	$scope.idcategoryinitial = 11;
	$scope.idcategoryinitialvirtual = 4;
	$scope.listemisoras = [];
	$scope.listemisorasvirtual = [];
	$scope.background = 'laradio';
	$scope.stationname = "RCN RADIO";
	$scope.stationradio = "93.9 FM";
	$scope.site = 'www.rcnradio.com';
	$scope.url_stream = '';
	$scope.objstream = '';
	$scope.imagenlogoradioact = 'http://wp.localhost/wp-content/uploads/2015/09/rcnradio1.png';
	$scope.listnoticias = [];
	$scope.listrecomend = [];
	$scope.listnoticiascatgory = [];


	$scope.trustSrc = function(src) {
	    return $sce.trustAsResourceUrl(src);
	  }


	$scope.xmlcall = function($scope, xmlurl){
		console.log(xmlurl);
		rcnmundoCustomization.getPostsByXml(xmlurl).success(function(adata){
			var xmldata = x2js.xml_str2json(adata);
			console.log(xmldata.rss.channel);
			$scope.datarss = xmldata.rss.channel;
			angular.forEach($scope.datarss.item, function(value, key) {
				var itemxml = {};
				itemxml['title'] = value.title;
				itemxml['media'] = false;
				$scope.tempvalue = '';
				if(value.enclosure != undefined){
					if (value.enclosure._type == "audio/mpeg"){
						$scope.tempvalue = value.enclosure._url;
						itemxml['media'] = true;
					}
				}
				itemxml['imagen'] = $scope.tempvalue;
				itemxml['category'] = value.category;
				itemxml['creator'] = value.creator;
				itemxml['descripcio'] = value.description.__cdata;
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
							if (value.enclosure['_type'] == "audio/mpeg"){
								$scope.tempvalue = value.enclosure['_url'];
								itemxml['media'] = true;
							}
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
						itemxml['descripcio'] = value.description.__cdata;
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
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 70,
							            visible: {
							                min: 3,
							                max: 6
							            }
							        }
							});
							$('#maskr').carouFredSel({
							    auto:false,
							    prev: '#prev_r',
							    next: '#next_r',
							    swipe:true,
							    responsive: true,
							        width: '100%',
							        scroll: 3,
							        items: {
							            width: 200,
							            visible: {
							                min: 1,
							                max: 4
							            }
							        }
							});
					    });
					console.log($scope.listrecomend);
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
		$scope.site = objemisora.site;
		$scope.stationname = objemisora.name;
		$scope.imagenlogoradioact = objemisora.imagenorigin;
		$scope.xmlcall($scope, objemisora.rss_noticias);
		$scope.xmlcallreco($scope, objemisora.rss_recomendado);
		if (objemisora.url_stream !='undefined' && objemisora.url_stream != undefined){
			llamado(objemisora.url_stream);
		}

	}

	$scope.filtro = function(idcategoria){
		console.log(idcategoria);
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
				itememisora['station'] = $scope.tempstation;
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
		});

	}



	rcnmundoCustomization.getPostsByCategory($scope.idcategoryinitial).success(function(adata){
		$scope.datarcnmundo = adata.posts;
		$scope.xmlcall($scope, 'http://www.rcnradio.com/feed/');
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
			$scope.temprss_recomendado = '';
			angular.forEach(value.custom_fields.rss_recomendado, function(value, key) {
				$scope.temprss_recomendado  = value;
			});
			itememisora['rss_recomendado'] = $scope.temprss_recomendado;
			itememisora['background'] = value.slug;
		  this.push(itememisora);
		}, $scope.listemisoras);
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
			itememisoravirtual['imagen'] = value.thumbnail_images.medium.url;
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
			itememisoravirtual['rss_recomendado'] = $scope.temprss_recomendado;
			itememisoravirtual['background'] = value.slug;
			itememisoravirtual['stationradio'] = value.custom_fields.station;
		  this.push(itememisoravirtual);
		}, $scope.listemisorasvirtual);
		//console.log($scope.listemisorasvirtual);
	});

	$scope.clickToOpen = function () {
        ngDialog.open({ template: 'templatenoticias.html' });
    };

	console.log($scope.listemisoras);
});

