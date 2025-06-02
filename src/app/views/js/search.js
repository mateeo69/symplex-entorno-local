document.addEventListener("DOMContentLoaded", function() {
    // Obtener referencias a los elementos
    const btnList = document.getElementById("btnList");
    const btnGrid = document.getElementById("btnGrid");
    const gridView = document.getElementById("gridView");
    const listView = document.getElementById("listView");

    // Mostrar por defecto la vista de tabla
    gridView.style.display = "flex";
    listView.style.display = "none";
    btnGrid.classList.remove("btn-outline-secondary");
    btnGrid.classList.add("btn-secondary");
    btnList.classList.remove("btn-secondary");
    btnList.classList.add("btn-outline-secondary");

    // Función para cambiar a vista de lista
    btnList.addEventListener("click", function() {
        gridView.style.display = "none";
        listView.style.display = "block";
        btnList.classList.remove("btn-outline-secondary");
        btnList.classList.add("btn-secondary");
        btnGrid.classList.remove("btn-secondary");
        btnGrid.classList.add("btn-outline-secondary");
    });

    // Función para cambiar a vista de tabla/grid
    btnGrid.addEventListener("click", function() {
        listView.style.display = "none";
        gridView.style.display = "flex";
        btnGrid.classList.remove("btn-outline-secondary");
        btnGrid.classList.add("btn-secondary");
        btnList.classList.remove("btn-secondary");
        btnList.classList.add("btn-outline-secondary");
    });
});