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
        <h1>Department creation</h1>
        <div>
            <form method="post" id="altaDptoForm">
                <fieldset class="main">
                    <div class="input">
                        <label for='codDepartamento'>Code</label>
                        <input type='text' name='codDepartamento' id='codDepartamento' value="<?php echo $_REQUEST['codDepartamento']??''; ?>" placeholder="AAA"/>
                        <div class="error"><?php echo $aErrores['codDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='descDepartamento'>Description</label>
                        <input type='text' name='descDepartamento' id='descDepartamento' value="<?php echo $_REQUEST['descDepartamento']??''; ?>"/>
                        <div class="error"><?php echo $aErrores['descDepartamento']; ?></div>
                    </div>
                    <div class="input">
                        <label for='volumenDeNegocio'>Turnover</label>
                        <input type='text' name='volumenDeNegocio' id='volumenDeNegocio' value="<?php echo $_REQUEST['volumenDeNegocio']??''; ?>" placeholder="1.0"/>
                        <div class="error"><?php echo $aErrores['volumenDeNegocio']; ?></div>
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