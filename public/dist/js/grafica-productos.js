$.ajax({
    url:'/datos-grafica/productos-categorias',
    type: 'GET',
    dataType: 'json',
    success: function (data) {
        const LienzoGraficaProductosCategoria = document.getElementById('graficaProductosCategoria');
        
        const dataProducto = data;
        let graficaLabel = [];
        let totalProducto = [];
        let colorPastel = []
        let colorBordePastel = [];

        dataProducto.forEach(producto => {
            let color1 = Math.floor(Math.random() * 54) + 1; 
            let color2 = Math.floor(Math.random() * 162) + 1;
            let color3 = Math.floor(Math.random() * 255) + 1;

            graficaLabel.push(producto.nombre);
            totalProducto.push(producto.total);
            colorPastel.push('rgba('+color1+', '+color2+', '+color3+', 0.2)');
            colorBordePastel.push('rgba('+color1+', '+color2+', '+color3+', 1)');
        });

        const graficaCapacitacion = {
            label: 'Productos por Categoria',
            data: totalProducto,
            backgroundColor: colorPastel,
            borderColor: colorBordePastel,
            borderWidth: 1,
        };

        new Chart(LienzoGraficaProductosCategoria, {
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