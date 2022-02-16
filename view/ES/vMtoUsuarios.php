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
        <div class="usuarios">
            <form onsubmit="buscarUsuarios()">
                <input type="text" name="descUsuario" id="descUsuario" placeholder="Descripción">
                <button>Buscar usuarios</button>
            </form>
            <table>
                <thead>
                    <tr>
                        <th>Código</th>
                        <th>Password</th>
                        <th>Descripción</th>
                        <th>Fecha-hora de última conexión</th>
                        <th>Número de conexiones</th>
                        <th>Perfil</th>
                        <th>Imagen de usuario</th>
                    </tr>
                </thead>
                <tbody id="mtoUsuarios">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        // Carga de usuarios al entrar en la página.
        cargarUsuarios();

        /**
         * Función ejecutada al ser enviado el formulario. Evita que se envíe y
         * carga los usuarios pasándole la descripción dada.
         */
        function buscarUsuarios() {
            event.preventDefault();
            cargarUsuarios(document.getElementById("descUsuario").value)
        }

        /**
         * Carga de los usuarios en la API.
         * 
         * @param String descUsuarios Descripción por la que buscar a los usuarios.
         */
        function cargarUsuarios(descUsuarios = '') {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    mostrarUsuarios(this.responseText);
                }
            };
            xhttp.open("GET", "http://daw204.sauces.local/AplicacionFinal/api/buscarUsuarioPorDesc.php?descUsuario=" + descUsuarios, true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send("Your JSON Data Here");
        }

        /**
         * Muestra los usuarios devueltos en formato tabla.
         * 
         * @param String usuarios String en formato JSON con los usuarios devueltos.
         */
        function mostrarUsuarios(usuarios) {
            var contenido = document.getElementById("mtoUsuarios");
            contenido.innerHTML = ''; // Limpieza de la tabla (si no, añade la información tras los anteriores).
            let JSONUsuarios = JSON.parse(usuarios);

            let newTR;

            for (Usuario of JSONUsuarios) {
                newTR = document.createElement("tr");
                let newTD;

                // codUsuario
                newTD = document.createElement("td");
                newTD.innerHTML = Usuario['codUsuario'];
                newTR.appendChild(newTD);

                // password
                newTD = document.createElement("td");
                newTD.innerHTML = "*********";
                newTR.appendChild(newTD);

                // descUsuario
                newTD = document.createElement("td");
                newTD.innerHTML = Usuario['descUsuario'];
                newTR.appendChild(newTD);

                // fechaHoraUltimaConexion
                let fechaHora = new Date(parseInt(Usuario['fechaHoraUltimaConexion']) * 1000); // *1000 para que esté en milisegundos.
                newTD = document.createElement("td");
                newTD.innerHTML = fechaHora.toUTCString();
                newTR.appendChild(newTD);

                // numConexiones
                newTD = document.createElement("td");
                newTD.innerHTML = Usuario['numConexiones'];
                newTR.appendChild(newTD);

                // perfil
                newTD = document.createElement("td");
                newTD.innerHTML = Usuario['perfil'];
                newTR.appendChild(newTD);

                // imagen de usuario
                newTD = document.createElement("td");
                newTD.innerHTML = Usuario['imagenUsuario'] ? `<img src="data:image/png;base64,${Usuario['imagenUsuario']}" alt="imagen de usuario">` : '-';
                newTR.appendChild(newTD);

                contenido.appendChild(newTR);
            }
        }
    </script>
</main>