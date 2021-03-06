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
            <h1>Home</h1>
            <div>
                <button type="submit" form="formInicio" name="miCuenta" value="miCuenta">Profile</button>
                <button type="submit" form="formInicio" name="logout" value="logout">Logout</button>
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
        </aside>
        <section class="contenido">
            <div class="bienvenida">Welcome <span class="user"><?php echo $aVInicioPrivado['descUsuario']; ?></span>, this is the <?php
                switch ($aVInicioPrivado['numConexiones']) {
                    case 1:
                        echo '1st';
                        break;
                    case 2:
                        echo '2nd';
                        break;
                    case 3:
                        echo '3rd';
                        break;
                    default:
                        echo $aVInicioPrivado['numConexiones'] . "th";
                }
                ?> time you login<?php
                if (!empty($aVInicioPrivado['fechaHoraUltimaConexionAnterior'])) {
                    ?> and the last time was on <?php
                    echo date('d/m/Y H:i:s', $aVInicioPrivado['fechaHoraUltimaConexionAnterior']);
                }
                ?>.</div>
        </section>
        <section>
            <form method="post" id="formInicio">
                <button type="submit" id="rest" name="rest" value="rest">REST</button>
                <button type="submit" name="detalle" value="detalle">Detail</button>
                <button type="submit" name="fallar" value="fallar">Execute a fail select</button>
                <button type="submit" name="mantenimiento" value="mantenimiento">Go to <?php echo $_SESSION['usuarioDAW204AplicacionFinal']->getPerfil() === 'administrador' ? 'UserMaintenance' : 'DptsMaintenance'; ?></button>
            </form>
        </section>
    </div>
</main>