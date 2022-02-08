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
<main>
    <div class="container">
        <h1>Login</h1>
        <form method="post">
            <fieldset>
                <label class="obligatorio" for="usuario">User</label>
                <input type="text" id="usuario" name="usuario" autofocus>
                <label class="obligatorio" for="password">Password</label>
                <input type="password" id="password" name="password">
            </fieldset>
            <fieldset class="submit">
                <button type="submit" name="login" id="login" value="login">Login</button>
                <button type="submit" name="registrarse" id="registrarse" value="registrarse">Sign up</button>
            </fieldset>
        </form>
    </div>
</main>

