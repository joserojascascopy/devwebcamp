if (document.querySelector('.mapa')) {
    var map = L.map('mapa').setView([-27.306304013629184, -55.88779856279675], 16);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    L.marker([-27.306304013629184, -55.88779856279675]).addTo(map)
        .bindPopup(`
            <h3 class="mapa__heading">DevWebCamp 2025</h3>
            <p class="mapa__texto">Universidad Nacional de Itapúa</p>
        `)
        .openPopup();
}