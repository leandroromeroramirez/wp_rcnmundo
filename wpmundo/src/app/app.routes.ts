import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

import { ListaEmisorasComponent } from './emisora/lista-emisoras/lista-emisoras.component';

const APP_ROUTES: Routes = [
  { path: '', component: ListaEmisorasComponent, pathMatch: 'full' }
];

export const APP_ROUTING = RouterModule.forRoot(APP_ROUTES);