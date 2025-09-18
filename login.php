<form id="loginForm" onsubmit="loginUser(event);">
    <h1>Iniciar Sesión</h1>
    
    <label for="loginEmail"> Dirección de correo electrónico: </label>
    <input type="email" id="loginEmail" name="loginEmail" required title="Ha de contenir un correu electrònic vàlid.">
    
    <label for="loginPassword">Contraseña:</label>
    <input type="password" id="loginPassword" name="loginPassword" required>
    
    <button type="submit">Iniciar Sesión</button>
</form>