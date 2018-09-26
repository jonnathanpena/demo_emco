import { Component, OnInit} from '@angular/core';

import { UsuariosProvider } from '../usuarios.providers';

@Component({
  templateUrl: './listar-usuarios.component.html',
  styleUrls: ['./listar-usuarios.component.scss']
})
export class ListarUsuariosComponent implements OnInit {
  usuarios: any = [];

  constructor(
    private services: UsuariosProvider
  ) {}

  ngOnInit() {
    this.usuarios = [];
    this.services.allUsuarios().subscribe(response => {
      this.usuarios = response.data;
      console.log('usuarios', this.usuarios);
    });
  }
}
