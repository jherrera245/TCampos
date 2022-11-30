let rows = 0; //numero de filas
//botones
const btnAgregar = document.querySelector('#agregar');
const btnGuardar = document.querySelector('#btn-guardar');

//entradas
const selectProducto = document.querySelector('#idproducto');

const inputCantidad = document.querySelector('#cantidad');

const inputPrecioCompra = document.querySelector('#precio_compra');
const inputPrecioVenta = document.querySelector('#precio_venta');
const inputDescuento = document.querySelector('#descuento');
const inputStock = document.querySelector('#stock');
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
});

$('#cantidad').each(() => {
    $(this).on('change', (e) => {
        changenValue(e.target)
    })

    $(this).on('keyup', (e) => {
        changenValue(e.target)
    })
});

const changenValue = (input) => {
    let value = parseInt(input.value)
    let max = parseInt(input.max)
    let min = parseInt(input.min)

    if (value > max) {
        input.value = max
    }else if (value < min) {
        input.value = min
    }
} 


function mostrarDatos(){
    //console.log("Hola mundo");

    datosProductos=document.getElementById('idproducto').value.split('_');
    
    if (listaCompras.length > 0) {
        let quitar = 0;

        listaCompras.forEach(compra=> {
            if (parseInt(compra.idProducto) === parseInt(compra.id)) {
                quitar += compra.cantidad;
            }
        });

        let stock = (datosProductos[1] > quitar) ? datosProductos[1] - quitar : 0;

        $('#stock').val(stock);
        $('#cantidad').attr('max', stock);
    }else {
        $('#stock').val(datosProductos[1]);
        $('#cantidad').attr('max', datosProductos[1]);
        $('#precio_venta').val(datosProductos[2]);
    }
} 

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

function restarStock() {
    let total=0;
    let ingreso1 = document.getElementById("cantidad");
    let ingreso2 = document.getElementById("stock");

    total=parseInt(ingreso2.value || 0)-parseInt(ingreso1.value || 0);
    console.log(total);
    document.getElementById("stock").value = total;
}

//agregamos compra a objeto
const agregarCompra = () =>{
    datosProductos=document.getElementById('idproducto').value.split('_');
    let getIdProducto = datosProductos[0];
    let getNombreProducto = selectProducto.options[selectProducto.selectedIndex].text;
    let getCantidad = parseInt(inputCantidad.value);
    let getDescuento = parseFloat(inputDescuento.value);
    let getPrecioVenta =  parseFloat(inputPrecioVenta.value);
    let getStock = parseInt(inputStock.value);
    var total=0;

    if (!isNaN(getCantidad) && !isNaN(getPrecioVenta) && !isNaN(getDescuento)) {
        if(getStock>=getCantidad){
            rows++;
        const compra = {
            id: rows,
            idProducto: getIdProducto,
            nombreProducto: getNombreProducto,
            cantidad: getCantidad,
            descuento: getDescuento,
            precioVenta: getPrecioVenta
        };

        listaCompras.push(compra);
        restarStock();
        clearInput();
        mostrarListaCompra();

        }else{
            alert("La cantidad a vender supera el stock")
        }
        
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
        clone.querySelector(".detalle-precio-venta").value = item.precioVenta;
        clone.querySelector(".detalle-descuento").value = item.descuento;
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
            subtotal += (item.precioVenta * item.cantidad-item.descuento);
        });
        $("#total").val(subtotal);
        console.log(subtotal);

        const clone = templeteSubtotal.content.cloneNode(true);

        clone.querySelector("#total_venta").textContent = subtotal.toFixed(2);

        clone.querySelector("#total").value = subtotal.toFixed(2);
        
        
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
    inputDescuento.value = '';
    
}

//habilitar o deshabilitar boton guardar
const enabledButtonGuardar = () => {
    if (listaCompras.length > 0) {
        btnGuardar.disabled = false;
    }else {
        btnGuardar.disabled = true;
    }
}