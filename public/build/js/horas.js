(function(){
    const categoria = document.querySelector('[name="categoria_id"]');
    const dias = document.querySelectorAll('[name="dia"]');
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
    const inputHiddenHora = document.querySelector('[name="hora_id"]');

    let busqueda = {
        categoria_id: +categoria.value || '',
        dia: ''
    }

    dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
    categoria.addEventListener('change', terminoBusqueda);

    function terminoBusqueda(e) {
        busqueda[e.target.name] = e.target.value;
        // Reiniciar los campos ocultos
        inputHiddenHora.value = '';
        inputHiddenDia.value = '';

        // Deshabilitar los campos ocultos
        const seleccionAnterior = document.querySelector('.horas__hora--seleccionada');

        if(seleccionAnterior) {
            seleccionAnterior.classList.remove('horas__hora--seleccionada');
        }

        if(Object.values(busqueda).includes('')) {
            return;
        }

        buscarEventos();
    }

    async function buscarEventos() {
        const {dia, categoria_id} = busqueda;

        const url = `http://localhost:3000/api/eventos-horario?dia_id=${dia}&categoria_id=${categoria_id}`;
        const res = await fetch(url);
        
        const eventos = await res.json();

        obtenerHorasDisponibles(eventos);
    }

    function obtenerHorasDisponibles(eventos) {
        const listadoHoras = document.querySelectorAll('#horas');
        //Reiniciar las horas
        listadoHoras.forEach(li => {
            li.classList.add('horas__hora--deshabilitada');
        })

        const horasTomadas = eventos.map(evento => evento.hora_id);
        
        const listadoHorasArray = Array.from(listadoHoras);
        
        const horarioDisponible = listadoHorasArray.filter(listado => !horasTomadas.includes(listado.dataset.horaId));
        horarioDisponible.forEach(horaDisponible => horaDisponible.classList.remove('horas__hora--deshabilitada'))
        
        horarioDisponible.forEach(horaDisponible => horaDisponible.addEventListener('click', seleccionarHora));
    
    }

    function seleccionarHora(e) {
        const seleccionAnterior = document.querySelector('.horas__hora--seleccionada');

        if(seleccionAnterior) {
            seleccionAnterior.classList.remove('horas__hora--seleccionada');
        }
        
        inputHiddenHora.value = e.target.dataset.horaId;

        // Agregar clase de seleccionado
        e.target.classList.add('horas__hora--seleccionada');

        // Añadir el id del dia al input oculto
        inputHiddenDia.value = document.querySelector('[name="dia"]:checked').value;
    }

})();