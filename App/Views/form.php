<div class="popup-overlay" id="popup">
    <div class="popup-content">
        <form id="recordForm" method="POST" action="">
            <div class="cabecera-popup">Add New Record</div>
            <label for="proyecto">Proyecto</label>
            <select id="proyecto" name="proyecto" required>
                <option value="osiris">osiris</option>
                <option value="idcat">idcat</option>
            </select>

            <label for="environment">Entorno</label>
            <select id="environment" name="environment" required>
                <option value="PRE">PRE</option>
                <option value="PRO">PRO</option>
            </select>

            <label for="version">Versión</label>
            <input type="text" id="version" name="version" required>

            <label for="date">Fecha</label>
            <input type="date" id="date" name="date" required>

            <label for="changeLog">Change Log:</label>
            <textarea id="changeLog" name="changeLog" required></textarea>

            <button class="boton-guardar" type="submit">Submit</button>
        </form>
    </div>
</div>