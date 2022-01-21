<?php
/**
 * @author Sasha
 * @since 20/01/2022
 * @version 3.0
 * 
 * Controlador de la ventana de borrar cuenta..
 * Muestra una confirmación para borrar la cuenta.
 */

// Si se selecciona cancelar, vuelve a miCuenta sin hacer cambios.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'miCuenta';
    header('Location: index.php');
    exit;
}

// Si se desea eliminar cuenta, lo hace, destruye la sesión y recarga el index.
if (isset($_REQUEST['aceptar'])) {
    UsuarioPDO::borrarUsuario($_SESSION['usuarioDAW204AppLoginLogout']);
    
    session_unset();
    session_destroy();
    header('Location: index.php');
    exit;
}

// Carga de la página de detalle.
require_once $aVistas['layout'];
    