SET NAMES utf8mb4;

-- Insertar 14 usuarios administradores
INSERT INTO users (first_name, last_name, email, password, phone, city_id, role)
VALUES
('Hotel', 'GranPalacio', 'hotelgranpalacio@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000001', 1, 'admin'),
('Hotel', 'Plaza Real', 'hotelplazareal@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000002', 1, 'admin'),
('Hotel', 'Jardines del Retiro', 'hoteljardinesdelretiro@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000003', 1, 'admin'),
('Hotel', 'Boutique Sol', 'hotelboutiquesol@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000004', 1, 'admin'),
('Hotel', 'Central Palace', 'hotelcentralpalace@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000005', 1, 'admin'),
('Hotel', 'Vista Norte', 'hotelvistanorte@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000005', 1, 'admin'),
-- Apartamentos
('Apartamento', 'Deluxe Malasaña', 'apartamentodeluxemalasaña@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000006', 1, 'admin'),
('Ático', 'Chic', 'aticochic@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000006', 1, 'admin'),
-- Hostel
('Hostel', 'Bohemio La Latina', 'hostelbohemiolalatina@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000007', 1, 'admin'),
('Hostel', 'Urban Art Lavapiés', 'hostelurbanartlavapies@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000008', 1, 'admin'),
-- Cabaña
('Cabaña', 'Bosque Encantado', 'cabañabosqueencantado@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000009', 1, 'admin'),
('Cabaña', 'Aventura', 'cabañaaventura@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000010', 1, 'admin'),
-- Villa
('Villa', 'La Moraleja', 'villalamoraleja@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000011', 1, 'admin'),
('Villa', 'Pozuelo de Alarcon', 'villapozuelodealarcon@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600000012', 1, 'admin');

-- Insertar usuarios por defecto (contraseña es hash de Test1234)
INSERT INTO users (first_name, last_name, email, password, phone, city_id) VALUES 
('Pepe', 'Viyuela', 'pepeViyuela@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600123456', 1),
('Paco', 'Mateo', 'pacomateo@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600654321', 1),
('Juan', 'López', 'juanlopez@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600987123', 1),
('Laura', 'Martín', 'laura.martin@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '600987654', 2);

INSERT INTO users (user_id, first_name, last_name, email, password, phone, city_id) VALUES 
(999, 'Test', 'User', 'test@gmail.com', '$2y$10$Ehy13IapFxRppvdHw/jtoOGTpDVr5kJMveAm.f7OOFA9nFmoZPIV6', '666777888', 1);


