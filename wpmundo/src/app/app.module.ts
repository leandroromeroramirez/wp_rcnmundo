import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from "@angular/http";
import { FormsModule, ReactiveFormsModule } from "@angular/forms";

import { AppComponent } from './app.component';
import { ListaEmisorasComponent } from './componentes/lista-emisoras/lista-emisoras.component';


//Servicios
import { EmisorasService } from "./service/emisoras.service";
import { NoticiasService } from "./service/noticias.service";

//Routes
import { APP_ROUTING } from "./app.routes";
import { NoticiasComponent } from './componentes/noticias/noticias.component';


@NgModule({
  declarations: [
    AppComponent,
    ListaEmisorasComponent,
    NoticiasComponent
  ],
  imports: [
    BrowserModule,
    APP_ROUTING,
    HttpModule,
    FormsModule,
    ReactiveFormsModule
  ],
  providers: [
    EmisorasService,
    NoticiasService
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
