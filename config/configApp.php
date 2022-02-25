<?php
/*
 * Fichero de configuración de aplicación.
 * 
 * Contiene las constantes, y los require de librerías y contenido de la aplicación.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 15/11/2021
 * @version 1.0
 */

// Librería de validación de formularios.
require_once 'core/libreriaValidacion.php';

// Constantes para el parámetro "obligatorio" de la validación de formularios.
define("OBLIGATORIO", 1);
define("OPCIONAL", 0);

// Constantes para la conexión a la base de datos.
require_once 'config/configDB.php';

// Requerimiento de todas las clases que componen la aplicación.
require_once 'model/Usuario.php';
require_once 'model/UsuarioDB.php';
require_once 'model/UsuarioPDO.php';
require_once 'model/Departamento.php';
require_once 'model/DepartamentoPDO.php';
require_once 'model/DB.php';
require_once 'model/DBPDO.php';
require_once 'model/AppError.php';
require_once 'model/REST.php';
require_once 'model/Palabra.php';

// Directorios de los controladores.
$aControladores = [
    'publico' => [
        'inicioPublico' => 'controller/cInicioPublico.php',
        'login' => 'controller/cLogin.php',
        'registro' => 'controller/cRegistro.php',
        'wip' => 'controller/cWIP.php',
        'tecnologias' => 'controller/cTecnologias.php',
        'error' => 'controller/cError.php'
    ],
    'privado' => [
        'inicioPrivado' => 'controller/cInicioPrivado.php',
        'miCuenta' => 'controller/cMiCuenta.php',
        'cambiarPassword' => 'controller/cCambiarPassword.php',
        'borrarCuenta' => 'controller/cBorrarCuenta.php',
        'detalle' => 'controller/cDetalle.php',
        'rest' => 'controller/cREST.php',
    ],
    'usuario' => [
        'mtoDepartamentos' => 'controller/cMtoDepartamentos.php',
        'consultarModificarDepartamento' => 'controller/cConsultarModificarDepartamento.php',
        'eliminarDepartamento' => 'controller/cEliminarDepartamento.php',
        'altaDepartamento' => 'controller/cAltaDepartamento.php',
        'exportarDepartamentos' => 'controller/cExportarDepartamentos.php',
    ],
    'administrador' => [
        'mtoUsuarios' => 'controller/cMtoUsuarios.php',
    ]
];

// Directorios de las vistas.
$aVistas = [
    'layout' => 'view/' . $_COOKIE['language'] . '/Layout.php',
    'inicioPublico' => 'view/' . $_COOKIE['language'] . '/vInicioPublico.php',
    'login' => 'view/' . $_COOKIE['language'] . '/vLogin.php',
    'registro' => 'view/' . $_COOKIE['language'] . '/vRegistro.php',
    'tecnologias' => 'view/' . $_COOKIE['language'] . '/vTecnologias.php',
    'wip' => 'view/' . $_COOKIE['language'] . '/vWIP.php',
    'error' => 'view/' . $_COOKIE['language'] . '/vError.php',
    'inicioPrivado' => 'view/' . $_COOKIE['language'] . '/vInicioPrivado.php',
    'miCuenta' => 'view/' . $_COOKIE['language'] . '/vMiCuenta.php',
    'cambiarPassword' => 'view/' . $_COOKIE['language'] . '/vCambiarPassword.php',
    'borrarCuenta' => 'view/' . $_COOKIE['language'] . '/vBorrarCuenta.php',
    'detalle' => 'view/' . $_COOKIE['language'] . '/vDetalle.php',
    'rest' => 'view/' . $_COOKIE['language'] . '/vREST.php',
    'mtoDepartamentos' => 'view/' . $_COOKIE['language'] . '/vMtoDepartamentos.php',
    'consultarModificarDepartamento' => 'view/' . $_COOKIE['language'] . '/vConsultarModificarDepartamento.php',
    'eliminarDepartamento' => 'view/' . $_COOKIE['language'] . '/vEliminarDepartamento.php',
    'altaDepartamento' => 'view/' . $_COOKIE['language'] . '/vAltaDepartamento.php',
    'mtoUsuarios' => 'view/' . $_COOKIE['language'] . '/vMtoUsuarios.php',
];
