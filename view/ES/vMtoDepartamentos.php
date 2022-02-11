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
                <input type="radio" name="estado" value="todos" id="departamentoTodos" <?php echo isset($_SESSION['criterioBusquedaDepartamentos']['estado'])?($_SESSION['criterioBusquedaDepartamentos']['estado']==DEPARTAMENTOS_TODOS?'checked':''):'checked'; ?>/>
                <label for="departamentoTodos">Todos</label>
                <input type="radio" name="estado" value="alta" id="departamentoAlta" <?php echo isset($_SESSION['criterioBusquedaDepartamentos']['estado'])?($_SESSION['criterioBusquedaDepartamentos']['estado']==DEPARTAMENTOS_ALTA?'checked':''):''; ?>/>
                <label for="departamentoAlta">Alta</label>
                <input type="radio" name="estado" value="baja" id="departamentoBaja" <?php echo isset($_SESSION['criterioBusquedaDepartamentos']['estado'])?($_SESSION['criterioBusquedaDepartamentos']['estado']==DEPARTAMENTOS_BAJA?'checked':''):'';  ?> />
                <label for="departamentoBaja">Baja</label>
            </fieldset>
            <fieldset>
                <input type="text" name="descDepartamento" id="descDepartamento" value="<?php echo $_SESSION['criterioBusquedaDepartamentos']['descripcionBusqueda'] ?? ''; ?>" placeholder="Descripción del departamento">
                <button name="buscar" value="buscar">Buscar</button>
                <div class="error"><?php echo '<span>' . $aErrores['descDepartamento'] . '</span>' ?></div>
            </fieldset>
            <fieldset>
                <button form="departamentosForm" type="submit" name="exportar">Exportar departamentos</button>
                <button form="departamentosForm" type="submit" name="importar">Importar departamentos</button>
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
                    <tr class="<?php echo empty($aDepartamento['fechaBajaDepartamento'])?'alta':'baja'; ?>">
                        <td><?php echo $aDepartamento['codDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['descDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['fechaCreacionDepartamento']; ?></td>
                        <td><?php echo $aDepartamento['volumenDeNegocio']; ?></td>
                        <td><?php echo $aDepartamento['fechaBajaDepartamento']; ?></td>
                        <td>
                            <button form="departamentosForm" type="submit" name="modificar" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                <img src="webroot/media/img/mtoDepartamentos/modify.png" alt="modificar"/>
                            </button>
                            <?php if (empty($aDepartamento['fechaBajaDepartamento'])) {
                                ?>
                                <button form="departamentosForm" type="submit" name="bajaLogica" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                    <img src="webroot/media/img/mtoDepartamentos/arrow_down.png" alt="bajaLogica"/>
                                </button>
                                <?php
                            } else {
                                ?>
                                <button form="departamentosForm" type="submit" name="rehabilitar" value="<?php echo $aDepartamento['codDepartamento']; ?>">
                                    <img src="webroot/media/img/mtoDepartamentos/arrow_up.png" alt="rehabilitar"/>
                                </button>
                                <?php }
                            ?>
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
        <div class="paginacion">
            <button type="submit" form="departamentosForm" name="paginaPrimera" value="paginaPrimera">
                <img src="webroot/media/img/mtoDepartamentos/pageFirst.png" alt="primera página">
            </button>
            <button type="submit" form="departamentosForm" name="paginaAnterior" value="paginaAnterior">
                <img src="webroot/media/img/mtoDepartamentos/pagePrevious.png" alt="página anterior">
            </button>
            <div id="numPagina">0</div>
            <button type="submit" form="departamentosForm" name="paginaSiguiente" value="paginaSiguiente">
                <img src="webroot/media/img/mtoDepartamentos/pageNext.png" alt="página siguiente">
            </button>
            <button type="submit" form="departamentosForm" name="paginaUltima" value="paginaUltima">
                <img src="webroot/media/img/mtoDepartamentos/pageLast.png" alt="última página">
            </button>
        </div>
    </div>
</main>