//import { RouteInfo } from './sidebar.metadata';

export const ROUTES = [
  {
    path: '/dashboard',
    title: 'Dashboards',
    icon: 'mdi mdi-gauge',
    class: '',
    extralink: false,
    submenu: []
  },
  {
    path: '',
    title: 'Usuarios',
    icon: 'mdi mdi-account-multiple',
    class: 'has-arrow',
    extralink: false,
    submenu: [
        { path: '/usuarios/crear', title: 'Nuevo', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
        { path: '/usuarios', title: 'Usuarios', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
    ]
  },
  {
    path: '',
    title: 'Solicitudes',
    icon: 'mdi mdi-equal-box',
    class: 'has-arrow',
    extralink: false,
    submenu: [
        { path: '/solicitudes/crear', title: 'Nueva', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
        { path: '/solicitudes', title: 'Solicitudes', icon: '', class: '', label: '', labelClass: '', extralink: false, submenu: [] },
    ]
  }
];

