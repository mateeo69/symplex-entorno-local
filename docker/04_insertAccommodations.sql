SET NAMES utf8mb4;

-- Insertar alojamientos
-- Madrid como ciudad de referencia
-- id del 1 al 6
INSERT INTO accommodations (name, description, address, city_id, type, image_url, owner_id) VALUES
('Hotel Gran Palacio', 
    'El Hotel Gran Palacio es un prestigioso establecimiento de cinco estrellas situado en la emblemática Avenida de la Castellana, en pleno centro financiero y cultural de Madrid. Con una arquitectura moderna y elegante, ofrece a sus huéspedes una experiencia de lujo con habitaciones espaciosas equipadas con tecnología de última generación. El hotel dispone de un spa de clase mundial, gimnasio abierto las 24 horas, piscina climatizada y un restaurante gourmet ubicado en la azotea con espectaculares vistas panorámicas de la ciudad.', 
    'Avenida de la Castellana 100, Madrid',
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel1.jpg',
    1),

('Hotel Plaza Real', 
    'Situado frente a la histórica Plaza Mayor, el Hotel Plaza Real es un elegante alojamiento que fusiona la arquitectura clásica madrileña con interiores modernos y funcionales. Sus habitaciones, decoradas con materiales nobles y tonos cálidos, ofrecen un ambiente acogedor tanto para turistas como para viajeros de negocios. El hotel cuenta con salas de conferencias completamente equipadas, un centro de negocios, y un bar en la azotea que brinda impresionantes vistas del casco antiguo y cócteles artesanales al atardecer.', 
    'Plaza Mayor 12, Madrid', 
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel2.jpg',
    2),

('Hotel Jardines del Retiro', 
    'Ubicado estratégicamente junto al emblemático Parque del Retiro, el Hotel Jardines del Retiro es ideal para quienes buscan tranquilidad sin alejarse del corazón de Madrid. Las habitaciones están orientadas hacia jardines privados, ofreciendo un ambiente sereno y relajante. El hotel promueve la sostenibilidad con un desayuno buffet ecológico basado en productos locales, áreas verdes interiores y servicios que respetan el medio ambiente. Además, está a poca distancia de museos como el Prado y el Reina Sofía.', 
    'Calle Alfonso XII 45, Madrid', 
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel3.jpg',
    3),

('Hotel Boutique Sol', 
    'Hotel Boutique Sol es un alojamiento íntimo y exclusivo en una de las zonas más vibrantes de Madrid. Este hotel destaca por su diseño vanguardista, con habitaciones personalizadas donde cada una representa un concepto artístico diferente. El edificio está equipado con sistemas de domótica que permiten al huésped controlar la iluminación, temperatura y entretenimiento desde su móvil. El servicio es altamente personalizado, orientado a brindar una experiencia única y acogedora. A escasos metros se encuentra la Puerta del Sol y otras atracciones turísticas.', 
    'Calle del Sol 8, Madrid', 
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel4.jpg',
    4),

('Hotel Central Palace', 
    'Ubicado en el barrio histórico de Madrid, el Hotel Central Palace ofrece una experiencia de alojamiento sofisticada y confortable. A tan solo unos pasos del Palacio Real y la Catedral de la Almudena, este hotel dispone de suites amplias decoradas con un estilo clásico renovado. Los huéspedes disfrutan de servicio de conserjería disponible las 24 horas, transporte privado bajo reserva, y un restaurante especializado en cocina de autor con influencias mediterráneas y asiáticas. El entorno es ideal para descubrir la historia y la cultura madrileña a pie.', 
    'Calle Bailén 25, Madrid', 
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel5.jpg',
    5),

('Hotel Vista Norte', 
    'Hotel Vista Norte es una opción moderna y funcional en la zona norte de Madrid, perfecta para viajeros frecuentes y asistentes a congresos. Ubicado cerca del aeropuerto de Barajas y del recinto ferial IFEMA, el hotel ofrece habitaciones insonorizadas con escritorio ergonómico, un completo centro de reuniones, Wi-Fi de alta velocidad y servicio de transporte gratuito. El restaurante del hotel sirve menús saludables y platos internacionales, mientras que el gimnasio y las zonas comunes permiten desconectar tras un día de trabajo. La conexión con el centro de Madrid es rápida gracias al transporte público cercano.', 
    'Calle Arturo Soria 75, Madrid', 
    1, 
    'hotel', 
    'assets/img/accomodations/madridHotel6.jpg',
    6);

-- Insertar 2 acomodaciones para tipo restante
-- id del 7 al 14
INSERT INTO accommodations (name, description, address, city_id, type, image_url, owner_id) VALUES
-- APARTAMENTOS
('Apartamento Deluxe Malasaña',
    'El Apartamento Deluxe Malasaña es una elegante y moderna propiedad ubicada en una de las zonas más animadas de Madrid. Diseñado para estancias prolongadas, este apartamento ofrece un ambiente acogedor con interiores de diseño contemporáneo y una distribución funcional que maximiza la comodidad. Dispone de una cocina totalmente equipada, sala de estar luminosa con acceso a balcón privado y dormitorio con cama king size. Los huéspedes disfrutan de servicios como Wi-Fi de alta velocidad, smart TV, climatización individual y sistema de entrada sin llave. La ubicación permite explorar fácilmente cafeterías, boutiques y sitios culturales del barrio.',
    'Calle Fuencarral 50, Madrid',
    1, 
    'apartment', 
    'assets/img/accomodations/madridApartment1.jpg',
    7),

('Ático Chic Paseo de la Castellana',
    'El Ático Chic Paseo de la Castellana es una exclusiva propiedad situada en una de las avenidas más prestigiosas de Madrid. Este ático destaca por su terraza privada con vistas panorámicas de la ciudad, ideal para cenas al aire libre o momentos de relajación. El interior combina elegancia y funcionalidad con una amplia sala de estar, cocina americana de alta gama y dormitorio principal en suite. El apartamento cuenta con acceso a parking privado, ascensor directo y servicios domotizados. Su cercanía a zonas empresariales y comerciales lo convierten en una opción perfecta para viajeros de negocios y parejas.',
    'Paseo de la Castellana 200, Madrid', 
    1, 
    'apartment', 
    'assets/img/accomodations/madridApartment2.jpg',
    8),

-- HOSTELES
('Hostel Bohemio La Latina',
    'El Hostel Bohemio La Latina es un albergue con encanto situado en el corazón del barrio más castizo de Madrid. Su ambiente acogedor y decoración ecléctica lo convierten en un punto de encuentro para viajeros de todo el mundo. Ofrece habitaciones compartidas y privadas, todas con taquillas individuales, climatización y acceso a baños modernos. Las zonas comunes incluyen una cocina equipada, sala de lectura y terraza con vistas al casco histórico. Además, se organizan actividades culturales y tours por la ciudad para fomentar la interacción entre los huéspedes.',
    'Calle de los Cuchilleros 15, Madrid', 
    1, 
    'hostel', 
    'assets/img/accomodations/madridHostel1.jpg',
    9),

('Hostel Urban Art Lavapiés',
    'Situado en el multicultural barrio de Lavapiés, el Hostel Urban Art destaca por su enfoque artístico y su ambiente juvenil. Cada habitación está decorada con murales creados por artistas locales, ofreciendo una experiencia visual única. Cuenta con dormitorios mixtos y femeninos, recepción 24 horas, Wi-Fi gratuito y una zona común vibrante con biblioteca, zona de juegos y cafetera libre. El albergue también promueve iniciativas sociales y sostenibles. Su excelente ubicación permite acceder fácilmente a museos, teatros alternativos y una variada oferta gastronómica.',
    'Calle Argumosa 25, Madrid', 
    1, 
    'hostel', 
    'assets/img/accomodations/madridHostel2.jpg',
    10),

-- CABAÑAS
('Cabaña Bosque Encantado',
    'La Cabaña Bosque Encantado es un refugio natural situado en las afueras de Madrid, ideal para quienes buscan desconexión total y contacto con la naturaleza. Rodeada por árboles centenarios, esta cabaña de madera combina estilo rústico y confort moderno, con chimenea ecológica, cama queen size y jacuzzi privado en la terraza. Ofrece desayuno ecológico, bicicletas gratuitas y rutas guiadas por el bosque. Es una opción perfecta para escapadas románticas o fines de semana de bienestar, todo a solo 30 minutos del centro urbano.',
    'Carretera de El Pardo km 10, Madrid', 
    1, 
    'cabin', 
    'assets/img/accomodations/madridCabin1.jpg',
    11),

('Cabaña Aventura Sierra de Guadarrama',
    'Ubicada en plena Sierra de Guadarrama, la Cabaña Aventura es una opción ideal para los amantes del aire libre y el turismo activo. Esta cabaña de montaña ofrece vistas impresionantes, cocina equipada, literas de madera maciza y estufa de leña. Se encuentra cerca de rutas de senderismo, escalada y zonas de nieve en invierno. El complejo ofrece actividades como tirolina, orientación, y talleres medioambientales. Es un espacio perfecto para familias, grupos de amigos o viajeros solitarios que deseen reconectar con la naturaleza sin renunciar a la comodidad.',
    'Carretera M-601 km 30, Madrid', 
    1, 
    'cabin', 
    'assets/img/accomodations/madridCabin2.jpg',
    12),

-- VILLAS
('Villa Mediterránea La Moraleja',
    'La Villa Mediterránea La Moraleja es una residencia de lujo situada en una de las urbanizaciones más exclusivas de Madrid. Con amplios jardines, piscina privada, zona chill-out y barbacoa, esta villa ofrece privacidad absoluta en un entorno sofisticado. El interior destaca por sus acabados de alta gama, techos altos y una cocina gourmet equipada con electrodomésticos premium. Dispone de cinco habitaciones, sala de cine, gimnasio privado y servicio de limpieza diario. Es ideal tanto para estancias prolongadas como para eventos privados de alto nivel.',
    'Avenida de Europa 10, Madrid', 
    1, 
    'villa', 
    'assets/img/accomodations/madridVilla1.jpg',
    13),

('Villa Moderna Pozuelo de Alarcón',
    'La Villa Moderna Pozuelo de Alarcón es una propiedad de diseño contemporáneo ubicada en una tranquila zona residencial al oeste de Madrid. Esta villa combina líneas minimalistas con espacios amplios y luminosos distribuidos en tres plantas. Cuenta con cuatro dormitorios en suite, cocina italiana, salón con ventanales panorámicos y un jardín con piscina climatizada. La propiedad dispone de garaje para varios vehículos, sistema de domótica integral y seguridad 24 horas. Es una opción inmejorable para familias o ejecutivos que buscan tranquilidad sin alejarse de la capital.',
    'Calle de la Villa 5, Madrid', 
    1, 
    'villa', 
    'assets/img/accomodations/madridVilla2.jpg',
    14);

-- Ciudades nuevas.
INSERT INTO accommodations (name, description, address, city_id, type, image_url, owner_id) VALUES
-- 1. Barcelona. ID 15 16
('Apartamento Gaudí View', 
    'El Apartamento Gaudí View se sitúa a pocos metros de la emblemática Sagrada Familia, ofreciendo una experiencia única en el corazón de Barcelona. Este moderno apartamento de dos dormitorios destaca por su diseño contemporáneo y funcionalidad, con una cocina completamente equipada, sala de estar luminosa y un balcón privado con vistas directas al monumento. Los huéspedes disfrutan de aire acondicionado, Wi-Fi de alta velocidad, smart TV y sistema de entrada sin llave. El edificio cuenta con ascensor, servicio de limpieza semanal y acceso a una terraza comunitaria con zona chill-out. Su ubicación privilegiada permite explorar fácilmente los principales atractivos turísticos, restaurantes de autor y boutiques de moda del Eixample, así como conexiones rápidas al transporte público para descubrir toda la ciudad.', 
    'Carrer de Mallorca 410, Barcelona', 
    2, 'apartment', 'assets/img/accomodations/barcelonaApartment1.jpg', 999),
('Hotel Barcelona Moderno', 
    'Ubicado en el vibrante distrito de Eixample, el Hotel Barcelona Moderno es un establecimiento de cuatro estrellas que fusiona el diseño minimalista con el máximo confort. Sus habitaciones insonorizadas están equipadas con camas king size, escritorio ergonómico, minibar y baño privado con amenities ecológicos. El hotel dispone de una espectacular terraza en la azotea con piscina y vistas panorámicas a la ciudad, gimnasio de última generación, restaurante de cocina mediterránea y bar de cócteles. Los huéspedes pueden disfrutar de servicio de habitaciones 24 horas, alquiler de bicicletas y asesoría turística personalizada. Su localización estratégica permite acceder a pie a la Casa Batlló, La Pedrera y las principales arterias comerciales de Barcelona.', 
    'Carrer de Provença 230, Barcelona', 
    2, 'hotel', 'assets/img/accomodations/barcelonaHotel1.jpg', 999),

-- 2. Valencia ID 17 18
('Hostel Ciutat Vella', 
    'Hostel Ciutat Vella es un acogedor alojamiento situado en pleno centro histórico de Valencia, a escasos minutos de la Catedral y la Plaza de la Virgen. El hostel ofrece tanto habitaciones privadas como compartidas, todas con aire acondicionado, taquillas individuales y acceso a baños modernos. Entre sus instalaciones destacan una cocina comunitaria totalmente equipada, sala de estar con juegos de mesa, biblioteca y una terraza en la azotea ideal para socializar y disfrutar del clima mediterráneo. El personal organiza rutas gastronómicas, visitas guiadas y actividades culturales para fomentar la interacción entre los huéspedes. La ubicación es perfecta para explorar los principales monumentos, museos y la animada vida nocturna valenciana.', 
    'Calle Caballeros 20, Valencia', 
    3, 'hostel', 'assets/img/accomodations/valenciaHostel1.jpg', 999),
('Apartamento Valencia Beach', 
    'Este luminoso apartamento se encuentra frente a la playa de Malvarrosa, ofreciendo impresionantes vistas al mar y acceso directo al paseo marítimo. Dispone de dos dormitorios, cocina completa con electrodomésticos de alta gama, salón comedor con grandes ventanales y una terraza amueblada perfecta para desayunos al aire libre. El apartamento cuenta con Wi-Fi de alta velocidad, climatización individual, smart TV y plaza de parking privada. Los huéspedes pueden disfrutar de servicios adicionales como alquiler de bicicletas, limpieza bajo demanda y recomendaciones personalizadas para descubrir la gastronomía local. Su ubicación privilegiada permite disfrutar tanto del ambiente playero como del centro histórico de Valencia en pocos minutos.', 
    'Paseo Marítimo 45, Valencia', 
    3, 'apartment', 'assets/img/accomodations/valenciaApartment1.jpg', 999),

-- 3. Sevilla
('Villa Triana Jardines',
    'Villa Triana Jardines es una exclusiva propiedad ubicada en el tradicional barrio de Triana, Sevilla. Rodeada de jardines privados y fuentes, esta villa de lujo cuenta con amplias estancias decoradas con azulejos sevillanos, techos altos y mobiliario artesanal. Dispone de piscina privada, zona de barbacoa, cocina gourmet totalmente equipada y varias terrazas con vistas al río Guadalquivir. El alojamiento incluye cinco dormitorios en suite, sala de cine, gimnasio privado y servicio de limpieza diario. Ideal para eventos familiares, celebraciones o estancias de lujo, la villa ofrece privacidad absoluta y acceso rápido al centro histórico, la Plaza de España y los principales monumentos de la ciudad.', 
    'Calle San Jacinto 140, Sevilla', 
    4, 'villa', 'assets/img/accomodations/sevillaVilla1.jpg', 999),
('Hostel Sevilla Centro', 
    'Situado junto a la Plaza de España, este hostel económico ofrece camas en dormitorios compartidos con aire acondicionado, taquillas individuales y cortinas para mayor privacidad. El establecimiento cuenta con cocina común totalmente equipada, sala de juegos, biblioteca y una terraza con vistas a la ciudad. Se organizan actividades diarias como rutas de tapas, clases de flamenco y visitas guiadas para conocer otros viajeros y la cultura local. El personal multilingüe está disponible las 24 horas para asesorar sobre excursiones y eventos. Su ubicación céntrica permite explorar fácilmente los principales atractivos de Sevilla a pie.', 
    'Calle San Fernando 8, Sevilla', 
    4, 'hostel', 'assets/img/accomodations/sevillaHostel1.jpg', 999),

-- 4. Zaragoza
('Hotel Pilar Central', 
    'El Hotel Pilar Central se sitúa frente a la famosa Basílica del Pilar en Zaragoza, ofreciendo una experiencia única en el corazón de la ciudad. Este moderno hotel dispone de habitaciones insonorizadas con decoración elegante, camas extragrandes, escritorio de trabajo y baño privado con ducha efecto lluvia. Los huéspedes pueden disfrutar de desayuno buffet diario, recepción 24 horas, gimnasio, sala de reuniones y parking privado. El restaurante del hotel sirve cocina aragonesa e internacional, y la terraza ofrece vistas espectaculares a la basílica. Su diseño funcional y ubicación privilegiada lo convierten en la opción ideal tanto para estancias de ocio como de trabajo.', 
    'Plaza del Pilar 1, Zaragoza', 
    5, 'hotel', 'assets/img/accomodations/zaragozaHotel1.jpg', 999),
('Cabaña Río Ebro', 
    'Pequeña cabaña de madera junto al río Ebro, a solo 15 minutos del centro de Zaragoza. Ideal para quienes buscan tranquilidad sin renunciar a la ciudad, esta cabaña ofrece cocina básica, baño completo, dormitorio con cama doble y terraza con hamaca para disfrutar del atardecer. El entorno natural permite realizar actividades como senderismo, pesca y paseos en bicicleta. El alojamiento incluye desayuno ecológico, zona de barbacoa y aparcamiento privado. Es perfecto para escapadas románticas, fines de semana de relax o turismo activo en contacto con la naturaleza.', 
    'Camino de las Norias 12, Zaragoza', 
    5, 'cabin', 'assets/img/accomodations/zaragozaCabin1.jpg', 999),

-- 5. Málaga
('Cabaña El Bosque del Sur', 
    'Cabaña El Bosque del Sur es un alojamiento con encanto situado en la serranía de Málaga, rodeado de naturaleza y tranquilidad. Su estructura de madera y decoración rústica crean un ambiente acogedor ideal para desconectar. Dispone de chimenea, cocina completa, dormitorio principal con cama king size y terraza privada con vistas al bosque. Los huéspedes pueden disfrutar de rutas de senderismo, observación de aves y actividades al aire libre. El alojamiento incluye desayuno casero, bicicletas gratuitas y servicio de limpieza bajo demanda. Es perfecto para parejas, familias o viajeros que buscan una experiencia auténtica en plena naturaleza.', 
    'Camino del Colmenar 45, Málaga', 
    6, 'cabin', 'assets/img/accomodations/malagaCabin1.jpg', 999),
('Hotel Málaga Centro', 
    'Este hotel boutique en el centro histórico de Málaga ofrece habitaciones decoradas con obras de arte local, camas extragrandes, minibar y baño privado con amenities premium. El hotel cuenta con un patio andaluz tradicional, bar de tapas, restaurante de cocina fusión y una terraza en la azotea con piscina y vistas a la ciudad. Los huéspedes pueden disfrutar de servicio de habitaciones, recepción 24 horas, alquiler de bicicletas y asesoría turística. La ubicación privilegiada permite acceder fácilmente a la catedral, el museo Picasso y las principales calles comerciales y gastronómicas de Málaga.', 
    'Calle Granada 30, Málaga', 
    6, 'hotel', 'assets/img/accomodations/malagaHotel1.jpg', 999),

-- 6. Murcia
('Hotel Río Segura', 
    'El Hotel Río Segura se ubica en el centro de Murcia, junto al paseo del Malecón y el río. Cuenta con habitaciones espaciosas y luminosas, equipadas con aire acondicionado, escritorio, minibar y baño privado con ducha de hidromasaje. El hotel dispone de restaurante de cocina local, bar, sala de reuniones para eventos y gimnasio. Los huéspedes pueden disfrutar de desayuno buffet, servicio de habitaciones y asesoría turística personalizada. Su estilo moderno con toques mediterráneos lo hace atractivo tanto para turismo como para viajes de negocios. La ubicación permite explorar a pie los principales monumentos, museos y zonas de ocio de Murcia.', 
    'Avenida Teniente Flomesta 3, Murcia', 
    7, 'hotel', 'assets/img/accomodations/murciaHotel1.jpg', 999),
('Apartamento Murcia Jardín', 
    'Acogedor apartamento en zona residencial de Murcia, con jardín privado y acceso a piscina comunitaria. El alojamiento dispone de dos dormitorios, cocina totalmente equipada, sala de estar amplia con smart TV y terraza amueblada para disfrutar del clima mediterráneo. Incluye Wi-Fi de alta velocidad, climatización individual y plaza de parking. Es perfecto para estancias largas, familias o viajeros que buscan tranquilidad y comodidad. La urbanización cuenta con zonas verdes, parque infantil y vigilancia 24 horas. Su localización permite acceder rápidamente al centro de Murcia y a las principales vías de comunicación.', 
    'Calle Floridablanca 22, Murcia', 
    7, 'apartment', 'assets/img/accomodations/murciaApartment1.jpg', 999),

-- 7. Granada
('Apartamento Mirador de la Alhambra', 
    'Este elegante apartamento se sitúa en el histórico barrio del Albaicín, con vistas directas a la Alhambra y a los jardines del Generalife. Dispone de un dormitorio principal con cama king size, salón con ventanales panorámicos, cocina equipada con electrodomésticos de alta gama y baño moderno con ducha efecto lluvia. La decoración combina el estilo nazarí con toques modernos, creando un ambiente acogedor y sofisticado. Los huéspedes pueden disfrutar de una terraza privada ideal para desayunos al aire libre, Wi-Fi de alta velocidad, climatización individual y smart TV. Su ubicación permite explorar a pie los principales monumentos, miradores y bares de tapas de Granada, así como acceder fácilmente a rutas de senderismo en la Sierra.', 
    'Cuesta de San Gregorio 21, Granada', 
    8, 'apartment', 'assets/img/accomodations/granadaApartment1.jpg', 999),
('Villa Sierra Nevada', 
    'Lujosa villa situada en las faldas de Sierra Nevada, a tan solo 20 minutos del centro de Granada. Con capacidad para 8 personas, esta propiedad cuenta con piscina climatizada, jacuzzi exterior, jardín privado y zona de barbacoa. El interior destaca por su amplitud y luminosidad, con cinco dormitorios en suite, salón con chimenea, cocina de alta gama y sala de juegos. La villa ofrece servicios exclusivos como chef privado bajo reserva, alquiler de material de esquí y traslados a las pistas. Es ideal para grupos o familias que buscan naturaleza, confort y privacidad en un entorno único, con vistas espectaculares a la montaña y fácil acceso tanto a la ciudad como a la estación de esquí.', 
    'Camino del Purche 15, Granada', 
    8, 'villa', 'assets/img/accomodations/granadaVilla1.jpg', 999),

-- 8. Las Palmas
('Hostel Surf & Sun', 
    'El Hostel Surf & Sun se encuentra a pocos metros de la Playa de Las Canteras, en Las Palmas de Gran Canaria, siendo el alojamiento ideal para surfistas y viajeros jóvenes. Ofrece habitaciones compartidas y privadas, todas con taquillas, aire acondicionado y acceso a baños modernos. Las zonas comunes incluyen cocina equipada, sala de juegos, biblioteca y terraza con vistas al mar. El hostel organiza clases de surf, alquiler de tablas y actividades grupales para fomentar la convivencia. Su atmósfera relajada y decoración tropical lo hacen perfecto para socializar y disfrutar del clima canario durante todo el año. La ubicación permite acceder fácilmente a restaurantes, bares y tiendas tradicionales.', 
    'Calle Portugal 68, Las Palmas de Gran Canaria', 
    9, 'hostel', 'assets/img/accomodations/laspalmasHostel1.jpg', 999),
('Apartamento Vegueta', 
    'Moderno apartamento situado en el barrio histórico de Vegueta, con vistas al océano Atlántico y a los tejados coloniales de la ciudad. Dispone de un dormitorio, cocina americana totalmente equipada, salón con smart TV y balcón donde disfrutar del clima canario. El edificio cuenta con ascensor, parking privado y acceso a zonas comunes ajardinadas. Es perfecto para estancias largas o cortas, tanto para viajeros de negocios como para turistas que desean explorar museos, mercados y la vibrante vida cultural de Las Palmas. La playa y el puerto están a pocos minutos a pie.', 
    'Calle Mendizábal 10, Las Palmas de Gran Canaria', 
    9, 'apartment', 'assets/img/accomodations/laspalmasApartment1.jpg', 999),

-- 9. Bilbao
('Villa Montaña Vasca', 
    'Ubicada en las afueras de Bilbao, la Villa Montaña Vasca ofrece una experiencia de lujo en plena naturaleza. La propiedad cuenta con cinco habitaciones dobles, cocina rústica equipada, sala de cine privada, gimnasio y piscina climatizada con vistas a los montes vascos. El amplio jardín dispone de zona de barbacoa, terraza chill-out y parque infantil. Los huéspedes pueden solicitar servicios adicionales como chef privado, rutas de senderismo guiadas y catas de vino. Es ideal para reuniones familiares, eventos exclusivos o escapadas de relax, con fácil acceso al centro de Bilbao y a la costa.', 
    'Camino Mendikoetxe 33, Bilbao', 
    10, 'villa', 'assets/img/accomodations/bilbaoVilla1.jpg', 999),
('Hostel Bilbao Arte', 
    'Albergue juvenil situado en el distrito de Abando, a pocos minutos del museo Guggenheim y del centro histórico de Bilbao. Ofrece dormitorios temáticos decorados por artistas locales, habitaciones privadas, cocina compartida y sala de estar con biblioteca y juegos. El hostel organiza visitas guiadas por la ciudad, talleres creativos y actividades culturales. Su ambiente moderno y multicultural lo convierte en un punto de encuentro para viajeros jóvenes y amantes del arte. La recepción está disponible 24 horas y se ofrece información turística personalizada.', 
    'Calle Bailén 5, Bilbao', 
    10, 'hostel', 'assets/img/accomodations/bilbaoHostel1.jpg', 999),

-- 10. Alicante
('Apartamento Costa Blanca View', 
    'Este apartamento moderno se ubica en el paseo marítimo de Alicante, con impresionantes vistas al mar Mediterráneo y acceso directo a la playa. Dispone de dos habitaciones dobles, cocina americana totalmente equipada, terraza amueblada y salón con Smart TV y sofá cama. El edificio cuenta con piscina comunitaria, ascensor y parking privado. Los huéspedes pueden disfrutar de Wi-Fi de alta velocidad, climatización individual y servicios adicionales como alquiler de bicicletas y limpieza bajo demanda. Es perfecto para familias o parejas que buscan confort, tranquilidad y cercanía a las principales atracciones turísticas y gastronómicas de la ciudad.', 
    'Avenida de Niza 12, Alicante', 
    11, 'apartment', 'assets/img/accomodations/alicanteApartment1.jpg', 999),
('Hotel Alicante Golf', 
    'Este resort de 4 estrellas se encuentra junto al campo de golf de Alicante, ofreciendo habitaciones con balcón privado, spa completo, gimnasio y varios restaurantes de cocina mediterránea e internacional. El hotel dispone de piscina exterior, pistas de tenis, club infantil y servicio de animación. Los huéspedes pueden reservar clases de golf, tratamientos de bienestar y excursiones a la Costa Blanca. Es ideal para quienes buscan relax, deporte y actividades en familia durante su estancia en una de las zonas más exclusivas de Alicante.', 
    'Urbanización San Juan 45, Alicante', 
    11, 'hotel', 'assets/img/accomodations/alicanteHotel1.jpg', 999),

-- 11. Córdoba
('Hotel Patio Andaluz', 
    'El Hotel Patio Andaluz es una joya arquitectónica en el centro histórico de Córdoba, a pocos pasos de la Mezquita-Catedral. Conserva un típico patio cordobés con fuentes, vegetación y columnas de mármol, rodeado de habitaciones con encanto decoradas en estilo andalusí. El hotel ofrece desayuno buffet con productos locales, servicio de guía turístico, recepción 24 horas y asesoría para rutas culturales y gastronómicas. Su ambiente tranquilo y su ubicación privilegiada permiten descubrir a pie los principales monumentos, museos y tabernas tradicionales de la ciudad.', 
    'Calle de las Flores 5, Córdoba', 
    12, 'hotel', 'assets/img/accomodations/cordobaHotel1.jpg', 999),
('Cabaña Sierra Córdoba', 
    'Encantadora cabaña de piedra situada en las montañas cercanas a Córdoba, rodeada de naturaleza y rutas de senderismo. Dispone de chimenea, terraza con vistas panorámicas, dormitorio principal con cama queen size y baño completo. El alojamiento incluye desayuno con productos locales, rutas guiadas por la sierra y servicio de alquiler de bicicletas. Es ideal para escapadas románticas, fines de semana de relax o turismo activo en contacto con el entorno natural de Andalucía.', 
    'Camino de los Almendros 8, Córdoba', 
    12, 'cabin', 'assets/img/accomodations/cordobaCabin1.jpg', 999),

-- 12. Valladolid
('Hostel Universidad Central', 
    'Situado en pleno centro de Valladolid, este hostel juvenil ofrece habitaciones cómodas y modernas con acceso a una cocina compartida, sala de estudio y zona de juegos. Está a pocos pasos del campus universitario, la plaza mayor y los principales bares y restaurantes de la ciudad. El personal organiza actividades culturales, visitas guiadas y noches temáticas para fomentar la convivencia entre los huéspedes. El alojamiento dispone de Wi-Fi gratuito, taquillas individuales y recepción 24 horas.', 
    'Calle Librería 2, Valladolid', 
    13, 'hostel', 'assets/img/accomodations/valladolidHostel1.jpg', 999),
('Hotel Valladolid Histórico', 
    'Antigua mansión del siglo XVI reconvertida en hotel boutique, conservando elementos originales como techos de madera, patios interiores y azulejos artesanales. Ubicado en la plaza mayor, ofrece habitaciones únicas con decoración vintage, baño privado y vistas a la ciudad. El hotel cuenta con restaurante de cocina castellana, sala de reuniones y servicio personalizado. Es ideal para quienes buscan una experiencia auténtica en el corazón de Valladolid, cerca de museos, teatros y zonas comerciales.', 
    'Plaza Mayor 15, Valladolid', 
    13, 'hotel', 'assets/img/accomodations/valladolidHotel1.jpg', 999),

-- 13. Vigo
('Villa Rías Baixas', 
    'Villa Rías Baixas es una casa señorial gallega reformada, con vistas a la ría de Vigo y rodeada de jardines privados. Cuenta con piscina exterior, salón con chimenea, cocina equipada y cinco dormitorios dobles. El alojamiento ofrece desayuno ecológico, rutas de senderismo guiadas, alquiler de bicicletas y actividades náuticas bajo reserva. Es ideal para escapadas en familia, eventos privados o estancias tranquilas cerca del mar, con fácil acceso a las playas y al centro de Vigo.', 
    'Rúa do Mar 18, Vigo', 
    14, 'villa', 'assets/img/accomodations/vigoVilla1.jpg', 999),
('Apartamento Vigo Mar', 
    'Acogedor estudio frente al puerto de Vigo, con vistas panorámicas a las islas Cíes y al casco antiguo. Dispone de cocina equipada, dormitorio con cama doble, baño moderno y parking gratuito en el edificio. El apartamento cuenta con Wi-Fi de alta velocidad, smart TV y climatización. Es perfecto para viajeros que buscan autenticidad gallega, tranquilidad y cercanía a los principales puntos de interés, restaurantes y tiendas tradicionales.', 
    'Avenida da Beiramar 30, Vigo', 
    14, 'apartment', 'assets/img/accomodations/vigoApartment1.jpg', 999),

-- 14. Gijón
('Cabaña El Mirador Asturiano', 
    'Rodeada de naturaleza, esta cabaña en las colinas de Gijón ofrece paz, desconexión y vistas espectaculares a la costa asturiana. Consta de dos dormitorios, cocina americana equipada, chimenea, baño completo y terraza amueblada. La decoración en madera natural genera un ambiente cálido y hogareño. El alojamiento incluye desayuno casero, rutas de senderismo guiadas y alquiler de bicicletas. Es ideal para familias, parejas o viajeros que buscan una experiencia auténtica en el norte de España, cerca de playas y pueblos con encanto.', 
    'Camino de las Mestas 55, Gijón', 
    15, 'cabin', 'assets/img/accomodations/gijonCabin1.jpg', 999),
('Hotel Gijón Playa', 
    'Moderno hotel frente a la playa de San Lorenzo en Gijón, con habitaciones con balcón al mar, spa, gimnasio y restaurante de cocina asturiana. El hotel dispone de recepción 24 horas, alquiler de bicicletas, servicio de habitaciones y asesoría turística. Su ubicación es perfecta para disfrutar del paseo marítimo, las sidrerías del centro y los principales museos de la ciudad. Es una opción ideal tanto para turismo de ocio como de negocios en la costa asturiana.', 
    'Avenida de la Costa 25, Gijón', 
    15, 'hotel', 'assets/img/accomodations/gijonHotel1.jpg', 999);
