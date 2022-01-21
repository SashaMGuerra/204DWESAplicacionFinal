<?php
/* 
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Vista para mostrado de errores y excepciones.
 */
?>
<header>
    <h2>Aplicación<br>Login-Logout</h2>
    <h1>Error</h1>
    <div></div>
</header>
<main id="vError">
    <h3>Ha sucedido el siguiente error:</h3>
    <div>
        <table>
            <tr>
                <th>Error</th>
                <td><?php echo $aVError['error']; ?></td>
            </tr>
            <tr>
                <th>Código</th>
                <td><?php echo $aVError['codigo']; ?></td>
            </tr>
            <tr>
                <th>Archivo</th>
                <td><?php echo $aVError['archivo']; ?></td>
            </tr>
            <tr>
                <th>Línea</th>
                <td><?php echo $aVError['linea']; ?></td>
            </tr>
        </table>
    </div>
    <form method="post">
        <button type="submit" name="volver" id="volver" value="volver">Cerrar y volver</button>
    </form>
</main>