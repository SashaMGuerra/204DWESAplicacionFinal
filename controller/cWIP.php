<?php
/**
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Controlador para la página de desarrrollo.
 * Tiene un botón para regresar al inicio privado.
 */

// Si se selecciona volver a la página en que estaba, lo hace.
if(isset($_REQUEST['volver'])){
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Carga de la página WIP.
require_once $aVistas['layout'];
    