import { Component, OnInit} from '@angular/core';

import { UsuariosProvider } from '../usuarios.providers';

@Component({
  templateUrl: './listar-usuarios.component.html',
  styleUrls: ['./listar-usuarios.component.scss']
})
export class ListarUsuariosComponent implements OnInit {
  usuarios: any = [];
  dataSource: any = [];
  areas: any = [];

  constructor(
    private services: UsuariosProvider
  ) {}

  ngOnInit() {
    this.usuarios = [];
    this.services.allUsuarios().subscribe(response => {
      this.usuarios = response.data;
      console.log('usuarios', this.usuarios);
    });
    this.services.graficoCantidadEstado().subscribe(response => {
      this.dataSource = response.data;
      console.log('cant x edo', this.dataSource);
    });
    this.services.graficoValorEstado().subscribe(response => {
      this.areas = response.data;
      console.log('valor x edo', this.areas);
    });
  }
}
