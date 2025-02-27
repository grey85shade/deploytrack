<div id="edit-popup" class="popup-overlay">
    <div class="popup-content">
        <div class="cabecera-popup">Editar Registro</div>
        <form id="edit-form" method="POST" action="">
            <input type="hidden" name="id" id="edit-id">
            <label for="edit-proyecto">Proyecto:</label>
            <input type="text" name="proyecto" id="edit-proyecto" required>
            <label for="edit-entorno">Entorno:</label>
            <select name="entorno" id="edit-entorno" required>
                <option value="PRO">PRO</option>
                <option value="PRE">PRE</option>
            </select>
            <label for="edit-version">Versión:</label>
            <input type="text" name="version" id="edit-version" required>
            <label for="edit-fecha">Fecha:</label>
            <input type="date" name="fecha" id="edit-fecha" required>
            <label for="edit-changelog">Changelog:</label>
            <textarea name="changeLog" id="edit-changelog" required></textarea>
            <button type="submit" class="boton-guardar">Guardar Cambios</button>
        </form>
    </div>
</div>