<?php
/*
 * @author Sasha
 * @since 18/01/2022
 * @version 1.0
 * 
 * Ventana de cambio de contraseña.
 */
?>
<main>
    <div class="container">
        <h1>Change password</h1>
        <form method='post'>
            <fieldset class="main">
                <div class="input">
                    <label class='obligatorio' for='passwordActual' >Old password</label>
                    <input class='obligatorio' type='password' name='passwordActual' id='passwordActual'/>
                    <div class="error"><?php echo $aErrores['passwordActual'] ?></div>
                </div>
                <div class="input">
                    <label class='obligatorio' for='passwordNueva' >New password</label>
                    <input class='obligatorio' type='password' name='passwordNueva' id='passwordNueva'/>
                    <div class="error"><?php echo $aErrores['passwordNueva'] ?></div>
                </div>
                <div class="input">
                    <label class='obligatorio' for='passwordRepeticion' >Repeat password</label>
                    <input class='obligatorio' type='password' name='passwordRepeticion' id='passwordRepeticion'/>
                    <div class="error"><?php echo $aErrores['passwordRepeticion'] ?></div>
                </div>            
            </fieldset>
            <fieldset class="submit">
                <button type='submit' name='aceptar' value='aceptar'>Change password</button>
                <button type='submit' name='cancelar' value='cancelar'>Cancel</button>
            </fieldset>
        </form>
    </div>
</main>