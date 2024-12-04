document.getElementById('manipulationForm').addEventListener('submit', function (event) {
    const manipulationInput = document.getElementById('manipulation_name');
    const manipulationError = document.getElementById('manipulationNameError');
    const manipulationValue = manipulationInput.value.trim();

    const userInput = document.getElementById('user');
    const userError = document.getElementById('userError');
    const userValue = userInput.value;

    const systemFreeIssueInputs = document.getElementsByName('system_free_issue');
    const systemFreeIssueError = document.getElementById('systemFreeIssueError');
    let isSystemFreeIssueSelected = false;

    const systemQualifiedInputs = document.getElementsByName('system_qualified');
    const systemQualifiedError = document.getElementById('systemQualifiedError');
    let isSystemQualifiedSelected = false;

    const channelCountInput = document.getElementById('channelCount');
    const channelCountError = document.getElementById('channelCountError');
    const channelCountValue = channelCountInput.value.trim();

    const columnDescriptionInput = document.getElementById('column_description');
    const columnDescriptionError = document.getElementById('columnDescriptionError');
    const columnDescriptionValue = columnDescriptionInput.value;

    const guardColumnDescriptionInput = document.getElementById('guard_column_description');
    const guardColumnDescriptionError = document.getElementById('guardColumnDescriptionError');
    const guardColumnDescriptionValue = guardColumnDescriptionInput.value;

    const typeOfSamplesInput = document.getElementById('type_of_samples');
    const typeOfSamplesError = document.getElementById('typeOfSamplesError');
    const typeOfSamplesValue = typeOfSamplesInput.value.trim();

    let isValid = true;

    // Validation pour manipulation_name
    if (manipulationValue.length < 3) {
        event.preventDefault();
        manipulationError.style.display = 'block';
        manipulationInput.classList.add('is-invalid');
        manipulationInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        manipulationError.style.display = 'none';
        manipulationInput.classList.remove('is-invalid');
    }

    // Validation pour user
    if (userValue === "") {
        event.preventDefault();
        userError.style.display = 'block';
        userInput.classList.add('is-invalid');
        userInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        userError.style.display = 'none';
        userInput.classList.remove('is-invalid');
    }

    // Validation pour system_free_issue
    for (const input of systemFreeIssueInputs) {
        if (input.checked) {
            isSystemFreeIssueSelected = true;
            break;
        }
    }

    if (!isSystemFreeIssueSelected) {
        event.preventDefault();
        systemFreeIssueError.style.display = 'block';
        systemFreeIssueInputs[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        systemFreeIssueError.style.display = 'none';
    }

    // Validation pour system_qualified
    for (const input of systemQualifiedInputs) {
        if (input.checked) {
            isSystemQualifiedSelected = true;
            break;
        }
    }

    if (!isSystemQualifiedSelected) {
        event.preventDefault();
        systemQualifiedError.style.display = 'block';
        systemQualifiedInputs[0].scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        systemQualifiedError.style.display = 'none';
    }

    // Validation pour channelCount
    if (channelCountValue === "" || channelCountValue < 1 || channelCountValue > 4) {
        event.preventDefault();
        channelCountError.style.display = 'block';
        channelCountInput.classList.add('is-invalid');
        channelCountInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        channelCountError.style.display = 'none';
        channelCountInput.classList.remove('is-invalid');
    }

    // Validation pour column_description
    if (columnDescriptionValue === "") {
        event.preventDefault();
        columnDescriptionError.style.display = 'block';
        columnDescriptionInput.classList.add('is-invalid');
        columnDescriptionInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        columnDescriptionError.style.display = 'none';
        columnDescriptionInput.classList.remove('is-invalid');
    }

    // Validation pour guard_column_description
    if (guardColumnDescriptionValue === "") 
    {
        event.preventDefault();
        guardColumnDescriptionError.style.display = 'block';
        guardColumnDescriptionInput.classList.add('is-invalid');
        guardColumnDescriptionInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else 
    {
        guardColumnDescriptionError.style.display = 'none';
        guardColumnDescriptionInput.classList.remove('is-invalid');
    }

    // Validation pour type_of_samples
    if (typeOfSamplesValue === "") {
        event.preventDefault();
        typeOfSamplesError.style.display = 'block';
        typeOfSamplesInput.classList.add('is-invalid');
        typeOfSamplesInput.scrollIntoView({ behavior: 'smooth', block: 'center' });
        isValid = false;
    } else {
        typeOfSamplesError.style.display = 'none';
        typeOfSamplesInput.classList.remove('is-invalid');
    }

    // Validation pour chaque textarea de channel_description
    const channelDescriptions = document.querySelectorAll('textarea[name^="channel_description_"]');
    channelDescriptions.forEach((textarea, index) => 
    {
        const value = textarea.value.trim();
        const errorElement = document.getElementById(`channelDescriptionError_${index + 1}`);

        if (value === "") 
        {
                event.preventDefault();
                errorElement.style.display = 'block';
                textarea.classList.add('is-invalid');
                textarea.scrollIntoView({ behavior: 'smooth', block: 'center' });
                isValid = false;
        } 
        else 
        {
            errorElement.style.display = 'none';
            textarea.classList.remove('is-invalid');
        }
    });

    // Empêche la soumission si l'un des champs est invalide
    if (!isValid) {
        event.preventDefault();
    }
});