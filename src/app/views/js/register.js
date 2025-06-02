// Variables globales para los widgetId de cada captcha
let captchaLoginWidgetId;
let captchaRegisterWidgetId;

// Esta función la llama automáticamente reCAPTCHA cuando carga el script
function onloadCallback() {
  // Renderiza ambos captchas y guarda sus widgetId
  captchaLoginWidgetId = grecaptcha.render("captcha-login", {
    sitekey: "6LfLjjErAAAAACaD5764-KBbbS_tG822wJwldEMX",
  });
  captchaRegisterWidgetId = grecaptcha.render("captcha-register", {
    sitekey: "6LdyoDErAAAAADwNLrpo-G1p84po7yTOzl8ARV-G",
  });
}
function login() {
  document.getElementById("loginForm").classList.add("active");
  document.getElementById("registerForm").classList.remove("active");
}
function register() {
  document.getElementById("registerForm").classList.add("active");
  document.getElementById("loginForm").classList.remove("active");
}

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

document.addEventListener("DOMContentLoaded", function () {
  const params = new URLSearchParams(window.location.search);
  const action = params.get("action");
  document.getElementById("registerBtn").addEventListener("click", function () {
    register();
  });
  document.getElementById("loginBtn").addEventListener("click", function () {
    login();
  });
  if (action === "login") {
    login();
  } else if (action === "register") {
    register();
  }
  // LOGIN
  const loginBtn = document.getElementById("login-submit");
if (loginBtn) {
  loginBtn.addEventListener("click", function (e) {
    let emailInput = document.getElementById("email");
    let passwordInput = document.getElementById("password");
    let termsCheckbox = document.getElementById("login-terms");

    let mail = emailInput.value;
    let password = passwordInput.value;

    let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;

    // Validar email
    if (!emailRegex.test(mail)) {
      emailInput.style.borderColor = "red";
      emailInput.focus();
      passwordInput.style.borderColor = "";
      termsCheckbox.style.outline = "";
      e.preventDefault();
      return false;
    } else {
      emailInput.style.borderColor = "";
    }

    // Validar contraseña
    if (!passwordRegex.test(password)) {
      passwordInput.style.borderColor = "red";
      passwordInput.focus();
      termsCheckbox.style.outline = "";
      e.preventDefault();
      return false;
    } else {
      passwordInput.style.borderColor = "";
    }

    // Validar checkbox de términos
    if (!termsCheckbox.checked) {
      termsCheckbox.style.outline = "2px solid red";
      termsCheckbox.focus();
      e.preventDefault();
      return false;
    } else {
      termsCheckbox.style.outline = "";
    }

    // Validar captcha de login usando el widget ID
    let captchaResponse = grecaptcha.getResponse(captchaLoginWidgetId);
    if (!captchaResponse) {
      showErrorModal("Por favor, resuelve el captcha.");
      e.preventDefault();
      return false;
    }
    const formData = new FormData();
    formData.append("email", mail);
    formData.append("password", password);

    fetch("index.php?action=login", {
      method: "POST",
      body: formData,
    })
      .then((response) => response.json())
      .then((data) => {
        // Debug: ver la respuesta completa
        console.log('Server response:', data);
        
        if (data.success) {
            console.log('Login exitoso, rol:', data.role);
            // Verificar el rol y redirigir en consecuencia
            if (data.role === "admin") {
              console.log('Redirigiendo a admin');
              window.location.href = "index.php?action=admin";
            } else {
              console.log('Redirigiendo a home');
              window.location.href = "index.php?action=home";
            }
          } else {
            // Si hay un error en el login, mostrar en el modal
            showErrorModal(data.message);
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showErrorModal("Ha ocurrido un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.");
        });
  });
}

  // REGISTRO
  const registerBtn = document.getElementById("register-submit");
  if (registerBtn) {
    registerBtn.addEventListener("click", function (e) {
      e.preventDefault();
      let nameInput = document.getElementById("name");
      let lastnameInput = document.getElementById("lastname");
      let emailInput = document.getElementById("reg-email");
      let phoneInput = document.getElementById("reg-phone");
      let cityInput = document.getElementById("reg-city");
      let passwordInput = document.getElementById("reg-password");
      let confirmPasswordInput = document.getElementById("confirm-password");
      let termsCheckbox = document.getElementById("register-terms");

      let name = nameInput.value.trim();
      let lastname = lastnameInput.value.trim();
      let mail = emailInput.value.trim();
      let phone = phoneInput.value.trim();
      let city = cityInput.value.trim();
      let password = passwordInput.value;
      let confirmPassword = confirmPasswordInput.value;

      let emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      let passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/;
      let phoneRegex = /^\d{9}$/; // 9 dígitos
      let cityRegex = /^[a-zA-Z\s]+$/; // Solo letras y espacios

      // Validar nombre
      if (name === "") {
        nameInput.style.borderColor = "red";
        nameInput.focus();
        e.preventDefault();
        return false;
      } else {
        nameInput.style.borderColor = "";
      }

      // Validar apellidos
      if (lastname === "") {
        lastnameInput.style.borderColor = "red";
        lastnameInput.focus();
        e.preventDefault();
        return false;
      } else {
        lastnameInput.style.borderColor = "";
      }

      // Validar email
      if (!emailRegex.test(mail)) {
        emailInput.style.borderColor = "red";
        emailInput.focus();
        passwordInput.style.borderColor = "";
        confirmPasswordInput.style.borderColor = "";
        termsCheckbox.style.outline = "";
        e.preventDefault();
        return false;
      } else {
        emailInput.style.borderColor = "";
      }

      // Validar teléfono
      if (!phoneRegex.test(phone)) {
        phoneInput.style.borderColor = "red";
        phoneInput.focus();
        passwordInput.style.borderColor = "";
        confirmPasswordInput.style.borderColor = "";
        termsCheckbox.style.outline = "";
        e.preventDefault();
        return false;
      } else {
        phoneInput.style.borderColor = "";
      } 

      // Validar ciudad
      if (!cityRegex.test(city)) {
        cityInput.style.borderColor = "red";
        cityInput.focus();
        passwordInput.style.borderColor = "";
        confirmPasswordInput.style.borderColor = "";
        termsCheckbox.style.outline = "";
        e.preventDefault();
        return false;
      } else {
        cityInput.style.borderColor = "";
      }

      // Validar contraseña
      if (!passwordRegex.test(password)) {
        passwordInput.style.borderColor = "red";
        passwordInput.focus();
        confirmPasswordInput.style.borderColor = "";
        termsCheckbox.style.outline = "";
        e.preventDefault();
        return false;
      } else {
        passwordInput.style.borderColor = "";
      }

      // Validar confirmación de contraseña
      if (password !== confirmPassword) {
        confirmPasswordInput.style.borderColor = "red";
        confirmPasswordInput.focus();
        e.preventDefault();
        return false;
      } else {
        confirmPasswordInput.style.borderColor = "";
      }

      // Validar checkbox de términos
      if (!termsCheckbox.checked) {
        termsCheckbox.style.outline = "2px solid red";
        termsCheckbox.focus();
        e.preventDefault();
        return false;
      } else {
        termsCheckbox.style.outline = "";
      }

      // Validar captcha de registro usando el widgetId
      let captchaResponse = grecaptcha.getResponse(captchaRegisterWidgetId);
      if (!captchaResponse) {
        showErrorModal("Por favor, resuelve el captcha.");
        e.preventDefault();
        return false;
      }

      const formData = new FormData();
      formData.append("first_name", name);
      formData.append("last_name", lastname);
      formData.append("email", mail);
      formData.append("phone", phone); 
      formData.append("city", city); 
      formData.append("password", password);    
    
      fetch("index.php?action=register", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.text())
        .then((data) => {
          // Mostrar mensaje en el modal en lugar de alert
          showErrorModal(data);
          
          // Si el registro fue exitoso, redirigir al home
          if (data.includes("éxito")) {
            setTimeout(() => {
              window.location.href = "index.php?action=home";
            }, 1500); // Esperar 1.5 segundos para que el usuario vea el mensaje de éxito
          }
        })
        .catch((error) => {
          console.error("Error:", error);
          showErrorModal("Ha ocurrido un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.");
        });
    
   
    });
  }
});
