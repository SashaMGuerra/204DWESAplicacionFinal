<?php
/**
 * @author Sasha
 * @since 22/12/2021
 * @version 1.0
 * 
 * Controlador del login.
 * Requiere la vista del login.
 */

// Si se cancela la operación de login, regresa al inicio público.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: index.php');
    exit;
}

// Información del formulario.
$aFormulario = [
    'usuario' => '',
    'password' => ''
];

/*
 * Si se ha enviado el formulario para hacer login, valida la entrada y comprueba que el usuario
 * y contraseña sean correctos para iniciar sesión.
 */
if(isset($_REQUEST['login'])){
    // Manejador de errores.
    $bEntradaOK = true;

    // Si los datos introducidos no son válidos, pone la entrada a false.
    if (validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 8, 4, OBLIGATORIO)
            || validacionFormularios::comprobarAlfaNumerico($_REQUEST['password'], 8, 4, OBLIGATORIO)) {
        $bEntradaOK = false;
    }
    /*
     * Si el usuario y password se han introducido de forma correcta, se conecta
     * con la base de datos para comprobar su existencia.
     */
    else{
        /* Recogida de información */
        $aFormulario['usuario'] = $_REQUEST['usuario'];
        $aFormulario['password'] = $_REQUEST['password'];
        
        /**
         * Si el usuario no existe o la contraseña es incorrecta, pone la entradaOK
         * a false.
         */
        $oUsuarioValido = UsuarioPDO::validarUsuario($aFormulario['usuario'], $aFormulario['password']);
        if(!$oUsuarioValido){
            $bEntradaOK = false;
        }
    }
}
/* 
 * Si no se ha enviado el formulario, pone el manejador a false.
 */
else{
    $bEntradaOK = false;
}

/*
 * Si la entrada es correcta, se conecta con la base de datos para registrar
 * la última conexión y pasar a la página de inicio.
 */
if ($bEntradaOK) {
    $oUsuarioValido = UsuarioPDO::registrarUltimaConexion($oUsuarioValido);
    $_SESSION['usuarioDAW204AppLoginLogout'] = $oUsuarioValido;

    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}

/*
 * Si no se ha enviado el formulario, o si se ha enviado pero estaba incorrecto,
 * se muestra la vista del login.
 */
require_once $aVistas['layout'];