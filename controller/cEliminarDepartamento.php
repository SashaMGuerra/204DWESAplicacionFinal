<?php

/**
 * Controlador de la ventana de eliminación de un departamento.
 * 
 * Muestra la información del departamento, y lo elimina si el usuario acepta.
 * 
 * @author Sasha
 * @since 02/02/2022
 * @version 2.0
 */

// Si se selecciona cancelar, vuelve a la página anterior sin realizar cambios.
if (isset($_REQUEST['cancelar'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// En cualquier caso, muestra la información sobre el departamento.
$oDepartamento = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamentoEnCurso']);

$aVEliminarDepartamento = [
    'codDepartamento' => $oDepartamento->getCodDepartamento(),
    'descDepartamento' => $oDepartamento->getDescDepartamento(),
    'fechaCreacionDepartamento' => date('d/m/Y H:i:s T', $oDepartamento->getFechaCreacionDepartamento()),
    'volumenDeNegocio' => $oDepartamento->getVolumenDeNegocio(),
    'fechaBajaDepartamento' => $oDepartamento->getFechaBajaDepartamento()
];

// Si se acepta, elimina el departamento y regresa a la página anterior.
if (isset($_REQUEST['aceptar'])) {
    DepartamentoPDO::bajaFisicaDepartamento($_SESSION['codDepartamentoEnCurso']);
    
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Mostrado de la vista.
require_once $aVistas['layout'];
