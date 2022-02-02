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

    /**
     * Búsqueda de departamento por código.
     * 
     * Busca en la base de datos el departamento con el código dado.
     * 
     * @param String $codDepartamento Código del departamento a buscar.
     * @return Departamento|false Devuelve el objeto Departamento si lo encuentra,
     * o false en caso contrario.
     */
    public static function buscaDepartamentoPorCod($codDepartamento) {
        $sSelect = <<<QUERY
            SELECT * FROM T02_Departamento WHERE T02_CodDepartamento = '{$codDepartamento}';
QUERY;

        $oResultado = DBPDO::ejecutarConsulta($sSelect);
        $oResultado = $oResultado->fetchObject();
        if ($oResultado) {
            return new Departamento(
                    $oResultado->T02_CodDepartamento,
                    $oResultado->T02_DescDepartamento,
                    $oResultado->T02_FechaCreacionDepartamento,
                    $oResultado->T02_VolumenDeNegocio);
        } else {
            return false;
        }
    }

    /**
     * Búsqueda de departamentos por descripción.
     * 
     * Dado un patrón de búsqueda o no, busca en la base de datos departamentos
     * que cumplan con ello. Si no se da un patrón, devuelve todos los departamentos.
     * 
     * @param String $sBusqueda Contenido que deben tener los departamentos a devolver.
     * @return Departamento[]|false Devuelve un array con los departamentos si
     * ha devuelto alguno, o false en caso contrario.
     */
    public static function buscaDepartamentosPorDesc($sBusqueda = '') {
        $sSelect = <<<QUERY
            SELECT * FROM T02_Departamento
            WHERE T02_DescDepartamento LIKE '%{$sBusqueda}%';
QUERY;

        $oResultado = DBPDO::ejecutarConsulta($sSelect);
        $aDepartamentos = $oResultado->fetchAll();
        if ($aDepartamentos) {
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
        } else {
            return false;
        }
    }

    /**
     * Alta de un departamento.
     * 
     * Añade un departamento en la base de datos, y crea un objeto departamento
     * con los mismos datos para devolverlos al usuario.
     * 
     * @param String $sCodDepartamento Código del departamento a ser creado.
     * @param String $sDescDepartamento Descripción del departamento.
     * @param float $fVolumenDeNegocio Volumen de negocio del departamento.
     * @return Departamento|false Devuelve un nuevo objeto Departamento si ha creado
     * el departamento, o false en caso contrario.
     */
    public static function altaDepartamento($sCodDepartamento, $sDescDepartamento, $fVolumenDeNegocio) {
        $iFechaCreacionDepartamento = time();
        $sInsert = <<<QUERY
            INSERT INTO T02_Departamento(T02_CodDepartamento, T02_DescDepartamento, T02_FechaCreacionDepartamento, T02_VolumenDeNegocio) VALUES
            ('{$sCodDepartamento}', '{$sDescDepartamento}', {$iFechaCreacionDepartamento} ,{$fVolumenDeNegocio});
        QUERY;
            
        $oResultado = DBPDO::ejecutarConsulta($sInsert);
        if ($oResultado) {
            return new Departamento(
                    $sCodDepartamento,
                    $sDescDepartamento,
                    $iFechaCreacionDepartamento,
                    $fVolumenDeNegocio);
        } else {
            return false;
        }
    }

    /**
     * Baja física de un departamento.
     * 
     * Dado su código, elimina un departamento de la base de datos.
     * 
     * @param String $sCodDepartamento Código del departamento a eliminar.
     * @return PDOStatement Devuelve el resultado del delete.
     */
    public static function bajaFisicaDepartamento($sCodDepartamento) {
        $sDelete = <<<QUERY
            DELETE FROM T02_Departamento WHERE T02_CodDepartamento = '{$sCodDepartamento}';
        QUERY;

        $oResultado = DBPDO::ejecutarConsulta($sDelete);
        return $oResultado;
    }

    public static function bajaLogicaDepartamento() {
        
    }

    /**
     * Modificación de un departamento.
     * 
     * Dado el código de un departamento, modifica su descripción y volumen
     * de negocio por los nuevos valores pasados como parámetro.
     * 
     * @param String $sCodDepartamento Código del departamento cuya descripción
     * y volumen son modificados.
     * @param String $sDescDepartamento Nueva descripción del departamento.
     * @param float $fVolumenDeNegocio Nuevo volumen de negocio del departamento.
     * @return PDOStatement Devuelve el resultado del update.
     */
    public static function modificaDepartamento($sCodDepartamento, $sDescDepartamento, $fVolumenDeNegocio) {
        $sUpdate = <<<QUERY
            UPDATE T02_Departamento SET T02_DescDepartamento = '{$sDescDepartamento}',
            T02_VolumenDeNegocio = {$fVolumenDeNegocio}
            WHERE T02_CodDepartamento= '{$sCodDepartamento}';
QUERY;
        return DBPDO::ejecutarConsulta($sUpdate);
    }

    public static function rehabilitaDepartamento() {
        
    }

    public static function validaCodNoExiste() {
        
    }

}
