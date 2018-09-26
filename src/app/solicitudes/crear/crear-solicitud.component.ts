import { Component, OnInit} from '@angular/core';
import notify from 'devextreme/ui/notify';

import { XlsxToJsonService } from '../xlsx-to-json-service';
import { SolicitudesProvider } from '../solicitudes.providers';

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
  private xlsxToJsonService: XlsxToJsonService = new XlsxToJsonService();
  excel: any;
  formulario: any = {
    de_id_usuario: 3,
    de_fecha_creacion: '2018-09-26 17:30:00',
    de_transaccion: 'TI-001',
    de_valor_solicitud: 1200,
    de_justificacion: 'Motivo',
    de_adjunto: 1,
    de_estado_id: 1
  };
  usuario: any = {
    id: 3,
    nombre: 'Jonnathanpena'
  };
  now: Date = new Date();

  constructor(
    private services: SolicitudesProvider
  ) {}

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
    this.excel = [];
    this.usuario = {
      id: 3,
      nombre: 'Jonnathanpena'
    };
    this.formulario = {
      de_id_usuario: 3,
      de_fecha_creacion: this.now,
      de_transaccion: '',
      de_valor_solicitud: '',
      de_justificacion: '',
      de_adjunto: 0,
      de_estado_id: 1
    };
    this.now = new Date();
    this.services.formularioIdMax().subscribe(response => {
      const data = response;
      let max = data.data[0].de_id_formulario * 1;
      max = max + 1;
      if (max > 0 && max < 10) {
        this.formulario.de_transaccion = 'TI-00' + max;
      } else if (max > 9 && max < 100) {
        this.formulario.de_transaccion = 'TI-0' + max;
      } else if (max > 99) {
        this.formulario.de_transaccion = 'TI-' + max;
      }
    });
  }

  guardarForm1(e) {
    e.preventDefault();
    this.formulario.de_estado_id = 1;
    this.services.insertFormulario(this.formulario).subscribe(response => {
      if (response['_body'] === 'false' || response['_body'] === false) {
        notify('Algo sucedió mal, por favor verifique la información e intente nuevamente', 'error', 2000);
      } else {
        this.insertDetalleForm1(response['_body']);
      }
    });
  }

  insertDetalleForm1(id) {

  }

  guardarForm2(e) {
    e.preventDefault();
  }

  cancelar() {
    this.guardando = false;
    this.imagenes = [];
    this.formulario.de_transaccion = '';
    this.formulario.de_valor_solicitud = '';
    this.formulario.de_justificacion = '';
    this.formulario.de_adjunto = 0;
  }

  uploaded(e) {
    this.nombreArchivo = e.file.name;
    console.log('subido', e);
    console.log('imagesnes', this.imagenes);
    this.formulario.de_adjunto = 1;
  }

  uploadError(e) {
    notify('Compruebe que tiene acceso a internet e intente nuevamente', 'error', 2000);
  }

  handleFile(event) {
    const file = event.target.files[0];
    this.xlsxToJsonService.processFileToJson({}, file).subscribe(data => {
      this.excel = data.sheets.Hoja1;
      console.log('excel', this.excel);
    });
  }
}
