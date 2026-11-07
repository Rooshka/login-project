document.addEventListener('DOMContentLoaded', function () {
    const forms = document.querySelectorAll('[data-validate]');

    forms.forEach(function (form) {
        const type = form.dataset.validate;

        function showError(name, message) {
            const input = form.querySelector('[name="' + name + '"]');
            const error = form.querySelector('[data-error-for="' + name + '"]');
            const field = input ? input.closest('.field') : null;

            if (!input || !error) {
                return;
            }

            error.textContent = message;
            input.setAttribute('aria-invalid', message ? 'true' : 'false');

            if (field) {
                field.classList.toggle('has-error', message !== '');
            }
        }

        function validEmail(value) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value);
        }

        function validate() {
            let valid = true;
            const name = form.querySelector('[name="name"]');
            const email = form.querySelector('[name="email"]');
            const password = form.querySelector('[name="password"]');
            const confirm = form.querySelector('[name="password_confirmation"]');

            if (type === 'register' && name) {
                const value = name.value.trim();
                let message = '';

                if (value.length < 2) {
                    message = 'Имя должно содержать минимум 2 символа.';
                } else if (value.length > 100) {
                    message = 'Имя слишком длинное.';
                }

                showError('name', message);
                if (message) valid = false;
            }

            if (email) {
                let message = '';
                if (!validEmail(email.value.trim())) {
                    message = 'Введи корректный адрес электронной почты.';
                } else if (email.value.trim().length > 190) {
                    message = 'Адрес электронной почты слишком длинный.';
                }

                showError('email', message);
                if (message) valid = false;
            }

            if (password) {
                let message = '';

                if (type === 'register' && password.value.length < 8) {
                    message = 'Пароль должен содержать минимум 8 символов.';
                } else if (type === 'register' && new TextEncoder().encode(password.value).length > 72) {
                    message = 'Пароль слишком длинный.';
                } else if (type === 'login' && password.value === '') {
                    message = 'Введи пароль.';
                }

                showError('password', message);
                if (message) valid = false;
            }

            if (type === 'register' && confirm && password) {
                let message = '';
                if (confirm.value === '') {
                    message = 'Повтори пароль.';
                } else if (confirm.value !== password.value) {
                    message = 'Пароли не совпадают.';
                }

                showError('password_confirmation', message);
                if (message) valid = false;
            }

            return valid;
        }

        form.addEventListener('submit', function (event) {
            if (!validate()) {
                event.preventDefault();
                const invalidInput = form.querySelector('[aria-invalid="true"]');
                if (invalidInput) {
                    invalidInput.focus();
                }
            }
        });

        form.querySelectorAll('input').forEach(function (input) {
            input.addEventListener('input', function () {
                validate();
            });
        });
    });
});
