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
        <h1>Delete department</h1>
        <div>
            <form method="post" id="eliminarDepartamentoForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Code</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVEliminarDepartamento['codDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Description</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $aVEliminarDepartamento['descDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='fechaCreacionDepartamento'>Creation date</label>
                        <input type='text' name='fechaCreacionDepartamento' id='fechaCreacionDepartamento' value="<?php echo $aVEliminarDepartamento['fechaCreacionDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Turnover</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $aVEliminarDepartamento['volumenDeNegocio']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='fechaBajaDepartamento'>Deactivation date</label>
                        <input type='text' name='fechaBajaDepartamento' id='fechaBajaDepartamento' value="<?php echo $aVEliminarDepartamento['fechaBajaDepartamento']; ?>" disabled/>
                    </div>
                </fieldset>
                <fieldset class="submit">
                    <button name="aceptar" value="aceptar">Accept</button>
                    <button name="cancelar" value="cancelar">Cancel</button>
                </fieldset>
            </form>
        </div>
    </div>
</main>