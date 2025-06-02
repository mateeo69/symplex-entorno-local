<?php
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['user']) || $_SESSION['user']['role'] !== 'admin') {
        header('Location: index.php');
        exit;
    }

    require_once __DIR__ . '/../../app/models/Booking.php';
    require_once __DIR__ . '/../../app/models/Accommodation.php';
    
    // Obtener el ID del administrador actual y pescar sus alojamientos
    $admin_id = $_SESSION['user']['user_id'];

    $accModel = new Accommodation();
    $accommodations = $accModel->getOwnerAccommodations($admin_id);

    // Verificar si hay parámetros de búsqueda por fecha
    $start_date = isset($_GET['start_date']) && !empty($_GET['start_date']) ? $_GET['start_date'] : null;
    $end_date = isset($_GET['end_date']) && !empty($_GET['end_date']) ? $_GET['end_date'] : null;
    $is_pending_filtering = isset($_GET['pending']) && $_GET['pending'] == 1;
    $is_date_filtering = $start_date && $end_date;
    
    // Obtener los alojamientos que pertenecen al administrador
    try {
        $bookingModel = new Booking();
        $all_bookings = $bookingModel->getBookingsByOwner($admin_id, $start_date, $end_date, $is_pending_filtering);
    } catch (Exception $e) {
        $error_message = "Error al cargar las reservas: " . $e->getMessage();
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Hotel - Symplex</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.css" rel="stylesheet"> <!-- FullCalendar CSS -->

    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm">
    <div class="container">
        <div class="d-flex justify-content-between align-items-center w-100">
            <a class="navbar-brand d-flex align-items-center" href="">
                <img src="assets/img/nuevologoSymplex.png" alt="Logo Symplex" class="logo-img me-2" />
            </a>
            <div class="text-center mx-auto">
                <span>Bienvenido, <strong><?= htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name'] ?? 'Propietario') ?></strong></span>
            </div>
            <a href="index.php?action=logout" class="btn btn-outline-danger">Cerrar sesión</a>
        </div>
    </div>
</nav>

    <div class="container mt-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h2><?= $is_pending_filtering ? 'Reservas Pendientes de Aceptación' : 'Próximas Reservas' ?></h2>
                <?php if ($is_date_filtering): ?>
                <div class="mt-2">
                    <span class="badge bg-info">
                        <i class="bi bi-calendar-range"></i> 
                        Mostrando reservas con check-in entre <?= date('d/m/Y', strtotime($start_date)) ?> y <?= date('d/m/Y', strtotime($end_date)) ?>
                    </span>
                    <a href="index.php?action=admin" class="btn btn-sm btn-outline-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Quitar filtro
                    </a>
                </div>
                <?php endif; ?>
                
                <?php if ($is_pending_filtering): ?>
                <div class="mt-2">
                    <span class="badge bg-warning text-dark">
                        <i class="bi bi-hourglass-split"></i> 
                        Mostrando reservas pendientes de aceptación
                    </span>
                    <a href="index.php?action=admin" class="btn btn-sm btn-outline-secondary ms-2">
                        <i class="bi bi-x-circle"></i> Quitar filtro
                    </a>
                </div>
                <?php endif; ?>
            </div>
            <div class="d-flex">
                <a href="index.php?action=admin&pending=1" class="btn btn-outline-warning me-2">
                    <i class="bi bi-hourglass-split"></i> Pendientes de aceptación
                </a>
                <button class="btn btn-outline-primary me-2" data-bs-toggle="modal" data-bs-target="#calendarModal">
                    <i class="bi bi-calendar"></i> Calendario
                </button>
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#availabilityModal">
                    <i class="bi bi-calendar2-check"></i> Ver Disponibilidad
                </button>
            </div>
        </div>
        


        <?php if (isset($error_message)): ?>
            <div class="alert alert-danger">
                <?= htmlspecialchars($error_message) ?>
            </div>
        <?php elseif (empty($accommodations)): ?>
            <div class="alert alert-info">
                No tienes ningún hotel registrado en el sistema.
            </div>
        <?php elseif (empty($all_bookings)): ?>
            <div class="alert alert-info">
                No hay reservas disponibles para tus hoteles en este momento.
            </div>
        <?php else: ?>
            <?php 
            // Definir el número de reservas por página
            $reservas_por_pagina = 3;
            
            // Calcular el número total de páginas
            $total_reservas = count($all_bookings);
            $total_paginas = ceil($total_reservas / $reservas_por_pagina);
            ?>
            
            <div class="row" id="reservas-container">
                <?php foreach ($all_bookings as $index => $booking): 
                    // Determinar si esta reserva debe estar visible inicialmente (solo las primeras 3)
                    $visible = $index < $reservas_por_pagina ? '' : 'd-none';
                    $pagina = floor($index / $reservas_por_pagina) + 1;
                ?>
                    <div class="col-12 mb-3 reserva-item <?= $visible ?>" data-pagina="<?= $pagina ?>">
                        <div class="card shadow-sm">
                            <div class="card-header bg-white d-flex justify-content-between align-items-center">
                                <h6 class="card-title mb-0">Hotel: <?= htmlspecialchars($booking['hotel_name']) ?></h6>
                                <?php 
                                $status_class = [
                                    'pending' => 'bg-warning',
                                    'confirmed' => 'bg-primary',
                                    'completed' => 'bg-success',
                                    'cancelled' => 'bg-danger'
                                ];
                                
                                $status_text = [
                                    'pending' => 'Pendiente',
                                    'confirmed' => 'Confirmada',
                                    'completed' => 'Completada',
                                    'cancelled' => 'Cancelada'
                                ];
                                ?>
                                <span class="badge <?= $status_class[$booking['status']] ?? 'bg-secondary' ?>">
                                    <?= $status_text[$booking['status']] ?? $booking['status'] ?>
                                </span>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5 class="card-title"><?= htmlspecialchars($booking['first_name'] . ' ' . $booking['last_name']) ?></h5>
                                        <p class="card-text mb-2">
                                            <i class="bi bi-envelope text-primary"></i> 
                                            <a href="mailto:<?= htmlspecialchars($booking['email']) ?>">
                                                <?= htmlspecialchars($booking['email']) ?>
                                            </a>
                                        </p>
                                        <p class="card-text">
                                            <i class="bi bi-telephone text-primary"></i> 
                                            <?= htmlspecialchars($booking['phone']) ?>
                                        </p>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="d-flex align-items-center mb-2">
                                            <i class="bi bi-calendar-check text-success me-2"></i>
                                            <span>Check-in: <?= date('d/m/Y', strtotime($booking['check_in'])) ?></span>
                                        </div>
                                        <div class="d-flex align-items-center">
                                            <i class="bi bi-calendar-x text-danger me-2"></i>
                                            <span>Check-out: <?= date('d/m/Y', strtotime($booking['check_out'])) ?></span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-end">
                                        <p><strong>Habitación:</strong> <?= htmlspecialchars($booking['room_id']) ?></p>
                                        <p><strong>Tipo:</strong> 
                                            <?php 
                                            $room_type_map = [
                                                'single' => 'Individual',
                                                'double' => 'Doble',
                                                'family' => 'Familiar',
                                                'suite' => 'Suite'
                                            ];
                                            echo htmlspecialchars($room_type_map[$booking['room_type']] ?? $booking['room_type']);
                                            ?>
                                        </p>
                                        <p><strong>Estado:</strong> 
                                            <span class="text-secondary data-status-text">
                                                <?= $status_text[$booking['status']] ?? $booking['status'] ?>
                                            </span>
                                        </p>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-12 text-end">
                                        <?php if ($booking['status'] === 'pending'): ?>
                                            <!-- Botones para reservas pendientes: Aceptar y Denegar -->
                                            <button class="btn btn-warning btn-sm" data-booking-id="<?= $booking['booking_id'] ?>" data-action="accept">
                                                <i class="bi bi-check-circle"></i> Aceptar
                                            </button>
                                            <button class="btn btn-danger btn-sm" data-booking-id="<?= $booking['booking_id'] ?>" data-action="deny">
                                                <i class="bi bi-x-circle"></i> Denegar
                                            </button>
                                        <?php else: ?>
                                            <!-- Botones normales para reservas no pendientes -->
                                            <?php if ($booking['status'] === 'confirmed'): ?>
                                                <button class="btn btn-success btn-sm" data-booking-id="<?= $booking['booking_id'] ?>" data-action="checkin">
                                                    <i class="bi bi-box-arrow-in-right"></i> Check-in
                                                </button>
                                            <?php endif; ?>
                                            
                                            <?php if ($booking['status'] !== 'cancelled' && $booking['status'] !== 'completed'): ?>
                                                <button class="btn btn-primary btn-sm" data-booking-id="<?= $booking['booking_id'] ?>" data-action="checkout">
                                                    <i class="bi bi-box-arrow-right"></i> Check-out
                                                </button>
                                            <?php endif; ?>
                                            
                                            <?php if ($booking['status'] !== 'completed' && $booking['status'] !== 'cancelled'): ?>
                                                <button class="btn btn-danger btn-sm" data-booking-id="<?= $booking['booking_id'] ?>" data-action="cancel">
                                                    <i class="bi bi-x-circle"></i> Cancelar
                                                </button>
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <?php if ($total_paginas > 1): ?>
            <!-- Paginación -->
            <nav aria-label="Navegación de reservas" class="mt-4">
                <ul class="pagination justify-content-center" id="paginacion">
                    <li class="page-item disabled" id="pagina-anterior">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
                    </li>
                    <?php for ($i = 1; $i <= $total_paginas; $i++): ?>
                        <li class="page-item <?= $i === 1 ? 'active' : '' ?>" data-pagina="<?= $i ?>">
                            <a class="page-link" href="#"><?= $i ?></a>
                        </li>
                    <?php endfor; ?>
                    <li class="page-item <?= $total_paginas <= 1 ? 'disabled' : '' ?>" id="pagina-siguiente">
                        <a class="page-link" href="#">Siguiente</a>
                    </li>
                </ul>
            </nav>
            <?php endif; ?>
        <?php endif; ?>
    </div>

    <!-- El modal de cancelación ha sido reemplazado por el modal de confirmación de acciones -->
    
    <!-- Modal de confirmación para acciones de reserva -->
    <div class="modal fade" id="confirmActionModal" tabindex="-1" aria-labelledby="confirmActionModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmActionModalLabel">Confirmar acción</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p id="confirmActionMessage"></p>
                    <input type="hidden" id="confirmActionBookingId">
                    <input type="hidden" id="confirmActionType">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-primary" id="confirmActionButton">Confirmar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal del calendario para seleccionar rango de fechas -->
    <div class="modal fade" id="calendarModal" tabindex="-1" aria-labelledby="calendarModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="calendarModalLabel">Seleccionar rango de fechas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="startDate" class="form-label">Fecha de inicio</label>
                        <input type="date" class="form-control" id="startDate" name="start_date" required>
                    </div>
                    <div class="mb-3">
                        <label for="endDate" class="form-label">Fecha de fin</label>
                        <input type="date" class="form-control" id="endDate" name="end_date" required>
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-primary" id="applyFilterButton">Aplicar filtro</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

        <!-- Modal de disponibilidad -->
    <div class="modal fade" id="availabilityModal" tabindex="-1" aria-labelledby="availabilityModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="availabilityModalLabel">Disponibilidad de habitaciones</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
            <div id="calendar-container"></div>
        </div>
        </div>
    </div>
    </div>


    <!-- Scripts de Bootstrap y dependencias (una sola versión) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Script principal de la aplicación (incluye admin.js) -->
    <script src="index.php?action=adminJs"></script>

    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const calendarEl = document.getElementById('calendar-container');
        let calendar; // Declare in outer scope

        // Initialize the calendar but don't render it yet
        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            locale: 'es',
            height: 500,
            events: [
                <?php foreach ($all_bookings as $booking): ?>
                {
                    title: 'Habitación <?= htmlspecialchars($booking["room_id"]) ?>',
                    start: '<?= $booking["check_in"] ?>',
                    end: '<?= date("Y-m-d", strtotime($booking["check_out"] . " +1 day")) ?>',
                    color: 'red'
                },
                <?php endforeach; ?>
            ],
            dayCellDidMount: function (info) {
                const dateStr = info.date.toISOString().split('T')[0];
                const isBooked = calendar.getEvents().some(ev =>
                    ev.startStr <= dateStr && dateStr < ev.endStr
                );
                if (!isBooked) {
                    info.el.style.backgroundColor = '#d4edda';
                }
            }
        });

        // Render the calendar only when the modal is shown to avoid issues with the modal's dimensions
        const availabilityModal = document.getElementById('availabilityModal');
        availabilityModal.addEventListener('shown.bs.modal', function () {
            calendar.render();
        });
    });
    </script>


    <!-- FullCalendar JS -->
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.8/index.global.min.js"></script>

</body>
</html>