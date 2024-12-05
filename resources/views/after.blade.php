<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculté de Pharmacie de l'ULB : Electronic Notebooks</title>
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure Bootbox.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.min.js"></script>
    <!-- Inclure SweetAlert2 depuis un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('js/boutons_radios.js') }}" defer></script>
</head>
<body>

    <div class="admin-button-container">
        <button class="admin-button" onclick="openAdminModal()">Admin</button>
    </div>




    <div class="form-container">
        <div class="title-section">
        <!-- Lien vers l'image -->
        <img src="<?= asset('images/Logo-Pharmacie-ULB.png') ?>" alt="Logo ULB">
        <h1>Electronic Notebooks : After : LC1</h1>
    </div>

    <!-- Section 1: Personal Information -->
    <div class="section">
        <form action="{{ url('/submit_after') }}" method="POST">
        @csrf
        

            <!-- Section 5: After Finalizing the Analysis -->
            <div id="section5" class="section">
                <h2>After Finalizing the Analysis</h2>
                
                
                <div class="form-group">
                    <label for="injections">How many samples did you inject ?</label>
                    <input type="number" id="injections" class="text-input" min="1" max="500" placeholder="Enter a number between 1 and 500">
                </div>

                
            
            <div class="form-group">
                <label>Did you rinse your column and the system?</label>
                <div>
                <div class="custom-radio-group">
                    <input type="radio" id="rinsed_no" name="rinsed_column" value="no" onclick="toggleRinsedInput()">
                    <label for="rinsed_no">NO</label>

                    <input type="radio" id="rinsed_yes" name="rinsed_column" value="yes" onclick="toggleRinsedInput()">
                    <label for="rinsed_yes">YES</label>
                </div>

                <!-- Message affiché si "NO" est sélectionné -->
                <div id="rinsedMessage" style="display: none; margin-top: 10px;" class="alert-message">
                    Please flush your column and system and click "YES" once done to finalize the form.
                </div>

                </div>

                <!-- Zone de texte cachée initialement -->
                <div id="rinsed-details" style="display: none; margin-top: 10px;">
                    <label for="rinsed_column">How did you rinse your column and the system?</label>
                    <input type="text" id="rinsed_column" class="text-input">
                </div>

                <!-- Zone de texte qui sera affichée/masquée -->
                <div id="rinsed-details" style="display: none; margin-top: 10px;">
                    <label for="rinsed_column">How did you rinse your column and the system?</label>
                    <input type="text" id="rinsed_column" class="text-input">
                </div>
            </div>

                
            <div class="form-group">
                <label>Have you got any issue with the system?</label>
                <div class="custom-radio-group">
                    <input type="radio" id="system_issue_yes" name="system_issue_option" value="yes" onclick="handleSystemIssue()">
                    <label for="system_issue_yes">Yes</label>
            
                    <input type="radio" id="system_issue_no" name="system_issue_option" value="no" onclick="handleSystemIssue()">
                    <label for="system_issue_no">No</label>
                </div>
            </div>            
            
            <div class="form-group">
                <label for="other_info">Any other important information to record?</label>
                <input type="text" id="other_info" class="text-input">
            </div>
            
        </form>
    </div>
    <div>
        <!-- Ajoute le bouton de soumission en bas du formulaire -->
        <button type="submit" class="submit-button">Submit the form</button>
    </div>

    <div id="errorMessage" class="error hidden">
        Operation cancelled, please contact Jacques Tchutchoua or Cédric Delporte to resolve this issue.
    </div>

    
            <script>
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


</script> 
<script>
document.querySelector('.submit-button').addEventListener('click', function(event) {
    event.preventDefault(); // Empêche l'envoi immédiat du formulaire

    let timerInterval;
    Swal.fire({
        title: 'Thank you for completing the form',
        html: 'You will be redirected to the main form in <b></b> seconds.',
        timer: 3000,
        timerProgressBar: true,
        didOpen: () => {
            Swal.showLoading();
            const b = Swal.getHtmlContainer().querySelector('b');
            timerInterval = setInterval(() => {
                b.textContent = Math.ceil(Swal.getTimerLeft() / 1000); // Affiche le compte à rebours
            }, 100);
        },
        willClose: () => {
            clearInterval(timerInterval);
        }
    }).then((result) => {
        // Redirection après 3 secondes
        if (result.dismiss === Swal.DismissReason.timer) {
            window.location.href = '{{ url('/') }}'; // Redirige vers la vue d'index
        }
    });
});
</script>

<script>
    document.getElementById('injections').addEventListener('input', function () {
        // Utiliser une expression régulière pour supprimer les caractères non numériques
        this.value = this.value.replace(/[^0-9]/g, '');

        // Vérifier que la valeur est entre 1 et 500
        const value = parseInt(this.value, 10);
        if (value < 1 || value > 500 || isNaN(value)) {
            this.value = ''; // Réinitialiser si la valeur est hors limites ou non valide
            alert('Please enter a number between 1 and 500.');
        }
    });
</script>
<script>
    function toggleRinsedInput() {
        const rinsedDetails = document.getElementById('rinsed-details');
        const isRinsed = document.querySelector('input[name="rinsed_column"]:checked').value === 'yes';

        // Affiche la zone de texte si "YES" est sélectionné, sinon la cache
        rinsedDetails.style.display = isRinsed ? 'block' : 'none';
    }
</script>

<script>
    function handleSystemIssue() {
    const selectedOption = document.querySelector('input[name="system_issue_option"]:checked').value;
    const submitButton = document.querySelector('.submit-button');
    const errorMessage = document.getElementById('errorMessage');
    const rinsedDetails = document.getElementById('rinsed-details');
    const isRinsed = document.querySelector('input[name="rinsed_column"]:checked')?.value === 'yes';

    if (selectedOption === 'yes') {
        // Cache le bouton Submit et affiche un message d'erreur
        submitButton.style.display = 'none';
        errorMessage.style.display = 'block';

        // Affiche une boîte de dialogue pour décrire le problème
        Swal.fire({
            title: 'Describe the Problem',
            html: `
                <label for="problemDescription">Please describe the problem, an email will be sent to the administrators</label>
                <textarea id="problemDescription" class="swal2-textarea" placeholder="Describe your issue here..."></textarea>
            `,
            showCancelButton: true,
            confirmButtonText: 'Submit',
            cancelButtonText: 'Cancel',
            preConfirm: () => {
                const problemDescription = document.getElementById('problemDescription').value.trim();
                if (!problemDescription) {
                    Swal.showValidationMessage('Please describe the issue before submitting.');
                    return false;
                }
                return problemDescription;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const description = result.value;

                // Simule l'envoi d'un e-mail ou exécute une requête AJAX ici
                Swal.fire({
                    icon: 'success',
                    title: 'Email Sent',
                    text: 'Your problem description has been sent to the administrators.'
                });

                // Gère l'affichage de rinsedDetails
                if (isRinsed) {
                    rinsedDetails.style.display = 'block';
                } else {
                    rinsedDetails.style.display = 'none';
                }

                // Réactive le bouton Submit après traitement
                submitButton.style.display = 'block';
                errorMessage.style.display = 'none';
            }
        });
    } else if (selectedOption === 'no') {
        // Réaffiche le bouton Submit si "No" est sélectionné
        submitButton.style.display = 'block';
        errorMessage.style.display = 'none';

        // Masque les détails de "rinsed" par défaut
        rinsedDetails.style.display = 'none';
    }
}

</script>

<script>
    function toggleRinsedInput() {
        const rinsedMessage = document.getElementById('rinsedMessage');
        const rinsedDetails = document.getElementById('rinsed-details');
        const submitButton = document.querySelector('.submit-button');
        const rinsedValue = document.querySelector('input[name="rinsed_column"]:checked').value;

        if (rinsedValue === 'no') {
            rinsedMessage.style.display = 'block'; // Affiche le message
            rinsedDetails.style.display = 'none';  // Cache la zone de détails
            submitButton.style.display = 'none';   // Cache le bouton submit
        } else if (rinsedValue === 'yes') {
            rinsedMessage.style.display = 'none'; // Cache le message
            rinsedDetails.style.display = 'block'; // Affiche la zone de détails
            submitButton.style.display = 'inline-block'; // Réaffiche le bouton submit
        }
    }
</script>




</body>
</html>
