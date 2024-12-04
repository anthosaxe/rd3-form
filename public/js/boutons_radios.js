document.addEventListener('DOMContentLoaded', function() {
    // Fonction pour vérifier les réponses et afficher/cacher les sections
    function checkSections() 
    {
        const systemFreeIssue = document.querySelector('input[name="system_free_issue"]:checked');
        const systemQualified = document.querySelector('input[name="system_qualified"]:checked');
        const systemIssue = document.querySelector('input[name="system_issue_option"]:checked'); // Sélectionne la valeur pour system_issue
        const beforeSection = document.getElementById('before');
        const errorMessage = document.getElementById('error-message');

        // Vérifie si "No" est sélectionné dans l'une des questions
        if (
            (systemFreeIssue && systemFreeIssue.value === 'no') ||
            (systemQualified && systemQualified.value === 'no') ||
            (systemIssue && systemIssue.value === 'yes') // Ajoute la condition pour system_issue
        ) 
        {
            beforeSection.classList.add('hidden');
            errorMessage.style.display = 'block'; // Affiche le message d'erreur
        } else {
            beforeSection.classList.remove('hidden');
            errorMessage.style.display = 'none'; // Cache le message d'erreur
        }

        // Affiche une popup pour chaque cas "No" si nécessaire
        if (
            (systemFreeIssue && systemFreeIssue.value === 'no') ||
            (systemQualified && systemQualified.value === 'no') ||
            (systemIssue && systemIssue.value === 'yes')
        ) {
            Swal.fire({
                title: 'Describe the Problem',
                html: `
                    <label for="problemDescription">Please describe the problem, an email will be sent to the administrators</label>
                    <textarea id="problemDescription" class="swal2-textarea" placeholder="Describe your issue here..."></textarea>
                `,
                showCancelButton: true,
                confirmButtonText: 'Send the email',
                cancelButtonText: 'Cancel',
                preConfirm: () => {
                    // Récupérer la description du problème entrée par l'utilisateur
                    const problemDescription = document.getElementById('problemDescription').value;
                    if (!problemDescription) {
                        Swal.showValidationMessage('Please describe the problem before sending.');
                        return false;
                    }
                    return problemDescription;
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    const description = result.value;

                    // Envoi de l'e-mail (exemple via AJAX)
                    // $.ajax({
                    //     url: '/send-problem-email',
                    //     method: 'POST',
                    //     data: {
                    //         _token: $('meta[name="csrf-token"]').attr('content'),
                    //         description: description
                    //     },
                    //     success: function(response) {
                    //         Swal.fire({
                    //             icon: 'success',
                    //             title: 'Email Sent',
                    //             text: 'Your problem description has been sent to the administrators.'
                    //         });
                    //     },
                    //     error: function(error) {
                    //         Swal.fire({
                    //             icon: 'error',
                    //             title: 'Error',
                    //             text: 'An error occurred while sending the email.'
                    //         });
                    //     }
                    // });
                }
            });
        }
    }

    // Ajoute des événements de changement sur les boutons radio pour vérifier les réponses
    document.querySelectorAll('input[name="system_free_issue"]').forEach(input => 
    {
        input.addEventListener('change', checkSections);
    });

    document.querySelectorAll('input[name="system_qualified"]').forEach(input => 
    {
        input.addEventListener('change', checkSections);
    });

    document.querySelectorAll('input[name="system_issue_option"]').forEach(input => 
    {
        input.addEventListener('change', checkSections);
    });
});
