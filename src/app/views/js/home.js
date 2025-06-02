document.addEventListener('DOMContentLoaded', function () {
    // Usuario localStorage (si lo necesitas)
    if(localStorage.getItem("users")!==null) {
        let users = JSON.parse(localStorage.getItem("users"))[0];
        document.getElementById("user").classList.remove("active");
        document.getElementById("user").innerHTML = ""; 
        document.getElementById("user-filled").classList.add("active");
        let h2 = document.createElement("h2");
        h2.textContent = `${users.name} ${users.lastname}`;
        document.getElementById("user-filled").appendChild(h2);
    }

    // --- MAPA LEAFLET ---
    // Comprueba que existe el div#map
    
    var mapDiv = document.getElementById('map');
    var loader = document.getElementById('map-loader');
    if (mapDiv) {
        // Inicializa el mapa centrado en España
        var map = L.map('map', {
            center: [40.0, -3.7],
            zoom: 5, // Cambia de 6 a 5 para ver toda España
            scrollWheelZoom: false // Desactiva zoom con la rueda
        });

        // Añade el mapa base de OpenStreetMap
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '© OpenStreetMap contributors'
        }).addTo(map);

        // Añade marcadores para cada ciudad del array cities
        if (typeof cities !== "undefined") {
            for (const city of cities) {
                if (city.lat && city.lon) {
                    L.marker([parseFloat(city.lat), parseFloat(city.lon)])
                        .addTo(map)
                        .bindPopup(
                            `<b class="d-block text-center">${city.name}</b>
                            <hr class="my-2">
                            <form action="index.php?action=search" method="POST">
                                <input type="hidden" name="filters[city_name]" value="${city.name}">
                                <div class="mb-1">
                                    <label for="check_in_${city.name}" class="form-label mb-0">Entrada:</label>
                                    <input type="date" id="check_in_${city.name}" name="filters[check_in]" class="form-control form-control-sm" value="${getToday()}" required>
                                </div>
                                <div class="mb-1">
                                    <label for="check_out_${city.name}" class="form-label mb-0">Salida:</label>
                                    <input type="date" id="check_out_${city.name}" name="filters[check_out]" class="form-control form-control-sm" value="${getTomorrow()}" required>
                                </div>
                                <input type="hidden" name="filters[people]" value="1">
                                <button type="submit" class="btn btn-primary btn-sm mt-2">Buscar alojamiento</button>
                            </form>`
                        )
                        .on('popupopen', function () {
                            const checkIn = document.getElementById('check_in_' + city.name);
                            const checkOut = document.getElementById('check_out_' + city.name);
                            if (checkIn && checkOut) {
                                // Inicializa el min
                                checkOut.min = checkIn.value;
                                checkIn.addEventListener('change', function () {
                                    checkOut.min = checkIn.value;
                                    if (checkOut.value < checkIn.value) {
                                        checkOut.value = checkIn.value;
                                    }
                                });
                            }
                        });
                }
            }
        }
        // Cuando termina, oculta el loader y muestra el mapa
        if (loader) loader.style.display = "none";
        mapDiv.style.visibility = "visible";
        map.invalidateSize(); // <-- Esto es importante para que Leaflet repinte bien el mapa
    }

    // --- Control de fechas en el formulario principal ---
    const checkIn = document.getElementById('check_in');
    const checkOut = document.getElementById('check_out');
    if (checkIn && checkOut) {
        checkIn.addEventListener('change', function () {
            checkOut.min = checkIn.value;
            if (checkOut.value < checkIn.value) {
                checkOut.value = checkIn.value;
            }
        });
        // Inicializa el min al cargar la página
        checkOut.min = checkIn.value;
    }
});

function getToday() {
    const today = new Date();
    return today.toISOString().split('T')[0];
}
function getTomorrow() {
    const tomorrow = new Date();
    tomorrow.setDate(tomorrow.getDate() + 1);
    return tomorrow.toISOString().split('T')[0];
}



