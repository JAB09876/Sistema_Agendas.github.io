document.addEventListener("DOMContentLoaded", function() {
    fetch('http://localhost:81/API/usuario/') // Reemplaza con la URL de tu API
        .then(response => {
            if (!response.ok) {
                throw new Error("Hubo un error al consumir el API.");
            }
            return response.json();
        })
        .then(data => {
            const usersTableBody = document.getElementById('users-table-body');
                        data.results.forEach(user => {
                            const row = document.createElement('tr');
                            row.innerHTML = `
                                <td>${user.id}</td>
                                <td>${user.telefono}</td>
                                <td>${user.correo_electronico}</td>
                                <td>${user.usuario}</td>
                                <td>${user.direccion}</td>
                                <td>${user.fecha_nacimiento}</td>
                                <td>${user.rol}</td>
                                <td>${user.estado}</td>
                                <td>${user.nombre_sucursal || 'N/A'}</td>
                            `;
                            usersTableBody.appendChild(row);
            });
        })
        .catch(error => {
            alert("Hubo un error después de consumir el API: " + error.message);
        });
});
