SET NAMES utf8mb4;

-- Relacionar amenities con alojamientos
INSERT INTO accommodation_amenities (accommodation_id, amenity_id) VALUES 
-- Hotel Gran Palacio
(1, 1),  -- WiFi
(1, 2),  -- Piscina
(1, 5),  -- Gimnasio
(1, 9),  -- Spa
(1, 10), -- Restaurante
(1, 11), -- Bar
(1, 12), -- Recepción 24h
(1, 13), -- Caja fuerte

-- Hotel Plaza Real
(2, 1),  -- WiFi
(2, 10), -- Restaurante
(2, 11), -- Bar
(2, 6),  -- Parking privado
(2, 12), -- Recepción 24h
(2, 14), -- TV por cable

-- Hotel Jardines del Retiro
(3, 1),  -- WiFi
(3, 3),  -- Desayuno incluido
(3, 10), -- Restaurante
(3, 8),  -- Pet friendly
(3, 13), -- Caja fuerte
(3, 15), -- Terraza con vistas

-- Hotel Boutique Sol
(4, 1),  -- WiFi
(4, 4),  -- Aire acondicionado
(4, 7),  -- Servicio de habitaciones
(4, 14), -- TV por cable
(4, 15), -- Terraza con vistas

-- Hotel Central Palace
(5, 1),  -- WiFi
(5, 5),  -- Gimnasio
(5, 10), -- Restaurante
(5, 6),  -- Parking privado
(5, 12), -- Recepción 24h
(5, 13), -- Caja fuerte

-- Hotel Vista Norte
(6, 1),  -- WiFi
(6, 6),  -- Parking privado
(6, 4),  -- Aire acondicionado
(6, 11), -- Bar
(6, 12), -- Recepción 24h

-- Apartamento Deluxe Malasaña
(7, 1),  -- WiFi
(7, 4),  -- Aire acondicionado
(7, 14), -- TV por cable
(7, 13), -- Caja fuerte
(7, 15), -- Terraza con vistas

-- Ático Chic Paseo de la Castellana
(8, 1),  -- WiFi
(8, 3),  -- Desayuno incluido
(8, 4),  -- Aire acondicionado
(8, 10), -- Restaurante
(8, 15), -- Terraza con vistas

-- Hostel Bohemio La Latina
(9, 1),  -- WiFi
(9, 3),  -- Desayuno incluido
(9, 8),  -- Pet friendly
(9, 11), -- Bar
(9, 12), -- Recepción 24h

-- Hostel Urban Art Lavapiés
(10, 1),  -- WiFi
(10, 4),  -- Aire acondicionado
(10, 8),  -- Pet friendly
(10, 11), -- Bar
(10, 14), -- TV por cable

-- Cabaña Bosque Encantado
(11, 1),  -- WiFi
(11, 4),  -- Aire acondicionado
(11, 7),  -- Servicio de habitaciones
(11, 13), -- Caja fuerte
(11, 15), -- Terraza con vistas

-- Cabaña Río Silencioso
(12, 1),  -- WiFi
(12, 4),  -- Aire acondicionado
(12, 3),  -- Desayuno incluido
(12, 7),  -- Servicio de habitaciones
(12, 15), -- Terraza con vistas

-- Villa El Encinar
(13, 1),  -- WiFi
(13, 2),  -- Piscina
(13, 4),  -- Aire acondicionado
(13, 6),  -- Parking privado
(13, 15), -- Terraza con vistas

-- Villa La Moraleja
(14, 1),  -- WiFi
(14, 2),  -- Piscina
(14, 4),  -- Aire acondicionado
(14, 6),  -- Parking privado
(14, 10), -- Restaurante
(14, 13), -- Caja fuerte

-- Apartamento Gaudí View (Barcelona) - ID 15
(15, 1),  -- WiFi
(15, 4),  -- Aire acondicionado
(15, 14), -- TV por cable
(15, 15), -- Terraza con vistas

-- Hotel Barcelona Moderno - ID 16
(16, 1),  -- WiFi
(16, 2),  -- Piscina
(16, 3),  -- Desayuno incluido
(16, 4),  -- Aire acondicionado
(16, 5),  -- Gimnasio
(16, 10), -- Restaurante
(16, 11), -- Bar
(16, 12), -- Recepción 24h

-- Hostel Ciutat Vella (Valencia) - ID 17
(17, 1),  -- WiFi
(17, 4),  -- Aire acondicionado
(17, 8),  -- Pet friendly (según descripción de ambiente acogedor)

-- Apartamento Valencia Beach - ID 18
(18, 1),  -- WiFi
(18, 4),  -- Aire acondicionado
(18, 6),  -- Parking privado
(18, 14), -- TV por cable
(18, 15), -- Terraza con vistas

-- Villa Triana Jardines (Sevilla) - ID 19
(19, 1),  -- WiFi
(19, 2),  -- Piscina
(19, 4),  -- Aire acondicionado
(19, 6),  -- Parking privado
(19, 10), -- Restaurante (cocina gourmet)
(19, 15), -- Terraza con vistas

-- Hostel Sevilla Centro - ID 20
(20, 1),  -- WiFi
(20, 4),  -- Aire acondicionado
(20, 12), -- Recepción 24h

-- Hotel Pilar Central (Zaragoza) - ID 21
(21, 1),  -- WiFi
(21, 3),  -- Desayuno incluido
(21, 4),  -- Aire acondicionado
(21, 5),  -- Gimnasio
(21, 10), -- Restaurante
(21, 12), -- Recepción 24h
(21, 13), -- Caja fuerte

-- Cabaña Río Ebro (Zaragoza) - ID 22
(22, 1),  -- WiFi
(22, 8),  -- Pet friendly (por entorno natural)

-- Cabaña El Bosque del Sur (Málaga) - ID 23
(23, 1),  -- WiFi
(23, 8),  -- Pet friendly (por entorno natural)

-- Hotel Málaga Centro - ID 24
(24, 1),  -- WiFi
(24, 3),  -- Desayuno incluido
(24, 4),  -- Aire acondicionado
(24, 10), -- Restaurante
(24, 11), -- Bar
(24, 12), -- Recepción 24h

-- Hotel Río Segura (Murcia) - ID 25
(25, 1),  -- WiFi
(25, 4),  -- Aire acondicionado
(25, 5),  -- Gimnasio
(25, 10), -- Restaurante
(25, 12), -- Recepción 24h

-- Apartamento Murcia Jardín - ID 26
(26, 1),  -- WiFi
(26, 2),  -- Piscina (comunitaria)
(26, 4),  -- Aire acondicionado
(26, 6),  -- Parking privado

-- Apartamento Mirador de la Alhambra (Granada) - ID 27
(27, 1),  -- WiFi
(27, 4),  -- Aire acondicionado
(27, 14), -- TV por cable
(27, 15), -- Terraza con vistas

-- Villa Sierra Nevada (Granada) - ID 28
(28, 1),  -- WiFi
(28, 2),  -- Piscina
(28, 4),  -- Aire acondicionado
(28, 6),  -- Parking privado
(28, 10), -- Restaurante (chef privado)
(28, 15), -- Terraza con vistas

-- Hostel Surf & Sun (Las Palmas) - ID 29
(29, 1),  -- WiFi
(29, 4),  -- Aire acondicionado
(29, 8),  -- Pet friendly (ambiente juvenil)

-- Apartamento Vegueta (Las Palmas) - ID 30
(30, 1),  -- WiFi
(30, 4),  -- Aire acondicionado
(30, 6),  -- Parking privado
(30, 14), -- TV por cable

-- Villa Montaña Vasca (Bilbao) - ID 31
(31, 1),  -- WiFi
(31, 2),  -- Piscina
(31, 4),  -- Aire acondicionado
(31, 6),  -- Parking privado
(31, 10), -- Restaurante (chef privado)
(31, 15), -- Terraza con vistas

-- Hostel Bilbao Arte - ID 32
(32, 1),  -- WiFi
(32, 4),  -- Aire acondicionado
(32, 12), -- Recepción 24h

-- Apartamento Costa Blanca View (Alicante) - ID 33
(33, 1),  -- WiFi
(33, 4),  -- Aire acondicionado
(33, 6),  -- Parking privado
(33, 14), -- TV por cable
(33, 15), -- Terraza con vistas

-- Hotel Alicante Golf - ID 34
(34, 1),  -- WiFi
(34, 2),  -- Piscina
(34, 3),  -- Desayuno incluido
(34, 4),  -- Aire acondicionado
(34, 5),  -- Gimnasio
(34, 9),  -- Spa
(34, 10), -- Restaurante
(34, 12), -- Recepción 24h

-- Hotel Patio Andaluz (Córdoba) - ID 35
(35, 1),  -- WiFi
(35, 3),  -- Desayuno incluido
(35, 4),  -- Aire acondicionado
(35, 12), -- Recepción 24h

-- Cabaña Sierra Córdoba - ID 36
(36, 1),  -- WiFi
(36, 8),  -- Pet friendly (entorno natural)

-- Hostel Universidad Central (Valladolid) - ID 37
(37, 1),  -- WiFi
(37, 4),  -- Aire acondicionado
(37, 12), -- Recepción 24h

-- Hotel Valladolid Histórico - ID 38
(38, 1),  -- WiFi
(38, 3),  -- Desayuno incluido
(38, 4),  -- Aire acondicionado
(38, 10), -- Restaurante
(38, 12), -- Recepción 24h

-- Villa Rías Baixas (Vigo) - ID 39
(39, 1),  -- WiFi
(39, 2),  -- Piscina
(39, 4),  -- Aire acondicionado
(39, 6),  -- Parking privado
(39, 10), -- Restaurante
(39, 15), -- Terraza con vistas

-- Apartamento Vigo Mar - ID 40
(40, 1),  -- WiFi
(40, 4),  -- Aire acondicionado
(40, 6),  -- Parking privado
(40, 14), -- TV por cable

-- Cabaña El Mirador Asturiano (Gijón) - ID 41
(41, 1),  -- WiFi
(41, 8),  -- Pet friendly (entorno natural)

-- Hotel Gijón Playa - ID 42
(42, 1),  -- WiFi
(42, 2),  -- Piscina
(42, 3),  -- Desayuno incluido
(42, 4),  -- Aire acondicionado
(42, 5),  -- Gimnasio
(42, 9),  -- Spa
(42, 10), -- Restaurante
(42, 12); -- Recepción 24h