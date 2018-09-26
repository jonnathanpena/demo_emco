import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { SolicitudesRoutes } from './solicitudes.routing';
import { CrearSolicitudComponent } from './crear/crear-solicitud.component';
import { ListarSolicitudesComponent } from './listar/listar-solicitudes.component';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forChild(SolicitudesRoutes),
    FormsModule
  ],
  declarations: [
    CrearSolicitudComponent,
    ListarSolicitudesComponent
  ]
})

export class SolicitudesModule {}
