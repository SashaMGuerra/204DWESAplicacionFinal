<?php
/*
 * @author Sasha
 * @since 25/01/2022
 * @version 1.0
 * 
 * Ventana de las api rest.
 */
?>
<main>
    <style>
        button[value="<?php echo $_SESSION['RESTEnCurso']; ?>"]{
            background-color: var(--pink);
        }
        <?php
            switch($_SESSION['RESTEnCurso']){
                case 'diccionario': ?>
        section#diccionario{
                    <?php break;
                case 'conversor': ?>  
        section#conversor{
                    <?php break;
                case 'buscarDPTOpropio': ?>  
        section#buscarDPTOpropio{
                    <?php break;
                case 'buscarDPTOajeno': ?>  
        section#buscarDPTOajeno{
                    <?php break;
            }
        ?>
            display: initial;
        }
    </style>
    <div class="container">
        <div class="mainH1">
            <h1>Rest</h1>
            <div>
                <button form="layoutForm" name="volver" value="volver">Volver</button>
            </div>
        </div>
        <form id="menuRESTForm" method="post">
            <nav>
                <ul>
                    <li><button type="submit" name="RESTEnCurso" value="diccionario">Diccionario</button></li>
                    <li><button type="submit" name="RESTEnCurso" value="conversor">Conversor</button></li>
                    <li><button type="submit" name="RESTEnCurso" value="buscarDPTOpropio">Buscar DPTO (propio)</button></li>
                    <li><button type="submit" name="RESTEnCurso" value="buscarDPTOajeno">Buscar DPTO (Óscar)</button></li>
                </ul>
            </nav>
        </form>
        <section id="diccionario">
            <div class="diccionario">
                <h2>Diccionario de Google<sup><a href="https://dictionaryapi.dev/" target="_blank">ⓘ</a></sup></h2>
                <div class="restDescripcion">Servicio web de búsqueda de palabras en el diccionario de Google. Funciona en inglés y en español. Devuelve los significados de la palabra, a veces con su tipo y origen.</div>
                <form method="post" id="restForm">
                    <fieldset>
                        <input type="text" name="word" placeholder="Palabra a buscar">
                        <select name="language">
                            <option value="ES" <?php echo $aVRESTDiccionario['language'] == 'ES' ? 'selected' : '' ?>>Español</option>
                            <option value="EN" <?php echo $aVRESTDiccionario['language'] == 'EN' ? 'selected' : '' ?>>Inglés</option>
                        </select>
                    </fieldset>
                    <div class="error"><?php echo $aErroresDiccionario['word'] ?></div>
                    <fieldset>
                        <button name="buscarPalabra" value="buscarPalabra">Buscar</button>
                    </fieldset>
                </form>
                <div class="palabra">
                    <?php if (is_array($aVRESTDiccionario['resultado'])) { ?>
                        <hr>
                        <h2><?php echo $aVRESTDiccionario['resultado']['palabra']; ?></h2>
                        <div>Origen: <?php echo $aVRESTDiccionario['resultado']['origen']; ?></div>
                        <div>
                            <?php
                            foreach ($aVRESTDiccionario['resultado']['significados'] as $num => $aMeaning) {
                                ?><article>
                                    <h3><?php
                                        $sSignificado = ($aMeaning->partOfSpeech) ?? '';
                                        echo '(' . ($num + 1) . ') ' . $sSignificado;
                                        ?></h3>
                                    <ol>
                                        <?php
                                        foreach ($aMeaning->definitions as $aDefinition) {
                                            echo "<li>$aDefinition->definition";
                                            if (!empty($aDefinition->synonyms)) {
                                                ?>
                                                <div class="sinant">
                                                    <h4>Sinónimos:</h4>
                                                    <div><?php echo implode(', ', $aDefinition->synonyms); ?></div>
                                                </div>
                                                <?php
                                            }
                                            if (!empty($aDefinition->antonyms)) {
                                                ?>
                                                <div class="sinant">
                                                    <h4>Antónimos:</h4>
                                                    <div><?php echo implode(', ', $aDefinition->antonyms); ?></div>
                                                </div>
                                                <?php
                                            }
                                            echo '</li>';
                                        }
                                        ?>
                                    </ol>
                                </article><?php
                            }
                            ?>
                        </div>
                        <?php
                    } else {
                        echo "<span>{$aVRESTDiccionario['resultado']}</span>";
                    }
                    ?>
                </div>
            </div>
        </section>
        <section id="conversor">
            <div class="conversor">
                <h2>Conversor de divisas<sup><a href="" target="_blank">ⓘ</a></sup></h2>
                <div class="restDescripcion">Servicio web de conversión de divisas. Introducidos dos códigos de divisa (hágase clic en el enlace de información junto a "Divisa" para un listado completo), devuelve el valor convertido.</div>
                <form method="post">
                    <fieldset>                      

                        <table>
                            <tr>
                                <th><label for="divisaOrigen">Divisa</label><sup><a href="https://es.wikipedia.org/wiki/ISO_4217" target="_blank"><abbr title="Lista de códigos de divisas">ⓘ</abbr></a></sup></th>
                                <th><label for="cantidad">Cantidad</label></th>
                            </tr>
                            <tr>
                                <td><input type="text" name="divisaOrigen" id="divisaOrigen" value="<?php echo $aVRESTConversor['divisaOrigen']; ?>" placeholder="EUR"></td>
                                <td><input type="text" name="cantidad" id="cantidad" value="<?php echo $aVRESTConversor['cantidad']; ?>" placeholder="1.00"></td>
                            </tr>
                            <tr>
                                <td><div class="error"><?php echo $aErroresConversor['divisaOrigen'] ?></div></td>
                                <td><div class="error"><?php echo $aErroresConversor['cantidad'] ?></div></td>
                            </tr>
                            <tr>
                                <th><label for="divisaResultado">Pasar a</label></th>
                                <th><label for="resultado">Resultado</label></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="divisaResultado" id="divisaResultado" value="<?php echo $aVRESTConversor['divisaResultado']; ?>" placeholder="USD">
                                </td>
                                <td>
                                    <input type="text" name="resultado" id="resultado" value="<?php echo number_format($aVRESTConversor['resultadoConversion'], 2); ?>" disabled>
                                </td>
                            </tr>
                            <tr>
                                <td><div class="error"><?php echo $aErroresConversor['divisaResultado']; ?></div></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="2"><div class="error"><?php echo $aErroresConversor['resultado']; ?></div></td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="submit">
                        <button name="convertir" value="convertir">Convertir</button>
                    </fieldset>
                </form>
            </div>
        </section>
        <section id="buscarDPTOpropio">
            <div class="REST">
                <h2>Búsqueda de departamentos por código (propio)<sup><a href="" target="_blank">ⓘ</a></sup></h2>
                <div class="restDescripcion">Servicio web de búsqueda de departamentos por código. Devuelve una tabla con el código, descripción, fecha de creación, volumen de negocio y fecha de baja —si tiene— del departamento.</div>
                <form method="post">
                    <fieldset>
                        <label for="codDepartamento">Código del departamento</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVRESTPropio['codDepartamento']; ?>" placeholder="AAA"/>
                        <div class='error'><?php echo $aErroresPropio['codDepartamento']; ?></div>
                    </fieldset>
                    <fieldset class="submit">
                        <button name="buscarDepartamento" value="buscarDepartamento">Buscar</button>
                    </fieldset>
                </form>
                <div class="mostradoDepartamento">
                    <?php if (is_array($aVRESTPropio['resultado'])) { ?>
                        <table>
                            <tr>
                                <th>Código</th>
                                <td><?php echo $aVRESTPropio['resultado']['codDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Descripción</th>
                                <td><?php echo $aVRESTPropio['resultado']['descDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de creación</th>
                                <td><?php echo $aVRESTPropio['resultado']['fechaCreacionDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Volumen de negocio</th>
                                <td><?php echo $aVRESTPropio['resultado']['volumenDeNegocio']; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de baja</th>
                                <td><?php echo $aVRESTPropio['resultado']['fechaBajaDepartamento']; ?></td>
                            </tr>
                        </table>
                        <?php
                    } else {
                        echo "<span>{$aVRESTPropio['resultado']}</span>";
                    }
                    ?>
                </div>
            </div>
        </section>
        <section id="buscarDPTOajeno">
            <div class="REST">
                <h2>Búsqueda de departamentos por código (Óscar)<sup><a href="" target="_blank">ⓘ</a></sup></h2>
                <div class="restDescripcion">Servicio web de búsqueda de departamentos por código. Devuelve una tabla con el código, descripción, fecha de creación, volumen de negocio y fecha de baja —si tiene— del departamento.</div>
                <form method="post">
                    <fieldset>
                        <label for="codDepartamento">Código del departamento</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVRESTAjeno['codDepartamento']; ?>" placeholder="AAA"/>
                        <div class='error'><?php echo $aErroresAjeno['codDepartamento']; ?></div>
                    </fieldset>
                    <fieldset class="submit">
                        <button name="buscarDepartamento" value="buscarDepartamento">Buscar</button>
                    </fieldset>
                </form>
                <div class="mostradoDepartamento">
                    <?php if (is_array($aVRESTAjeno['resultado'])) { ?>
                        <table>
                            <tr>
                                <th>Código</th>
                                <td><?php echo $aVRESTAjeno['resultado']['codDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Descripción</th>
                                <td><?php echo $aVRESTAjeno['resultado']['descDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de creación</th>
                                <td><?php echo $aVRESTAjeno['resultado']['fechaCreacionDepartamento']; ?></td>
                            </tr>
                            <tr>
                                <th>Volumen de negocio</th>
                                <td><?php echo $aVRESTAjeno['resultado']['volumenDeNegocio']; ?></td>
                            </tr>
                            <tr>
                                <th>Fecha de baja</th>
                                <td><?php echo $aVRESTAjeno['resultado']['fechaBajaDepartamento']; ?></td>
                            </tr>
                        </table>
                        <?php
                    } else {
                        echo "<span>{$aVRESTAjeno['resultado']}</span>";
                    }
                    ?>
                </div>
            </div>
        </section>
    </div>
</main>