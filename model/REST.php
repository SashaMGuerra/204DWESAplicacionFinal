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
class REST {

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
    public static function buscarPalabra($idioma, $palabra) {
        // El @ suprime el warning que sale si la búsqueda no tiene contenido.
        $sDevolucion = @file_get_contents("https://api.dictionaryapi.dev/api/v2/entries/{$idioma}/{$palabra}");

        $devuelto = $sDevolucion ? json_decode($sDevolucion)[0] : '';
        if (is_object($devuelto)) {
            return new Palabra($devuelto->word, $devuelto->origin ?? 'no indicado.', $devuelto->meanings);
        } else {
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
        if ($resultadoAPI) {
            $JSONDecodificado = json_decode($resultadoAPI, true); //Almacén de la informacion decodificada obtenida de la url como un array.
            // Si no se ha encontrado la divisa a la que pasar, devuelve null.
            $fConversion = $JSONDecodificado['conversion_rates'][$sOtraDivisa] ?? null;
            if ($fConversion) {
                return $fConversion * $fCantidad;
            }
        }
        return null;
    }

    /**
     * Búsqueda de departamentos por código.
     * 
     * Dado un código de departamento, llama a la API para buscarlo.
     * 
     * @param String $sCodDepartamento Código del departamento a buscar.
     * @return \Departamento|String|null Devuelve el objeto Departamento si lo
     * encuentra, un error si no lo hace, o null si ha sucedido algún error al
     * llamar a la API.
     */
    public function buscarDepartamentoPorCodigo($sCodDepartamento) {
        $resultadoAPI = file_get_contents("https://daw204.ieslossauces.es/AplicacionFinal/api/buscarDepartamentoPorCodigo.php?codDepartamento=$sCodDepartamento");
        if ($resultadoAPI) {
            $JSONDecodificado = json_decode($resultadoAPI, true); //Almacén de la informacion decodificada obtenida de la url como un array.

            /* Si el JSON contiene un array con un codDepartamento, significa que 
             * ha encontrado el departamento, y devuelve un objeto.
             */
            if (isset($JSONDecodificado['codDepartamento'])) {
                return new Departamento(
                    $JSONDecodificado['codDepartamento'],
                    $JSONDecodificado['descDepartamento'],
                    $JSONDecodificado['fechaCreacionDepartamento'],
                    $JSONDecodificado['volumenDeNegocio'],
                    $JSONDecodificado['fechaBajaDepartamento']
                );
            }
            else{
                return $JSONDecodificado['error'];
            }
        }
        return null;
    }

}
