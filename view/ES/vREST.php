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
    <div class="container">
        <div class="mainH1">
            <h1>Rest</h1>
            <div>
                <button form="layoutForm" name="volver" value="volver">Volver</button>
            </div>
        </div>
        <button class="forSection" onclick="showRest(this)">Diccionario</button>
        <section class="accordion">
            <div class="diccionario">
                <h2>Diccionario de Google<sup><a href="https://dictionaryapi.dev/" target="_blank">ⓘ</a></sup></h2>
                <form method="post" id="restForm">
                    <fieldset>
                        <div class="error"><?php echo $aErroresDiccionario['word'] ?></div>
                        <input type="text" name="word">
                        <select name="language">
                            <option value="ES" <?php echo $aVRESTDiccionario['language'] == 'ES' ? 'selected' : '' ?>>Español</option>
                            <option value="EN" <?php echo $aVRESTDiccionario['language'] == 'EN' ? 'selected' : '' ?>>Inglés</option>
                        </select>
                        <div class="error"><?php echo $aErroresDiccionario['language'] ?></div>
                    </fieldset>
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
                                    <h3><?php echo '(' . ($num + 1) . ') ' . $aMeaning->partOfSpeech ?></h3>
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
        <button class="forSection" onclick="showRest(this)">Conversor de monedas</button>
        <section class="accordion">
            <div class="conversor">
                <h2>Conversor de divisas<sup><a href="" target="_blank">ⓘ</a></sup></h2>
                <form method="post">
                    <fieldset>
                        <table>
                            <tr>
                                <th><label for="divisaOrigen">Divisa</label><sup><a href="https://es.wikipedia.org/wiki/ISO_4217" target="_blank">ⓘ</a></sup></th>
                                <th><label for="cantidad">Cantidad</label></th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="divisaOrigen" id="divisaOrigen" value="<?php echo $aVRESTConversor['divisaOrigen']; ?>" placeholder="EUR">
                                </td>
                                <td>
                                    <input type="text" name="cantidad" id="cantidad" value="<?php echo $aVRESTConversor['cantidad']; ?>" placeholder="1.11">
                                </td>
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
                                    <input type="text" name="resultado" id="resultado" value="<?php echo $aVRESTConversor['resultadoConversion']; ?>" disabled>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                    <fieldset class="submit">
                        <button name="convertir" value="convertir">Convertir</button>
                    </fieldset>
                </form>
            </div>
        </section>
    </div>
</main>