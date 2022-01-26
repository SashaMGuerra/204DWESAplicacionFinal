<?php

/**
 * @author Sasha
 * @since 25/12/2021
 * @version 1.0
 * 
 * Controlador del REST.
 */

// Si se selecciona volver, vuelve a la página anterior..
if (isset($_REQUEST['volver'])) {
    $_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
    $_SESSION['paginaAnterior'] = '';
    header('Location: index.php');
    exit;
}

$aErrores = [
    'word' => '',
    'language' => ''
];

// Si se ha enviado el formulario, valida la entrada.
if (isset($_REQUEST['enviar'])) {
    $bEntradaOK = true;

    $aErrores['word'] = validacionFormularios::comprobarAlfabetico($_REQUEST['word'], 300, 1, OBLIGATORIO);
    $aErrores['language'] = validacionFormularios::validarElementoEnLista($_REQUEST['language'], ['ES', 'EN', 'PT', 'FR']);

    foreach ($aErrores as $sKey => $sError) {
        if (!empty($sError)) {
            $bEntradaOK = false;
            $_REQUEST[$sKey] = '';
        }
    }
}
// Si no se ha enviado el formulario, pone el manejador de errores a false.
else {
    $bEntradaOK = false;
}

/*
 * Si la entrada es válida, llama a la api con el idioma y palabra indicados.
 * Según si la devolución ha sido correcta (ha devuelto la palabra) o no (warning)
 * mostrará al usuario la palabra o un mensaje de error.
 */
if ($bEntradaOK) {
    // Si la palabra tiene letras con caracteres especiales, los sustituye.
    $sPalabra = $_REQUEST['word'];
    $sPalabra = str_replace(['á', 'à', 'â'], 'a', $sPalabra);
    $sPalabra = str_replace(['é', 'è', 'ê'], 'e', $sPalabra);
    $sPalabra = str_replace(['í', 'ì', 'î'], 'i', $sPalabra);
    $sPalabra = str_replace(['ó', 'ò', 'ô'], 'o', $sPalabra);
    $sPalabra = str_replace(['ú', 'ù', 'û', 'ü'], 'u', $sPalabra);    
    $_REQUEST['word'] = $sPalabra;
    
    $devolucion = REST::buscarPalabra($_REQUEST['language'], $_REQUEST['word']);
}

$aVREST = [
    'word' => $_REQUEST['word'] ?? '',
    'language' => $_REQUEST['language'] ?? '',
    'resultado' => !empty($devolucion)?$devolucion:'' // Si es la primera vez que se carga la página, no hay ningún resultado.
];

/*
 * Si no se ha enviado el formulario, o si se ha enviado pero estaba incorrecto,
 * se muestra la vista del login.
 */
require_once $aVistas['layout'];
