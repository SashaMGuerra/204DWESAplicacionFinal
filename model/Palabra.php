<?php
/**
 * Clase para construcción de objetos palabra.
 * 
 * Crea objetos con información sobre palabras: la palabra en sí, su origen, 
 * y según el tipo de palabra, sus definiciones y ejemplos, sinónimos y antónimos
 * de cada uno.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 26/01/2022
 * @version 1.0
 */
class Palabra{
    public String $palabra;
    public String $origen;
    public Array $significados;
    
    /**
     * Constructor de objetos palabra.
     * 
     * Recibe una palabra, su origen y un array con sus significados.
     * 
     * @param String $palabra Palabra a la que pertenecen el origen y los significados.
     * @param String $origen Origen de la palabra indicada.
     * @param Array $significados Significados según tipo de la palabra, con
     * definiciones, ejemplos, sinónimos y antónimos.
     */
    function __construct($palabra, $origen, $significados) {
        $this->palabra = $palabra;
        $this->origen = $origen;
        $this->significados = $significados;
    }
}