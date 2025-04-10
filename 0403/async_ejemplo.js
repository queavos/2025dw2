var data = [];
async function fetchData() {
    try {
        const response = await fetch("https://api.api-onepiece.com/v2/fruits/en"); // API de prueba
        data = await response.json();
        const tableBody = document.getElementById("data-table");
        
        tableBody.innerHTML = ""; // Limpiar la tabla antes de actualizar
        
        data.forEach(fruit => {
            const row = document.createElement("tr");
            row.innerHTML = `
                <td>${fruit.id}</td>
                <td>${fruit.name}</td>
                <td>${fruit.roman_name}</td>
                <td><img src='${fruit.filename}' /></td>
            `;
            tableBody.appendChild(row);
        });
        const input = document.getElementById("buscador");

        input.addEventListener("input", () => {
            let texto = input.value; // Convertir a minúsculas para coincidencias sin importar mayúsculas/minúsculas
            let tableBody = document.getElementById("data-table");
            tableBody.innerHTML = ""; // Limpiar la tabla antes de actualizar

            // Filtrar elementos que coincidan con el texto ingresado
            let filtrados = data.filter(item => {
                return item.roman_name !== undefined && item.roman_name.includes(texto);
            });

            // Agregar los resultados al DOM
            filtrados.map(fruit => {
                const row = document.createElement("tr");
                row.innerHTML = `
                <td>${fruit.id}</td>
                <td>${fruit.roman_name}</td>
                <td>${fruit.description}</td>
                <td><img src='${fruit.filename}' /></td>
            `;
                tableBody.appendChild(row);

            });

            // Mostrar mensaje si no hay coincidencias
            if (filtrados.length === 0) {
                tableBody.innerHTML = "<tr><td align='center' colspan='4'>No se han encontrado resultados<td></tr>";
            }
        });
    } catch (error) {
        console.error("Error al obtener los datos", error);
    }
}

fetchData();

