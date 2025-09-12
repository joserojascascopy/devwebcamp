const { plugin } = require("postcss");

(function () {
    const ctx = document.getElementById('myChart');

    obtenerRegalos();

    async function obtenerRegalos() {
        const url = '/api/regalos';
        const res = await fetch(url);
        const body = await res.json();

        const labels = body.map(regalo => regalo.nombre);

        const data = {
            labels: labels,
            datasets: [{
                label: '',
                data: body.map(regalo => regalo.total[0]),
                backgroundColor: [
                    '#ea580c',
                    '#84cc16',
                    '#22d3ee',
                    '#a855f7',
                    '#ef4444',
                    '#14b8a6',
                    '#db2777',
                    '#e11d48',
                    '#7e22ce'
                ]
            }]
        };

        const config = {
            type: 'bar',
            data: data,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                },
                plugins: {
                    legend: {
                        display: false,
                    }
                }
            },
        };

        if (ctx) {
            new Chart(ctx, config);
        }
    }

})();