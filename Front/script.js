document.addEventListener('DOMContentLoaded', function() {
    fetchUsers();

    const userForm = document.getElementById('userForm');
    const userModalLabel = document.getElementById('userModalLabel');
    const userIdInput = document.getElementById('userId');
    const telefonoInput = document.getElementById('telefono');
    const correoInput = document.getElementById('correo_electronico');
    const nombreInput = document.getElementById('nombre');
    const direccionInput = document.getElementById('direccion');
    const fechaNacimientoInput = document.getElementById('fecha_nacimiento');
    const contrasennaInput = document.getElementById('contrasenna');
    const rolSelect = document.getElementById('rol');
    const estadoSelect = document.getElementById('estado');
    const sucursalGroup = document.getElementById('sucursalGroup');
    const idSucursalInput = document.getElementById('idSucursal');

    rolSelect.addEventListener('change', function() {
        if (rolSelect.value === 'Encargado') {
            sucursalGroup.style.display = 'block';
        } else {
            sucursalGroup.style.display = 'none';
        }
    });

    userForm.addEventListener('submit', function(event) {
        event.preventDefault();

        const userId = userIdInput.value;
        const method = userId ? 'PUT' : 'POST';
        const url = userId ? `api/usuarios/${userId}` : 'api/usuarios';

        const userData = {
            id: userId,
            telefono: telefonoInput.value,
            correo_electronico: correoInput.value,
            nombre: nombreInput.value,
            direccion: direccionInput.value,
            fecha_nacimiento: fechaNacimientoInput.value,
            contrasenna: contrasennaInput.value,
            rol: rolSelect.value,
            estado: estadoSelect.value,
            idSucursal: rolSelect.value === 'Encargado' ? idSucursalInput.value : null
        };

        fetch(url, {
            method: method,
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(userData)
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                fetchUsers();
                userForm.reset();
                const userModal = bootstrap.Modal.getInstance(document.getElementById('userModal'));
                userModal.hide();
            } else {
                alert('Error al guardar el usuario');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});

function fetchUsers() {
    fetch('api/usuarios')
    .then(response => response.json())
    .then(data => {
        const userTableBody = document.getElementById('userTableBody');
        userTableBody.innerHTML = '';

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
                <td>${user.estado === 1 ? 'Activo' : 'Inactivo'}</td>
                <td>${user.nombre_sucursal || ''}</td>
                <td>
                    <button class="btn btn-sm btn-warning" onclick="editUser(${user.id})">Editar</button>
                    <button class="btn btn-sm btn-danger" onclick="deleteUser(${user.id})">Eliminar</button>
                </td>
            `;

            userTableBody.appendChild(row);
        });
    })
    .catch(error => console.error('Error:', error));
}

function editUser(id) {
    fetch(`api/usuarios/${id}`)
    .then(response => response.json())
    .then(data => {
        const user = data.results;

        document.getElementById('userModalLabel').innerText = 'Editar Usuario';
        document.getElementById('userId').value = user.id;
        document.getElementById('telefono').value = user.telefono;
        document.getElementById('correo_electronico').value = user.correo_electronico;
        document.getElementById('nombre').value = user.usuario;
        document.getElementById('direccion').value = user.direccion;
        document.getElementById('fecha_nacimiento').value = user.fecha_nacimiento;
        document.getElementById('contrasenna').value = user.contrasenna;
        document.getElementById('rol').value = user.rol;
        document.getElementById('estado').value = user.estado;
        if (user.rol === 'Encargado') {
            document.getElementById('idSucursal').value = user.idSucursal;
            document.getElementById('sucursalGroup').style.display = 'block';
        } else {
            document.getElementById('sucursalGroup').style.display = 'none';
        }

        const userModal = new bootstrap.Modal(document.getElementById('userModal'));
        userModal.show();
    })
    .catch(error => console.error('Error:', error));
}

function deleteUser(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este usuario?')) {
        fetch(`api/usuarios/${id}`, {
            method: 'DELETE'
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 200) {
                fetchUsers();
            } else {
                alert('Error al eliminar el usuario');
            }
        })
        .catch(error => console.error('Error:', error));
    }
}
