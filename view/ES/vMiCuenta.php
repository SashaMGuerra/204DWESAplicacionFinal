<?php
/*
 * @author Sasha
 * @since 22/12/2021
 * @version 1.0
 * 
 * Vista del inicio.
 */
?>
<main>
    <div class="container">
        <div class="mainH1">
            <h1>Mi cuenta</h1>
            <div>
                <button type="submit" form="cuentaForm" name='eliminarCuenta' value='eliminarCuenta'>Eliminar cuenta</button>
            </div>
        </div>
        <form id="cuentaForm" method="post" enctype="multipart/form-data">
            <fieldset class="main">
                <div class="input">
                    <label for='usuario'>Nombre de usuario</label>
                    <input type='text' name='usuario' id='usuario' value="<?php echo $aVMiCuenta['usuario'] ?>" disabled/>
                </div>
                <div class="input">
                    <label class="obligatorio" for='descripcion'>Nombre y apellidos</label>
                    <input class="obligatorio" type='text' name='descripcion' id='descripcion' value="<?php echo $aVMiCuenta['descripcion'] ?? '' ?>"/>
                    <div class="error"><?php echo $aErrores['descripcion'] ?></div>
                </div>
                <div class="input">
                    <label for='perfil'>Perfil de usuario</label>
                    <input type='text' name='perfil' id='perfil' value="<?php echo $aVMiCuenta['perfil'] ?>" disabled/>
                </div>
                <div class="input password">
                    <button type="submit" name="cambiarPassword" value="cambiarPassword">Cambiar contraseña</button>
                </div>
                <div class="input">
                    <label for='numConexiones'>Número de conexiones</label>
                    <input type='text' name='numConexiones' id='numConexiones' value="<?php echo $aVMiCuenta['numConexiones'] ?>" disabled/>
                </div>
                <div class="input">
                    <label for='fechaHoraUltimaConexion'>Fecha-hora de última conexión</label>
                    <input type='text' name='fechaHoraUltimaConexion' id='fechaHoraUltimaConexion' value="<?php echo $aVMiCuenta['fechaHoraUltimaConexion'] ?>" disabled/>
                </div>
                <div class="input imagen">
                    <label for='imagenUsuario'>Imagen de usuario</label>
                    <?php
                    // Si el usuario tiene imagen de usuario, la muestra.
                    if ($aVMiCuenta['imagenUsuario']) {
                        ?>
                    <div class="img">
                        <img id="imgUsuario" src="data:image/jpg;base64, <?php echo $aVMiCuenta['imagenUsuario'] ?>" alt="imagen de usuario">
                        <div>
                            <input type="checkbox" name="eliminarImagenUsuario" id="eliminarImagenUsuario" onclick="ocultarSubidaImagen(this)">
                            <label for="eliminarImagenUsuario">¿Eliminar imagen de usuario?</label>
                        </div>
                    </div>
                        <?php }
                    ?>
                    <input type='file' name='imagenUsuario' id='imagenUsuario' accept=".jpg,.jpeg,.png" onchange="inputFile(this)"/>
                    <div class="error"><?php echo $aErrores['imagenUsuario'] ?></div>
                </div>
            </fieldset>
            <fieldset class="submit">
                <button type="submit" name='aceptar' value='aceptar'>Efectuar cambios</button>
                <button type="submit" name='cancelar' value='cancelar'>Cancelar</button>
            </fieldset>
        </form>
    </div>
</main>