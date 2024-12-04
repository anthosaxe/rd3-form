function updateChannels(input) {
    const container = document.getElementById('description-container');
    const count = parseInt(input.value, 10);

    // Vider le conteneur
    container.innerHTML = '';

    if (isNaN(count) || count < 1 || count > 4) {
        input.value = '';
        alert('Please enter a number between 1 and 4.');
        return;
    }

    // Ajouter les zones de texte dynamiquement
    for (let i = 1; i <= count; i++) {
        const label = document.createElement('label');
        label.textContent = `Please describe your mobile phase used in channel number ${i}`;

        const textarea = document.createElement('textarea');
        textarea.name = `channel_description_${i}`;
        textarea.id = `channel_description_${i}`;
        textarea.className = 'form-control';
        textarea.placeholder = `Description for channel ${i}`;

        // Ajouter au conteneur
        container.appendChild(label);
        container.appendChild(textarea);
    }

    
}
