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
    $aErrores['language'] = validacionFormularios::validarElementoEnLista($_REQUEST['language'], ['ES', 'EN', 'FR']);

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
 * Según si la devolución ha sido correcta (ha devuelto la palabra) o no (ha
 * devuelto false), mostrará al usuario la palabra o un mensaje de error.
 */
if ($bEntradaOK) {
    $devuelto = @file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/{$_REQUEST['language']}/{$_REQUEST['word']}");
    $devuelto = $devuelto?json_decode($devuelto)[0]:'No se han obtenido resultados';
}

$aVREST = [
    'word' => $_REQUEST['word'] ?? '',
    'language' => $_REQUEST['language'] ?? '',
    'resultado' => !empty($devuelto)?$devuelto:''
];

/*
 * Si no se ha enviado el formulario, o si se ha enviado pero estaba incorrecto,
 * se muestra la vista del login.
 */
require_once $aVistas['layout'];
