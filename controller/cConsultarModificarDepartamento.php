<?php
/**
 * Controlador de la ventana de consulta o modificación de un departamento.
 * 
 * Muestra la información del departamento, y realiza cambios si el usuario lo
 * ha indicado.
 * 
 * @author Sasha
 * @since 01/02/2022
 * @version 2.0
 */

// Si se selecciona volver, vuelve a la página anterior.
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}


// Mostrado de la vista.
require_once $aVistas['layout'];
