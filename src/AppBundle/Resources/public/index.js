$(function(){

    onChangeSelect('#selects_dependants_type', '#selects_dependants_brand');
    onChangeSelect('#selects_dependants_brand', '#selects_dependants_model');

});

/**
 * Permet de recharger les données du second select d'id selectIdToChange
 * grâce à la donnée selectionnée dans le le select d'id selectId.
 *
 * @param selectId
 * @param selectIdToChange
 *
 * @author Dominick Makome <makomedominick@gmail.com>
 */
function onChangeSelect(selectId, selectIdToChange)
{
    var container = '#select-in';
    $(container).on('change', selectId, function(e){
        e.preventDefault();

        var form = $(this).closest('form');
        var data = {};
        var type = $(selectId);
        data[type.attr('name')] = type.val();

        $.ajax({
            url: form.attr('action'),
            type: form.attr('method'),
            data: data,
            success: function (html) {
                $(selectIdToChange).replaceWith(
                    $(html).find(selectIdToChange)
                );
            }
        });
    })
}