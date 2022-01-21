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
<header id="vHeaderLogin">
    <h1>Aplicación Login-Logout</h1>
    <h2>Login</h2>
</header>
<main id="vLogin">
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
        </fieldset>
    </form>
</main>