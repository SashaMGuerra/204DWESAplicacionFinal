<?php

/**
 * Controlador de la ventana de creación de un departamento.
 * 
 * Muestra los campos para ser creado, y lo hace si el usuario acepta.
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

$aErrores = [
    'codDepartamento' => '',
    'descDepartamento' => '',
    'volumenDeNegocio' => ''
];

// Si se aceptan los cambios, valida la entrada.
if (isset($_REQUEST['aceptar'])) {
    $bEntradaOK = true;
    
    // Validación de campos.
    $aErrores['codDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codDepartamento'], 3, 3, OBLIGATORIO);
    /*
     * Comprobación si el código de departamento está en mayúsculas, y si no lo está
     * (es correcto), comprobación de si el código ya existe en la base de datos.
     */
    if($_REQUEST['codDepartamento'] !== strtoupper($_REQUEST['codDepartamento'])){
        $aErrores['codDepartamento'] = 'El código debe estar en mayúsculas.';
    }
    else if(DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codDepartamento'])){
        $aErrores['codDepartamento'] = 'Ya existe un departamento con ese código.';
    }
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfanumerico($_REQUEST['descDepartamento'], 255, 5, OBLIGATORIO);
    $aErrores['volumenDeNegocio'] = validacionFormularios::comprobarFloat($_REQUEST['volumenDeNegocio'], 5000, 0, OBLIGATORIO);
    
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
 * Si la entrada es correcta, crea el departamento en la base de datos y
 * regresa a la vista del mantenimiento de departamentos.
 */
if($bEntradaOK){
    DepartamentoPDO::altaDepartamento($_REQUEST['codDepartamento'], $_REQUEST['descDepartamento'], $_REQUEST['volumenDeNegocio']);
    
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Mostrado de la vista.
require_once $aVistas['layout'];
