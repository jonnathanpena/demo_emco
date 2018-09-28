import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';
import { NgbModalModule } from '@ng-bootstrap/ng-bootstrap';

import { SolicitudesRoutes } from './solicitudes.routing';
import { CrearSolicitudComponent } from './crear/crear-solicitud.component';
import { ListarSolicitudesComponent } from './listar/listar-solicitudes.component';

import { ULRProvider } from '../providers/url.providers';
import { SolicitudesProvider } from './solicitudes.providers';
import { XlsxToJsonService } from './xlsx-to-json-service';
import { DatePipe } from '@angular/common';
import { SwitchComponent } from './switch/switch.component';
import { ToggleComponent } from './toggle/toggle.component';

import {
  DxTextBoxModule,
  DxValidatorModule,
  DxValidationSummaryModule,
  DxSelectBoxModule,
  DxButtonModule,
  DxDataGridModule,
  DxBulletModule,
  DxTemplateModule,
  DxFileUploaderModule,
  DxDateBoxModule
} from 'devextreme-angular';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forChild(SolicitudesRoutes),
    NgbModalModule.forRoot(),
    FormsModule,
    DxTextBoxModule,
    DxValidatorModule,
    DxValidationSummaryModule,
    DxSelectBoxModule,
    DxButtonModule,
    DxDataGridModule,
    DxBulletModule,
    DxTemplateModule,
    DxFileUploaderModule,
    DxDateBoxModule
  ],
  declarations: [
    CrearSolicitudComponent,
    ListarSolicitudesComponent,
    SwitchComponent,
    ToggleComponent
  ],
  providers: [
    ULRProvider,
    SolicitudesProvider,
    XlsxToJsonService,
    DatePipe
  ]
})

export class SolicitudesModule {}
