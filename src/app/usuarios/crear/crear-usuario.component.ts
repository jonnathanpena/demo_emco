import { Component, OnInit} from '@angular/core';
import notify from 'devextreme/ui/notify';

@Component({
  templateUrl: './crear-usuario.component.html',
  styleUrls: ['./crear-usuario.component.scss']
})

export class CrearUsuarioComponent implements OnInit {
  usuario: any = {
    de_id_persona: '',
    de_nombre_per: '',
    de_apellido_per: '',
    de_celular_per: '',
    de_correo_per: '',
    de_provincia_per: '',
    de_canton_per: '',
    de_id_user: '',
    de_usuario: '',
    de_clave: '',
    confirme: '',
    de_persona_id: ''
  };
  provincias: any = [];
  cantones: any = [];

  constructor() {}

  ngOnInit() {
    this.usuario = {
      de_id_persona: '',
      de_nombre_per: '',
      de_apellido_per: '',
      de_celular_per: '',
      de_correo_per: '',
      de_canton_per: '',
      de_id_user: '',
      de_usuario: '',
      de_clave: '',
      confirme: '',
      de_persona_id: ''
    };
    this.provincias = [
      {
        id_intprov: 0,
        nombre_intprov: 'Machala'
      }
    ];
    this.cantones = [
      {
        id_intcant: 0,
        nombre_intcant: 'Canton 1',
        prov_canton_id: 1
      }
    ];
  }

  crearUsuario() {}
}
