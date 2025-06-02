SET NAMES utf8mb4;

-- Insertar 4 habitaciones (una de cada tipo) para cada alojamiento del 1 al 14
INSERT INTO rooms (accommodation_id, room_type, capacity, price, is_available) VALUES
-- Alojamiento 1
(1, 'single', 1, 78.00, TRUE),
(1, 'double', 2, 132.00, TRUE),
(1, 'family', 4, 198.00, TRUE),
(1, 'suite', 2, 275.00, TRUE),

-- Alojamiento 2
(2, 'single', 1, 85.00, TRUE),
(2, 'double', 2, 125.00, TRUE),
(2, 'family', 4, 210.00, TRUE),
(2, 'suite', 2, 260.00, TRUE),

-- Alojamiento 3
(3, 'single', 1, 75.00, TRUE),
(3, 'double', 2, 118.00, TRUE),
(3, 'family', 4, 190.00, TRUE),
(3, 'suite', 2, 240.00, TRUE),

-- Alojamiento 4
(4, 'single', 1, 82.00, TRUE),
(4, 'double', 2, 130.00, TRUE),
(4, 'family', 4, 205.00, TRUE),
(4, 'suite', 2, 255.00, TRUE),

-- Alojamiento 5
(5, 'single', 1, 79.00, TRUE),
(5, 'double', 2, 119.00, TRUE),
(5, 'family', 4, 199.00, TRUE),
(5, 'suite', 2, 245.00, TRUE),

-- Alojamiento 6
(6, 'single', 1, 80.00, TRUE),
(6, 'double', 2, 121.00, TRUE),
(6, 'family', 4, 202.00, TRUE),
(6, 'suite', 2, 248.00, TRUE),

-- Alojamiento 7
(7, 'single', 1, 77.00, TRUE),
(7, 'double', 2, 123.00, TRUE),
(7, 'family', 4, 195.00, TRUE),
(7, 'suite', 2, 250.00, TRUE),

-- Alojamiento 8
(8, 'single', 1, 83.00, TRUE),
(8, 'double', 2, 127.00, TRUE),
(8, 'family', 4, 208.00, TRUE),
(8, 'suite', 2, 263.00, TRUE),

-- Alojamiento 9
(9, 'single', 1, 72.00, TRUE),
(9, 'double', 2, 116.00, TRUE),
(9, 'family', 4, 185.00, TRUE),
(9, 'suite', 2, 230.00, TRUE),

-- Alojamiento 10
(10, 'single', 1, 81.00, TRUE),
(10, 'double', 2, 128.00, TRUE),
(10, 'family', 4, 212.00, TRUE),
(10, 'suite', 2, 270.00, TRUE),

-- Alojamiento 11
(11, 'single', 1, 74.00, TRUE),
(11, 'double', 2, 122.00, TRUE),
(11, 'family', 4, 200.00, TRUE),
(11, 'suite', 2, 235.00, TRUE),

-- Alojamiento 12
(12, 'single', 1, 79.00, TRUE),
(12, 'double', 2, 120.00, TRUE),
(12, 'family', 4, 201.00, TRUE),
(12, 'suite', 2, 255.00, TRUE),

-- Alojamiento 13
(13, 'single', 1, 90.00, TRUE),
(13, 'double', 2, 135.00, TRUE),
(13, 'family', 4, 220.00, TRUE),
(13, 'suite', 2, 280.00, TRUE),

-- Alojamiento 14
(14, 'single', 1, 88.00, TRUE),
(14, 'double', 2, 130.00, TRUE),
(14, 'family', 4, 215.00, TRUE),
(14, 'suite', 2, 270.00, TRUE);

INSERT INTO rooms (accommodation_id, room_type, capacity, price, is_available) VALUES
-- Alojamiento 15
(15, 'single', 1, 88.00, TRUE),
(15, 'double', 2, 150.00, TRUE),
(15, 'family', 4, 215.00, TRUE),
(15, 'suite', 2, 270.00, TRUE),

-- Alojamiento 16
(16, 'single', 1, 88.00, TRUE),
(16, 'double', 2, 150.00, TRUE),
(16, 'family', 4, 215.00, TRUE),
(16, 'suite', 2, 270.00, TRUE),
-- Alojamiento 17
(17, 'single', 1, 88.00, TRUE),
(17, 'double', 2, 150.00, TRUE),
(17, 'family', 4, 215.00, TRUE),
(17, 'suite', 2, 270.00, TRUE),
-- Alojamiento 18
(18, 'single', 1, 88.00, TRUE),
(18, 'double', 2, 150.00, TRUE),
(18, 'family', 4, 215.00, TRUE),
(18, 'suite', 2, 270.00, TRUE),
-- Alojamiento 19
(19, 'single', 1, 90.00, TRUE),
(19, 'double', 2, 155.00, TRUE),
(19, 'family', 4, 220.00, TRUE),
(19, 'suite', 3, 280.00, TRUE),
-- Alojamiento 20
(20, 'single', 2, 85.00, TRUE),
(20, 'double', 3, 145.00, TRUE),
(20, 'family', 3, 210.00, TRUE),
(20, 'suite', 2, 275.00, TRUE),
-- Alojamiento 21
(21, 'single', 1, 92.00, TRUE),
(21, 'double', 2, 152.00, TRUE),
(21, 'family', 4, 218.00, TRUE),
(21, 'suite', 3, 272.00, TRUE),
-- Alojamiento 22
(22, 'single', 1, 89.00, TRUE),
(22, 'double', 3, 148.00, TRUE),
(22, 'family', 3, 213.00, TRUE),
(22, 'suite', 2, 278.00, TRUE),
-- Alojamiento 23
(23, 'single', 2, 87.00, TRUE),
(23, 'double', 2, 150.00, TRUE),
(23, 'family', 4, 215.00, TRUE),
(23, 'suite', 3, 270.00, TRUE),
-- Alojamiento 24
(24, 'single', 1, 91.00, TRUE),
(24, 'double', 3, 154.00, TRUE),
(24, 'family', 3, 222.00, TRUE),
(24, 'suite', 2, 279.00, TRUE),
-- Alojamiento 25
(25, 'single', 2, 88.00, TRUE),
(25, 'double', 2, 149.00, TRUE),
(25, 'family', 4, 214.00, TRUE),
(25, 'suite', 3, 274.00, TRUE),
-- Alojamiento 26
(26, 'single', 1, 90.00, TRUE),
(26, 'double', 3, 151.00, TRUE),
(26, 'family', 3, 219.00, TRUE),
(26, 'suite', 2, 277.00, TRUE),
-- Alojamiento 27
(27, 'single', 2, 89.00, TRUE),
(27, 'double', 2, 147.00, TRUE),
(27, 'family', 4, 216.00, TRUE),
(27, 'suite', 3, 273.00, TRUE),
-- Alojamiento 28
(28, 'single', 1, 86.00, TRUE),
(28, 'double', 3, 150.00, TRUE),
(28, 'family', 3, 215.00, TRUE),
(28, 'suite', 2, 270.00, TRUE),
-- Alojamiento 29
(29, 'single', 2, 90.00, TRUE),
(29, 'double', 2, 152.00, TRUE),
(29, 'family', 4, 221.00, TRUE),
(29, 'suite', 3, 280.00, TRUE),
-- Alojamiento 30
(30, 'single', 1, 88.00, TRUE),
(30, 'double', 3, 149.00, TRUE),
(30, 'family', 3, 214.00, TRUE),
(30, 'suite', 2, 276.00, TRUE),
-- Alojamiento 31
(31, 'single', 2, 91.00, TRUE),
(31, 'double', 2, 153.00, TRUE),
(31, 'family', 4, 220.00, TRUE),
(31, 'suite', 3, 279.00, TRUE),
-- Alojamiento 32
(32, 'single', 1, 89.00, TRUE),
(32, 'double', 3, 150.00, TRUE),
(32, 'family', 3, 217.00, TRUE),
(32, 'suite', 2, 274.00, TRUE),
-- Alojamiento 33
(33, 'single', 2, 87.00, TRUE),
(33, 'double', 2, 148.00, TRUE),
(33, 'family', 4, 213.00, TRUE),
(33, 'suite', 3, 270.00, TRUE),
-- Alojamiento 34
(34, 'single', 1, 90.00, TRUE),
(34, 'double', 3, 151.00, TRUE),
(34, 'family', 3, 218.00, TRUE),
(34, 'suite', 2, 275.00, TRUE),
-- Alojamiento 35
(35, 'single', 2, 88.00, TRUE),
(35, 'double', 2, 149.00, TRUE),
(35, 'family', 4, 215.00, TRUE),
(35, 'suite', 3, 272.00, TRUE),
-- Alojamiento 36
(36, 'single', 1, 89.00, TRUE),
(36, 'double', 3, 150.00, TRUE),
(36, 'family', 3, 217.00, TRUE),
(36, 'suite', 2, 274.00, TRUE),
-- Alojamiento 37
(37, 'single', 2, 85.00, TRUE),
(37, 'double', 2, 145.00, TRUE),
(37, 'family', 4, 210.00, TRUE),
(37, 'suite', 3, 270.00, TRUE),
-- Alojamiento 38
(38, 'single', 1, 88.00, TRUE),
(38, 'double', 3, 148.00, TRUE),
(38, 'family', 3, 215.00, TRUE),
(38, 'suite', 2, 275.00, TRUE),
-- Alojamiento 39
(39, 'single', 2, 89.00, TRUE),
(39, 'double', 2, 150.00, TRUE),
(39, 'family', 4, 213.00, TRUE),
(39, 'suite', 3, 274.00, TRUE),
-- Alojamiento 40
(40, 'single', 1, 90.00, TRUE),
(40, 'double', 3, 152.00, TRUE),
(40, 'family', 3, 219.00, TRUE),
(40, 'suite', 2, 278.00, TRUE),
-- Alojamiento 41
(41, 'single', 2, 87.00, TRUE),
(41, 'double', 2, 149.00, TRUE),
(41, 'family', 4, 215.00, TRUE),
(41, 'suite', 3, 273.00, TRUE),
-- Alojamiento 42
(42, 'single', 1, 88.00, TRUE),
(42, 'double', 3, 150.00, TRUE),
(42, 'family', 3, 215.00, TRUE),
(42, 'suite', 2, 270.00, TRUE);
