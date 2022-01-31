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
        <link href="webroot/css/multiple.css" rel="stylesheet" type="text/css"/>
        <link href="webroot/css/v<?php echo ucfirst($_SESSION['paginaEnCurso']); ?>.css" rel="stylesheet" type="text/css"/>
        <script src="webroot/js/vMiCuenta.js" type="text/javascript"></script>
        <script src="webroot/js/vRest.js" type="text/javascript"></script>
    </head>
    <body>
        <header>
            <div class="container">
                <div class="logo">
                    <h1>Aplicación de Sasha</h1>
                    <h2>• Versión 1.0</h2>
                </div>
                <nav>
                    <form id="layoutForm" method="post">
                        <button class="language" name="cookieLanguage" value="<?php echo $_COOKIE['language'] == 'EN' ? 'ES' : 'EN'; ?>">
                            <img src="webroot/media/img/lang/<?php echo $_COOKIE['language'] == 'EN' ? 'ES' : 'EN'; ?>.png" alt="language">
                        </button>
                        <button name="menuInicio" value="menuInicio">Inicio</button>
                    </form>
                </nav>
            </div>
        </header>
        <?php require_once $aVistas[$_SESSION['paginaEnCurso']]; // Requiere la vista indicada en la variable de página. ?>
        <div class="movingImage">
            <div class="slidingImage"></div>
        </div>
        <footer>
            <div class="container">
                <div>
                    <button type="submit" form="layoutForm" name="opiniones" value="opiniones">Ver opiniones</button>
                </div>
                <hr/>
                <div class="info">
                    <a href="https://github.com/SashaMGuerra/204DWESAplicacionFinal" target="_blank">
                        <img src="webroot/media/img/footer/github_logo_white.png" alt="repositorio">
                        <p>SashaMGuerra</p>
                    </a>
                    <button type="submit" form="layoutForm" name="tecnologias" value="tecnologias">
                        <img src="webroot/media/img/footer/php.png" alt="repositorio">
                        <p>Tecnologías</p>
                    </button>
                    <a href="doc/index.html">
                        <img src="webroot/media/img/footer/doc.png" alt="phpdoc">
                        <p>Documentación</p>
                    </a>
                    <button type="submit" form="layoutForm" name="rss" value="rss">
                        <img src="webroot/media/img/footer/rss_white.png" alt="rss"/>
                        <p>RSS</p>
                    </button>
                    <div class="placedate">
                        <p>© IES Los Sauces (Benavente, Zamora) 2021-2022</p>
                        <p>Modificado el 26/01/2022</p>
                    </div>
                </div>
                <div>Diseño inspirado por <a href="https://www.timetochoose.com/" target="_blank">timetochoose.com</a> y <a href="https://www.thelonelypixel.co.uk/" target="_blank">thelonelypixel.co.uk</a>.</div>
            </div>
        </footer>
    </body>
</html>
