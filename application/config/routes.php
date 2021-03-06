<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['logout'] = 'auth/logout';
$route['ciudades'] = 'ciudades/ciudades';
$route['obtener_tipo_movimiento'] = 'movimientos/Movimientos/obtenerTipoMovimiento';
$route['getPlanCuenta'] = 'plancuentas/Plancuentas/getPlanCuenta';
$route['importarMarcacion'] = 'Marcacion/Marcacion/cargaImportacion';
$route['procesar_carga'] = 'Marcacion/Marcacion/procesarArchivo';
$route['insert_marcacion'] = 'Marcacion/Marcacion/insertarMarcaciones';
$route['viewgenerarFaltas'] = 'faltas/Faltas/viewGenerarFaltas';
$route['consulta_faltas'] = 'faltas/Faltas/consultarFaltas';
$route['procesar_faltas'] = 'faltas/Faltas/generacionFaltas';
$route['generar_movimiento'] = 'liquidacion/Liquidacion/insertMovimientoAusencia';
$route['tipo_faltas'] = 'faltas/Faltas';
$route['horarios'] = 'horario/Horario';
$route['detalle_horario'] = 'horario/Horario/viewDetalle';
$route['add_tipo_falta'] = 'faltas/Faltas/add';
$route['concepto_fijo'] = 'movimientos/Movimientos/list_concepto';
$route['add_concepto_fijo'] = 'movimientos/Movimientos/add_concepto';
$route['getEmpleado'] = 'empleados/Empleados/getEmpleado';
$route['store_concepto_fijos'] = 'movimientos/Movimientos/storeConceptoFijos';
$route['get_empleados_conceptos'] = 'movimientos/Movimientos/getEmpleadoConceptos';
$route['edit_conceptos/(:num)'] = 'movimientos/Movimientos/editConcepto/$1';
$route['get_concepto_fijo'] = 'movimientos/Movimientos/getConceptoFijos';
$route['edit_concepto_fijos'] = 'movimientos/Movimientos/editConceptoFijos';
$route['update_concepto_fijos'] = 'movimientos/Movimientos/updateConceptoFijo';
$route['delete_concepto_fijo'] = 'movimientos/Movimientos/deleteConceptoFijo';
$route['get_empleados_movimiento'] = 'movimientos/Movimientos/getEmpleadoMovimentos';
$route['pagos'] = 'pagos/pagos/cargarPantalla';
$route['generar_archivo'] = 'pagos/pagos/generarArchivo';
$route['descargar_archivo/(:any)'] = 'pagos/pagos/descargaArchivos/$1';
$route['marcacion_mapa'] = 'Marcacion/Marcacion';
$route['legajos'] = 'empleados/Empleados/legajos';
$route['agregar_incidencia/(:num)'] = 'empleados/Empleados/agregar_incidencia/$1';
$route['getTipoIncidencia'] = 'empleados/Empleados/getTipoIncidencia';
$route['store_incidencia'] = 'empleados/Empleados/storeIncidencia';
$route['tipo_incidencia'] = 'tipoincidencias/Incidencias';
$route['lista_empleados'] = 'informes/informes/listaEmpleados';
$route['listado_sueldos'] = 'informes/informes/listaSueldos';
$route['resumen_ocupadas'] = 'informes/informes/resumenOcupadas';
$route['listado_hijos'] = 'informes/informes/listadoHijos';
$route['resumen_sueldos'] = 'informes/informes/resumenSueldos';
$route['informe_empleado'] = 'informes/informes/informeEmpleado';
$route['informe_hijos'] = 'informes/informes/informeHijos';
$route['informe_libro_diario'] = 'informes/informes/informeLibroDiario';
$route['informe_sueldo'] = 'informes/informes/informeSueldo';
$route['resumen_ocupado'] = 'informes/informes/informePersonasOcupadas';
$route['store_user'] = 'Usuarios/Usuario/store';
$route['generar_pass'] = 'Usuarios/Usuario/generarContrasena';
$route['reporte_libro_mayor'] = 'informes/informes/informeMayor';
$route['lista_mayor'] = 'informes/informes/listadoLibrosMayor';