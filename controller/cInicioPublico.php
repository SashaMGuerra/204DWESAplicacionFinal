<?php
/**
 * Controlador de la página de inicio público.
 * 
 * Primera página de la aplicación. Permite ir a la página de login.
 * 
 * @author Sasha
 * @since 12/01/2022
 * @version 1.0
 */

// Si decide hacer login, va a la página.
if(isset($_REQUEST['login'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'login';
    header('Location: index.php');
    exit;
}

// Carga de la página de inicio.
require_once $aVistas['layout'];
    