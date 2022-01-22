<?php
/* 
 * @author Sasha
 * @since 15/11/2021
 * @version 1.0
 * 
 * Fichero de configuración de aplicación.
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
require_once 'model/DB.php';
require_once 'model/DBPDO.php';
require_once 'model/AppError.php';

// Directorios de los controladores.
$aControladores = [
    'inicioPublico' => 'controller/cInicioPublico.php',
    'login' => 'controller/cLogin.php',
    'inicioPrivado' => 'controller/cInicioPrivado.php',
    'registro' => 'controller/cRegistro.php',
    'miCuenta' => 'controller/cMiCuenta.php',
    'cambiarPassword' => 'controller/cCambiarPassword.php',
    'borrarCuenta' => 'controller/cBorrarCuenta.php',
    'detalle' => 'controller/cDetalle.php',
    'wip' => 'controller/cWIP.php',
    'error' => 'controller/cError.php'
];

// Directorios de las vistas.
$aVistas = [
    'inicioPublico' => 'view/'.$_COOKIE['language'].'/vInicioPublico.php',
    'layout' => 'view/'.$_COOKIE['language'].'/Layout.php',
    'login' => 'view/'.$_COOKIE['language'].'/vLogin.php',
    'inicioPrivado' => 'view/'.$_COOKIE['language'].'/vInicioPrivado.php',
    'registro' => 'view/'.$_COOKIE['language'].'/vRegistro.php',
    'miCuenta' => 'view/'.$_COOKIE['language'].'/vMiCuenta.php',
    'cambiarPassword' => 'view/'.$_COOKIE['language'].'/vCambiarPassword.php',
    'borrarCuenta' => 'view/'.$_COOKIE['language'].'/vBorrarCuenta.php',
    'detalle' => 'view/'.$_COOKIE['language'].'/vDetalle.php',
    'wip' => 'view/'.$_COOKIE['language'].'/vWIP.php',
    'error' => 'view/'.$_COOKIE['language'].'/vError.php'
];