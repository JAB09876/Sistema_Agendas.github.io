document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost:81/API/usuario/') // Reemplaza con la URL de tu API
        .then(response => {
            if (!response.ok) {
                throw new Error("Hubo un error al consumir el API.");
            }
            return response.json();
        })
        .then(data => {
            const tbody = document.getElementById('usuarios-tbody');
            console.log(data);
            data.results.forEach(usuario => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${usuario.id}</td>
                    <td>${usuario.nombre}</td>
                    <td>${usuario.telefono}</td>
                    <td>${usuario.correo_electronico}</td>
                    <td>${usuario.direccion}</td>
                    <td>${usuario.fecha_nacimiento}</td>
                    <td>${usuario.rol}</td>
                    <td>${usuario.estado === "1" ? "Activo" : "Inactivo"}</td>
                `;

                tbody.appendChild(row);
            });
        })
        .catch(error => {
            alert("Hubo un error después de consumir el API: " + error.message);
        });
});
