<?php
/**
 * Clase que crea y utiliza usuarios en la aplicación.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 23/12/2021
 * @version 1.0
 */
class Usuario{
    private $codUsuario;
    private $password;
    private $descUsuario;
    private $numConexiones;
    private $fechaHoraUltimaConexion;
    private $fechaHoraUltimaConexionAnterior;
    private $perfil;
    private $imagenUsuario;
    
    function __construct($codUsuario, $password, $descUsuario, $numConexiones, $fechaHoraUltimaConexion, $fechaHoraUltimaConexionAnterior, $perfil, $imagenUsuario) {
        $this->codUsuario = $codUsuario;
        $this->password = $password;
        $this->descUsuario = $descUsuario;
        $this->numConexiones = $numConexiones;
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
        $this->perfil = $perfil;
        $this->imagenUsuario = $imagenUsuario;
    }
    
    function getCodUsuario() {
        return $this->codUsuario;
    }

    function getPassword() {
        return $this->password;
    }

    function getDescUsuario() {
        return $this->descUsuario;
    }

    function getNumConexiones() {
        return $this->numConexiones;
    }

    function getFechaHoraUltimaConexion() {
        return $this->fechaHoraUltimaConexion;
    }

    function getFechaHoraUltimaConexionAnterior() {
        return $this->fechaHoraUltimaConexionAnterior;
    }

    function getPerfil() {
        return $this->perfil;
    }
    
    function getImagenUsuario() {
        return $this->imagenUsuario;
    }
    
    function setDescUsuario($descUsuario): void {
        $this->descUsuario = $descUsuario;
    }
    
    function setPassword($password): void {
        $this->password = $password;
    }
    
    function setNumConexiones($numConexiones) {
        $this->numConexiones = $numConexiones;
    }

    function setFechaHoraUltimaConexion($fechaHoraUltimaConexion) {
        $this->fechaHoraUltimaConexion = $fechaHoraUltimaConexion;
    }

    function setFechaHoraUltimaConexionAnterior($fechaHoraUltimaConexionAnterior) {
        $this->fechaHoraUltimaConexionAnterior = $fechaHoraUltimaConexionAnterior;
    }
    
    function setImagenUsuario($imagenUsuario): void {
        $this->imagenUsuario = $imagenUsuario;
    }









    

}