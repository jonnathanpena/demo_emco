import { Component, OnInit} from '@angular/core';
import notify from 'devextreme/ui/notify';
import { Router } from '@angular/router';
import { DatePipe } from '@angular/common';

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
  excel: any = [];
  tipoDocumento: any = [];
  datosNuevo: any = {
    de_formulario_id: 0,
    de_tipo_documento: '',
    de_num_documento: '',
    de_prioridad: 'BAJA'
  };
  acceso = true;
  dataCargada = true;


  constructor(
    private services: SolicitudesProvider,
    private router: Router,
    private datePipe: DatePipe
  ) {}

  ngOnInit() {
    if (localStorage.getItem('demo_emco_user') === '') {
      this.router.navigate(['/authentication/login']);
    } else {
      const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
      if (usuario.de_nombre_dpto === null) {
        this.acceso = false;
      } else {
        this.dataCargada = true;
        this.acceso = true;
        this.datosNuevo = {
          de_formulario_id: 0,
          de_tipo_documento: '',
          de_num_documento: '',
          de_prioridad: 'BAJA'
        };
        this.tipoDocumento = ['FACTURA', 'NOTA DE DÉBITO', 'NOTA DE CRÉDITO', 'NOTA DE VENTA'];
        this.excel = [];
        this.condiciones = {
          form1: true,
          form2: false,
          form3: false
        };
        this.guardando = false;
        this.imagenes = [];
        this.solicitudes = [];
        const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
        if (usuario.de_nombre_dpto === 'TI') {
          this.condiciones = {
            form1: true,
            form2: false,
            form3: false
          };
        } else if (usuario.de_nombre_dpto === 'FINANZAS') {
          this.condiciones = {
            form1: false,
            form2: true,
            form3: false
          };
        } else if (usuario.de_nombre_dpto === 'TALENTO HUMANO') {
          this.condiciones = {
            form1: false,
            form2: false,
            form3: true
          };
        }
        this.usuario = {
          id: usuario.de_id_user,
          nombre: usuario.de_usuario
        };
        this.formulario = {
          de_id_usuario: this.usuario.id,
          de_fecha_creacion: this.now,
          de_transaccion: '',
          de_valor_solicitud: '',
          de_justificacion: '',
          de_adjunto: 0,
          de_estado_id: 1
        };
        this.now = new Date();
        this.getMaxId();
      }
    }
  }

  getMaxId() {
    const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
    let departamento;
    if (usuario.de_nombre_dpto === 'TI') {
      departamento = 'TI';
    } else if (usuario.de_nombre_dpto === 'FINANZAS') {
      departamento = 'FIN';
    } else if (usuario.de_nombre_dpto === 'TALENTO HUMANO') {
      departamento = 'TH';
    }
    this.services.formularioIdMax().subscribe(response => {
      const data = response;
      let max = data.data[0].de_id_formulario * 1;
      max = max + 1;
      if (max > 0 && max < 10) {
        this.formulario.de_transaccion = departamento + '-00' + max;
      } else if (max > 9 && max < 100) {
        this.formulario.de_transaccion = departamento + '-0' + max;
      } else if (max > 99) {
        this.formulario.de_transaccion = departamento + '-' + max;
      }
    });
  }

  guardarForm1(e) {
    e.preventDefault();
    this.formulario.de_estado_id = 1;
    this.guardando = true;
    this.services.insertFormulario(this.formulario).subscribe(response => {
      if (response['_body'] === 'false' || response['_body'] === false) {
        notify('Algo sucedió mal, por favor verifique la información e intente nuevamente', 'error', 2000);
        this.cancelar();
      } else {
        this.senMail();
        if (this.formulario.de_adjunto === 1) {
          this.insertDetalleForm1(response['_body']);
        } else {
          notify('Solicitud generada exitosamente', 'success', 2000);
          this.cancelar();
        }
      }
    });
  }

  moveImage(id) {
    console.log('nombre archivo', this.nombreArchivo);
    this.services.moveImage(
      {
        archivo: this.nombreArchivo
      }
    ).subscribe(response => {
      if (response['_body'] === true || response['_body'] === 'true') {
        this.insertDetalleForm1(id);
      } else {
        notify('Algo sucedió mal, por favor verifique la información e intente nuevamente', 'error', 2000);
      }
    });
  }

  insertDetalleForm1(id) {
    this.services.insertDetalleFormulario(
      {
        de_formulario_id: id,
        de_ruta_adjunto: 'http://proconty.com/API/demo/documentos/' + this.nombreArchivo
      })
    .subscribe(response => {
      if (response['_body'] === false || response['_body'] === 'false') {
        notify('Algo sucedió mal, por favor verifique la información e intente nuevamente', 'error', 2000);
      } else {
        notify('Solicitud generada exitosamente', 'success', 2000);
      }
      this.cancelar();
    });
  }

  senMail() {
    const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
    this.services.sendMail(
      {
        usuario: usuario.de_usuario,
        valor_solicitud: this.formulario.de_valor_solicitud,
        justificacion: this.formulario.de_justificacion,
        transaccion: this.formulario.de_transaccion,
        fecha: this.formulario.de_fecha_creacion
      }
    ).subscribe(response => {
      console.log('response mail', response);
    });
  }

  guardarForm2(e) {
    e.preventDefault();
    this.guardando = true;
    this.formulario.de_estado_id = 2;
    this.services.insertFormulario(this.formulario).subscribe(response => {
      if (response['_body'] === 'false' || response['_body'] === false) {
        notify('Algo sucedió mal, por favor verifique la información e intente nuevamente', 'error', 2000);
        this.cancelar();
      } else {
        this.insertNuevoFormulario(response['_body']);
        if (this.formulario.de_adjunto === 1) {
          this.insertDetalleForm1(response['_body']);
        } else {
          notify('Solicitud generada exitosamente', 'success', 2000);
          this.cancelar();
        }
      }
    });
  }

  insertNuevoFormulario(id) {
    this.datosNuevo.de_formulario_id = id;
    this.services.insertFormularioNuevo(this.datosNuevo).subscribe(response => {
      console.log('datos nuevos', response['_body']);
    });
  }

  guardarForm3() {
    if (this.solicitudes.length > 0) {
      this.guardando = true;
      this.services.insertFormularioAll({solicitudes: this.excel}).subscribe(response => {
        if (response['_body'] === 'true') {
          notify('Guardado exitoso', 'success', 2000);
        } else {
          notify('Compruebe su conexión a internet e intente nuevamente', 'error', 2000);
        }
        const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
        let total = 0;
        for (let i = 0; i < this.excel.length; i++) {
          total += this.excel[i].de_valor_solicitud * 1;
        }
        this.services.sendMail(
          {
            usuario: usuario.de_usuario,
            valor_solicitud: total,
            justificacion: this.excel[0].de_justificacion,
            transaccion: 'Múltiples',
            fecha: this.now
          }
        ).subscribe(response => {
          console.log('response mail', response);
        });
        setTimeout(() => {
          this.salir();
        }, 4000);
      });
    } else {
      notify('Error no hay datos, intente de nuevo', 'error', 2000);
    }
  }

  salir() {
    this.router.navigate(['/solicitudes']);
  }

  getIdMax(form, posicion) {
    const usuario = JSON.parse(localStorage.getItem('demo_emco_user'));
    let departamento;
    const date = new Date(form.Fecha);
    const fecha = this.datePipe.transform(date, 'yyyy-MM-dd H:m:s');
    if (usuario.de_nombre_dpto === 'TI') {
      departamento = 'TI';
    } else if (usuario.de_nombre_dpto === 'FINANZAS') {
      departamento = 'FIN';
    } else if (usuario.de_nombre_dpto === 'TALENTO HUMANO') {
      departamento = 'TH';
    }
    this.services.formularioIdMax().subscribe(response => {
      const data = response;
      let max = data.data[0].de_id_formulario * 1;
      max = max + 1 + posicion;
      if (max > 0 && max < 10) {
        form.de_transaccion = departamento + '-00' + max;
      } else if (max > 9 && max < 100) {
        form.de_transaccion = departamento + '-0' + max;
      } else if (max > 99) {
        form.de_transaccion = departamento + '-' + max;
      }
      this.excel.push(
        {
          de_id_usuario: this.usuario.id,
          de_fecha_creacion: fecha,
          de_transaccion: form.de_transaccion,
          de_valor_solicitud: form.Monto,
          de_justificacion: form.Motivo,
          de_adjunto: 0,
          de_estado_id: 1
        }
      );
      console.log('excel', this.excel);
    });
  }

  insertarFormulario(form) {
    this.services.insertFormulario(form).subscribe(response => {});
  }

  cancelar() {
    this.guardando = false;
    this.imagenes = [];
    this.formulario.de_transaccion = '';
    this.formulario.de_valor_solicitud = '';
    this.formulario.de_justificacion = '';
    this.formulario.de_adjunto = 0;
    this.getMaxId();
    this.solicitudes = [];
    this.datosNuevo.de_formulario_id = 0;
    this.datosNuevo.de_num_documento = '';
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
    this.excel = [];
    const file = event.target.files[0];
    this.xlsxToJsonService.processFileToJson({}, file).subscribe(data => {
      if (data.sheets.Hoja1[0].Monto || data.sheets.Hoja1[0].Fecha || data.sheets.Hoja1[0].Motivo) {
        this.solicitudes = data.sheets.Hoja1;
        this.dataCargada = false;
        for (let i = 0; i < this.solicitudes.length; i++) {
          this.getIdMax(this.solicitudes[i], i);
        }
      } else {
        notify('Error en el formato, intente de nuevo', 'error', 2000);
        this.dataCargada = true;
      }
    });
  }

  cambiaTipoDocumento(e) {
    this.datosNuevo.de_tipo_documento = e.value;
  }

  showMessage(value) {
    if (value === true) {
      this.datosNuevo.de_prioridad = 'ALTA';
    } else {
      this.datosNuevo.de_prioridad = 'BAJA';
    }
  }

}
