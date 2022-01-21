<?php
/**
 * @author Sasha
 * @since 22/12/2021
 * @version 1.0
 * 
 * Controlador de la página de inicio privado.
 * Destruye la sesión cuando le es requerido. Requiere la vista del inicio privado.
 */

/*
 * Si se selecciona cerrar sesión, destruye la sesión y devuelve al usuario a la
 * página de login.
 */
if(isset($_REQUEST['logout'])){
    session_unset();
    session_destroy();
    
    header('Location: index.php');
    exit;
}

// Si se selecciona ver perfil, va a la página de MiCuenta.
if(isset($_REQUEST['miCuenta'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'miCuenta';
    header('Location: index.php');
    exit;
}

/*
 * Si se selecciona ir a la aplicación MtoDepartamentos, indica la página y
 * recarga el index.
 */
if(isset($_REQUEST['mtoDepartamentos'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'wip';
    header('Location: index.php');
    exit;
}

// Si se selecciona ir a la ventana de detalle, va.
if(isset($_REQUEST['detalle'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'detalle';
    header('Location: index.php');
    exit;
}

// Botón para probar la página de error que muestra las excepciones.
if(isset($_REQUEST['fallar'])){
    $sSelect = 'SELECT * FROM TablaFalsa;';
    DBPDO::ejecutarConsulta($sSelect);
}

// Array con la información de la vista.
$aVInicioPrivado = [
    'descUsuario' => $_SESSION['usuarioDAW204AppLoginLogout']->getDescUsuario(),
    'numAccesos' => $_SESSION['usuarioDAW204AppLoginLogout']->getNumAccesos(),
    'fechaHoraUltimaConexionAnterior' => $_SESSION['usuarioDAW204AppLoginLogout']->getFechaHoraUltimaConexionAnterior(),
    'imagenUsuario' => $_SESSION['usuarioDAW204AppLoginLogout']->getImagenUsuario()
];

// Carga de la página de inicio.
require_once $aVistas['layout'];
    