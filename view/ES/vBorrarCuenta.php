<?php
/*
 * @author Sasha
 * @since 20/01/2022
 * @version 3.0
 * 
 * Ventana de borrado de cuenta.
 */
?>
<header id="vHeaderBorrarCuenta">
    <h2>Aplicación<br>Login-Logout</h2>
    <h1>Borrar cuenta</h1>
    <div></div>
</header>
<main id="vBorrarCuenta">
    <form method="post">
        <h3>¿Está seguro que quiere borrar la cuenta?</h3>
        <fieldset class="submit">
            <button type="submit" id="aceptar" name="aceptar" value="aceptar">Aceptar</button>
            <button type="submit" id="cancelar" name="cancelar" value="cancelar">Cancelar</button>
        </fieldset>
    </form>
</main>