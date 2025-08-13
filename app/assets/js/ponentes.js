(function () {
    const ponentesInput = document.querySelector('#ponentes');
    const listadoPonentes = document.querySelector('#listado-ponentes');
    const inputHiddenPonente = document.querySelector('[name="ponente_id"]');

    let ponentes = [];
    let ponentesFiltrados = [];

    obtenerPonentes();

    ponentesInput.addEventListener('input', filtrarPonentes);

    async function obtenerPonentes() {
        const url = 'http://localhost:3000/api/ponentes';
        const res = await fetch(url);

        body = await res.json();

        formatearPonentes(body);
    }

    function formatearPonentes(arrayPonentes) {
        ponentes = arrayPonentes.map(ponente => {
            return {
                id: `${ponente.id}`,
                nombre: `${ponente.nombre.trim()} ${ponente.apellido.trim()}`
            }
        });
    }

    function filtrarPonentes(e) {
        ponentesFiltrados = [];

        const busqueda = e.target.value.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase();

        if (busqueda.length > 3) {
            ponentesFiltrados = ponentes.filter(ponente => ponente.nombre.normalize("NFD").replace(/[\u0300-\u036f]/g, "").toLowerCase().includes(busqueda));
        }

        mostrarPonentes();
    }

    function mostrarPonentes() {
        while (listadoPonentes.firstChild) {
            listadoPonentes.removeChild(listadoPonentes.firstChild);
        }

        if (ponentesFiltrados.length > 0) {
            ponentesFiltrados.forEach(ponente => {
                const ponenteHtml = document.createElement('LI');
                ponenteHtml.classList.add('listado-ponentes__ponente');
                ponenteHtml.textContent = ponente.nombre;
                ponenteHtml.dataset.ponenteId = ponente.id;
                ponenteHtml.onclick = seleccionarPonente;

                // Añadir al DOM
                listadoPonentes.appendChild(ponenteHtml);
            });
        } else {
            const noResultados = document.createElement('P');
            noResultados.classList.add('listado-ponentes__no-resultado');
            noResultados.textContent = 'No hay resultados para tu busqueda';

            listadoPonentes.appendChild(noResultados);
        }
    };

    function seleccionarPonente(e) {
        const ponente = e.target;

        const ponenteAnterior = document.querySelector('.listado-ponentes__ponente--seleccionado');

        if (ponenteAnterior) {
            ponenteAnterior.classList.remove('listado-ponentes__ponente--seleccionado');
        }

        ponente.classList.add('listado-ponentes__ponente--seleccionado');

        inputHiddenPonente.value = ponente.dataset.ponenteId;
    }

})();

// function filtrarPonentes(e) {
//     ponentesFiltrados = ponentes.filter(ponente => ponente.nombre.toLowerCase().includes(e.target.value));

//     ponentes.forEach(ponente => {
//         if (ponente.nombre.toLowerCase().includes(e.target.value) || ponente.apellido.toLowerCase().includes(e.target.value)) {
//             ponentesFiltrados = [...ponentesFiltrados, ponente.nombre + ' ' + ponente.apellido];
//         }
//     })

//     console.log(ponentesFiltrados);
// }