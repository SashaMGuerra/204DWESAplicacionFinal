<?php
/**
 * @author Sasha
 * @since 22/12/2021
 * @version 1.0
 * 
 * Layout, base de las vistas.
 * Contiene el head con el estilo básico, título y metas. También footer.
 */
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>IMG - App Login-Logout</title>
        <link href="webroot/css/layout.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vInicioPublico.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vLogin.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vInicioPrivado.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vRegistro.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vMiCuenta.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vCambiarPassword.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vBorrarCuenta.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vDetalle.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vWIP.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/vError.css" rel="stylesheet" type="text/css"/>
        <script src="webroot/js/vInicioPrivado.js" type="text/javascript"></script>
        <script src="webroot/js/vMiCuenta.js" type="text/javascript"></script>
    </head>
    <body>
        <?php require_once $aVistas[$_SESSION['paginaEnCurso']]; // Requiere la vista indicada en la variable de página. ?>
        <footer>
            <hr/>
            <div class="info">
                <a href="https://github.com/SashaMGuerra/204DWESAplicacionLoginLogout" target="_blank"><img src="webroot/media/img/github_logo_white.png" alt="repositorio"></a>
                <div>© 2021-2022 IES Los Sauces (Benavente, Zamora)<br>SashaMGuerra — Isabel Martínez Guerra</div>
                <a href="doc/index.html" target="_blank">phpdoc</a>
                <a href="" target="_blank">Web del autor</a>
                <a href="" target="_blank">Currículo</a>
                <a href="" target="_blank">Página imitada</a>
                <div>Modified on METE FECHA.</div>
            </div>
        </footer>
    </body>
</html>
