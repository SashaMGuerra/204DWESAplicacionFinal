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
        <h1>Rest</h1>
        <h2>Diccionario de Google<sup>ⓘ</sup><span>API Rest del diccionario de Google.<br><br>Dado un idioma y una palabra, muestra su origen —si lo tiene indicado— y sus definiciones con sinónimos y antónimos.</span></h2>
        <section class="diccionario">
            <form method="post">
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
                    <button name="volver" value="volver">Volver</button>
                </fieldset>
            </form>
            <hr>
            <div class="palabra">
                <?php if (is_object($aVREST['resultado'])) { ?>
                    <h2><?php echo $aVREST['resultado']->palabra; ?></h2>
                    <div>Origen: <?php echo $aVREST['resultado']->origen; ?></div>
                    <div>
                        <?php
                        foreach ($aVREST['resultado']->significados as $num => $aMeaning) {
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
        </section>
    </div>
</main>