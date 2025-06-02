# Proyecto PHP con Docker (Apache + MySQL + phpMyAdmin)

**SYMPLEX PROJECT**

---

## Descripción del proyecto

Aplicación web para gestión de reservas y alojamientos. Proyecto final estudiantes DAW.
Permite a los usuarios registrarse, iniciar sesión, buscar alojamientos, reservar, y administrar sus reservas.
Utiliza PHP para el backend, JavaScript para la interacción en frontend, y Docker para contenerización con Apache, MySQL y phpMyAdmin.

La imagen Docker personalizada usa PHP 8.3 con Apache configurado para servir desde /var/www/html/public, con extensiones PHP necesarias instaladas (zip, mysqli, pdo_mysql) y soporte para envío de correos usando msmtp y MailHog.

---

## Requisitos

- [Docker](https://www.docker.com/get-started)  

---

# Instalación

1. Clona el repositorio y accede al directorio del proyecto:

2. Construye y levanta los contenedores Docker:
    
    ```bash
    docker-compose up -d --build
    ```

    Si se hace desde windows, Docker debe estar abierto y las credenciales de la misma introducidas:
    ```bash
    docker logout
    docker login -u <nombre-de-usuario>
    ```
    Introduce contraseña, y realiza el comando de contrucción.

3. Accede a la aplicación desde el navegador:

    - http://localhost:8080 para la aplicación  
    - http://localhost:8081 para phpMyAdmin 
    - http://localhost:8025 para mailhog

Después de iniciar los contenedores, la aplicación estará disponible para navegación, búsqueda y reserva de alojamientos.

# Detalles técnicos y automatizaciones

## Base de la imagen Docker
- `php:8.3-apache`

## Extensiones PHP instaladas
- `zip` para manejo de archivos comprimidos
- `mysqli`, `pdo`, `pdo_mysql` para conexión con base de datos MySQL

## Herramientas y servicios instalados
- `git` para control de versiones dentro del contenedor (opcional)
- `unzip` y `zip` para manipulación de archivos
- `msmtp` y `msmtp-mta` para enviar emails desde PHP (configurado para usar MailHog durante desarrollo)

## Configuración Apache
- `DocumentRoot` cambiado a `/var/www/html/public` para una estructura de proyecto más limpia
- Módulo `rewrite` habilitado para URLs amigables y redirecciones

## Gestión de dependencias PHP
- Composer instalado globalmente para gestionar librerías y dependencias
- Se ejecuta `composer install --no-dev --optimize-autoloader` durante la construcción para optimizar la carga

## Correo electrónico
- Archivo `msmtp.conf` con configuración para reenviar emails a MailHog (fácil de cambiar para producción)
- Archivo `mailhog.ini` para habilitar configuración en PHP (smtp, mail settings)

## Volúmenes y permisos
- Se establecen permisos seguros en archivos de configuración sensibles (ej. `msmtprc`)

## Características

- Registro y login de usuarios con roles (usuario/admin).
- Búsqueda avanzada de alojamientos con filtros y gestión de disponibilidad.
- Visualización de detalles del alojamiento, incluyendo servicios y valoraciones.
- Creación y administración de reservas para usuarios autenticados.
- Panel de administración accesible para usuarios con rol admin.
- Gestión de alojamientos y usuarios vía base de datos (phpMyAdmin).
- Envío de correo electrónico al registrar propietarios (usando PHPMailer y mailhog en Docker).

# Endpoints y rutas principales

| Método | Ruta                            | Descripción                                 |
|--------|--------------------------------|---------------------------------------------|
| GET    | `/index.php?action=register`   | Mostrar formulario de registro              |
| POST   | `/index.php?action=register`   | Registrar nuevo usuario                      |
| GET    | `/index.php?action=login`      | Mostrar formulario de login                  |
| POST   | `/index.php?action=login`      | Autenticar usuario                           |
| GET    | `/index.php?action=logout`     | Cerrar sesión                               |
| GET    | `/index.php?action=home`       | Página principal / listado de alojamientos  |
| POST   | `/index.php?action=search`     | Buscar alojamientos con filtros              |
| GET    | `/index.php?action=details&id=ID` | Mostrar detalles de alojamiento         |
| POST   | `/index.php?action=createBooking` | Crear una nueva reserva (solo usuarios logueados) |
| GET    | `/index.php?action=bookings`   | Listar reservas del usuario logueado         |
| GET    | `/index.php?action=admin`      | Panel de administración (solo admins)        |
| POST   | `/index.php?action=contact`    | Registro de propietario y envío de credenciales por email |

## Endpoints para scripts JS

| Método | Ruta                      | Descripción                    |
|--------|---------------------------|--------------------------------|
| GET    | `/index.php?action=registerJs` | JS para página de registro    |
| GET    | `/index.php?action=homeJs`     | JS para página principal      |
| GET    | `/index.php?action=detailsJs`  | JS para página detalles       |

Para detener y eliminar contenedores y volúmenes:

    ```bash
    docker-compose up -d --build
    ```

# Contribuidores

 - @ipricez – Paco Fernández

 - @GuillermoModesto – Guillermo Modesto

 - @mateeo69 – Alejandro Mateo

 - @Jose-Snchz13 – Jose Sanchez
