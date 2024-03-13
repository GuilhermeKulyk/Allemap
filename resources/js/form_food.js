import $ from 'jquery';

$(document).ready(function() {

    var includedIngredients = [];
    var foodIngredients = [];

    // no carregar da pagina ja carrega os ingredientes inclusos da lista principal.
    $('#includedIngredients').empty();
    $('#mainIngredientList li').each(function() {
        var ingredientId = $(this).data('id');
        var ingredientName = $(this).text().trim();
        $('#includedIngredients').append('<li class="list-group-item bg-success" data-id="' + ingredientId + '">' + ingredientName + '</li>');
        includedIngredients.push({ id: ingredientId, name: ingredientName });
        //console.log(includedIngredients);
        hideIncludedIngredients(includedIngredients);
    });

    // Function to update the list of included ingredients in the modal
    function updateIncludedIngredientsModal() {
        $('#includedIngredients').empty();
        includedIngredients.forEach(function(ingredient) {
            $('#includedIngredients').append('<li class="list-group-item bg-success" data-id=' + ingredient.id + '>' + ingredient.name + '</li>');
        });
    }

    // Function to update the list of included ingredients in the main form
    function updateIncludedIngredientsForm() {
        $('#mainIngredientList').empty(); // Clear the list of ingredients in the main form
        includedIngredients.forEach(function(ingredient) {
            $('#mainIngredientList').append('<li class="list-group-item" data-id="' + ingredient.id + '">' + ingredient.name + '</li>');
        });
    }

    // Function to add an ingredient to the list and form
    function addIngredientToList(ingredient) {
        includedIngredients.push(ingredient);
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
        addIngredient(ingredient.id);
    }

    // Function to add the ingredient-id to the foodIngredients array
    function addIngredient(ingredientId) {
        // Check if the ingredient-id already exists in the array to avoid duplicates
        if (!foodIngredients.includes(ingredientId)) {
            foodIngredients.push(ingredientId);
        }
    }

    // Function to remove the ingredient-id from the foodIngredients array
    function removeIngredient(ingredientId) {
        // Find the index of ingredientId in the array
        var index = foodIngredients.indexOf(ingredientId);

        // If ingredientId is in the array, remove it
        if (index !== -1) {
            foodIngredients.splice(index, 1);
        }
    }

    // Event handler for clicking the save ingredients button
    $('#saveIngredients').on('click', function() {
        // Clear the list of ingredients in the modal
        //$('#includedIngredients').empty();
        // Update the list of ingredients in the main form
        //updateIncludedIngredientsForm();
        // Hide the modal
        $('#addIngredientsModal').modal('hide');
    });

    // Event handler for clicking the search button
    $('#searchButton').on('click', function() {
        var searchText = $('#ingredientSearch').val().toLowerCase();
        $('#ingredientList li').each(function() {
            var ingredientText = $(this).text().toLowerCase();
            if (ingredientText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        hideIncludedIngredientsFromSearchResults();
    });

    // Event handler for pressing Enter in the search field
    $('#ingredientSearch').keypress(function(e) {
        if (e.which === 13) {
            $('#searchButton').click();
        }
    });

    // Event handler for clicking ingredients in the search results list
    $(document).on('click', '#ingredientList li', function() {
        var ingredientId = $(this).data('id'); // Get the ID of the ingredient from the data-id attribute
        var ingredientName = $(this).text().trim(); // Get the name of the ingredient (remove extra spaces)
        
        // Add the ingredient to the list of ingredients
        addIngredientToList({ id: ingredientId, name: ingredientName });
        
        $(this).hide(); // Hide the ingredient from the search results list
        hideIncludedIngredientsFromSearchResults(); // Hide included ingredients from the search results list
    });

    // Event handler for clicking ingredients in the included list to remove them
    $(document).on('click', '#includedIngredients li', function() {
        var ingredientName = $(this).text();
        var ingredientId = $(this).data('id');
        includedIngredients = includedIngredients.filter(function(ingredient) {
            return ingredient.name !== ingredientName;
        });
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
        removeIngredient(ingredientId);
        //console.log(foodIngredients);
        $('#ingredientList li:contains("' + ingredientName + '")').show();
    });

    // Function to hide included ingredients from the search results list
    function hideIncludedIngredientsFromSearchResults() {
        includedIngredients.forEach(function(ingredient) {
            $('#ingredientList li:contains("' + ingredient.name + '")').hide();
        });
    }

    function hideIncludedIngredients() {
        includedIngredients.forEach(function(ingredient) {
            $('#ingredientList li:contains("' + ingredient.name + '")').hide();
        });
    }

    // Event handler for form submission
    $('#form-create-food').submit(function(event) {

        // Prevent default form submission behavior
        event.preventDefault();

        // Get form data
        var formData = $(this).serializeArray();
        
        // Add foodIngredients to form data
        formData.push({ name: "foodIngredients", value: JSON.stringify(foodIngredients) });

        // Send data via AJAX
        $.ajax({
            url: $(this).attr('action'), // URL specified in the form action attribute
            method: $(this).attr('method'), // Method specified in the form method attribute
            data: formData, // Form data
            success: function(response) {
                // If there is a redirection URL in the response, redirect to it
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                // Handle submission errors
                console.error('An error occurred while sending the data:', error);
            }
        });  
    }); 
});
