import { Component, OnInit} from '@angular/core';
import notify from 'devextreme/ui/notify';

@Component({
  templateUrl: './crear-solicitud.component.html',
  styleUrls: ['./crear-solicitud.component.scss']
})

export class CrearSolicitudComponent implements OnInit {
  condiciones: any = {
    form1: true,
    form2: false,
    form3: false
  };
  guardando = false;
  imagenes: any = [];
  nombreArchivo = '';
  solicitudes: any = [];

  constructor() {}

  ngOnInit() {
    this.condiciones = {
      form1: true,
      form2: false,
      form3: false
    };
    this.guardando = false;
    this.imagenes = [];
    this.solicitudes = [];
    this.solicitudes = [
      {
        de_id_usuario: 1,
        de_fecha_creacion: '2018-09-26 17:00:00',
        de_transaccion: 'TI-001',
        de_valor_solicitud: '200.65',
        de_justificacion: 'Justificación'
      }
    ];
  }

  guardarForm1(e) {
    e.preventDefault();
  }

  guardarForm2(e) {
    e.preventDefault();
  }

  cancelar() {
    this.guardando = false;
    this.imagenes = [];
  }

  uploaded(e) {
    this.nombreArchivo = e.file.name;
    console.log('subido', e);
    console.log('imagesnes', this.imagenes);
  }

  uploadError(e) {
    notify('Compruebe que tiene acceso a internet e intente nuevamente', 'error', 2000);
  }
}
