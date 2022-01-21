<?php
/**
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Clase que crea y utiliza errores generados en el uso de la aplicación
 * (excepciones).
 */

class AppError{
    private $codError;
    private $descError;
    private $archivoError;
    private $lineaError;
    private $paginaSiguiente;
    
    function __construct($codError, $descError, $archivoError, $lineaError, $paginaSiguiente) {
        $this->codError = $codError;
        $this->descError = $descError;
        $this->archivoError = $archivoError;
        $this->lineaError = $lineaError;
        $this->paginaSiguiente = $paginaSiguiente;
    }
    
    function getCodError() {
        return $this->codError;
    }
    
    function getDescError() {
        return $this->descError;
    }

    function getArchivoError() {
        return $this->archivoError;
    }

    function getLineaError() {
        return $this->lineaError;
    }
    
    function getPaginaSiguiente() {
        return $this->paginaSiguiente;
    }


}

