import './bootstrap';

$(document).ready(function() {
    var includedIngredients = []; // Array para armazenar os ingredientes incluídos

    // Função para atualizar a lista de ingredientes incluídos no modal
    function updateIncludedIngredientsModal() {
        $('#includedIngredients').empty();
        includedIngredients.forEach(function(ingredient) {
            $('#includedIngredients').append('<li class="list-group-item bg-success">' + ingredient.name + '</li>');
        });
    }

    // Função para atualizar a lista de ingredientes incluídos no formulário principal
    function updateIncludedIngredientsForm() {
        $('#mainIngredientList').empty(); // Limpa a lista de ingredientes no formulário principal
        includedIngredients.forEach(function(ingredient) {
            $('#mainIngredientList').append('<li class="list-group-item">' + ingredient.name + '</li>');
        });
    }

    // Função para adicionar um ingrediente à lista e ao formulário
    function addIngredientToList(ingredient) {
        includedIngredients.push(ingredient);
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
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
        var ingredientName = $(this).text();
        addIngredientToList({ name: ingredientName });
        $(this).hide();
        hideIncludedIngredientsFromSearchResults();
    });

    // Evento de clique nos ingredientes da lista de incluídos para removê-los
    $(document).on('click', '#includedIngredients li', function() {
        var ingredientName = $(this).text();
        includedIngredients = includedIngredients.filter(function(ingredient) {
            return ingredient.name !== ingredientName;
        });
        updateIncludedIngredientsModal();
        updateIncludedIngredientsForm();
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
});