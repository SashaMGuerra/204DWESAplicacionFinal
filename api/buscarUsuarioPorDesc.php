<?php
/**
 * REST de búsqueda de usuarios por descripción (no necesaria).
 * 
 * Dada (o no) la descripción de un usuario por parámetro en la url, devuelve
 * los datos de todos los departamentos en JSON.
 * 
 * @author Sasha
 * @since 10/02/2022
 * @version 2.2
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

/* Si en la url se ha especificado una descripción de usuario a buscar, la valida.
 * Si no es correcta, pone el manejador a false.
 */
$bEntradaOK = true;
if(isset($_REQUEST['descUsuario'])){
    if(validacionFormularios::comprobarAlfaNumerico($_REQUEST['descUsuario'], 255, 3, OBLIGATORIO)){
        $bEntradaOK = false;
    }
}

/* Si no hay entrada (no se ha especificado una descripción) o se ha especificado
 * y la entrada ha sido válida, busca los usuarios en la base de datos.
 */
if($bEntradaOK){
    $aUsuariosDevueltos = UsuarioPDO::buscaUsuariosporDesc($_REQUEST['descUsuario']??'');
    $aUsuarios = [];
    
    foreach ($aUsuariosDevueltos as $oUsuario) {
        array_push($aUsuarios, [
            'codUsuario' => $oUsuario->getCodUsuario(),
            'password' => $oUsuario->getPassword(),
            'descUsuario' => $oUsuario->getDescUsuario(),
            'numConexiones' => $oUsuario->getNumConexiones(),
            'fechaHoraUltimaConexion' => $oUsuario->getFechaHoraUltimaConexion(),
            'perfil' => $oUsuario->getPerfil(),
            'imagenUsuario' => $oUsuario->getImagenUsuario()
        ]);
    }
    
    print_r(json_encode($aUsuarios, JSON_PRETTY_PRINT));
}