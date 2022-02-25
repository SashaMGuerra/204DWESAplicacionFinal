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
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="mtoUsuarios">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        var xhttp = new XMLHttpRequest();

        // Carga de usuarios al entrar en la página.
        cargarUsuarios();

        /**
         * Función ejecutada al ser enviado el formulario. Evita que se envíe y
         * carga los usuarios pasándole la descripción dada.
         */
        function buscarUsuarios() {
            event.preventDefault();
            cargarUsuarios(document.getElementById("descUsuario").value);
        }

        /**
         * Carga de los usuarios en la API.
         * 
         * @param String descUsuarios Descripción por la que buscar a los usuarios.
         */
        function cargarUsuarios(descUsuarios = '') {
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

                // Información sobre el usuario.
                for (key in Usuario) {
                    newTD = document.createElement("td");
                    switch (key) {
                        case 'password':
                            newTD.innerHTML = `<input id="password${Usuario['codUsuario']}" form='formUsuarios' type='password' value='${Usuario[key]}' disabled>`;
                            break;
                        case 'fechaHoraUltimaConexion':
                            let fechaHora = new Date(parseInt(Usuario['fechaHoraUltimaConexion']) * 1000); // *1000 para que esté en milisegundos.
                            newTD.innerHTML = fechaHora.toUTCString();
                            break;
                        case 'imagenUsuario':
                            newTD.innerHTML = Usuario[key] ? `<img src="data:image/png;base64,${Usuario['imagenUsuario']}" alt="imagen de usuario">` : '-';
                            break;
                        default:
                            newTD.innerHTML = Usuario[key]??'-';
                                    break;
                    }
                    newTR.appendChild(newTD);
                }

                // Botones.
                newTD = document.createElement("td");
                newTD.innerHTML = `<button onclick='eliminarUsuario(this)' value="${Usuario['codUsuario']}"><img src='webroot/media/img/mtoUsuarios/delete.png' alt='Eliminar usuario'></button>
                                <button onclick='modificarPassword(this)' value="${Usuario['codUsuario']}"><img src='webroot/media/img/mtoUsuarios/modifyPassword.png' alt='Resetear contraseña'></button>`;
                newTR.appendChild(newTD);

                contenido.appendChild(newTR);
            }
        }

        /**
         * Elimina el usuario indicado.
         *     
         * @param DOMElement btn Botón pulsado, que contiene en el value el código
         * del usuario a eliminar.
         */
        function eliminarUsuario(btn) {
            var codUsuario = btn.value;

            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    cargarUsuarios();
                }
            };
            xhttp.open("DELETE", "http://daw204.sauces.local/AplicacionFinal/api/eliminarUsuarioPorCodigo.php?codUsuario=" + codUsuario, true);
            xhttp.setRequestHeader("Content-type", "application/json");
            xhttp.send("Your JSON Data Here");
        }

        /**
         * Modificación de contraseña del usuario indicado.
         * 
         * @param DOMElement btn Botón pulsado, que contiene en el value el código
         * del usuario a modificar su password.
         */
        function modificarPassword(btn) {
            var codUsuario = btn.value;
            var inputPassword = document.getElementById('password' + codUsuario);

            inputPassword.disabled = false;
            inputPassword.value = '';

            inputPassword.addEventListener('keydown', function () {
                // Si se ha pulsado enter.
                if (event.keyCode === 13) {
                    let password = inputPassword.value;

                    xhttp.onreadystatechange = function () {
                        if (this.readyState == 4 && this.status == 200) {
                            console.log(this.responseText);
                            cargarUsuarios();
                        }
                    };
                    xhttp.open("GET", ("http://daw204.sauces.local/AplicacionFinal/api/modificarPasswordUsuarioPorCodigo.php?codUsuario=" + codUsuario + "&password=" + password), true);
                    xhttp.setRequestHeader("Content-type", "application/json");
                    xhttp.send("Your JSON Data Here");
                }
            });
        }
    </script>
</main>