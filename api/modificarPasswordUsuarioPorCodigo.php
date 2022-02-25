<?php
/**
 * REST de modificación de password de un usuario por código.
 * 
 * Pasado el código de un usuario en la url y una nueva contraseña, la modifica.
 * 
 * @package APIRests
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

/* Valida la entrada, y si es incorrecta, pone la entrada a false.
 */
$bEntradaOK = true;
if(isset($_REQUEST['codUsuario']) && isset($_REQUEST['password'])){
    if(!empty(validacionFormularios::comprobarAlfaNumerico($_REQUEST['codUsuario'], 8, 4, OBLIGATORIO)
            || !empty(validacionFormularios::validarPassword($_REQUEST['password'], 8, 4, 1, OBLIGATORIO)))){
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
// Si no se ha indicado alguno de los parámetros, da error.
else{
    $bEntradaOK = false;
    $sError = 'No se ha especificado el usuario, la nueva contraseña o ambos.';
}

/* Si la entrada ha sido válida, lo modifica.
 */
if($bEntradaOK){
    print_r(json_encode(UsuarioPDO::cambiarPassword($oUsuario, $_REQUEST['password'])?'Modificado correctamente.':'No se ha podido modificar.', JSON_PRETTY_PRINT));
}
// Si la entrada ha sido incorrecta, muestra un mensaje de error.
else{
    print_r(json_encode($sError, JSON_PRETTY_PRINT));
}