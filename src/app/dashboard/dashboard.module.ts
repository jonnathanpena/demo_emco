import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { DashboardRoutes } from './dashboard.routing';
import { ULRProvider } from './../providers/url.providers';
import { DashboardComponent } from './dashboard.component';
import { DashboardProvider } from './dashboard.providers';

import {
  DxTextBoxModule,
  DxValidatorModule,
  DxValidationSummaryModule,
  DxSelectBoxModule,
  DxButtonModule,
  DxDataGridModule,
  DxBulletModule,
  DxTemplateModule,
  DxChartModule,
  DxPieChartModule
} from 'devextreme-angular';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forChild(DashboardRoutes),
    FormsModule,
    DxTextBoxModule,
    DxValidatorModule,
    DxValidationSummaryModule,
    DxSelectBoxModule,
    DxButtonModule,
    DxDataGridModule,
    DxBulletModule,
    DxTemplateModule,
    DxChartModule,
    DxPieChartModule
  ],
  declarations: [
    DashboardComponent
  ],
  providers: [
    ULRProvider,
    DashboardProvider
  ]
})

export class DashboardModule {}
