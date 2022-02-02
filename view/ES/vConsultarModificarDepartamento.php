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
        <h1>Consulta o modificación de departamento</h1>
        <div>
            <form method="post" id="consultarModificarForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Código</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVConsultarModificarDepartamento['codDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Descripción</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $aVConsultarModificarDepartamento['descDepartamento']; ?>"/>
                        <div class="error"><?php echo $aErrores['descDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='fechaCreacionDepartamento'>Fecha de creación</label>
                        <input type='text' name='fechaCreacionDepartamento' id='fechaCreacionDepartamento' value="<?php echo $aVConsultarModificarDepartamento['fechaCreacionDepartamento']; ?>" disabled/>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Volumen de negocio</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $aVConsultarModificarDepartamento['volumenDeNegocio']; ?>"/>
                        <div class="error"><?php echo $aErrores['volumenDeNegocio']; ?></div>
                    </div>
                    <div class="input">
                        <label for='fechaBajaDepartamento'>Fecha de baja</label>
                        <input type='text' name='fechaBajaDepartamento' id='fechaBajaDepartamento' value="<?php echo $aVConsultarModificarDepartamento['fechaBajaDepartamento']; ?>" disabled/>
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