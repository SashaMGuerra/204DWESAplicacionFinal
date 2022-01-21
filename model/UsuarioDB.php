<?php
/**
 * Interfaz para conexión de usuarios con la base de datos.
 * 
 * Interfaz para conexión de usuarios con la base de datos.
 * 
 * @author Sasha
 * @since 23/12/2021
 * @version 1.0
 */
interface UsuarioDB{
    /**
     * Comprobación de la existencia previa de un usuario y de si su contraseña
     * es correcta en la base de datos.
     * 
     * @param String $codigoUsuario Código del usuario a comprpobar.
     * @param String $password Contraseña del usuario a comprobar.
     */
    public static function validarUsuario($codigoUsuario, $password);
}