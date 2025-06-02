// Función para mostrar errores visualmente en el campo correspondiente
function showFieldError(field, message) {
  // Aplicar estilo visual al campo
  field.style.borderColor = "red";
  
  // Crear o actualizar mensaje de error
  let errorDiv = field.nextElementSibling;
  if (!errorDiv || !errorDiv.classList.contains('text-danger')) {
    errorDiv = document.createElement('div');
    errorDiv.classList.add('text-danger', 'small', 'mt-1');
    field.parentNode.insertBefore(errorDiv, field.nextSibling);
  }
  errorDiv.textContent = message;
}

// Función para limpiar errores
function clearFieldError(field) {
  field.style.borderColor = "";
  const errorDiv = field.nextElementSibling;
  if (errorDiv && errorDiv.classList.contains('text-danger')) {
    errorDiv.textContent = "";
  }
}

console.log("help.js cargado");
document.addEventListener("DOMContentLoaded", function () {
  // Formulario de ayuda
  const helpForm = document.querySelector('form[action="index.php?action=sendHelp"]');
  
  if (helpForm) {
    helpForm.addEventListener("submit", function (e) {
      e.preventDefault();
      
      // Obtener los campos del formulario
      let helpEmailInput = document.getElementById("helpEmail");
      let helpMessageInput = document.getElementById("helpMessage");
      let termsCheckbox = document.getElementById("register-terms");
      
      // Obtener los valores
      let helpEmail = helpEmailInput.value.trim();
      let helpMessage = helpMessageInput.value.trim();
      let termsAccepted = termsCheckbox.checked;
      
      // Expresión regular para validación de email
      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      
      // Validar correo electrónico
      if (helpEmail === "") {
        helpEmailInput.style.borderColor = "red";
        helpEmailInput.focus();
        return false;
      } else if (!emailRegex.test(helpEmail) || !helpEmail.includes('@')) {
        showFieldError(helpEmailInput, "Por favor, introduce un correo electrónico válido.");
        helpEmailInput.focus();
        return false;
      } else {
        helpEmailInput.style.borderColor = "";
      }
      
      // Validar mensaje de consulta
      if (helpMessage === "") {
        helpMessageInput.style.borderColor = "red";
        helpMessageInput.focus();
        return false;
      } else if (helpMessage.length < 10) {
        showFieldError(helpMessageInput, "La consulta debe tener al menos 10 caracteres.");
        helpMessageInput.focus();
        return false;
      } else {
        helpMessageInput.style.borderColor = "";
      }
      
      // Validar términos y condiciones
      if (!termsAccepted) {
        // Aplicar estilo visual al contenedor del checkbox
        const termsContainer = termsCheckbox.closest('.form-check');
        termsContainer.style.border = "1px solid red";
        termsContainer.style.borderRadius = "5px";
        termsContainer.style.padding = "10px";
        
        // Mostrar mensaje de error junto al checkbox
        let errorDiv = termsContainer.querySelector('.text-danger');
        if (!errorDiv) {
          errorDiv = document.createElement('div');
          errorDiv.classList.add('text-danger', 'small', 'mt-1');
          termsContainer.appendChild(errorDiv);
        }
        errorDiv.textContent = "Debes aceptar los términos y condiciones para continuar.";
        
        termsCheckbox.focus();
        return false;
      } else {
        const termsContainer = termsCheckbox.closest('.form-check');
        termsContainer.style.border = "";
        termsContainer.style.padding = "";
        
        // Limpiar mensaje de error
        const errorDiv = termsContainer.querySelector('.text-danger');
        if (errorDiv) {
          errorDiv.textContent = "";
        }
      }
      
      // Validar captcha
      const captchaResponse = grecaptcha.getResponse();
      if (!captchaResponse) {
        // Crear o actualizar div de error para el captcha
        const captchaContainer = document.getElementById('captcha-help').closest('.mb-3');
        let errorDiv = captchaContainer.querySelector('.text-danger');
        if (!errorDiv) {
          errorDiv = document.createElement('div');
          errorDiv.classList.add('text-danger', 'small', 'mt-1');
          captchaContainer.appendChild(errorDiv);
        }
        errorDiv.textContent = "Por favor, complete el captcha para verificar que no es un robot.";
        return false;
      }
      
      // Si todas las validaciones pasan, enviar el formulario
      const formData = new FormData(helpForm);
      // Añadir el token del captcha al FormData
      formData.append('g-recaptcha-response', captchaResponse);
      
      fetch("index.php?action=sendHelp", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          // Resetear el captcha en cualquier caso
          if (typeof grecaptcha !== 'undefined') {
            grecaptcha.reset();
          }
          
          if (data === "enviado") {
            // Si el envío fue exitoso
            const formContainer = helpForm.closest('.card-body');
            if (formContainer) {
              // Ocultar el formulario
              helpForm.style.display = 'none';
              
              // Crear div de éxito
              const successDiv = document.createElement('div');
              successDiv.classList.add('alert', 'alert-success', 'mb-3');
              successDiv.textContent = "Tu consulta ha sido enviada correctamente. Te responderemos lo antes posible.";
              
              // Añadir al contenedor
              formContainer.appendChild(successDiv);
              
              // Scroll al mensaje de éxito
              formContainer.scrollIntoView({ behavior: 'smooth' });
            }
          } else {
            // Si hay un error, mostrar mensaje de error en la parte superior del formulario
            const formContainer = helpForm.closest('.card-body');
            if (formContainer) {
              // Crear o actualizar div de error
              let errorDiv = formContainer.querySelector('.alert-danger');
              if (!errorDiv) {
                errorDiv = document.createElement('div');
                errorDiv.classList.add('alert', 'alert-danger', 'mb-3');
                helpForm.parentNode.insertBefore(errorDiv, helpForm);
              }
              errorDiv.textContent = data || "Ha ocurrido un error al procesar tu consulta. Inténtalo nuevamente.";
              // Scroll al mensaje de error
              errorDiv.scrollIntoView({ behavior: 'smooth' });
              
              // Limpiar los errores de los campos específicos
              const allErrorMessages = document.querySelectorAll('.text-danger');
              allErrorMessages.forEach(msg => {
                if (msg.parentNode !== errorDiv.parentNode) {
                  msg.textContent = '';
                }
              });
              
              // Restaurar los estilos de los campos
              helpEmailInput.style.borderColor = '';
              helpMessageInput.style.borderColor = '';
              const termsContainer = termsCheckbox.closest('.form-check');
              if (termsContainer) {
                termsContainer.style.border = '';
                termsContainer.style.padding = '';
              }
            }
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          // Resetear el captcha
          if (typeof grecaptcha !== 'undefined') {
            grecaptcha.reset();
          }
          
          // Mostrar error de conexión en la parte superior del formulario
          const formContainer = helpForm.closest('.card-body');
          if (formContainer) {
            // Crear o actualizar div de error
            let errorDiv = formContainer.querySelector('.alert-danger');
            if (!errorDiv) {
              errorDiv = document.createElement('div');
              errorDiv.classList.add('alert', 'alert-danger', 'mb-3');
              helpForm.parentNode.insertBefore(errorDiv, helpForm);
            }
            errorDiv.textContent = "Ha ocurrido un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.";
            // Scroll al mensaje de error
            errorDiv.scrollIntoView({ behavior: 'smooth' });
          }
        });
    });
    
    // Agregar validación en tiempo real para los campos
    const helpEmailInput = document.getElementById("helpEmail");
    const helpMessageInput = document.getElementById("helpMessage");
    const termsCheckbox = document.getElementById("register-terms");
    
    // Validación en tiempo real para el email
    if (helpEmailInput) {
      helpEmailInput.addEventListener('blur', function() {
        const emailValue = this.value.trim();
        if (emailValue !== '') {
          const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
          if (emailRegex.test(emailValue)) {
            this.style.borderColor = '';
          }
        }
      });
      
      helpEmailInput.addEventListener('input', function() {
        // Quitar borde rojo cuando el usuario comienza a escribir
        if (this.style.borderColor === 'red') {
          this.style.borderColor = '';
        }
      });
    }
    
    // Validación en tiempo real para el mensaje
    if (helpMessageInput) {
      helpMessageInput.addEventListener('blur', function() {
        if (this.value.trim() !== '' && this.value.trim().length >= 10) {
          this.style.borderColor = '';
        }
      });
      
      helpMessageInput.addEventListener('input', function() {
        // Quitar borde rojo cuando el usuario comienza a escribir
        if (this.style.borderColor === 'red') {
          this.style.borderColor = '';
        }
        
        // Mostrar contador de caracteres
        const currentLength = this.value.length;
        const minLength = 10;
        
        // Buscar o crear elemento contador
        let counter = document.getElementById('messageCounter');
        if (!counter) {
          counter = document.createElement('div');
          counter.id = 'messageCounter';
          counter.className = 'form-text';
          this.parentNode.appendChild(counter);
        }
        
        if (currentLength < minLength) {
          counter.textContent = `${currentLength}/${minLength} caracteres mínimos`;
          counter.className = 'form-text text-muted';
        } else {
          counter.textContent = `${currentLength} caracteres`;
          counter.className = 'form-text text-success';
        }
      });
    }
    
    // Validación en tiempo real para el checkbox de términos
    if (termsCheckbox) {
      termsCheckbox.addEventListener('change', function() {
        const termsContainer = this.closest('.form-check');
        if (this.checked) {
          // Limpiar estilos y mensajes de error
          termsContainer.style.border = '';
          termsContainer.style.padding = '';
          
          // Eliminar mensaje de error si existe
          const errorDiv = termsContainer.querySelector('.text-danger');
          if (errorDiv) {
            errorDiv.textContent = '';
          }
        } else {
          // Si se desmarca, mostrar el borde rojo pero sin mensaje
          termsContainer.style.border = '1px solid red';
          termsContainer.style.borderRadius = '5px';
          termsContainer.style.padding = '10px';
        }
      });
    }
  }
});