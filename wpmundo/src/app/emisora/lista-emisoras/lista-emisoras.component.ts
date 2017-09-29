import { Component, OnInit } from '@angular/core';
import { EmisorasService } from "../../service/emisoras.service";
import { Emisora } from "../emisora";

@Component({
  selector: 'app-lista-emisoras',
  templateUrl: './lista-emisoras.component.html',
  styleUrls: ['./lista-emisoras.component.css'],
  providers: [EmisorasService]
})

export class ListaEmisorasComponent implements OnInit {

  emisora:Emisora[];


  constructor(public _es:EmisorasService) {}

    getPosts(){
          this._es.getEmisoras('posts')
        .subscribe(res => {
          this.emisora = res;
        });
    }

    ngOnInit() {
      this.getPosts();
    }

}
