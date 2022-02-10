<?php
/**
 * Controlador de la exportación de departametnos.
 * 
 * No tiene vista. Contiene los header necesarios para descargar el archivo de 
 * la ruta indicada por la variable de sesión.
 * 
 * Después de descargado, restaura la paginaEnCurso a la página anterior y limpia
 * la página anterior. Elimina el archivo temporal y destruye la variable de
 * sesión con el archivo en curso.
 *  
 * @author Sasha
 * @since 10/02/2022
 * @version 2.2
 */

// Header para exportación a xml.
header('Content-Description: File Transfer');
header('Content-type: text/xml');
header("Content-disposition: attachment; filename=\"" . basename($_SESSION['URLArchivoEnCurso']) . "\"");

// Lectura del archivo en la ruta indicada.
readfile($_SESSION['URLArchivoEnCurso']);

// Restauración de la paginaEnCurso y limpieza de variables.
$_SESSION['paginaEnCurso'] = $_SESSION['paginaAnterior'];
$_SESSION['paginaAnterior'] = '';
unlink($_SESSION['URLArchivoEnCurso']);
unset($_SESSION['URLArchivoEnCurso']);