<?php

/*
 * Fichero de configuración de aplicación.
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

define("DEPARTAMENTOS_BAJA", 0);
define("DEPARTAMENTOS_ALTA", 1);
define("DEPARTAMENTOS_TODOS", 2);

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
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'registro' => 'controller/cRegistro.php',
    'miCuenta' => 'controller/cMiCuenta.php',
    'cambiarPassword' => 'controller/cCambiarPassword.php',
    'borrarCuenta' => 'controller/cBorrarCuenta.php',
    'mtoDepartamentos' => 'controller/cMtoDepartamentos.php',
    'consultarModificarDepartamento' => 'controller/cConsultarModificarDepartamento.php',
    'eliminarDepartamento' => 'controller/cEliminarDepartamento.php',
    'altaDepartamento' => 'controller/cAltaDepartamento.php',
    'detalle' => 'controller/cDetalle.php',
    'tecnologias' => 'controller/cTecnologias.php',
    'rest' => 'controller/cREST.php',
    'wip' => 'controller/cWIP.php',
    'error' => 'controller/cError.php'
];

// Directorios de las vistas.
/*
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
];
 * 
 */

$aVistas = [
    'layout' => 'view/' . $_COOKIE['language'] . '/Layout.php',
    'publica' => [
        'inicioPublico' => 'view/' . $_COOKIE['language'] . '/vInicioPublico.php',
        'login' => 'view/' . $_COOKIE['language'] . '/vLogin.php',
        'registro' => 'view/' . $_COOKIE['language'] . '/vRegistro.php',
        'tecnologias' => 'view/' . $_COOKIE['language'] . '/vTecnologias.php',
        'wip' => 'view/' . $_COOKIE['language'] . '/vWIP.php',
        'error' => 'view/' . $_COOKIE['language'] . '/vError.php'
    ],
    'privada' => [
        'inicioPrivado' => 'view/' . $_COOKIE['language'] . '/vInicioPrivado.php',
        'miCuenta' => 'view/' . $_COOKIE['language'] . '/vMiCuenta.php',
        'cambiarPassword' => 'view/' . $_COOKIE['language'] . '/vCambiarPassword.php',
        'borrarCuenta' => 'view/' . $_COOKIE['language'] . '/vBorrarCuenta.php',
        'detalle' => 'view/' . $_COOKIE['language'] . '/vDetalle.php',
        'rest' => 'view/' . $_COOKIE['language'] . '/vREST.php',
    ],
    'usuario' => [
        'mtoDepartamentos' => 'view/' . $_COOKIE['language'] . '/vMtoDepartamentos.php',
        'consultarModificarDepartamento' => 'view/' . $_COOKIE['language'] . '/vConsultarModificarDepartamento.php',
        'eliminarDepartamento' => 'view/' . $_COOKIE['language'] . '/vEliminarDepartamento.php',
        'altaDepartamento' => 'view/' . $_COOKIE['language'] . '/vAltaDepartamento.php',
    ],
    'administrador' => [
    ]
];
