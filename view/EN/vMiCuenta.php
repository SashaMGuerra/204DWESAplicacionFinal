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
            <h1>My account</h1>
            <div>
                <button type="submit" form="layoutForm" name='eliminarCuenta' value='eliminarCuenta'>Remove account</button>
            </div>
        </div>
        <form id="cuentaForm" method="post" enctype="multipart/form-data">
            <fieldset class="main">
                <div class="input">
                    <label for='usuario'>Username</label>
                    <input type='text' name='usuario' id='usuario' value="<?php echo $aVMiCuenta['usuario'] ?>" disabled/>
                </div>
                <div class="input">
                    <label class="obligatorio" for='descripcion'>Full name</label>
                    <input class="obligatorio" type='text' name='descripcion' id='descripcion' value="<?php echo $aVMiCuenta['descripcion'] ?? '' ?>"/>
                    <div class="error"><?php echo $aErrores['descripcion'] ?></div>
                </div>
                <div class="input">
                    <label for='perfil'>User profile</label>
                    <input type='text' name='perfil' id='perfil' value="<?php echo $aVMiCuenta['perfil'] ?>" disabled/>
                </div>
                <div class="input password">
                    <button type="submit" name="cambiarPassword" value="cambiarPassword">Change password</button>
                </div>
                <div class="input">
                    <label for='numConexiones'>Connections count</label>
                    <input type='text' name='numConexiones' id='numConexiones' value="<?php echo $aVMiCuenta['numConexiones'] ?>" disabled/>
                </div>
                <div class="input">
                    <label for='fechaHoraUltimaConexion'>Last connection date</label>
                    <input type='text' name='fechaHoraUltimaConexion' id='fechaHoraUltimaConexion' value="<?php echo $aVMiCuenta['fechaHoraUltimaConexion'] ?>" disabled/>
                </div>
                <div class="input imagen">
                    <label for='imagenUsuario'>User image</label>
                    <?php
                    // Si el usuario tiene imagen de usuario, la muestra.
                    if ($aVMiCuenta['imagenUsuario']) {
                        ?>
                    <div class="img">
                        <img id="imgUsuario" src="data:image/jpg;base64, <?php echo $aVMiCuenta['imagenUsuario'] ?>" alt="imagen de usuario">
                        <div>
                            <input type="checkbox" name="eliminarImagenUsuario" id="eliminarImagenUsuario" onclick="ocultarSubidaImagen(this)">
                            <label for="eliminarImagenUsuario">¿Remove user image?</label>
                        </div>
                    </div>
                        <?php }
                    ?>
                    <input type='file' name='imagenUsuario' id='imagenUsuario' accept=".jpg,.jpeg,.png" onchange="inputFile(this)"/>
                    <div class="error"><?php echo $aErrores['imagenUsuario'] ?></div>
                </div>
            </fieldset>
            <fieldset class="submit">
                <button type="submit" name='aceptar' value='aceptar'>Change profile info</button>
                <button type="submit" name='cancelar' value='cancelar'>Cancel</button>
            </fieldset>
        </form>
    </div>
</main>