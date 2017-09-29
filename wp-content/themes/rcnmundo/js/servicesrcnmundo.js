angular.module('rcnmundoService', [])
	.factory('rcnmundoCustomization', function($http) {
		var newURL = window.location.host + "/" + window.location.pathname;
		var pathArray = newURL.split( "/" );
		var newPathname = "";
		for (i = 0; i < pathArray.length-1; i++) {
			if(pathArray[i]!="")
		  		newPathname += pathArray[i]+"/";
		}

		newPathname=window.location.protocol + "//"+ newPathname;
		//console.log(newPathname);
		var path = newPathname;
		if(path == 'http://www.rcnmundo.com/extension/'){
			path = 'http://www.rcnmundo.com/';
		}
		//var path = 'http://localhost/rcnmundo/';

		path = window.location.protocol + "//"+window.location.host+"/";

		var headers = {
				'Access-Control-Allow-Origin' : '*',
				'Access-Control-Allow-Methods' : 'POST, GET, OPTIONS, PUT',
				'Content-Type': 'application/json',
				'Accept': 'application/json'
			};
		return {
			// get all the categories
			getPosts : function() {				
				global = $http.get(path + 'api/get_posts/','',{withCredentials: true});
				return global;
			},
			getPostById : function(id) {
				global = $http.get(path + 'api/get_post/?post_id='+id,'',{withCredentials: true});
				return global;
			},
			getPostsByCategory : function(id) {				
				global = $http.get(path + 'api/get_category_posts/?category_id='+id,'',{withCredentials: true});
				return global;
			},
			getnewemi : function(id) {	

			
				//global = $http.get(path + 'rds/reload.php?id='+id,'',{withCredentials: true});
				global = $http.get('http://www.rcnmundo.com/rds/reload.php?id='+id,'',{withCredentials: true});
				return global;
			},

			// getPostsByXml : function(urlxml) {			
			// 	global = $http.get(urlxml);
			// 	return global;
			// },

			getPostsByXml : function(urlxml) {
				global = $http.get(urlxml,'',{headers: headers});			
				return global;
			},
		}

	});