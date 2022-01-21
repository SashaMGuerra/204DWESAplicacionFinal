<?php
/*
 * @author Sasha
 * @since 04/01/2022
 * @version 2.0
 * 
 * Vista del registro.
 * Contiene un formulario para introducir los datos del nuevo usuario.
 */
?>
<header id="vHeaderRegistro">
    <h1>Aplicación Login-Logout</h1>
    <h2>Registro</h2>
</header>
<main id="vRegistro">
    <form method="post">
        <fieldset>
            <ul>
                <li><label class="obligatorio" for='usuario' >Usuario</label></li>
                <li><input class="obligatorio" type='text' name='usuario' id='usuario'/></li>
            </ul>
            <ul>
                <li><label class="obligatorio" for='descripcion' >Nombre y apellidos</label></li>
                <li><input class="obligatorio" type='text' name='descripcion' id='descripcion' value="<?php echo $_REQUEST['descripcion'] ?? '' ?>"/></li>
            </ul>
            <ul>
                <li><label class="obligatorio" for='password' >Contraseña</label></li>
                <li><input class="obligatorio" type='password' name='password' id='password'/></li>
            </ul>
            <div class="error"><?php echo $sError; ?></div>
        </fieldset>
        <fieldset class="submit">
            <button type="submit" name="anadirUsuario" id="anadirUsuario" value="anadirUsuario">Crear usuario</button>
            <button type="submit" name="cancelar" id="cancelar" value="cancelar">Cancelar</button>
        </fieldset>
    </form>
</main>