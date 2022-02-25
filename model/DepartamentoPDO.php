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
    public const DEPARTAMENTOS_BAJA = 0;
    public const DEPARTAMENTOS_ALTA = 1;
    public const DEPARTAMENTOS_TODOS = 2;

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
     * Recuento de páginas de departamentos.
     * 
     * Cuenta todo el número de departamentos que existen en la base de datos
     * según la descripción y estado dados, paginados de 3 en 3.
     * 
     * @param String $sBusqueda Contenido que deben tener los departamentos a devolver.
     * @param int $iEstado Estado de los departamentos a devolver.
     * @return int Número de páginas en que se divide el total de departamentos.
     */
    public static function contarPaginasDepartamentos($sBusqueda = '', $iEstado = self::DEPARTAMENTOS_TODOS){
        switch ($iEstado) {
            case self::DEPARTAMENTOS_BAJA:
                $estado = 'AND T02_FechaBajaDepartamento IS NOT NULL';
                break;
            case self::DEPARTAMENTOS_ALTA:
                $estado = 'AND T02_FechaBajaDepartamento IS NULL';
                break;
            case self::DEPARTAMENTOS_TODOS:
                $estado = '';
                break;
        }
        
        $sSelect = <<<QUERY
            SELECT COUNT(*) FROM T02_Departamento
            WHERE T02_DescDepartamento LIKE '%{$sBusqueda}%'
            {$estado};
QUERY;
            
        $oResultado = DBPDO::ejecutarConsulta($sSelect);
        $oResultado = $oResultado->fetch();
        return ceil(intval($oResultado[0])/3);
    }

    /**
     * Búsqueda de departamentos por descripción y estado.
     * 
     * Dado un patrón de búsqueda y un estado de departamentos, busca en la base
     * de datos los departamentos que cumplan con esos criterios.
     * Devuelve entre 0 y 3 departamentos, según la página indicada. Si no se
     * indica una, devolverá la primera.
     * 
     * @param String $sBusqueda Contenido que deben tener los departamentos a devolver.
     * @param int $iEstado Estado de los departamentos a devolver.
     * @param int $iPagina Número de página a devolver.
     * @return Departamento[]|false Devuelve un array con los departamentos si
     * ha devuelto alguno (entre 1 y 3), o false en caso contrario.
     */
    public static function buscaDepartamentosPorDescEstado($sBusqueda = '', $iEstado = self::DEPARTAMENTOS_TODOS, $iPagina = 1) {
        $iPagina = ($iPagina-1)*3;
        switch ($iEstado) {
            case self::DEPARTAMENTOS_BAJA:
                $estado = 'AND T02_FechaBajaDepartamento IS NOT NULL';
                break;
            case self::DEPARTAMENTOS_ALTA:
                $estado = 'AND T02_FechaBajaDepartamento IS NULL';
                break;
            case self::DEPARTAMENTOS_TODOS:
                $estado = '';
                break;
        }

        $sSelect = <<<QUERY
            SELECT * FROM T02_Departamento
            WHERE T02_DescDepartamento LIKE '%{$sBusqueda}%'
            {$estado}
            LIMIT 3 OFFSET {$iPagina};
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
                        $oDepartamento['T02_VolumenDeNegocio'],
                        $oDepartamento['T02_FechaBajaDepartamento']);
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

    /**
     * Baja lógica de un departamento.
     * 
     * Dado su código, da de baja un departamento de la base de datos, indicándole
     * como timestamp de fecha de baja el momento actual.
     * 
     * @param String $sCodDepartamento Código del departamento que dar de baja.
     * @return PDOStatement Devuelve el resultado del update.
     */
    public static function bajaLogicaDepartamento($sCodDepartamento) {
        $sUpdate = <<<QUERY
            UPDATE T02_Departamento SET T02_FechaBajaDepartamento = UNIX_TIMESTAMP()
            WHERE T02_CodDepartamento= '{$sCodDepartamento}';
QUERY;
        return DBPDO::ejecutarConsulta($sUpdate);
    }

    /**
     * Rehabilitación de departamento.
     * 
     * Dado el código de un departamento en baja lógica, lo rehabilita eliminando
     * su fecha de baja.
     * 
     * @param String $sCodDepartamento Código del departamento a rehabilitar.
     * @return PDOStatement Devuelve el resultado del update.
     */
    public static function rehabilitaDepartamento($sCodDepartamento) {
        $sUpdate = <<<QUERY
            UPDATE T02_Departamento SET T02_FechaBajaDepartamento = null
            WHERE T02_CodDepartamento= '{$sCodDepartamento}';
QUERY;
        return DBPDO::ejecutarConsulta($sUpdate);
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

    /**
     * Validación de existencia de código de departamento.
     * 
     * Comprueba si ya existe un departamento con el código dado. Distingue entre
     * mayúsculas y minúsculas.
     * 
     * @param String $sCodDepartamento Código de departamento a comprobar si
     * ya existe.
     * @return boolean Devuelve true si no existe, y false si sí está.
     */
    public static function validaCodNoExiste($sCodDepartamento) {
        if (self::buscaDepartamentoPorCod($sCodDepartamento)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Exportación de departamentos a formato XML.
     * 
     * Recoge todos los departamentos de la base de datos y crea un archivo xml
     * con la información que contienen.
     * 
     * @return string|boolean Devuelve un string con la localización del archivo
     * si se ha guardado en temporal correctamente, o false en caso contrario.
     */
    public static function exportarDepartamentosXML() {
        $aDepartamentos = self::buscaDepartamentosPorDescEstado();

        if ($aDepartamentos) {

            // Creación del archivo XML, con formato para mejorar su legibilidad.
            $oDoc = new DOMDocument();
            $oDoc->formatOutput = true;

            $nodoDepartamentos = $oDoc->appendChild($oDoc->createElement('departamentos')); // Elemento raíz.

            foreach ($aDepartamentos as $oDepartamento) {
                // Creación del elemento departamento.
                $oElemDepartamento = $oDoc->createElement("departamento"); // Cada departamento.
                $nodoDepartamentos->appendChild($oElemDepartamento);

                // Creación y añadido de la información sobre el departamento.
                $oElemCodigo = $oDoc->createElement('codDepartamento', $oDepartamento->getCodDepartamento());
                $oElemDepartamento->appendChild($oElemCodigo);

                $oElemCodigo = $oDoc->createElement('descDepartamento', $oDepartamento->getDescDepartamento());
                $oElemDepartamento->appendChild($oElemCodigo);

                $oElemCodigo = $oDoc->createElement('fechaCreacionDepartamento', $oDepartamento->getFechaCreacionDepartamento());
                $oElemDepartamento->appendChild($oElemCodigo);

                $oElemCodigo = $oDoc->createElement('volumenDeNegocio', $oDepartamento->getVolumenDeNegocio());
                $oElemDepartamento->appendChild($oElemCodigo);

                $oElemCodigo = $oDoc->createElement('fechaBajaDepartamento', $oDepartamento->getFechaBajaDepartamento());
                $oElemDepartamento->appendChild($oElemCodigo);
            }

            $sNombreArchivo = "tmp/departamentos" . time() . ".xml";
            if ($oDoc->save($sNombreArchivo)) {
                return $sNombreArchivo;
            }
        }
        return false;
    }

}
