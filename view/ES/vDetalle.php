<?php
/*
 * @author Sasha
 * @since 12/01/2022
 * @version 1.0
 * 
 * Ventana de detalle.
 */
?>
<main>
    <div class="container">
        <div class="mainH1">
            <h1>Ventana de detalle</h1>
            <div>
                <form method="post">
                    <button type="submit" name="volver" value="volver">Volver</button>
                </form>
            </div>
        </div>
        <hr>
        <h3>$_SESSION</h3>
        <table>
            <?php
            foreach ($_SESSION as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td><td><pre>";
                print_r($value); // print_r porque pueden ser objetos.
                echo '</pre></td></tr>';
            }
            ?>
        </table>
        <h3>$_COOKIE</h3>
        <table>
            <?php
            foreach ($_COOKIE as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <h3>$_SERVER</h3>
        <table>
            <?php
            foreach ($_SERVER as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <h3>$_REQUEST</h3>
        <table>
            <?php
            foreach ($_REQUEST as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <h3>$_FILES</h3>
        <table>
            <?php
            foreach ($_FILES as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <h3>$_ENV</h3>
        <table>
            <?php
            foreach ($_ENV as $key => $value) {
                echo '<tr>';
                echo "<td>$key</td>";
                echo "<td>$value</td>";
                echo '</tr>';
            }
            ?>
        </table>
        <hr>
        <?php
        phpinfo();
        ?>
    </div>

</main>