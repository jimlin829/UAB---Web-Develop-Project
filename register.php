<form id="registrationForm" onsubmit="registerUser(event);">
    <h1>Registro de Usuario</h1>
    
    <!--Email-->
    <label for="email">Dirección de correo electrónico:</label>
    <input type="email" id="email" name="email" required title="Ha de contenir un correu electrònic vàlid.">
    <div id="error-email" class="error-message" style="color: red;"></div>

    <!--Nombre-->
    <label for="name">Nombre y apellidos:</label>
    <input type="text" id="name" name="name" required pattern="[a-zA-ZÀ-ÿ\s]+" title="Este campo solo puede tener letras.">
    <div id="error-name" class="error-message" style="color: red;"></div>

    <!--Contraseña-->
    <label for="password">Contraseña:</label>
    <input type="password" id="password" name="password" required pattern="^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]+$" title="Debe contener almenos un número y una letra.">
    <div id="error-password" class="error-message" style="color: red;"></div>
    
    <!--Confirmar contraseña-->
    <label for="confirm-password">Confirma la contraseña:</label>
    <input type="password" id="confirm-password" name="confirm-password" required pattern="^(?=.*[A-Za-z])(?=.*[0-9])[A-Za-z0-9]+$" title="Camp alfanumèric."
        oninput="this.setCustomValidity(this.value !== document.getElementById('password').value ? 'Las contraseñas no coinciden.' : '')">
    <div id="error-confirm-password" class="error-message" style="color: red;"></div>

    <!--Dirección-->
    <label for="address">Dirección:</label>
    <input type="text" id="address" name="address" required maxlength="30" title="Puede contener hasta 30 caracteres y espacios.">
    <div id="error-address" class="error-message" style="color: red;"></div>
    
    <!--Población-->
    <label for="city">Población:</label>
    <input type="text" id="city" name="city" required maxlength="30" title="Puede contener hasta 30 caracteres y espacios.">
    <div id="error-city" class="error-message" style="color: red;"></div>
    
    <!--Codigo postal-->
    <label for="postalCode">Codigo Postal:</label>
    <input type="text" id="postalCode" name="postalCode" required pattern="^\d{5}$" title="Debe contener 5 dígitos.">
    <div id="error-postalCode" class="error-message" style="color: red;"></div>

    <div id="success" style="color: green;"></div>

    <button type="submit">Registrar</button>
</form>


