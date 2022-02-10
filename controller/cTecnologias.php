<?php
/**
 * Controlador de la ventana de tecnologías.
 * 
 * Muestra una infografía sobre las tecnologías utilizadas.
 * 
 * @author Sasha
 * @since 26/01/2022
 * @version 1.0
 */

// Si se selecciona volver, vuelve a la página anterior..
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Carga de la página de detalle.
require_once $aVistas['layout'];
    