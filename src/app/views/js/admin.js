// Variables globales para los modales
let confirmActionModal;
let confirmActionMessage;
let confirmActionBookingId;
let confirmActionType;
let confirmActionButton;
let bsConfirmActionModal;

document.addEventListener('DOMContentLoaded', function() {
    // Asegurarse de que Bootstrap esté completamente cargado antes de inicializar modales
    setTimeout(() => {
        // Referencias a los elementos del modal
        confirmActionModal = document.getElementById('confirmActionModal');
        confirmActionMessage = document.getElementById('confirmActionMessage');
        confirmActionBookingId = document.getElementById('confirmActionBookingId');
        confirmActionType = document.getElementById('confirmActionType');
        confirmActionButton = document.getElementById('confirmActionButton');
        
        // Inicializar el modal si existe y Bootstrap está disponible
        if (confirmActionModal && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bsConfirmActionModal = new bootstrap.Modal(confirmActionModal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
            
            // Manejar el botón de confirmación
            if (confirmActionButton) {
                confirmActionButton.addEventListener('click', function() {
                    const bookingId = confirmActionBookingId.value;
                    const newStatus = confirmActionType.value;
                    
                    if (bookingId && newStatus) {
                        // Ocultar el modal
                        bsConfirmActionModal.hide();
                        
                        // Actualizar el estado de la reserva
                        updateBookingStatus(bookingId, newStatus);
                    }
                });
            }
        }
    }, 500); // Esperar 500ms para asegurar que Bootstrap esté cargado
    
    // Manejar botones de aceptar y denegar reservas
    document.addEventListener('click', function(e) {
        // Verificar si el clic fue en un botón de acción
        if (e.target.closest('[data-action]')) {
            const button = e.target.closest('[data-action]');
            const action = button.getAttribute('data-action');
            const bookingId = button.getAttribute('data-booking-id');
            
            if (!bookingId) return;
            
            // Preparar el modal según la acción
            switch (action) {
                case 'accept':
                    showConfirmModal(bookingId, 'confirmed', '¿Estás seguro de que deseas aceptar esta reserva?');
                    break;
                case 'deny':
                    showConfirmModal(bookingId, 'cancelled', '¿Estás seguro de que deseas denegar esta reserva?');
                    break;
                case 'cancel':
                    showConfirmModal(bookingId, 'cancelled', '¿Estás seguro de que deseas cancelar esta reserva?');
                    break;               
            }
        }
    });
    
    // Función para mostrar el modal de confirmación
    function showConfirmModal(bookingId, newStatus, message) {
        // Si el modal no está inicializado, intentar inicializarlo
        if (!confirmActionModal) {
            confirmActionModal = document.getElementById('confirmActionModal');
            if (!confirmActionModal) {
                console.error('Modal de confirmación no encontrado');
                return;
            }
        }
        
        if (!confirmActionMessage) {
            confirmActionMessage = document.getElementById('confirmActionMessage');
        }
        
        if (!confirmActionBookingId) {
            confirmActionBookingId = document.getElementById('confirmActionBookingId');
        }
        
        if (!confirmActionType) {
            confirmActionType = document.getElementById('confirmActionType');
        }
        
        if (!confirmActionButton) {
            confirmActionButton = document.getElementById('confirmActionButton');
        }
        
        // Si el modal de Bootstrap no está inicializado, intentar inicializarlo
        if (!bsConfirmActionModal && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bsConfirmActionModal = new bootstrap.Modal(confirmActionModal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
        }
        
        // Si todavía no podemos inicializar el modal, mostrar un mensaje de error
        if (!bsConfirmActionModal) {
            console.error('No se pudo inicializar el modal de Bootstrap');
            alert(message + ' (No se pudo mostrar el modal)');
            return;
        }
        
        // Configurar el modal
        confirmActionMessage.textContent = message;
        confirmActionBookingId.value = bookingId;
        confirmActionType.value = newStatus;
        
        // Ajustar el botón de confirmación según el tipo de acción
        if (newStatus === 'confirmed') {
            confirmActionButton.classList.remove('btn-danger');
            confirmActionButton.classList.add('btn-success');
            confirmActionButton.textContent = 'Aceptar';
            confirmActionButton.style.display = 'block';
        } else if (newStatus === 'cancelled') {
            confirmActionButton.classList.remove('btn-success');
            confirmActionButton.classList.add('btn-danger');
            confirmActionButton.textContent = 'Denegar';
            confirmActionButton.style.display = 'block';
        }
        
        // Mostrar el modal
        bsConfirmActionModal.show();
    }
    
    // Función para mostrar un modal informativo
    function showInfoModal(message) {
        // Si el modal no está inicializado, intentar inicializarlo
        if (!confirmActionModal) {
            confirmActionModal = document.getElementById('confirmActionModal');
            if (!confirmActionModal) {
                console.error('Modal de confirmación no encontrado');
                alert(message);
                return;
            }
        }
        
        if (!confirmActionMessage) {
            confirmActionMessage = document.getElementById('confirmActionMessage');
        }
        
        if (!confirmActionBookingId) {
            confirmActionBookingId = document.getElementById('confirmActionBookingId');
        }
        
        if (!confirmActionType) {
            confirmActionType = document.getElementById('confirmActionType');
        }
        
        if (!confirmActionButton) {
            confirmActionButton = document.getElementById('confirmActionButton');
        }
        
        // Si el modal de Bootstrap no está inicializado, intentar inicializarlo
        if (!bsConfirmActionModal && typeof bootstrap !== 'undefined' && bootstrap.Modal) {
            bsConfirmActionModal = new bootstrap.Modal(confirmActionModal, {
                backdrop: true,
                keyboard: true,
                focus: true
            });
        }
        
        // Si todavía no podemos inicializar el modal, mostrar un alert tradicional
        if (!bsConfirmActionModal) {
            console.error('No se pudo inicializar el modal de Bootstrap');
            return;
        }
        
        // Configurar el modal
        confirmActionMessage.textContent = message;
        confirmActionBookingId.value = '';
        confirmActionType.value = '';
        confirmActionButton.style.display = 'none';
        
        // Mostrar el modal
        bsConfirmActionModal.show();
        
        // Ocultar el modal después de 2 segundos
        setTimeout(() => {
            bsConfirmActionModal.hide();
            confirmActionButton.style.display = 'block';
        }, 2000);
    }
    
    // Función para actualizar el estado de una reserva
    function updateBookingStatus(bookingId, newStatus) {
        const formData = new FormData();
        formData.append('booking_id', bookingId);
        formData.append('status', newStatus);
        
        fetch('index.php?action=updateBookingStatus', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {                
                // Recargar después de un breve retraso para que el usuario vea el mensaje
                setTimeout(() => {
                    window.location.reload();
                }, 100);
            } else {
                showInfoModal('Error: ' + (data.message || 'No se pudo actualizar la reserva'));
            }
        })
        .catch(error => {
            console.error('Error:', error);
            showInfoModal('Ha ocurrido un error al procesar tu solicitud.');
        });
    }
    // Manejar el filtrado por fechas
    const startDateInput = document.getElementById('startDate');
    const endDateInput = document.getElementById('endDate');
    const applyFilterButton = document.getElementById('applyFilterButton');
    
    if (startDateInput && endDateInput) {
        // Establecer la fecha actual como valor predeterminado para startDate
        const today = new Date();
        const formattedToday = today.toISOString().split('T')[0];
        startDateInput.value = formattedToday;
        
        // Establecer la fecha de una semana después como valor predeterminado para endDate
        const nextWeek = new Date();
        nextWeek.setDate(today.getDate() + 7);
        const formattedNextWeek = nextWeek.toISOString().split('T')[0];
        endDateInput.value = formattedNextWeek;
        
        // Validar que la fecha de fin no sea anterior a la fecha de inicio
        startDateInput.addEventListener('change', function() {
            if (endDateInput.value < startDateInput.value) {
                endDateInput.value = startDateInput.value;
            }
        });
        
        endDateInput.addEventListener('change', function() {
            if (endDateInput.value < startDateInput.value) {
                alert('La fecha de fin no puede ser anterior a la fecha de inicio');
                endDateInput.value = startDateInput.value;
            }
        });
    }
    
    // Manejar el botón de aplicar filtro
    if (applyFilterButton) {
        applyFilterButton.addEventListener('click', function() {
            if (startDateInput && endDateInput && startDateInput.value && endDateInput.value) {
                console.log('Aplicando filtro de fechas:', startDateInput.value, 'a', endDateInput.value);
                
                // Cerrar el modal
                const calendarModal = bootstrap.Modal.getInstance(document.getElementById('calendarModal'));
                if (calendarModal) {
                    calendarModal.hide();
                }
                
                // Redireccionar a la página con los parámetros
                window.location.href = 'index.php?action=admin&start_date=' + encodeURIComponent(startDateInput.value) + '&end_date=' + encodeURIComponent(endDateInput.value);
            } else {
                alert('Por favor, selecciona ambas fechas');
            }
        });
    }
    
    // Código para manejar la paginación
    const paginacion = document.getElementById('paginacion');
    const reservasContainer = document.getElementById('reservas-container');
    
    if (paginacion && reservasContainer) {
        // Obtener todos los botones de página
        const botonesPagina = paginacion.querySelectorAll('.page-item[data-pagina]');
        const botonAnterior = document.getElementById('pagina-anterior');
        const botonSiguiente = document.getElementById('pagina-siguiente');
        let paginaActual = 1;
        
        // Función para cambiar de página
        function cambiarPagina(pagina) {
            // Ocultar todas las reservas
            const todasLasReservas = reservasContainer.querySelectorAll('.reserva-item');
            todasLasReservas.forEach(reserva => {
                reserva.classList.add('d-none');
            });
            
            // Mostrar solo las reservas de la página actual
            const reservasDePagina = reservasContainer.querySelectorAll(`.reserva-item[data-pagina="${pagina}"]`);
            reservasDePagina.forEach(reserva => {
                reserva.classList.remove('d-none');
            });
            
            // Actualizar los botones de paginación
            botonesPagina.forEach(boton => {
                if (parseInt(boton.getAttribute('data-pagina')) === pagina) {
                    boton.classList.add('active');
                } else {
                    boton.classList.remove('active');
                }
            });
            
            // Actualizar los botones de anterior y siguiente
            if (pagina === 1) {
                botonAnterior.classList.add('disabled');
            } else {
                botonAnterior.classList.remove('disabled');
            }
            
            if (pagina === botonesPagina.length) {
                botonSiguiente.classList.add('disabled');
            } else {
                botonSiguiente.classList.remove('disabled');
            }
            
            // Actualizar la página actual
            paginaActual = pagina;
        }
        
        // Añadir eventos a los botones de página
        botonesPagina.forEach(boton => {
            boton.addEventListener('click', function(e) {
                e.preventDefault();
                const pagina = parseInt(this.getAttribute('data-pagina'));
                cambiarPagina(pagina);
            });
        });
        
        // Añadir eventos a los botones de anterior y siguiente
        if (botonAnterior) {
            botonAnterior.addEventListener('click', function(e) {
                e.preventDefault();
                if (paginaActual > 1) {
                    cambiarPagina(paginaActual - 1);
                }
            });
        }
        
        if (botonSiguiente) {
            botonSiguiente.addEventListener('click', function(e) {
                e.preventDefault();
                if (paginaActual < botonesPagina.length) {
                    cambiarPagina(paginaActual + 1);
                }
            });
        }
    }
    
    
    // Seleccionar todos los botones de check-in (verdes)
    const checkInButtons = document.querySelectorAll('.btn-success');
    
    // Seleccionar todos los botones de check-out (azules)
    const checkOutButtons = document.querySelectorAll('.btn-primary');
    
    // Seleccionar todos los botones de cancelar (rojos)
    const cancelButtons = document.querySelectorAll('.btn-danger');
    
    
    // Añadir evento a los botones de check-in
    checkInButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            // Obtener la tarjeta completa (card)
            const card = this.closest('.card');
            
            // Verificar si ya está en estado de check-in
            if (card.classList.contains('bg-success-light')) {
                // Cancelar check-in
                card.classList.remove('bg-success-light');
                this.innerHTML = '<i class="bi bi-box-arrow-in-right"></i> Check-in';
            } else {
                // Aplicar check-in
                card.classList.add('bg-success-light');
                // Remover otras clases de color si existen
                card.classList.remove('bg-primary-light');
                this.innerHTML = '<i class="bi bi-x-circle"></i> Cancelar check-in';
            }
        });
    });
    
    // Añadir evento a los botones de check-out
    checkOutButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault(); 
            // Obtener la tarjeta completa (card)
            const card = this.closest('.card');            
            // Verificar si ya está en estado de check-out
            if (card.classList.contains('bg-primary-light')) {
                // Cancelar check-out
                card.classList.remove('bg-primary-light');
                this.innerHTML = '<i class="bi bi-box-arrow-right"></i> Check-out';
            } else {
                // Aplicar check-out
                card.classList.add('bg-primary-light');
                // Remover otras clases de color si existen
                card.classList.remove('bg-success-light');
                this.innerHTML = '<i class="bi bi-x-circle"></i> Cancelar check-out';
            }
        });
    });
    
    // La función processCancelBooking ha sido reemplazada por updateBookingStatus
    
    // Añadir evento a los botones de cancelar
    cancelButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Obtener el ID de la reserva
            const bookingId = this.getAttribute('data-booking-id');
            if (!bookingId) {
                console.error('No se encontró el ID de la reserva');
                return;
            }
            
            // Usar el modal unificado para confirmar la cancelación
            showConfirmModal(bookingId, 'cancelled', '¿Estás seguro de que deseas cancelar esta reserva?');
        });
    });
});
