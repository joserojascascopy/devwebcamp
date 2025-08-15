(function () {
    const categoria = document.querySelector('[name="categoria_id"]');
    const dias = document.querySelectorAll('[name="dia"]');

    // Inputs ocultos (luego asignamos valores a estos inputs ocultos para mandar a la DB)
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
    const inputHiddenHora = document.querySelector('[name="hora_id"]');

    const horaSeleccionada = document.querySelector(`[data-hora-id="${inputHiddenHora.value}"]`); // Guardamos en una constante la hora seleccionada del evento a editar

    let busqueda = {
        categoria_id: +categoria.value || '',
        dia: +inputHiddenDia.value || ''
    }

    if (!Object.values(busqueda).includes('')) {
        (async () => {
            await buscarEventos();

            const id = inputHiddenHora.value;
            const horaAnterior = document.querySelector(`[data-hora-id="${id}"]`)

            horaAnterior.classList.remove('horas__hora--deshabilitada');
            horaAnterior.classList.add('horas__hora--seleccionada');

            horaAnterior.addEventListener('click', seleccionarHora);
        })();
    }

    dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
    categoria.addEventListener('change', terminoBusqueda);

    function terminoBusqueda(e) {
        busqueda[e.target.name] = +e.target.value;
        // Reiniciar los campos ocultos
        inputHiddenHora.value = '';
        inputHiddenDia.value = '';

        // Eliminar la hora anterior
        const seleccionAnterior = document.querySelector('.horas__hora--seleccionada');

        if (seleccionAnterior) {
            seleccionAnterior.classList.remove('horas__hora--seleccionada');
        }

        if (Object.values(busqueda).includes('')) {
            return;
        }

        buscarEventos();
    }

    async function buscarEventos() {
        const { dia, categoria_id } = busqueda;
        const url = `http://localhost:3000/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
        const res = await fetch(url);

        const eventos = await res.json();

        obtenerHorasDisponibles(eventos);
    }

    function obtenerHorasDisponibles(eventos) {
        const listadoHoras = document.querySelectorAll('#horas');

        listadoHoras.forEach(li => {
            // Quitar cualquier evento anterior (Al seleccionar otro día o una categoria diferente)
            // li.replaceWith(li.cloneNode(true));

            li.classList.add('horas__hora--deshabilitada');
            li.classList.remove('horas__hora--seleccionada');
            li.removeEventListener('click', seleccionarHora);
        });

        // // Volver a seleccionar después del replace
        // const listadoHorasActualizado = document.querySelectorAll('#horas');

        // // Deshabilitar todas las horas
        // listadoHorasActualizado.forEach(li => {
        //     li.classList.add('horas__hora--deshabilitada');
        // });

        const horasTomadas = eventos.map(evento => evento.hora_id);
        const listadoHorasArray = Array.from(listadoHoras);
        const horarioDisponible = listadoHorasArray.filter(listado => !horasTomadas.includes(listado.dataset.horaId));

        horarioDisponible.forEach(horaDisponible => horaDisponible.classList.remove('horas__hora--deshabilitada'))
        horarioDisponible.forEach(horaDisponible => horaDisponible.addEventListener('click', seleccionarHora));

        if (horaSeleccionada) {
            horaSeleccionada.classList.remove('horas__hora--deshabilitada');
            horaSeleccionada.onclick = seleccionarHora;
        }
    }

    function seleccionarHora(e) {
        const seleccionAnterior = document.querySelector('.horas__hora--seleccionada');

        if (seleccionAnterior) {
            seleccionAnterior.classList.remove('horas__hora--seleccionada');
        }

        // Añadir el id de la hora el input oculto
        inputHiddenHora.value = e.target.dataset.horaId;

        // Agregar clase de seleccionado
        e.target.classList.add('horas__hora--seleccionada');

        // Añadir el id del dia al input oculto
        inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
    }

})();