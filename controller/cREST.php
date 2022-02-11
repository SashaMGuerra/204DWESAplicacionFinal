<?php
/**
 * Controlador del REST.
 * 
 * Muestra y permite utilizar API REST externos en la aplicación.
 * 
 * @author Sasha
 * @since 25/12/2021
 * @version 1.0
 */

/* Si se selecciona volver, elimina la variable de sesión de RESTEnCurso
 * y vuelve a la página anterior.
 */
if (isset($_REQUEST['volver'])) {
    unset($_SESSION['RESTEnCurso']);
    
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

// Para mostrar un REST u otro del menú.
if(isset($_REQUEST['RESTEnCurso'])){
    $_SESSION['RESTEnCurso'] = $_REQUEST['RESTEnCurso'];
    
    // Recarga de la página para mostrar la sección.
    header('Location: index.php');
    exit;
}

$aErroresDiccionario = [
    'word' => '',
    'language' => ''
];

// Si se ha enviado el formulario, valida la entrada.
if (isset($_REQUEST['buscarPalabra'])) {
    $bEntradaOKPalabra = true;

    $aErroresDiccionario['word'] = validacionFormularios::comprobarAlfabetico($_REQUEST['word'], 300, 1, OBLIGATORIO);
    $aErroresDiccionario['language'] = validacionFormularios::validarElementoEnLista($_REQUEST['language'], ['ES', 'EN', 'PT', 'FR']);

    foreach ($aErroresDiccionario as $sKey => $sError) {
        if (!empty($sError)) {
            $bEntradaOKPalabra = false;
            $_REQUEST[$sKey] = '';
        }
    }
}
// Si no se ha enviado el formulario, pone el manejador de errores a false.
else {
    $bEntradaOKPalabra = false;
}

// REST Diccionario.
$aVRESTDiccionario = [
    'language' => $_REQUEST['language'] ?? '',
    'resultado' => '' // Si es la primera vez que se carga la página, no hay ningún resultado.
];

/*
 * Si la entrada es válida, llama a la api con el idioma y palabra indicados.
 * Según si la devolución ha sido correcta (ha devuelto la palabra) o no (warning)
 * mostrará al usuario la palabra o un mensaje de error.
 */
if ($bEntradaOKPalabra) {
    // Si la palabra tiene letras con caracteres especiales, los sustituye.
    $sPalabra = $_REQUEST['word'];
    $sPalabra = str_replace(['á', 'à', 'â'], 'a', $sPalabra);
    $sPalabra = str_replace(['é', 'è', 'ê'], 'e', $sPalabra);
    $sPalabra = str_replace(['í', 'ì', 'î'], 'i', $sPalabra);
    $sPalabra = str_replace(['ó', 'ò', 'ô'], 'o', $sPalabra);
    $sPalabra = str_replace(['ú', 'ù', 'û', 'ü'], 'u', $sPalabra);   
    $sPalabra = str_replace(['ñ'], 'n', $sPalabra);
    
    $devolucion = REST::buscarPalabra($_REQUEST['language'], $sPalabra);
    if(!empty($devolucion)){
        $aVRESTDiccionario['resultado'] = [
            'palabra' => $devolucion->getPalabra(),
            'origen' => $devolucion->getOrigen(),
            'significados' => $devolucion->getSignificados()
        ];
    }
    else{
        $aVRESTDiccionario['resultado'] = 'No se han encontrado resultados.';
    }
}

// REST Conversor.
$aErroresConversor = [
    'divisaOrigen' => '',
    'cantidad' => '',
    'divisaResultado' => '',
    'resultado' => ''
];

// Si se ha enviado el formulario, valida la entrada.
if (isset($_REQUEST['convertir'])) {
    $bEntradaOKConversor = true;

    $aErroresConversor['divisaOrigen'] = validacionFormularios::comprobarAlfabetico($_REQUEST['divisaOrigen'], 3, 3, OBLIGATORIO);
    $aErroresConversor['divisaOrigen'] .= $_REQUEST['divisaOrigen']!==strtoupper($_REQUEST['divisaOrigen'])?' Debe estar en mayúscula.':'';
    $aErroresConversor['cantidad'] = validacionFormularios::comprobarFloat($_REQUEST['cantidad'], PHP_INT_MAX, 0, OBLIGATORIO);
    $aErroresConversor['divisaResultado'] = validacionFormularios::comprobarAlfabetico($_REQUEST['divisaResultado'], 3, 3, OBLIGATORIO);
    $aErroresConversor['divisaResultado'] .= $_REQUEST['divisaResultado']!==strtoupper($_REQUEST['divisaResultado'])?' Debe estar en mayúscula.':'';

    foreach ($aErroresConversor as $sKey => $sError) {
        if (!empty($sError)) {
            $bEntradaOKConversor = false;
            $_REQUEST[$sKey] = '';
        }
    }
}
// Si no se ha enviado el formulario, pone el manejador de errores a false.
else {
    $bEntradaOKConversor = false;
}

/*
 * Si la entrada es válida, llama a la api con las divisas indicadas.
 * Según si la devolución ha sido correcta (ha devuelto el valor tras la conversión)
 * o no (false) mostrará el valor o "error".
 */
if ($bEntradaOKConversor) {
    $iDivisaResultado = REST::conversorMoneda($_REQUEST['cantidad'], $_REQUEST['divisaOrigen'], $_REQUEST['divisaResultado']);
    $aErroresConversor['resultado'] = is_null($iDivisaResultado)?'Alguno de los códigos de divisa no existe.':'';
}

$aVRESTConversor = [
    'divisaOrigen' => $_REQUEST['divisaOrigen'] ?? '',
    'cantidad' => $_REQUEST['cantidad'] ?? '',
    'divisaResultado' => $_REQUEST['divisaResultado']??'',
    'resultadoConversion' => $iDivisaResultado??0 // Si es la primera vez que se carga la página, no hay ningún resultado.
];

// REST propio.

$aErroresPropio = [
    'codDepartamento' => ''
];

// Si se ha enviado el formulario, valida la entrada.
if (isset($_REQUEST['buscarDepartamento'])) {
    $bEntradaOKPropio = true;

    $aErroresPropio['codDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codDepartamento'], 3, 3, OBLIGATORIO);

    foreach ($aErroresPropio as $sKey => $sError) {
        if (!empty($sError)) {
            $bEntradaOKPropio = false;
            $_REQUEST[$sKey] = '';
        }
    }
}
// Si no se ha enviado el formulario, pone el manejador de errores a false.
else {
    $bEntradaOKPropio = false;
}

$aVRESTPropio = [
    'codDepartamento' => $_REQUEST['codDepartamento'] ?? '',
    'resultado' => '' // Si es la primera vez que se carga la página, no hay ningún resultado.
];

/*
 * Si la entrada es válida, llama a la api con el código de departamento indicado.
 * Según si la devolución ha sido correcta (ha devuelto el departamento) o no (texto)
 * mostrará al usuario la palabra o el mensaje de error.
 */
if ($bEntradaOKPropio) {
    $devolucion = REST::buscarDepartamentoPorCodigoPropio($_REQUEST['codDepartamento']);
    // Si es un objeto, extrae su información en un array.
    if(is_object($devolucion)){
        $aVRESTPropio['resultado'] = [
            'codDepartamento' => $devolucion->getCodDepartamento(),
            'descDepartamento' => $devolucion->getDescDepartamento(),
            'fechaCreacionDepartamento' => date('d/m/Y H:i:s T', $devolucion->getFechaCreacionDepartamento()),
            'volumenDeNegocio' => $devolucion->getVolumenDeNegocio(),
            'fechaBajaDepartamento' => !empty($devolucion->getFechaBajaDepartamento()) ? date('d/m/Y H:i:s T', $devolucion->getFechaBajaDepartamento()) : ''
        ];
    }
    // Si no es un objeto, será un string que devuelva un mensaje de error.
    else{
        $aVRESTPropio['resultado'] = $devolucion;
    }
}

// REST ajeno.

$aErroresAjeno = [
    'codDepartamento' => ''
];

// Si se ha enviado el formulario, valida la entrada.
if (isset($_REQUEST['buscarDepartamento'])) {
    $bEntradaOKAjeno = true;

    $aErroresAjeno['codDepartamento'] = validacionFormularios::comprobarAlfabetico($_REQUEST['codDepartamento'], 3, 3, OBLIGATORIO);

    foreach ($aErroresAjeno as $sKey => $sError) {
        if (!empty($sError)) {
            $bEntradaOKAjeno = false;
            $_REQUEST[$sKey] = '';
        }
    }
}
// Si no se ha enviado el formulario, pone el manejador de errores a false.
else {
    $bEntradaOKAjeno = false;
}

$aVRESTAjeno = [
    'codDepartamento' => $_REQUEST['codDepartamento'] ?? '',
    'resultado' => '' // Si es la primera vez que se carga la página, no hay ningún resultado.
];

/*
 * Si la entrada es válida, llama a la api con el código de departamento indicado.
 * Según si la devolución ha sido correcta (ha devuelto el departamento) o no (texto)
 * mostrará al usuario la palabra o el mensaje de error.
 */
if ($bEntradaOKAjeno) {
    $devolucion = REST::buscarDepartamentoPorCodigoOscar($_REQUEST['codDepartamento']);
    // Si es un objeto, extrae su información en un array.
    if(is_object($devolucion)){
        $aVRESTAjeno['resultado'] = [
            'codDepartamento' => $devolucion->getCodDepartamento(),
            'descDepartamento' => $devolucion->getDescDepartamento(),
            'fechaCreacionDepartamento' => $devolucion->getFechaCreacionDepartamento(),
            'volumenDeNegocio' => $devolucion->getVolumenDeNegocio(),
            'fechaBajaDepartamento' => !empty($devolucion->getFechaBajaDepartamento()) ? date('d/m/Y H:i:s T', $devolucion->getFechaBajaDepartamento()) : ''
        ];
    }
    // Si no es un objeto, será un string que devuelva un mensaje de error.
    else{
        $aVRESTAjeno['resultado'] = $devolucion;
    }
}

/*
 * Si no se ha enviado el formulario, o si se ha enviado pero estaba incorrecto,
 * se muestra la vista del login.
 */
require_once $aVistas['layout'];
