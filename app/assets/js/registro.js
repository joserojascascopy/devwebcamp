(function () {
    let eventos = [];
    const eventosBoton = document.querySelectorAll('.evento__agregar');
    const resumen = document.querySelector('#registro-resumen');

    eventosBoton.forEach(boton => {
        boton.addEventListener('click', seleccionarEvento);
    })

    function seleccionarEvento({ target }) {
        // Deshabilitar el evento una vez seleccionado
        target.disabled = true;

        eventos = [...eventos, {
            id: target.dataset.id,
            titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
        }];

        mostrarEventos();
    }

    function mostrarEventos() {
        // Limpiar la selección anterior
        while (resumen.firstChild) {
            resumen.removeChild(resumen.firstChild);
        }

        if (eventos.length > 0) {
            eventos.forEach(evento => {
                const eventoDom = document.createElement('DIV');
                eventoDom.classList.add('registro__evento');

                const titulo = document.createElement('H3');
                titulo.classList.add('registro__nombre');
                titulo.textContent = evento.titulo;

                const botonEliminar = document.createElement('BUTTON');
                botonEliminar.classList.add('registro__eliminar');
                botonEliminar.innerHTML = `<i class="fa-solid fa-trash"></i>`;
                botonEliminar.onclick = function () {
                    eliminarEvento(evento.id);
                }

                // Renderizar en el html
                eventoDom.appendChild(titulo);
                eventoDom.appendChild(botonEliminar);
                resumen.appendChild(eventoDom);
            })
        }
    }

    function eliminarEvento(id) {
        eventos = eventos.filter(e => e.id !== id);

        mostrarEventos();

        // Volver a habilitar el boton
        const botonEliminar = document.querySelector(`[data-id="${id}"]`);
        botonEliminar.disabled = false;
    }

})();