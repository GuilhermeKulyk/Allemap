import './bootstrap';

$(document).ready(function() {
    var includedIngredients = []; // Array para armazenar os ingredientes incluídos

    var foodIngredients = [];

    // Função para atualizar a lista de ingredientes incluídos no modal
    function updateIncludedIngredientsModal() {
        $('#includedIngredients').empty();
        includedIngredients.forEach(function(ingredient) {
            $('#includedIngredients').append('<li class="list-group-item bg-success" data-id=' + ingredient.id + '>' + ingredient.name + '</li>');
        });
        
    }

    // Função para atualizar a lista de ingredientes incluídos no formulário principal
    function updateIncludedIngredientsForm() {
        $('#mainIngredientList').empty(); // Limpa a lista de ingredientes no formulário principal
        includedIngredients.forEach(function(ingredient) {
            $('#mainIngredientList').append('<li class="list-group-item" data-id="' + ingredient.id + '">' + ingredient.name + '</li>');
        });
    }

    // Função para adicionar um ingrediente à lista e ao formulário
    function addIngredientToList(ingredient) {
        includedIngredients.push(ingredient);
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
        addIngredient(ingredient.id);
        console.log(foodIngredients);
    }

    // Função para adicionar o ingredient-id à array foodIngredients
    function addIngredient(ingredientId) {
        // Verifica se o ingredient-id já existe na array, para evitar duplicatas
        if (!foodIngredients.includes(ingredientId)) {
            foodIngredients.push(ingredientId);
        }
    }

    // Função para remover o ingredient-id da array foodIngredients
    function removeIngredient(ingredientId) {
        // Encontra o índice do ingredientId na array
        var index = foodIngredients.indexOf(ingredientId);

        // Se o ingredientId estiver na array, remove-o
        if (index !== -1) {
            foodIngredients.splice(index, 1);
        }
    }

    // Evento de clique no botão de salvar ingredientes
    $('#saveIngredients').on('click', function() {
        // Limpar a lista de ingredientes no modal

        $('#includedIngredients').empty();

        // Atualizar a lista de ingredientes no formulário principal
        updateIncludedIngredientsForm();
        
        // Fechar o modal
        $('#addIngredientsModal').modal('hide');
        
    });

    // Evento de clique no botão de busca
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

    // Evento de pressionar Enter no campo de busca
    $('#ingredientSearch').keypress(function(e) {
        if (e.which === 13) {
            $('#searchButton').click();
        }
    });

    // Evento de clique nos ingredientes da lista de resultados
    $(document).on('click', '#ingredientList li', function() {
        var ingredientId = $(this).data('id'); // Obtém o ID do ingrediente do atributo data-id
        var ingredientName = $(this).text().trim(); // Obtém o nome do ingrediente (removendo espaços extras)
        
        // Adiciona o ingrediente à lista de ingredientes
        addIngredientToList({ id: ingredientId, name: ingredientName });
        
        $(this).hide(); // Oculta o ingrediente da lista de resultados
        hideIncludedIngredientsFromSearchResults(); // Oculta ingredientes incluídos da lista de resultados
    });

    // Evento de clique nos ingredientes da lista de incluídos para removê-los
    $(document).on('click', '#includedIngredients li', function() {
        var ingredientName = $(this).text();
        var ingredientId = $(this).data('id');
        includedIngredients = includedIngredients.filter(function(ingredient) {
            return ingredient.name !== ingredientName;
        });
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
        removeIngredient(ingredientId);
        console.log(foodIngredients);
        $('#ingredientList li:contains("' + ingredientName + '")').show();
    });

    // Função para ocultar ingredientes incluídos na lista de resultados da busca
    function hideIncludedIngredientsFromSearchResults() {
        includedIngredients.forEach(function(ingredient) {
            $('#ingredientList li:contains("' + ingredient.name + '")').hide();
        });
    }

    // Evento ao abrir o modal para atualizar os ingredientes incluídos
    $('#addIngredientsModal').on('show.bs.modal', function() {
        updateIncludedIngredientsModal();
    });

    $('#saveIngredients').on('click', function() {
        console.log(foodIngredients);
        // Extrair apenas os nomes dos ingredientes
        var ingredientNames = includedIngredients.map(function(ingredient) {
            return ingredient.name;
        });

    });  
});
