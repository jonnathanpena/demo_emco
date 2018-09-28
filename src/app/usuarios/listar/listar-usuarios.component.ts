import { Component, OnInit} from '@angular/core';

import { UsuariosProvider } from '../usuarios.providers';
import { Router } from '@angular/router';

@Component({
  templateUrl: './listar-usuarios.component.html',
  styleUrls: ['./listar-usuarios.component.scss']
})
export class ListarUsuariosComponent implements OnInit {
  usuarios: any = [];
  acceso: any = {
    admin: true,
    user: false
  };

  constructor(
    private services: UsuariosProvider,
    private router: Router
  ) {}

  ngOnInit() {
    if (localStorage.getItem('demo_emco_user') === '') {
      this.router.navigate(['/authentication/login']);
    } else {
      const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
      if (usuario.de_nombre_dpto === null) {
        this.acceso = {
          admin: true,
          user: false
        };
        this.usuarios = [];
        this.services.allUsuarios().subscribe(response => {
          this.usuarios = response.data;
          console.log('usuarios', this.usuarios);
        });
      } else {
        this.acceso = {
          admin: false,
          user: true
        };
      }
    }
  }
}
