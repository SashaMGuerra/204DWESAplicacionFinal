<?php

/**
 * @author Sasha
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
    setcookie('language', 'ES', time() + 60 * 60 * 24 * 30);
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
    /*
      $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
      $_SESSION['paginaEnCurso'] = 'wip';
     * 
     */

    setcookie('language', $_REQUEST['cookieLanguage'], time() + 60 * 60 * 24 * 30);

    header('Location: index.php');
    exit;
}

/*
 * Si desde el menú el usuario desea acceder a la página de inicio, se comprueba
 * si ha iniciado sesión. Si está, carga la privada, y si no, a la pública.
 */
if (isset($_REQUEST['menuInicio'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = isset($_SESSION['usuarioDAW204AplicacionFinal']) ? 'inicioPrivado' : 'inicioPublico';
}

// Si desde el footer el usuario quiere ir a la página de tecnologías, va.
if (isset($_REQUEST['tecnologias'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'tecnologias';
}

// Si no hay una página a cargar indicada, carga el login.
if (!isset($_SESSION['paginaEnCurso'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}


/* Si la página que se pide es privada y el usuario no ha hecho login, le manda
 * al inicio público.
 */
if(array_key_exists($_SESSION['paginaEnCurso'], $aVistas['privada']) && !isset($_SESSION['usuarioDAW204AplicacionFinal'])){
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}

// Cargado de la página indicada.
require_once $aControladores[$_SESSION['paginaEnCurso']];
