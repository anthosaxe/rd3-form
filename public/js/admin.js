function openAdminModal() {
    Swal.fire({
        title: 'Admin Login',
        html:
            '<input id="username" class="swal2-input" placeholder="Username">' +
            '<input id="password" type="password" class="swal2-input" placeholder="Password">',
        focusConfirm: false,
        showCancelButton: true,
        confirmButtonText: 'Login',
        preConfirm: () => {
            const username = document.getElementById('username').value;
            const password = document.getElementById('password').value;

            if (!username || !password) {
                Swal.showValidationMessage('Please enter both username and password');
            } else {
                // Vérifier les credentials
                if (username === 'admincahier' && password === 'jacquesced2024!') {
                    // Utiliser url() pour générer la bonne URL d'administration
                    window.location.href = '{{ url("/admin") }}';
                } else {
                    // Afficher une erreur si les credentials sont incorrects
                    Swal.fire({
                        icon: 'error',
                        title: 'Login Failed',
                        text: 'Incorrect username or password'
                    });
                }
            }
        }
    });
}