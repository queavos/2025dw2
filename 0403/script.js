
async function fetchData() {
    try {
        const response = await fetch("https://api.api-onepiece.com/v2/fruits/en"); // API de prueba
        const data = await response.json();
        const tableBody = document.getElementById("data-table");
        
        tableBody.innerHTML = ""; // Limpiar la tabla antes de actualizar
        
        data.forEach(fruit => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${fruit.id}</td>
                <td>${fruit.roman_name}</td>
                <td>${fruit.description}</td>
                <td><img src='${fruit.filename}' /></td>
            `;
            tableBody.appendChild(row);
        });
    } catch (error) {
        console.error("Error al obtener los datos", error);
    }
}

// // Ejecutar la función al cargar la página
// fetchData();

//<input type="text" id="buscador" placeholder="Escribe para buscar..."></input>