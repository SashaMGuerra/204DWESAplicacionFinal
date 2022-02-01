<?php

/**
 * Controlador del mantenimiento de departamentos.
 * 
 * Muestra la ventana de mantenimiento de departamentos, en que aparecen en una
 * lista.
 * Envía al usuario a las ventanas de detalle para realizar operaciones.
 * 
 * @author Sasha
 * @since 31/01/2022
 * @version 2.0
 */
// Si se selecciona volver, vuelve a la página anterior..
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}

/*
 * Si se selecciona modificar un departamento, guarda en la sesión el código
 * del departamento a modificar, y va a la página.
 */
if (isset($_REQUEST['modificar'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['modificar'];
    
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'consultarModificarDepartamento';
    header('Location: index.php');
    exit;
}

// Búsqueda deseada por el usuario.
$aFormulario = [
    'descDepartamento' => ''
];
// Array de errores.
$aErrores = [
    'descDepartamento' => ''
];

// Si el formulario ha sido enviado, valida el campo y registra los errores.
if (isset($_REQUEST['buscar'])) {
    $bEntradaOK = true;

    // Validación del campo.
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfanumerico($_REQUEST['descDepartamento'], 255, 1, OPCIONAL);

    /*
     * Recorrido del array de errores.
     * Si existe alguno, cambia el manejador de errores a false
     * y limpia el campo en el $_REQUEST.
     */
    foreach ($aErrores as $sCampo => $sError) {
        if ($sError != null) {
            $_REQUEST[$sCampo] = ''; //Limpieza del campo.
            $bEntradaOK = false;
        }
    }
}
/* Si el formulario no ha sido enviado, pone el manejador de errores a false
 * para que no entre en el if tras el correcto.
 */ else {
    $bEntradaOK = false;
}

/* Si el formulario ha sido enviado y no ha tenido errores guarda la información
 * a buscar.
 */
if ($bEntradaOK) {
    $aFormulario['descDepartamento'] = $_REQUEST['descDepartamento'];
}

/**
 * Se haya enviado o no el formulario, realiza la búsqueda de departamentos para
 * mostrarlos.
 */
$aVMtoDepartamentos = [];
$aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDesc($aFormulario['descDepartamento']);
if ($aDepartamentos) {
    foreach ($aDepartamentos as $oDepartamento) {
        array_push($aVMtoDepartamentos, [
            'codDepartamento' => $oDepartamento->getCodDepartamento(),
            'descDepartamento' => $oDepartamento->getDescDepartamento(),
            'fechaCreacionDepartamento' => date('d/m/Y H:i:s T', $oDepartamento->getFechaCreacionDepartamento()),
            'volumenDeNegocio' => $oDepartamento->getVolumenDeNegocio(),
            'fechaBajaDepartamento' => $oDepartamento->getFechaBajaDepartamento()
        ]);
    }
}




// Mostrado de la vista.
require_once $aVistas['layout'];
