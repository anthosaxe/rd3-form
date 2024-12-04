$(document).ready(function () 
{
    //alert("guard_columns");
    //var routeUrl = "{{ route('columns.all') }}";
    // Fonction Ajax pour charger des données
    
            $.ajax({
            url: routeGuardColumns,
            method: 'POST',
            dataType: 'json', // Indique que la réponse attendue est en JSON
            headers: {
                'X-Requested-With': 'XMLHttpRequest' // Indique qu'il s'agit d'une requête AJAX
            },
            data: {
                _token: $('meta[name="csrf-token"]').attr('content') // Ajout du jeton CSRF pour sécuriser la requête
            },
            success: function (response) 
            {
                console.log(response); // Vérification de la réponse
            
                let select = $('#guard_column_description'); // Supposez que vous avez un <select> avec cet ID
            
                // Vider les options existantes
                select.empty();
            
                // Ajouter une option vide
                select.append('<option value="">Select a guard column from RD3 Database</option>');
            
                // Itérer sur les données et créer une option pour chaque colonne
                response.forEach(function(response) {
                select.append(`<option value="${response.id}">
                    ${response.identifiant} - Type: ${response.type}, Chimie: ${response.chimie}, Dimension: ${response.dimension}
                </option>`);
            });
            },
            error: function (error) 
            {
                // Afficher un message d'erreur détaillé dans une alerte
                let errorMessage = `Erreur ${error.status}: ${error.statusText}\n\n${error.responseText}`;
                alert(errorMessage);

                // Affiche également l'erreur complète dans la console pour plus de détails
                console.error('Erreur complète:', error);
            }
        });
    });