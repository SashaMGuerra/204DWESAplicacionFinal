<?php
/**
 * @author Sasha
 * @since 17/01/2022
 * @version 3.0
 * 
 * Controlador de la ventana de miCuenta.
 * Permite ver y modificar información sobre el usuario, acceder al cambio de
 * contraseña y borrar la cuenta.
 */

// Si se selecciona cancelar, vuelve al índice privado sin hacer cambios.
if(isset($_REQUEST['cancelar'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}

// Si se selecciona cambiar contraseña, pasa a la ventana para ello.
if(isset($_REQUEST['cambiarPassword'])){
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'cambiarPassword';
    header('Location: index.php');
    exit;
}

// Si se desea eliminar cuenta, accede a la ventana de confirmación.
if (isset($_REQUEST['eliminarCuenta'])) {
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'borrarCuenta';
    header('Location: index.php');
    exit;
}

$aVMiCuenta = [
    'usuario' => $_SESSION['usuarioDAW204AppLoginLogout']->getCodUsuario(),
    'descripcion' => $_SESSION['usuarioDAW204AppLoginLogout']->getDescUsuario(),
    'numConexiones' => $_SESSION['usuarioDAW204AppLoginLogout']->getNumAccesos(),
    'fechaHoraUltimaConexion' => date('d/m/Y H:i:s e', $_SESSION['usuarioDAW204AppLoginLogout']->getFechaHoraUltimaConexion()),
    'perfil' => $_SESSION['usuarioDAW204AppLoginLogout']->getPerfil(),
    'imagenUsuario' => $_SESSION['usuarioDAW204AppLoginLogout']->getImagenUsuario()
];

$aErrores = [
    'descripcion' => '',
    'imagenUsuario' => ''
];

// Si se desea efectuar cambios, valida la entrada.
if(isset($_REQUEST['aceptar'])){
    $bEntradaOK = true;
    
    // Validación de entrada.
    $aErrores['descripcion'] = validacionFormularios::comprobarAlfaNumerico($_REQUEST['descripcion'], 255, 3, OBLIGATORIO);
    /* 
     * El nombre de la imagen no puede contener caracteres diferentes a letras o
     * números. La imagen debe ser menor a 2MG (tamaño máximo por defecto).
     */
    $aErrores['imagenUsuario'] = validacionFormularios::validarNombreArchivo($_FILES['imagenUsuario']['name'],['jpg', 'jpeg', 'png'], 255, 3);
    
    // Si existe algún error, pone la entrada a false y limpia el campo.
    foreach ($aErrores as $campo => $error){
        if(!empty($error)){
            $bEntradaOK = false;
            $_REQUEST[$campo] = '';
        }
    }
}
/* Si no se ha seleccionado efectuar cambios, pone la entrada a false para que
 * no haga cambios.
 */
else{
    $bEntradaOK = false;
}

// Si la entrada es correcta, efectúa cambios.
if($bEntradaOK){
    // Recogida de nueva información.
    $aVMiCuenta['descripcion'] = $_REQUEST['descripcion'];
        
    /*
     * Si se desea eliminar la imagen de usuario, lo rellena en el formulario
     * como null.
     * Si se ha subido una imagen, toma el archivo y lo codifica en base64 para 
     * mostrarse.
     */
    if (isset($_REQUEST['eliminarImagenUsuario'])) {
        $aVMiCuenta['imagenUsuario'] = null;
    } else if ($_FILES['imagenUsuario']['name'] != '') {
        // Guarda la imagen codificada en base64 para poder mostrarse con <img>.
        $aVMiCuenta['imagenUsuario'] = base64_encode(file_get_contents($_FILES['imagenUsuario']['tmp_name']));
    }
    
    // Actualización en la base de datos.
    $_SESSION['usuarioDAW204AppLoginLogout'] = UsuarioPDO::modificarUsuario($_SESSION['usuarioDAW204AppLoginLogout'], $aVMiCuenta['descripcion'], $aVMiCuenta['imagenUsuario']);

    // Regreso al índice público.
    $_SESSION['paginaAnterior'] = $_SESSION['paginaEnCurso'];
    $_SESSION['paginaEnCurso'] = 'inicioPrivado';
    header('Location: index.php');
    exit;
}


// Carga de la página de detalle.
require_once $aVistas['layout'];
    