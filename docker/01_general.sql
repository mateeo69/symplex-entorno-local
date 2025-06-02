USE mi_basedatos;
SET NAMES utf8mb4;

-- Script de creación de la base de datos para una plataforma de reservas de alojamientos.
-- Incluye tablas para usuarios, alojamientos, habitaciones, reservas, reseñas y servicios disponibles.

CREATE TABLE cities (
    city_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    country VARCHAR(100),
    lat DECIMAL(10,7),
    lon DECIMAL(10,7)
);

CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(100),
    last_name VARCHAR(100),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255),
    phone VARCHAR(20),
    city_id INT,
    role ENUM('client', 'admin') DEFAULT 'client',
    FOREIGN KEY (city_id) REFERENCES cities(city_id)
);

CREATE TABLE accommodations (
    accommodation_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    description TEXT,
    address VARCHAR(255),
    city_id INT,
    type ENUM('hotel', 'apartment', 'hostel', 'cabin', 'villa'),
    image_url VARCHAR(255),
    owner_id INT,
    FOREIGN KEY (city_id) REFERENCES cities(city_id),
    FOREIGN KEY (owner_id) REFERENCES users(user_id)
);

CREATE TABLE rooms (
    room_id INT AUTO_INCREMENT PRIMARY KEY,
    accommodation_id INT,
    room_type ENUM('single', 'double', 'family', 'suite','complete'),
    capacity INT,
    price DECIMAL(10,2),
    is_available BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(accommodation_id)
);

CREATE TABLE bookings (
    booking_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    room_id INT,
    check_in DATE,
    check_out DATE,
    booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    status ENUM('pending', 'confirmed', 'completed', 'cancelled') DEFAULT 'pending',
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (room_id) REFERENCES rooms(room_id)
);

CREATE TABLE reviews (
    review_id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    accommodation_id INT,
    rating DECIMAL(2,1) CHECK (rating BETWEEN 0 AND 10),
    comment TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES users(user_id),
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(accommodation_id)
);

CREATE TABLE amenities (
    amenity_id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100)
);

CREATE TABLE accommodation_amenities (
    accommodation_id INT,
    amenity_id INT,
    PRIMARY KEY (accommodation_id, amenity_id),
    FOREIGN KEY (accommodation_id) REFERENCES accommodations(accommodation_id),
    FOREIGN KEY (amenity_id) REFERENCES amenities(amenity_id)
);
