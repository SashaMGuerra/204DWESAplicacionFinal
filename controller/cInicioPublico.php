<?php
/**
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Controlador de la página de inicio público: primera página de la aplicación.
 * Se puede ir a la página de login.
 */

// Si decide hacer login, va a la página.
if(isset($_REQUEST['login'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: index.php');
    exit;
}

// Si se desea acceder a la página de registro, la indica y recarga el index.
if(isset($_REQUEST['registrarse'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'registro';
    header('Location: index.php');
    exit;
}

// Carga de la página de inicio.
require_once $aVistas['layout'];
    