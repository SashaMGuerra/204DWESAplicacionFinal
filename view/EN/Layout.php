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
<html lang="EN">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv='X-UA-Compatible' content='IE=edge'>
        <meta name='viewport' content='width=device-width, initial-scale=1'>
        <title>Final Application</title>
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
                    <h1>Sasha's Application</h1>
                    <h2>• 3.1 Version</h2>
                </div>
                <nav>
                    <form id="layoutForm" method="post">
                        <button class="language" name="cookieLanguage" value="<?php echo $_COOKIE['language'] == 'EN' ? 'ES' : 'EN'; ?>">
                            <img src="webroot/media/img/lang/<?php echo $_COOKIE['language'] == 'EN' ? 'ES' : 'EN'; ?>.png" alt="language">
                        </button>
                        <button name="menuInicio" value="menuInicio">Home</button>
                    </form>
                </nav>
            </div>
        </header>
        <?php require_once $aVistas[$_SESSION['paginaEnCurso']]; ?>
        <div class="movingImage">
            <div class="slidingImage"></div>
        </div>
        <footer>
            <div class="container">
                <hr/>
                <div class="info">
                    <a href="https://daw204.ieslossauces.es/" target="_blank">
                        <img src="webroot/media/img/footer/homepage.png" alt="web del autor">
                        <p>Author's website</p>
                    </a>
                    <a href="webroot/files/cv.pdf" target="_blank">
                        <img src="webroot/media/img/footer/cv.png" alt="rss">
                        <p>Curriculum</p>
                    </a>
                    <a href="https://github.com/SashaMGuerra/204DWESAplicacionFinal" target="_blank">
                        <img src="webroot/media/img/footer/github_logo_white.png" alt="repositorio">
                        <p>Repository</p>
                    </a>
                    <button type="submit" form="layoutForm" name="tecnologias" value="tecnologias">
                        <img src="webroot/media/img/footer/php.png" alt="repositorio">
                        <p>Technologies</p>
                    </button>
                    <a href="doc/index.html" target="_blank">
                        <img src="webroot/media/img/footer/doc.png" alt="phpdoc">
                        <p>Documentation</p>
                    </a>
                    <a href="webroot/files/rss.xml" target="_blank">
                        <img src="webroot/media/img/footer/rss_white.png" alt="rss">
                        <p>RSS</p>
                    </a>
                    <div class="placedate">
                        <p>© IES Los Sauces (Benavente, Zamora) 2021-2022</p>
                        <p>Last modified 08/02/2022</p>
                    </div>
                </div>
                <div>Design inspired by <a href="https://www.timetochoose.com/" target="_blank">timetochoose.com</a> and <a href="https://www.thelonelypixel.co.uk/" target="_blank">thelonelypixel.co.uk</a>.</div>
            </div>
        </footer>
    </body>
</html>
