<?php
/*
 * @author Sasha
 * @since 25/01/2022
 * @version 1.0
 * 
 * Ventana de las api rest.
 */
?>
<header>
    <h2>Aplicación<br>Login-Logout</h2>
    <h1>Rest</h1>
    <div></div>
</header>
<main id="vREST">
    <form>
        <fieldset>
            <input type="text" name="word" value="<?php echo $_REQUEST['word'] ?? '' ?>">
            <div class="error"><?php echo $aErrores['word'] ?></div>
            <select name="language">
                <option value="ES" <?php echo $aVREST['language'] == 'ES' ? 'selected' : '' ?>>Español</option>
                <option value="EN" <?php echo $aVREST['language'] == 'EN' ? 'selected' : '' ?>>Inglés</option>
                <option value="FR" <?php echo $aVREST['language'] == 'FR' ? 'selected' : '' ?>>Francés</option>
            </select>
            <div class="error"><?php echo $aErrores['language'] ?></div>
        </fieldset>
        <button name="enviar" value="enviar">Buscar</button>
        <button name="volver" value="volver">Volver</button>
    </form>

    <pre>
        <?php print_r($aVREST['resultado']); ?>
    </pre>
    
    <div class="palabra">
    <?php if(is_object($aVREST['resultado'])){ ?>
        <h2><?php echo $aVREST['resultado']->word; ?></h2>
        <div>Origen: <?php echo $aVREST['resultado']->origin; ?></div>
        <div>
            <?php foreach ($aVREST['resultado']->meanings as $aMeaning) {
                var_dump($aMeaning);
            } ?>
        </div>
    <?php } else {echo $aVREST['resultado'];} ?>
    </div>
</main>