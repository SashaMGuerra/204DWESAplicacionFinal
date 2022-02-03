<?php
/*
 * Vista del mantenimiento de departamentos.
 * 
 * Muestra los departamentos existentes en la base de datos y permite irse a
 * otras ventanas para hacer operaciones con ellos.
 * 
 * @author Sasha
 * @since 31/01/2022
 * @version 2.0
 */
?>
<main>
    <div class="container">
        <div class="mainH1">
            <h1>Mantenimiento de departamentos</h1>
            <div>
                <button type="submit" form="layoutForm" name="volver" value="volver">Volver</button>
            </div>
        </div>
        <form method="post" id="departamentosForm">
            <fieldset>
                <label for="descDepartamento">Departamento a buscar</label>
                <input type="text" name="descDepartamento" id="descDepartamento" value="<?php echo $_REQUEST['descDepartamento'] ?? '' ?>">
                <div class="error"><?php echo '<span>' . $aErrores['descDepartamento'] . '</span>' ?></div>
                <button name="buscar" value="buscar">Buscar</button>
            </fieldset>
            <fieldset>
                <button form="departamentosForm" type="submit" name="anadir">Añadir departamento</button>
            </fieldset>
        </form>
        <table>
            <tr>
                <th>Código</th>
                <th>Descripción</th>
                <th>Fecha de creación</th>
                <th>Volumen de negocio</th>
                <th>Fecha de baja</th>
                <th>Acciones</th>
            </tr>
            <?php
            if ($aVMtoDepartamentos) {
                foreach ($aVMtoDepartamentos as $aDepartamento) {
                    ?>
                    <tr>
                        <td><?php echo $aDepartamento['codDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['descDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['fechaCreacionDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['volumenDeNegocio']; ?></td>
                        <td><?php echo $aDepartamento['fechaBajaDepartamento']; ?></td>
                        <td>
                            <button form="departamentosForm" type="submit" name="ver" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                <img src="webroot/media/img/mtoDepartamentos/view.png" alt="ver"/>
                            </button>
                            <button form="departamentosForm" type="submit" name="modificar" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                <img src="webroot/media/img/mtoDepartamentos/modify.png" alt="modificar"/>
                            </button>
                            <button form="departamentosForm" type="submit" name="eliminar" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                <img src="webroot/media/img/mtoDepartamentos/delete.png" alt="eliminar"/>
                            </button>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </table>
    </div>
</main>