<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LC1</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('js/columns.js') }}" defer></script>
    <script src="{{ asset('js/users.js') }}" defer></script>
    <script src="{{ asset('js/guard_columns.js') }}" defer></script>
    <script src="{{ asset('js/update_channels.js') }}" defer></script>
    <script src="{{ asset('js/boutons_radios.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer></script>
    <script src="{{ asset('js/form_errors.js') }}" defer></script>
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure Bootbox.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.min.js"></script>
    <!-- Inclure SweetAlert2 depuis un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
</head>

<body>

    <div class="admin-button-container">
        <button class="admin-button" onclick="openAdminModal()">Admin</button>
    </div>

    <div class="form-container">
        <div class="title-section">
        <!-- Lien vers l'image -->
        <img src="<?= asset('images/Logo-Pharmacie-ULB.png') ?>" alt="Logo ULB">
        <h1>LC1</h1>
    </div>

    <!-- Section 1: Personal Information -->
    <div class="section">
        <form id="manipulationForm" action="{{ route('submit_before') }}" method="POST">
        @csrf
        <h2>Personal Information</h2>
        <div id="userError" class="error-message" style="display: none;">
            Please select a user.
        </div>
        <div class="form-group">
            <label for="user">Firstname and Surname of User</label>
            <select id="user" class="text-input" name="user">
                
                <!-- Add more users as needed -->
            </select>
        </div>
        
        <!-- Message d'erreur pour le champ manipulation_name -->
        <div id="manipulationNameError" class="error-message" style="display: none;">
            The manipulation name field is required and must contain at least 3 characters.
        </div>

        <div class="form-group">
            <label for="manipulation_name">Name of the manipulation/analysis/test</label>
            <input type="text" id="manipulation_name" class="text-input" name="manipulation_name">
        </div>

    
    
    <!-- Section 2: System Free of Issue -->
    <div class="section">
        <h2>System Free of Issue</h2>
        <p>Is the system usable and free of issue?</p>
        <div id="systemFreeIssueError" class="error-message" style="display: none;">
            Please select an option for system free of issue.
        </div>
        <div class="custom-radio-group">
            <input type="radio" id="system_free_yes" name="system_free_issue" value="yes">
            <label for="system_free_yes">Yes</label>

            <input type="radio" id="system_free_no" name="system_free_issue" value="no">
            <label for="system_free_no">No</label>
        </div>

    </div>

    <!-- Section 3: System Qualified -->
    <div class="section">
        <h2>System Qualified</h2>
        <label>Has the system been qualified within less than one year (six months)?</label>
        <div id="systemQualifiedError" class="error-message" style="display: none;">
            Please select an option for system qualification.
        </div>
        <div class="custom-radio-group">
            <input type="radio" id="system_qualified_yes" name="system_qualified" value="yes">
            <label for="system_qualified_yes">Yes</label>

            <input type="radio" id="system_qualified_no" name="system_qualified" value="no">
            <label for="system_qualified_no">No</label>
        </div>
    </div>

    <!-- Message d'erreur -->
    <div id="error-message" class="error hidden">
        Operation cancelled, please contact Jacques Tchutchoua or Cédric Delporte to resolve this issue.
    </div>

    <!-- Section before --> 
        
        
        <!-- Section 4: Describe Your Use -->
        <div id="before" class="section">
            <h2>Describe Your Use</h2>
            
            
            <div class="form-group">
                <label>What's the number of channels that you will use ?</label>
                <div id="channelCountError" class="error-message" style="display: none;">
                    Please enter a channel count between 1 and 4.
                </div>
                <div id="channel-container">
                    <input type="number" id="channelCount" name="channelCount" class="text-input" min="1" max="4" placeholder="Enter a channel (1-4)" oninput="updateChannels(this)">
                </div>
                <div id="channelDescriptionError_1" class="error-message" style="display: none;">
                    Please provide a description for Channel 1.
                </div>
                <div id="description-container"></div> <!-- Conteneur pour les descriptions de canaux --></div>
                
                
                
                <div class="form-group">
                    <label>Choose an option for the column:</label>
                    <div class="custom-radio-group">
                        <input type="radio" id="type1" name="column_type" value="Type1">
                        <label for="type1">Do you use a column from RD3 database?</label>

                        <input type="radio" id="type2" name="column_type" value="Type2">
                        <label for="type2">I use my own column</label>

                        <input type="radio" id="type3" name="column_type" value="Type3">
                        <label for="type3">I do not use column</label>
                    </div>
            
                 </div>
            <!-- Other Inputs -->
            <div class="form-group">
                <label id="columnDescriptionLabel" style="display: none;" for="column_description">Which type of column do you use ?</label>
                <div id="columnDescriptionError" class="error-message" style="display: none;">
                    Please select a column description.
                </div>
                <select id="column_description" class="text-input" name="column_description" style="display: none;"></select>   
            </div>

            <div class="form-group">
                <label id="myOwnColumnDescriptionLabel" style="display: none;" for="column_description">Please describe your column (Reference, dimension...) ?</label>
                <div id="columnDescriptionError" class="error-message" style="display: none;">
                    Please select a RD3 column description.
                </div>
                <input type="text" id="your_own_column_description" class="text-input" name="your_own_column_description" style="display: none;" placeholder="Please describe your own column">
            </div>

            <div>
                <label id="noColumnLabel" style="display: none;" for="column_description">No column used</label>
            </div>

            <div class="form-group">
                <label id="guardColumnTitleLabel">Choose an option for the guard column :</label>
                <div class="custom-radio-group">
                    <input type="radio" id="guard_type1" name="guard_column_type" value="guard_type1">
                    <label for="guard_type1">Do you use a guard column from RD3 database ?</label>
                
                
                    <input type="radio" id="guard_type2" name="guard_column_type" value="guard_type2">
                    <label for="guard_type2">I use my own guard column</label>
                
                    <input type="radio" id="guard_type3" name="guard_column_type" value="guard_type3">
                    <label for="guard_type3">I do not use guard column</label>
                </div>
            </div>


            <div class="form-group">
                <label id="guardmyOwnColumnDescriptionLabel" for="guard_column_description"> Which type of guard column do you use ? </label>
                <div id="guardColumnDescriptionError" class="error-message" style="display: none;">
                        Please select a guard column description.
                    </div>
                <div style="display: flex; align-items: center;">
                    <!-- Liste déroulante -->
                    <select style="display: none;" id="guard_column_description" class="text-input" name="guard_column_description"></select>
                </div>
                <input type="text" id="your_own_column_description_text" class="text-input" name="your_own_column_description_text" style="display: none;" placeholder="Please describe your own guard column (reference, dimension...)">
                </div>
                <div><label id="guardnoColumnLabel"> No use of guard column </label></div>            

                <div class="form-group">
                    <label for="type_of_samples">Type of Samples</label>
                    <div id="typeOfSamplesError" class="error-message" style="display: none;">
                        Please enter the type of samples.
                    </div>
                    <input type="text" id="type_of_samples" class="text-input" name="type_of_samples">
                </div>
                <!-- Affiche l'erreur si manipulation_name n'est pas valide -->
                @error('manipulation_name')
                    <div class="error-message" style="color: red;">
                        {{ $message }}
                    </div>
                @enderror
                <div>
                    <!-- Ajoute le bouton de soumission en bas du formulaire -->
                    <button id="btn_submit" type="submit" class="submit-button">Submit the form</button>
                </div>
            </div>    
            </form>
        </div>


    
    <!-- <footer class="footer">
        <p>All rights reserved <?php echo date('Y') . '. ' ?> Developped by David Dubois, if you have any problem, please send an email to <a href="mailto:david.dubois@ulb.be">david.dubois@ulb.be</a>.</p>
        <p>If you meet any other problem, please contact Jacques Tchutchoua at <a href="mailto:jacques.tchutchoua@ulb.be">jacques.tchutchoua@ulb.be</a> or Cédric Delporte at <a href="mailto:cedric.delporte@ulb.be">cedric.delporte@ulb.be

    </footer> -->

    <script>
    const dropdown = document.getElementById('guard_column_description');
    const noGuardCheckboxContainer = document.getElementById('no_guard_column_container');
    const externalGuardCheckboxContainer = document.getElementById('external_guard_column_container');

    dropdown.addEventListener('change', function () {
        if (dropdown.value === "") {
            // Affiche la case à cocher "No Guard Column" et cache l'autre
            noGuardCheckboxContainer.style.display = 'block';
            externalGuardCheckboxContainer.style.display = 'none';
        } else {
            // Cache la case à cocher "No Guard Column" et affiche l'autre
            noGuardCheckboxContainer.style.display = 'none';
            externalGuardCheckboxContainer.style.display = 'block';
        }
    });
</script>


<script>
    var routeUsers = "{{ route('users.all') }}";
    //04/11/24 je suis obigé de mettre ceci, autrement route not found 404
    var routeColumns = "{{ route('columns.all') }}";
    var routeGuardColumns = "{{ route('guardcolumns.all') }}";
    
</script>

<script>
// Sélectionner les éléments que nous voulons afficher
const type1Radio = document.getElementById('type1');
const columnDescriptionLabel = document.getElementById('columnDescriptionLabel');
const columnDescriptionSelect = document.getElementById('column_description');

const type2Radio = document.getElementById('type2');
const myOwnColumnDescriptionLabel = document.getElementById('myOwnColumnDescriptionLabel');
const myOwnColumnDescriptionSelect = document.getElementById('your_own_column_description');

const type3Radio = document.getElementById('type3');
const noColumnLabel = document.getElementById('noColumnLabel');


// Ajouter un gestionnaire d'événement au bouton radio
type1Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        columnDescriptionLabel.style.display = 'block';
        columnDescriptionSelect.style.display = 'block';
        myOwnColumnDescriptionLabel.style.display = 'none';
        myOwnColumnDescriptionSelect.style.display = 'none';
        noColumnLabel.style.display = 'none';
        // Réafficher les éléments pour la guard column
        guardtype1Radio.parentElement.style.display = 'block';
        guardtype2Radio.parentElement.style.display = 'block';
        guardtype3Radio.parentElement.style.display = 'block';
        guardTitleLabel.parentElement.style.display = 'block';
        
        
    }
});

type2Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        myOwnColumnDescriptionLabel.style.display = 'block';
        myOwnColumnDescriptionSelect.style.display = 'block';
        columnDescriptionLabel.style.display = 'none';
        columnDescriptionSelect.style.display = 'none';
        noColumnLabel.style.display = 'none';
        // Réafficher les éléments pour la guard column
        guardtype1Radio.parentElement.style.display = 'block';
        guardtype2Radio.parentElement.style.display = 'block';
        guardtype3Radio.parentElement.style.display = 'block';
        guardTitleLabel.parentElement.style.display = 'block';
        
        
    }
});

type3Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        myOwnColumnDescriptionLabel.style.display = 'none';
        myOwnColumnDescriptionSelect.style.display = 'none';
        columnDescriptionLabel.style.display = 'none';
        columnDescriptionSelect.style.display = 'none';
        noColumnLabel.style.display = 'block';

        // Masquer tous les éléments liés à la guard column
        guardtype1Radio.parentElement.style.display = 'none';
        guardtype2Radio.parentElement.style.display = 'none';
        guardtype3Radio.parentElement.style.display = 'none';
        guardcolumnDescriptionLabel.style.display = 'none';
        guardcolumnDescriptionSelect.style.display = 'none';
        guardmyOwnColumnDescriptionLabel.style.display = 'none';
        guardmyOwnColumnDescriptionText.style.display = 'none';
        guardnoColumnLabel.style.display = 'none';
        guardTitleLabel.style.display = 'none';
        
        
    }
});

</script>

<script>
// Sélectionner les éléments que nous voulons afficher
const guardTitleLabel = document.getElementById('guardColumnTitleLabel');
const guardtype1Radio = document.getElementById('guard_type1');
const guardcolumnDescriptionLabel = document.getElementById('guard_column_description');
const guardcolumnDescriptionSelect = document.getElementById('guard_column_description');

const guardtype2Radio = document.getElementById('guard_type2');
const guardmyOwnColumnDescriptionLabel = document.getElementById('guardmyOwnColumnDescriptionLabel');
const guardmyOwnColumnDescriptionText = document.getElementById('your_own_column_description_text');

const guardtype3Radio = document.getElementById('guard_type3');
const guardnoColumnLabel = document.getElementById('guardnoColumnLabel');


// Ajouter un gestionnaire d'événement au bouton radio
guardtype1Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        guardcolumnDescriptionLabel.style.display = 'block';
        guardcolumnDescriptionSelect.style.display = 'block';
        guardmyOwnColumnDescriptionLabel.style.display = 'none';
        guardmyOwnColumnDescriptionText.style.display = 'none';
        guardnoColumnLabel.style.display = 'none';
        
    }
});

guardtype2Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        guardmyOwnColumnDescriptionLabel.style.display = 'block';
        guardmyOwnColumnDescriptionText.style.display = 'block';
        guardcolumnDescriptionLabel.style.display = 'none';
        guardcolumnDescriptionSelect.style.display = 'none';
        guardnoColumnLabel.style.display = 'none';
        
    }
});

guardtype3Radio.addEventListener('change', function() 
{
    if (this.checked) 
    {
        // Afficher les éléments en retirant le display: none
        guardmyOwnColumnDescriptionLabel.style.display = 'none';
        guardcolumnDescriptionSelect.style.display = 'none';
        guardcolumnDescriptionLabel.style.display = 'none';
        guardmyOwnColumnDescriptionText.style.display = 'none';
        guardnoColumnLabel.style.display = 'block';
        
    }
});

</script>


</body>

</html>
