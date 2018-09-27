import { Component, OnInit} from '@angular/core';
import { Router } from '@angular/router';
import { DashboardProvider } from './dashboard.providers';

@Component({
  templateUrl: './dashboard.component.html',
  styleUrls: ['./dashboard.component.scss']
})

export class DashboardComponent implements OnInit {
  dataSource: any = [];
  areas: any = [];
  grossProductData: any = [];
  maleAgeData: any = [];
  totales: {
    pendientes: 0,
    aprobados: 0,
    rechazados: 0,
    total: 0
  };

  constructor(
    private router: Router,
    private services: DashboardProvider
  ) {}

  ngOnInit() {
    this.totales = {
      pendientes: 0,
      aprobados: 0,
      rechazados: 0,
      total: 0
    };
    if (localStorage.getItem('demo_emco_user') === '') {
      this.router.navigate(['/authentication/login']);
    } else {
      this.services.graficoCantidadEstado().subscribe(response => {
        this.dataSource = response.data;
        console.log('cant x edo', this.dataSource);
      });
      this.services.graficoValorEstado().subscribe(response => {
        this.areas = response.data;
        console.log('valor x edo', this.areas);
        this.totales = {
          pendientes: this.areas[1].valor,
          aprobados: this.areas[0].valor,
          rechazados: this.areas[2].valor,
          total: this.areas[0].total
        };
      });
      this.services.graficoCantCiudad().subscribe(response => {
        this.grossProductData = response.data;
        console.log('valor x edo', this.grossProductData);
      });
      this.services.graficoCantCiudad().subscribe(response => {
        this.maleAgeData = response.data;
        console.log('cant por cuidad', response.data);
      });
    }
  }
}
