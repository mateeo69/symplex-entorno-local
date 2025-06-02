// Función para cancelar una reserva
function cancelarReserva(bookingId) {
    if (!bookingId) {
        // No mostramos ningún aviso al usuario
        return;
    }
    
    // Crear FormData para enviar al servidor
    const formData = new FormData();
    formData.append('booking_id', bookingId);
    
    // Enviar los datos al servidor
    fetch('index.php?action=cancelBooking', {
        method: 'POST',
        body: formData
    })
    .then(response => {
        // Intentamos parsear la respuesta como JSON sin mostrar errores al usuario
        return response.json().catch(error => {
            // Devolvemos un objeto con success=false en lugar de lanzar un error
            return { success: false, message: 'Error al procesar la respuesta' };
        });
    })
    .then(data => {
        if (data.success) {
            // Cerrar el modal
            const modal = bootstrap.Modal.getInstance(document.getElementById('cancelarModal'));
            modal.hide();
            
            // Mostrar mensaje de éxito
            showErrorModal('Reserva cancelada con éxito');
            
            // Actualizar la interfaz: ocultar el botón de cancelar y cambiar el estado
            const bookingCard = document.querySelector(`[data-booking-id="${bookingId}"]`).closest('.card');
            if (bookingCard) {
                // Ocultar el botón de cancelar
                const cancelBtn = bookingCard.querySelector('.cancel-booking-btn');
                if (cancelBtn) {
                    cancelBtn.style.display = 'none';
                }
                
                // Cambiar el estado de la reserva a 'Cancelada'
                const statusBadge = bookingCard.querySelector('.badge');
                if (statusBadge) {
                    statusBadge.textContent = 'Cancelada';
                    statusBadge.className = 'badge bg-danger';
                }
            }
            
            // Recargar la página después de un breve retraso para mostrar los cambios
            setTimeout(() => {
                window.location.reload();
            }, 2000);
        } else {
            // No mostramos avisos al usuario
            
            // Recargar la página para refrescar el estado
            setTimeout(() => {
                window.location.reload();
            }, 500);
        }
    })
    .catch(error => {
        // Recargar la página para refrescar el estado
        setTimeout(() => {
            window.location.reload();
        }, 500);
    });
}

// Función para filtrar reservas en tiempo real
function filtrarReservas() {
    const estadoFiltro = document.getElementById('estado-filtro');
    const ordenFecha = document.getElementById('orden-fecha');
    
    if (!estadoFiltro || !ordenFecha) {
        return;
    }
    
    const estadoValue = estadoFiltro.value;
    const ordenValue = ordenFecha.value;
    
    // Redireccionar a la misma página con los parámetros de filtro
    window.location.href = `index.php?action=bookings&status=${estadoValue}&order=${ordenValue}`;
}

// Función principal que se ejecuta cuando el DOM está completamente cargado
document.addEventListener('DOMContentLoaded', function() {
    // Añadir event listeners para refrescar la página cuando se cierre cualquier modal
    document.querySelectorAll('.modal').forEach(modalEl => {
        modalEl.addEventListener('hidden.bs.modal', function() {
            // Refrescar la página manteniendo la misma URL
            window.location.href = window.location.href;
        });
    });

    // ------------ Manejo del modal de comentarios ------------
    console.log('bookings.js loaded');
    const commentModalEl = document.getElementById('commentModal');
    if (commentModalEl) {
        commentModalEl.addEventListener('show.bs.modal', function (event) {
            const triggerBtn = event.relatedTarget;
            if (triggerBtn) {
                const card = triggerBtn.closest('.reserva-card');
                if (card) {
                    // Get data from the card
                    const accommodation_id = card.dataset.id; // From data-id
                    const booking_id = card.dataset.bookingId; // From data-booking-id
                    const hotelName = card.querySelector('.hotel-name')?.textContent?.trim(); // From h4

                    // Inject into the form
                    const accommodationIdInput = document.querySelector('#commentForm input[name="accommodation_id"]');
                    const bookingIdInput = document.querySelector('#commentForm input[name="booking_id"]');
                    if (accommodationIdInput) accommodationIdInput.value = accommodation_id;
                    if (bookingIdInput) bookingIdInput.value = booking_id;
                    const form = this.querySelector('#commentForm');
                    if (form) {
                        const inputAccommodationId = form.querySelector('input[name="accommodation_id"]');
                        if (inputAccommodationId) {
                            inputAccommodationId.value = accommodation_id;
                        }
                    }

                    // Update modal title with hotel name
                    const modalTitleEl = this.querySelector('#editProfileModalLabel');
                    if (modalTitleEl && hotelName) {
                        modalTitleEl.textContent = hotelName;
                    }
                }
            }
        });
    }

    // ------------ Manejo del modal de cancelación ------------
    const cancelarModalEl = document.getElementById('cancelarModal');
    if (cancelarModalEl) {
        cancelarModalEl.addEventListener('show.bs.modal', function (event) {
            const button = event.relatedTarget;
            if (button) {
                const bookingId = button.getAttribute('data-booking-id');
                const bookingIdInput = document.getElementById('booking-id-to-cancel');
                if (bookingIdInput) {
                    bookingIdInput.value = bookingId;
                }
            }
        });
    }

    // Configurar el event listener para el botón de confirmar cancelación
    const confirmarCancelacionBtn = document.getElementById('confirmarCancelacion');
    if (confirmarCancelacionBtn) {
        confirmarCancelacionBtn.addEventListener('click', function() {
            const bookingIdInput = document.getElementById('booking-id-to-cancel');
            if (bookingIdInput && bookingIdInput.value) {
                cancelarReserva(bookingIdInput.value);
            }
        });
    }
    
    // ------------ Configurar los event listeners para los filtros ------------
    const estadoFiltro = document.getElementById('estado-filtro');
    if (estadoFiltro) {
        estadoFiltro.addEventListener('change', filtrarReservas);
    }
    
    const ordenFecha = document.getElementById('orden-fecha');
    if (ordenFecha) {
        ordenFecha.addEventListener('change', filtrarReservas);
    }
    
    // ------------ Configurar modalidad de edición de perfil ------------
    const editProfileModal = document.getElementById('editProfileModal');
    if (editProfileModal) {
        editProfileModal.addEventListener('show.bs.modal', function() {
            // Obtener datos del usuario desde el contenedor de datos
            const userDataContainer = document.getElementById('userDataContainer');
            if (!userDataContainer) return;
            
            // Obtener los campos del formulario
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const correoInput = document.getElementById('correo');
            const telefonoInput = document.getElementById('telefono');
            
            // Cargar los datos del usuario en el formulario si existen los campos
            if (nombreInput) nombreInput.value = userDataContainer.dataset.userFirstname || '';
            if (apellidoInput) apellidoInput.value = userDataContainer.dataset.userLastname || '';
            if (correoInput) correoInput.value = userDataContainer.dataset.userEmail || '';
            if (telefonoInput) telefonoInput.value = userDataContainer.dataset.userPhone || '';
            
            // Resetear los estilos de validación
            if (nombreInput) nombreInput.style.borderColor = '';
            if (apellidoInput) apellidoInput.style.borderColor = '';
            if (correoInput) correoInput.style.borderColor = '';
            if (telefonoInput) telefonoInput.style.borderColor = '';
        });
    }
    
    // Manejar el guardado de los cambios con validación del perfil
    const guardarPerfilBtn = document.getElementById('guardarPerfil');
    if (guardarPerfilBtn) {
        guardarPerfilBtn.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Obtener los campos del formulario
            const nombreInput = document.getElementById('nombre');
            const apellidoInput = document.getElementById('apellido');
            const correoInput = document.getElementById('correo');
            const telefonoInput = document.getElementById('telefono');
            
            // Verificar que existan todos los campos
            if (!nombreInput || !apellidoInput || !correoInput || !telefonoInput) {
                console.error('Faltan campos en el formulario');
                return false;
            }
            
            // Obtener los valores
            const nombre = nombreInput.value.trim();
            const apellido = apellidoInput.value.trim();
            const correo = correoInput.value.trim();
            const telefono = telefonoInput.value.trim();
            
            // Definir expresiones regulares para validación
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            const phoneRegex = /^\d{9}$/; 
            
            // Validar nombre
            if (nombre === '') {
                nombreInput.style.borderColor = 'red';
                nombreInput.focus();
                return false;
            } else {
                nombreInput.style.borderColor = '';
            }
            
            // Validar apellido
            if (apellido === '') {
                apellidoInput.style.borderColor = 'red';
                apellidoInput.focus();
                return false;
            } else {
                apellidoInput.style.borderColor = '';
            }
            
            // Validar email
            if (!emailRegex.test(correo)) {
                correoInput.style.borderColor = 'red';
                correoInput.focus();
                return false;
            } else {
                correoInput.style.borderColor = '';
            }
            
            // Validar teléfono
            if (!phoneRegex.test(telefono)) {
                telefonoInput.style.borderColor = 'red';
                telefonoInput.focus();
                return false;
            } else {
                telefonoInput.style.borderColor = '';
            }
            
            // Si todas las validaciones pasan, preparar los datos para enviar
            console.log('Guardando cambios del perfil...');
            
            // Crear FormData para enviar al servidor
            const formData = new FormData();
            formData.append('first_name', nombre);
            formData.append('last_name', apellido);
            formData.append('email', correo);
            formData.append('phone', telefono);
            
            // Enviar los datos al servidor
            fetch('index.php?action=updateProfile', {
                method: 'POST',
                body: formData
            })
            .then(response => response.text())
            .then(data => {
                // Mostrar mensaje de éxito o error
                if (data.includes('éxito')) {
                    // Actualizar los datos mostrados en la página
                    const userNameEl = document.getElementById('userName');
                    const userEmailEl = document.getElementById('userEmail');
                    
                    if (userNameEl) userNameEl.textContent = nombre;
                    if (userEmailEl) userEmailEl.textContent = correo;
                    
                    // Actualizar los datos en el contenedor para futuras ediciones
                    const userDataContainer = document.getElementById('userDataContainer');
                    if (userDataContainer) {
                        userDataContainer.dataset.userFirstname = nombre;
                        userDataContainer.dataset.userLastname = apellido;
                        userDataContainer.dataset.userEmail = correo;
                        userDataContainer.dataset.userPhone = telefono;
                    }
                    
                    // Cerrar el modal
                    const modal = bootstrap.Modal.getInstance(document.getElementById('editProfileModal'));
                    if (modal) modal.hide();
                    
                    // Mostrar mensaje de éxito
                    if (typeof showErrorModal === 'function') {
                        showErrorModal('Perfil actualizado con éxito');
                    }
                } else {
                    // Mostrar mensaje de error
                    if (typeof showErrorModal === 'function') {
                        showErrorModal(data || 'Ha ocurrido un error al actualizar el perfil');
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
                if (typeof showErrorModal === 'function') {
                    showErrorModal('Ha ocurrido un error al procesar tu solicitud. Por favor, intenta nuevamente más tarde.');
                }
            });
        });
    }
    
    // Configurar los event listeners para los botones de cancelar reserva
    const cancelButtons = document.querySelectorAll('.cancel-booking-btn');
    if (cancelButtons.length > 0) {
        cancelButtons.forEach(button => {
            button.addEventListener('click', function() {
                const bookingId = this.getAttribute('data-booking-id');
                const bookingIdInput = document.getElementById('booking-id-to-cancel');
                if (bookingIdInput) {
                    bookingIdInput.value = bookingId;
                }
            });
        });
    }
    
    // Validación de contraseña en el formulario de cambio de contraseña
    const changePasswordForm = document.getElementById('changePasswordForm');
    if (changePasswordForm) {
        changePasswordForm.addEventListener('submit', function(event) {
            const newPassword = document.getElementById('newPassword').value;
            const confirmNewPassword = document.getElementById('confirmNewPassword').value;
            const alertBox = document.getElementById('passwordMismatchAlert');
            if (newPassword !== confirmNewPassword) {
                event.preventDefault();
                alertBox.classList.remove('d-none');
            } else {
                alertBox.classList.add('d-none');
            }
        });
    }
    
    // Mostrar mensaje modal si existe
    const urlParams = new URLSearchParams(window.location.search);
    const successParam = urlParams.get('success');
    
    if (successParam) {
        let message = '';
        if (successParam === 'true') {
            message = 'Contraseña actualizada con éxito.';
        } else if (successParam === 'false') {
            message = 'Error al actualizar la contraseña. Por favor, inténtalo de nuevo.';
        } else if (successParam === 'verifyPassword') {
            message = 'Contraseña actual incorrecta. Por favor, inténtalo de nuevo.';
        }
        
        if (message) {
            const modalBody = document.getElementById('messageModalBody');
            if (modalBody) {
                modalBody.textContent = message;
                const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
                messageModal.show();
            }
        }
    }
    
    // Función para mostrar mensajes de error/éxito en un modal
    window.showErrorModal = function(message) {
        const modalBody = document.getElementById('messageModalBody');
        if (modalBody) {
            modalBody.textContent = message;
            const messageModal = new bootstrap.Modal(document.getElementById('messageModal'));
            
            // Prevenir que este modal específico refresque la página automáticamente
            const messageModalEl = document.getElementById('messageModal');
            const originalHandler = messageModalEl._refreshHandler;
            messageModalEl._refreshHandler = null;
            
            messageModal.show();
            
            // Recargar la página después de mostrar el mensaje
            setTimeout(() => {
                window.location.href = window.location.href;
            }, 100);
            
            // Restaurar el handler original después
            setTimeout(() => {
                messageModalEl._refreshHandler = originalHandler;
            }, 100);
        }
    };
    
    // Inicializar todos los botones con atributo data-bs-toggle="modal"
    const modalButtons = document.querySelectorAll('[data-bs-toggle="modal"]');
    modalButtons.forEach(button => {
        button.addEventListener('click', function(event) {
            const targetModalId = this.getAttribute('data-bs-target');
            if (targetModalId) {
                const modalElement = document.querySelector(targetModalId);
                if (modalElement) {
                    const modal = new bootstrap.Modal(modalElement);
                    modal.show();
                }
            }
        });
    });
});