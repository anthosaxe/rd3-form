document.getElementById('submitButton').addEventListener('click', function () 
{
    // Récupérer le temps depuis le div
    const timerDiv = document.getElementById('timer').textContent;

    // Convertir le format `hh:mm:ss` en secondes
    const timeParts = timerDiv.split(':').map(Number);
    const totalSeconds = (timeParts[0] * 3600) + (timeParts[1] * 60) + timeParts[2];

    // Envoyer les données au backend
    fetch('/call_form_after', 
    {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ elapsed_time: totalSeconds }),
    })
    .then(response => response.json())
    .then(data => {
        console.log('Temps enregistré avec succès', data);
        // Redirection après enregistrement (facultatif)
        window.location.href = '/after';
    })
    .catch(error => console.error('Erreur:', error));
});
