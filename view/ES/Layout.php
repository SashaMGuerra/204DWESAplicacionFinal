<?php
/**
 * @author Sasha
 * @since 22/01/2022
 * @version 1.0
 * 
 * Layout, base de las vistas.
 * Contiene el head con el estilo básico, título y metas.
 * También el header con el menú, y el footer.
 */
?>
<!DOCTYPE html>
<html lang="ES">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Aplicación Final</title>
        <link href="webroot/css/layout.css" rel="stylesheet" type="text/css"/>
        <!-- <script src="webroot/js/vMiCuenta.js" type="text/javascript"></script> -->
    </head>
    <body>
        <header id="vHeaderInicioPrivado">
            <div class="container">
                <div class="logo">
                    <h1>Aplicación Final</h1>
                    <h2>• Versión 1.0</h2>
                </div>
                <nav>
                    <form id="headerForm" method="post">
                        <button name="menuInicio" value="menuInicio">Inicio</button>
                        <?php if(isset($_SESSION['usuarioDAW204AppLoginLogout'])){ ?>
                        <button name="menuMiCuenta" value="menuMiCuenta">Mi cuenta</button>
                        <?php } else { ?>
                        <button name="menuLogin" value="menuLogin">Iniciar sesión</button>
                        <?php } ?>
                        <button class="language" name="cookieLanguage" value="<?php echo $_COOKIE['language']=='EN'?'ES':'EN'; ?>">
                            <img src="webroot/media/img/lang/<?php echo $_COOKIE['language']=='EN'?'ES':'EN'; ?>.png" alt="language">
                        </button>
                    </form>
                </nav>
            </div>
        </header>
        <?php require_once $aVistas[$_SESSION['paginaEnCurso']]; // Requiere la vista indicada en la variable de página. ?>
        <div class="movingImage"></div>
        <footer>
            <div class="container">
                <hr/>
                <div class="info">
                    <a href="https://github.com/SashaMGuerra/204DWESAplicacionLoginLogout" target="_blank"><img src="webroot/media/img/github_logo_white.png" alt="repositorio"></a>
                    <div class="author">
                        <p>SashaMGuerra (Isabel Martínez Guerra)</p>
                        <p>alexmtnezguerra@gmail.com</p>
                    </div>
                    <div><a href="doc/index.html"><img src="webroot/media/img/doc.png" alt="phpdoc"><br>Documentación</a></div>
                    <div class="placedate">
                        <p>© IES Los Sauces (Benavente, Zamora) 2021-2022</p>
                        <p>Modificado el 24/01/2022</p>
                    </div>
                </div>
                <div>Diseño inspirado por <a href="https://www.timetochoose.com/" target="_blank">timetochoose.com</a> y <a href="https://www.thelonelypixel.co.uk/" target="_blank">thelonelypixel.co.uk</a>.</div>
            </div>
        </footer>
    </body>
</html>
