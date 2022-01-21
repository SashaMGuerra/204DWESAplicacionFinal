<?php
/**
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Controlador para la página de mostrado de errores.
 */

/*
 * Si se selecciona cerrar la página, destruye la variable de sesión de error
 * y vuelve al inicio privado.
 */
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaAnterior'] = '';
    $_SESSION['paginaEnCurso'] = $_SESSION['error']->getPaginaSiguiente();
    unset($_SESSION['error']);
    header('Location: index.php');
    exit;
}

// Array con la información de la vista.
$aVError = [
    'error' => $_SESSION['error']->getDescError(),
    'codigo' => $_SESSION['error']->getCodError(),
    'archivo' => $_SESSION['error']->getArchivoError(),
    'linea' => $_SESSION['error']->getLineaError()
];

// Carga de la página de inicio.
require_once $aVistas['layout'];
    