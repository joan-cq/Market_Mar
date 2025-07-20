function agregarAlCarrito(nombre, precio) {
  const producto = { nombre, precio, cantidad: 1 };
  let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

  const index = carrito.findIndex(p => p.nombre === nombre);
  if (index >= 0) {
    carrito[index].cantidad += 1;
  } else {
    carrito.push(producto);
  }

  localStorage.setItem("carrito", JSON.stringify(carrito));
  alert(`Se agregó ${nombre} al carrito.`);
}
