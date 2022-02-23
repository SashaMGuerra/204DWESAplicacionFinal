<?php
/**
 * REST de búsqueda de departametno por código.
 * 
 * Dado el código de un departamento por parámetro por la url, devuelve los
 * datos del departamento en formato JSON al usuario si lo encuentra.
 * 
 * @package APIRests
 * @author Sasha
 * @since 07/02/2022
 * @version 2.1
 */

require_once '../config/configDB.php';
require_once '../model/DB.php';
require_once '../model/DBPDO.php';
require_once '../model/DepartamentoPDO.php';
require_once '../model/Departamento.php';

$sError = '';

// Si el usuario ha pasado un código de departamento, lo busca en la base de datos.
if(isset($_REQUEST['codDepartamento'])){
    $bEntradaOK = true;
    
    $oDepartamento = DepartamentoPDO::buscaDepartamentoPorCod($_REQUEST['codDepartamento']);

    // Si ha devuelto un departamento, crea un array con sus datos.
    if($oDepartamento){
        $aDepartamento = [
            'codDepartamento' => $oDepartamento->getCodDepartamento(),
            'descDepartamento' => $oDepartamento->getDescDepartamento(),
            'fechaCreacionDepartamento' => $oDepartamento->getFechaCreacionDepartamento(),
            'volumenDeNegocio' => $oDepartamento->getVolumenDeNegocio(),
            'fechaBajaDepartamento' => $oDepartamento->getFechaBajaDepartamento(),
        ];
    }
    // Si no ha devuelto un departamento, pone la entrada a false.
    else{
        $sError = 'No existe un departamento con ese código.';
        $bEntradaOK = false;
    }
}
// Si no se ha pasado un código de departamento, pone la entrada a false.
else{
    $sError = 'Se requiere un código de departamento (?codDepartamento=AAA).';
    $bEntradaOK = false;
}

// Si la entrada es correcta, codifica en JSON el array con el departamento y lo muestra.
if($bEntradaOK){
    echo json_encode($aDepartamento, JSON_PRETTY_PRINT);
}
// Si la entrada es incorrecta, devuelve un mensaje de error.
else{
    echo json_encode(['error' => $sError]);
}