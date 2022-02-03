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
// Si se selecciona cancelar, vuelve a la página anterior sin realizar cambios.
if (isset($_REQUEST['cancelar'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

$aErrores = [
    'descDepartamento' => '',
    'volumenDeNegocio' => ''
];

// En cualquier caso, muestra la información sobre el departamento.
$oDepartamento = DepartamentoPDO::buscaDepartamentoPorCod($_SESSION['codDepartamentoEnCurso']);

$aVConsultarModificarDepartamento = [
    'codDepartamento' => $oDepartamento->getCodDepartamento(),
    'descDepartamento' => $oDepartamento->getDescDepartamento(),
    'fechaCreacionDepartamento' => date('d/m/Y H:i:s T', $oDepartamento->getFechaCreacionDepartamento()),
    'volumenDeNegocio' => $oDepartamento->getVolumenDeNegocio(),
    'fechaBajaDepartamento' => $oDepartamento->getFechaBajaDepartamento()
];

// Si se aceptan los cambios, valida la entrada y modifica el departamento.
if (isset($_REQUEST['aceptar'])) {
    $bEntradaOK = true;
    
    // Validación de campos.
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfanumerico($_REQUEST['descDepartamento'], 255, 5, OBLIGATORIO);
    $aErrores['volumenNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenDeNegocio'], 5000, 0, OBLIGATORIO);
    
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
// Si no se ha enviado el formulario, pone la entradaOK a false.
else{
    $bEntradaOK = false;
}

/*
 * Si la entrada es correcta, modifica el departamento en la base de datos y
 * regresa a la vista del mantenimiento de departamentos.
 */
if($bEntradaOK){
    DepartamentoPDO::modificaDepartamento($_SESSION['codDepartamentoEnCurso'], $_REQUEST['descDepartamento'], $_REQUEST['volumenDeNegocio']);
    
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Mostrado de la vista.
require_once $aVistas['layout'];
