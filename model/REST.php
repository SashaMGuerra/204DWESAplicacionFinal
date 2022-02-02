<?php
/**
 * Funciones para uso de los REST utilizados.
 * 
 * Por cada rest, la clase tiene una función que, dados los parámetros para afinar
 * la devolución de la búsqueda, devuelve un objeto o un elemento vacío.
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
     * @return Palabra|null Objeto con información sobre la palabra si la encuentra,
     * o null si no lo hace.
     */
    function buscarPalabra($idioma, $palabra){
        // El @ suprime el warning que sale si la búsqueda no tiene contenido.
        $sDevolucion = @file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/{$idioma}/{$palabra}");
        
        $devuelto = $sDevolucion?json_decode($sDevolucion)[0]:'No se han obtenido resultados.';
        if(is_object($devuelto)){
            return new Palabra($devuelto->word, $devuelto->origin??'no indicado.' , $devuelto->meanings);
        }
        else{
            return null;
        }
    }
    
    /**
     * Conversión de monedas.
     * 
     * Dadas dos divisas, indica el valor de la segunda moneda respecto a una
     * unidad de la primera moneda.
     * 
     * @param float $fCantidad Cantidad a convertir.
     * @param string $sDivisaPrincipal Moneda a partir de la que convertir.
     * @param string $sOtraDivisa Divisa a la que convertir.
     * @return float|null Resultado de la conversión: el valor convertido si
     * es correcto, o null si no ha sido correcto.
     */
    public static function conversorMoneda($fCantidad, $sDivisaPrincipal, $sOtraDivisa) {
        $claveAPI = "2fb5f0e8f0ce47116b050ae0"; //La clave generada para poder usar la API
        $resultadoAPI = @file_get_contents("https://v6.exchangerate-api.com/v6/{$claveAPI}/latest/{$sDivisaPrincipal}");
        
        $JSONDecodificado = json_decode($resultadoAPI, true); //Almacén de la informacion decodificada obtenida de la url como un array.
        if($JSONDecodificado['result'] === "success"){
            $fConversion = $JSONDecodificado['conversion_rates'][$sOtraDivisa];
            return $fConversion*$fCantidad;
        }
        else{
            return null;
        }
    }
}

