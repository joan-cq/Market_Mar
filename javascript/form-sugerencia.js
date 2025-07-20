document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-sugerencias");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    const nombre = form.nombre.value.trim();
    const mail = form.mail.value.trim();
    const sugerencia = form.sugerencia.value.trim();

    if (!nombre || !mail || !sugerencia) {
      alert("Por favor, complete todos los campos.");
      return;
    }

    const confirmacion = confirm("¿Seguro que deseas enviar esta sugerencia?");
    if (confirmacion) {
      alert("¡Gracias por tu sugerencia!");
      form.submit(); // solo si tienes backend, si no puedes omitir esto
    }
  });
});
