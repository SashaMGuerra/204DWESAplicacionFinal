<?php
/*
 * Vista del mantenimiento de usuarios.
 * 
 * Utiliza javascript para realizar las acciones.
 * 
 * @author Sasha
 * @since 15/02/2022
 * @version 2.3
 */
?>
<main>
    <div class="container">
        <div class="mainH1">
            <h1>Mantenimiento de usuarios</h1>
            <div>
                <form method="post">
                    <button type="submit" name="volver" value="volver">Volver</button>
                </form>
            </div>
        </div>
        <div id="mtoUsuarios">
            <button onclick="cargarUsuarios()" id="cargarUsuarios">Cargar usuarios</button>
        </div>
    </div>
    <script>
        var contenido = document.getElementById("mtoUsuarios");

        function cargarUsuarios() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    alert(this.responseText);
                }
            };
            xhttp.open("GET", "http://daw204.sauces.local/AplicacionFinal/api/buscarUsuarioPorDesc.php", true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send("Your JSON Data Here");
        }
    </script>
</main>