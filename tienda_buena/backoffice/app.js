const myModalAlternative = new bootstrap.Modal("#exampleModal");
function pintarProducto(producto) {
  var html = "";
  const contenedor_producto = document.getElementById("resultado");
  let div_producto = document.createElement("div");
  div_producto.classList.add("card", "m-4");
  div_producto.style.width = "18rem";

  // let div_img = document.createElement("div");
  // let img = document.createElement("img");
  // img.setAttribute("src", producto.imagen);
  // div_img.appendChild(img);
  html = `
              <img src="${producto.imagen}" class="card-img-top" alt="imagen">
                <div class="card-body">
                  <h5 class="card-title"><b>ID:</b> ${producto.id}</h5>
                  <p class="card-text"><b>Nombre:</b> ${producto.nombre}</p>
                  <p class="card-text"><b>Descripcion:</b> ${producto.descripcion}</p>
                  <p class="card-text"><b>Precio:</b> ${producto.precio}€</p>           
                  <p class="card-text"><b>Categoria:</b> ${producto.nombre_categoria}</p>
                  <p class="card-text"><b>Stock:</b> ${producto.stock}</p>
                </div>
              `;

  div_producto.innerHTML = html;
  // div_producto.appendChild(div_img);

  div_botones = document.createElement("div");
  div_botones.classList.add(
    "d-grid",
    "gap-2",
    "d-md-flex",
    "justify-content-md-end"
  );

  //Creamos el boton de eliminar
  let btn_eliminar = document.createElement("button");
  btn_eliminar.textContent = "Eliminar";
  btn_eliminar.id = producto.id;
  btn_eliminar.classList.add("btn", "btn-danger");
  div_producto.appendChild(div_botones);
  div_botones.appendChild(btn_eliminar);

  //Cuando hacemos click en el boton de eliminar
  btn_eliminar.addEventListener("click", (event) => {
    //Funcion de eliminar producto
    event.preventDefault();
    let btn_e = event.target;

    Swal.fire({
      title: "Eliminar producto",
      text: "¿Deseas eliminar este producto?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si,deseo eliminar el producto",
    }).then((result) => {
      if (result.isConfirmed) {
        eliminarProducto(btn_e.id);
        contenedor_producto.removeChild(div_producto);
        Swal.fire({
          title: "Eliminado!",
          text: "Producto eliminado con exito",
          icon: "success",
        });
      }
    });
  });

  let btn_editar = document.createElement("button");
  btn_editar.textContent = "Editar";
  btn_editar.id = producto.id;
  btn_editar.classList.add("btn", "btn-warning");
  div_producto.appendChild(div_botones);
  div_botones.appendChild(btn_editar);

  //Cuando hacemos click en el boton de editar
  btn_editar.addEventListener("click", (event) => {
    event.preventDefault();
    let btn = event.target;
    alert(btn.id);

    btn_editar_producto.className = "btn btn-primary d-block";
    btn_agregar.className = "d-none";
    //Funcion de editar producto
    cargarProductoEditar(btn.id);
  });

  //   document.getElementById("btn_cancelar").addEventListener("click", () => {
  //     let contenedor1 = document.getElementById("container1");
  //     let contenedor2 = document.getElementById("container2");
  //     contenedor1.style.display = "block";
  //     contenedor2.style.display = "none";
  //   });

  contenedor_producto.appendChild(div_producto);
}

function pintarProductos(productos) {
  productos.forEach((producto) => {
    pintarProducto(producto);
  });
}

const resultado = document.getElementById("resultado");
const input_id = document.getElementById("buscar_id");
const btn_id = document.getElementById("btn_buscar");
const selet = document.getElementById("categoria");
const btn_precio = document.getElementById("btn_precio");
const input_min = document.getElementById("min");
const input_max = document.getElementById("max");
const input_palabra = document.getElementById("clave");
const btn_palabra = document.getElementById("btn_clave");
const btn_crear = document.getElementById("btn_crear");
// CREAR PRODUCTOS
const id_input = document.getElementById("id_oculto");
const nombre_input = document.getElementById("nombre");
const descripcion_input = document.getElementById("descripcion");
const imagen_input = document.getElementById("imagen");
const precio_input = document.getElementById("precio");
const categoria_input = document.getElementById("categoria_form");
const stock_input = document.getElementById("stock");
const btn_agregar = document.getElementById("btn_agregar");
const btn_editar_producto = document.getElementById("btn_editar_producto");

btn_crear.addEventListener("click", () => {
  btn_editar_producto.className = "btn btn-primary d-none";
  btn_agregar.className = "btn btn-primary d-block";
  nombre_input.value = "";
  descripcion_input.value = "";
  imagen_input.value = "";
  precio_input.value = "";
  categoria_input.value = "";
  stock_input.value = "";
});

function cargarProducto() {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos")
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      pintarProductos(data);
    });
}
cargarProducto();

// OBTENER PRODUCTOS POR ID
function obtenerProductosId(id) {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos/" + id)
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      resultado.innerHTML = "";
      pintarProducto(data);
    });
}

btn_id.addEventListener("click", (event) => {
  event.preventDefault();
  obtenerProductosId(input_id.value);
});

// CARGAR SELECT
function cargarCombo() {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/categorias")
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      //SELECT PRINCIPAL
      selet.innerHTML = "";
      let opcion = document.createElement("option");

      //SELECT FORMULARIO
      categoria_input.innerHTML = "";
      let opcion_formulario = document.createElement("option");

      opcion.textContent = "Nueva Categoria";
      opcion.value = 0;
      selet.appendChild(opcion);

      opcion_formulario.textContent = "Nueva Categoria";
      opcion_formulario.value = 0;
      categoria_input.appendChild(opcion_formulario);

      data.forEach((categoria) => {
        let opcion = document.createElement("option");
        let opcion_formulario = document.createElement("option");

        opcion.textContent = categoria.nombre;
        opcion.value = categoria.id;
        selet.appendChild(opcion);

        opcion_formulario.textContent = categoria.nombre;
        opcion_formulario.value = categoria.id;
        categoria_input.appendChild(opcion_formulario);
      });
    });
}

cargarCombo();

// OBTENER PRODUCTOS POR CATEGORIA
function obtenerPorCategoria(categoria_id) {
  fetch(
    "http://10.10.13.50/tienda/public/api/v1/api.php/productos?categoria_id=" +
      categoria_id
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      resultado.innerHTML = "";
      pintarProductos(data);
    });
}

selet.addEventListener("change", () => {
  obtenerPorCategoria(selet.value);
});

// OBTENER PRODUCTOS POR RANGO DE PRECIOS
function obtenerProductosPrecio(min, max) {
  fetch(
    "http://10.10.13.50/tienda/public/api/v1/api.php//productos?precio_min=" +
      min +
      "&precio_max=" +
      max
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      resultado.innerHTML = "";
      pintarProductos(data);
    });
}

btn_precio.addEventListener("click", (event) => {
  event.preventDefault();
  obtenerProductosPrecio(input_min.value, input_max.value);
});

// OBTENER PRODUCTOS POR DESCRIPCION
function obtenerProductosDescripcion(texto) {
  fetch(
    "http://10.10.13.50/tienda/public/api/v1/api.php/productos?busqueda=" +
      texto
  )
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      resultado.innerHTML = "";
      pintarProductos(data);
    });
}

btn_palabra.addEventListener("click", (event) => {
  event.preventDefault();
  obtenerProductosDescripcion(input_palabra.value);
});

function crearProductos(json_producto) {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos", {
    method: "post",
    body: JSON.stringify(json_producto),
  })
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Datos de creacion erroneos");
        }
        throw new Error("Error en la respuesta");
      }

      return response.json();
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Ha habido un problema, no se ha creado el producto!",
        color: "white",
        background: "#333",
      });
    });
}

btn_agregar.addEventListener("click", (event) => {
  event.preventDefault();
  producto = {
    nombre: nombre_input.value,
    descripcion: descripcion_input.value,
    imagen: imagen_input.value,
    precio: precio_input.value,
    categoria_id: categoria_input.value,
    stock: stock_input.value,
  };

  crearProductos(producto);
});

btn_editar_producto.addEventListener("click", (event) => {
  event.preventDefault();
  editarProducto(id_input.value);
});

function cargarProductoEditar(id) {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos/" + id)
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Categorias no encontradas");
        }
        throw new Error("Error respuesta");
      }
      return response.json();
    })
    .then((data) => {
      id_input.value = data.id;
      nombre_input.value = data.nombre;
      descripcion_input.value = data.descripcion;
      imagen_input.value = data.imagen;
      precio_input.value = data.precio;
      categoria_input.value = data.categoria_id;
      stock_input.value = data.stock;
      myModalAlternative.show();
    });
}

function editarProducto(id) {
  alert(id_input.value);
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos/" + id, {
    method: "put",
    body: JSON.stringify({
      nombre: nombre_input.value,
      descripcion: descripcion_input.value,
      imagen: imagen_input.value,
      precio: precio_input.value,
      categoria_id: categoria_input.value,
      stock: stock_input.value,
      id: id_input.value,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Datos de actualización erroneos");
        }
        throw new Error("Error en la respuesta");
      }

      return response.json();
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Ha habido un problema, no se ha actualizado el producto!",
        color: "white",
        background: "#333",
      });
    });
}

function eliminarProducto(id) {
  fetch("http://10.10.13.50/tienda/public/api/v1/api.php/productos/" + id, {
    method: "delete",
    body: JSON.stringify({
      nombre: nombre_input.value,
      descripcion: descripcion_input.value,
      imagen: imagen_input.value,
      precio: precio_input.value,
      categoria_id: categoria_input.value,
      stock: stock_input.value,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        if (response.status == 404) {
          console.log("Datos de eliminacion erroneos");
        }
        throw new Error("Error en la respuesta");
      }

      return response.json();
    })
    .catch((error) => {
      Swal.fire({
        icon: "error",
        title: "Oops...",
        text: "Ha habido un problema, no se ha eliminado el producto!",
        color: "white",
        background: "#333",
      });
    });
}
