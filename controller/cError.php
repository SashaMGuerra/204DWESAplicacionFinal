<?php
/**
 * Controlador para la página de mostrado de errores.
 * 
 * Muestra información sobre el error sucedido, y permite al usuario regresar a
 * una página indicada por el error.
 * 
 * @author Sasha
 * @since 12/01/2022
 * @version 1.0
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
    