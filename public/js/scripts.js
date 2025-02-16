// Obtener elementos
const icon = document.getElementById('icon');
const popup = document.getElementById('popup');
const form = document.getElementById('recordForm');

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

document.addEventListener('DOMContentLoaded', function() {
    const toggleButtons = document.querySelectorAll('.btn-toggle-changelog');

    toggleButtons.forEach(button => {
        button.addEventListener('click', function() {
            const shortChangelog = this.previousElementSibling.previousElementSibling;
            const fullChangelog = this.previousElementSibling;
            const isExpanded = fullChangelog.style.display === 'block';

            if (isExpanded) {
                fullChangelog.style.display = 'none';
                shortChangelog.style.display = 'inline';
                this.innerHTML = '<i class="fas fa-chevron-down"></i>';
            } else {
                fullChangelog.style.display = 'block';
                shortChangelog.style.display = 'none';
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
});
