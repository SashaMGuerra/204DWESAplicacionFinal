<?php
/*
 * Vista de la ventana de eliminación de un departamento.
 * 
 * Muestra la información del departamento para confirmar su  eliminación.
 * 
 * @author Sasha
 * @since 02/02/2022
 * @version 2.0
 */
?>
<main>
    <div class="container">
        <h1>Eliminación de departamento</h1>
        <div>
            <form method="post" id="eliminarDepartamentoForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Código</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVEliminarDepartamento['codDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Descripción</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $aVEliminarDepartamento['descDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='fechaCreacionDepartamento'>Fecha de creación</label>
                        <input type='text' name='fechaCreacionDepartamento' id='fechaCreacionDepartamento' value="<?php echo $aVEliminarDepartamento['fechaCreacionDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Volumen de negocio</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $aVEliminarDepartamento['volumenDeNegocio']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='fechaBajaDepartamento'>Fecha de baja</label>
                        <input type='text' name='fechaBajaDepartamento' id='fechaBajaDepartamento' value="<?php echo $aVEliminarDepartamento['fechaBajaDepartamento']; ?>" disabled/>
                    </div>
                </fieldset>
                <fieldset class="submit">
                    <button name="aceptar" value="aceptar">Aceptar</button>
                    <button name="cancelar" value="cancelar">Cancelar</button>
                </fieldset>
            </form>
        </div>
    </div>
</main>