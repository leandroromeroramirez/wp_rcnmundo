import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { HttpModule } from "@angular/http";

import { AppComponent } from './app.component';
import { ListaEmisorasComponent } from './emisora/lista-emisoras/lista-emisoras.component';

//Servicios
import { EmisorasService } from "./service/emisoras.service";

//Routes
import { APP_ROUTING } from "./app.routes";


@NgModule({
  declarations: [
    AppComponent,
    ListaEmisorasComponent
  ],
  imports: [
    BrowserModule,
    APP_ROUTING,
    HttpModule
  ],
  providers: [EmisorasService],
  bootstrap: [AppComponent]
})
export class AppModule { }
