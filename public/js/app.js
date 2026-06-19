// Utilidades globales del Sistema de Trivias

const API_URL = '/api';

/**
 * Realiza una llamada AJAX autenticada
 */
async function apiCall(endpoint, method = 'GET', data = null) {
    const options = {
        method,
        headers: {
            'Content-Type': 'application/json',
            'Authorization': `Bearer ${localStorage.getItem('token')}`
        }
    };

    if (data) {
        options.body = JSON.stringify(data);
    }

    try {
        const response = await fetch(`${API_URL}${endpoint}`, options);
        const result = await response.json();

        if (!response.ok) {
            throw new Error(result.message || 'Error en la solicitud');
        }

        return result;
    } catch (error) {
        console.error('API Error:', error);
        showAlert(error.message, 'danger');
        throw error;
    }
}

/**
 * Muestra una alerta
 */
function showAlert(message, type = 'info') {
    const alertDiv = document.createElement('div');
    alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
    alertDiv.innerHTML = `
        ${message}
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    `;

    const container = document.querySelector('.container') || document.body;
    container.insertBefore(alertDiv, container.firstChild);

    setTimeout(() => alertDiv.remove(), 5000);
}

/**
 * Valida contraseña
 */
function validatePassword(password) {
    const hasUpper = /[A-Z]/.test(password);
    const hasLower = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasCorrectLength = password.length >= 8 && password.length <= 12;

    return hasUpper && hasLower && hasNumber && hasCorrectLength;
}

/**
 * Formatea bytes a unidad legible
 */
function formatBytes(bytes, decimals = 2) {
    if (bytes === 0) return '0 Bytes';

    const k = 1024;
    const dm = decimals < 0 ? 0 : decimals;
    const sizes = ['Bytes', 'KB', 'MB', 'GB'];
    const i = Math.floor(Math.log(bytes) / Math.log(k));

    return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
}

// Event listeners globales
document.addEventListener('DOMContentLoaded', function() {
    // Validación de contraseñas
    const passwordInputs = document.querySelectorAll('input[type="password"]');
    passwordInputs.forEach(input => {
        input.addEventListener('input', function() {
            const feedback = this.parentElement.querySelector('.password-feedback');
            if (!feedback) {
                const div = document.createElement('div');
                div.className = 'small password-feedback mt-1';
                this.parentElement.appendChild(div);
            }

            if (this.value) {
                const isValid = validatePassword(this.value);
                feedback.className = isValid ? 
                    'small password-feedback mt-1 text-success' : 
                    'small password-feedback mt-1 text-danger';
                feedback.textContent = isValid ? 
                    '✓ Contraseña válida' : 
                    '✗ Debe tener 8-12 caracteres, mayúsculas, minúsculas y números';
            }
        });
    });
});