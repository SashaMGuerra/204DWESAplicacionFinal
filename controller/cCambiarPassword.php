<?php
/**
 * @author Sasha
 * @since 18/01/2022
 * @version 3.0
 * 
 * Controlador de la ventana de cambio de contraseña.
 */

// Si se selecciona cancelar, vuelve al índice privado sin hacer cambios.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'miCuenta';
    header('Location: index.php');
    exit;
}

$aFormulario = [
    'passwordNueva' => ''
];

$aErrores = [
    'passwordActual' => '',
    'passwordNueva' => '',
    'passwordRepeticion' => ''
];

// Si se desea efectuar cambios, valida la entrada.
if(isset($_REQUEST['aceptar'])){
    $bEntradaOK = true;
    
    /* 
     * Comprobación que la antigua contraseña coincida con la de la base de datos.
     * Si no lo hace, opne la entrada a false y guarda el error.
     */
    if(!UsuarioPDO::validarUsuario($_SESSION['usuarioDAW204AppLoginLogout']->getCodUsuario(), $_REQUEST['passwordActual'])){
        $aErrores['passwordActual'] = 'Contraseña incorrecta.';
        $bEntradaOK = false;
    }
    /*
     * Si la contraseña coincide con la introducida, valida la nueva y comprueba
     * si la introducida repetida es igual.
     */
    else{
        // Si la contraseña no cumple con lo especificado, mostrará el error.
        $aErrores['passwordNueva'] = validacionFormularios::validarPassword($_REQUEST['passwordNueva'], 8, 4, 1);
        
        // Si la nueva contraseña no coincide con la repetida, añade el error.
        if($_REQUEST['passwordNueva']!=$_REQUEST['passwordRepeticion']){
            $aErrores['passwordRepeticion'] = 'La contraseña repetida no coincide.';
        }
        
        // Recorrido del array de errores.
        foreach ($aErrores as $sCampo => $sError) {
            if ($sError != null) {
                $_REQUEST[$sCampo] = ''; //Limpieza del campo.
                $bEntradaOK = false;
            }
        }
    }
}
/* Si no se ha seleccionado cambiar contraseña, pone la entrada a false para que
 * no haga cambios.
 */
else{
    $bEntradaOK = false;
}

// Si la entrada es correcta, efectúa cambios.
if($bEntradaOK){
    // Actualización en la base de datos.
    $_SESSION["usuarioDAW204AppLoginLogout"] = UsuarioPDO::cambiarPassword($_SESSION["usuarioDAW204AppLoginLogout"], $_REQUEST['passwordNueva']);
            
    // Regreso al índice público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'miCuenta';
    header('Location: index.php');
    exit;
}


// Carga de la página de detalle.
require_once $aVistas['layout'];
    