// Smooth scroll para anclas
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({ behavior: 'smooth' });
        }
    });
});

// Validar formulario de registro
document.getElementById('registerForm')?.addEventListener('submit', function(e) {
    e.preventDefault();
    
    const name = this.querySelector('[name="name"]').value;
    const email = this.querySelector('[name="email"]').value;
    const nickname = this.querySelector('[name="nickname"]').value;
    const password = this.querySelector('[name="password"]').value;
    const passwordConfirm = this.querySelector('[name="password_confirmation"]').value;

    // Validaciones básicas
    if (name.length < 3) {
        alert('El nombre debe tener al menos 3 caracteres');
        return;
    }

    if (!isValidEmail(email)) {
        alert('Ingresa un email válido');
        return;
    }

    if (nickname.length < 3 || nickname.length > 100) {
        alert('El apodo debe tener entre 3 y 100 caracteres');
        return;
    }

    if (!isStrongPassword(password)) {
        alert('La contraseña debe tener 8-12 caracteres con mayúsculas, minúsculas y números');
        return;
    }

    if (password !== passwordConfirm) {
        alert('Las contraseñas no coinciden');
        return;
    }

    // Enviar registro
    submitRegistration({
        name,
        email,
        nickname,
        password,
        password_confirmation: passwordConfirm
    });
});

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}

function isStrongPassword(password) {
    const hasUpper = /[A-Z]/.test(password);
    const hasLower = /[a-z]/.test(password);
    const hasNumber = /[0-9]/.test(password);
    const hasCorrectLength = password.length >= 8 && password.length <= 12;

    return hasUpper && hasLower && hasNumber && hasCorrectLength;
}

function submitRegistration(data) {
    fetch('../../../api/auth/register', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data)
    })
    .then(response => response.json())
    .then(result => {
        if (result.success) {
            alert('¡Registro exitoso! Redirigiendo al login...');
            window.location.href = '../../login';
        } else {
            alert('Error: ' + (result.message || 'No se pudo completar el registro'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Ocurrió un error. Intenta de nuevo.');
    });
}

// Observador para animaciones en scroll
const observerOptions = {
    threshold: 0.1,
    rootMargin: '0px 0px -100px 0px'
};

const observer = new IntersectionObserver(function(entries) {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('animate-in');
            observer.unobserve(entry.target);
        }
    });
}, observerOptions);

document.querySelectorAll('.card, .feature-card, .level-card').forEach(el => {
    observer.observe(el);
});