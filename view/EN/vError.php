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
        <div class="mainH1">
            <h1>Error</h1>
            <div>
                <form method="post">
                    <button type="submit" name="volver" value="volver">Close and go back</button>
                </form>
            </div>
        </div>
        <h3>There has been an error:</h3>
        <div>
            <table>
                <tr>
                    <th>Error</th>
                    <td><?php echo $aVError['error']; ?></td>
                </tr>
                <tr>
                    <th>Code</th>
                    <td><?php echo $aVError['codigo']; ?></td>
                </tr>
                <tr>
                    <th>File</th>
                    <td><?php echo $aVError['archivo']; ?></td>
                </tr>
                <tr>
                    <th>Line</th>
                    <td><?php echo $aVError['linea']; ?></td>
                </tr>
            </table>
        </div>
    </div>
</main>