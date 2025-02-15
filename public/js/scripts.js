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
