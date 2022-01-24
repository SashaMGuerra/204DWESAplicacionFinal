<?php
/**
 * @author Isabel Martínez Guerra
 * @since 21/12/2021
 * @version 1.0
 * 
 * Controlador principal de la aplicación.
 */

/**
 * Si no se ha seleccionado un idioma preferido, crea la cookie de idioma con
 * español por defecto con una duración de 30 días.
 * Recarga la página.
 */
if (!isset($_COOKIE['language'])) {
    setcookie('language', 'ES', time()+60*60*24*30);
    header('Location: index.php');
    exit;
}

// Constantes de la aplicación.
require_once './config/configApp.php';

// Inicio o recuperación de la sesión.
session_start();

/**
 * Si se ha elegido un idioma, y el idioma elegido está entre los existentes en
 * la lista de idiomas, modifica la cookie y recarga la página.
 */
if (isset($_REQUEST['cookieLanguage']) && !validacionFormularios::validarElementoEnLista($_REQUEST['cookieLanguage'], ['ES', 'EN'])) {
    setcookie('language', $_REQUEST['cookieLanguage'], time()+60*60*24*30);
    header('Location: index.php');
    exit;
}

/*
 * Si desde el menú el usuario desea acceder a la página de inicio, se comprueba
 * si ha iniciado sesión. Si está, carga la privada, y si no, a la pública.
 */
if(isset($_REQUEST['menuInicio'])){
    $_SESSION['paginaEnCurso'] = isset($_SESSION['usuarioDAW204AppLoginLogout'])?'inicioPrivado':'inicioPublico';
}

// Si desde el menú el usuario desea acceder a iniciar sesión, lo hace.
if(isset($_REQUEST['menuLogin'])){
    $_SESSION['paginaEnCurso'] = 'login';
}

// Si desde el menú el usuario desea acceder a su cuenta, lo hace.
if(isset($_REQUEST['menuMiCuenta'])){
    $_SESSION['paginaEnCurso'] = 'miCuenta';
}

// Si no hay una página a cargar indicada, carga el login.
if(!isset($_SESSION['paginaEnCurso'])){
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}

// Cargado de la página indicada.
require_once $aControladores[$_SESSION['paginaEnCurso']];