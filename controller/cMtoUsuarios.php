<?php
/**
 * Controlador del mantenimiento de usuarios.
 * 
 * Muestra la ventana de mantenimiento de usuarios, en que se utiliza javascript
 * para utilizar el servicio web correspondiente.
 * 
 * @author Sasha
 * @since 15/02/2022
 * @version 2.3
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
