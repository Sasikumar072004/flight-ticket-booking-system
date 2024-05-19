
document.querySelectorAll('.password-toggle').forEach(function (toggle) {
    toggle.addEventListener('click', function () {
        const targetFieldId = this.getAttribute('toggle');
        const passwordField = document.querySelector(targetFieldId);

        if (passwordField.type === 'password') {
            passwordField.type = 'text';
        } else {
            passwordField.type = 'password';
        }
    });
});