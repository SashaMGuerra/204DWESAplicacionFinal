<?php

/**
 * Conexión de departamentos con la base de datos mediante PDO.
 * 
 * Funciones de conexión con la base de datos para modificación de departamentos.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 31/01/2022
 * @version 2.0
 */
class DepartamentoPDO {

    public static function buscaDepartamentoPorCod() {
        
    }

    /**
     * Búsqueda de departamentos por descripción.
     * 
     * Dado un patrón de búsqueda o no, busca en la base de datos departamentos
     * que cumplan con ello. Si no se da un patrón, devuelve todos los departamentos.
     * 
     * @param String $busqueda Contenido que deben tener los departamentos a devolver.
     * @return Departamento[]|false Devuelve un array con los departamentos si
     * ha devuelto alguno, o false en caso contrario.
     */
    public static function buscaDepartamentosPorDesc($busqueda = '') {
        $sSelect = <<<QUERY
            SELECT * FROM T02_Departamento
            WHERE T02_DescDepartamento LIKE '%{$busqueda}%';
QUERY;
            
        $oResultado = DBPDO::ejecutarConsulta($sSelect);
        $aDepartamentos = $oResultado->fetchAll();
        if($aDepartamentos){
            $aDevolucion = [];
            /*
             * Creación de cada departamento en objeto y añadido al array de
             * devolución de departamentos con el código de departamento como
             * key en el array.
             */
            foreach ($aDepartamentos as $oDepartamento) {
                $aDevolucion[$oDepartamento['T02_CodDepartamento']] = new Departamento(
                        $oDepartamento['T02_CodDepartamento'],
                        $oDepartamento['T02_DescDepartamento'],
                        $oDepartamento['T02_FechaCreacionDepartamento'],
                        $oDepartamento['T02_VolumenDeNegocio']);
            }
            return $aDevolucion;
        }
        else{
            return false;
        }
    }

    public static function altaDepartamento() {
        
    }
    
    public static function bajaFisicaDepartamento(){
        
    }
    
    public static function bajaLogicaDepartamento(){
        
    }

    public static function modificaDepartamento(){
        
    }
    
    public static function rehabilitaDepartamento(){
        
    }
    
    public static function validaCodNoExiste(){
        
    }
}
