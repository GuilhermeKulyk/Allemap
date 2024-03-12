import $ from 'jquery';

$(document).ready(function() {
    var includedIngredients = []; // Array para armazenar os ingredientes incluídos

    var   foodIngredients = [];

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

        //$('#includedIngredients').empty();

        // Atualizar a lista de ingredientes no formulário principal
        //updateIncludedIngredientsForm();
        
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

    // Evento de envio do formulário
    $('#form-create-food').submit(function(event) {

        // Evitar o comportamento padrão de envio do formulário
        event.preventDefault();

        // Obter os dados do formulário
        var formData = $(this).serializeArray();
        
        // Adicionar foodIngredients aos dados do formulário
        formData.push({ name: "foodIngredients", value: JSON.stringify(foodIngredients) });

        // Enviar os dados via AJAX
        // Enviar os dados via AJAX
        $.ajax({
            url: $(this).attr('action'), // URL especificada no atributo action do formulário
            method: $(this).attr('method'), // Método especificado no atributo method do formulário
            data: formData, // Dados do formulário
            success: function(response) {
                // Se houver uma URL de redirecionamento na resposta, redirecione para ela

                    window.location.href = response.redirect_url;

            },
            error: function(xhr, status, error) {
                // Lidar com erros de envio
                console.error('Ocorreu um erro ao enviar os dados:', error);
            }
        });  
    }); 

    // Evento disparado quando o modal de edição é mostrado
    $('#addIngredientsModal').on('show.bs.modal', function(event) {
        // Limpar a lista de ingredientes incluídos
        $('#includedIngredients').empty();
        
        // Verificar se existem ingredientes associados ao alimento
        console.log(foodIngredients);
        if (foodIngredients.length > 0) {
            // Preencher a lista de ingredientes incluídos com os ingredientes associados ao alimento
            includedIngredients.forEach(function(ingredient) {
                $('#includedIngredients').append('<li class="list-group-item bg-success" data-id=' + ingredient.id + '>' + ingredient.name + '</li>');
            });

            // Ocultar ingredientes incluídos da lista de resultados de busca
            hideIncludedIngredientsFromSearchResults();
        }
    });
});
