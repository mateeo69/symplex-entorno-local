// Función para mostrar errores en un modal
function showErrorModal(message) {
  const errorModalBody = document.getElementById('errorModalBody');
  if (errorModalBody) {
    errorModalBody.textContent = message;
    const errorModal = new bootstrap.Modal(document.getElementById('errorModal'));
    errorModal.show();
  } else {
    // Fallback a alert si el modal no está disponible
    alert(message);
  }
}
console.log("hotelview.js cargado");
document.addEventListener("DOMContentLoaded", function () {
  // Desplazamiento suave al formulario si existe
  const formSection = document.getElementById('hotelContactFormMessage');
  if (formSection) {
    formSection.scrollIntoView({ behavior: 'smooth' });
  }
  
  // Formulario de contacto para hoteles
  const hotelContactForm = document.getElementById("hotelContactForm");
  
  if (hotelContactForm) {
    hotelContactForm.addEventListener("submit", function (e) {
      e.preventDefault();
      
      // Obtener los campos del formulario
      let accNameInput = document.getElementById("acc_name");
      let accAddressInput = document.getElementById("acc_address");
      let accTypeInput = document.getElementById("acc_type");
      let accCityInput = document.getElementById("acc_city");
      let userNameInput = document.getElementById("user_name");
      let userPhoneInput = document.getElementById("user_phone");
      let userEmailInput = document.getElementById("user_email");
      
      // Obtener los valores
      let accName = accNameInput.value.trim();
      let accAddress = accAddressInput.value.trim();
      let accType = accTypeInput.value;
      let accCity = accCityInput.value;
      let userName = userNameInput.value.trim();
      let userPhone = userPhoneInput.value.trim();
      let userEmail = userEmailInput.value.trim();
      
      // Expresiones regulares para validación
      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      let phoneRegex = /^[0-9]{9}$/; // 9 dígitos para teléfono español
      let textRegex = /^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/; // Letras, espacios y acentos
      
      // Validar nombre del alojamiento
      if (accName === "") {
        accNameInput.style.borderColor = "red";
        accNameInput.focus();
        return false;
      } else {
        accNameInput.style.borderColor = "";
      }
      
      // Validar dirección del alojamiento
      if (accAddress === "") {
        accAddressInput.style.borderColor = "red";
        accAddressInput.focus();
        return false;
      } else {
        accAddressInput.style.borderColor = "";
      }
      
      // Validar tipo de alojamiento
      if (accType === "") {
        accTypeInput.style.borderColor = "red";
        accTypeInput.focus();
        return false;
      } else {
        accTypeInput.style.borderColor = "";
      }
      
      // Validar ciudad del alojamiento
      if (accCity === "") {
        accCityInput.style.borderColor = "red";
        accCityInput.focus();
        return false;
      } else {
        accCityInput.style.borderColor = "";
      }
      
      // Validar nombre del propietario
      if (userName === "" || !textRegex.test(userName)) {
        userNameInput.style.borderColor = "red";
        userNameInput.focus();
        return false;
      } else {
        userNameInput.style.borderColor = "";
      }
      
      // Validar teléfono del propietario
      if (!phoneRegex.test(userPhone)) {
        userPhoneInput.style.borderColor = "red";
        userPhoneInput.focus();
        return false;
      } else {
        userPhoneInput.style.borderColor = "";
      }
      
      // Validar email del propietario
      if (!emailRegex.test(userEmail) || !userEmail.includes('@')) {
        userEmailInput.style.borderColor = "red";
        userEmailInput.focus();
        return false;
      } else {
        userEmailInput.style.borderColor = "";
      }
      
      // Ya no necesitamos validar los términos y condiciones con JavaScript
      // porque usamos el atributo 'required' en HTML
      
      // Validar el captcha
      const captchaResponse = grecaptcha.getResponse();
      if (!captchaResponse) {
        // Si el captcha no está completado, mostrar un mensaje de error
        showErrorModal("Por favor, complete el captcha para verificar que no es un robot.");
        return false;
      }
      
      // Si todas las validaciones pasan, enviar el formulario
      const formData = new FormData(hotelContactForm);
      // Añadir la respuesta del captcha al formulario
      formData.append("g-recaptcha-response", captchaResponse);
      
      fetch("index.php?action=hotelContact", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          // Si el envío fue exitoso
          if (data.includes("éxito") || data.includes("enviado") || data.includes("registrado")) {
            // Reemplazar el formulario con un mensaje de éxito
            const formContainer = hotelContactForm.closest('.card-body');
            if (formContainer) {
              formContainer.innerHTML = `
                <h5 class="text-uppercase mb-4 text-success"><i class="bi bi-check-circle-fill me-2"></i>Formulario enviado</h5>
                <div class="alert alert-success">
                  <p>Gracias por tu interés en registrar tu alojamiento con Symplex.</p>
                  <p>Hemos recibido tu solicitud correctamente. Nuestro equipo se pondrá en contacto contigo lo antes posible para verificar los datos y completar el proceso de registro.</p>
                </div>
              `;
              // Scroll al mensaje de confirmación
              formContainer.scrollIntoView({ behavior: 'smooth' });
            }
          } else {
            // Si hay un error, mostrar en el modal
            showErrorModal(data);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showErrorModal("Ha ocurrido un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.");
        });
    });
    
    // Agregar validación en tiempo real para los campos
    const inputs = hotelContactForm.querySelectorAll('input, select');
    inputs.forEach(input => {
      input.addEventListener('blur', function() {
        // Quitar borde rojo cuando el usuario comienza a escribir
        if (this.value.trim() !== '') {
          this.style.borderColor = '';
        }
      });
    });
    
    // No validamos el email en tiempo real para evitar mensajes molestos
    
    // Ya no necesitamos la validación en tiempo real para el checkbox de términos y condiciones
    // porque usamos el atributo 'required' en HTML que maneja la validación nativa del navegador
  }
});