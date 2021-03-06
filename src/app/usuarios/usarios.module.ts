import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';
import { Routes, RouterModule } from '@angular/router';

import { UsuariosRoutes } from './usuarios.routing';
import { CrearUsuarioComponent } from './crear/crear-usuario.component';
import { ListarUsuariosComponent } from './listar/listar-usuarios.component';

@NgModule({
  imports: [
    CommonModule,
    RouterModule.forChild(UsuariosRoutes),
    FormsModule
  ],
  declarations: [
    CrearUsuarioComponent,
    ListarUsuariosComponent
  ]
})

export class UsuariosModule {}
