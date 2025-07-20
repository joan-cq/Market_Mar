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
    if (!confirmacion) return;

    // Enviar por fetch
    fetch("php/guardar_sugerencias.php", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `nombre=${encodeURIComponent(nombre)}&mail=${encodeURIComponent(mail)}&sugerencia=${encodeURIComponent(sugerencia)}`,
    })
      .then((res) => res.json())
      .then((data) => {
        if (data.success) {
          alert("¡Gracias por tu sugerencia!");
          form.reset();
        } else {
          alert("Error: " + data.error);
        }
      })
      .catch((err) => {
        console.error(err);
        alert("Error al enviar la sugerencia.");
      });
  });
});
