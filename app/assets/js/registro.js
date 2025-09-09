import Swal from 'sweetalert2';

(function () {
    let eventos = [];
    const resumen = document.querySelector('#registro-resumen');

    if (!resumen) return;

    const eventosBoton = document.querySelectorAll('.evento__agregar');

    eventosBoton.forEach(boton => {
        boton.addEventListener('click', seleccionarEvento);
    })

    const formularioRegistro = document.querySelector('#registro');

    formularioRegistro.addEventListener('submit', submitFormulario);

    mostrarEventos();

    function seleccionarEvento({ target }) {
        if (eventos.length < 5) {
            // Deshabilitar el evento una vez seleccionado
            target.disabled = true;

            eventos = [...eventos, {
                id: target.dataset.id,
                titulo: target.parentElement.querySelector('.evento__nombre').textContent.trim()
            }];
        } else {
            Swal.fire({
                title: 'Error',
                text: 'Máximo 5 eventos por registro',
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }

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
        } else {
            const noRegistro = document.createElement('P');
            noRegistro.textContent = 'No hay eventos, añade hasta 5';
            noRegistro.classList.add('registro__texto');

            resumen.appendChild(noRegistro);
        }
    }

    function eliminarEvento(id) {
        eventos = eventos.filter(e => e.id !== id);

        mostrarEventos();

        // Volver a habilitar el boton
        const botonAgregar = document.querySelector(`[data-id="${id}"]`);
        botonAgregar.disabled = false;
    }

    async function submitFormulario(e) {
        e.preventDefault();

        // Obtener el regalo
        const regaloId = document.querySelector('#regalo').value;

        const eventosId = eventos.map(evento => evento.id);

        if(eventosId.length === 0 || regaloId === '') {
            Swal.fire({
                title: 'Error',
                text: 'Elige al menos 1 evento y un regalo',
                icon: 'error',
                confirmButtonText: 'Ok'
            });

            return;
        }

        const datos = new FormData();
        datos.append('eventos_id', eventosId);
        datos.append('regalo_id', regaloId);

        const url = 'http://localhost:3000/finalizar-registro/conferencias';
        const res = await fetch(url, {
            method: 'POST',
            body: datos
        })

        const body = await res.json();
    }

})();