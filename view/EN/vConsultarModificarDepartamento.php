<?php
/*
 * Vista de la ventana de consulta o modificación de un departamento.
 * 
 * Muestra la información del departamento, y según su utilidad, permite o no
 * modificar los campos.
 * 
 * @author Sasha
 * @since 01/02/2022
 * @version 2.0
 */
?>
<main>
    <div class="container">
        <h1>Modify department</h1>
        <div>
            <form method="post" id="consultarModificarForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Code</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVConsultarModificarDepartamento['codDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Description</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $aVConsultarModificarDepartamento['descDepartamento']; ?>"/>
                        <div class="error"><?php echo $aErrores['descDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='fechaCreacionDepartamento'>Creation date</label>
                        <input type='text' name='fechaCreacionDepartamento' id='fechaCreacionDepartamento' value="<?php echo $aVConsultarModificarDepartamento['fechaCreacionDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Turnover</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $aVConsultarModificarDepartamento['volumenDeNegocio']; ?>"/>
                        <div class="error"><?php echo $aErrores['volumenDeNegocio']; ?></div>
                    </div>
                    <div class="input">
                        <label for='fechaBajaDepartamento'>Deactivation date</label>
                        <input type='text' name='fechaBajaDepartamento' id='fechaBajaDepartamento' value="<?php echo $aVConsultarModificarDepartamento['fechaBajaDepartamento']; ?>" disabled/>
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