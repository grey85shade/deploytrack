// Obtener elementos
const icon = document.getElementById('icon');
const popup = document.getElementById('popup');
const form = document.getElementById('recordForm');
const editPopup = document.getElementById('edit-popup');
const editForm = document.getElementById('edit-form');

// Abrir popup
icon.addEventListener('click', () => {
  popup.style.display = 'flex';
});

// Cerrar con clic fuera del popup
popup.addEventListener('click', (event) => {
  if (event.target === popup) {
    popup.style.display = 'none';
    form.reset();
  }
});

// Cerrar el popup de edición con clic fuera del cuadro
editPopup.addEventListener('click', (event) => {
  if (event.target === editPopup) {
    editPopup.style.display = 'none';
    editForm.reset();
  }
});

document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.btn-toggle-changelog');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const fullChangelog = this.previousElementSibling;
            const isExpanded = fullChangelog.classList.contains('expanded');

            if (isExpanded) {
                fullChangelog.classList.remove('expanded');
                this.innerHTML = '<i class="fas fa-chevron-down"></i>';
            } else {
                fullChangelog.classList.add('expanded');
                this.innerHTML = '<i class="fas fa-chevron-up"></i>';
            }
        });
    });

    const deleteForms = document.querySelectorAll('.delete-form');
    deleteForms.forEach(form => {
        form.addEventListener('submit', function(event) {
            event.preventDefault();
            const confirmed = confirm('Are you sure you want to delete this record?');
            if (confirmed) {
                form.submit();
            }
        });
    });

    document.querySelectorAll('.btn-edit').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            fetch(`../routes/web.php?id=${id}`)
                .then(response => response.text()) // Cambiar a .text() para depurar
                .then(data => {
                    console.log(data); // Agregar console.log para depurar
                    const jsonData = JSON.parse(data); // Convertir a JSON
                    document.getElementById('edit-id').value = jsonData.id;
                    document.getElementById('edit-proyecto').value = jsonData.proyecto;
                    document.getElementById('edit-entorno').value = jsonData.entorno;
                    document.getElementById('edit-version').value = jsonData.version;
                    document.getElementById('edit-fecha').value = jsonData.fecha;
                    document.getElementById('edit-changelog').value = jsonData.changeLog;
                    document.getElementById('edit-popup').style.display = 'flex';
                })
                .catch(error => console.error('Error:', error));
        });
    });

    document.getElementById('edit-form').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);
        formData.append('update', '1');
        fetch('../routes/web.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            console.log(data); // Agregar console.log para depurar
            if (data.success) {
                editPopup.style.display = 'none'; // Cerrar el popup de edición
                location.reload(); // Refrescar la página para ver los cambios
            } else {
                alert('Error al guardar los cambios');
            }
        })
        .catch(error => console.error('Error:', error));
    });
});
