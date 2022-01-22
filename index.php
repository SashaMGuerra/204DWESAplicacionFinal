<?php
/**
 * @author Isabel Martínez Guerra
 * @since 21/12/2021
 * @version 1.0
 * 
 * Controlador principal de la aplicación.
 */

// Constantes de la aplicación.
require_once './config/configApp.php';

// Inicio o recuperación de la sesión.
session_start();

// Si no hay una página a cargar indicada, carga el login.
if(!isset($_SESSION['paginaEnCurso'])){
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}

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
// Si se ha seleccionado cambiar de idioma, cambia el valor de la cookie y recarga la página.
if(isset($_REQUEST['cookieLanguage'])){
    setcookie('language', $_REQUEST['cookieLanguage'], time()+60*60*24*30);
    header('Location: index.php');
    exit;
}

/**
 * Si se ha elegido un idioma, y el idioma elegido está entre los existentes en
 * la lista de idiomas, modifica la cookie y recarga la página.
 */
if (isset($_REQUEST['idioma']) && !validacionFormularios::validarElementoEnLista($_REQUEST['idioma'], ['ES', 'EN', 'PT'])) {
    setcookie('idiomaPreferido', $_REQUEST['idioma'], time() + 604800);
    header('Location: indexLoginLogoffTema5.php');
    exit;
}

// Cargado de la página indicada.
require_once $aControladores[$_SESSION['paginaEnCurso']];