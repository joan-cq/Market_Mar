document.addEventListener('DOMContentLoaded', function () {
    const cartBody = document.getElementById('cart-body');

    if (cartBody) {
        cartBody.addEventListener('click', function (e) {
            const target = e.target;
            const productId = target.closest('tr').dataset.id;

            if (target.classList.contains('btn-increment')) {
                updateQuantity(productId, 1);
            } else if (target.classList.contains('btn-decrement')) {
                updateQuantity(productId, -1);
            } else if (target.classList.contains('btn-delete')) {
                deleteFromCart(productId);
            }
        });
    }
});

function updateQuantity(productId, change) {
    const formData = new FormData();
    formData.append('producto_id', productId);
    formData.append('change', change);

    fetch('php/actualizar_cantidad.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            updateCartUI(productId, data.newQuantity, data.newSubtotal, data.newTotal);
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

function deleteFromCart(productId) {
    if (!confirm('¿Estás seguro de que quieres eliminar este producto del carrito?')) {
        return;
    }

    const formData = new FormData();
    formData.append('producto_id', productId);

    fetch('php/eliminar_del_carrito.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const row = document.querySelector(`tr[data-id='${productId}']`);
            if (row) {
                row.remove();
            }
            updateCartUI(null, null, null, data.newTotal);
            if (document.querySelectorAll('#cart-body tr').length === 1 && document.querySelector('#cart-body tr td[colspan="5"]')) {
                 // No hacer nada, el mensaje de carrito vacío ya está
            } else if (document.querySelectorAll('#cart-body tr').length === 0) {
                const cartBody = document.getElementById('cart-body');
                cartBody.innerHTML = '<tr><td colspan="5" class="text-center">Tu carrito está vacío.</td></tr>';
            }
        } else {
            alert('Error: ' + data.error);
        }
    })
    .catch(error => console.error('Error:', error));
}

function updateCartUI(productId, newQuantity, newSubtotal, newTotal) {
    if (productId && newQuantity > 0) {
        const row = document.querySelector(`tr[data-id='${productId}']`);
        if (row) {
            row.querySelector('.quantity-input').value = newQuantity;
            row.querySelector('.subtotal').textContent = `S/ ${parseFloat(newSubtotal).toFixed(2)}`;
        }
    } else if (productId) {
        const row = document.querySelector(`tr[data-id='${productId}']`);
        if (row) {
            row.remove();
        }
    }
    
    document.getElementById('cart-total').textContent = `Total: S/ ${parseFloat(newTotal).toFixed(2)}`;

    const cartBody = document.getElementById('cart-body');
    if (cartBody.getElementsByTagName('tr').length === 0) {
        cartBody.innerHTML = '<tr><td colspan="5" class="text-center">Tu carrito está vacío.</td></tr>';
    }
}


function agregarAlCarrito(productoId, nombre, precio) {
  if (!IS_LOGGED_IN) {
    alert("Por favor, inicie sesión para agregar productos al carrito.");
    window.location.href = 'cuenta.php';
    return;
  }

  const formData = new FormData();
  formData.append('producto_id', productoId);

  fetch('php/agregar_al_carrito.php', {
    method: 'POST',
    body: formData
  })
  .then(response => response.json())
  .then(data => {
    if (data.success) {
      alert(`Se agregó ${nombre} al carrito.`);
      // Opcional: actualizar un contador de carrito en la UI
    } else {
      alert('Error al agregar el producto: ' + data.error);
    }
  })
  .catch(error => {
    console.error('Error:', error);
    alert('Hubo un problema de conexión.');
  });
}
