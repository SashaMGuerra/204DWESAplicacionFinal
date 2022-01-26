<?php
/**
 * Funciones para uso de información de los REST utilizados.
 * 
 * Por cada rest, la clase tiene una función que, dados los parámetros para afinar
 * la devolución de la búsqueda, devuelve un objeto o un mensaje de error.
 * 
 * @package AppFinal
 * @author Sasha
 * @since 26/01/2022
 * @version 1.0
 */
class REST{
    
    /**
     * Búsqueda de palabra en la api del diccionario de Google.
     * 
     * Indica el idioma y palabra a buscar en la api del diccionario de Google,
     * que devolverá o no la palabra según si la encuentra o no.
     * 
     * @param String $idioma Código de dos letras del idioma en que buscar la palabra.
     * No todos los idiomas funcionan.
     * @param String $palabra Palabra a buscar en el diccionario.
     * @return Palabra|boolean Objeto con información sobre la palabra si la encuentra,
     * o false si no lo hace.
     */
    function buscarPalabra($idioma, $palabra){
        // El @ suprime el warning que sale si la búsqueda no tiene contenido.
        $sDevolucion = @file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/{$idioma}/{$palabra}");
        
        $devuelto = $sDevolucion?json_decode($sDevolucion)[0]:'No se han obtenido resultados.';
        if(is_object($devuelto)){
            return new RESTPalabra($devuelto->word, $devuelto->origin??'no indicado.' , $devuelto->meanings);
        }
        else{
            return 'No se han encontrado resultados.';
        }
    }
}

