fetch("https://jsonplaceholder.typicode.com/posts", {
    method: "POST",
    headers: {
        "Content-Type": "application/json"
    },
    body: JSON.stringify({ title: "Hola", body: "Esto es un post", userId: 1 })
})
    .then(response => response.json())
    .then(data => console.log(data))
    .catch(error => console.error("Hubo un error:", error));
