SET NAMES utf8mb4;

-- Reseñas para Hotel Gran Palacio (accommodation_id = 1)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 1, 9.0, 'Habitación muy cómoda y excelente atención del personal. La zona de spa es fantástica.'),
(16, 1, 8.0, 'Todo estaba limpio y bien organizado. El desayuno podría tener más variedad.'),
(17, 1, 9.5, 'El restaurante con vistas fue lo mejor de nuestra estancia. Volveremos seguro.');

-- Reseñas para Hotel Plaza Real (accommodation_id = 2)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 2, 8.2, 'La ubicación es perfecta y el bar en la azotea ofrece vistas increíbles.'),
(15, 2, 7.5, 'Habitación correcta, aunque algo pequeña. Muy buena atención.'),
(16, 2, 9.0, 'Un lugar muy elegante y tranquilo. Ideal para viajes de trabajo.');

-- Reseñas para Hotel Jardines del Retiro (accommodation_id = 3)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(17, 3, 8.8, 'Poder desayunar con vistas al Retiro fue una experiencia muy agradable.'),
(18, 3, 9.3, 'Ideal para descansar, muy silencioso y con jardines preciosos.'),
(15, 3, 8.1, 'Cerca de todo y pet friendly, algo difícil de encontrar en Madrid.');

-- Reseñas para Hotel Boutique Sol (accommodation_id = 4)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(16, 4, 9.0, 'Decoración muy original y camas muy cómodas. Perfecto para parejas.'),
(17, 4, 8.6, 'Buen diseño y tecnología moderna, aunque el desayuno es algo justo.'),
(18, 4, 8.0, 'Muy buen trato del personal. La terraza tiene vistas preciosas.');

-- Reseñas para Hotel Central Palace (accommodation_id = 5)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 5, 9.4, 'La suite era enorme y muy bien equipada. Muy cerca del centro.'),
(16, 5, 8.7, 'Excelente relación calidad/precio. Gimnasio muy completo.'),
(17, 5, 9.1, 'Servicio impecable, la atención fue de 10 desde el primer momento.');

-- Reseñas para Hotel Vista Norte (accommodation_id = 6)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 6, 8.3, 'Buen acceso al aeropuerto. Ideal si estás de paso por negocios.'),
(15, 6, 7.9, 'Cómodo, aunque un poco lejos del centro. El bar es muy bueno.'),
(16, 6, 8.6, 'Parking gratuito y muy limpio. El personal es muy amable.');

-- Reseñas para Apartamento Deluxe Malasaña (accommodation_id = 7)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(17, 7, 8.5, 'Apartamento muy bien ubicado y decorado con mucho gusto. Perfecto para una escapada urbana.'),
(18, 7, 8.8, 'Cómodo, limpio y moderno. Cerca de muchos bares y restaurantes.'),
(15, 7, 9.0, 'Ideal para parejas. Nos encantó la tranquilidad del vecindario.');

-- Reseñas para Ático Chic Paseo de la Castellana (accommodation_id = 8)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(16, 8, 9.0, 'La terraza es increíble, ideal para cenas con vistas. Todo estaba muy limpio.'),
(17, 8, 9.2, 'Apartamento elegante y muy bien equipado. Volveríamos sin dudarlo.'),
(18, 8, 8.7, 'Perfecta ubicación y decoración moderna. La cama muy cómoda.');

-- Reseñas para Hostel Bohemio La Latina (accommodation_id = 9)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 9, 8.0, 'Buen ambiente juvenil y excelente localización. Ideal para mochileros.'),
(16, 9, 7.8, 'Personal amable y camas cómodas. Buen precio para la zona.'),
(17, 9, 8.2, 'Lugar divertido, aunque algo ruidoso por la noche. Repetiría.');

-- Reseñas para Hostel Urban Art Lavapiés (accommodation_id = 10)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 10, 7.5, 'Decoración original y zonas comunes agradables. Bien para estancias cortas.'),
(15, 10, 7.9, 'Personal atento y muy buena conexión con el centro.'),
(16, 10, 8.1, 'Buena relación calidad-precio y ambiente relajado.');

-- Reseñas para Cabaña Bosque Encantado (accommodation_id = 11)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(17, 11, 9.5, 'Un lugar mágico para desconectar. Rodeado de naturaleza.'),
(18, 11, 9.2, 'Muy tranquila y bien equipada. Ideal para escapadas románticas.'),
(15, 11, 9.0, 'Nos encantó el entorno y la chimenea. Muy acogedora.');

-- Reseñas para Cabaña Río Silencioso (accommodation_id = 12)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(16, 12, 8.9, 'Todo estaba impecable. La vista al río es impresionante.'),
(17, 12, 9.1, 'Lugar perfecto para desconectar. Repetiremos seguro.'),
(18, 12, 8.7, 'Muy cómoda y con buena calefacción. Entorno precioso.');

-- Reseñas para Villa El Encinar (accommodation_id = 13)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 13, 9.4, 'Espaciosa, lujosa y con un jardín espectacular. Muy recomendable.'),
(16, 13, 9.1, 'La piscina y las zonas exteriores son de 10.'),
(17, 13, 9.3, 'Villa impresionante y muy cómoda. Perfecta para familias.');

-- Reseñas para Villa La Moraleja (accommodation_id = 14)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 14, 9.2, 'Excelente ubicación y privacidad total. Muy bien equipada.'),
(15, 14, 8.8, 'La casa es preciosa. Pasamos un fin de semana perfecto.'),
(16, 14, 9.0, 'Zona muy tranquila y segura. Ideal para descansar.');

-- Reseñas para Apartamento Gaudí View (ID 15)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(16, 15, 9.2, 'Las vistas a la Sagrada Familia desde el balcón son impresionantes. El apartamento está muy bien equipado.'),
(15, 15, 8.5, 'Buena ubicación y diseño moderno, aunque el ascensor del edificio a veces tardaba.');

-- Reseñas para Hotel Barcelona Moderno (ID 16)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 16, 9.8, 'La terraza con piscina es increíble, con vistas panorámicas de Barcelona. Servicio impecable.'),
(16, 16, 8.7, 'Habitación muy cómoda pero algo ruidosa por la calle. El restaurante mediterráneo excelente.');

-- Reseñas para Hostel Ciutat Vella (ID 17)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 17, 8.3, 'Muy buena atmósfera para conocer viajeros. Las actividades organizadas son divertidas.'),
(17, 17, 7.9, 'Correcto por el precio, aunque los baños podrían estar más limpios.');

-- Reseñas para Apartamento Valencia Beach (ID 18)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(17, 18, 9.6, 'Despertar con vistas al mar fue mágico. El apartamento tiene todo lo necesario.'),
(18, 18, 9.0, 'Perfecto para familias. La playa está literalmente a un minuto caminando.');

-- Reseñas para Villa Triana Jardines (ID 19)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 19, 9.9, 'Una experiencia de lujo auténtica. Los jardines y piscina son de ensueño.'),
(17, 19, 9.5, 'Celebramos nuestra boda aquí y fue perfecto. El servicio de limpieza impecable.');

-- Reseñas para Hostel Sevilla Centro (ID 20)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 20, 8.0, 'Buena relación calidad-precio. Las clases de flamenco fueron lo más divertido.'),
(16, 20, 7.5, 'Básico pero limpio. La ubicación junto a Plaza de España es inmejorable.');

-- Reseñas para Hotel Pilar Central (ID 21)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(16, 21, 9.1, 'Vistas espectaculares a la basílica desde la habitación. Desayuno buffet muy completo.'),
(18, 21, 8.8, 'Camas muy cómodas y ducha relajante. Personal muy atento.');

-- Reseñas para Cabaña Río Ebro (ID 22)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(17, 22, 9.3, 'Romántico atardecer desde la hamaca. Perfecto para desconectar cerca de la ciudad.'),
(15, 22, 8.5, 'Encantador aunque algo pequeña. El desayuno ecológico fue delicioso.');

-- Reseñas para Cabaña El Bosque del Sur (ID 23)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(18, 23, 9.7, 'La chimenea y el silencio del bosque nos ayudaron a relajarnos completamente.'),
(16, 23, 8.9, 'Experiencia natural única. Las bicicletas incluidas fueron un gran detalle.');

-- Reseñas para Hotel Málaga Centro (ID 24)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 24, 9.4, 'Arte local en las habitaciones y terraza con piscina espectacular.'),
(17, 24, 8.2, 'Buen hotel boutique. El patio andaluz tiene mucho encanto.');

-- Reseñas para Hotel Río Segura (ID 25)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES 
(15, 25, 7.8, 'Hotel céntrico y cómodo, pero el desayuno era algo escaso.'),
(16, 25, 8.5, 'Personal muy amable y habitación limpia. Volvería.'),
(17, 25, 6.9, 'La ubicación es buena, pero la habitación era ruidosa.'),
(18, 25, 7.2, 'Buen precio, aunque el wifi no funcionaba bien.');

-- Reseñas para Apartamento Murcia Jardín (ID 26)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 26, 8.5, 'Apartamento muy tranquilo y bien equipado, ideal para familias.'),
(16, 26, 6.0, 'El jardín estaba algo descuidado y la piscina no muy limpia.'),
(17, 26, 7.8, 'Buena ubicación y zona silenciosa, aunque el wifi fallaba a veces.'),
(18, 26, 9.0, 'Todo perfecto, repetiría sin dudarlo.');

-- Reseñas para Apartamento Mirador de la Alhambra (ID 27)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 27, 9.6, 'Vistas espectaculares a la Alhambra, apartamento muy cómodo.'),
(16, 27, 7.0, 'El acceso es complicado y hay muchas escaleras.'),
(17, 27, 8.9, 'Decoración preciosa y muy limpio, recomendable.'),
(18, 27, 6.5, 'El aire acondicionado no funcionaba bien y hacía calor.');

-- Reseñas para Villa Sierra Nevada (ID 28)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 28, 9.8, 'Villa espectacular, perfecta para grupos grandes.'),
(16, 28, 7.2, 'La piscina estaba fría y el jacuzzi no funcionaba.'),
(17, 28, 8.7, 'Entorno natural precioso y casa muy amplia.'),
(18, 28, 6.9, 'El acceso en coche es complicado y el wifi es lento.');

-- Reseñas para Hostel Surf & Sun (ID 29)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 29, 8.2, 'Ambiente joven y divertido, ideal para surfistas.'),
(16, 29, 5.8, 'Las habitaciones compartidas eran ruidosas y poco limpias.'),
(17, 29, 7.5, 'Buena ubicación cerca de la playa, personal amable.'),
(18, 29, 6.3, 'El desayuno era muy básico y las duchas pequeñas.');

-- Reseñas para Apartamento Vegueta (ID 30)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 30, 8.9, 'Apartamento moderno y bien situado, perfecto para explorar la ciudad.'),
(16, 30, 6.7, 'El parking es pequeño y difícil de acceder.'),
(17, 30, 7.9, 'Muy cómodo y limpio, repetiría.'),
(18, 30, 5.5, 'El ascensor no funcionaba y tuvimos que subir muchas escaleras.');

-- Reseñas para Villa Montaña Vasca (ID 31)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 31, 9.4, 'Villa impresionante, ideal para familias grandes.'),
(16, 31, 7.5, 'El jardín es precioso pero la piscina estaba sucia.'),
(17, 31, 8.8, 'Muy cómoda y bien equipada, entorno natural espectacular.'),
(18, 31, 6.6, 'La calefacción no funcionaba bien y pasamos frío por la noche.');

-- Reseñas para Hostel Bilbao Arte (ID 32)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 32, 8.0, 'Hostel moderno y bien decorado, cerca del centro.'),
(16, 32, 5.9, 'Las habitaciones eran pequeñas y algo ruidosas.'),
(17, 32, 7.2, 'Buen ambiente y personal muy simpático.'),
(18, 32, 6.8, 'El desayuno era escaso y la limpieza mejorable.');

-- Reseñas para Apartamento Costa Blanca View (ID 33)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 33, 9.1, 'Vistas al mar increíbles, apartamento muy cómodo.'),
(16, 33, 6.3, 'El sofá cama era incómodo y la piscina estaba cerrada.'),
(17, 33, 8.5, 'Buena ubicación y todo muy limpio.'),
(18, 33, 7.0, 'El aire acondicionado hacía ruido por la noche.');

-- Reseñas para Hotel Alicante Golf (ID 34)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 34, 8.7, 'Hotel perfecto para amantes del golf, instalaciones muy completas.'),
(16, 34, 5.7, 'El spa estaba cerrado y la habitación olía a humedad.'),
(17, 34, 7.8, 'Personal muy amable y buen desayuno.'),
(18, 34, 6.5, 'La limpieza de la habitación no era la mejor.');

-- Reseñas para Hotel Patio Andaluz (ID 35)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 35, 9.2, 'El patio es precioso y la ubicación inmejorable. Muy recomendable.'),
(16, 35, 6.8, 'La habitación era pequeña y el desayuno poco variado.'),
(17, 35, 8.5, 'Personal muy atento y ambiente tranquilo.'),
(18, 35, 7.0, 'El aire acondicionado hacía ruido y la cama era algo dura.');

-- Reseñas para Cabaña Sierra Córdoba (ID 36)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 36, 8.9, 'Entorno natural espectacular y cabaña muy acogedora.'),
(16, 36, 6.5, 'La limpieza podría mejorar y la ducha era pequeña.'),
(17, 36, 7.8, 'Ideal para desconectar y hacer rutas de senderismo.'),
(18, 36, 5.7, 'Muchos insectos dentro de la cabaña y poca iluminación exterior.');

-- Reseñas para Hostel Universidad Central (ID 37)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 37, 8.3, 'Hostel muy bien situado y con buen ambiente estudiantil.'),
(16, 37, 6.1, 'Las zonas comunes estaban algo sucias y el wifi era lento.'),
(17, 37, 7.6, 'Habitaciones cómodas y personal atento.'),
(18, 37, 5.9, 'Mucho ruido por la noche y colchón incómodo.');

-- Reseñas para Hotel Valladolid Histórico (ID 38)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 38, 9.0, 'Hotel con mucho encanto y excelente ubicación en la plaza mayor. El personal fue muy atento.'),
(16, 38, 6.5, 'Bonito edificio pero la habitación era algo fría y el desayuno escaso.'),
(17, 38, 8.7, 'Decoración vintage preciosa y muy limpio. Volvería sin dudarlo.'),
(18, 38, 7.2, 'El restaurante estaba cerrado durante mi estancia y la ducha tardaba en salir caliente.');

-- Reseñas para Villa Rías Baixas (ID 39)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 39, 9.5, 'Vistas espectaculares y jardín muy cuidado. Ideal para familias.'),
(16, 39, 7.0, 'La piscina estaba fría y el wifi no llegaba bien a todas las habitaciones.'),
(17, 39, 8.9, 'Perfecto para desconectar y disfrutar de la naturaleza gallega.'),
(18, 39, 6.8, 'El desayuno ecológico no era tan variado como esperaba.');

-- Reseñas para Apartamento Vigo Mar (ID 40)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 40, 8.8, 'Estudio muy cómodo y con vistas increíbles al puerto.'),
(16, 40, 5.9, 'El parking es un plus, pero el apartamento es pequeño y algo ruidoso.'),
(17, 40, 7.5, 'Buena ubicación para explorar Vigo, aunque la cama era un poco dura.'),
(18, 40, 9.2, 'Todo muy limpio y moderno. Repetiría sin dudarlo.');

-- Reseñas para Cabaña El Mirador Asturiano (ID 41)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 41, 9.3, 'Entorno natural precioso y desayuno casero delicioso.'),
(16, 41, 6.2, 'La cabaña es acogedora pero hacía algo de frío por la noche.'),
(17, 41, 8.0, 'Perfecto para rutas de senderismo y desconexión total.'),
(18, 41, 7.1, 'La terraza tiene buenas vistas, pero la señal de TV era mala.');

-- Reseñas para Hotel Gijón Playa (ID 42)
INSERT INTO reviews (user_id, accommodation_id, rating, comment) VALUES
(15, 42, 8.7, 'Habitación con balcón al mar, muy recomendable.'),
(16, 42, 5.5, 'El spa estaba cerrado y el desayuno era repetitivo.'),
(17, 42, 9.0, 'Ubicación perfecta para disfrutar de la playa y la ciudad.'),
(18, 42, 6.7, 'El gimnasio es pequeño y la habitación olía un poco a humedad.');



