import {Injectable, Inject} from '@angular/core';
import {Http, Response} from '@angular/http';
import { Headers, RequestOptions } from '@angular/http';
import {Observable} from 'rxjs/Observable';
import 'rxjs/add/operator/catch';
import 'rxjs/add/operator/map';
import { DOCUMENT } from '@angular/platform-browser';

import {Noticia} from '../componentes/noticia';

@Injectable()
export class NoticiasService {
	// tslint:disable-next-line:indent
	constructor(private _http: Http, @Inject(DOCUMENT) private document: any) { }


	getNoticias(_url,noticia:boolean){
		var comp:string = "wp-json/wp/v2/posts";
		let ObjJson;

		// petición por get a esa url de un api rest de pruebas
		if (noticia) {
			ObjJson = this._http.get(_url+comp).map(res => res.json());
		}else{
			ObjJson = this._http.get(_url).map(res => res.json());
		}

		return ObjJson;
	}

	crearObjNoti(_json){

		let ArregloNoticias:Noticia[] = [];

    	for (let i = 0; i < _json.length; i++) {

			var id = _json[i].id;
			var titulo:string = _json[i].title.rendered;
			titulo = this.arreglarStrings('&#8216;','"', titulo);
			titulo = this.arreglarStrings('&#8217;','"', titulo);
			titulo = titulo.substr(0,71);

			var teaser: string = _json[i].excerpt.rendered;
			var fecha:Date = _json[i].date;
			var rutaUrl = _json[i].link;
			var logoMarca = _json[i].logomarca;
			var imgjson;
			if(_json[i]._links['wp:featuredmedia']){
				imgjson = _json[i]._links['wp:featuredmedia']['0']['href'];
			}else{
				imgjson = "http://image.rcn.com.co.s3.amazonaws.com/rcnradio/prev2.jpg";
			}

			var contenido = _json[i].content.rendered;
			let jsonIMG;

			let n = new Noticia(id, titulo.substring(0,73) ,teaser.substring(0,78) ,fecha , rutaUrl,logoMarca , imgjson ,contenido);
			if(imgjson != "http://image.rcn.com.co.s3.amazonaws.com/rcnradio/prev2.jpg"){
				this.getNoticias(imgjson, false).subscribe(res => { jsonIMG = res;
					n.urlImg = jsonIMG.source_url;
				  });
			}else{
				n.urlImg = imgjson;
			}


    		ArregloNoticias.push(n);
		}
		return ArregloNoticias;
	}

//Crea una lista completa y la ordena
	crearListaCompleta(noti1: Noticia[] ,noti2: Noticia[]){
		let ArregloNoticias1:Noticia[] = [];

		for (const _n of noti1)
		{ArregloNoticias1.push(_n);

		}

		for (const _n2 of noti2)
		{ArregloNoticias1.push(_n2);
		}


		var n = ArregloNoticias1.length;
		var k;


		for (var m = n; m >= 0; m--)
		{
			for (var i = 0; i < n - 1; i++) {
				k = 1 +i;
				if(ArregloNoticias1[i].dateNoti < ArregloNoticias1[k].dateNoti)
				{
					this.swapElements(i,k, ArregloNoticias1);
				}
			}


		}
		return ArregloNoticias1;

	}

	 swapElements(i: number, j: number, arg: Noticia[]){
		var temp;
		temp = 	arg[i];
		arg[i] = arg[j];
		arg[j] = temp;

	}
	addImagenJson(allnoti){
		let errorMessage;
		for (let i = 0; i < allnoti.length; i++) {
			let imgDatos;
			let valor:string = allnoti[i].urlImg;
			if (valor === 'sinImagen'){
				allnoti[i].urlImg = 'http://image.rcn.com.co.s3.amazonaws.com/rcnradio/prev2.jpg';
			}else{
				this.getNoticias(valor,false).subscribe(
					result => {
						imgDatos = result;
						allnoti[i].urlImg = imgDatos.source_url;

					},
					error => {
						errorMessage = <any>error;
						if (errorMessage !== null){
							allnoti[i].urlImg = 'http://image.rcn.com.co.s3.amazonaws.com/rcnradio/prev2.jpg';
							console.log(errorMessage);
						}
					});
			}
		}
	return allnoti;
	}

	arreglarStrings(_dato, _remplazo, _string:string){
		let StringArreglado = _string.replace(_dato,_remplazo);
		return StringArreglado;
	}
}