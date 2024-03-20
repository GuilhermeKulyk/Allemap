import $ from 'jquery';

$(document).ready(function() {
    /* MEAL FORM */
    var includedFoods = [];
    var mealFoods = [];

    // Ao carregar a página, carrega os alimentos incluídos na lista principal.
    $('#includedFoods').empty();

    $('#mainFoodList li').each(function() {
        var foodId = $(this).data('id');
        var foodName = $(this).text().trim();
        $('#includedFoods').append('<li class="list-group-item bg-success" data-id="' + foodId + '">' + foodName + '</li>');
        
        includedFoods.push({ id: foodId, name: foodName });
        hideIncludedFoods(includedFoods);
        addFood(foodId);
    });

    // Função para atualizar a lista de alimentos incluídos no modal
    function updateIncludedFoodsModal() {
        $('#includedFood').empty();
        includedFoods.forEach(function(food) {
            $('#includedFood').append('<li class="list-group-item bg-success" data-id=' + food.id + '>' + food.name + '</li>');
        });
    }

    // Função para atualizar a lista de alimentos incluídos no formulário principal
    function updateIncludedFoodsForm() {
        $('#mainFoodList').empty(); // Limpa a lista de alimentos no formulário principal
        includedFoods.forEach(function(food) {
            $('#mainFoodList').append('<li class="list-group-item" data-id="' + food.id + '">' + food.name + '</li>');
        });
    }

    // Função para adicionar um alimento à lista e ao formulário principal
    function addFoodToList(food) {
        includedFoods.push(food);
        updateIncludedFoodsModal();
        updateIncludedFoodsForm();
        addFood(food.id);
        // Adiciona o alimento ao formulário principal
    }

    // Função para adicionar o id do alimento ao array mealFoods
    function addFood(foodId) {
        // Verifica se o id do alimento já existe no array para evitar duplicatas
        if (!mealFoods.includes(foodId)) {
            mealFoods.push(foodId);
        }
    }

    // Função para remover o id do alimento do array mealFoods
    function removeFood(foodId) {
        // Encontra o índice de foodId no array
        var index = mealFoods.indexOf(foodId);

        // Se foodId estiver no array, remove
        if (index !== -1) {
            mealFoods.splice(index, 1);
        }
    }

    // Manipulador de eventos para clicar em alimentos na lista de resultados da pesquisa
    $(document).on('click', '#foodList li', function() {
        var foodId = $(this).data('id');
        var foodName = $(this).text().trim();
        
        // Adiciona o alimento à lista de alimentos
        addFoodToList({ id: foodId, name: foodName });
        
        $(this).hide(); // Oculta o alimento na lista de resultados da pesquisa
        hideIncludedFoodsFromSearchResults(); 
    });

    // Manipulador de eventos para clicar em alimentos incluídos para removê-los
    $(document).on('click', '#includedFood li', function() {
        var foodName = $(this).text();
        var foodId = $(this).data('id');
        includedFoods = includedFoods.filter(function(food) {
            return food.name !== foodName;
        });
        updateIncludedFoodsModal();
        updateIncludedFoodsForm();
        removeFood(foodId);
        $('#foodList li:contains("' + foodName + '")').show();
    });

    // Função para ocultar os alimentos incluídos na lista de resultados da pesquisa
    function hideIncludedFoodsFromSearchResults() {
        includedFoods.forEach(function(food) {
            $('#foodList li:contains("' + food.name + '")').hide();
        });
    }

    function hideIncludedFoods() {
        includedFoods.forEach(function(food) {
            $('#foodList li:contains("' + food.name + '")').hide();
        });
    }

    // Manipulador de eventos para envio do formulário
    $('#meal-form').submit(function(event) {
        // Previne o comportamento padrão de envio do formulário
        event.preventDefault();

        // Obtém os dados do formulário
        var formData = $(this).serializeArray();
        console.log('AQUI OH ' + mealFoods)
        
        // Adiciona os alimentos ao formData
        formData.push({ name: "mealFoods", value: JSON.stringify(mealFoods) });
        console.log(formData);
        // Envia os dados via AJAX
        $.ajax({
            url: $(this).attr('action'), // URL especificada no atributo action do formulário
            method: 'POST', // Método especificado no atributo method do formulário
            data: formData, // Dados do formulário
            success: function(response) {
                // Se houver uma URL de redirecionamento na resposta, redirecione para ela
                window.location.href = response.redirect_url;
            },
            error: function(xhr, status, error) {
                // Trata erros de envio
                console.error('An error occurred while sending the data:', error);
            }
        });  
    }); 

    // Event handler for clicking the search button
    $('#searchButton').on('click', function() {
        var searchText = $('#foodSearch').val().toLowerCase();
        $('#foodList li').each(function() {
            var foodText = $(this).text().toLowerCase();
            if (foodText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
        hideIncludedFoodsFromSearchResults();
    });

    /* FOOD FORM */
    var includedIngredients = [];
    var foodIngredients = [];

    // no carregar da pagina ja carrega os ingredientes inclusos da lista principal.
    $('#includedIngredients').empty();

    $('#mainIngredientList li').each(function() {
        var ingredientId = $(this).data('id');
        var ingredientName = $(this).text().trim();
        $('#includedIngredients').append('<li class="list-group-item bg-success" data-id="' + ingredientId + '">' + ingredientName + '</li>');
        // fila o array de ingredients ja inclusos na comida
        
        includedIngredients.push({ id: ingredientId, name: ingredientName });
        hideIncludedIngredients(includedIngredients);
        addIngredient(ingredientId)
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
        console.log($(this).attr('action'))
        // Send data via AJAX
        $.ajax({
            url: $(this).attr('action'), // URL specified in the form action attribute
            method: 'POST', // Method specified in the form method attribute
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

    // Event handler for form submission
    $('#form-edit-food').submit(function(event) {

        // Prevent default form submission behavior
        event.preventDefault();

        // Get form data
        var formData = $(this).serializeArray();
        //console.log(JSON.stringify(foodIngredients));
        // Add foodIngredients to form data
        // Adicionar foodIngredients aos dados do formulário como um array
        formData.push({ name: "foodIngredients", value: foodIngredients });
        
        // Send data via AJAX
        $.ajax({
            url: $(this).attr('action'), // URL specified in the form action attribute
            method: 'PUT', // Method specified in the form method attribute
            data: formData, // Form data
            success: function(response) {
                // If there is a redirection URL in the response, redirect to it
                window.location.href = response.redirect_url;
                console.log('SUSSA!');
            },
            error: function(xhr, status, error) {
                // Handle submission errors
                console.error('An error occurred while sending the data:', error);
            }
        });  
    }); 

    /* SIDEMENU */
    // JavaScript 
  
});
