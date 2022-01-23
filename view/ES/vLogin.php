<?php
/*
 * @author Sasha
 * @since 22/12/2021
 * @version 1.0
 * 
 * Vista del login.
 * Contiene un formulario para introducir usuario y contraseña.
 */
?>
<main id="vLogin">
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <fieldset>
                <label class="obligatorio" for="usuario">Usuario</label>
                <input type="text" id="usuario" name="usuario" autofocus>
                <label class="obligatorio" for="password">Contraseña</label>
                <input type="password" id="password" name="password">
            </fieldset>
            <fieldset class="submit">
                <button type="submit" name="login" id="login" value="login">Iniciar sesión</button>
                <button type="submit" name="cancelar" id="cancelar" value="cancelar">Cancelar</button>
                <button type="submit" name="registrarse" id="registrarse" value="registrarse">Registrarse</button>
            </fieldset>
        </form>
    </div>
</main>

