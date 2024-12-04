<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Faculté de Pharmacie de l'ULB : Electronic Notebooks (ADMIN)</title>
    <link rel="stylesheet" href="<?= asset('css/styles.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/admin.css') ?>">
    <!-- Inclure Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Inclure Bootbox.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootbox@5.5.2/bootbox.min.js"></script>
    <!-- Inclure SweetAlert2 depuis un CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>
<body>

    <div class="form-container">
        <form>
        <div class="title-section">
            <img src="<?= asset('images/Logo-Pharmacie-ULB.png') ?>" alt="Logo ULB">
            <h1>Electronic Notebooks : administration</h1>
        </div>

        <!-- Section interactive UL/LI -->
        <ul id="interactiveList">
            <li>
                User Management 
                <div class="content">
                    <!-- Formulaire pour la gestion des utilisateurs -->
                    <h4 class="custom-heading">Add user</h4>
                    <form id="userForm">
                        <input type="text" id="username" class="form-control" placeholder="Nom d'utilisateur" onclick="event.stopPropagation();">
                        <input type="email" id="email" class="form-control" placeholder="Email" onclick="event.stopPropagation();">
                        <input type="password" id="password" class="form-control" placeholder="Mot de passe" onclick="event.stopPropagation();">
                        <button type="button" class="btn btn-success" onclick="addUser(); event.stopPropagation();">Ajouter</button>
                    </form>

                    <hr>

                    <h4 class="custom-heading">Edit or delete a user</h4>
                    <form id="modifyUserForm">
                        <select id="userList" class="form-control" onclick="event.stopPropagation();">
                            <option value="">Sélectionner un utilisateur</option>
                            <option value="user1">David Dubois</option>
                            <option value="user2">Jacques Tchutchoua</option>
                        </select>
                        <input type="text" id="newUsername" class="form-control" placeholder="Nouveau nom d'utilisateur" onclick="event.stopPropagation();">
                        <input type="email" id="newEmail" class="form-control" placeholder="Nouvel email" onclick="event.stopPropagation();">
                        <button type="button" class="btn btn-primary" onclick="modifyUser(); event.stopPropagation();">Modifier</button>
                        <button type="button" class="btn btn-danger" onclick="deleteUser(); event.stopPropagation();">Supprimer</button>
                    </form>
                </div>
            </li>

            <li>
                Column Management
                <div class="content">
                    <!-- Formulaire pour la gestion des colonnes -->
                    <h4 class="custom-heading">Add a column</h4>
                    <form id="columnForm">
                        <input type="text" id="columnName" class="form-control" placeholder="Nom de la colonne" onclick="event.stopPropagation();">
                        <input type="text" id="columnDescription" class="form-control" placeholder="Description de la colonne" onclick="event.stopPropagation();">
                        <button type="button" class="btn btn-success" onclick="addColumn(); event.stopPropagation();">Ajouter</button>
                    </form>

                    <hr>

                    <h4 class="custom-heading">Edit or delete a column</h4>
                    <form id="modifyColumnForm">
                        <select id="columnList" class="form-control" onclick="event.stopPropagation();">
                            <option value="">Sélectionner une colonne</option>
                            <!-- Les colonnes peuvent être ajoutées ici via JS -->
                        </select>
                        <input type="text" id="newColumnName" class="form-control" placeholder="Nouveau nom de la colonne" onclick="event.stopPropagation();">
                        <input type="text" id="newColumnDescription" class="form-control" placeholder="Nouvelle description de la colonne" onclick="event.stopPropagation();">
                        <button type="button" class="btn btn-primary" onclick="modifyColumn(); event.stopPropagation();">Modifier</button>
                        <button type="button" class="btn btn-danger" onclick="deleteColumn(); event.stopPropagation();">Supprimer</button>
                    </form>
                </div>
            </li>

            
            <li>
                Activity Reports
                <div class="content">
                    Contenu détaillé pour les rapports d'activités.
                </div>
            </li>
        </ul>

        </form>
    </div>

    <footer class="footer">
        <p>All rights reserved <?php echo date('Y') . '. ' ?> Developped by David Dubois, if you have any problem, please send an email to <a href="mailto:david.dubois@ulb.be">david.dubois@ulb.be</a>.</p>
    </footer>

    <script>
        let users = [
            { username: 'David Dubois', email: 'david.dubois@ulb.be' },
            { username: 'Jacques Tchutchoua', email: 'jacques.tchutchoua@ulb.be' }
        ];

        let columns = [
            { name: 'Colonne 1', description: 'Description Colonne 1' },
            { name: 'Colonne 2', description: 'Description Colonne 2' }
        ];

        // Gestion des utilisateurs
        function addUser() {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;

            if (username && email && password) {
                users.push({ username, email });
                updateUserList();
                Swal.fire('Utilisateur ajouté', `${username} a été ajouté avec succès`, 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
            }
        }

        function updateUserList() {
            const userList = document.getElementById('userList');
            userList.innerHTML = '<option value="">Sélectionner un utilisateur</option>';  // Réinitialise la liste
            users.forEach((user, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.textContent = user.username;
                userList.appendChild(option);
            });
        }

        function modifyUser() {
            const selectedUserIndex = document.getElementById('userList').value;
            const newUsername = document.getElementById('newUsername').value;
            const newEmail = document.getElementById('newEmail').value;

            if (selectedUserIndex !== "" && (newUsername || newEmail)) {
                if (newUsername) users[selectedUserIndex].username = newUsername;
                if (newEmail) users[selectedUserIndex].email = newEmail;
                updateUserList();
                Swal.fire('Utilisateur modifié', 'Les informations ont été mises à jour.', 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez sélectionner un utilisateur et remplir au moins un champ.', 'error');
            }
        }

        function deleteUser() {
            const selectedUserIndex = document.getElementById('userList').value;

            if (selectedUserIndex !== "") {
                const username = users[selectedUserIndex].username;
                users.splice(selectedUserIndex, 1);
                updateUserList();
                Swal.fire('Utilisateur supprimé', `${username} a été supprimé.`, 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez sélectionner un utilisateur à supprimer.', 'error');
            }
        }

        // Gestion des colonnes
        function addColumn() {
            const columnName = document.getElementById('columnName').value;
            const columnDescription = document.getElementById('columnDescription').value;

            if (columnName && columnDescription) {
                columns.push({ name: columnName, description: columnDescription });
                updateColumnList();
                Swal.fire('Colonne ajoutée', `${columnName} a été ajoutée avec succès`, 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez remplir tous les champs.', 'error');
            }
        }

        function updateColumnList() {
            const columnList = document.getElementById('columnList');
            columnList.innerHTML = '<option value="">Sélectionner une colonne</option>';  // Réinitialise la liste
            columns.forEach((column, index) => {
                const option = document.createElement('option');
                option.value = index;
                option.textContent = column.name;
                columnList.appendChild(option);
            });
        }

        function modifyColumn() {
            const selectedColumnIndex = document.getElementById('columnList').value;
            const newColumnName = document.getElementById('newColumnName').value;
            const newColumnDescription = document.getElementById('newColumnDescription').value;

            if (selectedColumnIndex !== "" && (newColumnName || newColumnDescription)) {
                if (newColumnName) columns[selectedColumnIndex].name = newColumnName;
                if (newColumnDescription) columns[selectedColumnIndex].description = newColumnDescription;
                updateColumnList();
                Swal.fire('Colonne modifiée', 'Les informations ont été mises à jour.', 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez sélectionner une colonne et remplir au moins un champ.', 'error');
            }
        }

        function deleteColumn() {
            const selectedColumnIndex = document.getElementById('columnList').value;

            if (selectedColumnIndex !== "") {
                const columnName = columns[selectedColumnIndex].name;
                columns.splice(selectedColumnIndex, 1);
                updateColumnList();
                Swal.fire('Colonne supprimée', `${columnName} a été supprimée.`, 'success');
            } else {
                Swal.fire('Erreur', 'Veuillez sélectionner une colonne à supprimer.', 'error');
            }
        }

        // Sélectionner tous les éléments <li> pour la gestion du clic et des contenus
        const listItems = document.querySelectorAll('#interactiveList li');

        listItems.forEach(item => {
            item.addEventListener('click', () => {
                listItems.forEach(i => {
                    if (i !== item) {
                        i.classList.remove('active');
                        i.querySelector('.content').style.display = 'none';
                    }
                });

                const content = item.querySelector('.content');
                if (item.classList.contains('active')) {
                    content.style.display = 'none'; // Cacher le contenu si déjà actif
                    item.classList.remove('active');
                } else {
                    content.style.display = 'block'; // Afficher le contenu
                    item.classList.add('active');
                }
            });
        });
    </script>

</body>
</html>
