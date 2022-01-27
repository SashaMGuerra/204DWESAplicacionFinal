/* 
 * @author Sasha
 * @version v1.0
 * @description Funciones de la vista de mi cuenta (editar perfil).
 */

/**
 * Si se sube una nueva imagen de usuario, la muestra en la caja de la imagen.
 * 
 * @param element inputFile Input tipo file que ejecuta la función.
 */
function inputFile(inputFile) {
    let file = inputFile.files[0];
    if (file) {
        var reader = new FileReader();
        reader.readAsDataURL(file, "UTF-8");
        reader.onload = function (event) {
            let img = event.target.result;
            document.getElementById('imgUsuario').src = img;
        };
    }
    else{
        ocultarSubidaImagen();
    }
}

/**
 * Si el checkbox que ejecuta esta función (el de eliminar la imagen
 * de usuario existente) se checa, elimina de la página el input de
 * subida de imagen de usuario.
 * Si el checkbox se desactiva, lo vuelve a mostrar. 
 * 
 * @param element checkbox Checkbox que ejecuta la función.
 */
function ocultarSubidaImagen(checkbox = null) {
    if (!checkbox || checkbox.checked) {
        document.getElementById('imagenUsuario').style.display = 'none';
        document.getElementById('imgUsuario').style.display = 'none';
        document.getElementById('eliminarImagenUsuario').checked = true; 
    } else {
        document.getElementById('imagenUsuario').style.display = 'initial';
        document.getElementById('imgUsuario').style.display = 'initial';
    }
}

