let rows = 0; //nuemro de filas
//botones
const btnAgregar = document.querySelector('#agregar');
const btnGuardar = document.querySelector('#btn-guardar');

//entradas
const selectProducto = document.querySelector('#producto');
const inputCantidad = document.querySelector('#cantidad');
const inputPrecioCompra = document.querySelector('#precio_compra');
const inputPrecioVenta = document.querySelector('#precio_venta');
//contenedores
const contentCompras = document.querySelector('#detalle-compra');
const contentSubtotal = document.querySelector('#detalle-subtotal');
const templeteCompras = document.querySelector('#template-detalle-compra');
const templeteSubtotal = document.querySelector('#template-detalle-subtotal');
const fragment = document.createDocumentFragment(); //fragmento

let listaCompras = [];

//eventos
btnAgregar.addEventListener('click', (e) => {
    agregarCompra();
})

//evento remover compra
const agregarEventoRemoverCompra = () => {
    const btnEditar = document.querySelectorAll('.btn-remove');

    btnEditar.forEach(button => {
        button.addEventListener('click', (e) => {
            let idFila = button.dataset.id;
            removerCompra(idFila);
            mostrarListaCompra();
        })
    });
}

//agragar compra a objeto
const agregarCompra = () =>{
    let getIdProducto = parseInt(selectProducto.value);
    let getNombreProducto = selectProducto.options[selectProducto.selectedIndex].text;
    let getCantidad = parseInt(inputCantidad.value);
    let getPrecioCompra = parseFloat(inputPrecioCompra.value);
    let getPrecioVenta =  parseFloat(inputPrecioVenta.value);

    if (!isNaN(getCantidad) && !isNaN(getPrecioVenta) && !isNaN(getPrecioCompra)) {
        rows++;
        const compra = {
            id: rows,
            idProducto: getIdProducto,
            nombreProducto: getNombreProducto,
            cantidad: getCantidad,
            precioCompra: getPrecioCompra,
            precioVenta: getPrecioVenta
        };

        listaCompras.push(compra);
        clearInput();
        mostrarListaCompra();
    }else {
        alert("Completa las entradas")
    }
}

//mostrar listado de compras en filas de una tabla
const mostrarListaCompra = () =>{
    //limpiar la lista de compras
    contentCompras.textContent = "";

    //agregar a campos
    listaCompras.forEach(item => {
        const clone = templeteCompras.content.cloneNode(true)
        clone.querySelector(".btn-remove").dataset.id = item.id;
        clone.querySelector(".detalle-producto-id").value = item.idProducto;
        clone.querySelector(".detalle-producto-nombre").value = item.nombreProducto;
        clone.querySelector(".detalle-cantidad").value = item.cantidad;
        clone.querySelector(".detalle-precio-compra").value = item.precioCompra;
        clone.querySelector(".detalle-precio-venta").value = item.precioVenta;
        fragment.appendChild(clone);
    })

    contentCompras.appendChild(fragment);
    agregarEventoRemoverCompra();
    enabledButtonGuardar();
    mostrarSubtotal();
}

//calcular subtotales
const mostrarSubtotal = () => {
    contentSubtotal.textContent = "";
    if (listaCompras.length > 0) {
        let subtotal = 0;
        //contamos las tareas pendientes
        listaCompras.forEach    (item => {
            subtotal += (item.precioCompra * item.cantidad);
        });

        const clone = templeteSubtotal.content.cloneNode(true);

        clone.querySelector("#subtotal").textContent = subtotal.toFixed(2);
        fragment.appendChild(clone);
        contentSubtotal.appendChild(fragment);
    }
}

//remover compra
const removerCompra = (id) => {
    listaCompras = listaCompras.filter(item => item.id !== parseInt(id));
}

//limpiar entradas
const clearInput = () => {
    inputCantidad.value = '';
    inputPrecioVenta.value = '';
    inputPrecioCompra.value = '';
}

//habilitar o deshabilitar boton guardar
const enabledButtonGuardar = () => {
    if (listaCompras.length > 0) {
        btnGuardar.disabled = false;
    }else {
        btnGuardar.disabled = true;
    }
}