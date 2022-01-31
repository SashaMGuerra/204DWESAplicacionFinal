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
                <button form="restForm" name="volver" value="volver">Volver</button>
            </div>
        </div>
        <button class="forSection" onclick="showRest(this)">Diccionario</button>
        <section class="accordion">
            <div class="diccionario">
                <h2>Diccionario de Google<sup><a href="https://dictionaryapi.dev/" target="_blank">ⓘ</a></sup></h2>
                <form method="post" id="restForm">
                    <fieldset>
                        <div class="error"><?php echo $aErrores['word'] ?></div>
                        <input type="text" name="word">
                        <select name="language">
                            <option value="ES" <?php echo $aVREST['language'] == 'ES' ? 'selected' : '' ?>>Español</option>
                            <option value="EN" <?php echo $aVREST['language'] == 'EN' ? 'selected' : '' ?>>Inglés</option>
                        </select>
                        <div class="error"><?php echo $aErrores['language'] ?></div>
                    </fieldset>
                    <fieldset>
                        <button name="enviar" value="enviar">Buscar</button>
                    </fieldset>
                </form>
                <hr>
                <div class="palabra">
                    <?php if (is_array($aVREST['resultado'])) { ?>
                        <h2><?php echo $aVREST['resultado']['palabra']; ?></h2>
                        <div>Origen: <?php echo $aVREST['resultado']['origen']; ?></div>
                        <div>
                            <?php
                            foreach ($aVREST['resultado']['significados'] as $num => $aMeaning) {
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
                        echo "<span>{$aVREST['resultado']}</span>";
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
                                <th><label for="divisaOrigen">Divisa</label></th>
                                <th><label for="cantidad">Cantidad</label></th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="divisaOrigen" id="divisaOrigen">
                                        <option value="EUR">EUR - Euro</option>
                                        <option value="USD">USD - Dólar estadounidense</option>
                                        <option value="JPY">JPY - Yen</option>
                                        <option value="GBP">GBP - Libra esterlina</option>
                                        <option value="AUD">AUD - Dólar australiano</option>
                                        <option value="CAD">CAD - Dólar canadiense</option>
                                        <option value="CHF">CHF - Franco suizo</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="cantidad" id="cantidad" value="1" disabled>
                                </td>
                            </tr>
                            <tr>
                                <th></th>
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