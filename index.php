<?php
/**
 * @author Isabel Martínez Guerra
 * @since 21/12/2021
 * @version 1.0
 * 
 * Controlador principal de la aplicación.
 */

// Constantes de la aplicación.
require_once './config/configApp.php';

// Inicio o recuperación de la sesión.
session_start();

/*
 * Si no hay una página a cargar indicada, carga el login.
 */
if(!isset($_SESSION['paginaEnCurso'])){
    $_SESSION['paginaEnCurso'] = 'inicioPublico';
}

// Cargado de la página indicada.
require_once $aControladores[$_SESSION['paginaEnCurso']];