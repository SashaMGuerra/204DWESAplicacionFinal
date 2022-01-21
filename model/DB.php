<?php
/**
 * @author Sasha
 * @since 23/12/2021
 * @version 1.0
 * 
 * Interfaz para conexión con la base de datos y ejecución de consultas sobre la misma.
 */
interface DB{
    /**
     * Conexión con la base de datos para ejecución de una consulta con o sin
     * parámetros.
     * 
     * @param String $sentenciaSQL Sentencia SQL a ejecutar.
     * @param Array|null $parametros Parámetros con los que completar la sentencia.
     */
    public static function ejecutarConsulta($sentenciaSQL, $parametros = null);
}

