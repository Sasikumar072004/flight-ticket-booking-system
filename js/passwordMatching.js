// Add JavaScript to check password matching character by character
const passwordField = document.getElementById('password');
const confirmPasswordField = document.getElementById('confirm-password');
const passwordMatchMessage = document.getElementById('password-match-message');

confirmPasswordField.addEventListener('input', () => {
    const password = passwordField.value;
    const confirmPassword = confirmPasswordField.value;

    const minLength = Math.min(password.length, confirmPassword.length);
    let match = true;

    for (let i = 0; i < minLength; i++) {
        if (password[i] !== confirmPassword[i]) {
            match = false;
            break;
        }
    }

    if (match) {
        passwordMatchMessage.textContent = '';
    } else {
        passwordMatchMessage.textContent = 'Passwords do not match';
    }
});
