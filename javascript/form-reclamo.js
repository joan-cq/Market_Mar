document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("form-reclamaciones");
  const confirmarBtn = document.getElementById("confirmar-envio");
  const cancelarBtn = document.getElementById("cancelar-envio");
  const modal = new bootstrap.Modal(document.getElementById("confirmacionModal"));

  let formularioValido = false; // bandera para saber si puede enviar

  const campos = form.querySelectorAll("input, select, textarea");

  // 🔄 Agrega listeners a cada campo para quitar "is-invalid" cuando se corrijan
  campos.forEach((campo) => {
    campo.addEventListener("input", () => {
      if (campo.value.trim() !== "") {
        campo.classList.remove("is-invalid");
      }
    });

    campo.addEventListener("change", () => {
      if (campo.value.trim() !== "") {
        campo.classList.remove("is-invalid");
      }
    });
  });

  // 🧪 Validación al enviar
  form.addEventListener("submit", function (event) {
    event.preventDefault(); // detiene el envío

    let camposVacios = false;

    campos.forEach((campo) => {
      if (!campo.value.trim()) {
        campo.classList.add("is-invalid");
        camposVacios = true;
      }
    });

    if (camposVacios) {
      alert("Por favor, complete todos los campos antes de enviar.");
      return;
    }

    // ✅ Mostrar modal de confirmación si todo está bien
    formularioValido = true;
    modal.show();
  });

  // ✅ Enviar después del modal
  confirmarBtn.addEventListener("click", function () {
    if (formularioValido) {
      form.submit();
    }
  });

  // ❌ Cancelar envío
  cancelarBtn.addEventListener("click", function () {
    modal.hide();
  });
});
