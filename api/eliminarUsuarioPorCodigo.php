<?php
/**
 * REST de eliminación de un usuario por código.
 * 
 * Pasado el código de un usuario en la url, elimina el usuario de la base de
 * datos del servidor.
 * 
 * @author Sasha
 * @since 21/02/2022
 * @version 3.0
 */

define("OBLIGATORIO", 1);
define("OPCIONAL", 0);

require_once '../core/libreriaValidacion.php';
require_once '../config/configDB.php';
require_once '../model/DB.php';
require_once '../model/DBPDO.php';
require_once '../model/UsuarioDB.php';
require_once '../model/UsuarioPDO.php';
require_once '../model/Usuario.php';

/* Valida la entrada, y si es correcta, valida que exista el usuario en la base
 * de datos.
 */
$bEntradaOK = true;
if(isset($_REQUEST['codUsuario'])){
    if(validacionFormularios::comprobarAlfaNumerico($_REQUEST['codUsuario'], 8, 4, OBLIGATORIO)){
        $bEntradaOK = false;
        $sError = 'Entrada incorrecta.';
    }
    else{
        // Si el usuario no existe, pone la entrada OK a false.
        $oUsuario = UsuarioPDO::validarCodNoExiste($_REQUEST['codUsuario']);
        if(!$oUsuario){
            $bEntradaOK = false;
            $sError = 'No existe un usuario con ese código.';
        }
    }
}
// Si no se ha indicado el parámetro, da error.
else{
    $bEntradaOK = false;
    $sError = 'No se ha especificado un código de usuario.';
}

/* Si la entrada ha sido válida y el usuario existe, lo elimina.
 */
if($bEntradaOK){
    // Utiliza el objeto usuario devuelto por el validarCodNoExiste para eliminarlo.
    print_r(json_encode(UsuarioPDO::borrarUsuario($oUsuario)?'Eliminado correctamente.':'No se ha podido eliminar', JSON_PRETTY_PRINT));
}
// Si la entrada ha sido incorrecta, muestra un mensaje de error.
else{
    print_r(json_encode($sError, JSON_PRETTY_PRINT));
}