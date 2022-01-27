<?php
/*
 * @author Sasha
 * @since 04/01/2022
 * @version 1.0
 * 
 * Vista del registro.
 * Contiene un formulario para introducir los datos del nuevo usuario.
 */
?>
<main>
    <div class="container">
        <h1>Registro</h1>
        <form method="post">
            <fieldset>
                <label class="obligatorio" for='usuario' >Usuario</label>
                <input class="obligatorio" type='text' name='usuario' id='usuario'/>
                <label class="obligatorio" for='descripcion' >Nombre y apellidos</label>
                <input class="obligatorio" type='text' name='descripcion' id='descripcion' value="<?php echo $_REQUEST['descripcion'] ?? '' ?>"/>
                <label class="obligatorio" for='password' >Contraseña</label>
                <input class="obligatorio" type='password' name='password' id='password'/>
                <div class="error"><?php echo $sError; ?></div>
            </fieldset>
            <fieldset class="submit">
                <button type="submit" name="anadirUsuario" value="anadirUsuario">Crear usuario</button>
                <button type="submit" name="cancelar" value="cancelar">Cancelar</button>
            </fieldset>
        </form>
    </div>
</main>