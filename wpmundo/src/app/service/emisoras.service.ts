import { Injectable } from '@angular/core';

import { Http, Response } from '@angular/http';
import { Observable } from 'rxjs/Observable';
import 'rxjs/add/operator/map';
import { Emisora } from '../componentes/emisora';
import { Categoria } from '../componentes/categoria';

@Injectable()
export class EmisorasService {

  private emisoraUrl = "";

  constructor(private _http:Http) { }

  getEmisoras(_url): Observable<any>{
    return this._http.get(_url).map((res: Response) => res.json());
  }

  crearObjEmisora(post){

    let ArregloPost:Emisora[] = [];

    for (let p of post) {
      var id = p.id;
      var slug = p.title.rendered;
      var cat:Array<any> = p.categories;
      var link = p.link;
      var urlJson = p._links['wp:featuredmedia']['0']['href'];
      var player = p.meta.url_stream;
      var site = p.meta.site;
      var dial = p.meta.station;

      let jsonIMG;
      var imgEmisora;
      let e = new Emisora(id,slug,cat,link,imgEmisora,player,site,dial);

      this.getEmisoras(urlJson).subscribe(res => { jsonIMG = res;
        e.urlImg = jsonIMG.source_url;

      });

      ArregloPost.push(e);
    }

    return ArregloPost;
  }

  crearObjCatergorias(post){
    // console.log(post);
    let ArregloPost:Categoria[] = [];
    for (var i = 0; i < post.length; i++) {

      var id = post[i].id;
      var name = post[i].name;
      var parent = post[i].parent;
      var link = post[i].link;

      let c = new Categoria(id,name,parent,link);
      ArregloPost.push(c);
    }
    // console.log(ArregloPost);
    return ArregloPost;
  }


}
