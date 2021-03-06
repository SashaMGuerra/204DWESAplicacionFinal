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
    unset($_SESSION['criterioBusquedaDepartamentos']);
    unset($_SESSION['paginacionDepartamentos']);
    unset($_SESSION['codDepartamentoEnCurso']);

    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}

/**
 * Si se selecciona exportar departamentos (xml), crea el documento para ser
 * exportado, y acude al controlador de exportar departamentos para ser descargado
 * por el usuario.
 */
if (isset($_REQUEST['exportar'])) {
    /*
    $_SESSION['URLArchivoEnCurso'] = DepartamentoPDO::exportarDepartamentosXML();
    
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'exportarDepartamentos';
    header('Location: index.php');
    exit;
     * 
     */
}


// Si se selecciona añadir un departamento, va a la página.
if (isset($_REQUEST['anadir'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['anadir'];

    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'altaDepartamento';
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

/*
 * Si se selecciona eliminar un departamento, guarda en la sesión el código
 * del departamento a modificar, y va a la página.
 */
if (isset($_REQUEST['eliminar'])) {
    $_SESSION['codDepartamentoEnCurso'] = $_REQUEST['eliminar'];

    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'eliminarDepartamento';
    header('Location: index.php');
    exit;
}

// Si se selecciona dar de baja lógica un departamento, lo hace.
if (isset($_REQUEST['bajaLogica'])) {
    DepartamentoPDO::bajaLogicaDepartamento($_REQUEST['bajaLogica']);

    // Recarga la página.
    header('Location: index.php');
    exit;
}

// Si se selecciona rehabilitar de una baja lógica un departamento, lo hace.
if (isset($_REQUEST['rehabilitar'])) {
    DepartamentoPDO::rehabilitaDepartamento($_REQUEST['rehabilitar']);

    // Recarga la página.
    header('Location: index.php');
    exit;
}

// Botones de paginación.
if (isset($_REQUEST['paginaPrimera'])) {
    $_SESSION['paginacionDepartamentos']['numPagina'] = 1;

    // Recarga la página.
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['paginaAnterior']) && $_SESSION['paginacionDepartamentos']['numPagina']>=2) {
    $_SESSION['paginacionDepartamentos']['numPagina']--;

    // Recarga la página.
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['paginaSiguiente']) && $_SESSION['paginacionDepartamentos']['numPagina']<$_SESSION['paginacionDepartamentos']['totalPaginas']) {
    $_SESSION['paginacionDepartamentos']['numPagina']++;

    // Recarga la página.
    header('Location: index.php');
    exit;
}
if (isset($_REQUEST['paginaUltima'])) {
    $_SESSION['paginacionDepartamentos']['numPagina'] = $_SESSION['paginacionDepartamentos']['totalPaginas'];

    // Recarga la página.
    header('Location: index.php');
    exit;
}

// Array de errores.
$aErrores = [
    'descDepartamento' => '',
    'estado' => ''
];

// Si el formulario ha sido enviado, valida el campo y registra los errores.
if (isset($_REQUEST['buscar'])) {
    $bEntradaOK = true;

    // Validación del campo.
    $aErrores['descDepartamento'] = validacionFormularios::comprobarAlfanumerico($_REQUEST['descDepartamento'], 255, 1, OPCIONAL);
    $aErrores['estado'] = validacionFormularios::validarElementoEnLista($_REQUEST['estado'], ['alta', 'baja', 'todos']);

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
    $_SESSION['criterioBusquedaDepartamentos']['descripcionBusqueda'] = $_REQUEST['descDepartamento'];
    switch ($_REQUEST['estado']) {
        case 'baja':
            $iEstado = DepartamentoPDO::DEPARTAMENTOS_BAJA;
            break;
        case 'alta':
            $iEstado = DepartamentoPDO::DEPARTAMENTOS_ALTA;
            break;
        case 'todos':
            $iEstado = DepartamentoPDO::DEPARTAMENTOS_TODOS;
            break;
    }
    $_SESSION['criterioBusquedaDepartamentos']['estado'] = $iEstado;
    $_SESSION['paginacionDepartamentos']['numPagina'] = 1;
}

// Si no tiene indicado un número de página, lo crea en 1.
if (!isset($_SESSION['paginacionDepartamentos']['numPagina'])) {
    $_SESSION['paginacionDepartamentos']['numPagina'] = 1;
}

/**
 * Se haya enviado o no el formulario, realiza la búsqueda de departamentos para
 * mostrarlos.
 */
$_SESSION['paginacionDepartamentos']['totalPaginas'] = DepartamentoPDO::contarPaginasDepartamentos(
        $_SESSION['criterioBusquedaDepartamentos']['descripcionBusqueda'] ?? '',
        $_SESSION['criterioBusquedaDepartamentos']['estado'] ?? DepartamentoPDO::DEPARTAMENTOS_TODOS);
$aVMtoDepartamentos = [];
$aDepartamentos = DepartamentoPDO::buscaDepartamentosPorDescEstado(
        $_SESSION['criterioBusquedaDepartamentos']['descripcionBusqueda'] ?? '',
        $_SESSION['criterioBusquedaDepartamentos']['estado'] ?? DepartamentoPDO::DEPARTAMENTOS_TODOS,
        $_SESSION['paginacionDepartamentos']['numPagina']);
if ($aDepartamentos) {
    foreach ($aDepartamentos as $oDepartamento) {
        array_push($aVMtoDepartamentos, [
            'codDepartamento' => $oDepartamento->getCodDepartamento(),
            'descDepartamento' => $oDepartamento->getDescDepartamento(),
            'fechaCreacionDepartamento' => date('d/m/Y H:i:s T', $oDepartamento->getFechaCreacionDepartamento()),
            'volumenDeNegocio' => $oDepartamento->getVolumenDeNegocio(),
            'fechaBajaDepartamento' => !empty($oDepartamento->getFechaBajaDepartamento()) ? date('d/m/Y H:i:s T', $oDepartamento->getFechaBajaDepartamento()) : ''
        ]);
    }
}

// Mostrado de la vista.
require_once $aVistas['layout'];
