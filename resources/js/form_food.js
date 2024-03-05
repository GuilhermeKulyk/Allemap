$(document).ready(function() {
    $('#searchButton').on('click', function() {
        console.log('aqui');
        var searchText = $('#ingredientSearch').val().toLowerCase();
        $('#ingredientList li').each(function() {
            var ingredientText = $(this).text().toLowerCase();
            if (ingredientText.includes(searchText)) {
                $(this).show();
            } else {
                $(this).hide();
            }
        });
    });

    // Limpar a pesquisa e mostrar todos os ingredientes quando o campo de busca estiver vazio
    $('#ingredientSearch').on('input', function() {
        var searchText = $(this).val().toLowerCase();
        if (searchText === '') {
            $('#ingredientList li').show();
        }
    });
});
