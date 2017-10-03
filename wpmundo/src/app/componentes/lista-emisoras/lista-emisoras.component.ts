import { Component, OnInit } from '@angular/core';
import { FormGroup, FormControl, Validators, FormArray } from "@angular/forms";

import { EmisorasService } from "../../service/emisoras.service";
import { NoticiasService } from "../../service/noticias.service";
import { Emisora } from "../emisora";
import { Post } from "../post";
import { Categoria } from "../categoria";
import { Noticia } from "../noticia";


@Component({
  selector: 'app-lista-emisoras',
  templateUrl: './lista-emisoras.component.html',
  styleUrls: ['./lista-emisoras.component.css'],
  providers: [EmisorasService]
})

export class ListaEmisorasComponent implements OnInit {

  urlActual:string = "http://wp.localhost";

  forma:FormGroup;

  categorias:Categoria[];
  posts: Post[];
  arregloEmisora:Array<Emisora>;
  allCategorias:Array<Categoria>;
  ciudades:Array<Categoria>;
  selectedValue:number;
  arregloSeleccionado:Emisora[];
  urlStream;
  noticias:Noticia[];
  ngOnInit() {}


  constructor(public _es:EmisorasService, public _not:NoticiasService) {


    this.forma = new FormGroup({
      'ciudad': new FormControl()
    });

    this._es.getEmisoras(this.urlActual+'/wp-json/wp/v2/categories/?per_page=100')
    .subscribe(res => {
      this.categorias = res;
      this.allCategorias = this._es.crearObjCatergorias(this.categorias);
      this.ciudades = this.getCiudades(this.allCategorias);
    });

    this.ciudadActiva(11);



  }

  ciudadActiva(_id){

    this._es.getEmisoras(this.urlActual+'/wp-json/wp/v2/posts?categories='+ _id)
    .subscribe(res => {
      this.posts = res;
      this.arregloEmisora = this._es.crearObjEmisora(this.posts);
     });

  }


  getCiudades(cat:Categoria[]):Categoria[]{
    let Ciudad:Array<Categoria> = [];
    for (var c of cat) {
      if (c.parent == 2){
        Ciudad.push(c);
      }
    }

    return Ciudad;

  }

  cargarEmisora(e:Emisora){
    this.urlStream = e.player;
    this.traerNoticas(e.site);
  }


  traerNoticas(url){
    this._not.getJson(url).subscribe(res => {
      this.noticias = res;
    })

  }

}
