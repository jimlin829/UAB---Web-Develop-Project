<form id="editForm" enctype="multipart/form-data" onsubmit="updateUserData(event);">
        <h1>Editar Información de Usuario</h1>
    <div class = "editarPerfil">
        <div class="form-fields">
            <!-- Email (no editable) -->
            <label for="email">Dirección de correo electrónico:</label>
            <input type="email" id="email" name="email" value="<?php echo $emailUser; ?>" readonly>
            <div id="error-email" class="error-message" style="color: red;"></div>

            <!-- Contraseña -->
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required pattern="^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]+$" title="Debe contener al menos un número y una letra.">
            <div id="error-password" class="error-message" style="color: red;"></div>

            <!-- Nombre -->
            <label for="name">Nombre y apellidos:</label>
            <input type="text" id="name" name="name" value="<?php echo $nom; ?>" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Este campo solo puede tener letras.">
            <div id="error-name" class="error-message" style="color: red;"></div>

            <!-- Dirección -->
            <label for="address">Dirección:</label>
            <input type="text" id="address" name="address" value="<?php echo $direccio; ?>" required maxlength="30" title="Puede contener hasta 30 caracteres y espacios.">
            <div id="error-address" class="error-message" style="color: red;"></div>

            <!-- Población -->
            <label for="city">Población:</label>
            <input type="text" id="city" name="city" value="<?php echo $ciutat; ?>" required maxlength="30" title="Puede contener hasta 30 caracteres y espacios.">
            <div id="error-city" class="error-message" style="color: red;"></div>

            <!-- Código Postal -->
            <label for="postalCode">Código Postal:</label>
            <input type="text" id="postalCode" name="postalCode" value="<?php echo $codiPostal; ?>" required pattern="^\d{5}$" title="Debe contener 5 dígitos.">
            <div id="error-postalCode" class="error-message" style="color: red;"></div>
        </div>

        <div class="profile-section">
            <!-- Foto de perfil -->
            <label for="profilePhoto">Foto de perfil:</label>
            <img src="<?php echo $filesPublicPath . $fotoPerfil; ?>" alt="<?php echo $nom; ?>" />
            <input type="file" id="profilePhoto" name="profilePhoto">
            <div id="error-profilePhoto" class="error-message" style="color: red;"></div>
        </div>
    </div>
  <div id="success" style="color: green;"></div>

  <button type="submit">Guardar Cambios</button>
</form>