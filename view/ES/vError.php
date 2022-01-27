<?php
/* 
 * @author Sasha
 * @since 12/01/2022
 * @version 1.0
 * 
 * Vista para mostrado de errores y excepciones.
 */
?>
<main>
    <div class="container">
        <h1>Error</h1>
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
            <button type="submit" name="volver" value="volver">Cerrar y volver</button>
        </form>
    </div>
</main>