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
            <h1>Inicio</h1>
            <div>
                <button type="submit" form="formInicio" name="miCuenta" value="miCuenta">Ver perfil</button>
                <button type="submit" form="formInicio" name="logout" value="logout">Cerrar sesión</button>
            </div>
        </div>
        <aside>
            <?php
            // Si el usuario tiene imagen de usuario, la muestra. Si no, muestra una de las de por defecto.
            if (!empty($aVInicioPrivado['imagenUsuario'])) {
                ?>
                <img src="data:image/gif;base64, <?php echo $aVInicioPrivado['imagenUsuario'] ?>" alt="imagen de usuario">
            <?php } else { ?>
                <script>document.write(`<img src="webroot/media/img/randomDefault/${Math.floor(Math.random() * 5)}.jpg" alt="imagen de usuario"/>`);</script>
            <?php } ?>
            <form method="post" id="formInicio">
                <button type="submit" id="rest" name="rest" value="rest">REST</button>
                <button type="submit" name="detalle" value="detalle">Detalle</button>
                <button type="submit" name="fallar" value="fallar">Hacer un select fallido</button>
                <button type="submit" name="mantenimiento" value="mantenimiento">Ir a <?php echo $_SESSION['usuarioDAW204AppLoginLogout']->getPerfil()==='administrador'?'mtoUsuarios':'mtoDepartamentos'; ?></button>
            </form>
        </aside>
        <section>
            <div class="bienvenida">Bienvenid@ <span class="user"><?php echo $aVInicioPrivado['descUsuario']; ?></span>, esta es la <?php echo $aVInicioPrivado['numAccesos']; ?>ª vez que se conecta<?php
                if (!empty($aVInicioPrivado['fechaHoraUltimaConexionAnterior'])) {
                    ?> y su última conexión fue <?php
                    echo date('d/m/Y H:i:s', $aVInicioPrivado['fechaHoraUltimaConexionAnterior']);
                }
                ?>.</div>
        </section>
    </div>
</main>