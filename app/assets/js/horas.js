(function(){
    let busqueda = {
        categoria_id: '',
        dia: ''
    }

    const categoria = document.querySelector('[name="categoria_id"]');
    const horas = document.querySelectorAll('#horas');
    const dias = document.querySelectorAll('[name="dia"]');
    const inputHiddenDia = document.querySelector('[name="dia_id"]');
        

    dias.forEach(dia => dia.addEventListener('change', terminoBusqueda));
    categoria.addEventListener('change', terminoBusqueda);

    function terminoBusqueda(e) {
        busqueda[e.target.name] = e.target.value;
    }

})();