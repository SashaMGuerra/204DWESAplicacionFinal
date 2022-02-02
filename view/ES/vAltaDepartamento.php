<?php
/*
 * Vista de la ventana de alta de un departamento.
 * 
 * Muestra los campos a rellenar para crear un departamento.
 * 
 * @author Sasha
 * @since 02/02/2022
 * @version 2.0
 */
?>
<main>
    <div class="container">
        <h1>Creación de departamento</h1>
        <div>
            <form method="post" id="altaDptoForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Código</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $aVAltaDepartamento['codDepartamento']; ?>" placeholder="AAA"/>
                        <div class="error"><?php echo $aErrores['codDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Descripción</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $aVAltaDepartamento['descDepartamento']; ?>"/>
                        <div class="error"><?php echo $aErrores['descDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Volumen de negocio</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $aVAltaDepartamento['volumenDeNegocio']; ?>" placeholder="1.0"/>
                        <div class="error"><?php echo $aErrores['volumenDeNegocio']; ?></div>
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