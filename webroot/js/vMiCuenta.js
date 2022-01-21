/* 
 * @author Sasha
 * @version v2.2
 * @description Funciones de la vista de mi cuenta (editar perfil).
 */


/**
 * Si el checkbox que ejecuta esta función (el de eliminar la imagen
 * de usuario existente) se checa, elimina de la página el input de
 * subida de imagen de usuario.
 * Si el checkbox se desactiva, lo vuelve a mostrar. 
 * 
 * @param elemento checkbox Checkbox que ejecuta la función.
 */
function ocultarSubidaImagen(checkbox) {
    if (checkbox.checked) {
        document.getElementById('imagenUsuario').style.display = 'none';
    } else {
        document.getElementById('imagenUsuario').style.display = 'initial';
    }
}

