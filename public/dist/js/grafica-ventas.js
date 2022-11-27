$.ajax({
    url:'/datos-grafica/ventas-clientes',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        const LienzoGraficaVentasCliente = document.getElementById('graficaVentasCliente');
        
        const dataVenta = data;
        let graficaLabel = [];
        let totalVenta = [];
        let colorPastel = []
        let colorBordePastel = [];

        dataVenta.forEach(venta => {
            let color1 = Math.floor(Math.random() * 54) + 1; 
            let color2 = Math.floor(Math.random() * 162) + 1;
            let color3 = Math.floor(Math.random() * 255) + 1;

            graficaLabel.push(venta.nombres);
            totalVenta.push(venta.total);
            colorPastel.push('rgba('+color1+', '+color2+', '+color3+', 0.2)');
            colorBordePastel.push('rgba('+color1+', '+color2+', '+color3+', 1)');
        });

        const graficaCapacitacion = {
            label: 'Ventas por cliente',
            data: totalVenta,
            backgroundColor: colorPastel,
            borderColor: colorBordePastel,
            borderWidth: 1,
        };

        new Chart(LienzoGraficaVentasCliente, {
            type: 'doughnut',// Tipo de gráfica
            data: {
                labels: graficaLabel,
                datasets: [
                    graficaCapacitacion,
                ]
            },
            options: {
                scales: {
                    y: {
                        display: false,
                    },
                    x:{
                        display: false,
                    },
                },
            }
        });
    },
    error:function() {
        console.log('Error al recibir los datos')
    }
});