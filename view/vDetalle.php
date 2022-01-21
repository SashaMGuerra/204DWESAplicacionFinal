<?php
/*
 * @author Sasha
 * @since 12/01/2022
 * @version 2.1
 * 
 * Ventana de detalle.
 */
?>
<header>
    <h2>Aplicación<br>Login-Logout</h2>
    <h1>Detalle</h1>
    <div></div>
</header>
<main id="vDetalle">
    <form method="post">
        <fieldset class="submit">
            <button type="submit" id="volver" name="volver" value="volver">Volver</button>
        </fieldset>
    </form>
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
</main>