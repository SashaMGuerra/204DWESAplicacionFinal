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


// Comprobaciones previas a cargado de página.

// Si no hay una página a cargar indicada, carga el inicio público.
if (!isset($_SESSION['paginaEnCurso'])) {
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}
else{
    /* Si la página que se pide es privada (no está en el array público) y el usuario
     * no ha hecho login, le manda al inicio público.
     */
    if (!array_key_exists($_SESSION['paginaEnCurso'], $aControladores['publico'])
            && !isset($_SESSION['usuarioDAW204AplicacionFinal'])) {
        $_SESSION['paginaEnCurso'] = 'inicioPublico';
    }
    /*
     * Si la página que se pide es privada de administrador, y el usuario no es administrador,
     * o si la página es de usuario normal, y el usuario no es usuario normal,
     * envía al inicio privado (ya se ha comprobado en la opción anterior si ha iniciado sesión).
     */
    else if((array_key_exists($_SESSION['paginaEnCurso'], $aControladores['administrador'])
            && $_SESSION['usuarioDAW204AplicacionFinal']->getPerfil()!='administrador')
            || (array_key_exists($_SESSION['paginaEnCurso'], $aControladores['usuario'])
            && $_SESSION['usuarioDAW204AplicacionFinal']->getPerfil()!='usuario')){
        $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    }
}

/*
 * Cargado de la página indicada.
 * 
 * Como puede estar en cualquiera de la segunda dimensión del array, busca en todas
 * mediante array_column, que devuelve todos los values de un array multidimensional
 * con el key indicado como parámetro. Se asume que no hay ninguna página repetida.
 */
require_once array_column($aControladores, $_SESSION['paginaEnCurso'])[0];
