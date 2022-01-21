<?php
/**
 * @author Sasha
 * @since 04/01/2022
 * @version 2.0
 * 
 * Controlador de la página de registro.
 * Requiere la vista del registro.
 */

// Si se cancela, devuelve a la página de inicio público.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
    header('Location: index.php');
    exit;
}

// Información del formulario.
$aFormulario = [
    'usuario' => '',
    'descripcion' => '',
    'password' => ''
];

// Variable de mensaje de error.
$sError = '';

/*
 * Si se selecciona crear usuario, valida la entrada y comprueba que el usuario
 * no exista ya en la base de datos.
 */
if(isset($_REQUEST['anadirUsuario'])){   
    // Manejador de errores.
    $bEntradaOK = true;
    
    /*
     * Si el usuario, descripción o password no están definidos, o si se ha introducido de
     * forma incorrecta, pone la entrada como incorrecta.
     */
    if (validacionFormularios::comprobarAlfaNumerico($_REQUEST['usuario'], 8, 4, OBLIGATORIO) ||
        validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 3, OBLIGATORIO) ||
            validacionFormularios::validarPassword($_REQUEST['password'], 8, 4, 1)) {
        $sError = 'Tanto el usuario como la contraseña deben tener entre 8 y 4 caracteres.<br>Nombre y apellidos deben tener mínimo 3 caracteres.';
    }
    /*
     * Si la entrada es válida, comprueba si existe el usuario en la base de 
     * datos.
     */
    else{      
        $oUsuarioValido = UsuarioPDO::validarCodNoExiste($_REQUEST['usuario']);
        if($oUsuarioValido){
            $sError = 'El usuario ya existe.';
        }
    }
    
    // Si hay algún error, pone la entradaOK a false.
    if(!empty($sError)){
        $bEntradaOK = false;
    }
}
/* 
 * Si no se ha enviado el formulario, pone el manejador a false.
 */
else{
    $bEntradaOK = false;
}

/*
 * Si la entrada es correcta, se conecta con la base de datos para crear el usuario,
 * iniciar sesión y enviar a la página de inicio.
 */
if($bEntradaOK){
    $oUsuario = UsuarioPDO::altaUsuario($_REQUEST['usuario'], $_REQUEST['password'], $_REQUEST['descripcion']);
            
    // Almacenamiento del usuario y la fecha-hora de última conexión.
    $_SESSION['usuarioDAW204AppLoginLogout'] = $oUsuario;

    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}

// Carga de la vista del registro.
require_once $aVistas['layout'];
    