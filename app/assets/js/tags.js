const tagsInput = document.querySelector('#tags_input');
if (!tagsInput) return; // Si no existe el input, salir de la función

const tagsDiv = document.querySelector('#tags');
const tagsInputHidden = document.querySelector('[name="tags"]');
let tags = [];

// Recuperar los tags del input oculto
if(tagsInputHidden.value !== '') {
    const arrayTags = tagsInputHidden.value.split(',');
    
    tags = arrayTags;

    mostrarTags();
}

// Escuchar los cambios en el input
tagsInput.addEventListener('keypress', guardarTags);

function guardarTags(e) {
    if (e.keyCode === 44) {
        if (e.target.value.trim() === '' || e.target.value.length < 1) return;

        e.preventDefault();

        tags = [...tags, e.target.value.trim()];

        tagsInput.value = '';

        mostrarTags();
    }
}

function mostrarTags() {
    tagsDiv.textContent = '';

    tags.forEach(tag => {
        const etiqueta = document.createElement('LI');
        etiqueta.classList.add('formulario__tag');
        etiqueta.textContent = tag;
        etiqueta.ondblclick = eliminarTag;

        tagsDiv.appendChild(etiqueta);
    })

    actualizarInputHidden();
}

function eliminarTag(e) {
    e.target.remove();

    tags = tags.filter(tag => tag !== e.target.textContent);

    actualizarInputHidden();
}

function actualizarInputHidden() {
    tagsInputHidden.value = tags.toString();
}
